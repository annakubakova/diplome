<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fractalpaint_workshops";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}

// Обработка формы
$success = false;
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Валидация данных
    $lastName = trim($_POST['lastName'] ?? '');
    $firstName = trim($_POST['firstName'] ?? '');
    $middleName = trim($_POST['middleName'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $workshop = trim($_POST['workshop'] ?? '');
    $agree = isset($_POST['agree']) ? 1 : 0;
    
    if (empty($lastName)) $errors[] = "Фамилия обязательна для заполнения";
    if (empty($firstName)) $errors[] = "Имя обязательно для заполнения";
    if (empty($phone)) $errors[] = "Телефон обязателен для заполнения";
    if (empty($workshop)) $errors[] = "Выберите мастер-класс";
    if (!$agree) $errors[] = "Необходимо согласие на обработку данных";
    
    if (empty($errors)) {
        try {
            // Проверка на существующую регистрацию
            $checkStmt = $conn->prepare("SELECT COUNT(*) FROM registrations 
                                        WHERE last_name = :lastName 
                                        AND first_name = :firstName 
                                        AND phone = :phone 
                                        AND workshop = :workshop");
            $checkStmt->bindParam(':lastName', $lastName);
            $checkStmt->bindParam(':firstName', $firstName);
            $checkStmt->bindParam(':phone', $phone);
            $checkStmt->bindParam(':workshop', $workshop);
            $checkStmt->execute();
            
            $count = $checkStmt->fetchColumn();
            
            if ($count > 0) {
                $errors[] = "Вы уже зарегистрированы на этот мастер-класс";
            } else {
                // Регистрация нового участника
                $stmt = $conn->prepare("INSERT INTO registrations 
                    (last_name, first_name, middle_name, phone, email, workshop, agree, registration_date) 
                    VALUES (:lastName, :firstName, :middleName, :phone, :email, :workshop, :agree, NOW())");
                
                $stmt->bindParam(':lastName', $lastName);
                $stmt->bindParam(':firstName', $firstName);
                $stmt->bindParam(':middleName', $middleName);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':workshop', $workshop);
                $stmt->bindParam(':agree', $agree, PDO::PARAM_INT);
                
                $stmt->execute();
                $success = true;
            }
        } catch(PDOException $e) {
            $errors[] = "Ошибка при сохранении данных: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Запись на мастер-класс | Fractal Paint</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
        /* Основные стили */
        body {
            font-family: 'Comfortaa', sans-serif;
            background-color: #fff;
            color: #333;
            line-height: 1.6;
        }
        
        .registration-page {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .registration-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px 20px;
        }
        
        .registration-card {
            max-width: 800px;
            margin: 0 auto;
            width: 100%;
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
        }
        
        .success-message {
            padding: 40px;
        }
        
        h1 {
            color: var(--oxford-blue);
            font-size: 36px;
            margin-bottom: 30px;
            font-weight: 700;
        }
        
        h2 {
            color: var(--royal-blue-dark);
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        p {
            font-size: 18px;
            color: #555;
            margin-bottom: 30px;
        }
        
        /* Стили формы */
        .workshop-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            text-align: left;
        }
        
        .form-row {
            display: flex;
            gap: 20px;
        }
        
        .form-row .form-group {
            flex: 1;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--royal-blue-dark);
        }
        
        .required label::after {
            content: '*';
            color: var(--bittersweet);
            margin-left: 4px;
        }
        
        input, select {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
            font-family: 'Comfortaa', sans-serif;
            transition: all 0.3s;
        }
        
        input:focus, select:focus {
            outline: none;
            border-color: var(--bittersweet);
            box-shadow: 0 0 0 3px rgba(218, 37, 28, 0.1);
        }
        
        /* Чекбокс */
        .checkbox-group {
            display: flex;
            align-items: center;
            margin: 25px 0;
        }
        
        .checkbox-group input {
            width: auto;
            margin-right: 12px;
        }
        
        .checkbox-group label {
            margin: 0;
            font-weight: normal;
        }
        
        /* Кнопки */
        .btn {
            display: inline-block;
            padding: 14px 32px;
            background: var(--bittersweet);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-family: 'Comfortaa', sans-serif;
            text-decoration: none;
        }
        
        .btn:hover {
            background: #c21a12;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(218, 37, 28, 0.3);
        }
        
        .btn-secondary {
            background: var(--royal-blue-dark);
        }
        
        .btn-secondary:hover {
            background: var(--oxford-blue);
        }
        
        /* Сообщения об ошибках */
        .error-message {
            background: #ffebee;
            border-left: 4px solid var(--bittersweet);
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 4px;
            text-align: left;
        }
        
        .error-message h4 {
            color: var(--bittersweet);
            margin-top: 0;
            margin-bottom: 10px;
        }
        
        .error-message ul {
            margin: 0;
            padding-left: 20px;
        }
        
        .error-message li {
            margin-bottom: 5px;
        }
        
        /* Адаптация для мобильных */
        @media (max-width: 768px) {
            .registration-card {
                padding: 30px 20px;
            }
            
            .form-row {
                flex-direction: column;
                gap: 15px;
            }
            
            h1 {
                font-size: 28px;
            }
            
            h2 {
                font-size: 22px;
            }
            
            p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body id="top">


    <main>
        <section class="workshops-slider">
            <div class="container">
                <h2 class="h2 section-title">Регистрация на мастер-класс</h2>
                
                <?php if ($success): ?>
                    <div class="success-message">
                        <h3>Спасибо за регистрацию!</h3>
                        <p>Ваша заявка успешно отправлена. Мы свяжемся с вами в ближайшее время для подтверждения.</p>
                        <a href="index.php" class="btn btn-primary">Вернуться на главную</a>
                    </div>
                <?php else: ?>
                    <?php if (!empty($errors)): ?>
                        <div class="error-message">
                            <h4>Ошибки при заполнении формы:</h4>
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <form class="workshop-form" method="POST" action="register.php">
                        <div class="form-group">
                            <label for="lastName">*Фамилия</label>
                            <input type="text" id="lastName" name="lastName" required 
                                   value="<?= htmlspecialchars($_POST['lastName'] ?? '') ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="firstName">*Имя</label>
                            <input type="text" id="firstName" name="firstName" required 
                                   value="<?= htmlspecialchars($_POST['firstName'] ?? '') ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="middleName">Отчество</label>
                            <input type="text" id="middleName" name="middleName" 
                                   value="<?= htmlspecialchars($_POST['middleName'] ?? '') ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">*Телефон</label>
                            <input type="tel" id="phone" name="phone" required 
                                   placeholder="+7 (___) ___-__-__"
                                   value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" 
                                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="workshop">*Мастер-класс</label>
                            <select id="workshop" name="workshop" required>
                                <option value="">Выберите мастер-класс</option>
                                <option value="Наше — родное! (15 августа)" <?= (isset($_POST['workshop']) && $_POST['workshop'] == 'Наше — родное! (15 августа)') ? 'selected' : '' ?>>Наше — родное! (15 августа 2025, 18:00)</option>
                                <option value="Криво, косо, но пойдет! (22 июля)" <?= (isset($_POST['workshop']) && $_POST['workshop'] == 'Криво, косо, но пойдет! (22 июля)') ? 'selected' : '' ?>>Криво, косо, но пойдет! (22 июля 2025, 18:00)</option>
                            </select>
                        </div>
                        
                        <div class="form-group checkbox-group">
                            <input type="checkbox" id="agree" name="agree" required <?= isset($_POST['agree']) ? 'checked' : '' ?>>
                            <label for="agree">Я согласен на обработку персональных данных!</label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                    </form>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-top" id="contact">
            <div class="container">
                <div class="footer-brand">
                    <a href="#" class="logo"><img src="img/logo.png" alt="Funel logo" width="180px"></a>

                    <p class="footer-text">Следите за нами на других платформах</p>

                    <ul class="social-list">
                        <li><a class="social-link"><ion-icon name="logo-instagram"></ion-icon></a></li>
                        <li><a class="social-link"><ion-icon name="logo-youtube"></ion-icon></a></li>
                    </ul>
                </div>

                <div class="footer-link-box">
                    <ul class="footer-link-list">
                        <li><h3 class="h4 link-title">Фрактальные краски</h3></li>
                        <li><a href="index.php" class="footer-link">На главную</a></li>
                        <li><a href="https://vk.com/fractalpaint" class="footer-link">Группа ВКонтакте</a></li>
                        <li><a href="https://fractalpaint.com/" class="footer-link">Интернет-магазин</a></li>
                    </ul>

                    <ul class="footer-link-list">
                        <li><h3 class="h4 link-title">Документация</h3></li>
                        <li><a href="dock.php" class="footer-link">Правовая документация</a></li>
                    </ul>

                    <ul class="footer-link-list">
                        <li><h3 class="h4 link-title">Мастер-классы</h3></li>
                        <li><a href="event.php" class="footer-link">Больше о мастер-классах</a></li>
                        <li><a href="register.php" class="footer-link">Регистрация на мастер-класс</a></li>
                    </ul>

                    <ul class="footer-link-list">
                        <li><h3 class="h4 link-title">Сотрудничество</h3></li>
                        <li><a href="barter.php" class="footer-link">Сотрудничество</a></li>
                        <li><a href="https://docs.google.com/forms/d/e/1FAIpQLSfBLiGEjIjE3vehUKsJ6Zh5FTCrvrgdJ2rbPw7-dHF1Yd9A7g/viewform?usp=dialog" class="footer-link">Анкета для сотрудничества</a></li>
                    </ul>

                    <ul class="footer-link-list">
                        <li><h3 class="h4 link-title">Связь с нами</h3></li>
                        <li><a href="#" class="footer-link">+7-900-536-48-88</a></li>
                        <li><a href="#" class="footer-link">info@fractalpaint.com</a></li>
                        <li><a href="#" class="footer-link"></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="copyright" >©FractalPaint 2016–2025. Все права защищены.</p>
            <a href="admin_login.php" style="display: inline-block; padding: 5px 10px; background: white; color: #f8f8ff; text-decoration: none; border: 1px solid #f8f8ff; border-radius: 3px; font-size: 12px; cursor: pointer;">Перейти</a>
        </div>
    </footer>

    <script>
    // Маска для телефона
    document.getElementById('phone').addEventListener('input', function(e) {
        let x = e.target.value.replace(/\D/g, '').match(/(\d{0,1})(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})/);
        e.target.value = !x[2] ? '+7' + x[1] : '+7 (' + x[2] + ') ' + x[3] + (x[4] ? '-' + x[4] : '') + (x[5] ? '-' + x[5] : '');
    });
    </script>
</body>

</html>
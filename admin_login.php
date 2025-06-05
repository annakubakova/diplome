<?php
session_start();

// Проверка авторизации
if (isset($_SESSION['admin_logged_in'])) {
    header('Location: admin.php');
    exit;
}

// Обработка входа
$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === 'admin' && $password === 'admin1') {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Неверные учетные данные';
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в админ-панель | Fractal Paint</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --login-bg: #f8f9fa;
            --card-shadow: 0 10px 30px -15px rgba(0, 0, 0, 0.1);
            --input-focus: 0 0 0 3px rgba(218, 37, 28, 0.2);
        }
        
        body {
            background: var(--login-bg);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            font-family: 'Comfortaa', sans-serif;
        }
        
        .login-wrapper {
            width: 100%;
            max-width: 480px;
            animation: fadeIn 0.5s ease;
        }
        
        .login-card {
            background: var(--white);
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .login-header {
            background: var(--white);
            color: var(--white);
            padding: 30px;
            text-align: center;
            position: relative;
        }
        
        .login-header h1 {
            margin: 0;
            font-size: var(--fs-2);
            font-weight: var(--fw-700);
            position: relative;
            z-index: 1;
        }
        
        .login-header::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 0;
            right: 0;
            height: 40px;
            background: var(--white);
            transform: skewY(-3deg);
            z-index: 0;
        }
        
        .login-body {
            padding: 40px;
            position: relative;
        }
        
        .error-message {
            background: #ffebee;
            color: #d32f2f;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            font-size: var(--fs-6);
            display: flex;
            align-items: center;
            gap: 10px;
            animation: shake 0.5s;
        }
        
        .error-message::before {
            content: '!';
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
            background: #d32f2f;
            color: white;
            border-radius: 50%;
            font-weight: bold;
        }
        
        .login-form {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .form-group label {
            font-size: var(--fs-5);
            color: var(--royal-blue-dark);
            font-weight: var(--fw-600);
        }
        
        .form-control {
            padding: 14px 16px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: var(--fs-5);
            transition: all var(--transition);
            background: #f8f9fa;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--bittersweet);
            box-shadow: var(--input-focus);
            background: var(--white);
        }
        
        .login-btn {
            padding: 14px;
            background: var(--bittersweet);
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-size: var(--fs-5);
            font-weight: var(--fw-600);
            cursor: pointer;
            transition: all var(--transition);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 10px;
        }
        
        .login-btn:hover {
            background: #c21a12;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(218, 37, 28, 0.3);
        }
        
        .login-footer {
            text-align: center;
            margin-top: 30px;
            color: var(--rythm);
            font-size: var(--fs-6);
        }
        
        /* Анимации */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
        
        /* Адаптация для мобильных */
        @media (max-width: 576px) {
            .login-header {
                padding: 25px 20px;
            }
            
            .login-body {
                padding: 30px 20px;
            }
            
            .login-header h1 {
                font-size: var(--fs-3);
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <h1>Админ панель</h1>
            </div>
            
            <div class="login-body">
                <?php if ($error): ?>
                    <div class="error-message">
                        <?= $error ?>
                    </div>
                <?php endif; ?>
                
                <form class="login-form" method="POST">
                    <div class="form-group">
                        <label for="username">Имя пользователя</label>
                        <input type="text" id="username" name="username" class="form-control" required autofocus>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    
                    <button type="submit" class="login-btn">Войти в систему</button>
                </form>
                
                <div class="login-footer">
                    Fractal Paint Admin Panel
                </div>
            </div>
        </div>
    </div>
</body>
</html>
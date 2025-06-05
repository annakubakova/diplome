<?php
session_start();

// Проверка авторизации
function checkAuth() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: admin_login.php');
        exit;
    }
}

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

// Обработка выхода
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin_login.php');
    exit;
}

// Обработка изменения статуса
if (isset($_POST['change_status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    
    $stmt = $conn->prepare("UPDATE registrations SET status = :status WHERE id = :id");
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    header('Location: admin.php');
    exit;
}

// Получение всех регистраций
$stmt = $conn->query("SELECT * FROM registrations ORDER BY registration_date DESC");
$registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);

checkAuth();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель | Fractal Paint</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Админ-панель - основные стили */
.admin-container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
}

.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 2px solid var(--bittersweet);
}

.admin-header h1 {
    color: var(--oxford-blue);
    font-size: var(--fs-2);
    margin: 0;
}

.logout-btn {
    background: var(--bittersweet);
    color: var(--white);
    padding: 10px 20px;
    border-radius: 8px;
    font-size: var(--fs-6);
    font-weight: var(--fw-600);
    text-transform: uppercase;
    transition: all var(--transition);
    border: 2px solid var(--bittersweet);
}

.logout-btn:hover {
    background: transparent;
    color: var(--bittersweet);
}

/* Статистика */
.stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
    margin-bottom: 40px;
}

.stat-card {
    background: var(--white);
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.stat-card h3 {
    color: var(--royal-blue-dark);
    font-size: var(--fs-5);
    margin: 0 0 15px 0;
    font-weight: var(--fw-600);
}

.stat-value {
    font-size: 36px;
    font-weight: var(--fw-700);
    color: var(--bittersweet);
    margin: 0;
    line-height: 1;
}

/* Таблица регистраций */
.registrations-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin: 30px 0;
    background: var(--white);
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.registrations-table th {
    background: var(--bittersweet);
    color: var(--white);
    padding: 15px;
    font-weight: var(--fw-600);
    text-align: left;
    position: sticky;
    top: 0;
}

.registrations-table td {
    padding: 15px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    vertical-align: middle;
}

.registrations-table tr:last-child td {
    border-bottom: none;
}

.registrations-table tr:hover td {
    background: rgba(218, 37, 28, 0.03);
}

/* Статусы */
.status-pending {
    color: #FFA000;
    font-weight: var(--fw-600);
}

.status-confirmed {
    color: #4CAF50;
    font-weight: var(--fw-600);
}

.status-cancelled {
    color: #F44336;
    font-weight: var(--fw-600);
}

/* Форма изменения статуса */
.status-form {
    display: flex;
    align-items: center;
    gap: 10px;
}

.status-select {
    padding: 8px 12px;
    border-radius: 8px;
    border: 1px solid #ddd;
    font-size: var(--fs-6);
    background: var(--white);
    color: var(--oxford-blue);
    flex-grow: 1;
    min-width: 150px;
}

.status-btn {
    padding: 8px 15px;
    background: var(--bittersweet);
    color: var(--white);
    border: none;
    border-radius: 8px;
    font-size: var(--fs-6);
    font-weight: var(--fw-600);
    cursor: pointer;
    transition: all var(--transition);
    white-space: nowrap;
}

.status-btn:hover {
    background: #c21a12;
    transform: translateY(-2px);
}

/* Адаптация для мобильных */
@media (max-width: 992px) {
    .admin-container {
        padding: 0 15px;
    }
    
    .stats-container {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 768px) {
    .admin-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .stats-container {
        grid-template-columns: 1fr;
    }
    
    .registrations-table {
        display: block;
        overflow-x: auto;
    }
    
    .status-form {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    
    .status-select {
        width: 100%;
    }
    
    .status-btn {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .stat-card {
        padding: 20px 15px;
    }
    
    .stat-value {
        font-size: 28px;
    }
    
    .registrations-table th,
    .registrations-table td {
        padding: 12px 10px;
        font-size: var(--fs-6);
    }
}
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <h1>Админ-панель Fractal Paint</h1>
            <a href="?logout=1" class="logout-btn">Выйти</a>
        </div>
        
        <!-- Статистика -->
        <div class="stats-container">
            <?php
            // Получаем статистику
            $total = $conn->query("SELECT COUNT(*) FROM registrations")->fetchColumn();
            $pending = $conn->query("SELECT COUNT(*) FROM registrations WHERE status = 'pending'")->fetchColumn();
            $confirmed = $conn->query("SELECT COUNT(*) FROM registrations WHERE status = 'confirmed'")->fetchColumn();
            ?>
            
            <div class="stat-card">
                <h3>Всего заявок</h3>
                <div class="stat-value"><?= $total ?></div>
            </div>
            
            <div class="stat-card">
                <h3>На рассмотрении</h3>
                <div class="stat-value"><?= $pending ?></div>
            </div>
            
            <div class="stat-card">
                <h3>Подтверждено</h3>
                <div class="stat-value"><?= $confirmed ?></div>
            </div>
        </div>
        
        <!-- Таблица заявок -->
        <h2>Список регистраций</h2>
        <table class="registrations-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Дата</th>
                    <th>ФИО</th>
                    <th>Телефон</th>
                    <th>Email</th>
                    <th>Мастер-класс</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registrations as $reg): ?>
                <tr>
                    <td><?= $reg['id'] ?></td>
                    <td><?= date('d.m.Y H:i', strtotime($reg['registration_date'])) ?></td>
                    <td><?= htmlspecialchars($reg['last_name'] . ' ' . htmlspecialchars($reg['first_name'] . ' ' . htmlspecialchars($reg['middle_name']))) ?></td>
                    <td><?= htmlspecialchars($reg['phone']) ?></td>
                    <td><?= htmlspecialchars($reg['email']) ?></td>
                    <td><?= htmlspecialchars($reg['workshop']) ?></td>
                    <td class="status-<?= $reg['status'] ?>"><?= $reg['status'] ?></td>
                    <td>
                        <form class="status-form" method="POST">
                            <input type="hidden" name="id" value="<?= $reg['id'] ?>">
                            <select name="status" class="status-select">
                                <option value="pending" <?= $reg['status'] == 'pending' ? 'selected' : '' ?>>На рассмотрении</option>
                                <option value="confirmed" <?= $reg['status'] == 'confirmed' ? 'selected' : '' ?>>Подтверждено</option>
                                <option value="cancelled" <?= $reg['status'] == 'cancelled' ? 'selected' : '' ?>>Отменено</option>
                            </select>
                            <button type="submit" name="change_status" class="status-btn">OK</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
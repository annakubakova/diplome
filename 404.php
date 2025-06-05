<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Страница не найдена | Fractal Paint</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        .error-page {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
            padding: 20px;
            background-color: var(--white);
        }

        .error-content {
            max-width: 600px;
            margin: 0 auto;
        }

        .error-code {
            font-size: 120px;
            font-weight: var(--fw-700);
            color: var(--bittersweet);
            margin-bottom: 20px;
            line-height: 1;
        }

        .error-title {
            font-size: var(--fs-2);
            color: var(--oxford-blue);
            margin-bottom: 20px;
            font-weight: var(--fw-600);
        }

        .error-text {
            font-size: var(--fs-4);
            color: var(--rythm);
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .btn-404 {
            display: inline-block;
            padding: 12px 30px;
            background-color: var(--bittersweet);
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-weight: var(--fw-600);
            font-size: var(--fs-5);
            transition: all 0.3s ease;
            border: 2px solid var(--bittersweet);
        }

        .btn-404:hover {
            background-color: transparent;
            color: var(--bittersweet);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(218, 37, 28, 0.3);
        }

        @media (max-width: 768px) {
            .error-code {
                font-size: 80px;
            }
            
            .error-title {
                font-size: var(--fs-3);
            }
            
            .error-text {
                font-size: var(--fs-5);
            }
        }
    </style>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>

    <header>
        <div class="container">
            <a href="index.php" class="logo">
                <img src="img/logo.png" alt="Fractal Paint Logo" width="80">
            </a>

            <div class="navbar-wrapper">
                <button class="navbar-menu-btn" data-navbar-toggle-btn aria-label="Toggle menu">
                    <ion-icon name="menu-outline"></ion-icon>
                </button>

                <nav class="navbar" data-navbar>
                    <ul class="navbar-list">
                        <li class="nav-item"><a href="index.php" class="nav-link">Главная</a></li>
                        <li class="nav-item"><a href="event.php" class="nav-link">Мастер-классы</a></li>
                        <li class="nav-item"><a href="dock.php" class="nav-link">Документация</a></li>
                        <li class="nav-item"><a href="barter.php" class="nav-link">Сотрудничество</a></li>
                        <li class="nav-item"><a href="#contact" class="nav-link">Контакты</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <div class="error-page">
            <div class="error-content">
                <div class="error-code">404</div>
                <h1 class="error-title">Страница не найдена</h1>
                <p class="error-text">Неправильно набран адрес или такой страницы не существует</p>
                <a href="index.php" class="btn-404">Вернуться на главную</a>
            </div>
        </div>
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
        </div>
    </footer>
</body>
<script>
    // Меню для мобильных
    const navbarToggleBtn = document.querySelector('[data-navbar-toggle-btn]');
    const navbar = document.querySelector('[data-navbar]');
    
    navbarToggleBtn.addEventListener('click', function() {
        navbar.classList.toggle('active');
        this.classList.toggle('active');
    });
    
    // Закрытие меню при клике на ссылку
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            navbar.classList.remove('active');
            navbarToggleBtn.classList.remove('active');
        });
    });
    
    // Эффект при скролле
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            document.querySelector('header').classList.add('scrolled');
        } else {
            document.querySelector('header').classList.remove('scrolled');
        }
    });
</script>
</html>
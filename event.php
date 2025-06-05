<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Мастер-классы | Fractal Paint</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body id="top">
    <header>
        <div class="container">
            <a href="#" class="logo"><img src="img/logo.png" alt="Funel logo" width="80px"></a>

            <div class="navbar-wrapper">
                <button class="navbar-menu-btn" data-navbar-toggle-btn><ion-icon name="menu-outline"></ion-icon></button>
                <nav class="navbar " data-navbar>
                    <ul class="navbar-list">
                        <li class="nav-item"><a href="index.php" class="nav-link">Главная</a></li>
                        <li class="nav-item"><a href="#workshops" class="nav-link">Мастер-классы</a></li>
                        <li class="nav-item"><a href="register.php" class="nav-link">Запись на МК</a></li>
                        <li class="nav-item"><a href="barter.php" class="nav-link">Сотрудничество</a></li>
                        <li class="nav-item"><a href="dock.php" class="nav-link">Документация</a></li>
                        <li class="nav-item"><a href="#contact" class="nav-link">Контакты</a></li>
                    </ul>
                </nav>

                <div class="menu-overlay" data-nav-overlay></div>
            </div>
        </div>
    </header>

    <main>
        <article>
            <section class="hero" id="home">
                <div class="container">
                    <div class="hero-content">
                        <h1 class="h1 hero-title">Предстоящие мероприятия с Fractal Paint </h1>

                        <p class="hero-text">Поможем не только опробовать продукт, но и создать уникальную вещь в вашем гардеробе!</p>
                        <form action="#contact" target="_blank">
                    </div>
                    <div class="hero-banner2"></div>
                </div>

            </section>

            <section class="features" id="about">
                <h3 class="audience-title">Профессионалы творческих наук</h3> 
                <div class="container">
                    <ul class="features-list">
                        <li class="features-item">
                            <figure class="features-item-banner"><img src="img/russkoe.png" alt="feature banner"></figure>

                            <div class="feature-item-content">
                                <h3 class="h2 item-title">Наше — родное!</h3>

                                <p class="item-text"> Погрузимся в мир народного творчества и создадим уникальные футболки с узорами, вдохновлёнными русскими сказками c Мариной Беловой! Вы научитесь работать с традиционными мотивами: жар-птицы, древо жизни, а также освоите элементы гжельской и хохломской росписи. </p>
                                <p class="item-text"> Марина Белова — королева этно-фьюжн и ручной росписи. Работает со славянскими мотивами, любит сочетать традиционные техники с современными трендами.
                                                      Приходите создавать свою сказочную вещь под руководством мастера! </p>
                            </div>
                        </li>

                        <li class="features-item">
                            <figure class="features-item-banner"><img src="img/karakuli.png" alt="feature banner"></figure>

                            <div class="feature-item-content">
                                <h3 class="h2 item-title">Криво, косо, но пойдет!</h3>

                                <p class="item-text">Приглашаем вас на творческий мастер-класс, где вы освоите современную каллиграфию и перенесёте свои работы на ткань. Узнаете все тонкости работы с профессиональными красками и создадите уникальный дизайн футболки.</p>

                                <p class="item-text">Нашим проводником в мир уличной каллиграфии станет художник Алексей Волков, специализирующийся на динамичных шрифтах и графике. Его работы для музыкальных брендов и коллаборации с Fractal Paint давно заслужили признание в индустрии.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>

            <!-- Слайдер мастер-классов -->
            <section class="workshops-slider" id="workshops">
                <div class="container">
                    <h2 class="h2 section-title">Запись на мастер-класс</h2>
                    <p class="section-subtitle">Учитесь у профессионалов и создавайте уникальные работы</p>
                    
                    <div class="slider-container">
                        <div class="slider-track">
                            <!-- Слайд 1 -->
                            <div class="slide">
                                <div class="slide-image">
                                    <img src="img/event1.png" alt="Мастер-класс">
                                </div>
                                <div class="slide-content">
                                    <h3>Наше — родное!</h3>
                                    <div class="workshop-info">
                                        <p><ion-icon name="calendar-outline"></ion-icon> 15 августа 2025, 18:00</p>
                                        <p><ion-icon name="time-outline"></ion-icon> 3 часа</p>
                                        <p><ion-icon name="pricetag-outline"></ion-icon> 5500 руб.</p>
                                    </div>
                                    <p class="workshop-desc">Научись создавать уникальные дизайны на одежде с помощью наших профессиональных красок в русско-народном стиле с изюминкой современности. Все материалы предоставляются.</p>
                                    <form action="#about" target="_blank">
                                        <button type="submit" class="btn btn-primary">Записаться</button>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Слайд 2 -->
                            <div class="slide">
                                <div class="slide-image">
                                    <img src="img/event2.png" alt="Мастер-класс">
                                </div>
                                <div class="slide-content">
                                    <h3>Криво, косо, но пойдет!</h3>
                                    <div class="workshop-info">
                                        <p><ion-icon name="calendar-outline"></ion-icon> 22 июля 2025, 18:00</p>
                                        <p><ion-icon name="time-outline"></ion-icon> 2.5 часа</p>
                                        <p><ion-icon name="pricetag-outline"></ion-icon> 4000 руб.</p>
                                    </div>
                                    <p class="workshop-desc">Научись создавать уникальные дизайны на одежде с помощью наших профессиональных красок в стиле каллиграфии и современности. Все материалы предоставляются.</p>
                                    <form action="register.php" method="get" target="_blank">
                                        <button type="submit" class="btn btn-primary">Записаться</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Кнопки навигации вынесены за пределы slider-track -->
                        <button class="slider-btn prev"><ion-icon name="chevron-back-outline"></ion-icon></button>
                        <button class="slider-btn next"><ion-icon name="chevron-forward-outline"></ion-icon></button>
                        <!-- Индикаторы для мобильных -->
                        <div class="slider-dots"></div>
                    </div>
                </div>
            </section>
        </article>
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

    <a href="#top" class="go-top active" data-go-top><ion-icon name="chevron-up-outline"></ion-icon></a>

    <script src="main.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

</html>
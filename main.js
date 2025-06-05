document.addEventListener('DOMContentLoaded', function() {
    // Адаптивная шапка 
    const navbarToggleBtn = document.querySelector('[data-navbar-toggle-btn]');
    const navbar = document.querySelector('[data-navbar]');
    const navOverlay = document.querySelector('[data-nav-overlay]');
    const navLinks = document.querySelectorAll('.nav-link');

    // Открытие/закрытие меню на мобильных
    if (navbarToggleBtn && navbar) {
        navbarToggleBtn.addEventListener('click', function() {
            navbar.classList.toggle('active');
            this.classList.toggle('active');
            document.body.classList.toggle('no-scroll');
        });

        // Закрытие меню при клике на оверлей или ссылку
        if (navOverlay) {
            navOverlay.addEventListener('click', function() {
                navbar.classList.remove('active');
                navbarToggleBtn.classList.remove('active');
                document.body.classList.remove('no-scroll');
            });
        }

        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                navbar.classList.remove('active');
                navbarToggleBtn.classList.remove('active');
                document.body.classList.remove('no-scroll');
            });
        });
    }

    // Эффект при скролле (тень у шапки)
    window.addEventListener('scroll', function() {
        const header = document.querySelector('header');
        if (header) {
            header.classList.toggle('scrolled', window.scrollY > 50);
        }
    });

    // Слайдер мастер-классов 
    const sliderTrack = document.querySelector('.slider-track');
    if (sliderTrack) {
        const slides = document.querySelectorAll('.slide');
        const prevBtn = document.querySelector('.prev');
        const nextBtn = document.querySelector('.next');
        const dotsContainer = document.querySelector('.slider-dots');
        let dots = [];
        let currentSlide = 0;
        let slideWidth = slides[0].clientWidth;

        // Создаем индикаторы (точки)
        function createDots() {
            if (!dotsContainer) return;
            dotsContainer.innerHTML = '';
            dots = [];
            slides.forEach((_, i) => {
                const dot = document.createElement('div');
                dot.classList.add('slider-dot');
                if (i === 0) dot.classList.add('active');
                dot.addEventListener('click', () => goToSlide(i));
                dotsContainer.appendChild(dot);
                dots.push(dot);
            });
        }

        // Обновляем активную точку
        function updateDots() {
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === currentSlide);
            });
        }

        // Переход к слайду
        function goToSlide(slideIndex) {
            currentSlide = slideIndex;
            updateSlider();
            updateDots();
        }

        // Обновление позиции слайдера
        function updateSlider() {
            sliderTrack.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
        }

        // Следующий слайд
        function nextSlide() {
            if (currentSlide >= slides.length - 1) return;
            currentSlide++;
            updateSlider();
            updateDots();
        }

        // Предыдущий слайд
        function prevSlide() {
            if (currentSlide <= 0) return;
            currentSlide--;
            updateSlider();
            updateDots();
        }

        // Обработчики кнопок
        if (nextBtn) nextBtn.addEventListener('click', nextSlide);
        if (prevBtn) prevBtn.addEventListener('click', prevSlide);

        // Адаптация при ресайзе
        function handleResize() {
            slideWidth = slides[0].clientWidth;
            updateSlider();
            if (window.innerWidth <= 768 && !dots.length) {
                createDots();
            } else if (dotsContainer) {
                dotsContainer.innerHTML = '';
                dots = [];
            }
        }

        window.addEventListener('resize', handleResize);
        handleResize(); // Инициализация
    }

    
    const registerButtons = document.querySelectorAll('.btn-primary:not([form])');
    registerButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!this.closest('form')) {
                e.preventDefault();
                window.location.href = 'register.php';
            }
        });
    });
});





    // фотогалерея
document.addEventListener('DOMContentLoaded', function() {
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    galleryItems.forEach(item => {
        item.addEventListener('click', function() {
            // Удаляем активный класс у всех элементов
            galleryItems.forEach(i => i.classList.remove('active'));
            
            // Добавляем активный класс только к текущему элементу
            this.classList.add('active');
        });
    });
    
    // Закрываем увеличенное изображение при клике вне галереи
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.gallery-item')) {
            galleryItems.forEach(item => item.classList.remove('active'));
        }
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('workshopRegistration');
    
    if (form) {
        // Маска для телефона
        const phoneInput = document.getElementById('phone');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                let x = e.target.value.replace(/\D/g, '').match(/(\d{0,1})(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})/);
                e.target.value = !x[2] ? '+7' + x[1] : '+7 (' + x[2] + ') ' + x[3] + (x[4] ? '-' + x[4] : '') + (x[5] ? '-' + x[5] : '');
            });
        }

        // Обработка отправки формы
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Здесь можно добавить отправку данных на сервер
            // Например, с помощью fetch или AJAX
            
            // Временное сообщение об успехе
            alert('Ваша заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.');
            form.reset();
        });
    }
});




form.addEventListener('submit', function(e){
    e.preventDefault();
    
    // Собираем данные формы
    const formData = new FormData(form);
    
    // Добавляем workshop_id (значение из select)
    const workshopSelect = document.getElementById('workshop');
    const workshopId = workshopSelect.options[workshopSelect.selectedIndex].value;
    formData.append('workshop', workshopId);
    
    // Отправляем данные на сервер
    fetch('process_form.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            modal.classList.remove('active');
            document.body.style.overflow = '';
            form.reset();
        } else {
            // Показываем ошибки
            alert(data.errors.join('\n'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Произошла ошибка при отправке формы');
    });
});

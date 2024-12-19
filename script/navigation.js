document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menuToggle');
    const navMenu = document.querySelector('.nav_menu'); // Перевірка наявності елемента з класом .nav_menu

    if (!menuToggle || !navMenu) {
        console.error('Menu elements not found');
        return; // Завершуємо виконання, якщо елементи не знайдено
    }

    // Функція для сховання меню
    function hideMenu() {
        navMenu.classList.remove('active'); // Убирає клас 'active'
    }

    // Обробник натискання на кнопку меню
    menuToggle.addEventListener('click', function(event) {
        event.stopPropagation(); // Зупиняє подію, щоб клік не спрацював на документі
        navMenu.classList.toggle('active'); // Переключає клас 'active'
    });

    // Обробник натискання на посилання меню
    const navLinks = navMenu.querySelectorAll('a'); // Отримуємо всі посилання в меню
    navLinks.forEach(link => {
        link.addEventListener('click', hideMenu); // Сховує меню при натисканні на будь-яке посилання
    });

    // Обробник прокрутки сторінки
    window.addEventListener('scroll', hideMenu); // Сховує меню при прокрутці

    // Обробник натискання на документ
    document.addEventListener('click', hideMenu); // Сховує меню при натисканні в будь-яке місце документа
});

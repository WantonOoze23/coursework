document.addEventListener("DOMContentLoaded", () => {
    // Отримуємо елементи кнопок
    const viewButton = document.querySelector(".choice .view");
    const addButton = document.querySelector(".choice .add");

    // Отримуємо секції контенту
    const viewContent = document.querySelector(".manager-content.view");
    const addContent = document.querySelector(".manager-content.add");

    // Функція для приховування всіх секцій
    const hideAllSections = () => {
        viewContent.style.display = "none";
        addContent.style.display = "none";
    };

    // Функція для відображення секції
    const showSection = (section) => {
        section.style.display = "block";
    };

    // Функція для зняття активного класу з усіх кнопок
    const resetActiveButton = () => {
        viewButton.classList.remove("active");
        addButton.classList.remove("active");
    };

    // Обробники подій для кнопок
    viewButton.addEventListener("click", () => {
        hideAllSections();
        showSection(viewContent);
        resetActiveButton();
        viewButton.classList.add("active");
    });

    addButton.addEventListener("click", () => {
        hideAllSections();
        showSection(addContent);
        resetActiveButton();
        addButton.classList.add("active");
    });

    // Ініціалізація: відображаємо лише "Перегляд" і підсвічуємо кнопку
    hideAllSections();
    showSection(viewContent);
    resetActiveButton();
    viewButton.classList.add("active");

    
});

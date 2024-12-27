document.addEventListener("DOMContentLoaded", () => {
    // Отримуємо елементи кнопок
    const employeeButton = document.getElementById("employee");
    const departmentButton = document.getElementById("department");
    const performanceButton = document.getElementById("performance");
    const positionButton = document.getElementById("position");
    const projectButton = document.getElementById("project");
    const vacationButton = document.getElementById("vacation");

    // Отримуємо контейнери для форм додавання
    const employeeAdd = document.getElementById("employee_add");
    const departmentAdd = document.getElementById("department_add");
    const performanceAdd = document.getElementById("performance_add");
    const positionAdd = document.getElementById("position_add");
    const projectAdd = document.getElementById("project_add");
    const vacationAdd = document.getElementById("vacation_add");

    // Функція для приховування всіх форм додавання
    const hideAllAddForms = () => {
        employeeAdd.style.display = "none";
        departmentAdd.style.display = "none";
        performanceAdd.style.display = "none";
        positionAdd.style.display = "none";
        projectAdd.style.display = "none";
        vacationAdd.style.display = "none";
    };

    // Функція для відображення потрібної форми
    const showAddForm = (form) => {
        form.style.display = "block";
    };

    // Функція для зняття активного класу з усіх кнопок
    const resetActiveButtons = () => {
        employeeButton.classList.remove("active");
        departmentButton.classList.remove("active");
        performanceButton.classList.remove("active");
        positionButton.classList.remove("active");
        projectButton.classList.remove("active");
        vacationButton.classList.remove("active");
    };

    // Функція для додавання активного класу до кнопки
    const setActiveButton = (button) => {
        resetActiveButtons(); // Видаляємо активний клас з усіх кнопок
        button.classList.add("active"); // Додаємо активний клас до натиснутої кнопки
    };

    // Обробники подій для кожної кнопки
    employeeButton.addEventListener("click", () => {
        hideAllAddForms(); // Приховуємо всі форми
        showAddForm(employeeAdd); // Відображаємо форму для Робітника
        setActiveButton(employeeButton); // Підсвічуємо кнопку Робітник
    });

    departmentButton.addEventListener("click", () => {
        hideAllAddForms(); // Приховуємо всі форми
        showAddForm(departmentAdd); // Відображаємо форму для Відділу
        setActiveButton(departmentButton); // Підсвічуємо кнопку Відділ
    });

    performanceButton.addEventListener("click", () => {
        hideAllAddForms(); // Приховуємо всі форми
        showAddForm(performanceAdd); // Відображаємо форму для Продуктивності
        setActiveButton(performanceButton); // Підсвічуємо кнопку Продуктивність
    });

    positionButton.addEventListener("click", () => {
        hideAllAddForms(); // Приховуємо всі форми
        showAddForm(positionAdd); // Відображаємо форму для Посад
        setActiveButton(positionButton); // Підсвічуємо кнопку Посади
    });

    projectButton.addEventListener("click", () => {
        hideAllAddForms(); // Приховуємо всі форми
        showAddForm(projectAdd); // Відображаємо форму для Проєктів
        setActiveButton(projectButton); // Підсвічуємо кнопку Проєкти
    });

    vacationButton.addEventListener("click", () => {
        hideAllAddForms(); // Приховуємо всі форми
        showAddForm(vacationAdd); // Відображаємо форму для Відпочинку
        setActiveButton(vacationButton); // Підсвічуємо кнопку Відпочинок
    });
});

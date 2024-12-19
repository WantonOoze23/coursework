document.addEventListener('DOMContentLoaded', function () {
    // Функція для отримання даних

    fetch('../api/get_departments.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Ошибка загрузки данных');
        }
        return response.json();
    })
    .then(departments => {
        const departmentList = document.getElementById('department_content'); // Контейнер для карточек сотрудников

        // Очистить контейнер перед добавлением новых карточек
        departmentList.innerHTML = '';

        // Создаем карточки сотрудников
        departments.forEach(department => {
            const departmentCard = document.createElement('div');
            departmentCard.classList.add('department-card');

            
            departmentCard.innerHTML = `
                <img src="${department.image}">
                <h3><strong>Назва:</strong> ${department.department}</h3>
                <p><strong>Опис:</strong> ${department.description}</p>
                <p><strong>Голова:</strong> ${department.emp_id}</p>
            `;

            // Добавляем карточку сотрудника в список
            departmentList.appendChild(departmentCard);
        });
    })
    .catch(error => {
        console.error('Ошибка:', error);
    });


});

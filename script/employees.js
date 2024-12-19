document.addEventListener('DOMContentLoaded', function () {
    // Функція для отримання даних

    fetch('../api/get_employees.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Ошибка загрузки данных');
        }
        return response.json();
    })
    .then(employees => {
        const employeeList = document.getElementById('employees_content'); // Контейнер для карточек сотрудников

        // Очистить контейнер перед добавлением новых карточек
        employeeList.innerHTML = '';

        // Создаем карточки сотрудников
        employees.forEach(employee => {
            const employeeCard = document.createElement('a');
            employeeCard.classList.add('employee-card');
            employeeCard.href = `/person/person.html?emp_id=${employee.emp_id}`;

            var employeeDep = '';
            if(employee.dep_id === null){
                employeeDep = `<p><strong>Підпорядковується:</strong> ${employee.beloning_dep}</p>`;
            } else{
                employeeDep = `<p><strong>Голова:</strong> ${employee.dep_id} відділу`;
            }
            
            employeeCard.innerHTML = `
                <img src="${employee.image}">
                <h3>${employee.name} ${employee.surname}</h3>
                <p><strong>Посада:</strong> ${employee.position}</p>
                <p><strong>Дата народження:</strong> ${employee.dob}</p>
                <p><strong>Телефон:</strong> <a href="tel:${employee.phone}">+38${employee.phone}</a></p>
                <p><strong>Email:</strong> <a href="mailto:${employee.email}">${employee.email}</a></p>
                <p><strong>Адреса:</strong> ${employee.address}</p>
                <p><strong>Зарплата:</strong> ${employee.salary} грн</p>
                ${employeeDep}
            `;

            // Добавляем карточку сотрудника в список
            employeeList.appendChild(employeeCard);
        });
    })
    .catch(error => {
        console.error('Ошибка:', error);
    });


});

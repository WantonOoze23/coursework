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
        const employeeList = document.getElementById('employees_content'); // Контейнер для карток співробітників

        // Очистити контейнер перед додаванням нових карток
        employeeList.innerHTML = '';

        // Створюємо картки співробітників
        employees.forEach(employee => {
            const employeeCard = document.createElement('a');
            employeeCard.classList.add('employee-card');
            employeeCard.href = `/person/person.html?emp_id=${employee.emp_id}`;

            let employeeDep = '';
            // Перевірка на підпорядкування або відділ
            if (employee.dep_name) {
                if (employee.dep_name.startsWith('Підпорядковується')) {
                    employeeDep = `<p><strong>${employee.dep_name}</strong></p>`; // Виводимо підпорядкування
                } else {
                    employeeDep = `<p><strong>Голова:</strong> ${employee.dep_name} відділу</p>`; // Виводимо відділ
                }
            } else {
                employeeDep = `<p><strong>Підпорядковується:</strong> ${employee.beloning_dep}</p>`; // Якщо немає відділу
            }

            employeeCard.innerHTML = `
                <img src="${employee.image}" alt="${employee.name} ${employee.surname}">
                <h3>${employee.name} ${employee.surname}</h3>
                <p><strong>Посада:</strong> ${employee.position}</p>
                <p><strong>Дата народження:</strong> ${employee.dob}</p>
                <p><strong>Телефон:</strong> <a href="tel:${employee.phone}">+38${employee.phone}</a></p>
                <p><strong>Email:</strong> <a href="mailto:${employee.email}">${employee.email}</a></p>
                <p><strong>Адреса:</strong> ${employee.address}</p>
                <p><strong>Зарплата:</strong> ${employee.salary} грн</p>
                ${employeeDep}
            `;

            // Додаємо картку співробітника до списку
            employeeList.appendChild(employeeCard);
        });
    })
    .catch(error => {
        console.error('Ошибка:', error);
    });
});

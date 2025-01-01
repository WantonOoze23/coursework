document.addEventListener('DOMContentLoaded', function () {
    // Отримуємо параметр emp_id з URL
    const urlParams = new URLSearchParams(window.location.search);
    const empId = urlParams.get('emp_id'); // Змінна повинна бути empId

    if (empId) {
        // Виконати запит до API або використовувати локальні дані, щоб отримати інформацію про співробітника
        fetch(`/api/employer-info/get_all_info.php?emp_id=${empId}`)  // Використовуємо empId в запиті
            .then(response => {
                if (!response.ok) {
                    throw new Error('Ошибка загрузки данных');
                }
                return response.json();
            })
            .then(data => {
                // Розбиваємо дані на секції
                const { employee, vacation, performance } = data;

                // Вивід інформації про співробітника
                const employeeDetails = document.getElementById('employee_details');
                employeeDetails.innerHTML = `
                    <img src="${employee.image}" alt="Фото співробітника">
                    <h3>${employee.name} ${employee.surname}</h3>
                    <p><strong>Посада:</strong> ${employee.position}</p>
                    <p><strong>Дата народження:</strong> ${employee.dob}</p>
                    <p><strong>Телефон:</strong> <a href="tel:${employee.phone}">+38${employee.phone}</a></p>
                    <p><strong>Email:</strong> <a href="mailto:${employee.email}">${employee.email}</a></p>
                    <p><strong>Адреса:</strong> ${employee.address}</p>
                    <p><strong>Зарплата:</strong> ${employee.salary} грн</p>
                    ${employee.department_name ? `<p><strong>Відділ:</strong> ${employee.department_name}</p>` : ''}
                    ${employee.beloning_dep ? `<p><strong>Підпорядковується:</strong> ${employee.beloning_dep}</p>` : ''}
                `;

                // Вивід інформації про продуктивність
                const employeePerformance = document.getElementById('employee-perfomance');
                if (performance && performance.length > 0) {
                    employeePerformance.innerHTML = `
                        <h4>Продуктивність:</h4>
                        <ul>
                            ${performance.map(item => `
                                <li>
                                    <p><strong>Дата огляду:</strong> ${item.date_review}</p>
                                    <p><strong>Оцінка:</strong> ${item.score}</p>
                                    <p><strong>Коментар:</strong> ${item.comment}</p>
                                </li>
                            `).join('')}
                        </ul>
                    `;
                } else {
                    employeePerformance.innerHTML = `<p>Дані про продуктивність відсутні.</p>`;
                }

                // Вивід інформації про відпустки
                const employeeVacation = document.getElementById('employee-vocation');
                if (vacation && vacation.length > 0) {
                    employeeVacation.innerHTML = `
                        <h4>Відпустки:</h4>
                        <ul>
                            ${vacation.map(item => `
                                <li>
                                    <p><strong>Тип:</strong> ${item.type}</p>
                                    <p><strong>Початок:</strong> ${item.beginning}</p>
                                    <p><strong>Кінець:</strong> ${item.end}</p>
                                    <p><strong>Сумарно:</strong> ${item.amount} днів</p>
                                </li>
                            `).join('')}
                        </ul>
                    `;
                } else {
                    employeeVacation.innerHTML = `<p>Дані про відпустки відсутні.</p>`;
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
            });
    } else {
        console.error('Параметр emp_id не найден в URL');
    }
});

document.addEventListener('DOMContentLoaded', function () {
    // Функція для отримання даних

    fetch('../api/get_performance.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Ошибка загрузки данных');
        }
        return response.json();
    })
    .then(performances => {
        const performanceList = document.getElementById('performance_content'); // Контейнер для карточек сотрудников

        // Очистить контейнер перед добавлением новых карточек
        performanceList.innerHTML = '';

        // Создаем карточки сотрудников
        performances.forEach(performance => {
            const performanceCard = document.createElement('div');
            performanceCard.classList.add('performance-card');

            
            performanceCard.innerHTML = `
                <h3><strong>Робітник: </strong> ${performance.emp_id}</h3>
                <p><strong>Дата аудиту: </strong> ${performance.date_review}</p>
                <p><strong>Оцінка: </strong> ${performance.score}</p>
                <p><strong>Коментар: </strong> ${performance.comment}</p>
            `;

            // Добавляем карточку сотрудника в список
            performanceList.appendChild(performanceCard);
        });
    })
    .catch(error => {
        console.error('Ошибка:', error);
    });


});

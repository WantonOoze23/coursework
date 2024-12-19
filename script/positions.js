document.addEventListener('DOMContentLoaded', function () {
    // Функція для отримання даних

    fetch('../api/get_positions.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Ошибка загрузки данных');
        }
        return response.json();
    })
    .then(positions => {
        const positionList = document.getElementById('positions_content'); // Контейнер для карточек сотрудников

        // Очистить контейнер перед добавлением новых карточек
        positionList.innerHTML = '';

        // Создаем карточки сотрудников
        positions.forEach(position => {
            const positionCard = document.createElement('div');
            positionCard.classList.add('position-card');

            positionCard.innerHTML = `
                <h3><strong>Назва посади:</strong> ${position.position}</h3>
                <p><strong>Опис:</strong> ${position.description} грн</p>
                <p><strong>Підпорядковується:</strong> ${position.responsibilities}</

            `;

            // Добавляем карточку сотрудника в список
            positionList.appendChild(positionCard);
        });
    })
    .catch(error => {
        console.error('Ошибка:', error);
    });


});

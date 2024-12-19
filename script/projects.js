document.addEventListener('DOMContentLoaded', function () {
    // Функція для отримання даних

    fetch('../api/get_projects.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Ошибка загрузки данных');
        }
        return response.json();
    })
    .then(projects => {
        const projectList = document.getElementById('projects_content'); // Контейнер для карточек сотрудников

        // Очистить контейнер перед добавлением новых карточек
        projectList.innerHTML = '';

        // Создаем карточки сотрудников
        projects.forEach(project => {
            const projectCard = document.createElement('div');
            projectCard.classList.add('project-card');

            projectCard.innerHTML = `
                <img src="">
                <h3>${project.project_name}</h3>
                <p><strong>Посада:</strong> ${project.project_description}</p>
                <p><strong>Відділ що займається:</strong> ${project.dep_id}</p>
                <p><strong>Голова проєкту:</strong> ${project.emp_id}</p>
                
            `;

            // Добавляем карточку сотрудника в список
            projectList.appendChild(projectCard);
        });
    })
    .catch(error => {
        console.error('Ошибка:', error);
    });


});

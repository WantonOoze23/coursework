document.getElementById('loginForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();

    // Проверка на пустые поля
    if (!username || !password) {
        alert('Будь ласка, заповніть всі поля.');
        return;
    }

    try {
        const response = await fetch('../api/login.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ username, password })
        });

        // Проверка на успешный ответ от сервера
        if (!response.ok) {
            throw new Error('Помилка на сервері');
        }

        const data = await response.json();

        // Проверка результата авторизации
        if (data.success) {
            window.location.href = 'manager.php';
        } else {
            alert('Неправильний логін або пароль');
        }
    } catch (error) {
        console.error('Помилка:', error);
        alert('Виникла проблема із сервером. Спробуйте пізніше.');
    }
});

<?php
session_start(); // Стартуем сессию

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Если нет, перенаправляем на страницу логина
    header("Location: /manager/login.html");
    exit; // Завершаем выполнение скрипта
}
?>

<!DOCTYPE html>
<html lang="ua-UA">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../styles/main.css?v=1.0">
    <link rel="stylesheet" href="manager_styles/manager.css">

    <link rel="stylesheet" href="manager_styles/output_data.css">
    <link rel="stylesheet" href="manager_styles/input_data.css">


    <title>Manager</title>

</head>
<body>
    <section class="navigation">
        
        <button class="menu-toggle" id="menuToggle">☰</button>

        <div id="nav_tools">

            <ul class="nav_menu">
                <li><a href="../index.html">Головна</a></li>
                <li><a href="../employees.html">Робітники</a></li>
                <li><a href="../departments.html">Відділи</a></li>
                <li><a href="../performance.html">Продуктивність</a></li>
                <li><a href="../positions.html">Посади</a></li>
                <li><a href="../projects.html">Проєкти</a></li>
                <li><a href="../manager/login.html">Кабінет</a></li>
            </ul>
        </div>
    </section>


    <section class="wrapper-manager">
        <div class="manager-header">
            <h1>Добро пожаловать, <?php echo $_SESSION['username']; ?>!</h1>
            
            <!-- Кнопка вихода -->
            <form action="../api/logout.php" method="POST">
                <button type="submit">Вийти</button>
            </form>
        </div>
        

        <div class="choice">
            <button class="view">Перегляд</button>
            <button class="add">Додати</button>
        </div>

        
        <div class="manager-content view">
            <div id="filter">

                <label>Фільтр:</label>
                <select name="filter" id="filter">
                    <option value="all">Всі</option>
                    <option value="employees">Робітники</option>
                    <option value="departments">Відділи</option>
                    <option value="performance">Продуктивність</option>
                    <option value="positions">Посади</option>
                    <option value="projects">Проєкти</option>
                </select>
                <button type="submit">Фільтрувати</button>

            </div>

            <div id="output">

            </div>

        </div>

        <div class="manager-content add">
        
            <div class="choice">
                <a href="employee.php"><button id="employee">Робітник</button></a>
                <a href="department.php"><button id="department">Відділ</button></a>
                <a href="perfomance.php"><button id="performance">Продуктивність</button></a>
                <a href="position.php"><button id="position">Посади</button></a>
                <a href="project.php"><button id="project">Проєкти</button></a>
                <a href="vacation.php"><button id="vacation">Відпочинок</button></a>
            </div>
            
        </div>

    </section>

    <script src="../script/navigation.js"></script>
    <script src="./manager_script/manager.js"></script>
    <script src="./manager_script/manager_add.js"></script>
    <script src="./manager_script/manager_get.js"></script>
</body>
</html>
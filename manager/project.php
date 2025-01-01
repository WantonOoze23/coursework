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

        <div class="manager-content add">
        

            <div id="project_add">
                <form method="POST" enctype="multipart/form-data">
                    <label for="project_name">Назва проєкту:</label>
                    <input type="text" id="project_name" name="project_name" required><br><br>

                    <label for="project_description">Опис:</label>
                    <input type="text" id="description" name="description"><br><br>

                    <label for="dep_id">Підпорядковується:</label>
                    <input type="text" id="department" name="department" required><br><br>

                    <label for="emp_id">Голова проєкту:</label>
                    <input type="text" id="emp_id" name="emp_id" required><br><br>

                    <button type="submit">Додати проєкт</button>
                </form>
            </div>
            
        </div>

    </section>

    <script src="../script/navigation.js"></script>
    <script src="./manager_script/manager.js"></script>
    <script src="./manager_script/manager_add.js"></script>
    <script src="./manager_script/manager_get.js"></script>
</body>
</html>
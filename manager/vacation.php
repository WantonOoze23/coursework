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
            <a href="manager.php"><button class="view">Перегляд</button></a>
            <a href="manager.php"><button class="add">Додати</button></a>
        </div>

        <div class="manager-content add">
        

            <div id="vacation_add">
                <form method="POST" enctype="multipart/form-data">
                    <label for="type">Тип відпочинку</label>
                    <input type="text" id="type" name="type" required><br><br>

                    <label for="beginning">Дата початку:</label>
                    <input type="date" id="beginning" name="beginning" required><br><br>
                    
                    <label for="end">Дата закінчення:</label>
                    <input type="date" id="end" name="end" required><br><br>

                    <label for="amount">Кількість днів:</label>
                    <input type="text" id="amount" name="amount" readonly><br><br>

                    <label for="emp_id">Співробітник:</label>
                    <input type="text" id="emp_id" name="emp_id" required><br><br>

                    <button type="submit">Додати відпочинок</button>
                </form>
                
            </div>
            
        </div>

    </section>

    <script src="../script/navigation.js"></script>
    <script src="./manager_script/vacation_add.js"></script>
</body>
</html>
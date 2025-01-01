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

            <div id="employee_add">
                <h2>Додати співробітника</h2>
                <form method="POST" enctype="multipart/form-data">
                    <label for="name">Ім'я:</label>
                    <input type="text" id="name" name="name" required><br><br>

                    <label for="surname">Прізвище:</label>
                    <input type="text" id="surname" name="surname" required><br><br>

                    <label for="middle_name">По батькові:</label>
                    <input type="text" id="middle_name" name="middle_name"><br><br>

                    <label for="dob">Дата народження:</label>
                    <input type="date" id="dob" name="dob" required><br><br>

                    <label for="sex">Стать:</label>
                    <select id="sex" name="sex">
                        <option value="M">Чоловік</option>
                        <option value="F">Жінка</option>
                    </select><br><br>

                    <label for="phone">Телефон:</label>
                    <input type="text" id="phone" name="phone" required><br><br>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required><br><br>

                    <label for="address">Адреса:</label>
                    <input type="text" id="address" name="address"><br><br>

                    <label for="position">Посада:</label>
                    <select id="position" name="position">
                        <option value=""></option>
                        <option value="Директор">Директор</option>
                        <option value="Директор відділу управління ресторанами">Директор відділу управління ресторанами</option>
                        <option value="Директор відділу закупівель">Директор відділу закупівель</option>
                        <option value="Директор відділу маркетингу">Директор відділу маркетингу</option>
                        <option value="Директор відділу логістики">Директор відділу логістики</option>
                        <option value="Директор бухгалтерії">Директор бухгалтерії</option>
                        <option value="Директор відділу зв’язку">Директор відділу зв’язку</option>
                        <option value="Директор відділу розвитку">Директор відділу розвитку</option>
                        <option value="Бариста">Бариста</option>
                        <option value="Офіціант">Офіціант</option>
                    </select><br><br>

                    <label for="dep_id">Відділ:</label>
                    <input type="text" id="dep_id" name="dep_id"><br><br>

                    <label for="date">Дата прийому</label>
                    <input type="date" id="date" name="date" required><br><br>

                    <label for="salary">Зарплата:</label>
                    <input type="number" id="salary" name="salary" required><br><br>

                    <label for="status">Статус:</label>
                    <select id="status" name="status">
                        <option value="Повний">Повний</option>
                        <option value="Пів ставки">Пів ставки</option>
                        <option value="Звільнений">Звільнений</option>
                        <option value="В очікуванні">В очікуванні</option>
                    </select><br><br>

                    <label for="image">Фото:</label>
                    <input type="file" id="image" name="image"><br><br>

                    <label for="beloning_dep">Належить відділу:</label>
                    <input type="text" id="beloning_dep" name="beloning_dep"><br><br>

                    <button type="submit">Додати співробітника</button>
                </form>
            </div>
            
        </div>

    </section>

    <script src="../script/navigation.js"></script>
    <script src="./manager_script/manager.js"></script>
</body>
</html>
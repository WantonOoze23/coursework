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
                <button id="employee">Робітник</button>
                <button id="department">Відділ</button>
                <button id="performance">Продуктивність</button>
                <button id="position">Посади</button>
                <button id="project">Проєкти</button>
                <button id="vacation">Відпочинок</button>
            </div>

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

            <div id="department_add">
                <form method="POST" enctype="multipart/form-data">
                    <label for="name">Назва відділу:</label>
                    <input type="text" id="department" name="department" required><br><br>
                    
                    <label for="description">Опис:</label>
                    <input type="text" id="description" name="description"><br><br>
                    
                    <label for="image">Фото:</label>
                    <input type="file" id="image" name="image"><br><br>

                    <label for="emp_id">Керівник:</label>
                    <input type="number" id="emp_id" name="emp_id"><br><br>

                    <button type="submit">Додати відділ</button>
            </div>

            <div id="performance_add">
                <form method="POST" enctype="multipart/form-data">
                    <label for="emp_id">Співробітник:</label>
                    <input type="text" id="emp_id" name="emp_id" required><br><br>
                    
                    <label for="date_review">Дата:</label>
                    <input type="date" id="date_review" name="date_review" required><br><br>
                    
                    <label for="score">Оцінка:</label>
                    <input type="number" id="score" name="score" required><br><br>
                    
                    <label for="comment">Коментар:</label>
                    <input type="text" id="comment" name="comment"><br><br>
                    
                    <button type="submit">Додати продуктивність</button>
                </form>
            </div>

            <div id="position_add">
                <form method="POST" enctype="multipart/form-data">
                    <label for="position">Назва посади:</label>
                    <input type="text" id="position" name="position" required><br><br>
                    
                    <label for="description">Опис:</label>
                    <input type="text" id="description" name="description"><br><br>
    
                    <label for="responsibilities">Обов’язки:</label>
                    <input type="text" id="responsibilities" name="responsibilities"><br><br>
                    
                    <button type="submit">Додати посаду</button>
                </form>
            </div>

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

            <div id="vacation_add">
                <form method="POST" enctype="multipart/form-data">
                    <label for="type">Тип відпочинку</label>
                    <input type="text" id="type" name="type" required><br><br>

                    <label for="beginning">Дата початку:</label>
                    <input type="date" id="beginning" name="beginning" required><br><br>
                    
                    <label for="end">Дата закінчення:</label>
                    <input type="date" id="end" name="end" required><br><br>

                    <label for="amount">Кількість днів:</label>
                    <!--Кількість днів має підраховуватись та виводитись автоматично-->

                    <label for="emp_id">Співробітник:</label>
                    <input type="text" id="emp_id" name="emp_id" required><br><br>

                    <button type="submit">Додати відпочинок</button>
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
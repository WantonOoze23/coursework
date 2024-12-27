<?php
// Підключення до бази даних
require_once "../db_connection.php"; // Підключаємо налаштування БД


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Отримуємо дані з форми
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $middle_name = $_POST['middle_name'];
    $dob = $_POST['dob'];
    $sex = $_POST['sex'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $position = $_POST['position'];
    $dep_id = $_POST['dep_id'];  // Значення відділу
    $beloning_dep = $_POST['beloning_dep'];  // Значення належності до відділу
    $date = $_POST['date'];
    $salary = $_POST['salary'];
    $status = $_POST['status'];

    // Обробка фото (якщо воно є)
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = $_FILES['image']['name'];
        $imageTmp = $_FILES['image']['tmp_name'];
        $imageSize = $_FILES['image']['size'];
        $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        // Перевірка розширення фото
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageExt, $allowedExts) && $imageSize < 5000000) { // Перевірка на розмір (5MB макс)
            $newImageName = uniqid() . '.' . $imageExt;
            $uploadDir = "../uploads/images/";
            move_uploaded_file($imageTmp, $uploadDir . $newImageName);
        } else {
            echo "Невірний формат фото або файл занадто великий!";
            exit;
        }
    } else {
        $newImageName = null; // Якщо фото не було завантажено
    }

    // SQL запит для додавання співробітника
    $sql = "INSERT INTO EMPLOYEES (name, surname, middle_name, dob, sex, phone, email, address, position, dep_id, date, salary, status, image, belonging_dep) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $mysqli->prepare($sql)) {
        // Прив'язуємо параметри до запиту
        $stmt->bind_param("ssssssssssssss", $name, $surname, $middle_name, $dob, $sex, $phone, $email, $address, $position, $dep_id, $date, $salary, $status, $newImageName, $beloning_dep);
        
        // Виконуємо запит
        if ($stmt->execute()) {
            echo "Співробітника успішно додано!";
        } else {
            echo "Помилка при додаванні співробітника: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Помилка при підготовці запиту: " . $mysqli->error;
    }

    $mysqli->close();
}
?>

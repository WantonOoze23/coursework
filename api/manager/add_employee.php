<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../db_connection.php'; // Підключення до БД

header('Content-Type: application/json');

// Перевірка, чи надійшли дані методом POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Зчитування даних з POST-запиту
    $name = $_POST['name'] ?? null;
    $surname = $_POST['surname'] ?? null;
    $middle_name = $_POST['middle_name'] ?? null;
    $dob = $_POST['dob'] ?? null;
    $sex = $_POST['sex'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $email = $_POST['email'] ?? null;
    $address = $_POST['address'] ?? null;
    $position = $_POST['position'] ?? null;
    $dep_id = $_POST['dep_id'] ?? null;
    $date = $_POST['date'] ?? null;
    $salary = $_POST['salary'] ?? null;
    $status = $_POST['status'] ?? null;
    $beloning_dep = $_POST['beloning_dep'] ?? null;

    // Перевірка завантаження зображення
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../../images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Створюємо папку, якщо її не існує
        }
        $imagePath = $uploadDir . basename($_FILES['image']['name']);
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            echo json_encode(['success' => false, 'message' => 'Не вдалося завантажити фото.']);
            exit;
        }
        $imagePath = '/images/' . basename($_FILES['image']['name']); // Зберігаємо відносний шлях
    }

    // Валідація даних
    if (!$name || !$surname || !$dob || !$phone || !$email || !$salary) {
        echo json_encode(['success' => false, 'message' => 'Будь ласка, заповніть всі обов’язкові поля.']);
        exit;
    }

    // SQL-запит для додавання співробітника
    $stmt = $conn->prepare("
        INSERT INTO employees (name, surname, middle_name, dob, sex, phone, email, address, position, dep_id, date, salary, status, image, beloning_dep)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if ($stmt) {
        // Прив'язка параметрів
        $stmt->bind_param(
            'sssssssssssdsss',
            $name,
            $surname,
            $middle_name,
            $dob,
            $sex,
            $phone,
            $email,
            $address,
            $position,
            $dep_id,
            $date,
            $salary,
            $status,
            $imagePath,
            $beloning_dep
        );

        // Виконання запиту
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Співробітника успішно додано!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Не вдалося додати співробітника: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Помилка SQL: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Невірний метод запиту.']);
}
?>

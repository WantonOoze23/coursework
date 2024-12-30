<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../db_connection.php'; // Підключення до БД

header('Content-Type: application/json');

// Перевірка, чи надійшли дані методом POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Зчитування даних з POST-запиту
    $department = $_POST['department'] ?? null;
    $description = $_POST['description'] ?? null;
    $emp_id = $_POST['emp_id'] ?? null;

    // Перевірка завантаження зображення
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../../images/departments/';
        $imagePath = $uploadDir . basename($_FILES['image']['name']);
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            echo json_encode(['success' => false, 'message' => 'Не вдалося завантажити фото.']);
            exit;
        }
        $imagePath = '/images/departments/' . basename($_FILES['image']['name']); // Зберігаємо відносний шлях
    }

    // Валідація даних
    if (!$department || !$description) {
        echo json_encode(['success' => false, 'message' => 'Будь ласка, заповніть всі обов’язкові поля.']);
        exit;
    }

    // SQL-запит для додавання відділу
    $stmt = $conn->prepare("
        INSERT INTO department (department, description, image, emp_id)
        VALUES (?, ?, ?, ?)
    ");

    if ($stmt) {
        // Прив'язка параметрів
        $stmt->bind_param(
            'sssi',
            $department,
            $description,
            $imagePath,
            $emp_id
        );

        // Виконання запиту
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Відділ успішно додано!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Не вдалося додати відділ: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Помилка SQL: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Невірний метод запиту.']);
}
?>

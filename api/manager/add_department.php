<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Підключення до бази даних
require_once '../db_connection.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $department = $_POST['department'] ?? null;
    $description = $_POST['description'] ?? null;
    $emp_id = $_POST['emp_id'] ?? null;
    $image = $_FILES['image'] ?? null;

    // Валідація
    if (!$department) {
        echo json_encode(['success' => false, 'message' => 'Назва відділу є обов\'язковою']);
        exit;
    }

    $uploadDir = __DIR__ . '/../../images/';
    $imagePath = '/images/';
    $uploadedImagePath = null;

    if ($image && $image['error'] === UPLOAD_ERR_OK) {
        $fileName = uniqid() . '_' . basename($image['name']);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($image['tmp_name'], $targetPath)) {
            $uploadedImagePath = $imagePath . $fileName;
        } else {
            echo json_encode(['success' => false, 'message' => 'Помилка завантаження зображення']);
            exit;
        }
    }

    $stmt = $conn->prepare("
        INSERT INTO department (department, description, image, emp_id)
        VALUES (?, ?, ?, ?)
    ");

    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Помилка SQL: ' . $conn->error]);
        exit;
    }

    // Прив'язуємо параметри до запиту
    $stmt->bind_param("sssi", $department, $description, $uploadedImagePath, $emp_id);

    // Виконуємо запит
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Відділ успішно додано']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Помилка при додаванні до бази даних']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Некоректний метод запиту']);
}
?>
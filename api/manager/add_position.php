<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../db_connection.php'; // Підключення до БД

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $position_name = $_POST['position_name'];
    $salary_range = $_POST['salary_range'];
    $description = $_POST['description'] ?? null;

    $sql = "INSERT INTO positions (position_name, salary_range, description) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute([$position_name, $salary_range, $description])) {
        echo json_encode(['success' => true, 'message' => 'Посаду успішно додано']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Помилка при додаванні посади']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Неправильний метод запиту']);
}
?>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../db_connection.php'; // Підключення до БД

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project_name = $_POST['project_name'];
    $description = $_POST['description'] ?? null;
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $sql = "INSERT INTO projects (project_name, description, start_date, end_date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute([$project_name, $description, $start_date, $end_date])) {
        echo json_encode(['success' => true, 'message' => 'Проект успішно додано']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Помилка при додаванні проекту']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Неправильний метод запиту']);
}
?>
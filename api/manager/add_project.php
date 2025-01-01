<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../db_connection.php'; // Підключення до БД

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project_name = $_POST['project_name'] ?? '';
    $project_description = $_POST['description'] ?? '';
    $dep_id = $_POST['dep_id'] ?? null;
    $emp_id = $_POST['emp_id'] ?? null;

    if (!$project_name || !$dep_id || !$emp_id) {
        echo json_encode(['success' => false, 'message' => 'Обов’язкові поля повинні бути заповнені!']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO projects (project_name, project_description, dep_id, emp_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssii', $project_name, $project_description, $dep_id, $emp_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Проєкт успішно додано!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Помилка додавання: ' . $stmt->error]);
    }
    $stmt->close();
}
?>

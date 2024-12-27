<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../db_connection.php'; // Підключення до БД

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = $_POST['employee_id'];
    $performance_score = $_POST['performance_score'];
    $performance_date = $_POST['performance_date'];
    $comments = $_POST['comments'] ?? null;

    $sql = "INSERT INTO performance (employee_id, performance_score, performance_date, comments) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute([$employee_id, $performance_score, $performance_date, $comments])) {
        echo json_encode(['success' => true, 'message' => 'Продуктивність успішно додано']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Помилка при додаванні продуктивності']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Неправильний метод запиту']);
}

?>
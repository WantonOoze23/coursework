<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../db_connection.php'; // Підключення до БД

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emp_id = $_POST['emp_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $type = $_POST['type'] ?? null;

    $sql = "INSERT INTO vacations (emp_id, beginning, end, type) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute([$emp_id, $beginning, $end, $type])) {
        echo json_encode(['success' => true, 'message' => 'Відпустку успішно додано']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Помилка при додаванні відпустки']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Неправильний метод запиту']);
}
?>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../db_connection.php'; // Підключення до БД

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'] ?? null;
    $beginning = $_POST['beginning'] ?? null;
    $end = $_POST['end'] ?? null;
    $emp_id = $_POST['emp_id'] ?? null;

    if (!$type || !$beginning || !$end || !$emp_id) {
        echo json_encode(['success' => false, 'message' => 'Обов’язкові поля повинні бути заповнені!']);
        exit;
    }

    $begin_date = new DateTime($beginning);
    $end_date = new DateTime($end);
    $days_diff = $end_date->diff($begin_date)->days + 1;

    $stmt = $conn->prepare("INSERT INTO vacations (type, beginning, end, days, emp_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssii', $type, $beginning, $end, $days_diff, $emp_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Відпочинок успішно додано!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Помилка додавання: ' . $stmt->error]);
    }
    $stmt->close();
}
?>

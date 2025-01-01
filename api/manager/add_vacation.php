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
    $amount = $_POST['amount'] ?? null;

    if (!$type || !$beginning || !$end || !$emp_id) {
        echo json_encode(['success' => false, 'message' => 'Обов’язкові поля повинні бути заповнені!']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO vacation (type, beginning, end, amount, emp_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssii', $type, $beginning, $end, $amount, $emp_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Відпочинок успішно додано!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Помилка додавання: ' . $stmt->error]);
    }
    $stmt->close();
}
?>

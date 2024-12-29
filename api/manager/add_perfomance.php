<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../db_connection.php'; // Підключення до БД

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emp_id = $_POST['emp_id'] ?? null;
    $date_review = $_POST['date_review'] ?? null;
    $score = $_POST['score'] ?? null;
    $comment = $_POST['comment'] ?? null;

    if (!$emp_id || !$date_review || !$score) {
        echo json_encode(['success' => false, 'message' => 'Обов’язкові поля повинні бути заповнені!']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO performance (emp_id, date_review, score, comment) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('isds', $emp_id, $date_review, $score, $comment);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Продуктивність успішно додано!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Помилка додавання: ' . $stmt->error]);
    }
    $stmt->close();
}
?>

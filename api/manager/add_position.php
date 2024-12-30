<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../db_connection.php'; // Підключення до БД

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $position = $_POST['position'] ?? null;
    $description = $_POST['description'] ?? null;
    $responsibilities = $_POST['responsibilities'] ?? null;

    if (!$position) {
        echo json_encode(['success' => false, 'message' => 'Назва посади є обов’язковою!']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO positions (position, description, responsibilities) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $position, $description, $responsibilities);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Посаду успішно додано!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Помилка додавання: ' . $stmt->error]);
    }
    $stmt->close();
}
?>

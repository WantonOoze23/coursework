<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Подключение к базе данных
require_once 'db_connection.php';
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Выполнение запроса
$query = "SELECT * FROM department";
$result = $conn->query($query);
if (!$result) {
    die("Ошибка SQL-запроса: " . $conn->error);
}

$departments = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $departments[] = $row;
    }
}

// Отправка JSON-ответа
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($departments, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

$conn->close();

?>

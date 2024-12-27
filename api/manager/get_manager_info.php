<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Підключення до бази даних
require_once '../db_connection.php';

if ($conn->connect_error) {
    die("Помилка підключення: " . $conn->connect_error);
}

// Отримання даних з бази
function fetchData($conn, $query) {
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    } else {
        return [];
    }
}

// Структурування даних
$data = [
    'employees' => fetchData($conn, "SELECT * FROM employees"),
    'departments' => fetchData($conn, "SELECT * FROM department"),
    'performance' => fetchData($conn, "SELECT * FROM performance"),
    'positions' => fetchData($conn, "SELECT * FROM position"),
    'projects' => fetchData($conn, "SELECT * FROM projects"),
    'vacation' => fetchData($conn, "SELECT * FROM vacation"),
];

$conn->close();

// Повернення JSON-даних
header('Content-Type: application/json');
echo json_encode($data);
?>

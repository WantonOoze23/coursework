<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Подключення до бази даних
require_once '../db_connection.php';
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Отримуємо параметр emp_id з URL
$emp_id = isset($_GET['emp_id']) ? intval($_GET['emp_id']) : 0;

// Якщо emp_id не переданий або неправильний
if ($emp_id <= 0) {
    echo json_encode(["error" => "Invalid emp_id"]);
    exit();
}

// Масив для збереження всіх даних
$data = [];

// Отримання даних з таблиці employees
$sql_employee = "
    SELECT e.*, d.department AS department_name 
    FROM employees e
    LEFT JOIN department d ON e.dep_id = d.dep_id
    WHERE e.emp_id = ?
";
$stmt_employee = $conn->prepare($sql_employee);
if ($stmt_employee === false) {
    die("Ошибка подготовки запроса: " . $conn->error);
}
$stmt_employee->bind_param("i", $emp_id);
$stmt_employee->execute();
$result_employee = $stmt_employee->get_result();

if ($result_employee->num_rows > 0) {
    $data['employee'] = $result_employee->fetch_assoc();
} else {
    echo json_encode(["error" => "Employee not found"]);
    exit();
}


// Отримання даних з таблиці vacation
$sql_vacation = "SELECT * FROM vacation WHERE emp_id = ?";
$stmt_vacation = $conn->prepare($sql_vacation);
if ($stmt_vacation === false) {
    die("Ошибка подготовки запроса: " . $conn->error);
}
$stmt_vacation->bind_param("i", $emp_id);
$stmt_vacation->execute();
$result_vacation = $stmt_vacation->get_result();

$data['vacation'] = [];
while ($row = $result_vacation->fetch_assoc()) {
    $data['vacation'][] = $row;
}

// Отримання даних з таблиці performance
$sql_performance = "SELECT * FROM performance WHERE emp_id = ?";
$stmt_performance = $conn->prepare($sql_performance);
if ($stmt_performance === false) {
    die("Ошибка подготовки запроса: " . $conn->error);
}
$stmt_performance->bind_param("i", $emp_id);
$stmt_performance->execute();
$result_performance = $stmt_performance->get_result();

$data['performance'] = [];
while ($row = $result_performance->fetch_assoc()) {
    $data['performance'][] = $row;
}

// Повертаємо всі дані у форматі JSON
echo json_encode($data);

// Закриваємо з'єднання
$stmt_employee->close();
$stmt_vacation->close();
$stmt_performance->close();
$conn->close();
?>
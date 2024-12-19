<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Подключение к базе данных
require_once 'db_connection.php';
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Запит для отримання відділів
$departmentsQuery = "SELECT * FROM department";
$departmentsResult = $conn->query($departmentsQuery);
if (!$departmentsResult) {
    die("Ошибка SQL-запроса для отделов: " . $conn->error);
}

$departments = [];
if ($departmentsResult->num_rows > 0) {
    while ($row = $departmentsResult->fetch_assoc()) {
        $departments[] = $row;
    }
}

// Запит для отримання співробітників
$employeesQuery = "SELECT * FROM employees";
$employeesResult = $conn->query($employeesQuery);
if (!$employeesResult) {
    die("Ошибка SQL-запроса для сотрудников: " . $conn->error);
}

$employees = [];
if ($employeesResult->num_rows > 0) {
    while ($row = $employeesResult->fetch_assoc()) {
        $employees[] = $row;
    }
}

// Об'єднуємо співробітників з даними про відділи
foreach ($employees as &$employee) {
    // Якщо співробітник має прив'язку до відділу
    if ($employee['dep_id'] !== null) {
        foreach ($departments as $department) {
            if ($employee['dep_id'] == $department['dep_id']) {
                $employee['dep_name'] = $department['department']; // Додаємо назву відділу
                break;
            }
        }
    } else {
        // Якщо відсутній відділ, перевіряємо на підпорядкування
        if ($employee['beloning_dep'] !== null) {
            // Пошук назви відділу, до якого підпорядковується співробітник
            foreach ($departments as $department) {
                if ($employee['beloning_dep'] == $department['dep_id']) {
                    $employee['dep_name'] = 'Підпорядковується: ' . $department['department']; // Виводимо назву відділу
                    break;
                }
            }
        } else {
            $employee['dep_name'] = 'Без підпорядкування';
        }
    }
}

// Відправка JSON-відповіді
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($employees, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

$conn->close();
?>

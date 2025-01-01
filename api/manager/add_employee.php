<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../db_connection.php'; // Підключення до бази даних

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? null;
    $surname = $_POST['surname'] ?? null;
    $middle_name = $_POST['middle_name'] ?? null;
    $dob = $_POST['dob'] ?? null;
    $sex = $_POST['sex'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $email = $_POST['email'] ?? null;
    $address = $_POST['address'] ?? null;
    $position = $_POST['position'] ?? null;
    $dep_id = !empty($_POST['dep_id']) ? (int)$_POST['dep_id'] : null;
    $date = $_POST['date'] ?? null;
    $salary = $_POST['salary'] ?? null;
    $status = $_POST['status'] ?? null;
    $beloning_dep = !empty($_POST['beloning_dep']) ? (int)$_POST['beloning_dep'] : null;

    $imagePath = '';
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = __DIR__ . '/../../images/';
        $imageName = uniqid() . '_' . basename($_FILES['image']['name']);
        $targetFile = $uploadDir . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = '/images/' . $imageName;
        } else {
            echo json_encode(['success' => false, 'message' => 'Не вдалося завантажити зображення.']);
            exit;
        }
    }

    $stmt = $conn->prepare("INSERT INTO employees (name, surname, middle_name, dob, sex, phone, email, address, position, dep_id, date, salary, status, image, beloning_dep) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param(
            'sssssssssisdsss',
            $name,
            $surname,
            $middle_name,
            $dob,
            $sex,
            $phone,
            $email,
            $address,
            $position,
            $dep_id,
            $date,
            $salary,
            $status,
            $imagePath,
            $beloning_dep
        );

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Співробітника додано успішно.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Помилка при виконанні запиту: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Не вдалося підготувати запит: ' . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Неприпустимий метод запиту.']);
}

?>

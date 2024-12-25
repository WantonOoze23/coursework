<?php
session_start(); // Стартуем сессию

ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $username = $input['username'];
    $password = $input['password'];

    // Проверка логина и пароля в базе данных
    $stmt = $conn->prepare("SELECT * FROM managers WHERE username = ?");
    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "Ошибка запроса: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Прямое сравнение пароля
        if ($password === $user['password']) {
            // Устанавливаем сессию
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;

            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Неправильный пароль."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Пользователь не найден."]);
    }

    $stmt->close();
    $conn->close();
}
?>

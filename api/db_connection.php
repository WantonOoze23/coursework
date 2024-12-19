<?php
$servername = "localhost";
$username = "root"; // Ваш логін MySQL
$password = ""; // Ваш пароль MySQL
$dbname = "Personal accounting";

$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка з'єднання
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
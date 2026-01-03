<?php
session_start();
require_once __DIR__ . '/db_connect.php';
$mysqli = getDB();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"] ?? '';
    $password = $_POST["password"] ?? '';

    $stmt = $mysqli->prepare('SELECT id, fullname, password, role FROM hrsystem WHERE fullname = ? LIMIT 1');
    $stmt->bind_param('s', $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if ($row && password_verify($password, $row['password'])) {
        session_regenerate_id(true);
        $_SESSION['logged_in'] = true;
        $_SESSION['name'] = $row['fullname'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['user_id'] = $row['id'];

        if ($row['role'] === 'employee') {
            header('Location: Employee-dashboard.php');
            exit();
        } elseif ($row['role'] === 'admin') {
            header('Location: ../components/Admin/Admin.php');
            exit();
        }
    } else {
        $_SESSION['loginMessage'] = 'Username and password do not match';
        header('Location: login.php');
        exit();
    }
}

      

?>

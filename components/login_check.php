<?php
session_start();
$host="localhost";
$user="root";
$password= "";
$dbname= "hr_systems";
$data = mysqli_connect($host, $user, $password, $dbname);
if($data === false){
    die("connection error");
}
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $name = $_POST["name"];
    $password_input = $_POST["password"];

    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM users WHERE fullname = ? AND password = ?";
    $stmt = mysqli_prepare($data, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $name, $password_input);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);

        if($row["role"] == "employee"){
            // $_SESSION["name"] = $name;
            header("location:Employee-dashboard.php");
            exit();
        } elseif($row["role"] == "admin"){
            // $_SESSION["name"] = $name;
            header("location:Admin.php");
            exit();
        } else {
            $msg = "Invalid role";
            $_SESSION["loginMessage"] = $msg;
            header("location:login.php");
            exit();
        }
    } else {
        $msg = "Username and password do not match";
        $_SESSION["loginMessage"] = $msg;
        header("location:login.php");
        exit();
    }
}



?>
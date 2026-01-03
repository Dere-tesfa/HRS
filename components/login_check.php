<?php
session_start();
require_once __DIR__ . '/db_connect.php';
$data = getDB();


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST["name"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM hrsystem 
            WHERE fullname='$name' AND password='$password'";
    // $sql = "SELECT * FROM users 
    //         WHERE fullname='$name' AND password='$password'";

    $result = mysqli_query($data, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        session_regenerate_id(true);
        $_SESSION["logged_in"] = true;
        $_SESSION["name"] = $row["fullname"];
        $_SESSION["role"] = $row["role"];


        if ($row["role"] == "employee") {
            header("Location:Employee-dashboard.php");

            exit();
        } elseif ($row["role"] == "admin") {
            header("Location:../components/Admin/Admin.php");
            exit();
        }
           

    } else {
        $_SESSION["loginMessage"] = "Username and password do not match";
        header("Location: login.php");
        exit();
    }
}

      

?>

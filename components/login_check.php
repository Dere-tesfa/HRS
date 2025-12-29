<?php
session_start();
$host = "localhost";
$user = "root";
$password = "";
$dbname = "hr_systems";

$data = mysqli_connect($host, $user, $password, $dbname);
if ($data === false) {
    die("connection error");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST["name"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM hrsystem 
            WHERE fullname='$name' AND password='$password'";
    // $sql = "SELECT * FROM users 
    //         WHERE fullname='$name' AND password='$password'";

    $result = mysqli_query($data, $sql);

    if ($row = mysqli_fetch_assoc($result)) {

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

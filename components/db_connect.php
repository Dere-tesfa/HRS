<?php
function getDB() {
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "hr_systems";

    $mysqli = new mysqli($host, $user, $password, $dbname);
    if ($mysqli->connect_errno) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    $mysqli->set_charset("utf8mb4");
    return $mysqli;
}

?>

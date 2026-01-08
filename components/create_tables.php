<?php
require_once __DIR__ . '/db_connect.php';

$rootDbName = 'hr_systems';

// Connect without selecting DB to ensure database exists
$host = 'localhost';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password);
if ($conn->connect_errno) {
    die("Connection failed: " . $conn->connect_error);
}

if (!$conn->query("CREATE DATABASE IF NOT EXISTS `$rootDbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci")) {
    die("Failed to create database: " . $conn->error);
}

$conn->select_db($rootDbName);

$sql = [];

$sql[] = "CREATE TABLE IF NOT EXISTS hrsystem (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    phone VARCHAR(50),
    address VARCHAR(255),
    department VARCHAR(100),
    gender VARCHAR(20),
    role VARCHAR(50) DEFAULT 'employee',
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$sql[] = "CREATE TABLE IF NOT EXISTS employees (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    position VARCHAR(100),
    department VARCHAR(100),
    hire_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES hrsystem(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$sql[] = "CREATE TABLE IF NOT EXISTS leaves (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    employee_id INT UNSIGNED NOT NULL,
    start_date DATE,
    end_date DATE,
    reason TEXT,
    status ENUM('pending','approved','rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$sql[] = "CREATE TABLE IF NOT EXISTS jobs (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    job_title VARCHAR(255) NOT NULL,
    department VARCHAR(255) NOT NULL,
    job_type VARCHAR(255) NOT NULL,
    salary DECIMAL(10, 2) NOT NULL,
    location VARCHAR(255) NOT NULL,
    description TEXT,
    deadline DATE,
    posted_by INT UNSIGNED,
    posted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (posted_by) REFERENCES hrsystem(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

// $sql[] = "CREATE TABLE IF NOT EXISTS job_applications (
//     id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     job_id INT UNSIGNED NOT NULL,
//     fullname VARCHAR(255),
//     email VARCHAR(150),
//     phone VARCHAR(50),
//     resume_path VARCHAR(255),
//     cover_letter TEXT,
//     applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     FOREIGN KEY (job_id) REFERENCES jobs(id) ON DELETE CASCADE
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$sql[] = "CREATE TABLE IF NOT EXISTS job_applications_raw (
      id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(100) NOT NULL,
    lname VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    appliedPosition VARCHAR(150) NOT NULL,
    applied_date DATE NOT NULL,
    coverletter TEXT NOT NULL,
    uploadresume VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";


foreach ($sql as $stmt) {
    if (!$conn->query($stmt)) {
        echo "Error creating table: " . $conn->error . "\n";
    }
}

echo "Database and tables created (or already exist).\n";

$conn->close();

?>

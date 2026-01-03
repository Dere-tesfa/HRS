
<?php
session_start();
// error_reporting(0);
require_once __DIR__ . '/db_connect.php';
$mysqli = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $errors = [];
    $old = [];

    // Collect and trim
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $department = trim($_POST['department'] ?? '');
    $gender = $_POST['gender'] ?? '';
    $password = trim($_POST['password'] ?? '');
    $confirm = trim($_POST['confirmPassword'] ?? '');

    $old['fullname'] = $fullname;
    $old['email'] = $email;
    $old['phone'] = $phone;
    $old['address'] = $address;
    $old['department'] = $department;
    $old['gender'] = $gender;

    // Validations (same rules as signup.php)
    if ($fullname === '') {
        $errors['fullname'] = '* Name is required!';
    } elseif (strlen($fullname) < 3) {
        $errors['fullname'] = '* Name must be at least 3 characters!';
    }

    if ($email === '') {
        $errors['email'] = '* Email is required!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format!';
    } else {
        // check duplicate email
        $stmt = $mysqli->prepare('SELECT id FROM hrsystem WHERE email = ? LIMIT 1');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors['email'] = 'Email is already registered';
        }
        $stmt->close();
    }

    if ($phone === '') {
        $errors['phone'] = '* Phone is required!';
    } elseif (strlen($phone) < 13) {
        $errors['phone'] = '* phoneNumber must not be less than 13 digits long!';
    } elseif (strlen($phone) > 13) {
        $errors['phone'] = '* phoneNumber must not be greater than 13 digits long!';
    }

    if ($address === '') {
        $errors['address'] = '* Address is required!';
    }

    if ($department === '') {
        $errors['department'] = '* Department is required!';
    }

    if (empty($gender)) {
        $errors['gender'] = '* Gender must be selected!';
    }

    if ($password === '') {
        $errors['password'] = '* Password is required!';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'Your Password Must Contain At Least 8 Characters!';
    } elseif (!preg_match('/\d/', $password)) {
        $errors['password'] = 'Your Password Must Contain At Least 1 Number!';
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $errors['password'] = 'Your Password Must Contain At Least 1 Capital Letter!';
    }

    if ($confirm === '') {
        $errors['confirmPassword'] = '* Confirm password is required!';
    } elseif ($password !== $confirm) {
        $errors['confirmPassword'] = '* Password did not match!';
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $old;
        header('Location: signup.php');
        exit;
    }

    // All good: insert user (hash password)
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $role = 'employee';

    $stmt = $mysqli->prepare('INSERT INTO hrsystem (fullname,email,phone,address,department,gender,role,password) VALUES (?,?,?,?,?,?,?,?)');
    if (!$stmt) {
        $_SESSION['errors'] = ['general' => 'Database error: ' . $mysqli->error];
        $_SESSION['old'] = $old;
        header('Location: signup.php');
        exit;
    }
    $stmt->bind_param('ssssssss', $fullname, $email, $phone, $address, $department, $gender, $role, $hash);
    $ok = $stmt->execute();
    if ($ok) {
        $_SESSION['message'] = 'The application is sent successfully!';
        $stmt->close();
        header('Location: login.php');
        exit;
    } else {
        $_SESSION['errors'] = ['general' => 'Apply failed: ' . $stmt->error];
        $_SESSION['old'] = $old;
        $stmt->close();
        header('Location: signup.php');
        exit;
    }
}

?>
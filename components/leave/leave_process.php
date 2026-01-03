<?php
session_start();
require_once __DIR__ . '/../db_connect.php';

$mysqli = getDB();

// Require POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: Add_leave.php');
    exit;
}

// Basic validation
$leave_type = trim($_POST['leave_type'] ?? '');
$start_date = trim($_POST['start_date'] ?? '');
$end_date = trim($_POST['end_date'] ?? '');
$reason = trim($_POST['reason'] ?? '');
$employee_name = trim($_POST['employee_name'] ?? '');

$errors = [];
if ($leave_type === '') $errors[] = 'Leave type is required.';
if ($start_date === '') $errors[] = 'Start date is required.';
if ($end_date === '') $errors[] = 'End date is required.';
if ($reason === '') $errors[] = 'Reason is required.';
if (!empty($start_date) && !empty($end_date) && $start_date > $end_date) $errors[] = 'Start date must be before end date.';

if (!empty($errors)) {
    $_SESSION['leave_errors'] = $errors;
    header('Location: Add_leave.php');
    exit;
}

// Determine hr user id: prefer explicit logged-in user id, then session name, then posted name
$hr_user_id = null;
if (!empty($_SESSION['user_id'])) {
    $hr_user_id = (int) $_SESSION['user_id'];
} elseif (!empty($_SESSION['name'])) {
    $stmt = $mysqli->prepare('SELECT id FROM hrsystem WHERE fullname = ? LIMIT 1');
    $stmt->bind_param('s', $_SESSION['name']);
    $stmt->execute();
    $stmt->bind_result($hr_user_id);
    $stmt->fetch();
    $stmt->close();
}

// Fallback: try posted employee_name
if (empty($hr_user_id) && $employee_name !== '') {
    $stmt = $mysqli->prepare('SELECT id FROM hrsystem WHERE fullname = ? LIMIT 1');
    $stmt->bind_param('s', $employee_name);
    $stmt->execute();
    $stmt->bind_result($hr_user_id);
    $stmt->fetch();
    $stmt->close();
}

if (empty($hr_user_id)) {
    $_SESSION['leave_errors'] = ['Could not determine your user account. Please ensure you are logged in.'];
    header('Location: Add_leave.php');
    exit;
}

// Ensure there is an employees record for this hr user
$employee_id = null;
$stmt = $mysqli->prepare('SELECT id FROM employees WHERE user_id = ? LIMIT 1');
$stmt->bind_param('i', $hr_user_id);
$stmt->execute();
$stmt->bind_result($employee_id);
$stmt->fetch();
$stmt->close();

if (empty($employee_id)) {
    // insert a new employees row (minimal data)
    $position = null;
    $department = null;
    $hire_date = null;
    // attempt to get department from hrsystem
    $stmt = $mysqli->prepare('SELECT department FROM hrsystem WHERE id = ? LIMIT 1');
    $stmt->bind_param('i', $hr_user_id);
    $stmt->execute();
    $stmt->bind_result($department_from_user);
    if ($stmt->fetch()) {
        $department = $department_from_user;
    }
    $stmt->close();

    $stmt = $mysqli->prepare('INSERT INTO employees (user_id, position, department, hire_date) VALUES (?,?,?,?)');
    $stmt->bind_param('isss', $hr_user_id, $position, $department, $hire_date);
    $ok = $stmt->execute();
    if ($ok) {
        $employee_id = $stmt->insert_id;
    } else {
        $_SESSION['leave_errors'] = ['Failed to create employee record: ' . $stmt->error];
        $stmt->close();
        header('Location: Add_leave.php');
        exit;
    }
    $stmt->close();
}

// Insert leave
$status = 'pending';
$stmt = $mysqli->prepare('INSERT INTO leaves (employee_id, start_date, end_date, reason, status) VALUES (?,?,?,?,?)');
$stmt->bind_param('issss', $employee_id, $start_date, $end_date, $reason, $status);
$ok = $stmt->execute();
if ($ok) {
    $_SESSION['leave_success'] = 'Leave request submitted successfully.';
    $stmt->close();
    header('Location: Add_leave.php');
    exit;
} else {
    $_SESSION['leave_errors'] = ['Failed to submit leave request: ' . $stmt->error];
    $stmt->close();
    header('Location: Add_leave.php');
    exit;
}

?>

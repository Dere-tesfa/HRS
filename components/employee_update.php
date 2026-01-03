<?php
session_start();
require_once __DIR__ . '/db_connect.php';
$mysqli = getDB();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: Employee-profile.php');
    exit;
}

if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$uid = (int) $_SESSION['user_id'];

$fullname = trim($_POST['fullname'] ?? '');
$email = trim($_POST['email'] ?? '');
$address = trim($_POST['address'] ?? '');
$position = trim($_POST['position'] ?? '');
$department = trim($_POST['department'] ?? '');
$hire_date = trim($_POST['hire_date'] ?? '');

$errors = [];
if ($fullname === '') $errors[] = 'Full name is required.';
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';

// check email uniqueness (exclude current user)
$stmt = $mysqli->prepare('SELECT id FROM hrsystem WHERE email = ? AND id <> ? LIMIT 1');
$stmt->bind_param('si', $email, $uid);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) $errors[] = 'Email is already used by another account.';
$stmt->close();

if (!empty($errors)) {
    $_SESSION['profile_errors'] = $errors;
    header('Location: Employee-profile.php?edit=1');
    exit;
}

// Update hrsystem table
$stmt = $mysqli->prepare('UPDATE hrsystem SET fullname = ?, email = ?, address = ?, department = ? WHERE id = ?');
$stmt->bind_param('ssssi', $fullname, $email, $address, $department, $uid);
$ok1 = $stmt->execute();
$stmt->close();

// Clear any duplicated department stored in employees table for this user
$stmt = $mysqli->prepare('UPDATE employees SET department = NULL WHERE user_id = ?');
if ($stmt) {
    $stmt->bind_param('i', $uid);
    $stmt->execute();
    $stmt->close();
}

$emp_id = 0;
// Ensure employees row exists (store only position and hire_date in employees)
$stmt = $mysqli->prepare('SELECT id FROM employees WHERE user_id = ? LIMIT 1');
$stmt->bind_param('i', $uid);
$stmt->execute();
$stmt->bind_result($emp_id);
$stmt->fetch();
$stmt->close();

if ($emp_id) {
    $stmt = $mysqli->prepare('UPDATE employees SET position = ?, hire_date = ? WHERE id = ?');
    $stmt->bind_param('ssi', $position, $hire_date, $emp_id);
    $ok2 = $stmt->execute();
    $stmt->close();
} else {
    $stmt = $mysqli->prepare('INSERT INTO employees (user_id, position, hire_date) VALUES (?,?,?)');
    $stmt->bind_param('iss', $uid, $position, $hire_date);
    $ok2 = $stmt->execute();
    $stmt->close();
}

// Remove any accidental duplicate employees rows for this user (keep lowest id)
$stmt = $mysqli->prepare('SELECT id FROM employees WHERE user_id = ? ORDER BY id ASC');
if ($stmt) {
    $stmt->bind_param('i', $uid);
    $stmt->execute();
    $res = $stmt->get_result();
    $keep = null;
    $toDelete = [];
    while ($r = $res->fetch_assoc()) {
        if ($keep === null) {
            $keep = $r['id'];
        } else {
            $toDelete[] = (int)$r['id'];
        }
    }
    $stmt->close();
    if (!empty($toDelete)) {
        $in = implode(',', array_map('intval', $toDelete));
        $mysqli->query("DELETE FROM employees WHERE id IN ($in)");
    }
}

if ($ok1 && $ok2) {
    $_SESSION['profile_success'] = 'Profile updated successfully.';
} else {
    $_SESSION['profile_errors'] = ['Failed to update profile.'];
}
// Clean up any leftover old form/session data and redirect
unset($_SESSION['old'], $_SESSION['errors']);
header('Location: Employee-profile.php');
exit;
?>
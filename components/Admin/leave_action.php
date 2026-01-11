<?php
session_start();
require_once __DIR__ . '/../db_connect.php';

$mysqli = getDB();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die('Unauthorized access.');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: admin_leave_requests.php');
    exit;
}

$leave_id = (int)($_POST['leave_id'] ?? 0);
$action   = $_POST['action'] ?? '';
$admin_id = (int)($_SESSION['user_id'] ?? 0);

if ($leave_id <= 0 || !in_array($action, ['approved', 'rejected']) || $admin_id <= 0) {
    die('Invalid request.');
}

$approved_at = date('Y-m-d H:i:s');

$stmt = $mysqli->prepare("
    UPDATE leaves 
    SET status = ?, approved_at = ?, approved_by = ?
    WHERE id = ?
");

$stmt->bind_param('ssii', $action, $approved_at, $admin_id, $leave_id);

$stmt->execute();
$stmt->close();

header('Location: admin_leave_requests.php');
exit;

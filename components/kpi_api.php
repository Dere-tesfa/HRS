<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/db_connect.php';

$mysqli = getDB();

function tableExists($mysqli, $name) {
    $name = $mysqli->real_escape_string($name);
    $res = $mysqli->query("SHOW TABLES LIKE '" . $name . "'");
    return $res && $res->num_rows > 0;
}

$result = [
    'headcount' => 0,
    'active_today' => 0,
    'pending_leave' => 0,
    'open_tasks' => 0
];

// Headcount
if (tableExists($mysqli, 'employees')) {
    $row = $mysqli->query('SELECT COUNT(*) AS c FROM employees')->fetch_assoc();
    $result['headcount'] = (int)($row['c'] ?? 0);
}

// Active Today - attendance table if exists
if (tableExists($mysqli, 'attendance')) {
    $stmt = $mysqli->prepare("SELECT COUNT(DISTINCT employee_id) AS c FROM attendance WHERE DATE(attendance_date) = CURDATE()");
    if ($stmt) {
        $stmt->execute();
        $r = $stmt->get_result()->fetch_assoc();
        $result['active_today'] = (int)($r['c'] ?? 0);
        $stmt->close();
    }
}

// Pending Leave
if (tableExists($mysqli, 'leaves')) {
    $stmt = $mysqli->prepare("SELECT COUNT(*) AS c FROM leaves WHERE status IN ('pending','Pending','PENDING')");
    if ($stmt) {
        $stmt->execute();
        $r = $stmt->get_result()->fetch_assoc();
        $result['pending_leave'] = (int)($r['c'] ?? 0);
        $stmt->close();
    }
}

// Open Tasks
if (tableExists($mysqli, 'tasks')) {
    $stmt = $mysqli->prepare("SELECT COUNT(*) AS c FROM tasks WHERE status IN ('open','Open','OPEN')");
    if ($stmt) {
        $stmt->execute();
        $r = $stmt->get_result()->fetch_assoc();
        $result['open_tasks'] = (int)($r['c'] ?? 0);
        $stmt->close();
    }
}

// Support details view: ?action=details&metric=headcount|active_today|pending_leave|open_tasks
$action = $_GET['action'] ?? '';
if ($action === 'details') {
    $metric = $_GET['metric'] ?? '';
    $rows = [];
    if ($metric === 'headcount' && tableExists($mysqli, 'employees')) {
        $res = $mysqli->query('SELECT id, COALESCE(name, user_id) AS name, position FROM employees ORDER BY id DESC LIMIT 20');
        while ($r = $res->fetch_assoc()) $rows[] = $r;
    } elseif ($metric === 'active_today' && tableExists($mysqli, 'attendance')) {
        $sql = "SELECT a.employee_id, COALESCE(e.name,e.user_id) AS name, a.attendance_date AS time FROM attendance a LEFT JOIN employees e ON e.id = a.employee_id WHERE DATE(a.attendance_date)=CURDATE() ORDER BY a.attendance_date DESC LIMIT 20";
        $res = $mysqli->query($sql);
        while ($r = $res->fetch_assoc()) $rows[] = $r;
    } elseif ($metric === 'pending_leave' && tableExists($mysqli, 'leaves')) {
        $sql = "SELECT l.id, COALESCE(e.name,e.user_id) AS name, l.start_date, l.end_date, l.reason FROM leaves l LEFT JOIN employees e ON e.id = l.employee_id WHERE l.status IN ('pending','Pending','PENDING') ORDER BY l.start_date DESC LIMIT 20";
        $res = $mysqli->query($sql);
        while ($r = $res->fetch_assoc()) $rows[] = $r;
    } elseif ($metric === 'open_tasks' && tableExists($mysqli, 'tasks')) {
        $sql = "SELECT id, title, assignee, status FROM tasks WHERE status IN ('open','Open','OPEN') ORDER BY id DESC LIMIT 20";
        $res = $mysqli->query($sql);
        while ($r = $res->fetch_assoc()) $rows[] = $r;
    }
    echo json_encode(['rows' => $rows]);
    $mysqli->close();
    exit;
}

echo json_encode($result);
$mysqli->close();
exit;

?>

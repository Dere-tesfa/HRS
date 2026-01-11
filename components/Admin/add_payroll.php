<?php
session_start();
require_once __DIR__ . '/../db_connect.php';
$mysqli = getDB();

if ($_SESSION['role'] !== 'admin') die('Access denied');

$employees = [];
$res = $mysqli->query("SELECT id, fullname FROM hrsystem WHERE role='employee'");
while ($row = $res->fetch_assoc()) $employees[] = $row;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = (int)$_POST['employee_id'];
    $month = $_POST['month'];
    $basic = (float)$_POST['basic_salary'];
    $allowance = (float)$_POST['allowance'];
    $deduction = (float)$_POST['deduction'];
    $net = ($basic + $allowance) - $deduction;
    $admin_id = (int)$_SESSION['user_id'];

    $stmt = $mysqli->prepare("
        INSERT INTO payroll 
        (employee_id, month, basic_salary, allowance, deduction, net_salary, created_by)
        VALUES (?,?,?,?,?,?,?)
    ");
    $stmt->bind_param('issdddi', $employee_id, $month, $basic, $allowance, $deduction, $net, $admin_id);
    $stmt->execute();
    $stmt->close();

    header('Location: payroll_list.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Payroll</title>
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
    background: #f4f6f9;
    padding: 40px 0;
}
.container {
    max-width: 500px;
    margin: auto;
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
.container h2 {
    text-align: center;
    color: #04b8a0;
    margin-bottom: 25px;
}
label {
    display: block;
    margin: 12px 0 5px;
    font-weight: bold;
}
input, select {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 15px;
}
button {
    background: #04b8a0;
    color: #fff;
    border: none;
    padding: 12px 20px;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
}
button:hover {
    background: #039e90;
}
</style>
</head>
<body>
<div class="container">
    <h2>Add Payroll</h2>
    <form method="POST">
        <label>Employee:</label>
        <select name="employee_id" required>
            <option value="">--Select Employee--</option>
            <?php foreach($employees as $e): ?>
                <option value="<?= $e['id'] ?>"><?= htmlspecialchars($e['fullname']) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Month (YYYY-MM):</label>
        <input type="month" name="month" required>

        <label>Basic Salary:</label>
        <input type="number" name="basic_salary" step="0.01" required>

        <label>Allowance:</label>
        <input type="number" name="allowance" step="0.01" required>

        <label>Deduction:</label>
        <input type="number" name="deduction" step="0.01" required>

        <button type="submit">Add Payroll</button>
    </form>
</div>
</body>
</html>

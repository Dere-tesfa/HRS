<?php
session_start();
require_once __DIR__ . '/../db_connect.php';
$mysqli = getDB();
if ($_SESSION['role'] !== 'employee') die('Access denied');

$user_id = (int)$_SESSION['user_id'];
$sql = "SELECT p.*, a.fullname AS admin_name
        FROM payroll p
        JOIN hrsystem a ON p.created_by = a.id
        WHERE p.employee_id = ?
        ORDER BY p.created_at DESC";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>My Payroll</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            padding: 30px;
        }

        h1 {
            text-align: center;
            color: #04b8a0;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #04b8a0;
            color: #fff;
        }

        tr:hover {
            background: #f1f1f1;
        }
    </style>
</head>

<body>
    <h1>My Payrolls</h1>
    <table>
        <tr>
            <th>Month</th>
            <th>Basic</th>
            <th>Allowance</th>
            <th>Deduction</th>
            <th>Net Salary</th>
            <th>Admin</th>
            <th>Created At</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['month'] ?></td>
                <td><?= number_format($row['basic_salary'], 2) ?></td>
                <td><?= number_format($row['allowance'], 2) ?></td>
                <td><?= number_format($row['deduction'], 2) ?></td>
                <td><?= number_format($row['net_salary'], 2) ?></td>
                <td><?= htmlspecialchars($row['admin_name']) ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>
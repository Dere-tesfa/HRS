<?php
session_start();
require_once __DIR__ . '/../db_connect.php';

$mysqli = getDB();

if (!isset($_SESSION['user_id'])) {
    die('Please log in.');
}

$user_id = (int) $_SESSION['user_id'];

$sql = "
SELECT 
    l.start_date,
    l.end_date,
    l.reason,
    l.status,
    l.approved_at,
    h.fullname AS approved_by
FROM leaves l
JOIN employees e ON l.employee_id = e.id
LEFT JOIN hrsystem h ON l.approved_by = h.id
WHERE e.user_id = ?
ORDER BY l.start_date DESC
";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>

<head>
    <title>My Leave Requests</title>
       <link rel="stylesheet" href="../../font/css/all.css">
  <link rel="stylesheet" href="../../font/css/all.min.css">
  <script src="../../font/js/all.js"></script>
  <script src="../../font/js/all.min.js"></script>
    <style>
        body {
            background: #f4f6f9;
            font-family: Arial;
            padding: 40px;
        }

        .card {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            max-width: 900px;
            margin: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
        }

        .pending {
            background: #f1c40f;
            color: #000;
        }

        .approved {
            background: #2ecc71;
            color: #fff;
        }

        .rejected {
            background: #e74c3c;
            color: #fff;
        }

        .back-btn{
            background: #04b8a0ff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            margin-bottom: 20px;
        }
        .back-btn a {
            text-decoration: none;
            color: white;
        }
    </style>
</head>

<body>
    <button class="back-btn" type="submit"><a href="../Employee-dashboard.php"> <i class="fa fa-arrow-left"></i>Back</a></button>
    <div class="card">
        <h2>My Leave Requests</h2>

        <table>
            <tr>
                <th>Period</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Approved Info</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['start_date'] ?> → <?= $row['end_date'] ?></td>
                    <td><?= htmlspecialchars($row['reason']) ?></td>
                    <td>
                        <span class="badge <?= $row['status'] ?>">
                            <?= ucfirst($row['status']) ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($row['status'] === 'approved' || $row['status'] === 'rejected'): ?>
                            <?= $row['approved_at'] ?><br>
                            By: <?= htmlspecialchars($row['approved_by']) ?>
                        <?php else: ?>
                            —
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

    </div>
</body>

</html>
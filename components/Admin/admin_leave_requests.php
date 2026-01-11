<?php
session_start();
require_once __DIR__ . '/../db_connect.php';

$mysqli = getDB();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die('Access denied.');
}

$sql = "
SELECT 
    l.id AS leave_id,
    h.fullname,
    l.start_date,
    l.end_date,
    l.reason,
    l.status
FROM leaves l
JOIN employees e ON l.employee_id = e.id
JOIN hrsystem h ON e.user_id = h.id
WHERE l.status = 'pending'
ORDER BY l.start_date ASC
";

$result = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Leave Approvals</title>

<style>
* {
    box-sizing: border-box;
    font-family: 'Segoe UI', Arial, sans-serif;
}

body {
    background: #f4f6f9;
    padding: 40px;
}

.container {
    max-width: 1100px;
    margin: auto;
}

.card {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
}

h2 {
    margin-bottom: 20px;
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background: #f1f3f5;
}

th, td {
    padding: 14px 12px;
    text-align: left;
}

th {
    color: #555;
    font-weight: 600;
}

tbody tr {
    border-bottom: 1px solid #e6e6e6;
}

tbody tr:hover {
    background: #fafafa;
}

.reason {
    max-width: 300px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.actions {
    display: flex;
    gap: 10px;
}

button {
    border: none;
    padding: 8px 14px;
    border-radius: 6px;
    font-size: 14px;
    cursor: pointer;
}

.approve {
    background: #2ecc71;
    color: white;
}

.reject {
    background: #e74c3c;
    color: white;
}

.approve:hover { background: #27ae60; }
.reject:hover { background: #c0392b; }

.empty {
    text-align: center;
    padding: 30px;
    color: #777;
}

.modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.45);
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal-content {
    background: #fff;
    padding: 25px;
    max-width: 500px;
    border-radius: 10px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.modal-content h3 {
    margin-bottom: 10px;
}

.close-btn {
    margin-top: 15px;
    background: #444;
    color: #fff;
    padding: 8px 14px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
}

</style>
</head>
<div class="modal" id="reasonModal">
    <div class="modal-content">
        <h3>Leave Reason</h3>
        <p id="modalText"></p>
        <button class="close-btn" onclick="closeModal()">Close</button>
    </div>
</div>
<script>
function openModal(text) {
    document.getElementById('modalText').innerText = text;
    document.getElementById('reasonModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('reasonModal').style.display = 'none';
}
</script>

<body>

<div class="container">
    <div class="card">
        <h2>Pending Leave Requests</h2>

        <?php if ($result->num_rows === 0): ?>
            <div class="empty">No pending leave requests.</div>
        <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Reason</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['fullname']) ?></td>
                    <td><?= $row['start_date'] ?></td>
                    <td><?= $row['end_date'] ?></td>
                   <td>
    <a href="#" onclick="openModal('<?= htmlspecialchars(addslashes($row['reason'])) ?>')">
        View Reason
    </a>
</td>

                    <td>
                        <div class="actions">
                            <form method="POST" action="leave_action.php">
                                <input type="hidden" name="leave_id" value="<?= $row['leave_id'] ?>">
                                <button class="approve" name="action" value="approved">Approve</button>
                            </form>
                            <form method="POST" action="leave_action.php">
                                <input type="hidden" name="leave_id" value="<?= $row['leave_id'] ?>">
                                <button class="reject" name="action" value="rejected">Reject</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>

</body>
</html>

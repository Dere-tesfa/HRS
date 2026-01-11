<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Leave</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f4f6f9;
            padding: 40px;
        }

        .leave-container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .leave-container h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        hr {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        .form-actions {
            text-align: center;
            margin-top: 20px;
        }

        button {
            background: #04b8a0ff;
            color: #fff;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 20px;
        }
button a {
            text-decoration: none;
            color: white;
        }
        button:hover {
            background: #588fcbff;
        }
    </style>
</head>
<body>
    <?php
    if (session_status() === PHP_SESSION_NONE) session_start();
    $leave_errors = $_SESSION['leave_errors'] ?? [];
    $leave_success = $_SESSION['leave_success'] ?? '';
    unset($_SESSION['leave_errors'], $_SESSION['leave_success']);
    ?>

    <?php if (!empty($leave_errors)): ?>
        <div style="color:#b00020;margin-bottom:12px;font-size:26px;text-align:center;">
            <?php foreach ($leave_errors as $e) echo '<div>' . htmlspecialchars($e) . '</div>'; ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($leave_success)): ?>
        <div style="color:green;margin-bottom:12px;font-size:26px;text-align:center;">
            <?php echo htmlspecialchars($leave_success); ?>
        </div>
    <?php endif; ?>

<div class="leave-container">
    <h2>Leave Request Form</h2>
    <hr>

    <form action="leave_process.php" method="POST">
        
        <div class="form-group">
            <label>Employee Name</label>
            <input type="text" name="employee_name" value="<?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : ''; ?>" required>
        </div>

        <div class="form-group">
            <label>Leave Type</label>
            <select name="leave_type" required>
                <option value="">-- Select Leave Type --</option>
                <option value="Annual Leave">Annual Leave</option>
                <option value="Sick Leave">Sick Leave</option>
                <option value="Maternity Leave">Maternity Leave</option>
                <option value="Paternity Leave">Paternity Leave</option>
                <option value="Unpaid Leave">Unpaid Leave</option>
            </select>
        </div>

        <div class="form-group">
            <label>Start Date</label>
            <input type="date" name="start_date" required>
        </div>

        <div class="form-group">
            <label>End Date</label>
            <input type="date" name="end_date" required>
        </div>

        <div class="form-group">
            <label>Reason for Leave</label>
            <textarea name="reason" placeholder="Enter reason for leave..." required></textarea>
        </div>

        <div class="form-actions">
            <button type="submit">Submit Request</button>
             <button type="submit"><a href="../Employee-dashboard.php">Cancel</a></button>
        </div>

    </form>
</div>

</body>
</html>

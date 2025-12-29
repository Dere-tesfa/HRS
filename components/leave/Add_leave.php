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
        }

        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <?php
    
    
    ?>

<div class="leave-container">
    <h2>Leave Request Form</h2>
    <hr>

    <form action="leave_process.php" method="POST">
        
        <div class="form-group">
            <label>Employee Name</label>
            <input type="text" name="employee_name" required>
        </div>

        <div class="form-group">
            <label>Employee ID</label>
            <input type="text" name="employee_id" required>
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
        </div>

    </form>
</div>

</body>
</html>

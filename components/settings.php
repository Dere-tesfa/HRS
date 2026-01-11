<?php
// Include the db_connect.php file
include('db_connect.php');

$mysqli = getDB();

// Check if the user is logged in
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ... rest of your code
 

if (!empty($_SESSION['user_id'])) {

    $userId = (int) $_SESSION['user_id'];

    // Fetch current password
    $stmt = $mysqli->prepare("SELECT password FROM hrsystem WHERE id = ? LIMIT 1");
    if (!$stmt) {
        die("Prepare failed: " . $mysqli->error);
    }

    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    $stmt->close();

    if (!$row) {
        die("User not found.");
    }

    if (!empty($_POST['current_password']) &&
        !empty($_POST['new_password']) &&
        !empty($_POST['confirm_password'])) {

        $currentPassword = $_POST['current_password'];
        $newPassword     = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];

        if (!password_verify($currentPassword, $row['password'])) {
            $_SESSION['errors'][] = 'Current password is incorrect';
        } elseif ($newPassword !== $confirmPassword) {
            $_SESSION['errors'][] = 'New password and confirm password do not match';
        } else {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $stmt = $mysqli->prepare("UPDATE hrsystem SET password = ? WHERE id = ?");
            if (!$stmt) {
                die("Prepare failed: " . $mysqli->error);
            }

            $stmt->bind_param('si', $hashedPassword, $userId);
            $stmt->execute();
            $stmt->close();

            header('Location: login.php');
            exit;
        }
    }
}
?>
<html>
<head>
    <title>Change Password</title>
       <link rel="stylesheet" href="../../font/css/all.css">
  <link rel="stylesheet" href="../../font/css/all.min.css">
  <script src="../../font/js/all.js"></script>
  <script src="../../font/js/all.min.js"></script>
<style>
    h1 {
        margin-top: 150px;
        text-align: center;
    }
    .settings-form {
        max-width: 400px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    .settings-form label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }
    .settings-form input[type="password"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .settings-form .form-submit {
        background-color: hsl(180, 58%, 47%);
        color: white;
        font-weight: bold;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .settings-form .form-submit:hover {
        background-color: #1988a0ff;
    }
    .settings-form .form-back {
        background-color: #1988a0ff;
        color: white;
        font-weight: bold;
        margin-left: 80px;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-left: 10px;
    }
    .settings-form .form-back:hover {
         background-color: hsl(180, 58%, 47%);
    }
    .form-back a {
        text-decoration: none;
        color: white;
    }
    .error {
        font-size: 17px;
        color: red;
        font-weight: bold;
        text-align: center;
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
            margin-left: 30px;
        }
        .back-btn a {
            text-decoration: none;
            color: white;
        }
</style>
</head>
<body>
    
<button class="back-btn" type="submit"><a href="../components/login.php"> <i class="fa fa-arrow-left"></i>Back</a></button>
<h1>Change Password</h1>
<form class="settings-form" method="POST" action="">
    <label for="current_password">Current Password:</label>
    <input type="password" id="current_password" name="current_password" required><br>

    <label for="new_password">New Password:</label>
    <input type="password" id="new_password" name="new_password" required><br>

    <label for="confirm_password">Confirm New Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required><br>

    <input class="form-submit" type="submit" value="Change Password">
</form>

</body>
</html>
<?php
if (!empty($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $error) {
        echo '<p class="error">' . htmlspecialchars($error) . '</p>';
    }
    unset($_SESSION['errors']);
}
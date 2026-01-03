<?php
$headersSent = false;
if (session_status() === PHP_SESSION_NONE) session_start();
// Prevent browser caching so updated profile shows immediately after save
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
require_once __DIR__ . '/db_connect.php';
$mysqli = getDB();

if (empty($_SESSION['user_id'])) {
        header('Location: ../components/login.php');
        exit;
}

$userId = (int) $_SESSION['user_id'];
$stmt = $mysqli->prepare('SELECT h.fullname, h.email, h.address AS h_address, h.department AS h_department, e.position, e.hire_date FROM hrsystem h LEFT JOIN employees e ON e.user_id = h.id WHERE h.id = ? LIMIT 1');
$stmt->bind_param('i', $userId);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
$stmt->close();

// fallback values
$fullname = $row['fullname'] ?? '';
$email = $row['email'] ?? '';
$address = $row['h_address'] ?? $row['address'] ?? '';
$position = $row['position'] ?? '';
$department = $row['h_department'] ?? '';
$hire_date = $row['hire_date'] ?? '';

?>




<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>employee profile</title>
         <link rel="stylesheet" href="/HRS/css/style.css?v=2">
        <link rel="stylesheet" href="../font/css/all.css">
        <link rel="stylesheet" href="../font/css/all.min.css">
        <script src="../font/js/all.js"></script>
        <script src="../font/js/all.min.js"></script>
</head>

<body>
        <header>
                <div class="header_content">
                        <div class="header-logo"><a href="../Html/index.php"><img src="../images/logo.png" alt="logo"></a>
                        </div>
                        <h2>HR-System</h2>
                </div>
        </header>
        <div class="employee_page_container">
                <aside class="employee_dashboard">
                        <ul class="employee_main_page">
                                <li> <i class="fa-solid fa-city dashboard_icons
                          "></i><a class="dashboard_links
                          " href="Employee-dashboard.php">Dashboard</a></li>
                                </li>
                                <li class="active"> <i class="fa-solid fa-user dashboard_icons
                          "></i><a class="dashboard_links
                          " href="./Employee-profile.php">Profile</a></li>
                                <li> <i class="fa-solid fa-clipboard-user dashboard_icons
                          "></i><a class="dashboard_links
                          " href="#">Attendance</a></li>
                                <li> <i class="fa-brands fa-paypal dashboard_icons
                          "></i><a class="dashboard_links
                          " href="#">Payroll</a></li>
                                <li> <i class="fa-solid fa-ban dashboard_icons
                          "></i><a class="dashboard_links
                          " href="#">Leave</a></li>
                        </ul>
                </aside>
                <div class="employee_profile_container">
                        <h2>Employee Profile Page</h2>
                        <p>Welcome to your profile page. Here you can view and update your personal information.</p>
                        <div class="profile_card">
                                <i class="fa-solid fa-user profile_icon"></i>
                                
                                <?php if (!empty($_SESSION['profile_success'])): ?>
                                        <div class="profile-success"><?php echo htmlspecialchars($_SESSION['profile_success']); unset($_SESSION['profile_success']); ?></div>
                                <?php endif; ?>
                                <?php if (!empty($_SESSION['profile_errors'])): ?>
                                        <div class="profile-errors"><?php foreach ($_SESSION['profile_errors'] as $e) echo '<div>' . htmlspecialchars($e) . '</div>'; unset($_SESSION['profile_errors']); ?></div>
                                <?php endif; ?>

                                <?php if (!empty($_GET['edit'])): ?>
                                        <form class="profile-form" action="employee_update.php" method="post">
                                                <div class="form-row">
                                                        <label>Full Name</label>
                                                        <input type="text" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>" required>
                                                </div>
                                                <div class="form-row">
                                                        <label>Email</label>
                                                        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                                                </div>
                                                <div class="form-row">
                                                        <label>Address</label>
                                                        <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>">
                                                </div>
                                                <div class="form-row">
                                                        <label>Position</label>
                                                        <input type="text" name="position" value="<?php echo htmlspecialchars($position ?? ''); ?>">
                                                </div>
                                                <div class="form-row">
                                                        <label>Department</label>
                                                        <input type="text" name="department" value="<?php echo htmlspecialchars($department); ?>">
                                                </div>
                                                <div class="form-row">
                                                        <label>Hire Date</label>
                                                        <input type="date" name="hire_date" value="<?php echo htmlspecialchars($hire_date); ?>">
                                                </div>
                                                <div class="form-actions">
                                                        <button class="btn btn-primary" type="submit">Save</button>
                                                        <a class="btn btn-ghost" href="Employee-profile.php">Cancel</a>
                                                </div>
                                        </form>
                                <?php else: ?>
                                        <h3><?php echo htmlspecialchars($fullname); ?></h3>
                                        <p><strong>Name:</strong> <?php echo htmlspecialchars($fullname); ?></p>
                                        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                                        <p><strong>Department:</strong> <?php echo htmlspecialchars($department); ?></p>
                                        <?php if ($hire_date): ?>
                                                <p><strong>Hire Date:</strong> <?php echo htmlspecialchars($hire_date); ?></p>
                                        <?php endif; ?>
                                        <div style="margin-top:10px"><a href="Employee-profile.php?edit=1" class="update_button">Update Profile</a></div>
                                <?php endif; ?>

                        </div>
                </div>
</body>
</div>

</html>
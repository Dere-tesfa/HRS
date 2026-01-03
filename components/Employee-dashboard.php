
<?php
session_start();
if (!isset($_SESSION["name"])) {
    header("Location: login.php");
    exit();
} elseif (isset($_SESSION["role"]) && $_SESSION["role"] === 'admin') {
    header("Location: login.php");
    exit();
}
require_once __DIR__ . '/db_connect.php';
$mysqli = getDB();

// resolve employee id for logged in user
$employee_id = null;
if (!empty($_SESSION['user_id'])) {
        $uid = (int) $_SESSION['user_id'];
        $stmt = $mysqli->prepare('SELECT id FROM employees WHERE user_id = ? LIMIT 1');
        if ($stmt) {
                $stmt->bind_param('i', $uid);
                $stmt->execute();
                $stmt->bind_result($employee_id);
                $stmt->fetch();
                $stmt->close();
        }
}

// count pending leaves for this employee
$pendingLeaves = 0;
if ($employee_id) {
        $stmt = $mysqli->prepare('SELECT COUNT(*) FROM leaves WHERE employee_id = ? AND status = "pending"');
        if ($stmt) {
                $stmt->bind_param('i', $employee_id);
                $stmt->execute();
                $stmt->bind_result($pendingLeaves);
                $stmt->fetch();
                $stmt->close();
        }
}
?>


<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>employee page</title>
        <link rel="stylesheet" href="/HRS/css/style.css?v=2">
                <link rel="stylesheet" href="/HRS/font/css/all.css">
                <link rel="stylesheet" href="/HRS/font/css/all.min.css">
                <script src="/HRS/font/js/all.js"></script>
                <script src="/HRS/font/js/all.min.js"></script>
</head>
<body>
  <header>
  <div class="header_content">
                <div class="header-logo"><a href="../Html/index.php"><img src="../images/logo.png" alt="logo"></a>
                </div>
                <h2>HR-System</h2>
            </div>  
          </header>

 <aside class="employee_dashboard">
            <ul class="employee_main_page">
                <li class="active"> <i class="fa-solid fa-city dashboard_icons
                        "></i><a class="dashboard_links
                        " href="#">Dashboard</a></li>
               </li>
                <li> <i class="fa-solid fa-user dashboard_icons
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
        <main class="main-content">
                <div class="container">
                        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></h1>
                        <p>Quick links and summary for your account.</p>

                        <div class="card-grid">
                                <a class="card-link" href="Employee-profile.php">
                                        <div class="card">
                                                <div class="card-icon"><i class="fa-solid fa-user"></i></div>
                                                <div class="card-body">
                                                        <h3>Profile</h3>
                                                        <p>View or update your personal information.</p>
                                                </div>
                                        </div>
                                </a>

                                <a class="card-link" href="leave/Add_leave.php">
                                        <div class="card">
                                                <div class="card-icon card-icon--accent"><i class="fa-solid fa-calendar-days"></i></div>
                                                <div class="card-body">
                                                        <h3>Request Leave</h3>
                                                        <p><?php echo (int)$pendingLeaves; ?> pending request(s)</p>
                                                </div>
                                        </div>
                                </a>

                                <a class="card-link" href="../components/Recruitment/add_job.php">
                                        <div class="card">
                                                <div class="card-icon"><i class="fa-solid fa-briefcase"></i></div>
                                                <div class="card-body">
                                                        <h3>Jobs</h3>
                                                        <p>View open positions and apply.</p>
                                                </div>
                                        </div>
                                </a>
                        </div>

                        <div class="actions-panel">
                                <h2>Things you can do</h2>
                                <ul class="actions-list">
                                        <li><a class="action-link" href="Employee-profile.php">View / Edit Profile</a></li>
                                        <li><a class="action-link" href="leave/Add_leave.php">Request Leave</a></li>
                                        <li><a class="action-link" href="leave/">My Leaves</a></li>
                                        <li><a class="action-link" href="../components/Recruitment/viewAdd_job.php">View Jobs</a></li>
                                </ul>
                        </div>
                </div>
        </main>
        </body>
        </html>
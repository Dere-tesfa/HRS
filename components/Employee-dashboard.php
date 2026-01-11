
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
          <link rel="stylesheet" href="../css/style.css?v=2">
                    <link rel="stylesheet" href="../font/css/all.css">
                    <link rel="stylesheet" href="../font/css/all.min.css">
                    <script src="../font/js/all.min.js" defer></script>
</head>
<body>
        <header>
                <?php include_once __DIR__ . '/../include_Components/header.php'; ?>
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
                <li> <i class="fa-brands fa-paypal dashboard_icons
                        "></i><a class="dashboard_links
                        " href="#">Payroll</a></li>
                <li> <i class="fa-solid fa-ban dashboard_icons
                        "></i><a class="dashboard_links
                        " href="../components/leave/Add_leave.php">Leave</a></li>
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
                                <a class="card-link" href="leave/leave_status.php">
                                        <div class="card">
                                                <div class="card-icon card-icon--accent"><i class="fa-solid fa-calendar-days"></i></div>
                                                <div class="card-body">
                                                        <h3>My Leave requests</h3>
                                                        <p>You have <?php echo $pendingLeaves; ?> pending leave request<?php echo $pendingLeaves !== 1 ? 's' : ''; ?>.</p>
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

        
                </div>
        </main>
        </body>
        </html>

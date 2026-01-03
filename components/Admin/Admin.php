<?php
session_start();
if (!isset($_SESSION["name"])) {
    header("Location: login.php");
    exit();
} elseif (isset($_SESSION["role"]) && $_SESSION["role"] === 'employee') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashbord</title>
           <link rel="stylesheet" href="/HRS/css/style.css?v=2">
    <link rel="stylesheet" href="../../font/css/all.css">
    <link rel="stylesheet" href="../../font/css/all.min.css">
    <script src="../../font/js/all.js"></script>
    <script src="../../font/js/all.min.js"></script>
</head>

<body>

    <div class="admin__pages">

        <header>
          <?php include "../../include_Components/header.php"?>
        </header>
        
        <aside>
       <?php include "../../include_Components/asideBar.php"?>
        </aside>
        <main>
           <section class="admin-entities">
    <div class="entities-container">
         <h1>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></h1>
        <h2 class="entities-title">Manage Entities</h2>

        <div class="entities-grid">

            <!-- Employees -->
            <div class="entity-card">
                <div class="entity-head">
                    <i class="fa-solid fa-users entity-icon emp-icon"></i>
                    <strong>Employees</strong>
                </div>
                <div class="entity-stat">1,248</div>
                <p class="entity-label">Total Employees</p>
                <div class="entity-actions">
                    <a class="btn" href="../Employee/Employee-table.php">View</a>
                
                </div>
            </div>

            <!-- Attendance -->
            <div class="entity-card">
                <div class="entity-head">
                    <i class="fa-solid fa-clock entity-icon att-icon"></i>
                    <strong>Attendance</strong>
                </div>
                <div class="entity-stat">892</div>
                <p class="entity-label">Present Today</p>
                <div class="entity-actions">
                    <a class="btn" href="../manage_attendance.php">View</a>
                 
                </div>
            </div>

            <!-- Leave -->
            <div class="entity-card">
                <div class="entity-head">
                    <i class="fa-solid fa-plane-departure entity-icon leave-icon"></i>
                    <strong>Leave</strong>
                </div>
                <div class="entity-stat">34</div>
                <p class="entity-label">Pending Requests</p>
                <div class="entity-actions">
                    <a class="btn" href="../leave/manage_leave.php">View</a>
                  
                </div>
            </div>

            <!-- Jobs / Recruitment -->
            <div class="entity-card">
                <div class="entity-head">
                    <i class="fa-solid fa-briefcase entity-icon jobs-icon"></i>
                    <strong>Recruitment</strong>
                </div>
                <div class="entity-stat">12</div>
                <p class="entity-label">Open Positions</p>
                <div class="entity-actions">
                    <a class="btn" href="../Recruitment/manege_jobs.php">View</a>
                    
                </div>
            </div>

            <!-- Tasks -->
            <div class="entity-card">
                <div class="entity-head">
                    <i class="fa-solid fa-list-check entity-icon tasks-icon"></i>
                    <strong>Tasks</strong>
                </div>
                <div class="entity-stat">76</div>
                <p class="entity-label">Open Tasks</p>
                <div class="entity-actions">
                    <a class="btn" href="../tasks/manage_tasks.php">View</a>
                </div>
            </div>

            <!-- Payroll -->
            <div class="entity-card">
                <div class="entity-head">
                    <i class="fa-solid fa-money-check-dollar entity-icon payroll-icon"></i>
                    <strong>Payroll</strong>
                </div>
                <div class="entity-stat">1,210</div>
                <p class="entity-label">Payslips Generated</p>
                <div class="entity-actions">
                    <a class="btn" href="../payroll/manage_payroll.php">View</a>
                    <a class="btn" href="../payroll/add_payslip.php">Add</a>
                    <button class="btn">Export CSV</button>
                </div>
            </div>

        </div>
    </div>
</section>


        </main>
        <footer>
           <?php include "../../include_Components/footer.php"?>
        </footer>
    </div>
    
           
</body>

</html>
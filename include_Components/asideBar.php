<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HRMS Sidebar</title>

<style>
    body{
        font-family: Arial, sans-serif;
    }
    ul{
        padding: 0;
        margin: 0;
    }
    li{
        list-style: none;
        margin: 5px 0;
    }
    .dashboard_links{
        text-decoration: none;
        color: #040404ff;
        display: block;
        padding: 8px;
    }
     .dashboard_links .submenu li:hover{
        background: #000;
     }
    .submenu{
        display: none;
        padding-left: 30px;
        font-size: 14px;
        font-family: Arial, Helvetica, sans-serif;
    }
    .has-submenu.open .submenu{
        display: block;
    }
    .submenu li a{
        font-size: 14px;
    }
   
   
</style>
</head>

<body>

<ul class="admin_main_page">

    <!-- Dashboard -->
    <li>
        <a class="dashboard_links" href="../Admin/Admin.php">🏠 Dashboard</a>
    </li>

    <!-- Employees -->
    <li class="has-submenu">
        <a class="dashboard_links" href="#">👥 Employees</a>
        <ul class="submenu">
            <li class="list_menu" ><a href="../signup.php">➕ Add Employee</a></li>
            <li><a href="../Employee/Employee-table.php">📋 Manage Employees</a></li>
        </ul>
    </li>

    <!-- Attendance -->
    <li class="has-submenu">
        <a class="dashboard_links" href="#">🕒 Attendance</a>
        <ul class="submenu">
            <li><a href="add_attendance.php">➕ Mark Attendance</a></li>
            <li><a href="manage_attendance.php">📋 View Attendance</a></li>
        </ul>
    </li>

    <!-- Recruitment -->
    <li class="has-submenu">
        <a class="dashboard_links" href="#">📄 Recruitment</a>
        <ul class="submenu">
            <li><a href="../Recruitment/add_job.php">➕ Add Job</a></li>
            <li><a href="../Recruitment/manege_jobs.php">📋 Manage Jobs</a></li>
            <li><a href="../Recruitment/applications.php">📨 Applications</a></li>
        </ul>
    </li>

    <!-- Payroll -->
    <li class="has-submenu">
        <a class="dashboard_links" href="#">💰 Payroll</a>
        <ul class="submenu">
            <li><a href="add_salary.php">➕ Add Salary</a></li>
            <li><a href="manage_payroll.php">📋 Manage Payroll</a></li>
        </ul>
    </li>

    <!-- Leave -->
    <li class="has-submenu">
        <a class="dashboard_links" href="#">🛑 Leave</a>
        <ul class="submenu">
            <li><a href="../leave/Add_leave.php">➕ Leave Request</a></li>
            <li><a href="manage_leave.php">📋 Manage Leave</a></li>
        </ul>
    </li>

    <!-- Settings -->
    <li class="has-submenu">
        <a class="dashboard_links" href="#">⚙️ Settings</a>
       
    </li>

</ul>

<script>
document.querySelectorAll('.has-submenu > a').forEach(link => {
    link.addEventListener('click', function(e){
        e.preventDefault();
        this.parentElement.classList.toggle('open');
    });
});
</script>

</body>
</html>

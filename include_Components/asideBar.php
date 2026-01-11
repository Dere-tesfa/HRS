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
    .submenu:hover li:hover {
        background-color: #6fbae9ff;
        color: black;
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
    .dashboard_links i, 
.submenu li a i{
    color: aqua;
    margin-right: 8px;
}
    
   
</style>
</head>

<body>

<ul class="admin_main_page">

    <!-- Dashboard -->
    <li class="active">
        <a class="dashboard_links " href="../Admin/Admin.php"><i class="fa-solid fa-calendar"></i> Dashboard</a>
    </li>

    <!-- Employees -->
    <li class="has-submenu">
        <a class="dashboard_links" href="#"><i class="fa-solid fa-users"></i> Employees</a>
        <ul class="submenu">
            <li class="list_menu" ><a href="../signup.php"><i class="fa-solid fa-plus"></i> Add Employee</a></li>
            <li><a href="../Employee/Employee-table.php"><i class="fa-solid fa-list"></i> Manage Employees</a></li>
        </ul>
    </li>


    <!-- Recruitment -->
    <li class="has-submenu">
        <a class="dashboard_links" href="#"><i class="fa-solid fa-briefcase"></i> Recruitment</a>
        <ul class="submenu">
            <li><a href="../Recruitment/add_job.php"><i class="fa-solid fa-plus"></i> Add Job</a></li>
            <li><a href="../Recruitment/viewAdd_job.php"><i class="fa-solid fa-list"></i> Manage Jobs</a></li>
            <li><a href="../Recruitment/manege_jobs.php"><i class="fa-solid fa-envelope"></i> Applications</a></li>

        </ul>
    </li>

    <!-- Payroll -->
    <li class="has-submenu">
        <a class="dashboard_links" href="#"><i class="fa-solid fa-money-check-dollar"></i> Payroll</a>
        <ul class="submenu">
            <li><a href="add_salary.php"><i class="fa-solid fa-plus"></i> Add Salary</a></li>
            <li><a href="manage_payroll.php"><i class="fa-solid fa-list"></i> Manage Payroll</a></li>
        </ul>
    </li>

    <!-- Leave -->
    <li class="has-submenu">
        <a class="dashboard_links" href="#"><i class="fa-solid fa-ban"></i> Leave</a>
        <ul class="submenu">
           <li><a href="../Admin/admin_leave_requests.php"><i class="fa-solid fa-check"></i> manage Leaves requests</a></li>
        </ul>
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





<?php
session_start();
// if(!isset($_SESSION["name"]) || $_SESSION["role"] != "employee") {
//     header("location:login.php");
//     exit();
// }
?>


<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>employee page</title>
  <link rel="stylesheet" href="../css/style.css">
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
</html>
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

<body style="background-color: aliceblue;">

    <div class="admin__pages">

        <header>
          <?php include "../../include_Components/header.php"?>
        </header>
        
        <aside>
       <?php include "../../include_Components/asideBar.php"?>
        </aside>
        <main>
            <div class="chart_box ">
                <canvas id="barChart"></canvas>
            </div>
            <div class="chart_box">
                <canvas id="pieChart"></canvas>
            </div>


        </main>
        <footer>
           <?php include "../../include_Components/footer.php"?>
        </footer>
    </div>
    <script>
        // Colors (matching your image)
        const c1 = "#76e9f0";
        const c2 = "#27b8d5";
        const c3 = "#1577b6";

        // BAR CHART
        new Chart(document.getElementById("barChart"), {
            type: 'bar',
            data: {
                labels: ["Item 1", "Item 2", "Item 3", "Item 4"],
                datasets: [
                    { label: "Series 1", data: [6, 89, 17, 20], backgroundColor: c1 },
                    { label: "Series 2", data: [7, 10, 82, 98], backgroundColor: c2 },
                    { label: "Series 3", data: [56, 8, 7, 12], backgroundColor: c3 }
                ]
            },
            options: {
                plugins: { legend: { position: "top" } },
                scales: {
                    x: { stacked: true },
                    y: { stacked: true }
                }
            }
        });


        //PIE CHART

        new Chart(document.getElementById("pieChart"), {
            type: "pie",
            data: {
                labels: ["Item 1", "Item 2", "Item 3"],
                datasets: [{
                    data: [50, 20, 10],
                    backgroundColor: [c1, c2, c3]
                }]
            },
            options: {
                plugins: { legend: { position: "right" } }
            }
        });
    </script>
</body>

</html>
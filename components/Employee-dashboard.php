
<?php
session_start();
if (!isset($_SESSION["name"])) {
    header("Location: login.php");
    exit();
} elseif (isset($_SESSION["role"]) && $_SESSION["role"] === 'admin') {
    header("Location: login.php");
    exit();
}
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
    <style>
        /* KPI / Employee-dashboard specific styles (moved from inline in Employee-dashboard.php) */
.kpi-card {
  background-color: #ffffff;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  padding: 20px;
  text-align: center;
  width: 200px;
}
.kpi-card h3 {
  margin-bottom: 10px;
  font-size: 18px;
  color: #333333;
}
.kpi-card p {
  font-size: 24px;
  font-weight: bold;
  color: #0fa9d8;
}

.kpi-container {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 20px;
    }
.kpi-icon {
        font-size: 36px;
        color: #0fa9d8;
        margin-bottom: 10px;
    }
.kpi-label {
        font-size: 16px;
        color: #555555;
    }
.kpi-value {
        font-size: 28px;
        font-weight: bold;
        color: #0fa9d8;
    }
.kpi-table {
        width: 100%;
        border-collapse: collapse;
    }
.kpi-table th, .kpi-table td {
        border: 1px solid #ddd;
        padding: 8px;
    }
.kpi-table th {
        background-color: #f2f2f2;
        text-align: left;
    }
.modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
    }
.modal-content {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        width: 80%;
        max-height: 80%;
        overflow-y: auto;
        position: relative;
    }
.modal-close {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
    }

    </style>
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
                        " href="../components/leave/Add_leave.php">Leave</a></li>
            </ul>
        </aside>
 
<main class="content">
        <section class="kpi-section">
                <h1>Overview</h1>
                <div class="kpi-container">
                        <div class="kpi-grid">
                        <div class="kpi-card" data-metric="headcount" onclick="fetchDetails('headcount')">
                                <div class="kpi-icon"><i class="fa-solid fa-users"></i></div>
                                <div class="kpi-body">
                                        <div class="kpi-label">Headcount</div>
                                        <div class="kpi-value" id="headcount-count">—</div>
                                </div>
                        </div>

                        <div class="kpi-card" data-metric="active_today" onclick="fetchDetails('active_today')">
                                <div class="kpi-icon"><i class="fa-solid fa-clock"></i></div>
                                <div class="kpi-body">
                                        <div class="kpi-label">Active Today</div>
                                        <div class="kpi-value" id="active-count">—</div>
                                </div>
                        </div>

                        <div class="kpi-card" data-metric="pending_leave" onclick="fetchDetails('pending_leave')">
                                <div class="kpi-icon"><i class="fa-solid fa-plane-departure"></i></div>
                                <div class="kpi-body">
                                        <div class="kpi-label">Pending Leave</div>
                                        <div class="kpi-value" id="pending-count">—</div>
                                </div>
                        </div>

                        <div class="kpi-card" data-metric="open_tasks" onclick="fetchDetails('open_tasks')">
                                <div class="kpi-icon"><i class="fa-solid fa-list-check"></i></div>
                                <div class="kpi-body">
                                        <div class="kpi-label">Open Tasks</div>
                                        <div class="kpi-value" id="tasks-count">—</div>
                                </div>
                        </div>
                </div>
        </section>

        <div id="details-modal" class="modal" style="display:none;">
                <div class="modal-content">
                        <button id="modal-close" class="modal-close">×</button>
                        <h3 id="modal-title">Details</h3>
                        <div id="modal-body">Loading…</div>
                </div>
                        </div>
                </div>
</main>

<!-- KPI styles moved to ../css/style.css -->

<script>
async function loadKpis(){
        try{
                const res = await fetch('kpi_api.php');
                const data = await res.json();
                document.getElementById('headcount-count').textContent = data.headcount ?? '0';
                document.getElementById('active-count').textContent = data.active_today ?? '0';
                document.getElementById('pending-count').textContent = data.pending_leave ?? '0';
                document.getElementById('tasks-count').textContent = data.open_tasks ?? '0';
        }catch(e){
                console.error('KPI load failed', e);
        }
}

async function fetchDetails(metric){
        const modal = document.getElementById('details-modal');
        const body = document.getElementById('modal-body');
        const title = document.getElementById('modal-title');
        title.textContent = metric.replace('_',' ').toUpperCase();
        body.innerHTML = 'Loading…';
        modal.style.display = 'flex';
        try{
                const res = await fetch('kpi_api.php?action=details&metric='+encodeURIComponent(metric));
                const j = await res.json();
                const rows = j.rows || [];
                if(rows.length === 0){
                        body.innerHTML = '<div>No records found.</div>';
                        return;
                }
                // build simple table
                const keys = Object.keys(rows[0]);
                let html = '<table class="kpi-table"><thead><tr>' + keys.map(k=>'<th>'+k+'</th>').join('') + '</tr></thead><tbody>';
                for(const r of rows){
                        html += '<tr>' + keys.map(k=>'<td>'+ (r[k]===null? '': escapeHtml(''+r[k])) +'</td>').join('') + '</tr>';
                }
                html += '</tbody></table>';
                body.innerHTML = html;
        }catch(e){
                body.innerHTML = '<div>Error fetching details</div>';
                console.error(e);
        }
}

function escapeHtml(s){return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;')}

document.addEventListener('DOMContentLoaded', function(){
        document.getElementById('modal-close').addEventListener('click',()=>{document.getElementById('details-modal').style.display='none'});
        loadKpis();
        setInterval(loadKpis, 60*1000);
});
</script>

</body>
</html>
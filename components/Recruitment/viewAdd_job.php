<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Job</title>

   <style>
* {
    box-sizing: border-box;
    font-family: "Segoe UI", Arial, sans-serif;
}

body {
    background: #f4f6f8;
    padding: 40px 20px;
}

.job-container {
    max-width: 1100px;
    margin: 30px auto;
    background: #ffffff;
    padding: 35px;
    border-radius: 14px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
}

/* Header */
.job-header {
    text-align: center;
    margin-bottom: 35px;
}

.job-header h1 {
    font-size: 34px;
    color: #16bfb5;
    margin-bottom: 8px;
}

.job-header p {
    font-size: 18px;
    color: #666;
}

/* Section title */
.section-title {
    font-size: 22px;
    margin-bottom: 20px;
    color: #333;
    border-left: 5px solid #16bfb5;
    padding-left: 12px;
}

/* Job content */
.job-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 30px;
    align-items: start;
}

.job-details {
    list-style: none;
    padding: 0;
}

.job-details li {
    padding: 12px 0;
    border-bottom: 1px solid #eee;
    font-size: 16px;
    color: #444;
}

.job-details span {
    font-weight: 600;
    color: #222;
}

/* Image */
.job-image img {
    width: 100%;
    border-radius: 12px;
    object-fit: cover;
}

/* Apply section */
.apply-section {
    text-align: center;
    margin-top: 40px;
    padding-top: 25px;
    border-top: 1px solid #eee;
}

.apply-section h2 {
    font-size: 26px;
    color: #16bfb5;
    margin-bottom: 20px;
}

.apply-btn {
    display: inline-block;
    padding: 14px 40px;
    background: #16bfb5;
    color: #fff;
    text-decoration: none;
    border-radius: 30px;
    font-size: 18px;
    font-weight: 600;
    transition: background 0.3s ease, transform 0.2s ease;
}

.apply-btn:hover {
    background: #129a92;
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 768px) {
    .job-content {
        grid-template-columns: 1fr;
    }
}
</style>

</head>
<body>
<?php
$host="localhost";
$user= "root";
$password="";
$dbname="hr_systems";
$data=mysqli_connect($host,$user,$password,$dbname);
$sql="SELECT *FROM jobs";
$result=mysqli_query($data,$sql);



?>
 <?php
                while($info=$result->fetch_assoc()){
                
                ?>
    <div class="job-container">

        <div class="job-header">
            <h1>WE ARE HIRING!</h1>
            <p>Join our team as a <strong>Creative Writer</strong></p>
        </div>

       <h2 class="section-title">Job Details</h2>
<div class="job-content">

           <ul class="job-details">
    <li><span>Job Title:</span> <?= htmlspecialchars($info['job_title']) ?></li>
    <li><span>Department:</span> <?= htmlspecialchars($info['department']) ?></li>
    <li><span>Job Type:</span> <?= htmlspecialchars($info['job_type']) ?></li>
    <li><span>Salary:</span> <?= htmlspecialchars($info['salary']) ?></li>
    <li><span>Location:</span> <?= htmlspecialchars($info['location']) ?></li>
    <li><span>Description:</span> <?= htmlspecialchars($info['description']) ?></li>
    <li><span>Deadline:</span> <?= htmlspecialchars($info['deadline']) ?></li>
</ul>

            
        <div class="job-image">
    <img src="../../images/Job Hiring Flyer Template.jpg" alt="Job Hiring">
</div>


   <div class="apply-section">
    <h2>Apply Now</h2>
    <a href="Job_Application_Form.php" class="apply-btn">
        Apply for this Position
    </a>
</div>

    </div>
     <?php
                }
                    ?>

</body>
</html>

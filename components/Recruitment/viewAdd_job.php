<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Job</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f4f6f8;
            padding: 40px 20px;
        }

        .job-container {
            max-width: 100%;
            margin: 2rem 7rem;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .job-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .job-header h1 {
            color: #16dbd1ff;
            font-size: 32px;
            margin-bottom: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .job-header h1::before {
            content: "📣"; /* megaphone emoji */
            font-size: 36px;
        }

        .job-header p {
            font-size: 18px;
            color: #555;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 22px;
            border-bottom: 2px solid #16dbd1ff;
            display: inline-block;
            padding-bottom: 5px;
        }

        .hiring {
            display: flex;
            gap: 30px;
            align-items: flex-start;
            margin-bottom: 30px;
        }

        .hiring ul {
            list-style-type: disc;
            padding-left: 20px;
            flex: 1;
        }

        .hiring ul li {
            margin-bottom: 12px;
            color: #444;
            font-size: 16px;
        }

        .hiring img {
            max-width: 400px;
            width: 100%;
            border-radius: 12px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .apply-section {
            text-align: center;
            margin-top: 30px;
        }

        .apply-section h1 {
            margin-bottom: 20px;
            color: #16dbd1ff;
        }

        .apply-btn {
            padding: 14px 35px;
            background: #16dbd1ff;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            transition: 0.3s;
        }

        .apply-btn:hover {
            background: #16dbd1ff;
        }

        /* Responsive for mobile */
        @media (max-width: 768px) {
            .hiring {
                flex-direction: column;
                align-items: center;
            }

            .hiring img {
                max-width: 100%;
            }
        }
        ul li{
            margin-left: 2rem;
            font-family: 'Times New Roman', Times, serif;
          font-weight: bold;
        }
        span{
            font-weight: bold;
            font-size: 20px;

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

        <h2>Qualifications:</h2>
        <div class="hiring">
            
            <ul>
               
                <li>
                   <span>Job_title:</span><?php echo "{$info['job_title']}"?>
                </li>
                <li> <span>Department:</span> <?php echo "{$info['department']}"?></li>
                <li> <span>job_Type:</span> <?php echo "{$info['job_type']}"?></li>
                <li><span>Salary:</span> <?php echo "{$info['salary']}"?></li>
                <li><span>location: </span><?php echo "{$info['location']}"?></li>
                <li><span>Description:</span> <?php echo "{$info['description']}"?></li>
                <li><span>Deadline:</span> <?php echo "{$info['deadline']}"?></li>
                
            </ul>
            
            <img src="../../images/Job Hiring Flyer Template.jpg" alt="Job Hiring Flyer">
        </div>

        <div class="apply-section">
            <h1>Apply Now</h1>
            <a href="Job_Application_Form.php" class="apply-btn">Apply for this Job</a>
        </div>

    </div>
     <?php
                }   
                    ?>

</body>
</html>

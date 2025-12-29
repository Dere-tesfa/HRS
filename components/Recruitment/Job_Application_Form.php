<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Job Application Form</title>
<style>
    /* General Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Arial', sans-serif;
    }

    body {
        background: #f4f6f8;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .job_Application {
        background: #fff;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 600px;
    }

    .Application_content h1 {
        color: #333;
        font-size: 28px;
        margin-bottom: 10px;
        text-align: center;
    }

    .Application_content h3 {
        color: #666;
        font-size: 16px;
        font-weight: 400;
        margin-bottom: 25px;
        text-align: center;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .form-group {
        display: flex;
        flex-direction: column; /* label on top */
    }

    .form-group label {
        margin-bottom: 5px;
        font-weight: 600;
        color: #555;
    }

    .form-group input,
    .form-group textarea {
        padding: 12px 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        width: 100%; /* full width input */
        transition: all 0.3s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #16dbd1ff;
        outline: none;
        box-shadow: 0 0 5px rgba(0,123,255,0.3);
    }

    textarea {
        resize: vertical;
        min-height: 120px;
    }
    #uploadresume{
        padding: 100px;
        cursor: pointer;
    }

    button {
        padding: 12px;
        background-color: #16dbd1ff;
        border: none;
        color: #fff;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    button:hover {
        background-color: #16dbd1ff;
    }

    hr {
        margin: 20px 0;
        border: none;
        border-top: 1px solid #ddd;
    }

    /* Responsive */
    @media (max-width: 600px) {
        .job_Application {
            padding: 20px;
        }
    }
</style>
</head>
<body>


<?php
// error_reporting(0);
$host="localhost";
$user= "root";
$password="";
$dbname= "hr_systems";
$data=mysqli_connect($host,$user,$password,$dbname);
if($_SERVER["REQUEST_METHOD"]=="POST"){

$job_fname=$_POST["fname"];
$job_lname=$_POST["lname"];
$job_email=$_POST["email"];
$job_phone=$_POST["phone"];
$job_appliedposition=$_POST["appliedPosition"];
$job_date=$_POST["date"];
$job_coverletter=$_POST["coverletter"];
$file=$_FILES["uploadresume"]['name'];
$dst="../components/upload/".$file;
$dst_db=$dst;
move_uploaded_file($_FILES["uploadresume"]['tmp_name'],$dst);


$sql="INSERT INTO job_applications(fname,lname,email,phone,appliedPosition,date,coverletter,uploadresume)VALUES
('$job_fname','$job_lname','$job_email','$job_phone','$job_appliedposition','$job_date','$job_coverletter','$dst_db') ";

$result=mysqli_query($data,$sql);
if ( $result) {
        echo "<script>alert('Submit Successfully!');</script>";
       
    } else {
        echo "Error";
    }
}

?>
<div class="job_Application">
    <div class="Application_content">
       <h1>Job Application</h1>
       <h3>Please fill out the form below to submit your application</h3>
    </div>
    <hr>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="fname">First Name:</label>
            <input type="text" id="fname" placeholder="Enter First Name" name="fname">
        </div>
        <div class="form-group">
            <label for="lname">Last Name:</label>
            <input type="text" id="lname" placeholder="Enter Last Name" name="lname" requered>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" placeholder="Enter Email" name="email" requered>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" placeholder="Enter Phone Number" name="phone" requered>
        </div>
        <div class="form-group">
            <label for="appliedPosition">Applied Position:</label>
            <input type="text" id="appliedPosition" placeholder="Enter Position" name="appliedPosition" requered>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" requered>
        </div>
        <div class="form-group">
            <label for="coverLetter">Cover Letter:</label>
            <textarea id="coverLetter" placeholder="Write your cover letter" name="coverletter" requered></textarea>
        </div>
        <div class="form-group">
            <label for="uploadresume">Upload Resume:</label>
            <input type="file" id="uploadresume" name="uploadresume" requered>
        </div>
        <button type="submit">Submit</button>
    </form>
</div>
</body>
</html>

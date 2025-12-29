
<?php
$host="localhost";
$user= "root";
$password="";
$dbname="hr_systems";
$data=mysqli_connect($host,$user,$password,$dbname);

if($_SERVER["REQUEST_METHOD"]== "POST"){

$job_title=$_POST["job_title"];
 $department = $_POST['department'];
 $job_type = $_POST['job_type'];
 $salary = $_POST['salary'];
 $location = $_POST['location'];
 $description = $_POST['description'];
$deadline = $_POST['deadline'];

  $sql = "INSERT INTO jobs 
            (job_title, department, job_type, salary, location, description, deadline)
            VALUES 
            ('$job_title', '$department', '$job_type', '$salary', '$location', '$description', '$deadline')";
            $result=mysqli_query($data, $sql);

 if ( $result) {
        echo "<script>alert('Job Posted Successfully');</script>";
        echo "<script>window.location='add_job.php';</script>";
    } else {
        echo "Error";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add_job</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

body {
    background: #f4f6f8;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Main Container */
.add_container {
    width: 100%;
    max-width: 700px;
    background: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

/* Header Area */
.add_content {
    text-align: center;
    margin-bottom: 20px;
}

.add_content h2 {
    color: #333;
    font-size: 24px;
}

/* Form Layout */
form {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

/* Full width elements */
form textarea,
form .full-width {
    grid-column: span 2;
}

/* Label */
label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    color: #555;
}

/* Inputs */
input,
textarea {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
    outline: none;
    font-size: 14px;
}

input:focus,
textarea:focus {
    border-color: #007bff;
}

/* Textarea */
textarea {
    resize: none;
    height: 120px;
}

/* File Input */
input[type="file"] {
    padding: 6px;
}

/* Submit Button */
button {
    grid-column: span 2;
    padding: 12px;
    background: #007bff;
    border: none;
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #0056b3;
}

/* Responsive */
@media (max-width: 600px) {
    form {
        grid-template-columns: 1fr;
    }

    form textarea,
    form .full-width,
    button {
        grid-column: span 1;
    }
}

    </style>
</head>
<body>
   <div class="add_container">
    <div class="add_content">
        <h2>Add New Job</h2>
        <p>Fill in the job details below</p>
    </div>

    <hr>

    <form action="add_job.php" method="POST">
        
        <div>
            <label>Job Title</label>
            <input type="text" name="job_title" placeholder="e.g. Web Developer" required>
        </div>

        <div>
            <label>Department</label>
            <input type="text" name="department" placeholder="e.g. IT Department" required>
        </div>

        <div>
            <label>Job Type</label>
            <select name="job_type" required>
                <option value="">Select Job Type</option>
                <option value="Full Time">Full Time</option>
                <option value="Part Time">Part Time</option>
                <option value="Contract">Contract</option>
                <option value="Internship">Internship</option>
            </select>
        </div>

        <div>
            <label>Salary</label>
            <input type="text" name="salary" placeholder="e.g. 10,000 ETB">
        </div>

        <div>
            <label>Location</label>
            <input type="text" name="location" placeholder="e.g. Addis Ababa">
        </div>

        <div>
            <label>Deadline</label>
            <input type="date" name="deadline" required>
        </div>

        <div class="full-width">
            <label>Job Description</label>
            <textarea name="description" placeholder="Enter job description..." required></textarea>
        </div>

        <button type="submit">Post Job</button>

    </form>
</div>

</body>
</html>
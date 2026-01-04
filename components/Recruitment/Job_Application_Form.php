<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Job Application Form</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
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
    width: 100%;
    max-width: 600px;
}

h1, h3 {
    text-align: center;
}

form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 5px;
    font-weight: bold;
}

input, textarea {
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

button {
    padding: 12px;
    background: #16dbd1ff;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}
</style>
</head>

<body>
<?php
$data = mysqli_connect("localhost", "root", "", "hr_systems");
if (!$data) {
    die("Database connection failed");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $appliedPosition = $_POST["appliedPosition"];
    $applied_date = date("Y-m-d");
    $coverletter = $_POST["coverletter"];

    /* File upload */
    $upload_dir = __DIR__ . "/../upload/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_name = time() . "_" . basename($_FILES["uploadresume"]["name"]);
    $target_path = $upload_dir . $file_name;
    $db_path = "components/upload/" . $file_name;

    move_uploaded_file($_FILES["uploadresume"]["tmp_name"], $target_path);

    /* Insert */
    $sql = "INSERT INTO job_applications_raw
    (fname, lname, email, phone, appliedPosition, applied_date, coverletter, uploadresume)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $data->prepare($sql);
    $stmt->bind_param(
        "ssssssss",
        $fname,
        $lname,
        $email,
        $phone,
        $appliedPosition,
        $applied_date,
        $coverletter,
        $db_path
    );

    $stmt->execute();

    echo "<script>alert('Application submitted successfully');</script>";
}
?>


<div class="job_Application">
    <h1>Job Application</h1>
    <h3>Please fill out the form</h3>

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="fname" required>
        </div>

        <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="lname" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input type="tel" name="phone" required>
        </div>

     <div class="form-group">
    <label>Applied Position</label>
    <input type="text" name="appliedPosition" required>
</div>


        <div class="form-group">
            <label>Cover Letter</label>
            <textarea name="coverletter" required></textarea>
        </div>

        <div class="form-group">
            <label>Upload Resume</label>
            <input type="file" name="uploadresume" required>
        </div>

        <button type="submit">Submit</button>
    </form>
</div>

</body>
</html>

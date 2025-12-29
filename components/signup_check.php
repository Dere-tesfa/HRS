
<?php
session_start();
// error_reporting(0);
$host="localhost";
$user="root";
$password="";
$dbname="hr_systems";
$data=new mysqli($host,$user,$password,$dbname);
if($data===false){
  die("connection error");
}
if(isset($_POST["signup"])){
    $data_name=$_POST["fullname"];
    $data_email=$_POST["email"];
    $data_phone=$_POST["phone"];
    $data_address=$_POST["address"];
    $data_dep=$_POST["department"];
    $data_gender=$_POST["gender"];
    $data_password=$_POST["password"];
    $role = 'employee';

    $sql="INSERT INTO hrsystem(fullname,email,phone,address,department,gender,role,password)
    VALUES('$data_name','$data_email','$data_phone','$data_address','$data_dep','$data_gender','$role','$data_password')";
    $result=$data->query($sql);
    if($result){
        $_SESSION["message"]="The application is sent successfully!";
        header("location:login.php");
    
    } else {
        echo 'Apply Failed';
    }


}

?>
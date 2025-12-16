<?php
session_start();
$host="localhost";
$user="root";
$password= "";
$dbname= "hr_systems";
$data=mysqli_query($host,$user,$password,$dbname);
if($data===false){
    die("connection error");
}
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $name=$_POST["name"];
    $password=$_POST["password"];

     $sql="select*from user where username='".$name."' AND
    password='".$password."' ";
    $result=mysqli_query($data,$sql);
    $row=mysqli_fetch_array($result);

    if($row["usertype"]=="employee"){
        // $_SESSION["name"]=$name;
        header("location:employee.php");

    }elseif($row["usertype"=="admin"]){
        // $_SESSION["name"]=$name;
        header("location:Admin.php");
    }
    
      else{
        session_start();
       $msg= "username and password is not mach";
       $_SESSION["loginMessage"]=$msg;
       header("location:login.php");
    }
}



?>
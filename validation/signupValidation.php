<?php 
$FullName="";
$fullNameError="";
$email="";
$emailError= "";
$phoneNumber="";
$phoneNumberError= "";
$department="";
$depError="";
$address="";
$addError="";
$gender="";
$genderError= "";
$password="";
$passwordError= "";
$confirmPassword= "";
$confirmError="";
// check methods
if($_SERVER["REQUEST_METHOD"]=="POST"){
  //fullName validation
  $FullName=trim( $_POST["fullName"]);
  if(empty($FullName)){
    $fullNameError="* Name is requered!";
  }
  elseif(strlen($FullName)<3){
    $fullNameError= "* Name must be at least 3 character!";
  }
  //email validation
 $email=trim( $_POST["email"]);
  if(empty($email)){
    $emailError= "* Email is required!";
  }
  elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $emailError="invalid email format!";
  }
  //phoneNumber validetion
  $phoneNumber=trim($_POST["phone"]);
  if(empty($phoneNumber)){
    $phoneNumberError= "* phone is required!";

  }elseif(strlen($phoneNumber)<13){
    $phoneNumberError="* phoneNumber must not be less than 13 digits long! ";
  }
  elseif(strlen($phoneNumber)>13){
    $phoneNumberError="* phoneNumber must not be greater than 13 digits long! ";
  }
  // Address validation
  $address=trim($_POST["address"]);
  if(empty($address)){
    $addError="* Address is requered!";
  }
  //department validation
  $department=trim($_POST["department"]);
  if(empty($department)){
    $depError="* Department is requered!";
  };
  //gender validation
  $gender=trim($_POST["gender"]);
  if(empty($gender)){
    $genderError="* Gender must be selected!";
  }
  //password validation
  $password=trim($_POST["password"]);
if(empty($password)){
  $passwordError= "* password is required!";
}
elseif(strlen($password)< 8){
  $passwordError= "Your Password Must Contain At Least 8 Characters!";
}
elseif(!preg_match("0-9",$password)){
  $passwordError= "Your Password Must Contain At Least 1 Number!";
}
elseif(!preg_match("A-Z",$password)){
  $passwordError="Your Password Must Contain At Least 1 Capital Letter!";
}
//confirm password validation
if($password !== $confirmPassword){
$confirmPassword= trim($_POST["confirmPassword"]);
  $confirmError = "Passwords do not match!";
}
}

?>
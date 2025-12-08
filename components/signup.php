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
$confirm_password= "";
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
  $department=trim($_POST["department"]);
  if(empty($department)){
    $depError="* Department is requered!";
  }
  // $gender=trim($_POST["gender"]);
  // if(empty($gender)){
  //   $genderError="* Gender must be selected!";
  // }
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
}

?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>signup</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../font/css/all.css">
  <link rel="stylesheet" href="../font/css/all.min.css">
  <script src="../font/js/all.js"></script>
  <script src="../font/js/all.min.js"></script>
  <style>
    body {
      background: hsl(0, 0%, 89%);
    }
    .error{
  color: rgb(241, 30, 30);
}
  </style>
</head>

<body>
  <div class="signup__container">
    <div class="signup-container">
      <i class="fa-solid fa-user signup_icon "></i>
      
      <h2 class="signup-title">Sign Up</h2>
     <div class="line"></div>
      <form class="signup-form" action="" method="post" novalidate>
        <div class="group_signup">
          <label for="fullName">Full Name:</label>
          <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" required><br>
         <span class="error"><?php echo $fullNameError?></span>
        </div>
        <div class="group_signup">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" required><br>
          <span class="error"><?php echo $emailError?></span>
        </div>
        <div class="group_signup">
          <label for="phone">Phone:</label>
          <input type="tel" id="phone" name="phone" value="+251" required><br>
          <span class="error"><?php echo $phoneNumberError?></span>
        </div>
        <div class="group_signup">
          <label for="address">Address:</label>
          <input type="text" id="address" name="address" placeholder="Enter your address" required><br>
          <span class="error"><?php echo $addError?></span>
        </div>
        <div class="group_signup">
          <label for="department">Department:</label>
          <input type="text" id="department" name="department" placeholder="Enter your department" required><br>
          <span class="error"><?php echo $depError?></span>
        </div>
        <div class="group_gender">
          <label for="gender">Gender:</label>
          <input type="radio" name="gender" id="male" value="male"> Male
          <input type="radio" name="gender" id="female" value="female"> Female
        </div><br>
        <span class="error"><?php echo $genderError?></span>

        <div class="group_signup">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" required><br>
                  <span class="error"><?php echo $passwordError?></span>

        </div>
        <div class="group_signup">
          <label for="confirmPassword">Confirm Password:</label>
          <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password"
            required><br>
                    <span class="error"><?php echo $passwordError?></span>

        </div>


        <input type="checkbox" name="terms" id="terms">
        I agree to the terms and conditions
        <button class="signup-form-btn" type="submit">signup</button>
      </form>
    </div>
  </div>
</body>

</html>
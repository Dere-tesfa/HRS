
<?php
session_start();
error_reporting(0);

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
$message = $_SESSION['message'] ?? '';
unset($_SESSION['errors'], $_SESSION['old'], $_SESSION['message']);

function old($key, $default = '') {
    global $old;
    return htmlspecialchars($old[$key] ?? $default);
}

function err($key) {
    global $errors;
    return isset($errors[$key]) ? '<span class="error">' . $errors[$key] . '</span>' : '';
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
      margin-top: 10rem;
      
    }
    .error{
  color: rgb(241, 30, 30);
}
  </style>
</head>

<body>


  <div class="signup__container">
    <div class="signup-container">
          <div class="quote">
            <div class="quote_text">
              <h2>welcome!</h2>
              <p>Already signup?<a href="login.php">login</a></p>
            </div>
        </div>

      <div class="signup_content">
        <i class="fa-solid fa-user signup_icon "></i>
        <h2 class="signup-title">Sign Up</h2>
             <div class="line"></div>
             <?php
             if(isset($_SESSION["message"])){
             $message = $_SESSION["message"];
                 echo"".$message."";
}
             ?>
        <form class="signup-form" action="signup_check.php" method="post" novalidate>
          <div class="group_signup">
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullname" placeholder="Enter your full name" value="<?php echo old('fullname'); ?>" required><br>
           <?php echo err('fullname'); ?>
          </div>
          <div class="signup_column">
            <div class="group_signup">
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echo old('email'); ?>" required><br>
              <?php echo err('email'); ?>
            </div>
            <div class="group_signup">
              <label for="phone">Phone:</label>
              <input type="tel" id="phone" name="phone" value="<?php echo old('phone', '+251'); ?>" required><br>
              <?php echo err('phone'); ?>
            </div>
          </div>
          <div class="signup_column">
            <div class="group_signup">
              <label for="address">Address:</label>
              <input type="text" id="address" name="address" placeholder="Enter your address" value="<?php echo old('address'); ?>" required><br>
              <?php echo err('address'); ?>
            </div>
            <div class="group_signup">
              <label for="department">Department:</label>
              <input type="text" id="department" name="department" placeholder="Enter your department" value="<?php echo old('department'); ?>" required><br>
              <?php echo err('department'); ?>
            </div>
          </div>
          <div class="group_gender">
            <label for="gender">Gender:</label>
            <input type="radio" name="gender" id="male" value="male" <?php echo (old('gender') === 'male') ? 'checked' : ''; ?>> Male
            <input type="radio" name="gender" id="female" value="female" <?php echo (old('gender') === 'female') ? 'checked' : ''; ?>> Female
          </div>
          <div class="error"><?php echo err('gender'); ?></div>
          <div class="signup_column">
            <div class="group_signup">
              <label for="password">Password:</label>
              <input type="password" id="password" name="password" placeholder="Enter your password" required><br>
                      <?php echo err('password'); ?>
            </div>
            <div class="group_signup">
              <label for="confirmPassword">Confirm Password:</label>
              <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password"
                required><br>
                        <?php echo err('confirmPassword'); ?>
            </div>
          </div>
          <?php if (!empty($errors) && isset($errors['general'])): ?>
            <div class="error"><?php echo $errors['general']; ?></div>
          <?php endif; ?>
          <input type="checkbox" name="terms" id="terms">
          I agree to the terms and conditions
          <button class="signup-form-btn" type="submit" name="signup">signup</button>
           <p class="page_navigator">Already signup?<a href="login.php">login</a></p>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
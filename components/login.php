


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../font/css/all.css">
    <link rel="stylesheet" href="../font/css/all.min.css">
    <script src="../font/js/all.js"></script>
    <script src="../font/js/all.min.js"></script>
    <style>
        body{
            background: hsl(0, 0%, 89%);
        }
    </style>
</head>
<body>
    <div class="login__container">
        <div class="login_container">
          <i class="fa-solid fa-user login_icon"></i>
            <h1 class="login_title">Login</h1>
            <hr>
             <h4 style="color:red">
                    <?php
                     error_reporting(0);
                    session_start();
                     session_destroy();
                    echo $_SESSION["loginMessage"];
                    ?>
                </h4>
            <form class="logi_form" action="login_check.php" method="POST">
                <div class="login__group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name">
                </div>
                <div class="login__group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password">
                </div>
                <button class="login_button" type="submit">Login</button>
            </form>
            
             <p>Don't have account?<a href="signup.php">signup</a></p>
        </div>
    </div>
</body>
</html>
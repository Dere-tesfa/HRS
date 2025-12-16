<?php
$host="localhost";
$user= "root";
$password= "";
$dbname= "hr_systems";
$data=mysqli_connect($host,$user,$password,$dbname);
$sql="SELECT*from hrsystem WHERE role='employee'";
$result=mysqli_query($data, $sql);

?>


<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>employee list</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../font/css/all.css">
  <link rel="stylesheet" href="../font/css/all.min.css">
  <script src="../font/js/all.js"></script>
  <script src="../font/js/all.min.js"></script>
</head>

<body>
  <div class="admin__pages">
    <header>
     <?php require "../include_Components/header.php"?>
    
    </header>

    <aside>
     <?php include "../include_Components/asideBar.php"?>
    </aside>
    
    <main>

      <div class="employee-list-container">
       
          
          
            <button class="add-btn"><a href="../components/signup.php">ADD</a></button>
            
         
      
       <h2 style="text-align:center;">Employee List</h2>
        <table>
          <tr>
            <th>Employee Name</th>
            <th>Email</th>
            <th>phone</th>
            <th>Address</th>
            <th>Department</th>
            <th>gender</th>
            <th>password</th>
            <th>Delete</th>
          </tr>
           <?php
        
      while($info=$result->fetch_assoc()){
       
       
                ?>
          <tr>
            <td>
              <?php echo "{$info['fullname']}"?>
          </td>
            <td>
              <?php echo "{$info['email']}"?>
          </td>
            <td>
              <?php echo "{$info['phone']}"?>
          </td>
            <td>
              <?php echo "{$info['address']}"?>
          </td>
            <td>
              <?php echo "{$info['department']}"?>
          </td>
            <td>
              <?php echo "{$info['gender']}"?>
          </td>
            <td>
              <?php echo "{$info['password']}"?>
          </td>
            <td>
             
          </td>
            </tr>
          
          <?php
          
          }
          ?>
        </table>
      </div>

    </main>
    <footer>
     <?php include "../include_Components/footer.php"?>
    </footer>
  </div>
</body>

</html>
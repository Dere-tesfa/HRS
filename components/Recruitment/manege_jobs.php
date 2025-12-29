<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>manege jobs</title>
    <style>
        table,th,tr,td{
            border: 1px solid gray;
            border-collapse: collapse;

        }
    </style>
</head>
<body>
    <?php
$host="localhost";
$user= "root";
$password="";
$dbname="hr_systems";
$data=mysqli_connect($host,$user,$password,$dbname);
$sql="SELECT *FROM job_applications";
$result=mysqli_query($data,$sql);
    
    ?>
    
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>APPilide Position</th>
            <th>Date</th>
            <th>Cover Letter</th>
            <th>CV</th>
        </tr>
         <?php
                while($info=$result->fetch_assoc()){
                
                ?>
        <tr>
            <td>
                <?php
                echo "{$info['fname']}"
                ?>
            </td>
            <td><?php
                echo "{$info['lname']}"
                ?></td>
            <td><?php
                echo "{$info['email']}"
                ?></td>
            <td><?php
                echo "{$info['phone']}"
                ?></td>
            <td>
                <?php
                echo "{$info['appliedPosition']}"
                ?>
            </td>
            <td>
               <?php
                echo "{$info['date']}"
                ?> 
            </td>
            <td>
               <?php
                echo "{$info['coverletter']}"
                ?>"
            </td>
            <td>
              <img src=" <?php
                echo "{$info['uploadresume']}"
                ?>" alt="">
            </td>
        </tr>
         <?php
         
}
    ?>
    </table>
   
</body>
</html>
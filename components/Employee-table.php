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
        <div class="table-actions">
          <h2 class="employee-list-title">Employee List</h2>
          <div class="table-btn-group">
            <button class="add-btn"><a href="../components/signup.html">ADD</a></button>
            <button class="delete-btn"><a href="#">DELETE</a></button>
          </div>
        </div>
        <table class="employee-table">
          <tr>
            <th>No</th>
            <th>Employee Name</th>
            <th>Employee ID</th>
            <th>Department</th>
            <th>Gender</th>
            <th>Joining Date</th>
            <th>action</th>
          </tr>
          <tr>
            <td>1</td>
            <td>tadios misganaw</td>
            <td>hr1234</td>
            <td>developer</td>
            <td>male</td>
            <td>20/03/2003 EC</td>
            <td><button class="detail-btn"><a href="#">view detail</a></button></td>
          </tr>
          <tr>
            <td>2</td>
            <td>dereje tesfaye</td>
            <td>hr1234</td>
            <td>developer</td>
            <td>male</td>
            <td>20/03/2003 EC</td>
            <td><button class="detail-btn"><a href="#">view detail</a></button></td>

          </tr>
          <tr>
            <td>3</td>
            <td>biniyam misganaw</td>
            <td>hr1234</td>
            <td>developer</td>
            <td>male</td>
            <td>20/03/2003 EC</td>
            <td><button class="detail-btn"><a href="#">view detail</a></button></td>

          </tr>
          <tr>
            <td>4</td>
            <td>john </td>
            <td>hr1234</td>
            <td>developer</td>
            <td>male</td>
            <td>20/03/2003 EC</td>
            <td><button class="detail-btn"><a href="#">view detail</a></button></td>

          </tr>
          <tr>
            <td>5</td>
            <td>belete misganaw</td>
            <td>hr1234</td>
            <td>developer</td>
            <td>male</td>
            <td>20/03/2003 EC</td>
            <td><button class="detail-btn"><a href="#">view detail</a></button></td>
          </tr>
          <tr>
            <td>6</td>
            <td>hewan</td>
            <td>hr1235</td>
            <td>designer</td>
            <td>female</td>
            <td>21/03/2003 EC</td>
            <td><button class="detail-btn"><a href="#">view detail</a></button></td>
          </tr>
        </table>
      </div>

    </main>
    <footer>
     <?php include "../include_Components/footer.php"?>
    </footer>
  </div>
</body>

</html>
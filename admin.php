<?php
  include('connection.php');
  session_start();
  if(! isset($_SESSION['username']))
  {
    header("location:admin_login.php");
  }
  $query="SELECT * FROM user ";
  $results=mysqli_query($conn,$query);
 ?>
<html>
<head>
  <link rel="stylesheet" href="css/admin_styles.css">
</head>

<body>

  <ul>
    <li><a href="admin.php">Users</a></li>
    <li><a href="admin.php">Search</a></li>
    <li class="logout"><a href="admin_logout.php">Logout</a></li>

  </ul>
  <div class="box" style="">
    <h1 style="color:black;">ADMINISTRATION</h1>
    <table class="container">
      <thead>
        <tr>
          <th>
            <h1>First Name</h1>
          </th>
          <th>
            <h1>Last Name</h1>
          </th>
          <th>
            <h1>Email</h1>
          </th>
          <th>
            <h1>Password</h1>
          </th>
          <th>
            <h1>Gender</h1>
          </th>
          <th>
            <h1>Date of Birth</h1>
          </th>
          <th> <h1> View</h1></th>
        </tr>
      </thead>
      <tbody>
        <?php while($row=mysqli_fetch_array($results)) { ?>

        <tr>

          <td><?php echo $row['FirstName']; ?></td>
          <td><?php echo $row['LastName']; ?></td>
          <td><?php echo $row['Email']; ?></td>
          <td><?php echo $row['Password']; ?></td>
          <td><?php echo $row['Gender']; ?></td>
          <td><?php echo $row['DateofBirth']; ?></td>
          <td> <a href="userdata.php?id=<?php echo $row['UserID']; ?>">View</a> </td>

        </tr>

        <?php } ?>
      </tbody>
    </table>
  </div>

</body>

</html>

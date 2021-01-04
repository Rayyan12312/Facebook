<?php
include('connection.php');
session_start();
if(isset($_SESSION['username']))
{
  header("location:admin.php");
}
 ?>
<html oncontextmenu="return false">

<head>
  <meta charset="utf-8">

  <link rel="stylesheet" href="css/admin_login_styles.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
  <div class="center">

    <div class="container" style="border-radius:10px;">
      <div class="text">Login Form</div>
      <?php if(isset($_SESSION['msg'])) { ?>
        <div class="data">
          <p style="color:red; ">
            <?php echo $_SESSION['msg'];?>
          </p>
        </div>
      <?php } ?>
      <form action="admin_process.php" method="post">
        <div class="data">
          <label>User Name</label>
          <input type="text" name="username" required>
        </div>
        <div class="data">
          <label>Password</label>
          <input type="password" name="password" required>
        </div>

        <div class="btn" style="border-radius:8px;">
          <div class="inner">
          </div>
          <button type="submit" name="save">login</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>

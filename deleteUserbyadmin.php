<?php
include('connection.php');
$id=$_GET['id'];

mysqli_query($conn,"DELETE FROM user WHERE UserID='$id'");
header("location:admin.php");
 ?>

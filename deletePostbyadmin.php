<?php

include('connection.php');

$pid=$_GET['pid'];
$id=$_GET['id'];
mysqli_query($conn,"DELETE FROM post WHERE PostID='$pid'");
header("location:userdata.php?id=$id");
 ?>

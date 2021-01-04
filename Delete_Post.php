<?php
include('connection.php');
session_start();
if( ! isset($_SESSION['email']))
{
  header("location:Facebook.php");
}
$userid=$_SESSION['UserID'];
$pid=$_GET['pid'];
$result=mysqli_query($conn,"SELECT * FROM profile WHERE UserID='$userid'");
$row=mysqli_fetch_array($result);
$nop=$row['Number_of_posts'];

$nop=$nop-1;
mysqli_query($conn,"UPDATE profile SET Number_of_posts='$nop' WHERE UserID='$userid'");
mysqli_query($conn,"DELETE FROM post WHERE PostID='$pid'");
header("location:MyPosts.php");
 ?>

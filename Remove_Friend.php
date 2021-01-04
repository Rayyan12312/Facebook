<?php
include('connection.php');
session_start();
if(! isset($_SESSION['email']))
{
  header("location:Facebook.php");
}

$userid=$_SESSION['UserID'];
$uid=$_GET['id'];
$query="SELECT * FROM profile WHERE UserID='$userid'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_array($result);
$nof=$row['Number_of_friends'];
$nof=$nof-1;
mysqli_query($conn,"UPDATE profile SET Number_of_friends='$nof' WHERE UserID='$userid'");
mysqli_query($conn,"DELETE FROM isfriend WHERE User1='$userid' AND User2='$uid'");
header("location:MyFriends.php");

 ?>

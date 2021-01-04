<?php
include('connection.php');
session_start();
$userid=$_SESSION['UserID'];
if(isset($_GET['id']))
{
  $post_id=$_GET['id'];
  $query="SELECT * FROM likes WHERE UserID='$userid' AND PostID='$post_id'";
  $result=mysqli_query($conn,$query);
  if(mysqli_num_rows($result)==0)
  {
    mysqli_query($conn,"INSERT INTO likes VALUES ('$post_id','$userid',1)");
  }
}
header("location:MyPosts.php");
 ?>

<?php

include('connection.php');
session_start();
$userid=$_SESSION['UserID'];
$post_id=$_GET['id'];
$id=$_GET['pid'];
$comment=$_POST['comment'];
mysqli_query($conn,"INSERT INTO comment (UserID,PostID,CommentText) VALUES ('$userid','$post_id','$comment')");
header("location:Person_Posts.php?pid=$id");

 ?>

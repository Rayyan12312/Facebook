<?php
include('connection.php');
session_start();
if( ! isset($_SESSION['email']))
{
  header("location:Facebook.php");
}
$userid=$_SESSION['UserID'];
$email=$_SESSION['email'];
if(isset($_POST['edit-post']))
{
  $post_text=$_POST['post-text'];
  $files=$_FILES['pic'];
  $filename=$files['name'];
  $filetmp=$files['tmp_name'];
  $fileext=explode('.',$filename);
  $filecheck=strtolower(end($fileext));
  $fileExtstored=array('png','jpg','jpeg');
  if(in_array($filecheck,$fileExtstored))
  {
    mkdir('Posts/'.$email);
    $destinationfile='Posts/'.$email.'/'.$filename;
    move_uploaded_file($filetmp,$destinationfile);
    mysqli_query($conn,"UPDATE post SET Post_content='$post_text', Post_Photo='$destinationfile' WHERE UserID='$userid'");
    header("location:MyPosts.php");
  }
  else if(($_FILES['pic']['size'] == 0) && isset($_POST['post-text'])) {
    mysqli_query($conn,"UPDATE post SET Post_content='$post_text', Post_Photo='$destinationfile' WHERE UserID='$userid'");
    header("location:MyPosts.php");
}
else{
  header("location:Home.php");
}
}
 ?>

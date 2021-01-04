<?php

include('connection.php');
session_start();
if(! isset($_SESSION['email']))
{
  header("location:Facebook.php");
}
$userid=$_SESSION['UserID'];
$email=$_SESSION['email'];
if(isset($_POST['post-save']))
{
  $query="SELECT * FROM profile WHERE UserID='$userid'";
  $result=mysqli_query($conn,$query);
  $row=mysqli_fetch_array($result);
  $nop=$row['Number_of_posts'];
  $post_text=$_POST['post-text'];
  $files=$_FILES['pic'];
  $filename=$files['name'];
  $filetmp=$files['tmp_name'];
  $fileext=explode('.',$filename);
  $filecheck=strtolower(end($fileext));
  $fileExtstored=array('png','jpg','jpeg');
  if(in_array($filecheck,$fileExtstored))
  {
    $profileID=$pro_row['ProfileID'];
    $_SESSION['profileID']=$profileID;
    mkdir('Posts/'.$email);
    $destinationfile='Posts/'.$email.'/'.$filename;
    move_uploaded_file($filetmp,$destinationfile);
    $nop=$nop+1;
    $q="INSERT INTO post (UserID,Post_content,Post_Photo) Values ('$userid','$post_text','$destinationfile')";
    mysqli_query($conn,$q);
    mysqli_query($conn,"UPDATE profile SET Number_of_posts='$nop' WHERE UserID='$userid'");
    header("location:Home.php");
  }
  else if(($_FILES['pic']['size'] == 0) && isset($_POST['post-text'])) {
    $q="INSERT INTO post (UserID,Post_content,Post_Photo) Values ('$userid','$post_text','')";
    $nop=$nop+1;
    mysqli_query($conn,"UPDATE profile SET Number_of_posts='$nop' WHERE UserID='$userid'");
    mysqli_query($conn,$q);
    header("location:Home.php");
  }

}
 ?>

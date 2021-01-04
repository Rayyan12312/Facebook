<?php

include('connection.php');

if(isset($_POST['save']))
{
  $username=$_POST['username'];
  $password=$_POST['password'];

  $query="SELECT * FROM admin WHERE user_name='$username'";
  $result=mysqli_query($conn,$query);
  $row=mysqli_fetch_array($result);

  if(mysqli_num_rows($result))
  {
    if(($row['password']) != $password)
    {
      $_SESSION['msg']="Incorrect Username and Password";
    }
    else{
      session_start();
      $_SESSION['username']=$username;
      header("location:admin.php");
    }
  }
  else{
    $_SESSION['msg']="Incorrect Username and Password";
  }
}
header("location:admin_login.php");
?>

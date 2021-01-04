<?php
session_start();
if(isset($_SESSION['email']))
{
  header("location:Home.php");
}
$msg="";
$msg2="";
$msg3="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
if(isset($_POST['save'])){
  $Fname=$_POST['FirstName'];
  $Lname=$_POST['LastName'];
  $email=$_POST['email'];
  $password=$_POST['Password'];
  $day=$_POST['Day'];
  $month=$_POST['Month'];
  $year=$_POST['Year'];
  $dob=$year."-".$month."-".$day;
  $gender=$_POST['Gender'];
$query="SELECT Email FROM user where Email ='$email' ";
$users=mysqli_query($conn,$query);
$results=mysqli_num_rows($users);
if($results>0)
{
  $msg="Email is already taken";
}
else if(preg_match('~[0-9]~', $Fname) || preg_match('~[0-9]~', $Lname))
{
  $msg2="Name does not contain numeric values";
}
else{
mysqli_query($conn,"INSERT INTO user(FirstName,LastName,Email,Password,Gender,DateofBirth) VALUES ('$Fname','$Lname','$email','$password','$gender','$dob')");
$_SESSION['email']=$email;
$_SESSION['Fname']=$Fname;
$_SESSION['Lname']=$Lname;
  header("location:Home.php");
}
}
if(isset($_POST['login']))
{
  $email=$_POST['email'];
  $password=$_POST['pass'];
  $query="SELECT * FROM user where Email='$email'";
  $user=mysqli_query($conn,$query);
  $result=mysqli_num_rows($user);
$row=mysqli_fetch_array($user);
if($result>0)
{
  if($password!= ($row['Password']))
  {
    $msg3="Password is incorrect";
  }
  else{
    $_SESSION['email']=$email;
    $_SESSION['Fname']=$row['FirstName'];
    $_SESSION['Lname']=$row['LastName'];
      header("location:Home.php");
  }
}
else{
  $msg3="Account does not exist";
}
}
}

 ?>

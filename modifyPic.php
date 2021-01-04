<?php
include('connection.php');
session_start();
if( ! (isset($_SESSION['email'])))
{
  header("location:Facebook.php");
}
if(! isset($_GET['help']))
{
  header("location:Profile.php");
}
$picID=$_GET['help'];
$profileID=$_SESSION['profileID'];
$query="SELECT * FROM profile_picture WHERE PPID='$picID'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_array($result);
if(isset($_POST['update-button']))
{
  $q="UPDATE profile_picture SET active =0 where ProfileID='$profileID'";
  mysqli_query($conn,$q);
  $q="UPDATE profile_picture SET active =1 where PPID='$picID'";
  mysqli_query($conn,$q);
  header("location:Profile.php");
}

if(isset($_POST['delete-button']))
{
  $q="DELETE from profile_picture where PPID='$picID'";
  mysqli_query($conn,$q);
  header("location:Profile.php");
}
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/facebook.css">
    <link rel="icon" href="https://icons.iconarchive.com/icons/lgp85/blue-crystal/256/My-Pictures-icon.png">
    <title>My Photos</title>
    <style>
    .center {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 40%;
}
    </style>
  </head>
  <body>
    <div class="wrapper">
     <div class="box">
       <div class="row row-offcanvas row-offcanvas-left">
         <div class="column col-sm-2 col-xs-1 " id="sidebar">
           <ul class="nav">
             <li><a href="logout.php?log_out" data-toggle="offcanvas" class="visible-xs text-center"><i class="###">Log out</i></a></li>
           </ul>

           <ul class="nav hidden-xs" id="lg-menu">
             <li class="active"><a href="Home.php"><i class=""></i> Featured</a></li>
             <li><a href="MyFriends.php"><i class=""></i> Friends</a></li>
             <li><a href="Profile.php"><i class=""></i> Profile</a></li>
             <li><a href="Settings.php"><i class=""></i> Settings</a></li>
           </ul>
         </div>
         <div class="column col-sm-10 col-xs-11" id="main">
           <div class="navbar navbar-blue navbar-static-top">
             <div class="navbar-header">
               <a href="" class="navbar-brand logo">f</a>
             </div>
             <nav class="collapse navbar-collapse" role="navigation">
               <form class="navbar-form navbar-left">
                 <div class="input-group input-group-sm" style="max-width:360px;">
                   <input class="form-control" placeholder="Search" name="srch-term" type="text">
                   <div class="input-group-btn">
                     <button class="btn btn-success" type="submit"><i class="#">--></i></button>
                   </div>
                 </div>
               </form>


               <?php
               $data=mysqli_query($conn,"SELECT * from profile_picture where ProfileID='$profileID' AND active=1 ");
               if(mysqli_num_rows($data))
               {
                 $pic_row=mysqli_fetch_array($data);
                 $pic=$pic_row['Picture'];
               }
               else{
                 $pic="default.png";
               }
                ?>

               <ul class="nav navbar-nav">
                 <li>
                   <img style="border-radius:50%; margin-top:5px; margin-right:10px;" src="<?php echo $pic; ?>" alt="" height="40" width="40">
                 </li>

                 <li>
                   <p style="font-size: 25px;margin:0px;margin-top: 5px; margin-right:5px;">
                     <?php echo $_SESSION['Fname']." ".$_SESSION['Lname']; ?>
                   </p>
                 </li>
                 <li>
                   <a href="Home.php"><i class=""></i> Home</a>
                 </li>

                 <li>
                   <a href="logout.php?log_out"><span class="badge">Log out</span></a>
                 </li>
               </ul>

               </ul>
             </nav>
           </div>

           <div class="full col-sm-9">
             <div class="row">
               <div class="col-sm-10">
                 <div class="panel panel-default">
                   <div class="panel-heading"><i class="pull-right"><img src="https://www.iconarchive.com/download/i43804/itzikgur/my-seven/Pictures-Nikon.ico" style=" height:40px;"></i>
                     <h4>My Photos</h4>
                   </div>
                   <div class="panel-body">

                     <img src="<?php echo $row['Picture']; ?>" alt="" class="center">
                     <hr>
                     <form class="" action="" method="post">
                       <button style=" margin-left: 15px;" type="submit" name="update-button" class="btn btn-primary pull-right">Set Picture</button>
                       <button type="submit" name="delete-button" class="btn btn-primary pull-right">Delete Picture</button>
                     </form>

                     </div>
                     </div>
                     </div>
                     </div>
                     </div>
  </body>
</html>

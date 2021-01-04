<?php
include('connection.php');
session_start();
if( ! (isset($_SESSION['email'])))
{
  header("location:Facebook.php");
}
$profileID=$_SESSION['profileID'];
$query="SELECT * FROM profile_picture WHERE ProfileID='$profileID'";
$pics=mysqli_query($conn,$query);
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/facebook.css">
    <link rel="icon" href="https://icons.iconarchive.com/icons/lgp85/blue-crystal/256/My-Pictures-icon.png">
    <title>My Photos</title>
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
               <form class="navbar-form navbar-left" action ="Search.php" method="post">
                 <div class="input-group input-group-sm" style="max-width:360px;">
                   <input class="form-control" placeholder="Search" name="srch-term" type="text">
                   <div class="input-group-btn">
                     <button class="btn btn-success" type="submit" name="search-btn"><i class="#">--></i></button>
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

                       <?php while($row=mysqli_fetch_array($pics)) {?>

                        <a href="modifyPic.php?help=<?php echo $row['PPID']; ?>"><img class="img-tag" style="margin:0px; border: solid;margin-right:5px; margin-bottom:5px;" src="<?php echo $row['Picture']; ?>" alt="" height="200" width="200" ></a>
                       <?php } ?>


                     </div>
                     </div>
                     </div>
                     </div>
                     </div>
  </body>
</html>

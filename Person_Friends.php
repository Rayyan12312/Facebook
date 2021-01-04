<?php

include('connection.php');
session_start();
if( !isset($_SESSION['email']))
{
  header("location:Facebook.php");
}

$userid=$_SESSION['UserID'];
$uid=$_GET['id'];

 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Friends</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/facebook.css">
    <style>
      .search-result{
        margin:0px;
        margin-top: 20px;
        margin-bottom: 20px;
        margin-left: 20px;
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
               <form class="navbar-form navbar-left" action ="Search.php" method="post">
                 <div class="input-group input-group-sm" style="max-width:360px;">
                   <input class="form-control" placeholder="Search" name="srch-term" type="text">
                   <div class="input-group-btn">
                     <button class="btn btn-success" type="submit" name="search-btn"><i class="#">--></i></button>
                   </div>
                 </div>
               </form>
               <?php
               $data=mysqli_query($conn,"SELECT * from profile_picture where UserID='$userid' AND active=1 ");
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
                     <div class="panel-heading"><i class="pull-right"><img src="https://v.cdn.vine.co/r/videos/1AD88FF1561230663558019571712_3c7038f784a.4.1.9145269429472457195.mp4.jpg?versionId=oQ6yyxU375eoXglu18jH9gE19BjAT80Y" style=" height:40px;"></i>
                       <h4>Friends</h4>
                     </div>
                   <?php
                   $q="SELECT * FROM isfriend WHERE User1='$uid'";
                   $data=mysqli_query($conn,$q);
                   if(mysqli_num_rows($data)){
                   while($r=mysqli_fetch_array($data)){
                     $fid=$r['User2'];
                     $result=mysqli_query($conn,"SELECT * FROM user where UserID='$fid'");
                     $picresult=mysqli_query($conn,"SELECT * FROM profile_picture WHERE UserID='$fid' AND active=1");
                     $p=mysqli_fetch_array($picresult);
                     while($row=mysqli_fetch_array($result)){
                    ?>
                    <div class="search-result">
                      <?php if(mysqli_num_rows($picresult)) { ?>
                         <?php  if( $p['Picture']!="") { ?>
                      <img  style="border-radius:50%;" src="<?php echo $p['Picture']; ?>" alt="" height="100" width="100" >
                    <?php } } else { ?>
                      <img  style="border-radius:50%;" src="default.png" alt="" height="100" width="100" >

                    <?php } ?>
                    <b>
                      <?php if($fid==$userid){ ?>
                        <h4 style="display:inline-block; position:absolute; margin-left:15px; margin-top:15px;">You </h4>
                          </a>
                        <?php } else { ?>
                      <a href="Person.php?help=<?php echo $row['UserID']; ?>">
                      <h4 style="display:inline-block; position:absolute; margin-left:15px; margin-top:15px;"><?php echo $row['FirstName']." ".$row['LastName']; ?></h4>
                        </a>
                      <?php } ?>
                    </b>
                      <p style="display:inline-block; margin-left:15px; color:blue;"><?php echo $row['Gender']; ?></p>
                      <hr style="width:70%;">
                    </div>

                  <?php } ?>
                <?php } ?>
<?php } ?>

                   </div>
                   </div>
                   </div>
                   </div>
  </body>
</html>

<?php
include('connection.php');
session_start();
if( ! isset($_SESSION['email']))
{
header("location:Facebook.php");
}
$userid=$_SESSION['UserID'];
$query="SELECT * FROM user where UserID='$userid'";
$user=mysqli_query($conn,$query);
$row=mysqli_fetch_array($user);
 ?>

 <!DOCTYPE html>
 <html lang="" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Edit Post</title>
     <link rel="stylesheet" href="css/bootstrap.css">
     <link rel="stylesheet" href="css/facebook.css">
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
              <li><a href="#"><i class=""></i> Settings</a></li>
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
                    <li>
                      <img style="border-radius:50%; margin-top:5px; margin-right:10px;" src="<?php echo $pic; ?>" alt="" height="40" width="40">
                    </li>

                    <li>
                      <p style="font-size: 25px;margin:0px;margin-top: 5px; margin-right:5px;">
                        <?php echo $row['FirstName']." ".$row['LastName']; ?>
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
                    <div class="panel-heading"><i class="pull-right"><img src="settings.svg" style=" height:40px;"></i>
                      <h4>Edit Post</h4>
                    </div>
                    <div class="panel-body">
                      <p>Insert new detail of the post</p>
                      <form class="form" action="Editpost.php" method="post" enctype="multipart/form-data">
                     <input type="file" name="pic" value="" style="margin:0px; padding:0px;">
                     <br>
                     <div class="input-group text-center">
                     <input class="form-control input-lg" placeholder="Enter new text..." type="text" name="post-text">
                       <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit" name="edit-post">Save</button></span>
                     </div>
                     <br>
                     </form>

                      </div>
                      </div>
                      </div>
                      </div>
                      </div>

   </body>
 </html>

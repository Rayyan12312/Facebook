<?php
include('connection.php');
session_start();
if(! isset($_SESSION['email']))
{
  header("location:Facebook.php");
}
if(! ((isset($_GET['help']))))
{
  header("location:Home.php");
}
$uid=$_GET['help'];
$userid=$_SESSION['UserID'];
$query="SELECT * FROM user where UserID='$uid'";
$q="SELECT * FROM profile where UserID='$uid'";
$results=mysqli_query($conn,$query);
$row=mysqli_fetch_array($results);
$results2=mysqli_query($conn,$q);
$pro_row = mysqli_fetch_array($results2);

if(isset($_POST['add']))
{
  $check=mysqli_query($conn,"SELECT * FROM isfriend where User2='$uid' AND User1='$userid'");
  if(mysqli_num_rows($check)==0)
  {
    mysqli_query($conn,"INSERT INTO isfriend VALUES ('$userid',1,'$uid')");
    $r=mysqli_query($conn,"SELECT * FROM profile WHERE UserID='$userid'");
    $r1=mysqli_fetch_array($r);
    $nof=$r1['Number_of_friends'];
    $nof=$nof+1;
    mysqli_query($conn,"UPDATE profile SET Number_of_friends='$nof' WHERE UserID='$userid'");
  }
}
 ?>
<html >
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/facebook.css">
    <link rel="icon" href="https://www.freeiconspng.com/uploads/profile-icon-1.png">
    <title>Profile</title>
    <style>
      .name-heading{
      display:inline-block;
      padding:0px;
      font-family: 'Trebuchet MS', sans-serif;
       margin-top: 40px;
       margin-left:25px;
       padding-bottom: 10px;
      }
      .profile-pic{
      display:inline-block;
       vertical-align:top;
       border-radius:50%;
      }
      .p-tag{
        margin:0px;
        margin-left: 25px;
        color:grey;
        padding-bottom: 5px;
      }
      .icon-tag{
        padding-right: 10px;
      }

      .edit {
        color: blue;
        border-style: solid;
        background-color: #dff3e3;
        width: 50px;
        text-align: center;
        border-radius: 5px;
        border-width: thin;
        margin-left: 25px;
      }

      .edit:hover {
        background-color: #d0e8f2;
      }
      .hide-box {
    display: none;
    position: fixed;
    z-index: 1;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
      }
      .content-box{
        display:inline-block;
        margin-left: 500px;
        width:400px;
        height:500px;
        background-color: #ccc;
        border-radius: 20px;
      }
      .edit-box-input{
        margin-top:5px;
        border-radius: 5px;
        margin-left: 20px;
        margin-bottom: 15px;
        border: 5px;
      }
      .profile-box{
        display:inline-block;
        position:absolute;
         padding:10px;
         background-color: #dbf6e9;
         width:200px;
         border-radius: 10px;
         margin-left: 100px
      }
      .follow{
        margin-top:15px;
        margin-right:10px;
        border: none;
        background: none;
      }
    </style>
  </head>
  <body>
    <div class="wrapper">
     <div class="box">
       <div class="row row-offcanvas row-offcanvas-left">
         <div class="column col-sm-2 col-xs-1 " id="sidebar">
           <ul class="nav">
             <li><a href="logout.php" data-toggle="offcanvas" class="visible-xs text-center"><i class="###">Log out</i></a></li>           </ul>

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
                  <div class="panel-heading"><i class="pull-right"><img src="profile.png" style=" height:40px;"></i>
                    <h4>Profile</h4>
                  </div>
                  <div class="panel-body">
                    <form class="" action="" method="post">
                      <button type="submit" name="add" id="add-btn" class="pull-right follow">
                        <img class="pull-right follow" src="https://forum.gameloft.com/images/game_icons/AddMe_icon.png" height="40" width="40" alt="">
                      </button>
                    </form>
                    <div class="inner-box" >
                      <?php
                      $data=mysqli_query($conn,"SELECT * from profile_picture where UserID='$uid' AND active=1 ");
                      if(mysqli_num_rows($data))
                      {
                        $pic_row=mysqli_fetch_array($data);
                        $pic=$pic_row['Picture'];
                      }
                      else{
                        $pic="default.png";
                      }
                       ?>

                      <img src="<?php echo $pic; ?>" alt="" height="200" width="200" class="profile-pic">
                      <div class="" style="display:inline-block;">
                        <h2 class="name-heading"><?php echo $row['FirstName']." ".$row['LastName']; ?></h2>
                        <h2 class="name-heading" style="font-size:20px;">
                          <?php
                          if(mysqli_num_rows($results2))
                          {
                            if($pro_row['Nickname']=="nickname")
                            {
                              echo "( None )";
                            }
                            else{
                             echo "(";
                             echo $pro_row['Nickname'];
                             echo ")";
                           }
                           }

                           ?>
                        </h2>
                        <p class="p-tag"><img class="icon-tag" src="https://image.flaticon.com/icons/png/512/14/14869.png" height="20">
                          <?php echo $row['Gender']; ?>
                        </p>
                        <p class="p-tag"><img class="icon-tag" src="https://www.flaticon.com/svg/static/icons/svg/25/25694.svg" height="20">
                          <?php if(mysqli_num_rows($results2)){
                            if($pro_row['Hometown']=="Insert your Hometown here")
                            {
                              echo "None";
                            }
                            else{
                             echo $pro_row['Hometown'];
                            }

                           }

                           ?>
                        </p>
                        <p class="p-tag"><img class="icon-tag" src="https://images.vexels.com/media/users/3/140908/isolated/preview/bdc30bbe3c022a11e2d7fd0e642c61ae-open-book-icon-by-vexels.png" height="20">

                          <?php if(mysqli_num_rows($results2)){
                            if($pro_row['Education']=="Insert your education here")
                            {
                                echo "None";
                            }
                            else{
                              echo $pro_row['Education'];
                            }
                          }
                           ?>

                        </p>
                        <p class="p-tag"><img class="icon-tag" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f1/Heart_coraz%C3%B3n.svg/1200px-Heart_coraz%C3%B3n.svg.png" height="20">
                          <?php if(mysqli_num_rows($results2)){
                            if($pro_row['Relationship_status']=="Insert your Relationship status here")
                            {
                              echo "None";

                            }
                            else{
                              echo $pro_row['Relationship_status'];
                            }
                           }
                           ?>

                        </p>
                        <hr>

                      </div>
                      <p class="p-tag">
                        <?php if(mysqli_num_rows($results2))
                        {
                          if($pro_row['Bio']=="Insert your bio here")
                          {
                            echo " ";

                          }
                          else{
                            echo $pro_row['Bio'];
                          }
                         }

                         ?>
                      </p>
                      <hr>
                      <?php
                       $q="SELECT * FROM isfriend WHERE User1='$userid' AND User2='$uid'";
                       $check=mysqli_query($conn,$q);

                       ?>
                       <?php
                       if(mysqli_num_rows($check)){
                        ?>
                      <div class="content">
                        <a href="Person_Photos.php?proID=<?php echo $pro_row['ProfileID']; ?>" class="btn btn-primary">Photos</a>
                        <a href="Person_Friends.php?id=<?php echo $uid; ?>" class="btn btn-primary">Friends</a>
                        <a href="Person_Posts.php?pid=<?php echo $uid; ?>" class="btn btn-primary">Posts</a>
                      </div>
                    <?php } ?>
                      <hr>

                    </div>
		                </div>

                </div>
              </div>

            </div>
          </div>

           </div>
           </div>
           </div>
           </div>
           <script>
           if ( window.history.replaceState ) {
             window.history.replaceState( null, null, window.location.href );
           }
           </script>

  </body>
</html>

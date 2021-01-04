<?php
include('connection.php');
session_start();
if(! isset($_SESSION['email']))
{
  header("location:Facebook.php");
}

$email=$_SESSION['email'];
$query="SELECT * FROM user where Email ='$email'";
$user=mysqli_query($conn,$query);
$row=mysqli_fetch_array($user);
$userid=$_SESSION['UserID'];
$q="SELECT * FROM profile where UserID='$userid'";

$profile=mysqli_query($conn,$q);
if(!(mysqli_num_rows($profile)))
{
  $nickname="nickname";
  $bio="Insert your bio here";
  $education="Insert your education here";
  $hometown="Insert your Hometown here";
  $relationship="Insert your Relationship status here";
 mysqli_query($conn,"INSERT INTO profile (Education,Bio,Nickname,Relationship_status,Hometown,UserID) Values ('$education','$bio','$nickname','$relationship','$hometown','$userid')");
header("Refresh:0");
}
$pro_row=mysqli_fetch_array($profile);
$profileID=$pro_row['ProfileID'];
$_SESSION['profileID']=$profileID;
if(isset($_POST['save']))
{
  $nickname=$_POST['nickname'];
  $bio=$_POST['bio'];
  $education=$_POST['education'];
  $hometown=$_POST['hometown'];
  $relationship=$_POST['relationship'];
  $q="SELECT * FROM profile where UserID='$userid'";
  $user=mysqli_query($conn,$q);
  if(mysqli_num_rows($user))
  {
    mysqli_query($conn,"UPDATE profile SET Education='$education',Bio='$bio',NickName='$nickname',Relationship_status='$relationship',Hometown='$hometown' WHERE UserID='$userid'");
  }
  header("Refresh:0");
}
if(isset($_POST['pro-save']))
{
  $files=$_FILES['profile-pic'];
  $filename=$files['name'];
  $filetmp=$files['tmp_name'];
  $fileext=explode('.',$filename);
  $filecheck=strtolower(end($fileext));
  $fileExtstored=array('png','jpg','jpeg');
  if(in_array($filecheck,$fileExtstored))
  {
    $profileID=$pro_row['ProfileID'];
    $_SESSION['profileID']=$profileID;
    mkdir('Pictures/Profile_Pictures/'.$email);
    $destinationfile='Pictures/Profile_Pictures/'.$email.'/'.$filename;
    move_uploaded_file($filetmp,$destinationfile);
    mysqli_query($conn,"UPDATE profile_picture SET active=0 where ProfileID='$profileID'");
    $q="INSERT INTO profile_picture (ProfileID,UserID,Picture,active) Values ('$profileID','$userid','$destinationfile',1)";
    mysqli_query($conn,$q);
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
             <li><a href="#"><i class=""></i> Profile</a></li>
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

                    <div class="inner-box" >


                      <img src="<?php echo $pic; ?>" alt="" height="200" width="200" class="profile-pic">
                      <div class="" style="display:inline-block;">
                        <h2 class="name-heading"><?php echo $row['FirstName']." ".$row['LastName']; ?></h2>
                        <h2 class="name-heading" style="font-size:20px;">

                          <?php if(mysqli_num_rows($profile)){
                             echo "(";
                             echo $pro_row['Nickname'];
                             echo ")";
                           }

                           ?>
                        </h2>
                        <p class="p-tag"><img class="icon-tag" src="https://image.flaticon.com/icons/png/512/14/14869.png" height="20">
                          <?php echo $row['Gender']; ?>
                        </p>
                        <p class="p-tag"><img class="icon-tag" src="https://www.flaticon.com/svg/static/icons/svg/25/25694.svg" height="20">
                          <?php if(mysqli_num_rows($profile)){
                             echo $pro_row['Hometown'];
                           }

                           ?>
                        </p>
                        <p class="p-tag"><img class="icon-tag" src="https://images.vexels.com/media/users/3/140908/isolated/preview/bdc30bbe3c022a11e2d7fd0e642c61ae-open-book-icon-by-vexels.png" height="20">

                          <?php if(mysqli_num_rows($profile)){
                             echo $pro_row['Education'];
                           }
                           ?>

                        </p>
                        <p class="p-tag"><img class="icon-tag" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f1/Heart_coraz%C3%B3n.svg/1200px-Heart_coraz%C3%B3n.svg.png" height="20">
                          <?php if(mysqli_num_rows($profile)){
                             echo $pro_row['Relationship_status'];
                           }
                           ?>

                        </p>
                        <button id="detail_edit" class="edit"> Edit </button>
                        <hr>

                      </div>
                      <div style="" class="profile-box">
                        <p style="margin:auto;"><b>Change Profile Picture</b></p>
                        <form action="" method="post" enctype="multipart/form-data">
                          <input type="file" name="profile-pic" value="" style="width:200px; margin-bottom:10px;" required>
                          <button type="submit" name="pro-save" class="">Save</button>
                        </form>
                      </div>



                      <p class="p-tag">
                        <?php if(mysqli_num_rows($profile)){
                           echo $pro_row['Bio'];
                         }

                         ?>
                      </p>
                      <hr>
                      <div class="content">
                        <a href="Myphotos.php" class="btn btn-primary">My Photos</a>
                        <a href="MyFriends.php" class="btn btn-primary">My Friends</a>
                        <a href="MyPosts.php" class="btn btn-primary">My Posts</a>
                      </div>
                      <hr>
                      <div class="well">
                        <form class="form" action="InsertPost.php" method="post" enctype="multipart/form-data">
                       <h4>Post</h4>
                       <input type="file" name="pic" value="" style="margin:0px; padding:0px;">
                       <br>
                       <div class="input-group text-center">
                       <input class="form-control input-lg" placeholder="What's on your mind ?" type="text" name="post-text">
                         <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit" name="post-save">POST</button></span>
                       </div>
                       <br>
                       </form>
                      </div>
                      <div id="edit-box" class="hide-box" >
                        <div class="content-box">
                          <form class="" action="" method="post">
                            <input class="edit-box-input" style="margin-top:15px;"type="text" name="nickname" value="" placeholder="NickName" required><br>
                            <input class="edit-box-input" type="text" name="hometown" value="" placeholder="Hometown" required><br>
                            <input  class="edit-box-input" type="text" name="education" value="" placeholder="Education" required><br>
                            <p style="padding-left:15px;">Relationship Status</p>
                            <select class="edit-box-input" name="relationship" placeholder="Relationship" required>
                              <option value=""></option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Engaged">Engaged</option>
                            </select>
                            <br>
                            <textarea class="edit-box-input" name="bio" rows="10" cols="30" placeholder="Enter your bio" required></textarea><br>
                            <button type="submit" name="save" class="btn btn-success edit-box-input">Save</button>
                          </form>
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
           </div>
           </div>

           <script>
           var modal = document.getElementById("edit-box");
           var btn = document.getElementById("detail_edit");
           btn.onclick = function() {
             modal.style.display = "block";
           }
           window.onclick = function(event) {
             if (event.target == modal) {
               modal.style.display = "none";
             }
           }
           </script>
           <script>
           if ( window.history.replaceState ) {
             window.history.replaceState( null, null, window.location.href );
           }
           </script>

  </body>
</html>


<?php
include('connection.php');
session_start();
if(! isset($_SESSION['email']))
{
  header("location:Facebook.php");
}
$userid=$_SESSION['UserID'];

 ?>
<html lang="" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>My Posts</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/facebook.css">
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
           <?php
           $q="SELECT * FROM post WHERE UserID='$userid'";
           $result=mysqli_query($conn,$q);
           ?>
           <div class="full col-sm-9">
            <div class="row">
              <div class="col-sm-10">
                <div class="panel panel-default">
                  <div class="panel-heading"><i class="pull-right"><img src="https://i.pinimg.com/originals/90/11/b1/9011b1176169e0732f8f099dc1d584ce.png" style=" height:40px;"></i>
                    <h4>My Posts</h4>
                  </div>
                  <div class="panel-body">

                     <?php while($row=mysqli_fetch_array($result)) {  ?>
                    <p> <?php echo $row['Post_content']; ?>  </p>
                    <hr>
                    <a style="margin-left:10px;" href="Delete_Post.php?pid=<?php echo $row['PostID']; ?>" class="pull-right btn btn-danger">

                      Delete Post
                    </a>

                    <a href="Edit_Post.php?pid=<?php echo $row['PostID']; ?>" class="pull-right btn btn-info">
                      Edit Post
                    </a>

                    <?php if($row['Post_Photo']!="") {?>


                      <center>
                      <img src="<?php echo $row['Post_Photo']; ?>" alt="" height="200" width="200" style="border-radius:5px;">
                      </center>

                    <?php } ?>
                    <br>

                    <?php
                    $count=0;
                    $count1=0;
                    $post_id=$row['PostID'];
                    $all_likes=mysqli_query($conn,"SELECT * FROM likes WHERE PostID='$post_id'");
                    while($r=mysqli_fetch_array($all_likes))
                    {
                      $count++;
                    }
                    $all_comments=mysqli_query($conn,"SELECT * FROM comment WHERE PostID='$post_id'");
                    while($r=mysqli_fetch_array($all_comments))
                    {
                      $count1++;
                    }
                     ?>
                    <b><p>Likes <?php echo $count; ?></p></b>
                    <a href="ViewComment.php?id=<?php echo $row['PostID']; ?>"><b><p>Comments <?php echo $count1; ?></p></b></a>

                    <div class="input-group">
                      <div class="input-group-btn">
                        <a href="InsertLikefromProfile.php?id=<?php echo $row['PostID']; ?>">
                      <button class="btn btn-default">Like</button>
                      </a>
                      </div>
                      <form style="margin-top:14px;" class="" action="InsertCommentFromProfile.php?id=<?php echo $row['PostID']; ?>" method="post">
                      <input class="form-control" placeholder="Add a comment.." type="text" name="comment">
                      <button type="button" name="button" style="display:none;"></button>

                      </form>

                    </div>

                    <hr>
                  <?php }  ?>

                    </div>
                    </div>
                    </div>
                    </div>
                    </div>

  </body>
</html>

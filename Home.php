<?php
include('connection.php');
session_start();
if(isset($_SESSION['email']))
{
$email=$_SESSION['email'];
$query="SELECT * FROM user where Email ='$email'";
$user=mysqli_query($conn,$query);
$row=mysqli_fetch_array($user);
$_SESSION['UserID']=$row['UserID'];
$userid=$_SESSION['UserID'];
}
else{
	header("location: Facebook.php");
}
?>
<html oncontextmenu="return false">
	<head>
        <title>Home</title>
				<link rel="icon" href="https://icons.iconarchive.com/icons/graphicloads/100-flat/256/home-icon.png">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/facebook.css" rel="stylesheet">
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
							<li><a href="Settings.php" <i class=""></i> Settings</a></li>
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

							  </li>
							</ul>
							</nav>
						</div>


						<div class="padding">
							<div class="full col-sm-9">

								<div class="row">

								  <div class="col-sm-10">

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
<?php

$q="SELECT * FROM isfriend WHERE User1='$userid'";
$data=mysqli_query($conn,$q);

 ?>
<?php
if(mysqli_num_rows($data)){
while($r=mysqli_fetch_array($data))
{
	$id=$r['User2'];
	$result=mysqli_query($conn,"SELECT * FROM post WHERE UserID='$id'");

 ?>

 						<?php while($row=mysqli_fetch_array($result)) {

							$user_data=mysqli_query($conn,"SELECT * FROM user WHERE UserID='$id'");
							$user=mysqli_fetch_array($user_data);
							 ?>
									   <div class="panel panel-default">
										  <div class="panel-body">

												<a href="Person.php?help=<?php echo $id; ?>"> <h4 style="color:blue; display:inline-block;"><b><?php echo $user['FirstName']." ".$user['LastName']; ?></b> </h4></a>
											 <p> <?php echo $row['Post_content']; ?>  </p>
											 <?php if($row['Post_Photo']!="") {?>
												 <hr>
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
													 <a href="InsertLikefromHome.php?id=<?php echo $row['PostID']; ?>">
												 <button class="btn btn-default">Like</button>
												 </a>
												 </div>
												 <form style="margin-top:14px;" class="" action="InsertCommentFromHome.php?id=<?php echo $row['PostID']; ?>" method="post">
												 <input class="form-control" placeholder="Add a comment.." type="text" name="comment">
												 <button type="button" name="button" style="display:none;"></button>

												 </form>

											 </div>


											 <hr>

										  </div>
									   </div>
<?php } ?>
<?php } ?>
<?php } ?>


								  </div>
							   </div>



							</div>
						</div>
					</div>


				</div>
			</div>
		</div>

</body>


</html>

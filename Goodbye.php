<?php
session_start();
if($_GET['help']==1){
if(isset($_SESSION['email']))
{
	session_destroy();
}
}
else{
	header("location:Facebook.php");
}
?>
<!DOCTYPE html>
<html oncontextmenu="return false">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/bootstrap.css">
		<title>Good Bye</title>
		<style>
		body{
			background-color: #ccc;
		}
			.box{
				margin:0px auto;
				position: relative;
				width: 600px;
			}
			.heading-box{
				background-color: #2d6187;
				text-align: center;
				border-radius: 10px;
			}
			h2{
				color:white;
			}
			.msg-box{
				font-size: 18px;
				padding-left: 20px;
				padding-top: 10px;
			}
			.goback{
				font-size: 18px;
				padding-left: 20px;
				padding-top: 20px;

			}
			a{
				padding: 20px;
				color:white;
				background-color: #0f3057;
				border-radius: 5px;

			}
			a:hover{
				text-decoration: none;
				background-color:#9ab3f5;
			}

		</style>
	</head>
	<body>
	<div class="box">
		<div class="heading-box">
		<h2>Good Bye</h2>
		</div>
		<div class="msg-box">
		<p>Your account is successfully deleted</p>
		</div>
		<div class="goback">
		<a href="Facebook.php">Go Back to Facebook</a>
		</div>

	</div>
	</body>
</html>

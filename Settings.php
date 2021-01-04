<?php
$msg="";
include('connection.php');
session_start();
if( ! isset($_SESSION['email']))
{
  header("location:Facebook.php");
}
$email=$_SESSION['email'];
$query="SELECT * FROM user where Email='$email'";
$user=mysqli_query($conn,$query);
$row=mysqli_fetch_array($user);
$userid=$row['UserID'];
if(isset($_POST['save-name']))
{
  $f=$_POST['fname'];
  $l=$_POST['lname'];
  $q="UPDATE user SET FirstName='$f', LastName='$l' where Email='$email'";
  mysqli_query($conn,$q);
  header("Refresh:0");
}
if(isset($_POST['save-email']))
{
$e=$_POST['current_email'];
$n=$_POST['new_email'];
$q="SELECT Email FROM user where Email = '$n'";
$user=mysqli_query($conn,$q);
$results=mysqli_num_rows($user);
if($e != ($row['Email']))
{
  $msg="Current Email is incorrect";
}
else if($results>0)
{
  $msg="Email is already taken";
}
else{
  $q="UPDATE user SET Email='$n' where Email='$e'";
  mysqli_query($conn,$q);
  $_SESSION['email']=$n;
  header("Refresh:0");
}
}
if(isset($_POST['save-password']))
{
  $n=$_POST['new_password'];
  $c=$_POST['current_password'];
  if($c != ($row['Password']))
  {
    $msg="Current Password is incorrect";
  }
  else
  {
    $q="UPDATE user SET Password ='$n' where Email='$email'";
    mysqli_query($conn,$q);
    header("Refresh:0");
  }
}
if(isset($_POST['save-gender']))
{
  $g=$_POST['Gender'];
  $query="UPDATE user SET Gender='$g' WHERE Email='$email'";
  mysqli_query($conn,$query);
  header("Refresh:0");
}
if(isset($_POST['delete']))
{
  if($_POST['ans']=="yes")
  {
    $q="DELETE FROM user where Email='$email'";
    mysqli_query($conn,$q);
    header("location:GoodBye.php?help=1");
  }
}
 ?>


<html oncontextmenu="return false">

<head>
  <meta charset="utf-8">
  <link rel="icon" href="https://cdn4.iconfinder.com/data/icons/meBaze-Freebies/512/setting.png">
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/facebook.css" rel="stylesheet">
  <title>Settings</title>
  <style>
    .edit {
      color: blue;
      border-style: solid;
      background-color: #dff3e3;
      width: 50px;
      text-align: center;
      border-radius: 5px;
      border-width: thin;
    }

    .edit:hover {
      background-color: #d0e8f2;
    }

    .Sp {
      display: inline-block;
    }

    .edit-box {
      display: none;
      padding-left: 20px;
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
                    <h4>Settings</h4>
                  </div>
                  <div class="panel-body">
                    <div>
                      <ul style="list-style-type: none; margin:0px; padding:0px; padding-left: 20px;">
                        <li>
                          Name<span class="Sp" style="margin-left: 200px; "><?php echo $row['FirstName']." ".$row['LastName']; ?></span>
                          <button id="name_edit" class="pull-right edit"> Edit </button>
                        </li>
                        <hr>
                        <li>Email<span class="Sp" style="margin-left: 200px; "><?php echo $row['Email']; ?></span>
                          <button id="email_edit" class="pull-right edit"> Edit </button>
                        </li>
                        <hr>
                        <li>Password<span class="Sp" style="margin-left: 175px; ">*********</span>
                          <button id="pass_edit" class="pull-right edit"> Edit </button>
                        </li>
                        <hr>
                        <li>Gender<span class="Sp" style="margin-left: 190px; "><?php echo $row['Gender']; ?></span>
                          <button id="gender_edit" class="pull-right edit"> Edit </button>
                        </li>
                        <hr>
                        <li>Delete Account
                          <button style="width:52px;" id="delete_btn" class="pull-right edit"> Delete </button>
                        </li>
                      </ul>
                    </div>
                    <hr>
                    <div class="edit-box" id="show-name">
                      <h3 style="font-weight:100; padding-bottom:20px;">Change Name</h3>
                      <form class="" action="" method="post">
                        <input type="text" name="fname" value=" <?php echo $row['FirstName']; ?>" placeholder="First Name" required><br><br>
                        <input type="text" name="lname" value=" <?php echo $row['LastName']; ?>" placeholder="Last Name" required><br><br>
                        <button type="submit" name="save-name">Save</button>
                      </form>
                    </div>
                    <div class="edit-box" id="show-email">
                      <h3 style="font-weight:100; padding-bottom:20px;">Change Email</h3>
                      <form class="" action="" method="post">
                        <input type="email" name="current_email" value=" <?php echo $row['Email']; ?>" placeholder="Current Email" required><br><br>
                        <input type="email" name="new_email" value="" placeholder="New Email" required><br><br>
                        <?php if($msg=="Current Email is incorrect" || $msg=="Email is already taken") {?>
                        <script>
                          var s = document.getElementById("show-email");
                          s.style.display = "block";
                        </script>
                        <p style="color:red;">
                          <?php echo $msg; ?>
                        </p>
                        <?php } ?>
                        <button type="submit" name="save-email">Save</button>
                      </form>
                    </div>
                    <div class="edit-box" id="show-password">
                      <h3 style="font-weight:100; padding-bottom:20px;">Change Password</h3>
                      <form class="" action="" method="post">
                        <input type="password" name="current_password" value="" placeholder="Current Password" minlength="6" required><br><br>
                        <input type="password" name="new_password" value="" placeholder="New Password" minlength="6" required><br><br>
                        <?php if($msg=="Current Password is incorrect") {?>
                        <script>
                          var s = document.getElementById("show-password");
                          s.style.display: "block";
                        </script>
                        <p style="color:red;">
                          <?php echo $msg; ?>
                        </p>
                        <?php } ?>
                        <button type="submit" name="save-password">Save</button>
                      </form>
                    </div>
                    <div class="edit-box" id="show-gender">
                      <h3 style="font-weight:100; padding-bottom:20px;">Change Gender</h3>
                      <form class="" action="" method="post">

                        <input type="radio" id="male" name="Gender" value="male" required>
                        <label for="male">Male</label>
                        <input type="radio" id="female" name="Gender" value="female" required>
                        <label for="female">Female</label>
                        <br>
                        <button type="submit" name="save-gender">Save</button>
                      </form>
                    </div>

                    <div class="edit-box" id="delete_account">
                      <h3 style="font-weight:100; padding-bottom:20px;">Delete Account</h3>
                      <form class="" action="" method="post">
                        <p>Do you want to delete your account ? </p>
                        <input type="radio" id="yes" name="ans" value="yes" required>
                        <label for="">Yes</label>
                        <input type="radio" id="no" name="ans" value="no" required>
                        <label for="">No</label>
                        <br>
                        <button type="submit" name="delete">Save</button>
                      </form>
                    </div>

                  </div>

                </div>
              </div>

            </div>
</div>

            <script>
              var modal = document.getElementById("show-name");
              var btn = document.getElementById("name_edit");
              btn.onclick = function() {
                modal.style.display = "block";
              }

              var modal2 = document.getElementById("show-email");
              var btn2 = document.getElementById("email_edit");
              btn2.onclick = function() {
                modal2.style.display = "block";
              }
              var modal3 = document.getElementById("show-password");
              var btn3 = document.getElementById("pass_edit");
              btn3.onclick = function() {
                modal3.style.display = "block";
              }
              var modal4 = document.getElementById("show-gender");
              var btn4 = document.getElementById("gender_edit");
              btn4.onclick = function() {
                modal4.style.display = "block";
              }
              var modal5 = document.getElementById("delete_account");
              var btn5 = document.getElementById("delete_btn");
              btn5.onclick = function() {
                modal5.style.display = "block";
              }
            </script>
            <script>
              if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
              }
            </script>


</body>

</html>

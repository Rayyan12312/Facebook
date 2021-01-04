<?php
include('connection.php');
session_start();
if(!(isset($_SESSION['email'])))
{
  header("location:Facebook.php");
}
if(! isset($_POST['search-btn']))
{
  header("location:Home.php");
}
$email=$_SESSION['email'];
$userid=$_SESSION['UserID'];
$search_name=$_POST['srch-term'];
$query="SELECT FirstName,LastName,Gender,UserID FROM user Where (FirstName='$search_name' OR LastName='$search_name') AND Email !='$email'";
// $query="SELECT * FROM profile WHERE FirstName='$search_name' OR LastName='$search_name'";
$results=mysqli_query($conn,$query);
if(isset($_POST['add']))
{
  $check=mysqli_query($conn,"SELECT * FROM isfriend where User2='$uid' AND User1='$userid'");
  if(mysqli_num_rows($check)==0)
  {
    mysqli_query($conn,"INSERT INTO isfriend VALUES ('$userid',1,'$uid')");
  }
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Search</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/facebook.css">
    <link rel="icon" href="https://icons.iconarchive.com/icons/custom-icon-design/flatastic-1/512/search-icon.png">
<style>
  .search-result{
    margin:0px;
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
                   <div class="panel-heading"><i class="pull-right"><img src="https://icons.iconarchive.com/icons/custom-icon-design/flatastic-1/512/search-icon.png" style=" height:40px;"></i>
                     <h4>Search Results</h4>
                   </div>
                   <div class="panel-body">
                     <?php if(!(mysqli_num_rows($results))) {?>
                       <p style="font-size:18px;"><?php echo "No result found"; ?></p>
                     <?php } ?>
                     <?php while($row=mysqli_fetch_array($results)){ ?>
                       <?php
                        $u=$row['UserID'];
                        $data=mysqli_query($conn,"SELECT * from profile_picture where UserID='$u' AND active=1 ");
                        if(mysqli_num_rows($data))
                        {
                          $pic_row=mysqli_fetch_array($data);
                          $pic=$pic_row['Picture'];
                        }
                        else{
                          $pic="default.png";
                        }

                       ?>
                       <a href="#"></a>
                    <div class="search-result">
                    <img style="border-radius:50%;" src="<?php echo $pic; ?>" alt="" height="100" width="100">
                    <a href="Person.php?help=<?php echo $row['UserID']; ?>">
                    <h4 style="display:inline-block; position:absolute; margin-left:15px; margin-top:15px;"><?php echo $row['FirstName']." ".$row['LastName']; ?></h4>
                    </a>
                    <p style="display:inline-block; margin-left:15px; color:blue;"><?php echo $row['Gender']; ?></p>
                      </div>
                      <br>
                      <hr>
                    <?php } ?>

                     </div>
                     </div>
                     </div>
                     </div>
                     </div>


  </body>
</html>

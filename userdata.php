<?php
  include('connection.php');
  session_start();
  if(! isset($_SESSION['username']))
  {
    header("location:admin_login.php");
  }
  $query="SELECT * FROM user ";
  $results=mysqli_query($conn,$query);
  $id=$_GET['id'];
  $profile_result=mysqli_query($conn,"SELECT * FROM profile WHERE UserID='$id'");
  $pic_result=mysqli_query($conn,"SELECT * FROM profile_picture WHERE UserID='$id'");
  $pro_row=mysqli_fetch_array($profile_result);
  $post_result=mysqli_query($conn,"SELECT * FROM post WHERE UserID='$id'");
 ?>
<html>
<head>
  <link rel="stylesheet" href="css/admin_styles.css">
  <title>User Data</title>
</head>

<body>

  <ul>
    <li><a href="admin.php">Users</a></li>
    <li><a href="admin.php">Search</a></li>
    <li class="logout"><a href="admin_logout.php">Logout</a></li>

  </ul>
  <div class="box" style="">
    <h1 style="color:black;">ADMINISTRATION</h1>
    <table class="container" style="padding:0px;">
      <thead>
      <tr>
      <th><h1>Nickname</h1> </th>
      <th> <h1>Education </h1>  </th>
      <th>  <h1>Hometown</h1> </th>
      <th> <h1>Relatioship Status  </h1> </th>
      <th> <h1>Number of Friends </h1> </th>
      <th> <h1>Number of Posts </h1>  </th>
      </tr>
      </thead>
      <tbody>
        <tr>
          <td> <?php echo $pro_row['Nickname']; ?> </td>
          <td><?php echo $pro_row['Education']; ?></td>
          <td><?php echo $pro_row['Hometown']; ?></td>
          <td><?php echo $pro_row['Relationship_status']; ?></td>
          <td><?php echo $pro_row['Number_of_friends']; ?></td>
          <td><?php echo $pro_row['Number_of_posts']; ?></td>
        </tr>
      </tbody>
    </table>
    <a href="deleteUserbyadmin.php?id=<?php echo $id; ?>" style="margin-left:30px; margin-top:40px;">
    <button type="button" name="button"> Delete User</button>
    </a>
    <h1 style="float:left; color:black; margin-right: 10px;">Bio :  </h2>
      <br>
    <h4 style="color:black;"> <?php echo $pro_row['Bio']; ?></h4><br>
    <br>
    <h1 style="margin:0px; padding:0px; color:red;">Profile Pictures</h1>
<br>
    <?php if(mysqli_num_rows($pic_result)) {?>
      <div class="" style="display:inline-block; margin-left:170px; width:75%;">
    <?php while($pic_row=mysqli_fetch_array($pic_result)){ ?>

        <img src=" <?php echo $pic_row['Picture'] ?> " alt="" height="200" width="200" style="border:solid; border-color:black;">

    <?php } ?>
    </div>
  <?php } else { ?>
      <h2 style="font-size:20px; color:black;">No pictures</h2>
  <?php } ?>
  <hr>
  <h1 style="color:green;">Posts</h1>
  <?php  while($post_row=mysqli_fetch_array($post_result)){   ?>

    <p style="color:black;">  <?php echo $post_row['Post_content']; ?> </p>
    <?php if($post_row['Post_Photo']!=""){ ?>
<center>
      <img src="<?php echo $post_row['Post_Photo'];?>" alt="" height="200" width="200">
</center>

    <?php } ?>
    <a href="deletePostbyadmin.php?pid=<?php echo $post_row['PostID']; ?> && id=<?php echo $id; ?>" style="text-decoration:none;">
    <button type="button" name="button" class="btn-danger pull-right"> Delete Post</button>
    </a>
  <?php } ?>
  </div>
</body>
</html>

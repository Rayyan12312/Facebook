<?php
session_start();
if(isset($_GET['log_out']))
{
  session_destroy();
  header("location:Facebook.php");
}
 ?>

<?php
require "header.php";

if (!isset($_SESSION['userID'])) {
  echo '<b> You are not logged in </b> </br>';
  echo 'Please <a href="login.php"> log in </a>';

}

if (isset($_SESSION['userID'])) {
  echo '<b> You are already logged in </b> </br>';
  echo 'Go back to <a href="index.php"> Home </a>';  
}


require "footer.php";
?>

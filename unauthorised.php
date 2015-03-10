<?php
require "header.php";

if (!isset($_SESSION['userID'])) {
  echo '<b> You are not logged in </b> </br>';
  echo 'Go back and <a href="login.php"> get a visa</a>';

}

if (isset($_SESSION['userID'])) {
  echo '<b> You are already logged in </b> </br>';
  echo 'Go back to <a href="index.php"> your country</a>';  
}


require "footer.php";
?>

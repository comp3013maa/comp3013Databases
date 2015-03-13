<?php
require "header.php"; //include file - require means must be there or give error, include() is can have it 

if (!isset($_SESSION['userID'])) {
	header('location: unauthorised.php?');	 
	
}


echo '
<form action = "upload.php" method = "POST" enctype"multiplart/form-data">
      <input type="file" name="file"> <br><br>
      <input type="submit" value"Submit">
</form>';

if(!isset($_FILES['file'])){
	echo 'not uploaded';
}
echo 'lol';

$directory = "ftp://waws-prod-am2-025.ftp.azurewebsites.windows.net/site/wwwroot/uploads/";

require "footer.php";
?>



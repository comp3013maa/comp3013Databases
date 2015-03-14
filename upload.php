<?php
require "header.php"; //include file - require means must be there or give error, include() is can have it 

if (!isset($_SESSION['userID'])) {
	header('location: unauthorised.php?');	 
	
}

if (isset ($_POST['uploaded'])){
	var_dump($_FILES['file']);

$conn_id = ftp_connect('waws-prod-am2-025.ftp.azurewebsites.windows.net')or die('could not connect');

$login_result = ftp_login($conn_id, 'comp3013maa\abbuz','FuckingCunt') or die('could not log in');
	
if (ftp_put($conn_id, 'site/wwwroot/uploads/'.$_FILES['file']['name'], $_FILES['file']['tmp_name'], FTP_BINARY))
{
 echo "successfully uploaded";
}
ftp_close($conn_id);
}

echo '
<form action = "upload.php" method = "POST" enctype = "multipart/form-data">
      <input type="file" name="file" id="file"> <br><br>
      <input type="submit" value="Submit" name = "uploaded">
</form>';


require "footer.php";
?>



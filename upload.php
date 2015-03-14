<?php
require "header.php"; //include file - require means must be there or give error, include() is can have it 

if (!isset($_SESSION['userID'])) {
	header('location: unauthorised.php?');	 
	
}

if (isset ($_POST['uploaded'])){
	var_dump($_FILES['file']);

$conn_id = ftp_connect('ftp://waws-prod-am2-025.ftp.azurewebsites.windows.net')or die('couldnt connect');

$login_result = ftp_login($conn_id, 'comp3013maa\abbuz',' FuckingCunt');
	
if (ftp_put($conn_id, 'ftp://waws-prod-am2-025.ftp.azurewebsites.windows.net/site/wwwroot/uploads/' , $_FILES['file']['tmp_name'], FTP_ASCII)) {
 echo "successfully uploaded";
}
/*	
$directory = "ftp://waws-prod-am2-025.ftp.azurewebsites.windows.net/site/wwwroot/uploads/";
$target = $directory . basename($_FILES['file']['name']);
if(move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
	echo 'file has successfully uplaoded';
}
else{
	echo 'failed';
	
}
*/
}

echo '
<form action = "upload.php" method = "POST" enctype = "multipart/form-data">
      <input type="file" name="file" id="file"> <br><br>
      <input type="submit" value="Submit" name = "uploaded">
</form>';


require "footer.php";
?>



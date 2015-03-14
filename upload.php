<?php
require "header.php"; //include file - require means must be there or give error, include() is can have it 

if (!isset($_SESSION['userID'])) {
	header('location: unauthorised.php?');	 
	
}

if (isset ($_POST['uploaded'])){
	var_dump($_FILES["file"]);
$directory = "ftp://waws-prod-am2-025.ftp.azurewebsites.windows.net/site/wwwroot/uploads/";
if(move_uploaded_file($_FILES['file']['tmp_name'], $directory)) {
	echo 'looool';
}
else{
	echo 'failed';
	
}
}
echo '
<form action = "upload.php" method = "POST" enctype"multiplart/form-data">
      <input type="file" name="file"> <br><br>
      <input type="submit" value"Submit" name = "uploaded">
</form>';



require "footer.php";
?>



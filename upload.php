<?php
require "header.php"; //include file - require means must be there or give error, include() is can have it 

if (!isset($_SESSION['userID'])) {
	header('location: unauthorised.php?');	 
	
}
/*
if (isset ($_POST['uploaded'])){
var_dump($_FILES['file']);
$filename = $_FILES['file']['name'];
$temp_name = $_FILES['file']['tmp_name'];

$conn_id = ftp_connect('waws-prod-am2-025.ftp.azurewebsites.windows.net')or die('could not connect');

ftp_login($conn_id, 'comp3013maa\abbuz','FuckingCunt') or die('could not log in');

ftp_chdir($conn_id, '/site/wwwroot/uploads/');

if (ftp_put($conn_id, $filename, $temp_name, FTP_ASCII))
{
 echo 'successfully uploaded';
}else{echo 'not uploaded';}
ftp_close($conn_id);
}
*/
if(isset($_POST["uploaded"])) {
$directory = "uploads/". basename($_FILES["file"]["name"]);

$uploadOk = 1;
$imageFileType = pathinfo($directory,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
/*
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
*/
// Check if file already exists
if (file_exists($directory)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["file"]["size"] > 2000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "txt" && $imageFileType != "doc" && $imageFileType != "pdf"
&& $imageFileType != "docx" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $directory)) {
        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
	
}
echo '
<form action = "upload.php" method = "POST" enctype = "multipart/form-data">
      <input type="file" name="file" id="file"> <br><br>
      <input type="submit" value="Submit" name = "uploaded">
</form>';


require "footer.php";
?>



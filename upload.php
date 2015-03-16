<?php
require "header.php"; //include file - require means must be there or give error, include() is can have it 

if (!isset($_SESSION['userID'])) {
	header('location: unauthorised.php?');	 
	
}
unlink('uploads/'.up1);
unlink('uploads/'.up2);
unlink('uploads/'.up3);
unlink('uploads/'.up);
unlink('uploads/'.up4);
unlink('uploads/'.up5);
unlink('uploads/'.up6.txt.txt);
unlink('uploads/'.'up6.txt');
unlink('uploads/'.up6.txt);
unlink('uploads/'.'up6');

if(isset($_POST['uploaded'])) {
	
$file = $_FILES['file']['name'];	
$directory = 'uploads/'. basename($file);
$validUpload = true;
$extension = pathinfo($directory,PATHINFO_EXTENSION);


$marker = 0;
while (file_exists($directory)) {
    $marker = $marker + 1;
    $directory = 'uploads/'.basename($file,'.'.pathinfo($file)['extension']) . $marker . '.' . $extension;
}//adds a number marker if file exists

if ($_FILES['file']['size'] > 2000000) {
    echo 'Cannot exceed 2MB. ';
    $validUpload = false;
}

if($extension != 'txt' && $extension != 'doc' && $extension != 'pdf' && $extension != 'docx') {
    echo 'Please ensure file is .txt, .docx, or .pdf. ';
    $validUpload = false;
}
if ($validUpload) {
 if (move_uploaded_file($_FILES['file']['tmp_name'], $directory)) {
        echo basename($file) . ' successfully uploaded.';
    }else{
        echo 'Upload error';
    }
} 
else {
	echo 'File not uploaded. Try again.';
}
}
echo '
<form action = "upload.php" method = "POST" enctype = "multipart/form-data">
      <input type="file" name="file" id="file"> <br><br>
      <input type="submit" value="Submit" name = "uploaded">
</form>';

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
require "footer.php";
?>



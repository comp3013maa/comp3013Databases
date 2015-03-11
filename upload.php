<?php
require "header.php"; //include file - require means must be there or give error, include() is can have it 
/*
if (!isset($_SESSION['userID'])) {
	header('location: unauthorised.php?');	 
	
}
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
*/
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	 	 // Check for an uploaded file:
	 	 if (isset($_FILES['upload'])) {
	 	 	
	 	 	 // Validate the type. Should be JPEG or PNG.
	 	 	 $allowed = array ('image/pjpeg',
'image/jpeg', 'image/JPG', 'image/
X-PNG', 'image/PNG', 'image/png',
'image/x-png');
	 	 	 if (in_array($_FILES['upload']
['type'], $allowed)) {
	 	 	
	 	 	 	 // Move the file over.
	 	 	 	 if (move_uploaded_file
($_FILES['upload']['tmp_name'],
"../uploads/{$_FILES['upload']
['name']}")) {
	 	 	 	 	 echo '<p><em>The file has
been uploaded!</em></p>';
	 	 	 	 } // End of move... IF.
	 	 	 	
	 	 	 } else { // Invalid type.
	 	 	 	 echo '<p class="error">Please
upload a JPEG or PNG image.</p>';
	 	 	 }
	
	 	 } // End of isset($_FILES['upload']) IF.
	 	 
	 	  // Check for an error:
	 	 if ($_FILES['upload']['error'] > 0) {
	 	 	 echo '<p class="error">The file could
not be uploaded because: <strong>';
	 	
	 	 	 // Print a message based upon the
error.
	 	 	 switch ($_FILES['upload']['error']) {
	 	 	 	 case 1:
	 	 	 	 	 print 'The file exceeds the
upload_max_filesize setting
in php.ini.';
	 	 	 	 	 break;
	 	 	 	 case 2:
	 	 	 	 	 print 'The file exceeds the
MAX_FILE_SIZE setting in the
HTML form.';
	 	 	 	 	 break;
	 	 	 	 case 3:
	 	 	 	 	 print 'The file was only
partially uploaded.';
	 	 	 	 	 break;
	 	 	 	 case 4:
	 	 	 	 	 print 'No file was uploaded.';
	 	 	 	 	 break;
	 	 	 	 case 6:
	 	 	 	 	 print 'No temporary folder
was available.';
	 	 	 	 	 break;
	 	 	 	 case 7:
	 	 	 	 	 print 'Unable to write to
the disk.';
	 	 	 	 	 break;
	 	 	 	 case 8:
	 	 	 	 	 print 'File upload stopped.';
	 	 	 	 	 break;
?>

<form action = "upload.php" method = "POST" enctype"multiplart/form-data">
      <input type="file" name="file"> <br><br>
      <input type="submit" value"Submit">
</form>

<?php
require "footer.php";
?>



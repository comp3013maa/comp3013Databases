<?php
require "header.php"; //include file - require means must be there or give error, include() is can have it 

if (!isset($_SESSION['userID'])) {
	header('location: unauthorised.php?');	 
	
}
unlink('uploads/'.'up.txt'); //to delete file

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

 $connection = mysqli_connect('eu-cdbr-azure-west-b.cloudapp.net','b6526a64c19791','5d020f59','comp3013')
	 or die('Error' . mysql_error());
	 $userID = $_SESSION['userID'];
	$query1 = 
	"SELECT groupID 
	FROM users
	WHERE userID = '$userID'
	";
	 
	 	$result1 = mysqli_query($connection,$query1) or die('Error' . mysql_error("$result1"));
	 	$row = mysqli_fetch_assoc($result1);
	 echo	$groupID = $row['groupID'];
	 echo	$filename =  basename($file);
	 
	$query2 = 
	 "INSERT INTO submissions(submissionName, groupID)
	 VALUES ('$filename', $groupID)";  
	 
	$result = mysqli_query($connection,$query2) or die(mysql_error("$result"));
	
	mysqli_close($connection);

}
echo '
<form action = "upload.php" method = "POST" enctype = "multipart/form-data">
      <input type="file" name="file" id="file"> <br><br>
      <input type="submit" value="Submit" name = "uploaded">
</form>';


require "footer.php";
?>



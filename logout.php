<html>

<head> 
	<title> Logged out </title>
</head>

<body>
<?php
  if(isset($_POST['logoutForm'])){ 
    session_destroy(); 
    echo 'logged out';  
    echo 'http://comp3013maa.azurewebsites.net/index.php'; 
  }
?>

</body>
</html>

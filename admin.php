

<?php
require "header.php"; 

echo '<a href="register.html">Add New User Form</a> <br />' ;
/*
$connection = mysqli_connect('eu-cdbr-azure-west-b.cloudapp.net','b6526a64c19791','5d020f59','comp3013')
	 or die('Error' . mysql_error());
	 
	$query = 
	 "SELECT * 
	  FROM users";  
	 
	$result = mysqli_query($connection,$query) or die('Error' . mysql_error());
	  
	while($row = mysqli_fetch_assoc($result)){ 
	echo $row['firstName'];
	echo $row['lastName'];	
}	
	 mysqli_close($connection);
*/
?>



<?php

 $connection = mysqli_connect('eu-cdbr-azure-west-b.cloudapp.net','b6526a64c19791','5d020f59','comp3013')
	 or die('Error' . mysql_error());
	 
	$query = 
	 "SELECT * 
	  FROM users";  
	 
	$result = mysqli_query($connection,$query) or die('Error' . mysql_error());
	  
	
echo '<div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
    Dropdown
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">';
  while($row = mysqli_fetch_assoc($result)){ 
   echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="#">'; echo $row['firstName'];
	
echo '	  </a></li>
  </ul>
</div>';

}
mysqli_close($connection);
?>

<?php
require "footer.php";
?>


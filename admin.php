<?php
require "header.php"; 

echo '<a href="register.html">Add New User Form</a> <br />' ;

$connection = mysqli_connect('eu-cdbr-azure-west-b.cloudapp.net','b6526a64c19791','5d020f59','comp3013')
	 or die('Error' . mysql_error());
	 
	 $query = 
	 "SELECT userID, userName 
	  FROM users";  
	 
	  $result = mysqli_query($connection,$query) or die('Error' . mysql_error());
	 

		$row = mysqli_fetch_assoc($result); 
		 
		
	 
	 	 
	 mysqli_close($connection);

?>


<div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
    Dropdown
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
       <li role="presentation"><a role="menuitem" tabindex="-1" href="#">$row</a></li>
  </ul>
</div>


<?php
require "footer.php";
?>

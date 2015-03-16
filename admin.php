

<?php
require "header.php"; 

if (empty($_GET)) {
	echo '
	<ul> 
		<li id = "indexList"> <a href = "admin.php?add" class="listLinks"> Add New User</a> </li>                  		
		<li id = "indexList"> <a href = "admin.php?browse" class="listLinks">Browse & Edit Users</a> </li>
		<li id = "indexList"> <a href = "admin.php?allocateGroups" class="listLinks">Allocate Groups </a></li>
		<li id = "indexList"> <a href = "admin.php?rankings" class="listLinks">Group Rankings </a></li>
	</ul>   
	';
}

if (isset($_GET['add'])) {
	echo '<a href="register.html">Add New User Form</a> <br />' ;

	
}

if (isset($_GET['browse'])) {
	/* DISPLAY USERS & Search bar - from other stuff  */
	
	/* Edit group allocation - List of users, list of groups dropdown - update sql query*/
	
	/* EDIT PERSONAL INFO*/
	
	echo 'ruff';
}

if (isset($_GET['allocateGroups'])) {
	echo 'Hey there';
}

if (isset($_GET['rankings'])) {

}

?>


<?php
require "footer.php";
?>


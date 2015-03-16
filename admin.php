

<?php
require "header.php"; 

function displayAssignedTo($groupID) {
	$connection = mysqli_connect('eu-cdbr-azure-west-b.cloudapp.net','b6526a64c19791','5d020f59','comp3013') or die('Error' . mysql_error());
	$sql = "SELECT assignedTo
		FROM groupassignments
		WHERE groupID = $groupID
		"; 
	$result = mysqli_query($connection, $sql) or die( mysqli_error($connection) );
	
	while ($row = mysqli_fetch_assoc($result) ) {
	 	echo '<td>' . htmlentities($row['assignedTo']) . '</td>';
	}
	mysqli_close($connection);
}


if (empty($_GET)) {
	// Overall structure found in the list below 
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
	/* Have an option to create a new group as well */
	
	/* EDIT PERSONAL INFO - admin panel code */
	
	echo 'ruff';
}

if (isset($_GET['allocateGroups'])) {
	// list of each group, and the ones they're assigned too 
	/*
	$connection = mysqli_connect('eu-cdbr-azure-west-b.cloudapp.net','b6526a64c19791','5d020f59','comp3013') or die('Error' . mysql_error());
	$sql = "SELECT groupID, assignedTo 
		FROM groupassignments"; 
	$result = mysqli_query($connection, $sql) or die( mysqli_error($connection) );
	$row = mysqli_fetch_assoc($result); 
	echo 'GroupID: ' . $row['groupID'] . 'AND AssignedTo:' . $row['assignedTo'];	
	mysqli_close($connection); */ 
	
?> 	

<h3> Group Allocations </h3> <br /> 
<p> List of current allocations: </p>	
<div class="well">
    <table class="table">
      <thead>
        <tr>
          <th>GroupID</th>
          <th>Assigned 1</th>
          <th>Assigned 2</th>
          <th>Assigned 3</th>
          <th style="width: 36px;"></th>
        </tr>
      </thead>
      <tbody>
	<?php
	
	$connection = mysqli_connect('eu-cdbr-azure-west-b.cloudapp.net','b6526a64c19791','5d020f59','comp3013') or die('Error' . mysql_error());
	$sql = "SELECT groupID
		FROM groupassignments
		ORDER BY groupID ASC";
	$result = mysqli_query($connection, $sql) or die( mysqli_error($connection) );
	while ($row = mysqli_fetch_assoc($result) ) {
		echo '<tr> <td>' . htmlentities($row['groupID']) . '</td>' . displayAssignedTo(($row['groupID']) . '</tr>';
	}
	mysqli_close($connection);
	
	?>	
      </tbody>
    </table>
</div>	

<?php 	

	// two dropdowns - groupid, assign to - submit button assigns as long as not already exisiting 
	// max 3 assigned 
} // end isset allocateGrpuos 

if (isset($_GET['rankings'])) {

}

?>


<?php
require "footer.php";
?>


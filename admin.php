<?php require "header.php"; 
require_once "include/sql_model.php";
$this->sql_model = new SQL_Model();

function displayAssignedTo($groupID, $connection) {
	
// possibly move to its own class, move sql query to one file,  tuan's structure
// then just have the gets (the view with functions in them - mvc) - DO EEET
	$groupID= mysqli_real_escape_string($connection, $groupID);
	$sql = "SELECT assignedTo FROM groupassignments WHERE groupID=$groupID"; 
	$result = mysqli_query($connection, $sql) or die( mysqli_error($connection) );
	$output = "";
	while ($row = mysqli_fetch_assoc($result) ) {
	 	$output .= '<td>' . htmlentities($row['assignedTo']) . '</td>';
	}
	return $output;
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
	
	// use helper classes like tuan? For validation like graham's slides? 
	
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
	echo $this->sql_model->getGroupAllocations(); 
	/* 
	$connection = mysqli_connect('eu-cdbr-azure-west-b.cloudapp.net','b6526a64c19791','5d020f59','comp3013') or die('Error' . mysql_error());
	$sql = "SELECT groupID
		FROM groupassignments
		ORDER BY groupID ASC";
	$result = mysqli_query($connection, $sql) or die( mysqli_error($connection) );
	$groupID = $row['groupID'];
	while ($row = mysqli_fetch_assoc($result) ) {
		echo '<tr> <td>' . htmlentities($groupID) . '</td>' . displayAssignedTo($groupID, $connection). '</tr>';
	} 
	mysqli_close($connection);
	*/ 
	
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


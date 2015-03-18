<?php require "header.php"; 
require_once "include/sql_model.php";
/* This file follows mvc - only deals with the view. sql_model is the model in our mvc and deals with our data */

if (empty($_GET)) {
	// Overall structure  
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

/* DISPLAY GROUP ALLOCATIONS AND ALLOW NEW ONES TO CREATED */
if (isset($_GET['allocateGroups'])) {
	// list of each group, and the ones they're assigned too 
?> 	

<h3> Group Allocations </h3> <br /> 
<h5> List of current allocations: </h5>	
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
	$sql_model = new SQL_Model();
	echo $sql_model->getGroupAllocations(); 
 // not closed as using again below	$sql_model->close();
	?>	
      </tbody>
    </table>
</div>	

<!-- CREATE A NEW GROUP ALLOCATION-->
<hr /> 
<h3> Allocate a New Group: </h3>	
<p> Note: A maximum of 3 groups can be allocated for review to one group</p>


<form class="form-horizontal" method="POST" action="users.php?add">
<fieldset>	
	<div class="form-group">
	  <label class="col-md-4 control-label" for="textinput">Username: </label>  
	  <div class="col-md-4">
	  	<input id="textinput" name="username" type="text" class="form-control input-md">
	  </div>
	</div>

	<div class="form-group">
	  <label class="col-md-4 control-label" for="textinput">Email: </label>
	  <div class="col-md-4">
	  	<input id="textinput" name="email" type="text" class="form-control input-md">
	  </div>
	</div>

	<div class="form-group">
			<label class="col-md-4 control-label" for="passwordinput">Password: </label>
			<div class="col-md-4">
	  			<input id="passwordinput" name="password1" type="password" class="form-control input-md">
  	</div>
	</div>

	<div class="form-group">
			<label class="col-md-4 control-label" for="passwordinput">Confirm Password: </label>
			<div class="col-md-4">
	  			<input id="passwordinput" name="password2" type="password" class="form-control input-md">
  	</div>
	</div>

	<!-- Button -->
	<div class="form-group">
			<label class="col-md-4 control-label" for="singlebutton"></label>
			<div class="col-md-4">
				<button type ="submit "id="singlebutton" name="register" class="btn btn-success"> Register </button>
			</div>
	</div>
</form>
<?php
$groupList = array(); 
$groupList = $sql_model->getGroups();  
$sql_model->close();

	
// var_dump($groupList); 

echo '<select name = "groupId">';
	for ($i=0; $i < count($groupList); $i++ )  {						

		echo "<option value =" . $groupList[$i] . ">" . $groupList[$i]. "</option>"; 						
echo '</select>'; 		
	}

echo '<select name = "AllocateTo">';
	for ($i=0; $i < count($groupList); $i++ )  {						

		echo "<option value =" . $groupList[$i] . ">" . $groupList[$i]. "</option>"; 	
		}					
echo '</select>'; 	
?> 

<?php
if(isset($_POST['newGroupAllocation'])) {
	
}

}  // end allocateGroups if 

if (isset($_GET['rankings'])) {

}

?>


<?php
require "footer.php";
?>


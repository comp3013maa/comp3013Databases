<?php require "header.php"; 
require_once "include/sql_model.php";
/* This file follows mvc - only deals with the view. sql_model is the model in our mvc and deals with our data */

if(!isset($_SESSION['admin']) ) {
	header('location: unauthorised.php?admin');	 
} 

if (empty($_GET)) {
	// Overall structure  
	echo '
        <div class="panel panel-primary">
            <div class="panel-heading">
              	<h3 class="panel-title">ADMIN</h3>
            </div>
            <div class="panel-body">
                    <ul> 
		<li id = "indexList"> <a href = "register.php" class="listLinks"> Add New User</a> </li>                  		
		<li id = "indexList"> <a href = "browse_users.php" class="listLinks">Browse & Edit Users</a> </li>
		<li id = "indexList"> <a href = "admin.php?allocateGroups" class="listLinks">Allocate Groups </a></li>
		<li id = "indexList"> <a href = "admin.php?rankings" class="listLinks">Group Rankings </a></li>                </ul>   
            </div>
        </div>  
    </div> ';
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
		$sql_model->close();
	 // not closed as using again below	$sql_model->close();
		?>	
	      </tbody>
	    </table>
	</div>	

	<!-- CREATE A NEW GROUP ALLOCATION-->
	<hr /> 
	<h3> Allocate a New Group: </h3>	
	<p> Note: A maximum of 3 groups can be allocated for review to one group</p>

	<?php
	$groupList = array(); 
	$sql_model2 = new SQL_Model();
	$groupList = $sql_model2->getGroups();
	$sql_model2->close();  
	?>

	<form class="form-horizontal" method="POST" action="admin.php?allocateGroups">
	<fieldset>	
		<div class="form-group">  
		  <label class="col-md-4 control-label" for="textinput">Chose a group to assign: </label>  
		  <div class="col-md-4">
			<select name = "groupID" class="form-control input-md">
				<?php
				for ($i=0; $i < count($groupList); $i++ )  {						
					echo "<option value =" . $groupList[$i] . ">" . $groupList[$i]. "</option>"; 	
					}		
				?>
			</select>		
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="textinput">Allocate To: </label>
		  <div class="col-md-4">
			<select name = "allocateTo" class="form-control input-md">
				<?php
				for ($i=0; $i < count($groupList); $i++ )  {						
					echo "<option value =" . $groupList[$i] . ">" . $groupList[$i]. "</option>"; 	
					}		
				?>
			</select>	
		  </div>
		</div>

		<!-- Button -->  
		<div class="form-group">  
				<label class="col-md-4 control-label" for="singlebutton"></label>
				<div class="col-md-4">
					<button type ="submit "id="singlebutton" name="newGroupAllocation" class="btn btn-success"> Assign Group </button>
				</div>
		</div>
	</form>

	<?php
	if(isset($_POST['newGroupAllocation'])) {
		$sql_model3 = new SQL_Model();
		echo $sql_model3->newGroupAllocation($_POST['groupID'], $_POST['allocateTo']);  
		$sql_model3->close();
	}
}  



if (isset($_GET['rankings'])) {
	echo '<h3>Group Rankings</h3> <br />
	<p> Groups Ranked according to an aggregation of score (an average of scores): </p>  ';
	$sql_model = new SQL_Model();
	echo $sql_model->getGroupAverageScores();
	$sql_model->close();	
		
	echo'	<hr />
	<p> These groups are ranked according with the aggregation of peer assessments on their submissions 
	(from point 12 - a little vague so we did it through both an aggregation of scores as above and assessement numbers as here). </p>
	'; 
	$sql_model2 = new SQL_Model();
	echo $sql_model2->adminGetGroupRankings();
	$sql_model2->close();
}

?>


<?php
require "footer.php";
?>


<?php

require_once "header.php";
require_once "include/sql_model.php";
include_once "include/helper_functions.php";

if(!isset($_SESSION['admin']) ) {
	header('location: unauthorised.php?admin');	 
} 
?>
<h3> Browse users </h3> <br /> 


<form method="post" action="browse_users.php">
<div class="col-md-4">
	<input id="textinput" name="searchUser" type="text" class="form-control input-md">
</div> 	
<button type ="submit "id="singlebutton" name="completedsearch" class="btn btn-success"> Search for a user </button>
</form>
<br /> 

<?php
if(isset($_POST['completedsearch']))
{
   	$sql_model = new SQL_Model();
    echo $sql_model->userSearch($_POST['searchUser']);
    $sql_model->close();
}
?>


<h4> List of all current users: </h4>

<div class="well">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Name</th>  
          <th>Email</th>
          <th>Group ID</th>
          <th>Admin</th>
          <th>Joined On </th>
          <th style="width: 36px;"></th>
        </tr>
      </thead>
      <tbody>
		<?php
			$conx = dbConnect(); /* db connection */
			$output = "";

			$sql = "SELECT userID, userName, firstName, lastName, email, groupID, admin, joinedOn
			FROM users"; 
			$result = mysqli_query($conx, $sql) or die( mysqli_error($conx) );
			
			while ($row = mysqli_fetch_assoc($result) ) {
				$output.= '
		        <tr>
		          <td>' . htmlentities($row['userID']) . '</td>
		          <td>' . htmlentities($row['userName']) . '</td>
		          <td>' . htmlentities($row['firstName']) . ' ' . htmlentities($row['lastName']) .  '</td>		          
		          <td>' . htmlentities($row['email']) . '</td>
		          <td>' . htmlentities($row['groupID']) . '</td>';
		          if ($row['admin'] == 0) {
		          	$output .= '<td> No </td>'; 
		          }
		          else if ($row['admin'] == 1) {
					$output .= '<td> Yes </td>'; 		          	
		          }	

		          $output .= '<td>' . htmlentities($row['joinedOn']) . '</td>

		        </tr>';
			}
			echo $output;
		?>	
      </tbody>
    </table>
</div>

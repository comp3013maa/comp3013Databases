<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Create New User</title>
</head>
  
<body>
<?php
require_once "header.php";
require_once "include/sql_model.php";
include_once "include/helper_functions.php";

if(!isset($_SESSION['admin']) ) {
	header('location: unauthorised.php?admin');	 
} 

/*******  Check the submitted new user form  ********/
if (isset($_POST['register'])) {
	require_once('include/connection_details.php'); 
	$conx= dbConnect(); /* db connection */

	/* Create blank arrays to put clean/erroroneous data into once chekced. clean = filtered, mysql = escaped mysql output (suitable for input to db) */
	$clean = array(); $mysql = array(); $error = array(); $trimmed = array();
	$mysql['username'] = $mysql['email'] = $mysql['password'] = FALSE;


	//************ USERNAME ************** //
	$trimmed['username'] = trim($_POST['username']); /* trim extra whitespaces */
	
	/* Start with a letter, 1-15 characters, Letters and numbers only. Twitter allows letters, numbers, underscores. pg 443 of php & mysql by Larry Ullman -> \w represents all these. */ 
	/* Regular expression syntax: / / -delimiters. ^ -beginning of string. $ -end of string. {1,14} as [A-Za-z] takes one char too.  */ 
	if (preg_match('/^[A-Za-z][A-Za-z0-9]{0,14}$/' , $trimmed['username'])) {
		$clean['username'] =  $trimmed['username'];
		$mysql['username'] = mysqli_real_escape_string($conx, $trimmed['username']); 
	}		
	else {
		$error['username'] = "Error: Username can be 1 to 15 characters, and can be either letters or numbers only. The first character must be a letter."; 
	}

	//************ EMAIL ************** //
	$trimmed['email'] = trim($_POST['email']);
	if( filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)) {
		$clean['email'] = $trimmed['email']; 
		$mysql['email'] = mysqli_real_escape_string($conx, $clean['email']); 
	}
	else {
		$error['email'] = 'Error: Invalid Email';
	}

	//************ PASSWORD ************** //
	$trimmed['password1'] = trim($_POST['password1']); $trimmed['password2'] = trim($_POST['password2']); 
	
	/* Follow twitter. 6 Characters min. 6 requires letter + number. 7 Characters can be just letters. Max 20 characters. Allows special characters. */
	$letter = preg_match('/[A-Za-z]/', $trimmed['password1']);
	$number = preg_match('/[0-9]/', $trimmed['password1']);
	$letters_numbers = preg_match('/[A-Za-z0-9]/', $trimmed['password1']);
	
	$condition1 = strlen($trimmed['password1']) == 6 && $letter && $number; // 6 needs a letter and number 
	$condition2 = strlen($trimmed['password1']) > 6 && strlen($trimmed['password1']) <= 20 && $letters_numbers; 
	if( $condition1 || $condition2 ) {
		if ($trimmed['password1'] == $trimmed['password2']) {
			$clean['password'] = $trimmed['password1'];
			$mysql['password'] = mysqli_real_escape_string($conx, $clean['password']); 
		}
		else {
			$error['password'] = 'Your passwords do not match!'; 
		}
	}
	else {
		if(!$condition2) {
			$error['password'] = 'Password needs to be between 6 to 20 characters and contain at least one letter or number';
		} 
		else if (!$condition1) {
			$error['password'] = 'Password needs to contain at least one letter and one number';
		}
	}

	//************ AVAILABILITY OF USERNAME/EMAIL + INSERT IF AVAILABLE  ************** //
	if ($mysql['username'] && $mysql['email'] && $mysql['password']) {
		$usernameAvailable = $emailAvailable = FALSE; 
		
		/* Check username available */
		$username_check = $mysql['username'];
		$sql = "SELECT userID FROM users WHERE userName='$username_check'"; // mysql is case insensitive
		$result = mysqli_query($conx, $sql) or die ( "Username exist check db error: " . mysqli_error($conx) );
		if (mysqli_num_rows($result) == 0) {
			$usernameAvailable = TRUE;
		}
		else {
			$error['username'] = 'Username is not available'; 
		}
		
		/* Check email available */
		$email_check = $mysql['email'];
		$sql = "SELECT userID FROM users WHERE email='$email_check'"; // mysql is case insensitive
		$result = mysqli_query($conx, $sql) or die ( "Email exist check db error: " . mysqli_error($conx) );
		if (mysqli_num_rows($result) == 0) {
			$emailAvailable = TRUE;
		}
		else {
			$error['email'] = 'Email has already been used'; 
		}
		
		/* Both available, insert. */
		if ($usernameAvailable && $emailAvailable) {

			/* Use SHA512 to hash passwords. */
			$hash = hash('sha512', $mysql['password']); /* hexit hash 128 chars */
			$usernameInsert =  $mysql['username']; $emailInsert = $mysql['email'];  //assoc array doesnt work, so new values..
			$hash = mysqli_real_escape_string($conx, $hash);
			$firstName = mysqli_real_escape_string($conx, $_POST['firstname']);
			$lastName = mysqli_real_escape_string($conx, $_POST['lastname']);			
			$admin = $_POST['admin']; $groupInsert = $_POST['groupID'];
			
			$sql = "INSERT INTO users 
					(firstName, lastName, userName, password, email, groupID, joinedOn, admin)
					VALUES
					('$firstName', '$lastName','$usernameInsert', '$hash','$emailInsert', '$groupInsert', NOW(), $admin) 
					";
			$result = mysqli_query($conx, $sql) or  trigger_error( "Reg Values correct but could not insert into db: " . mysqli_error($conx) );
			if( mysqli_affected_rows($conx) == 1) {					

				/* Succesful, output message. */
				echo successMessage('Success Message', 'Success: New user succesfully added! Please go to the <a href="browse_users.php">user list </a> page to see a list of all users. ');
			}
		}
	} 
	mysqli_close($conx);		
} // end if $_POST['register']

/* error messages if any from previous submission */
if(isset($error['username']) || isset($error['email']) || isset($error['password']) ) {
	echo'
	<div class="row">
  	<div class="col-md-6 col-md-offset-3">
      <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×</button>
            <span class="glyphicon glyphicon-hand-right"></span> <strong>Error Message</strong>
            <hr class="message-inner-separator">
            <p>';  
            if(isset($error['username']) ) {
				echo '- ' . $error['username'] . '<br />';
			}
			if(isset($error['email']) ) {
				echo '- ' . $error['email'] . '<br />';
			}
			if(isset($error['password']) ) {
				echo '- ' . $error['password'] . '<br />';
			}		

    echo '</p>
        </div>
    </div>
</div>';    

} 	
?>




<h3> Add User </h3> <br /> 

<form class="form-horizontal" method="POST" action="register.php">
<fieldset>	
	<div class="form-group">
	  <label class="col-md-4 control-label" for="textinput">Username: </label>  
	  <div class="col-md-4">
	  	<input id="textinput" name="username" type="text" class="form-control input-md">
	  </div>
	</div>

	<div class="form-group">
	  <label class="col-md-4 control-label" for="textinput">First Name: </label>  
	  <div class="col-md-4">
	  	<input id="textinput" name="firstname" type="text" class="form-control input-md">
	  </div>
	</div>		

	<div class="form-group">
	  <label class="col-md-4 control-label" for="textinput">Last Name: </label>  
	  <div class="col-md-4">
	  	<input id="textinput" name="lastname" type="text" class="form-control input-md">
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

	<div class="form-group">
	  <label class="col-md-4 control-label" for="textinput">Assign To Group: </label>  
	  <div class="col-md-4">
		<select name = "groupID" class="form-control input-md">
			<?php
			$groupList = array(); 
			$sql_model2 = new SQL_Model();
			$groupList = $sql_model2->getGroups();
			$sql_model2->close();  				
			for ($i=0; $i < count($groupList); $i++ )  {						
				echo "<option value =" . $groupList[$i] . ">" . $groupList[$i]. "</option>"; 	
				}		
			?>				
		</select>		
	  </div>
	</div>		

	<div class="form-group">
	  <label class="col-md-4 control-label" for="textinput">Make Admin: </label>  
	  <div class="col-md-4">
		<select name = "admin" class="form-control input-md">	
			<option value ="0"> No</option>			
			<option value ="1"> Yes</option>				
		</select>		
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


<hr />
<h3> Define Groups From Registration List  </h3> <br /> 


<?php
if (isset($_POST['editUserGroup'])) {

	$sql_model5 = new SQL_Model();
	$sql_model5->editUserGroup($_POST['userToModify'], $_POST['groupID']);
	$sql_model5->close();  	
}

?>



<form class="form-horizontal" method="POST" action="register.php">
<fieldset>	

	<div class="form-group">
	  <label class="col-md-4 control-label" for="textinput">User: </label>  
	  <div class="col-md-4">
		<select name = "userToModify" class="form-control input-md">
			<?php
			$groupList = array(); 
			$sql_model3 = new SQL_Model();
			$userList = $sql_model3->getUsers();
			$sql_model3->close();  				
			for ($i=0; $i < count($userList); $i++ )  {						
				echo "<option value =" . $userList[$i]['userID'] . ">" . $userList[$i]['userName']. "</option>"; 	
			}		
			?>				
		</select>		
	  </div>
	</div>	

	<div class="form-group">
	  <label class="col-md-4 control-label" for="textinput">Assign To Group: </label>  
	  <div class="col-md-4">
		<select name = "groupID" class="form-control input-md">
			<?php
			$groupList = array(); 
			$sql_model4 = new SQL_Model();
			$groupList = $sql_model4->getGroups();
			$sql_model4->close();  				
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
				<button type ="submit "id="singlebutton" name="editUserGroup" class="btn btn-success"> Modify Group </button>
			</div>
	</div>
</form>


</body>

</html>

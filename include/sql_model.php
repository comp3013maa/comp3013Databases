<?php
require_once"connection_details.php"; 
include_once "helper_functions.php";

class SQL_Model {

/*
* Using prepared statements 
$stmt = $dbConnection->prepare('SELECT * FROM employees WHERE name = ?');
$stmt->bind_param('s', $name);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) { }
*/
  
public function __construct() {
   $this->conn = dbConnect();
}

public function close() {
	closeDB($this->conn);
}

/* Gets the users groupID
* @param: int userid @return int groupID
*/
public function getUsersGroupID($userid) {
	$stmt = $this->conn->prepare("SELECT groupID FROM users WHERE userID=?");
	$stmt->bind_param("i", $userid);
	$stmt->execute(); 
	$result = $stmt->get_result();
	$row = $result->fetch_assoc(); 
	$stmt->free_result();
    $stmt->close();
	return $row['groupID'];
} 

/* Return list of all groups */ 
public function getGroups() {
	$stmt = $this->conn->prepare("SELECT groupID FROM groups ORDER BY groupID ASC ");
	$stmt->execute(); 
	$result = $stmt->get_result();
	$groupList = array(); $n = 0;
	while ($row = $result->fetch_assoc()) {
		$groupList[$n] = $row['groupID'];
		$n++;
	}	
	$stmt->free_result();
        $stmt->close();
	return $groupList;
}

/* Get assigned groups for a group ID - used in getGroupAllocations()
* @params: int - $groupID, @return: string - $output */

public function getAssignedTo($groupID) {
	$stmt = $this->conn->prepare("SELECT assignedTo FROM groupassignments WHERE groupID=?");
	$stmt->bind_param("i", $groupID);	
 	$stmt->execute(); $result = $stmt->get_result();
	$row = array(); $output = "";
	while ($row = $result->fetch_assoc()) {
	 	$output .= '<td>' . htmlentities($row['assignedTo']) . '</td>';
	}
	
	$stmt->free_result();
        $stmt->close();	
	return $output;
}

/*  Get group allocations list 
*   @params: none @return: string - $ouptput
*/
public function getGroupAllocations() {
	$stmt = $this->conn->prepare("SELECT groupID
	FROM groupassignments
	GROUP BY groupID	
	ORDER BY groupID ASC ");
	// $stmt->bind_param('s', $name);

    if ($stmt->execute()) {
		$result = $stmt->get_result();
		$row = array(); $output = "";
		while ($row = $result->fetch_assoc()) {
			
		// $output .= '<tr> <td>' . htmlentities($row['groupID']) . '</td>/tr>';
		$output .= '<tr> <td>' . htmlentities($row['groupID']) . '</td></td>' . $this->getAssignedTo($row['groupID']) . '</td></tr>';
		}
		
		$stmt->free_result();
	        	$stmt->close();
		return $output; 
    } 
    else {
		die("An error occurred performing the request");
	}
}

/*  Assigns the $groupID to make the reports of $allocateTo - 3 validation checks - max assignments per group 
*   @params: int $groupID, int $allocateTo 
*   @return: string - $message (success or error)
*/

public function newGroupAllocation($groupID, $allocateTo) {
			
	$errorMessage = ""; $message = "";
	$check1 = FALSE; $check2 = FALSE; $check3 = FALSE; 

	// 1. check not existing 
	$stmt = $this->conn->prepare("SELECT groupID FROM groupassignments WHERE groupID=? AND assignedTo=?");
	$stmt->bind_param("ii", $groupID, $allocateTo);	
	$stmt->execute();
	$stmt->store_result();	// needed for num_rows to work properly
	if ($stmt->num_rows == 1) {
		$message .= "Error: This group assignment already exists <br />";
	} 
	else {
		$check1 = TRUE; 
	}

	$stmt->free_result(); $stmt->close();

	// 2. check each groupID isn't assigned to more than 3 groups
	$stmt = $this->conn->prepare("SELECT assignedTo FROM groupassignments WHERE groupID=?");
	$stmt->bind_param("i", $groupID);	
	$stmt->execute();

	$stmt->store_result();	
	if ($stmt->num_rows >= 3) {
		$message .= "Error: That group cannot be assigned to more than three groups <br />";		
	}
	else {
		$check2 = TRUE; 
		// $message .= 'Check 2:' . $check2 . '<br />';
	}	

	$stmt->free_result(); $stmt->close();

	// 3. check each allocateTo hasn't got more than 3 groups managing it 
	$stmt = $this->conn->prepare("SELECT groupID FROM groupassignments WHERE  assignedTo=?");
	$stmt->bind_param("i", $allocateTo);	
	$stmt->execute();
	$stmt->store_result();	

	if ($stmt->num_rows >= 3) {
		$message .= "Error: That group already has the maximum amount of markers. A group cannot be marked by more than three groups <br />";		
	}
	else {
		$check3 = TRUE; 
		// $message .= 'Check 3:' . $check3 . '<br />';	
	}	
	$stmt->free_result(); $stmt->close();

	if (($check1 && $check2 && $check3) == TRUE)  {
		$stmt = $this->conn->prepare("INSERT INTO groupassignments (groupID, assignedTo) VALUES(?,?)");
        $stmt->bind_param("ii", $groupID, $allocateTo);
        
        if ($stmt->execute()) {
    			$message .= 'Succesfully allocated group ' . $groupID . ' to mark group ' . $allocateTo . '. <br />';
    			$stmt->close(); 
				return successMessage("Success", $message);
        }
      	else { return errorMessage("Database Error", "Error Inserting Values into the Database"); }
	} 
	else 
	{
		return errorMessage("Error:", $message);

	}
}

/* Return list of all groups */ 
public function getUsers() {
	$stmt = $this->conn->prepare("SELECT userID, userName FROM users ORDER BY userID ASC ");
	$stmt->execute(); 
	$result = $stmt->get_result();
	$userList = array(); $i = 0;
	while ($row = $result->fetch_assoc()) {
		$userList[$i]['userID'] = $row['userID'];
		$userList[$i]['userName'] = $row['userName'];
		$i++;
	}	
    $stmt->close();
	return $userList;
}

/*  Edits the users current group id
*   @params: int $userToModify, int $groupToAssign 
*   @return: string - $message (success or error)
*/

public function editUserGroup($userToModify, $groupToAssign) {
		$stmt = $this->conn->prepare("UPDATE users SET groupID = ? WHERE userID =?");
        $stmt->bind_param("ii", $groupToAssign, $userToModify);
        
        if ($stmt->execute()) {
        	 $stmt->close();
        	return successMessage("Succes", "Succesfully modified users group");
        }	
        else {      $stmt->close(); return errorMessage("Error", "Could not update users group");  }
}

/*  Search for a user based on a search term 
*   @params: string $searchTerm
*   @return: string - $message 
*/

public function userSearch($searchTerm) {
	$searchTerm = trim($searchTerm);
	// prepared statemens makes safeh
	$stmt = $this->conn->prepare(
	"SELECT userID, userName, firstName, lastName, email, groupID, admin, joinedOn
	FROM users WHERE userName LIKE ? OR firstName LIKE ? OR lastName LIKE ? OR email like ?");
	$stmt->bind_param("ssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm);	
	$stmt->execute(); $output = "";
 	// $stmt->store_result();		
 	$result = $stmt->get_result();	
	// $sql = mysql_query("SELECT * FROM your_table WHERE condition1 LIKE '%{$term}%' OR condition2 LIKE '%{$term}%' OR condition3 LIKE '%{$term}%' OR condition4 LIKE '%{$term}%' "); 
	
	if ($result->num_rows >= 1) {
		
		$output.= '<div class="well">
	    <table class="table">
	      <thead>
	        <tr>
	          <th>ID</th>
	          <th>Username</th>
	          <th>Name </th>  
	          <th>Email</th>
	          <th>Group ID</th>
	          <th>Admin</th>
	          <th>Joined On </th>
	          <th style="width: 36px;"></th>
	        </tr>
	      </thead>
	      <tbody>';

		while ($row = $result->fetch_assoc()) {
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
		$output .= '</tbody></table></div>';

	}	
	else {
		$output .= 'Numrows is ' . $stmt->num_rows . '<br />';
		$output .= errorMessage("No Results", "No users match the term entered");
	}	
    
    $stmt->close();
	return $output; 
}

/*  Logs a user in or returns an error  
*   @params: string $user, string $password
*/

public function login($username, $password) {
	$password = hash('sha512', $password); // hash password 
	$stmt = $this->conn->prepare("SELECT userID, userName FROM users  WHERE userName = ? AND password = ?");
	$stmt->bind_param("ss", $username, $password);	
	$stmt->execute();
	$success = FALSE; 
 	$result = $stmt->get_result();	
	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();		
		$_SESSION['userID'] = $row['userID']; 
		$_SESSION['userName'] = $row['userName'];
		// setcookie("userName", $_SESSION['userName'], time() +3600); 
		return $success = TRUE; 
	} 
	else {
		echo errorMessage("Error Message", "Invalid username or password. Please go back and try again." );
	}
	$stmt->close();	
}

/*  Creates an admin session variable   
*   @params: int $userID
*/
public function authenticateAdmin($userID) {
	$stmt = $this->conn->prepare("SELECT admin FROM users  WHERE userID = ?");
	$stmt->bind_param("i", $userID);	
	$stmt->execute();
 	$result = $stmt->get_result();	
	$row = $result->fetch_assoc();	
	if ($row['admin'] == 1) {
		$_SESSION['admin'] = $row['admin']; 
	}		
	$stmt->close();	 
}

/*  Point 12 in the list of things to do - 12.  see a list of the groups ranked according with the aggregation of peer assessments on their submissions
*   @return: string $output
*/
public function adminGetGroupRankings() {
	$stmt = $this->conn->prepare("SELECT groupID, count(groupID) as aggregatePeerAssessments
								FROM submissions
								INNER JOIN grade
								ON submissions.submissionID = grade.submissionID
								GROUP BY groupID
								ORDER BY aggregatePeerAssessments DESC ");
	$stmt->execute();
 	$result = $stmt->get_result();	
 	$output = 	
 	'<div class="well">
	    <table class="table">
	      <thead>
	        <tr>
	          <th>Group ID</th>
	          <th>Aggregate Peer Assesememnts</th>
	          <th style="width: 36px;"></th>
	        </tr>
	      </thead>
	      <tbody>';
	while ($row = $result->fetch_assoc()) {
		$output.= '
	    <tr>
	      <td>' . htmlentities($row['groupID']) . '</td>
	      <td>' . htmlentities($row['aggregatePeerAssessments']) . '</td>
	    </tr>';			
	}	
	$output .= '</tbody></table></div>';
 	$stmt->close();
 	return $output;
}

public function getGroupAverageScores() {
	$stmt = $this->conn->prepare("
	SELECT submissions.groupID, AVG(grade) as AverageGrade
	FROM grade
	INNER JOIN submissions
	ON submissions.submissionID = grade.submissionID
	GROUP BY grade.submissionID ");
	$stmt->execute();
 	$result = $stmt->get_result();	
 	$output = 	
 	'<div class="well">
	    <table class="table">
	      <thead>
	        <tr>
	          <th>Group ID</th>
	          <th>Aggregate Peer Assesememnts</th>
	          <th style="width: 36px;"></th>
	        </tr>
	      </thead>
	      <tbody>';
	while ($row = $result->fetch_assoc()) {
		$output.= '
	    <tr>
	      <td>' . htmlentities($row['groupID']) . '</td>
	      <td>' . htmlentities($row['AverageGrade']) . '</td>
	    </tr>';			
	}	
	$output .= '</tbody></table></div>';
 	$stmt->close();
 	return $output;	
}

} // end class	

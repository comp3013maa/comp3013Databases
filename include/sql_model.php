<?php
require_once "config.php";

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
   $this->conn = DbConnect();
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
			
	$errorMessage = ""; 
	$check1 = FALSE; $check2 = FALSE; $check3 = FALSE; 


	// 1. check not existing 
	$stmt = $this->conn->prepare("SELECT groupID FROM groupassignments WHERE groupID=? AND assignedTo=?");
	$stmt->bind_param("ii", $groupID, $allocateTo);	
	$stmt->execute();
	if ($stmt->num_rows == 1) {
		$message .= "This assignment already exists <br />";
	} 
	else {
		$check1 = TRUE; 
	}

	$stmt->free_result(); $stmt->close();

	// 2. check each groupID isn't assigned to more than 3 groups
	$stmt = $this->conn->prepare("SELECT assignedTo FROM groupassignments WHERE groupID=?");
	$stmt->bind_param("i", $groupID);	
	$stmt->execute();
	if ($stmt->num_rows >= 3) {
		$message .= "A group cannot be assigned to more than three groups <br />";		
	}
	else {
		$check2 = TRUE; 
	}	

	$stmt->free_result(); $stmt->close();

	// 3. check each allocateTo hasn't got more than 3 groups managing it 
	$stmt = $this->conn->prepare("SELECT groupID FROM groupassignments WHERE  assignedTo=?");
	$stmt->bind_param("i", $allocateTo);	
	$stmt->execute();
	if ($stmt->num_rows >= 3) {
		$message .= "A group cannot be marked by more than three groups <br />";		
	}
	else {
		$check3 = TRUE; 
	}	
	$stmt->free_result(); $stmt->close();

	if (($check1 && $check2 && $check3) == TRUE)  {

		$message .= 'Succesfully allocated group ' . $groupID . ' to mark group ' . $allocateTo . '. <br />';
		return $message;
	} 
	else {
		return $message;
	}
}

} // end class	

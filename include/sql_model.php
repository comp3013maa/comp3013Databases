<?php
require_once "config.php";

class sql_model {

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

    /*
    *   Get group allocations list 
    *   @params: none 
    *   @return: 
    */
public function getGroupAllocations() {
	$stmt = $this->conn->prepare("SELECT groupID
	FROM groupassignments
	ORDER BY groupID ASC");
	// $stmt->bind_param('s', $name);

        if ($stmt->execute()) {
		$result = $stmt->get_result();
		$row = array(); $output = "";
		while ($row = $result->fetch_assoc()) {
			$output= '<tr> <td>' . htmlentities($groupID) . '</td></tr>';     // . displayAssignedTo($groupID, $connection). '</tr>';
		}
		
		$stmt->free_result();
            	$stmt->close();
		return $output; 
        } 
        else {
		die("An error occurred performing the request");
	}
}




} // end class	

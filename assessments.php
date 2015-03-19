<?php
require "header.php"; 

if(!isset($_SESSION['userID'])){
	header('location: unauthorised.php?');
}

echo '<p><h3>View Assessments</h3></p>'.'<p>You are graded by groups </p>'.;


$connection = mysqli_connect('eu-cdbr-azure-west-b.cloudapp.net','b6526a64c19791','5d020f59','comp3013')
	 or die('Error1' . mysqli_error($connection));
	 
 $userID = $_SESSION['userID'];
	 
	 $query1 = "
                SELECT groupID 
                FROM users 
          	WHERE userID=$userID
	        ";
	
$result1 = mysqli_query($connection,$query1) or die('Error2' . mysqli_error($connection));
$row1 = mysqli_fetch_assoc($result1);
$groupID = $row1['groupID'];	 

$query = "
        SELECT grade, comments, byGroup
        FROM grade
        INNER JOIN groupassignments
	ON grade.byGroup = groupassignments.groupID
        WHERE groupassignments.assignedTo = $groupID
          ";
          
$result = mysqli_query($connection,$query) or die('Error2' . mysqli_error($connection));
        while($row = mysqli_fetch_assoc($result)){
                echo $row['byGroup'];
                echo $row['comments'];
                echo $row['grade'];
        }
        
          
          
mysqli_close($connection);

require "footer.php";
?>

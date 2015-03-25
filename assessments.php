<?php
require "header.php"; 

if(!isset($_SESSION['userID'])){
	header('location: unauthorised.php?');
}

$connection = mysqli_connect('eu-cdbr-azure-west-b.cloudapp.net','b6526a64c19791','5d020f59','comp3013')
	 or die('Error1' . mysqli_error($connection));
	 
$userID = $_SESSION['userID'];
$userID =  mysqli_real_escape_string($connection, $userID);
	 $query1 = "
                SELECT groupID 
                FROM users 
          	WHERE userID=$userID
	        ";
	
$result1 = mysqli_query($connection,$query1) or die('Error1' . mysqli_error($connection));
$row1 = mysqli_fetch_assoc($result1);
$groupID = $row1['groupID'];	 
$groupID =  mysqli_real_escape_string($connection, $groupID);

$query = "
        SELECT grade, comments, byGroup
        FROM grade
        INNER JOIN groupassignments
	ON grade.byGroup = groupassignments.groupID
	INNER JOIN submissions
        ON grade.submissionID = submissions.submissionID
        WHERE groupassignments.assignedTo = $groupID AND submissions.groupID = $groupID
        ";

$result = mysqli_query($connection,$query) or die('Error2' . mysqli_error($connection));


  		$query2 = " 
		SELECT groupID
		FROM groupassignments
		WHERE assignedTo = $groupID
		";
	
$result2 = mysqli_query($connection,$query2) or die('Error' . mysqli_error($connection));
	
	echo '<p><h3>View Assessments</h3></p>'.'You are graded by groups ';

while($row2 = mysqli_fetch_assoc($result2)){
	echo $row2['groupID']. ' ';
}

echo '<p></p>';
echo "Your group's assessments are shown below.". "<p></p>";

  	while($row = mysqli_fetch_assoc($result)){
  		$byGroup = $row['byGroup'];
  		echo '<div class="well">
  		 	<label> Review from group '. $byGroup . ' </label><p></p>';
  			
  		$query3 = "
  			SELECT AVG(grade) as averageMark
  			FROM grade
  			WHERE byGroup = $byGroup
  			GROUP BY byGroup
  		";	
  		
  		$result3 = mysqli_query($connection,$query3) or die('Error' . mysqli_error($connection));
  		$row3 = mysqli_fetch_assoc($result3);
  			
		echo 	'<div class="actionBox">
			 	<ul class="commentList">
        		    		<li>
        			      	<div class="commentText">
        		        		<p class="">' . $row['comments']. '</p> 
             					<p class="">Grade: ' . $row['grade']. '/10</p>
             					<p class="">Group ' . $byGroup . ' average mark: ' . $row3['averageMark']. '/10</p>
                			</div>
        				</li>
				 </ul>
			</div> 
                	</div>';
        }
        
mysqli_close($connection);



require "footer.php";
?>

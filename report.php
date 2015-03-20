<?php
require "header.php"; //include file - require means must be there or give error, include() is can have it 
require_once "include/sql_model.php";

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

$result1 = mysqli_query($connection,$query1) or die('Error2' . mysqli_error($connection));
$row1 = mysqli_fetch_assoc($result1);
$groupID = $row1['groupID'];	
$groupID =  mysqli_real_escape_string($connection, $groupID);

	 $query = "
	 SELECT submissions.submissionID as submissionID, submissionName, submissions.groupID
	 FROM submissions INNER JOIN groupassignments
	 ON submissions.groupID = groupassignments.assignedTo
	 WHERE groupassignments.groupID = $groupID
	 ";
	 
$result = mysqli_query($connection,$query) or die('Error2' . mysqli_error($connection));

$query4 = " 
	SELECT assignedTo
	FROM groupassignments
	WHERE groupID = $groupID
	";
	
$result4 = mysqli_query($connection,$query4) or die('Error2' . mysqli_error($connection));

echo '<h3>Submit Gradings</h3>';

echo 'Your group is assigned to review groups ';

while($row4 = mysqli_fetch_assoc($result4)){
	echo $row4['assignedTo']. ' ';
}

echo '<p></p>';
echo 'Submitted reports are shown below. Please review them.'.'<p></p>';

if (isset($_POST['grade']) && (isset($_POST['comments']))){
	
			$subID = $_POST['submissionID'];
			$grade = $_POST['grade'];
			$comment = $_POST['comments'];
	
	$subID =  mysqli_real_escape_string($connection, $subID);
	$grade =  mysqli_real_escape_string($connection, $grade);
	$comment =  mysqli_real_escape_string($connection, $comment);
			
			$query3 = "
				INSERT INTO grade (submissionID, grade, comments, byGroup)
				VALUES ($subID, $grade, '$comment' , $groupID)
				";
				
$result3 = mysqli_query($connection, $query3) or die('Error4' . mysqli_error($connection));

}


	while ($row = mysqli_fetch_assoc($result)){
echo	'<div class="well">';
		echo "<label> Report from group ". $row['groupID'] . ' </label><p></p>';

		echo file_get_contents($row['submissionName']) . '<p></p>';
		
		$submissionID = $row['submissionID'];
		$submissionID =  mysqli_real_escape_string($connection, $submissionID);
		
		$query2 = "SELECT grade, comments
			FROM grade
			WHERE submissionID = $submissionID AND byGroup = $groupID
			";
	$result2 = mysqli_query($connection,$query2) or die('Error3' . mysqli_error($connection));
		if (mysqli_num_rows($result2) == 1) {
		$row2 = mysqli_fetch_assoc($result2);

	echo '<div class="actionBox">
        <ul class="commentList">
            <li>
                <div class="commentText">
                    <p class="">' . $row2['comments']. '</p> 
             		 <p class="">Grade: ' . $row2['grade']. '/10</p> 
                </div>
            </li>
        </ul>
		</div>  ';
		}
		else{
				echo '
<div class="detailBox">
    <div class="titleBox">
      <label>Your review</label>
        <button type="button" class="close" aria-hidden="true">&times;</button>
    </div>
    
    
        <form action="report.php" class="form-inline" method="post" role="form">
            <div class="form-group">
                <textarea rows="7" cols="80" name="comments" > </textarea>
            </div>
            <p></p>
            Select Grade
        <select name="grade">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
        </select>
    </div>
	    <div class="form-group">
	    		<input type = "hidden" name = "submissionID" value = ' . $row['submissionID'] . '>
	    	<p><input type="submit" value="Submit review"></p>
        </form>
             </div>';
		
		
		}
	echo	'</div>';
	}	
		

mysqli_close($connection);
//$review = array();
//echo $review['comments'] = $_POST['comments'];
//echo $review['grade'] = $_POST['grade'];



require "footer.php";
?>

<?php
require "header.php"; //include file - require means must be there or give error, include() is can have it 
require_once "include/sql_model.php";

if(!isset($_SESSION['userID'])){
	header('location: unauthorised.php?');
}

$report = array();
$i = 0;
date_default_timezone_set("Europe/London");
$time = date("d/m/y h:ia");

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
	 SELECT submissions.submissionID as submissionID, submissionName, submissions.groupID
	 FROM submissions INNER JOIN groupassignments
	 ON submissions.groupID = groupassignments.assignedTo
	 WHERE groupassignments.groupID = $groupID
	 ";
	 
$result = mysqli_query($connection,$query) or die('Error2' . mysqli_error($connection));


	while ($row = mysqli_fetch_assoc($result)){
		echo "Report from group ". $row['groupID'] . '<p></p>';
		$report[$i] = $row['submissionName'];
		echo file_get_contents($report[$i]) . '<p></p>';
		$i++;
		
	
		$submissionID = $row['submissionID'];
		$query2 = "SELECT grade, comments
			FROM grade
			WHERE submissionID = $submissionID AND byGroup = $groupID
			";
	$result2 = mysqli_query($connection,$query2) or die('Error3' . mysqli_error($connection));
		if (mysqli_num_rows($result2) == 1) {
		$row2 = mysqli_fetch_assoc($result2);
		echo $row2['comments'];
		echo $row2['grade'];
	echo '<div class="actionBox">
        <ul class="commentList">
            <li>
                <div class="commentText">
                    <p class="">Good work!</p> <span class="date sub-text">'.$time.'</span>
                </div>
            </li>
        </ul>
		</div>  ';
		}
		else{
			
			$subID = $_POST['submissionID'];
			$grade = $_POST['grade'];
			$comment = $_POST['comments'];
			
			$query3 = "
				INSERT INTO grade (submissionID, grade, comments, byGroup)
				VALUES ($subID, $grade, '$comment' , $groupID)
				";
$result3 = mysqli_query($connection, $query3) or die('Error4' . mysqli_error($connection));
			echo '
<div class="detailBox">
    <div class="titleBox">
      <label>Grading Assessments</label>
        <button type="button" class="close" aria-hidden="true">&times;</button>
    </div>
    
    
        <form action="report.php" class="form-inline" method="post" role="form">
            <div class="form-group">
                <textarea rows="7" cols="80" name="comments" > Your review </textarea>
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
             </div>';
		}	
	}	
	

mysqli_close($connection);
//$review = array();
//echo $review['comments'] = $_POST['comments'];
//echo $review['grade'] = $_POST['grade'];



require "footer.php";
?>

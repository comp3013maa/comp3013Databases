<?php
require "header.php"; //include file - require means must be there or give error, include() is can have it 
require_once "include/sql_model.php";

if(!isset($_SESSION['userID'])){
	header('location: unauthorised.php?');
}
/*
getReports()
while row=fetch assoc
displayReport() //the groupID and free text 
if (graded) print the review and grade
else comment box and dropdown and submit button. 
*/
$report = array();
$i = 0;
	
	$connection = mysqli_connect('eu-cdbr-azure-west-b.cloudapp.net','b6526a64c19791','5d020f59','comp3013')
	 or die('Error1' . mysqli_error($connection));
	 
	$userID = $_SESSION['userID'];
	 
	$sql_model = new SQL_Model();
	$groupID = $sql_model->getUsersGroupID($userID); 
	$sql_model->close();
	 
	 $query = "
	 SELECT submissionName, submissions.groupID
	 FROM submissions INNER JOIN groupassignments
	 ON submissions.groupID = groupassignments.assignedTo
	 WHERE groupassignments.groupID = $groupID
	 ";
	 
 $result = mysqli_query($connection,$query) or die('Error2' . mysqli_error($connection));
mysqli_close($connection);

	while ($row = mysqli_fetch_assoc($result)){
		echo $row['groupID'];
		
	echo $report[$i] = $row['submissionName'];
	echo file_get_contents($report[$i]);
	$i++;	

	}
	
/*
$review = array();
echo $review['comment'] = $_POST['comment'];
echo $review['grade'] = $_POST['grade'];



date_default_timezone_set("Europe/London");
$time = date("d/m/y h:ia");
echo '
<div class="detailBox">
    <div class="titleBox">
      <label>Grading Assessments</label>
        <button type="button" class="close" aria-hidden="true">&times;</button>
    </div>
    
    <div class="actionBox">
        <ul class="commentList">
            <li>
                <div class="commentText">
                    <p class="">Good work!</p> <span class="date sub-text">'.$time.'</span>
                </div>
            </li>
        </ul>
       
        <form action="report.php" class="form-inline" method="post" role="form">
            <div class="form-group">
                <textarea rows="7" cols="80" name="comment" > Your review </textarea>
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
                <p><input type="submit" value="Submit review"></p>
            </div>
        </form>
    </div>
</div>';
*/
require "footer.php";
?>

<?php
require "header.php";
require "connect.php";

echo '<form  method="post" action="search.php?go"  id="searchform"> 
	      <input  type="text" name="name"> 
	      <input  type="submit" name="submit" value="Search"> 
	    </form>';
	    
	    if(isset($_POST['submit'])){ 
	    	if(isset($_GET['go'])){ 
	  	$sql = "select * from posts where text LIKE *". $_GET['go']."*";
	  	$result = mysqli_query($conn,$sql) or die('Error2' . mysqli_error($conn)); 
	  		echo '<table border="1">
				<tr>
				<th>Posts Found</th>
				
				</tr>';
				
		while($row = $result->fetch_assoc())
			{
			echo '<tr>';
			echo '<td class="leftpart">';
			echo '<h3><a href="topic.php?id=' . $row['post_topic'] . '">' . $row['post_content'] . '</a></h3>' . $row['post_id'];
			echo '</td>';
			echo '<td class="rightpart">';
	    	}
	  } 

require "footer.php";
?>

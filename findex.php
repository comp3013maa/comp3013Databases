<?php
require "header.php";
require "connect.php";

echo '<form  method="post"  id="searchform"> 
	      <input  type="text" name="name"> 
	      <input  type="submit" name="submit" value="Search"> 
	    </form>';
	    
	    if(isset($_POST['submit']) ){
	  	$sql = "select p.*, u.* from p posts, u users where post_content LIKE '%". $_POST['name'] ."%'";
	  	$result = mysqli_query($conn,$sql) or die('Error2' . mysqli_error($conn)); 
	  		echo '<table border="1">
				<tr>
				<th>Posts Found</th>
				
				</tr>';
				
		while($row = $result->fetch_assoc())
			{
			echo '<tr>';
			echo '<td class="leftpart">';
			echo '<h3><a href="topic.php?id=' . $row['p.post_topic'] . '">' . $row['p.post_content'] . '</a></h3>' . $row['u.userName'];
			echo '</td>';
			echo '<td class="rightpart">';
	    		}
	  	
	 }

require "footer.php";
?>

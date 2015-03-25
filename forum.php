<?php
//create_cat.php
require 'header.php';

$server = 'eu-cdbr-azure-west-b.cloudapp.net';
$username = 'b6526a64c19791';
$password = '5d020f59';
$database = 'comp3013';

// Create connection
$conn = new mysqli($server, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql = "SELECT 
			categories.cat_id,
			categories.cat_name,
			categories.cat_description,
			COUNT(topics.topic_id) AS topics
		FROM
			categories
		LEFT JOIN
			topics
		ON
			topics.topic_id = categories.cat_id
		GROUP BY
			categories.cat_name, categories.cat_description, categories.cat_id";

$result = mysqli_query($conn,$sql) or die('Error2' . mysqli_error($conn));
$num_rows = $result->num_rows;

if(!$result)
{
	echo 'The categories could not be displayed, please try again later.';
}
else
{
	if($num_rows == 0)
	{
		echo 'No categories defined yet.';
	}
	else
	{
		//prepare the table
		echo '<div class="well">
		<table class="table">
			 <thead>
			  <tr>
				<th>Category</th>
				<th>Last topic</th>
			  </tr>
			 </thead> 
			<tbody>';	
			
		while($row = mysqli_fetch_assoc($result))
		{				
			echo '<tr>';
				echo '<td class="leftpart">';
					echo '<h3><a href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
				echo '</td>';
				echo '<td class="rightpart">';
				
				//fetch last topic for each cat
					$topicsql = "SELECT
									topic_id,
									topic_subject,
									topic_date,
									topic_cat
								FROM
									topics
								WHERE
									topic_cat = " . $row['cat_id'] . "
								ORDER BY
									topic_date
								DESC
								LIMIT
									1";
								
					$topicsresult = mysqli_query($conn,$topicsql) or die('Error2' . mysqli_error($conn));
					$topicnum_rows = $topicsresult->topicnum_rows;
					if(!$topicsresult)
					{
						echo 'Last topic could not be displayed.';
					}
					else
					{
						if(mysqli_num_rows($topicsresult) == 0)
						{
							echo 'no topics';
						}
						else
						{
							while($topicrow = mysqli_fetch_assoc($topicsresult))
							echo '<a href="topic.php?id=' . $topicrow['topic_id'] . '">' . $topicrow['topic_subject'] . '</a> at ' . date('d-m-Y', strtotime($topicrow['topic_date']));
						}
					}
				echo '</td>';
			echo '</tr>';
		}
		echo '</tbody></table></div>';
		echo '<li id = "indexList"> <a href = "create_cat.php" class="listLinks"> Create Category </a></li>';
	}
}
mysqli_close($conn);
require 'footer.php';
?>

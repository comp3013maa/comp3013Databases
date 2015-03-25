<?php
//create_cat.php


include 'header.php';
include 'connect.php';

echo '<h2>Create a category</h2>';
if(!isset ($_SESSION['userID']))
{
	//the user is not an admin
	echo 'Sorry, you do not have sufficient rights to access this page.';
}
else
{
	//the user has admin rights
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		//the form hasn't been posted yet, display it
		echo '<form method="post" action="">
			Category name: <input type="text" name="cat_name" /><br />
			Category description:<br /> <textarea name="cat_description" /></textarea><br /><br />
			<input type="submit" value="Add category" />
		 </form>';
	}
	else
	{
		//the form has been posted, so save it
		 $postcatname =  mysqli_real_escape_string($conn, $_POST['cat_name'] );
		 $postcatdescription =  mysqli_real_escape_string($conn, $_POST['cat_description'] );
		$sql = "INSERT INTO categories(cat_name, cat_description)
		   VALUES(' $postcatname ',
				 ' $postcatdescription ')";
		$result = mysqli_query($conn,$sql) or die('Error2' . mysqli_error($conn));
		if(!$result)
		{
			//something went wrong, display the error
			echo 'Error' . mysql_error();
		}
		else
		{
			echo 'New category succesfully added.';
		}
	}
}
mysqli_close($conn);
include 'footer.php';
?>

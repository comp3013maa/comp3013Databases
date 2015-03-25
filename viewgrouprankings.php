<?php 
  require "header.php"; 
  require_once "include/sql_model.php";

	echo '<h3> User Group Rankings</h3> <br />
	<p> Ranking of your own aggregated mark within the aggregated marks for all groups.</p>  ';
	$sql_model = new SQL_Model();
	echo $sql_model->getGroupAverageScores();
	$sql_model->close();
	
	require "footer.php";
?>

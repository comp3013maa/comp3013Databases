<?php 
  require "header.php"; 
  require_once "include/sql_model.php";

	echo '<h3>Group Rankings</h3> <br />
	<p> Groups Ranked according to an aggregation of score (an average of scores): </p>  ';
	$sql_model = new SQL_Model();
	echo $sql_model->getGroupAverageScores();
	$sql_model->close();
	
	require "footer.php";
?>

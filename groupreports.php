<?php
require "header.php"; 

echo '
        <div class="panel panel-primary">
            <div class="panel-heading">
              	<h3 class="panel-title">ADMIN</h3>
            </div>
            <div class="panel-body">
                    <ul> 
		<li id = "indexList"> <a href = "report.php" class="listLinks"> Submit Gradings</a></li>                  		
		<li id = "indexList"> <a href = "assessments.php" class="listLinks">View Assessments</a></li>
		<li id = "indexList"> <a href = "" class="listLinks">View Rankings</a></li>         
		 </ul>   
            </div>
        </div>  
    </div>  ';

require "footer.php";
?>

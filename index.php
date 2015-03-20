<?php
require "header.php"; //include file - require means must be there or give error, include() is can have it 

if (!isset($_SESSION['userID'])) {
  echo '<p> You are not currently logged in - please sign in to access authenticated-only areas of the system <br />';
}

?> 
    <div class="col-sm-6">
        <div class="panel panel-primary"> <!-- Change to panel-default to get grey colour-->
            <div class="panel-heading">
              <h3 class="panel-title">Upload Reports</h3>
            </div>
            <div class="panel-body">
              	<ul> 
	                <li id = "indexList"> <a href = "upload.php" class="listLinks"> Upload Free Text Report</a> </li>                  		
	                <li id = "indexList"> <a href = "upload.php" class="listLinks">Upload XML</a> </li>
               	</ul>
              </div>  
        </div>
        
        <div class="panel panel-primary"> 
            <div class="panel-heading">
             	 <h3 class="panel-title">Group Reports</h3>
            </div>
            <div class="panel-body">
               	<ul> 
		<li id = "indexList"> <a href = "report.php" class="listLinks"> Submit Gradings </a></li>
		<li id = "indexList"> <a href = "assessments.php" class="listLinks"> View Your Reports Assessments </a></li>
		<li id = "indexList"> <a href = "" class="listLinks"> View Rankings of Groups</a></li>
               </ul>
            </div>  
        </div>
        
        <div class="panel panel-primary"> 
            <div class="panel-heading">
             	 <h3 class="panel-title">Forum</h3>
            </div>
            <div class="panel-body">
               	<ul> 
		<li id = "indexList"> <a href = "forum.php" class="listLinks"> Forum Index </a></li>
		<li id = "indexList"> <a href = "forum.php?newThread" class="listLinks"> New Thread </a></li>
		<li id = "indexList"> <a href = "forum.php?search" class="listLinks"> Search Forum </a></li>
               </ul>
            </div>  
        </div>
    </div>  

    <div class="col-sm-6">
       
        <div class="panel panel-primary">
            <div class="panel-heading">
              	<h3 class="panel-title">Admin</h3>
            </div>
            <div class="panel-body">
                    <ul> 
	                <li id = "indexList"> <a href = "register.php" class="listLinks"> Add New User</a> </li>                  		
	                <li id = "indexList"> <a href = "browse_users.php" class="listLinks">Browse Users</a> </li>
	                <li id = "indexList"> <a href = "admin.php?allocateGroups" class="listLinks">Allocate Groups </a></li>
	                <li id = "indexList"> <a href = "admin.php?rankings" class="listLinks">Group Rankings </a></li>
                </ul>   
            </div>
        </div>


       	<div class="panel panel-primary">
            <div class="panel-heading">
              	<h3 class="panel-title">Support</h3>
            </div>
            <div class="panel-body">
                <ul> 
			<li id = "indexList"> <a href="contact.php">  Message </a></li>
                </ul>   
            </div>
        </div>
    
      
    </div>

<?php require "footer.php";
?>

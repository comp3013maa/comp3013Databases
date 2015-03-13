<?php
require "header.php"; //include file - require means must be there or give error, include() is can have it 

echo '<a href="register.html">Add New User Form</a> <br />' ;
echo '<a href="login.php">Login</a> <br />' ;

    <div class="col-sm-6">
     
        <div class="panel panel-primary"> <!-- Change to panel-default to get grey colour-->
            <div class="panel-heading">
              <h3 class="panel-title">APIS</h3>
            </div>
            <div class="panel-body">
              	<ul> 
	                <li id = "indexList"> <a href = "api.php?add" class="listLinks"> Add New </a> </li>                  		
	                <li id = "indexList"> <a href = "api.php?id=1" class="listLinks">Timetable</a> </li>
	                <li id = "indexList"> <a href = "api.php?id=2" class="listLinks">Moodle </a></li>
	                <li id = "indexList"> <a href = "api.php?view" class="listLinks">View All </a></li>

               	</ul>
              </div>  
        </div>
        
        <div class="panel panel-primary"> 
            <div class="panel-heading">
             	 <h3 class="panel-title">ANALYTICS</h3>
            </div>
            <div class="panel-body">
               	<ul> 
					<li id = "indexList"> <a href = "analytics.php" class="listLinks"> Google Analytics </a></li>
               </ul>
            </div>  
        </div>

        <div class="panel panel-primary"> 
            <div class="panel-heading">
             	 <h3 class="panel-title">DESIGN</h3>
            </div>
            <div class="panel-body">
               	<ul> 
					<li id = "indexList"> <a href="design.php?icons"> Menu Icons </a></li>
					<li id = "indexList"> Style </li>  
               </ul>
            </div>  
        </div>

    </div>  

    <div class="col-sm-6">
       
        <div class="panel panel-primary">
            <div class="panel-heading">
              	<h3 class="panel-title">USER MANAGEMENT</h3>
            </div>
            <div class="panel-body">
                    <ul> 
                    <li id = "indexList"> <a href="users.php?add">Add <a/></li>
                    <li id = "indexList"> <a href="users.php?edit">View/Modify Users </a></li>
                </ul>   
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">
              	<h3 class="panel-title">ALERTS</h3>
            </div>
            <div class="panel-body">
                <ul> 
						<li id = "indexList"> <a href="alerts.php?add"> Add </a></li>
						<li id = "indexList"> <a href="alerts.php?edit"> Modify </a> </li>
                </ul>   
            </div>
        </div>

       	<div class="panel panel-primary">
            <div class="panel-heading">
              	<h3 class="panel-title">SUPPORT</h3>
            </div>
            <div class="panel-body">
                <ul> 
					<li id = "indexList"> <a href="support.php">  Message </a></li>
                </ul>   
            </div>
        </div>
    
      
    </div>

require "footer.php";
?>

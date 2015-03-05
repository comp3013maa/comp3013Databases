<?php
ob_start(); // ignore, prevents errors when redirecting 

/* if session not already created, create it */
if(!isset($_SESSION))  {
	session_start(); // 
}  

/* If more than an hour since last activity, destroy session */
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}

/*  if session still active - update last activity to current time  */ 
$_SESSION['LAST_ACTIVITY'] = time(); 
?>

<link href="include/bootstrap-3.1.1-dist/css/bootstrap.min.css" rel="stylesheet">
<link href="include/style.css" rel="stylesheet" type="text/css">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) - maybe not actually be used - ignore largely -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="include/bootstrap-3.1.1-dist/js/bootstrap.min.js"></script>

 <div class="navbar navbar-default navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" id="headerLinks" href="index.php">Proper Abbuz m8</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="support.php">Documentation</a></li>
            <li><a href="support.php">Contact</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">

            <?php  if( isset ($_SESSION['userID']) ) {?> 
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, <?php echo $_SESSION['userName']; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="support.php"><i class="icon-envelope"></i> Contact Support</a></li>
                            <li class="divider"></li>
                            <li><!-- <a href="logout.php"><i class="icon-off"></i> Logout</a> -->
                            	<form method="POST" action = "logout.php">
                            	  <button type="button" class="btn btn-default">Middle</button>

					<p>	<input type="submit" value = "logout" name="logoutForm" class="logoutDesign"> </p> 
				</form> 
                            </li>
                        </ul>
            </li>
            <?php } ?>

            <!-- For other things in the rigth section of the menu, just use li e.g. 
             <li><a href="logout.php"> Log Out </a> </li>
            -->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>


<?php 
if( isset ($_SESSION['userID']) ) {
	echo '<p class="lol"> Hi user: ' . $_SESSION['userName'] . ' with userID: ' . $_SESSION['userID'] . '</p>';
	echo ' 
} 
?>

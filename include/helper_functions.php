<?php
/* Used in the to display errors and */
function errorMessage($title, $message) {
	$errorMessage = '
	<div class="row">
      	<div class="col-md-6 col-md-offset-3">
          <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    ×</button>
                <span class="glyphicon glyphicon-hand-right"></span> <strong>' .$title. '</strong>
                <hr class="message-inner-separator">
                <p>' . $message . '</p>
            </div>
        </div>
    </div>  ';
    return $errorMessage;
}

function successMessage($title, $message) {
	$successMessage = '
	<div class="row">
		      <div class="col-md-6 col-md-offset-3">
	            <div class="alert alert-success">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	                    ×</button>
	               <span class="glyphicon glyphicon-ok"></span> <strong>' . $title . '</strong>
	                <hr class="message-inner-separator">
	                <p>' . $message . '</p>
	            </div>
	        </div>   
	   </div>';	
	   return $successMessage; 
}
?>

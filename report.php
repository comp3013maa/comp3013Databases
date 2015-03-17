<?php
require "header.php"; //include file - require means must be there or give error, include() is can have it 

echo file_get_contents('uploads/up.txt');

echo '<div class="detailBox">
    <div class="titleBox">
      <label>Grading Assessments</label>
        <button type="button" class="close" aria-hidden="true">&times;</button>
    </div>
    
    <div class="actionBox">
        <ul class="commentList">
            <li>
                <div class="commentText">
                    <p class="">Good work!</p> <span class="date sub-text">on March 5th, 2014</span>
                </div>
            </li>
        </ul>
        <form class="form-inline" role="form">
            <div class="form-group">
                <textarea rows="7" cols="80"> Your review </textarea>
            </div>
    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
            Please select grade
            <span class="caret"></span>
        </button>
    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

   <li role="presentation"><a role="menuitem" tabindex="-1" href="1">1</a></li>
   <li role="presentation"><a role="menuitem" tabindex="-1" href="1">2</a></li>
   <li role="presentation"><a role="menuitem" tabindex="-1" href="1">3</a></li>
   <li role="presentation"><a role="menuitem" tabindex="-1" href="1">4</a></li>
   <li role="presentation"><a role="menuitem" tabindex="-1" href="1">5</a></li>
   <li role="presentation"><a role="menuitem" tabindex="-1" href="1">6</a></li>
   <li role="presentation"><a role="menuitem" tabindex="-1" href="1">7</a></li>
   <li role="presentation"><a role="menuitem" tabindex="-1" href="1">8</a></li>
   <li role="presentation"><a role="menuitem" tabindex="-1" href="1">9</a></li>
   <li role="presentation"><a role="menuitem" tabindex="-1" href="1">10</a></li>
 </ul>
</div>
            <div class="form-group">
                <button class="btn btn-default">Add</button>
            </div>
        </form>
    </div>
</div>';

require "footer.php";
?>

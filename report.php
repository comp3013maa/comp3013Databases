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
                <input class="form-control" type="textarea" placeholder="Your comments" />
                <textarea rows="4" cols="50">
At w3schools.com you will learn how to make a website. We offer free tutorials in all web development technologies. 
</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-default">Add</button>
            </div>
        </form>
    </div>
</div>';

require "footer.php";
?>

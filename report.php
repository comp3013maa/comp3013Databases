<?php
require "header.php"; //include file - require means must be there or give error, include() is can have it 

echo file_get_contents('uploads/up.txt');

echo '<div class="detailBox">
    <div class="titleBox">
      <label>Comment Box</label>
        <button type="button" class="close" aria-hidden="true">&times;</button>
    </div>
    <div class="commentBox">
        
        <p class="taskDescription">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
    </div>
    <div class="actionBox">
        <ul class="commentList">
            <li>
                <div class="commenterImage">
                  <img src="http://lorempixel.com/50/50/people/6" />
                </div>
                <div class="commentText">
                    <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>

                </div>
            </li>
            <li>
                <div class="commenterImage">
                  <img src="http://lorempixel.com/50/50/people/7" />
                </div>
                <div class="commentText">
                    <p class="">Hello this is a test comment and this comment is particularly very long and it goes on and on and on.</p> <span class="date sub-text">on March 5th, 2014</span>

                </div>
            </li>
            <li>
                <div class="commenterImage">
                  <img src="http://lorempixel.com/50/50/people/9" />
                </div>
                <div class="commentText">
                    <p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span>

                </div>
            </li>
        </ul>
        <form class="form-inline" role="form">
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Your comments" />
            </div>
            <div class="form-group">
                <button class="btn btn-default">Add</button>
            </div>
        </form>
    </div>
</div>';

require "footer.php";
?>

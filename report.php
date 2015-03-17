<?php
require "header.php"; //include file - require means must be there or give error, include() is can have it 

echo file_get_contents('uploads/up.txt');

$review = array();
echo	$review['comment'] = $_POST['comment'];

echo '



<div class="detailBox">
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
       
        <form action="report.php" class="form-inline" method="post" role="form">
        <input type="text" name="comment" size="300">
            <div class="form-group">
                <textarea rows="7" cols="80"> Your review </textarea>
            </div>
            <p></p>
            Select Grade
        <select>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
        </select>
    </div>
            <div class="form-group">
                <p><input type="submit" value="Submit review"></p>
            </div>
        </form>
    </div>
</div>';

require "footer.php";
?>

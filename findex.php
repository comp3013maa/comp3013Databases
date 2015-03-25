<?php
require "header.php";
require "connect.php";

echo '<form  method="post" action="search.php?go"  id="searchform"> 
	      <input  type="text" name="name"> 
	      <input  type="submit" name="submit" value="Search"> 
	    </form>';

require "footer.php";
?>

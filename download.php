<?php
require "header.php"; //include file - require means must be there or give error, include() is can have it 


}
echo '<form action = "download.php" method = "POST" enctype = "downloadform">
      <input name="file" value="up.txt" type="hidden"> <br><br>
      <input type="submit" value="download" name = "download">
</form>';
require "footer.php";
?>

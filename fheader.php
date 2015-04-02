<?php
session_start();
header ("Content-type: image/png");

$rno = rand(1000,99999);
$_SESSION['ckey'] = md5($rno);

$img_handle = imageCreateFromPNG("http://s18.postimg.org/ov6ea0t11/bg1.png");
$color = ImageColorAllocate ($img_handle, 0, 0, 0);
ImageString ($img_handle, 5, 20, 13, $rno, $color);
ImagePng ($img_handle);
ImageDestroy ($img_handle);

?>

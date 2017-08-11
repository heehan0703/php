<?php
if (isset($_REQUEST['thumb'])) {
 include_once('inc/easyphpthumbnail.class.php');
 // Your full path to the images
 $dir = str_replace(chr(92),chr(47),getcwd()) . '/product_img/';
 // Create the thumbnail
 $thumb = new easyphpthumbnail;

 $thumb -> Copyrighttext = 'www.beautco.com';

$thumb -> Copyrightfonttype = 'gfx/handwriting.ttf';
 $thumb -> Copyrightposition = '50% 50%';
 $thumb -> Copyrightfontsize = 15;
 $thumb -> Copyrighttextcolor = '#FFFFFF';
 $thumb -> Createthumb($dir . basename($_REQUEST['thumb']));
}
?>

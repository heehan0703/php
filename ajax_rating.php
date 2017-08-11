<?php
$rate=$_POST['rate'];
  $vid=$_POST['vid'];
  $pic=$_POST['pic'];
 $detail=$_POST['detail'];
 $tit=$_POST['tit'];
 if($pic)
 {
	 $target_path = "upload/";

$target_path = $target_path . basename($pic);
//echo $target_path;
//$imageFileType holds the file extension of the file
$imageFileType = pathinfo($target_path,PATHINFO_EXTENSION);


// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
} 
 // Check file size


else {
 
 // Check if file already exists
if (file_exists($target_path)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
else{

if(move_uploaded_file($pic,
 $target_path)) {
    echo "The file ".  basename( $pic). 
    " has been uploaded";
	
} else{
    echo "There was an error uploading the file, please try again!";
}
}
}
 
 
 }

?>



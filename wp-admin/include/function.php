<?
function upload_multiple_file($file_name,$upload_dir){

$file=$_FILES[$file_name];

$upload_dir_path=$upload_dir;

$count=count($file['name']);

if($count >= 1){

	for($i=0;$i<$count;$i++){

if($file['name'][$i]!=''){
		$ext=end(explode(".",$file['name'][$i]));

		$new['name']=$file['name'][$i];

		$new['type']=$file['type'][$i];

		$new['tmp_name']=$file['tmp_name'][$i];

		$new['error']=$file['error'][$i];

		$new['extention']=$ext;

		$size=$file['size'][$i]/(1024*1024);

		$size=round($size,2);		

		$new['size']=$size;

		$re_array[]=$new;
}
		}

	foreach($re_array as $file){

if($file['type'] == "image/jpg" || $file['type'] == "image/png" || $file['type'] == "image/jpeg" || $file['type']== "image/gif" ){
			
			$name_fi=time().$file['name'];
			

			move_uploaded_file($file['tmp_name'],$upload_dir_path.$name_fi);

		$newinsert .="$name_fi ,";
}
		}	

	}

	$newinsert=rtrim($newinsert,',');

	$insert="`images`='$newinsert'";

	//$insert=rtrim($insert,',');

return $insert;

}


function upload_multiple_file_jpg_pdf($file_name,$upload_dir){

$file=$_FILES[$file_name];

$upload_dir_path=$upload_dir;

$count=count($file['name']);

if($count >= 1){

	for($i=0;$i<$count;$i++){

if($file['name'][$i]!=''){
		$ext=end(explode(".",$file['name'][$i]));

		$new['name']=$file['name'][$i];

		$new['type']=$file['type'][$i];

		$new['tmp_name']=$file['tmp_name'][$i];

		$new['error']=$file['error'][$i];

		$new['extention']=$ext;

		$size=$file['size'][$i]/(1024*1024);

		$size=round($size,2);		

		$new['size']=$size;

		$re_array[]=$new;
}
		}


	foreach($re_array as $file){
		

if($file['type'] == "image/jpeg" || $file['type'] == "application/pdf" || $file['type'] == "image/jpeg"){
			
			$name_fi=time().$file['name'];
			

			move_uploaded_file($file['tmp_name'],$upload_dir_path.$name_fi);

		$newinsert .="$name_fi ,";
}
		}	

	}

	$newinsert=rtrim($newinsert,',');

	$insert="`shipping_label`='$newinsert'";

	//$insert=rtrim($insert,',');

return $insert;

}
?>
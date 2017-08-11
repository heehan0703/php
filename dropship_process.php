<?php
session_start();

 $member_id=$_SESSION['member_id'];
 
 $GOOD_SHOP_USERID =$_SESSION['GOOD_SHOP_USERID'];

require_once('wp-admin/include/connectdb.php');

require_once('include/function.php');

if(isset($_POST['card_all_id']) && $_POST['card_all_id']!=''){

	$total_P = $_POST['total_P'];
	$total_weight = $_POST['total_weight'];
	$message = $_POST['message'];
	//print_r($_FILES['file']);
	if($_FILES['file']['error'][0]!=4){
	
	$upload_img = upload_multiple_file_jpg_pdf('file','ship_img/');
	
	$card_all_id = $_POST['card_all_id'];
	$card_array=explode(',',$card_all_id);
	for($i=0;$i<count($card_array);$i++){
	mysql_query("update  `cart` set `message`='$message',$upload_img where id='$card_array[$i]'");
//	echo $card_array[$i].' vimall<Br><br>';	
	}
	}
	else{
$card_all_id = $_POST['card_all_id'];
	$card_array=explode(',',$card_all_id);
	for($i=0;$i<count($card_array);$i++){
	mysql_query("update  `cart` set `message`='$message' where id='$card_array[$i]'");
//	echo $card_array[$i].' vimall<Br><br>';	
	}	
		
	}

	echo "<form method='post' name='dropshipform' id='dropshipform' action='checkout.php' >
<input type='hidden' name='total_P' value='$total_P'  >
<input type='hidden' name='total_weight' value='$total_weight'  >
</form>
<script type='text/javascript'>
document.getElementById('dropshipform').submit();
</script>";
}



?>

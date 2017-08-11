<?php 

session_start();


require_once('wp-admin/include/connectdb.php');



/**
 * authorize.net response url...
 */
if ($_REQUEST) {
	
	//print_r($_REQUEST);
	//exit;
	$res_code		= $_REQUEST['x_response_code'];			// 1.����, 2.����, 3.����..
	$res_message	= $_REQUEST['x_response_reason_text'];	// ����...
	$res_amount		= $_REQUEST['x_amount'];					// �ŷ� �ݾ�...
	$res_tradecode	= $_REQUEST['x_description'];				// �ŷ� ��ȣ....
      
				

	if ($res_code == 1) {
		$qry = "update trade set payMethod='card', status=1 where tradecode='$res_tradecode'";
		@DBquery($qry);
		
		////// beginning of sending ordering mail///////////////////////////////////////////////////////////////////////
	/*if($admin_row['bBuymail']=="y"){
		include "../email/goods_order.php";
	}*/
	////// end of sending ordering mail///////////////////////////////////////////////////////////////////////
	$userid=mysql_result(mysql_query("select userid from trade where tradecode='$res_tradecode'"),0);
	
	mysql_query("delete from cart where userid='$userid'");
	header("location:order_ok.php?tradecode=$res_tradecode");
		
		$url = "https://fahair.com/newhair/order_ok.php?tradecode=$res_tradecode&payMethod=card";
		header("location:$url");
	} else {
		$Msg = "[Code:".$res_code."]".$res_message;
		$url = "https://fahair.com/newhair/my_bag.php";
		mysql_query("delete from trade where tradecode='$res_tradecode'");
		mysql_query("delete from trade_goods where tradecode='$res_tradecode'");
		MsgViewHref($Msg, $url);
	}
} else {
	echo "Err. authorize.net response..";
}
function MsgViewHref($msg,$url){
echo '<script type="text/javascript">
alert("$msg");
window.location="$url";
</script>';	
}

?>


<?php 
session_start();
require_once('wp-admin/include/connectdb.php');

 $REMOTE_ADDR=$_SERVER['REMOTE_ADDR'];
$admin_row = mysql_fetch_assoc(mysql_query("SELECT * FROM `admin` where idx=1"));
if(isset($_POST['tradecode'])){
$GOOD_SHOP_USERID=$_SESSION['GOOD_SHOP_USERID'];
$GOOD_SHOP_PART = $_SESSION['GOOD_SHOP_PART'];
 
 $tradecode = $_POST['tradecode'];
 $totalM = $_POST['totalM'];
 $ship_price = $_POST['ship_price_hidden'];
 $payM = $_POST['payM']; 
 $pay_method_select = $_POST['pay_method_select'];
 $time= time();
 $name1= $_POST['name1'];
 $name2 = $_POST['name2'];
 $address1 = $_POST['address1'];
 $address2 = $_POST['address2'];
 $city = $_POST['city'];
 $zipcode = $_POST['zipcode'];
 $country= $_POST['country'];
 $state = $_POST['state'];
 $userid=$_POST['userid'];

  $ship_name1= $_POST['ship_name1'];
 $ship_name2 = $_POST['ship_name2'];
 $ship_address1 = $_POST['ship_address1'];
 $ship_address2 = $_POST['ship_address2'];
 //echo "shipadd-$ship_address2";
 $ship_city = $_POST['ship_city'];
 $ship_zipcode = $_POST['ship_zipcode'];
 $ship_country= $_POST['ship_country'];
 $ship_state = $_POST['ship_state'];
 $service_choose = $_POST['service_choose'];
 $card_number= $_POST['card_number'];
 $card_type= $_POST['card_type'];
 $card_month = $_POST['card_month'];
 $card_year = $_POST['card_year'];
 $cvv = $_POST['cvv'];
 $total_weight = $_POST['total_weight'];
 $shipping_charge_other_countery=$_POST['shipping_charge_other_countery'];
 
 
 
 

$query11=mysql_query("INSERT INTO `trade`( `tradecode`, `userid`, `userid_part`, `totalM`, `shipM`, `payM`,`writeday`, `name1`, `name2`, `adr1`, `adr2`, `city`, `state`, `country`, `zip`, `rname1`, `rname2`, `radr1`, `radr2`, `rcity`, `rstate`, `rcountry`, `rzip`, `totalweight`,`shipotherM`,`servicechoose`) VALUES 
('$tradecode','$GOOD_SHOP_USERID','$GOOD_SHOP_PART','$totalM','$ship_price','$payM','$time','$name1','$name2','$address1',
'$address2','$city','$state','$country','$zipcode','$ship_name1','$ship_name2','$ship_address1','$ship_address2',
'$ship_city','$ship_state','$ship_country','$ship_zipcode','$total_weight','$shipping_charge_other_countery','$service_choose')");


$temp_row = mysql_fetch_array(mysql_query("select * from trade where tradecode='$tradecode'"));
//print_r($temp_row);

$cart_result = mysql_query("select * from cart where userid='$temp_row[userid]'");
	while($cart_row = mysql_fetch_array($cart_result))
	{

		
	mysql_query("INSERT INTO `trade_goods`( `userid`, `tradecode`, `goodsId`, `supplier_id`,`cnt`, `option1`, `option2`, `option3`, `writeday`, `price`,`message`,`dropship`,`shipping_label`,`length`,`option_index`) VALUES ('$cart_row[userid]','$tradecode','$cart_row[goodsId]','$cart_row[supplier_id]','$cart_row[cnt]','$cart_row[option1]','$cart_row[option2]','$cart_row[option3]',
now(),'$cart_row[price]','$cart_row[message]','$cart_row[dropship]','$cart_row[shipping_label]','$cart_row[length]','$cart_row[option_index]')");
		
		
		$goods_row = mysql_fetch_array(mysql_query("select * from product where id=$cart_row[goodsId] limit 1"));
		if($goods_row['quantity']){
			$new_limitCnt = $goods_row['quantity']-$cart_row['cnt'];
			$sale_amount=$goods_row['sale_amount'];
			$sale_amount=$sale_amount+1;
			if($new_limitCnt <0) $new_limitCnt=0;
			
			  
			
				mysql_query("update product set quantity=$new_limitCnt,sale_amount='$sale_amount' where id=$goods_row[id]");
			
		}
	}
	

?>
<!-- authrize.net form start -->
	<!---	<form name="authorizeFrm" id="authorizeFrm" action="https://test.authorize.net/gateway/transact.dll" method="post">
-->

	<form name="authorizeFrm" id="authorizeFrm" action="process-credit-card.php" method="post">
   	<?php
		
		/**
		 * authorize.net check field create...
		 * x_fp_sequence, x_fp_timestamp, x_fp_hash
		 */
		srand(time());
		$sequence = rand(1, 1000);
		//$ret = InsertFP ($admin_row['shopId'], $admin_row['txnKey'],  $temp_row['payM'], $sequence);		// create hidden value..
		//$ret = InsertFP ('53zHnq9bB6', '5Gkm59d4q48NDhA8', $temp_row['payM'], $sequence);	
	
		//print_r($ret);
		
		?>

		<input type="hidden" name="x_txnkey"                value="<?=$admin_row['shopId']?>">
		<input type="hidden" name="x_login"                 value="<?=$admin_row['txnKey']?>">
		<input type="hidden" name="x_relay_response"        value="TRUE">
		<input type="hidden" name="x_type"                  value="AUTH_CAPTURE">
		<input type="hidden" name="x_version"               value="8.0">
		<input type="hidden" name="x_customer_ip"           value="<?=$REMOTE_ADDR?>">
		<input type="hidden" name="x_test_request"          value="FALSE">
		<input type="hidden" name="x_email_customer"        value="false">
		<input type="hidden" name="x_relay_url"       value="https://ebhahair.com/order_ok.php?tradecode=<?=$tradecode?>&p=paypal">
		<input type="hidden" name="x_method"                value="CC">
		<input type="hidden" name="x_amount"                value="<?=$temp_row['payM']?>">
		<input type="hidden" name="x_cust_id"               value="">
		<input type="hidden" name="x_description"           value="<?=$tradecode?>">
		<input type="hidden" name="x_address"               value="<?=$temp_row['adr1']?><?=$temp_row['adr2']?>">
		<input type="hidden" name="x_city"                  value="<?=$temp_row['city']?>">
		<input type="hidden" name="x_state"                 value="<?=$temp_row['state']?>">
		<input type="hidden" name="x_country"               value="<?=$temp_row['country']?>">
		<input type="hidden" name="x_zip"                   value="<?=$temp_row['zip']?>">
		<input type="hidden" name="x_phone"                 value="<?=$temp_row['tel']?>">
		<input type="hidden" name="x_email"                 value="<?=$temp_row['userid']?>">
		<input type="hidden" name="x_ship_to_first_name"    value="<?=$temp_row['ship_name1']?>">
		<input type="hidden" name="x_ship_to_last_name"     value="<?=$temp_row['ship_name2']?>">
		<input type="hidden" name="x_ship_to_address"       value="<?=$temp_row['radr1']?><?=$temp_row['ship_address2']?>">
		<input type="hidden" name="x_ship_to_city"          value="<?=$temp_row['ship_city']?>">
		<input type="hidden" name="x_ship_to_state"         value="<?=$temp_row['ship_state']?>">
		<input type="hidden" name="x_ship_to_zip"           value="<?=$temp_row['ship_zipcode']?>">
		<input type="hidden" name="x_ship_to_country"       value="<?=$temp_row['ship_country']?>">
		<input type="hidden" name="x_last_name"			    value="<?=$temp_row['name2']?>">
		<input type="hidden" name="x_first_name"		    value="<?=$temp_row['name1']?>">
		<input type="hidden" name="x_card_num"				value="<?=$card_number?>">
		<input type="hidden" name="x_month_date"			value="<?=$card_month?>">
        <input type="hidden" name="x_year_date"			    value="<?=$card_year?>">
		<input type="hidden" name="x_card_code"				value="<?=$cvv?>">
        <input type="hidden" name="x_card_type"				value="<?=$card_type?>">


		</form>
		<!-- authrize.net form end -->
        
        <form name="paypalForm" id="paypalForm" method="post" action="https://www.paypal.com/cgi-bin/webscr">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<?=$admin_row['paypalEmail']?>">
<input type="hidden" name="item_name" value="<?=$tradecode?>">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="amount" value="<?=$temp_row['payM']?>">
<input type="hidden" name="image_url" value="https://ebhahair.com/images/ebhahair.jpg">
<input type="hidden" name="first_name" value="<?=$temp_row['name1']?>">
<input type="hidden" name="last_name" value="<?=$temp_row['name2']?>">
<input type="hidden" name="return" value="https://ebhahair.com/order_ok.php?tradecode=<?=$tradecode?>&p=paypal">
<input type="hidden" name="cancel_return" value="https://ebhahair.com/cart.php">
</form>
        
        <?
		if($pay_method_select=='creditcard'){ ?>
	<script type="text/javascript">
	document.getElementById('authorizeFrm').submit();
	</script>		
            
	<? 	} 
	if($pay_method_select=='paypal'){
	?>
	<script type="text/javascript">
	document.getElementById('paypalForm').submit();
	</script>		
            
	<? 	} 

	?>	
<? }?>
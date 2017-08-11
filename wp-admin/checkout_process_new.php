<?php 
session_start();
require_once('wp-admin/include/connectdb.php');
////////////////////////// gust part  /////////////////////////////////
$country_query=$con_pdo->query("SELECT * FROM `country` where country_name!='' order by country_id asc");
$checkoutoption=$_POST['checkoutoption'];
 if($checkoutoption=='member'){  
 
  $email=$_POST['username'];
  $pass =$_POST['password'];
  $country =$_POST['country'];
  $state=$_POST['state'];
  $address1 =$_POST['billaddress'];
  $address2 =$_POST['billadress2'];
  $city =$_POST['billcity'];
  $zipcode = $_POST['billzip'];
  $f_name = $_POST['gustname1'];
  $l_name = $_POST['billlastname'];
  $com_name =$_POST['com_name'];
  $tel =$_POST['tel1'].'-'.$_POST['tel2'].'-'.$_POST['tel3'];
  $cel =$_POST['cel1'].'-'.$_POST['cel2'].'-'.$_POST['cel3']; 
  $time=time();
 $stmt=$con_pdo->prepare("insert into member set `f_name`=:f_name, `l_name`=:l_name, `email`=:email,`pwd`=:pwd, `address1`=:address1, `address2`=:address2, `city`=:city, `state`=:state, `country`=:country, `zipcode`=:zipcode,`registered_date`=:time");
 $stmt->bindParam(':f_name',$f_name);
 $stmt->bindParam(':l_name',$l_name);
 $stmt->bindParam(':email',$email);
 $stmt->bindParam(':pwd',$pass);
 $stmt->bindParam(':address1',$address1);
 if($address2!=''){
 $stmt->bindParam(':address2',$address2);
 }else{
 $stmt->bindParam(':address2',$address2="");
 }
 $stmt->bindParam(':city',$city);
 if($_POST['state']!=''){
 
 $stmt->bindParam(':state',$state);
 }
 else{
$stmt->bindParam(':state',$state='');	 
 }
 
 $stmt->bindParam(':country',$country);
 
 $stmt->bindParam(':zipcode',$zipcode);
 $stmt->bindParam(':time',$time);
 $stmt->execute();
 $email_login=$email;
		 $pwd_login=$pass;
$stmtautologin=$con_pdo->prepare("select * from member where `email`=:email_login and `pwd`=:pwd_login ");
 $stmtautologin->bindParam(':email_login',$email_login);
 $stmtautologin->bindParam(':pwd_login',$pwd_login);
 $stmtautologin->execute();
  $count=$stmtautologin->rowCount();
  if($count>0){
   $user_info_row = $stmtautologin->fetch(PDO::FETCH_ASSOC);
	 if($user_info_row['supplier']==1){
	$_SESSION['user_type']='Supplier';
	 }
	 else{
		$_SESSION['user_type']='Buyer';	 
	 }
	 $_SESSION['GOOD_SHOP_USERID']=$user_info_row['email'];
	 $_SESSION['GOOD_SHOP_PART']='member';
	 $_SESSION['member_id']=$user_info_row['member_id'];
	 $_SESSION['company_name'] = $user_info_row['company_name'];
	 $_SESSION['verify_status'] = $user_info_row['verify_status'];
	 $_SESSION['level'] = $user_info_row['level'];
	 $GOOD_SHOP_USERID= $_SESSION['GOOD_SHOP_USERID'];
//echo $GOOD_SHOP_USERID;
	if(empty($GOOD_SHOP_USERID)){	//registering non-member session id
		$GOOD_SHOP_USERID	= time();
		$GOOD_SHOP_NAME		= "non-member";
		$GOOD_SHOP_PART		= "guest";
		$GOOD_SHOP_LEVEL		= 0;
		$GOOD_SHOP_CART		= $GOOD_SHOP_USERID;
		$_SESSION['GOOD_SHOP_USERID'] = $GOOD_SHOP_USERID;
		//echo $GOOD_SHOP_USERID;
		$_SESSION['GOOD_SHOP_NAME'] = $GOOD_SHOP_NAME;
		$_SESSION['GOOD_SHOP_LEVEL'] = $GOOD_SHOP_LEVEL;
		$_SESSION['GOOD_SHOP_PART'] = $GOOD_SHOP_PART;
		$_SESSION['GOOD_SHOP_CART'] = $GOOD_SHOP_CART;
	
	}
	if($_SESSION['GOOD_SHOP_CART']!=$GOOD_SHOP_USERID)
	{
	mysql_query("update cart set userid='$GOOD_SHOP_USERID' where userid='$_SESSION[GOOD_SHOP_CART]'");
	}	  	
		} 
}

 $REMOTE_ADDR=$_SERVER['REMOTE_ADDR'];
$admin_row = mysql_fetch_assoc(mysql_query("SELECT * FROM `admin` where idx=1"));
if(isset($_POST['tradecode'])){
$GOOD_SHOP_USERID=$_SESSION['GOOD_SHOP_USERID'];
$GOOD_SHOP_PART = $_SESSION['GOOD_SHOP_PART'];
//echo "select * from member where email=$GOOD_SHOP_USERID";
$user_result=mysql_query("select * from member where email='$GOOD_SHOP_USERID'");
$user_row=mysql_fetch_array($user_result);
$ISR=$user_row['ISR'];
 
 $tradecode = $_POST['tradecode'];
 $totalM = $_POST['totalM'];
 $ship_price = $_POST['ship_price_hidden'];
 $discountval = $_POST['discountval'];
 $payM = $_POST['payM']; 
 $pay_method_select = $_POST['pay_method_select'];
 $time= time();
 $name1= $_POST['gustname1'];
 $name2 = $_POST['billlastname'];
 $address1 = $_POST['billaddress'];
 $address2 = $_POST['billadress2'];
 $city = $_POST['billcity'];
 $billphone=$_POST['billTel'];
 $zipcode = $_POST['billzip'];
 $country= $_POST['country'];
 $state = $_POST['state'];
 $userid=$_POST['userid'];

 $ship_name1= $_POST['shipfname'];
 $ship_name2 = $_POST['shiplname'];
 $ship_address1 = $_POST['shipaddress'];
 $ship_address2 = $_POST['shipaddress2'];
 $shipphone = $_POST['shipphone'];
 //echo "shipadd-$ship_address2";
 $ship_city = $_POST['shipcity'];
 $ship_zipcode = $_POST['ship_zipcode'];
 $ship_country= $_POST['ship_country'];
 $ship_state = $_POST['ship_state'];
 $service_choose = $_POST['service_choose'];
 $addinfo=$_POST['addinfo'];
 $card_number= $_POST['card_number'];
 $card_type= $_POST['card_type'];
 $card_month = $_POST['card_month'];
 $card_year = $_POST['card_year'];
 $cvv = $_POST['cvv'];
 $total_weight = $_POST['total_weight'];
 $shipping_charge_other_countery=$_POST['shipping_charge_other_countery'];
 $storepickup=$_POST['storepickup'];
 if($storepickup){
 $type="Pickup";
 }
 $usedcoupon=$_POST['usedcoupon'];
 $totalcredit=$_POST['credit'];
 if($_POST['storecredit']){
		 if($totalcredit>=$payM){
		 $credit_used=$payM;
		 $remaining_credit=$totalcredit-$credit_used;
		 $payM=0;
		 }else{
		 $remaining_credit=0;
		 $payM=$payM-$totalcredit;
		 $credit_used=$totalcredit;
		 }
 }
 
 
 

$query11=mysql_query("INSERT INTO `trade`( `tradecode`, `userid`, `userid_part`, `totalM`, `shipM`, `payM`,`writeday`, `name1`, `name2`, `adr1`, `adr2`, `city`, `state`, `country`, `zip`, `rname1`, `rname2`, `radr1`, `radr2`, `rcity`, `rstate`, `rcountry`, `rzip`, `totalweight`,`shipotherM`,`servicechoose`,`addinfo`,`bill_phone`,`ship_phone`,`bill_address2`,`ship_address2`,`discount`,`storeid`,`order_type`,`ISR`,`coupon_code`,`credit_used`,`remaining_credit`) VALUES 
('$tradecode','$GOOD_SHOP_USERID','$GOOD_SHOP_PART','$totalM','$ship_price','$payM','$time','$name1','$name2','$address1',
'$address2','$city','$state','$country','$zipcode','$ship_name1','$ship_name2','$ship_address1','$ship_address2',
'$ship_city','$ship_state','$ship_country','$ship_zipcode','$total_weight','$shipping_charge_other_countery','$service_choose','$addinfo','$billphone','$shipphone','$address2','$ship_address2','$discountval','$storepickup','$type','$ISR','$usedcoupon','$credit_used','$remaining_credit')");


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
		 if($temp_row['payM']==0){?>
         <script type="text/javascript">
			 window.location = "https://ebhahair.com/order_ok.php?tradecode=<?=$tradecode?>";
	         </script>	
		<? }else{
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
            
	<? 	} }  ?>
    
    <? }else{?>
            <script type="text/javascript">
			 window.location = "https://ebhahair.com/order_ok.php?tradecode=<?=$tradecode?>";
	         </script>		

<? }?>
    	


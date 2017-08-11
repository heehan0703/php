<?php
session_start();
$p=$_GET['p'];
$q=$_GET['p'];
 $member_id=$_SESSION['member_id'];
 
 $GOOD_SHOP_USERID =$_SESSION['GOOD_SHOP_USERID'];
 
 $tradecode=$_GET['tradecode'];

require_once('wp-admin/include/connectdb.php');

$admin_row = mysql_fetch_assoc(mysql_query("SELECT * FROM `admin` where idx=1"));


if($member_id!=''){

mysql_query("delete from cart where userid='$GOOD_SHOP_USERID'");


$member_row = mysql_fetch_assoc(mysql_query("SELECT * FROM `member` where member_id =$member_id"));
if($p == 'paypal')
{
$query_update = mysql_query("Update `trade` set paymethod = 'PayPal' where tradecode='$tradecode'");
}


if($q == 'card')
{
$query_update = mysql_query("Update `trade` set paymethod = 'Credit Card' where tradecode='$tradecode'");
}

$tradecode_row = mysql_fetch_assoc(mysql_query("SELECT * FROM `trade` where tradecode='$tradecode'"));
$remaining_credit=$tradecode_row['remaining_credit'];

$num=mysql_num_rows(mysql_query("SELECT * FROM `rewards` where tradecode='$tradecode' and  customer_id='$member_id' and transaction_type='debited'"));


if(!$num){
$used_credit=$tradecode_row['credit_used'];
$order_id=$tradecode_row['id'];
$ti=time();

$debited_customer_id=$member_id;
if($member_id){
mysql_query("Update `member` set account_credit = '$remaining_credit' where member_id='$member_id'");
}

 mysql_query("insert into rewards set customer_id='$debited_customer_id',order_id='$order_id',date_complete='$ti',tradecode='$tradecode',reward='$used_credit', transaction_type='debited'");
 }

$tradegoods_query = mysql_query("SELECT * FROM `trade_goods` where tradecode='$tradecode'");

if($tradecode_row['state']!=0){

$bill_state = mysql_result(mysql_query("SELECT state_name FROM `state` where state_id='$tradecode_row[state]'"),0);
}

if($tradecode_row['rstate']!=0){

$ship_state = mysql_result(mysql_query("SELECT state_name FROM `state` where state_id='$tradecode_row[rstate]'"),0);

}

$bill_country = mysql_result(mysql_query("SELECT country_name  FROM `country` where country_Id='$tradecode_row[country]'"),0);

$ship_country = mysql_result(mysql_query("SELECT country_name  FROM `country` where country_Id='$tradecode_row[rcountry]'"),0);

 $writeday = date('d/m/Y h:i:s',$tradecode_row['writeday']);
$body ="";

$dropship_count =0;
while($tradegoods_row= mysql_fetch_assoc($tradegoods_query))
{	

$product_info = mysql_fetch_assoc(mysql_query("SELECT product_code,product_name FROM `product` where id='$tradegoods_row[goodsId]'"));
 $color_option = explode('-',$tradegoods_row['option1']);
 $color_option = $color_option[1];
 
 $length_option = explode('-',$tradegoods_row['option2']);
 $length_option = $length_option[1];
 
  $tprice = $tradegoods_row['cnt']*$tradegoods_row['price'];
 
 $dropship_pricee =0;
 
 if($tradegoods_row['dropship']==1)
 { $dropship_count++;
  $dropship_pricee++;
  }
  
  $supplier_total_price = $tprice+$dropship_pricee;
 
 $supplier_info = mysql_fetch_assoc(mysql_query("SELECT f_name,l_name,email FROM `member` where member_id='$tradegoods_row[supplier_id]'"));
 $body .="";
	 ///dynamic list start //
 	 
	
   $supplier_bodyy =" 
   <html>
   <body>
   <img  src='https://ebhahair.com/images/logo1.png' width='187' height='67' border='0' style='display: block; margin-left: auto;
    margin-right: auto;'>

<hr /  style='height:3px;'>
<p> <h2 align='center'> Hi $supplier_info[f_name] $supplier_info[l_name],,</h2></p>
<p align='center'>Congratulations, your item sold—get ready to ship!</p>

<p> You did it! Your item sold. Please ship your item with this invoice <b>as soon as possible.</b> </p>
<p>Ship to ebhahair.com </p>
<p>1951 Landmeier Rd Elk Grove Village,IL 60007</p>

<table bgcolor='#FCFBFC' border=0  cellpadding =0 cellspacing=0 width='100%'>

<tr>
<td style ='padding-top: 20px; padding-left:20px;'>
<p><span style='font-size:13.5pt;'>Order Details</span></p>
</td>

</tr>
<tr>
<td>
<hr / width='97%' align='center'>
</td>
</tr>

<tr>
<td style ='padding-left:20px;'>
<span><strong>Order :</strong></span> $writeday
</td>
</tr>

<tr>
<td style ='padding-left:20px;'>
<span><strong>Trade Code :</strong></span> $tradecode_row[tradecode]
</td>
</tr>


<tr>
<td style ='padding-left:20px;'>
<span><strong>Payment : </strong></span> $tradecode_row[paymethod]</td>
</tr>

<tr>
<td style ='padding-left:20px;'>
<span><strong>Shipping : </strong></span> Dropship</td>
</tr>

</table>

<table bgcolor='#FCFBFC' border=1  cellpadding =0 cellspacing=0 width='100%' style='margin-top: 20px'>
<tr>
<td style ='padding-left:20px;'>Product Code </td>
<td style ='padding-left:20px;'>Product</td>
<td style ='padding-left:20px;'>Unit price </td>
<td style ='padding-left:20px;'>Quantity </td>
<td style ='padding-left:20px;'>Total price </td>
</tr>

<tr >
<td colspan='5' bgcolor='#FFFFFF' height:25px;></td>
</tr>


<tr>
<td style ='padding-left:20px;'>$product_info[product_code] </td>
<td style ='padding-left:20px;'>$product_info[product_name] - Color : $color_option, Size : $length_option</td>
<td style ='padding-left:20px;'>$ $tradegoods_row[price]</td>
<td style ='padding-left:20px;'>$tradegoods_row[cnt]</td>
<td style ='padding-left:20px;'>$ $tprice</td>
</tr>

<tr >
<td colspan='5' bgcolor='#FFFFFF' style='height: 25px;'></td>
</tr>

<tr>
<td colspan='4' align='right'><strong>Products</strong></td><td  align='center'>$ $tradecode_row[totalM]</td>
</tr>

<tr>
<td colspan='4' align='right'><strong>Discounts</strong></td><td  align='center'>$0.00</td>
</tr>

<tr>
<td colspan='4' align='right' ><strong>Dropship Fee</strong></td><td  align='center'>$ $dropship_count<td></td>
</tr>


<tr>
<td colspan='4' align='right' ><strong>Total paid</strong> </td><td  align='center'>$ $tradecode_row[payM]</td>
</tr>



</table>


<hr /  style='height:3px;'>
</body>

</html>

 
  ";

  
   $subject_supplier ="Congrats! your item sold";

         $headers_supplier =  "From:ebhahair.com\r\n";
		 $headers_supplier .= 'MIME-Version: 1.0' . "\r\n";
         $headers_supplier .= 'Content-type:text/html;charset=iso-8859-1' . "\r\n";
		 
		//$to_supplier ='kaushiknitin2701@gmail.com';
		 $to_supplier =$supplier_info['email'];
		 

		$mail=mail($to_supplier,$subject_supplier,html_entity_decode($supplier_bodyy),$headers_supplier);   
		if($mail){
 echo "success";
  }else{
 echo "failed."; 
  }
	
	 
	 	 

	 // dynamaic list end //

$body .=" <html>
<body>
<img src='https://ebhahair.com/images/logo1.PNG' width='150' border='0' style='display: block; margin-left: auto;
    margin-right: auto;'>
<hr /  style='height:3px;'>
<p> <h2 align='center'> Hi $member_row[f_name]  $member_row[l_name],</h2></p>

<p> Thank you for shopping with ebhahair!</p>

<table bgcolor='#FCFBFC' border=0  cellpadding =0 cellspacing=0 width='100%'>

<tr>
<td style ='padding-top: 20px; padding-left:20px;'>
<p><span style='font-size:13.5pt;'>Order Details</span></p>
</td>

</tr>
<tr>
<td>
<hr / width='97%' align='center'>
</td>
</tr>

<tr>
<td style ='padding-left:20px;'>
<span><strong>Order :</strong></span> $writeday
</td>
</tr>

<tr>
<td style ='padding-left:20px;'>
<span><strong>Trade Code :</strong></span> $tradecode_row[tradecode]
</td>
</tr>


<tr>
<td style ='padding-left:20px;'>
<span><strong>Payment : </strong></span> $tradecode_row[paymethod]</td>
</tr>

</table>

<table bgcolor='#FCFBFC' border=1  cellpadding =0 cellspacing=0 width='100%' style='margin-top: 20px'>
<tr>
<td style ='padding-left:20px;'>Product Code </td>
<td style ='padding-left:20px;'>Product</td>
<td style ='padding-left:20px;'>Unit price </td>
<td style ='padding-left:20px;'>Quantity </td>
<td style ='padding-left:20px;'>Total price </td>
</tr>

<tr >
<td colspan='5' bgcolor='#FFFFFF' height:25px;></td>
</tr>


<tr>
<td style ='padding-left:20px;'>$product_info[product_code] </td>
<td style ='padding-left:20px;'>$product_info[product_name] - Color : $color_option, Size : $length_option</td>
<td style ='padding-left:20px;'>$ $tradegoods_row[price]</td>
<td style ='padding-left:20px;'>$tradegoods_row[cnt]</td>
<td style ='padding-left:20px;'>$ $tprice</td>
</tr>

<tr >
<td colspan='5' bgcolor='#FFFFFF' style='height: 25px;'></td>
</tr>

<tr>
<td colspan='4' align='right'><strong>Products</strong></td><td  align='center'>$ $tradecode_row[totalM]</td>
</tr>

<tr>
<td colspan='4' align='right'><strong>Discounts</strong></td><td  align='center'>$0.00</td>
</tr>

<tr>
<td colspan='4' align='right' ><strong>Dropship Fee</strong></td><td  align='center'>$ $dropship_count<td></td>
</tr>

<tr>
<td colspan='4' align='right' ><strong>Shipping</strong></td><td  align='center'>$ $tradecode_row[shipM]</td>
</tr>
<tr>
<td colspan='4' align='right'><strong>Total Tax paid</strong> </td><td  align='center'>$0.00</td>
</tr>

<tr>
<td colspan='4' align='right' ><strong>Total paid</strong> </td><td  align='center'>$ $tradecode_row[payM]</td>
</tr>



</table>

<table width='100%' bgcolor='#FCFBFC' border=0  cellpadding =0 cellspacing=0  style='margin-top:20px;'>

<tr>
<td style ='padding-top: 20px; padding-left:20px;'>
<p><span style='font-size:13.5pt;'>Shipping</span></p>
</td>

</tr>
<tr>
<td>
<hr / width='97%' align='center'>
</td>
</tr>

<tr>
<td style ='padding-left:20px;'>
<span><strong>Carrier:</strong></span> My carrier
</td>
</tr>
<tr>
<td style ='padding-left:20px;'>
<span><strong>Payment: </strong></span> $tradegoods_row[shipM]
</td>
</tr>
</table>



<table width='100%' bgcolor='#FCFBFC' border=0  cellpadding =0 cellspacing=0  style='margin-top:20px;'>
<tr>
<td width='40%' style ='padding-top: 20px; padding-left:20px;'>
<p><span>Delivery address </span></p>
</td>

<td width='20%' bgcolor='#FFFFFF'> 
</td>

<td width='40%' style ='padding-top: 20px; padding-left:20px;'>
<p><span>  Billing address  </span></p>
</td>

</tr>

<tr>
<td width='40%'>
<hr / width='97%' align='center'>
</td>

<td width='20%' bgcolor='#FFFFFF'> 
</td>

<td width='40%'>
<hr / width='97%' align='center'>
</td>
</tr>


<tr>
<td style ='padding-left:20px;' width='40%'>
<b>$tradecode_row[name1]</b><br>
<b>$tradecode_row[name2]</b><br>
$tradecode_row[adr1]<br>
         $tradecode_row[adr2]<br>
        $tradecode_row[city], $bill_state,  $tradecode_row[zip] <br>
       $bill_country <br>
</td>

<td width='20%' bgcolor='#FFFFFF'> 
</td>

<td width='40%'>
<b> $tradecode_row[rname1]</b><br>
<b> $tradecode_row[rname2]</b><br>
        $tradecode_row[radr1] <br>
         $tradecode_row[radr2] <br>
        $tradecode_row[rcity], $ship_state,  $tradecode_row[rzip] <br>
       $ship_country <br>

</td>
</tr>




</table>











<p> You can review your order and download your invoice from the 
<a href='https://ebhahair.com/prestabrain/megashop/default/index.php?controller=history'>
<span style='color:#337FF1'>&quot;Order history&quot;</span></a> 
section of your customer account by clicking 
<a href='https://ebhahair.com/prestabrain/megashop/default/index.php?controller=my-account'>
<span style='color:#337FF1'>&quot;My account&quot;</span></a> on our shop. </span>
</p>

<p>
If you have a guest account, you can follow your order via the 
<a href='https://ebhahair.com/prestabrain/megashop/default/index.php?controller=guest-tracking?id_order=WQWKCUWRU'>
<span style='color:#337FF1'>&quot;Guest Tracking&quot;</span></a> section on our
    shop. </span>
	</p>

<hr /  style='height:3px;'>
</body>

</html>";
 $subject ="[ebhahair] Order confirmation";

         $headers =  "From:ebhahair.com\r\n";
		 $headers .= 'MIME-Version: 1.0' . "\r\n";
         $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
		//$to ='nitinkaushik01@yahoo.co.in';
		 $to =$tradecode_row['userid'];

		$mail1= mail($to,$subject,html_entity_decode($body),$headers);
		if($mail1){
// echo "success_nitin";
  }else{
// echo "failed._nitin"; 
  }
		
}
}

?>
<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Checkout Page</title>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
	
 
    </script>
<style type="text/css">
@import url(//fonts.googleapis.com/css?family=Lato:400,700,900);
.overlay-mask {
	background: none repeat scroll 0 0 rgba(28, 45, 50, 0.8);
	bottom: 0;
	height: 100%;
	left: 0;
	position: fixed;
	right: 0;
	top: 0;
	width: 100%;
	z-index: 999999;
	display: none;
	overflow-y: auto;
	overflow-x: hidden;
}
.overlay.iframe-content {
	border: 2em solid #fff;
	border-radius: 6px;
	box-sizing: content-box;
	padding: 0;
	width: 90%;
}
.overlay {
	background: none repeat scroll 0 0 #fff;
	border-radius: 3px;
	box-shadow: 0 1px 3px rgba(23, 74, 104, 0.35), 0 0 32px rgba(60, 82, 93, 0.35);
	box-sizing: border-box;
	margin: 50px auto 0;
	padding: 30px;
	position: relative;
}
.overlay.iframe-content .title {
	border: medium none;
	margin: 0;
	position: absolute;
}
.overlay .title {
	border-bottom: 1px solid #e2e8ea;
	margin-bottom: 20px;
}
.overlay .close-icon {
	font: 32px Dingbatz;
	color: #b3c5d0;
	content: "";
	display: block;
	font: bold 20px "Dingbatz";
	position: absolute;
	right: 0;
}
.overlay.iframe-content .close-icon {
	/*background: none repeat scroll 0 0 white;
	border-radius: 32px;
	height: 32px;
	left: 706px;
	position: absolute;
	top: -16px;
	width: 32px;

*/
	background: none repeat scroll 0 0 #000;
	border-radius: 32px;
	color: white;
	height: 32px;
	opacity: 1;
	position: absolute;
	right: -2em;
	top: -2em;
	width: 32px;
}
.overlay .close-icon {
	cursor: pointer;
	float: right;
}
.full {
	width: 100%;
	overflow: hidden;
}
.search-header {
	border: 1px solid #e5e5e5;
	border-bottom-left-radius: 2px;
	border-top-left-radius: 2px;
	color: #828282;
	height: 40px;
	margin-right: -1px;
	padding: 8px;
}
.arrow-down-cls {
	-webkit-appearance: none;
	-moz-appearance: none;
	background: transparent url("http://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/br_down.png") no-repeat right center;
//width:100%;
}
#pts_search_query_top {
	border: 1px solid #e5e5e5;
	color: #828282;
	display: inline;
	height: 40px;
	margin-right: -1px;
	min-width: 310px;
	padding: 8px 10px;
}
.red-btn {
	border: 0 none;
	border-radius: 2px;
	color: #fff;
	padding: 0.8em;
	background: #F14E47;
}
.blue-btn {
	background: #2992C1;
	border: 0 none;
	border-radius: 2px;
	color: #fff;
	padding: 0.8em;
}
.menu-home {
	list-style: none outside none;
}
.menu-home >li {
	float: left;
	padding: 10px 5px;
	color: #FFF;
}
.vertical-menu {
	background: none repeat scroll 0 0 #fff;
	color: #000;
	float: left;
	border-right: 1px solid #eee;
	list-style: outside none none;
	position: absolute;
	display: none;
	width: 90%;
}
.vertical-menu > li {
	padding: 0.5em 0;
}
#body_container {
	background-image: url("images/strip.png");
	background-repeat: repeat-x;
	background-color: #F5F5F5;
}
.category_title {
	font-family: "shruti-bold";
	font-size: 16px;
	height: 85px;
	line-height: 85px;
	margin: 0;
	padding: 0 10px 0 25px;
}
.active-menu {
	color: #60AACC;
	border: 1px solid #EEEEEE;
	border-right: 0;
	width: 101%;
}
.footer-menu {
	list-style: none outside none;
	padding-left: 0px;
}
.footer-menu li {
	padding: 5px 0px;
	text-transform: uppercase;
}
.full-hidden {
	display: none;
}
.full-hidden-menu {
	height: 0;
	width: 0;
}
.background-img {
	background-image: url('images/flower_strip.png');
	height: 130px;
}
.atss {
	background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
	position: fixed;
	top: 20%;
	width: 48px;
	z-index: 100020;
}
.atss a {
 //background: none repeat scroll 0 0 #e8e8e8;
	display: block;
	float: left;
 //line-height: 48px;
	margin: 0;
	outline: medium none;
	overflow: hidden;
	padding: 0px 0;
	position: relative;
	text-align: center;
 // text-indent: -9999em;
	transition: width 0.15s ease-in-out 0s;
	width: 48px;
	z-index: 100030;
}
.atss-right {
	float: right;
	left: auto;
	right: 0;
}
.input-xm {
	width: 21%;
}
.dotted-class {
	border-bottom: 1px dotted #999;
	display: inline-block;
	height: 1px;
}
.dotted-text {
	overflow: hidden !important;
	text-overflow: ellipsis;
	white-space: nowrap !important;
}
@media (max-width: 726px) {
.small-padding-zero {
	padding: 0px !important;
}
}
 @media (max-width: 426px) {
.full-hidden {
	display: block;
}
.row-30-small {
	width: 30% !important;
	float: left !important;
}
#pts_search_query_top {
	min-width: 70% !important;
	width: 120px;
}
.search-header {
	font-size: .6em;
}
.row-30-small-right {
	float: right;
	padding-top: 3em;
	position: absolute;
	right: 0;
	width: 50%;
}
.small-hidden {
	display: none;
}
.small-margin-5 {
	margin-top: 5em;
}
.small-margin-2 {
	margin-top: 2em;
}
.small-margin-bottom-1 {
	margin-bottom: 1em;
}
.vertical-menu {
	margin-top: -1em;
	width: 82.5% !important;
	z-index: 222;
	border: 1px solid #909090;
	border-top: 0px;
}
.small-rotate-img {
	margin-left: 42%;
	text-align: center;
	transform: rotate(270deg);
	margin-bottom: -11em;
	margin-top: -10em;
}
.col-lg-4, .col-lg-3 {
	margin-bottom: 1em;
}
.small-padding-zero {
	padding: 0px !important;
}
.small-width-full {
	width: 96% !important;
	padding: 0 2% !important;
}
.small-width-60 {
	width: 60% !important;
}
.row-25-small {
	width: 25% !important;
	float: left !important;
}
.row-50-small {
	width: 50% !important;
	float: left !important;
}
.small-width-40 {
	width: 40% !important;
}
.small-text-center {
	text-align: center !important;
}
.small-padding-left-15 {
	padding: 0 15% !important;
}
.small-border-dotted {
	border: 1px dashed !important;
	padding: .5em !important
}
.small-margin-bottom-hidden {
	margin-bottom: 0px !important;
}
.small-font {
	font-size: .7em;
}
.menu-small {
	background-color: rgba(0, 0, 0, 0.3);
	color: #fff;
	height: 42px;
	margin-left: 2em;
	margin-top: 1em;
	padding-top: 14px;
	text-align: center;
	width: 50px;
}
.full-hidden-menu {
	list-style: none outside none;
	background-color: #242424;
	margin: 1% 5%;
	padding-left: 0;
	width: 90%;
	height: auto;
}
.full-hidden-menu >li {
	border-bottom: 1px solid;
	color: #fff;
	padding: 0.5em;
	position: relative;
}
.overlay.iframe-content {
	width: 70% !important;
}
.text-right-small div {
	text-align: left !important;
}
.border-bottom-small {
	border-right: 0px !important;
	border-bottom: 1px solid #eeeeee;
	margin-bottom: 2em;
	padding-bottom: 2em;
}
}
.no-border {
	border: 0;
}
#loader_container {
	display: none;
}
</style>
<link href="css/custom.css" rel="stylesheet">
</head>
<body>
<div class="full"> 
  <!--header start-->
  <?php include('header_new.php')?>
  
  <!--header end--> 
  
  <!--body start-->
  <div class="full" id="body_container">
    <div class="container">
     <div class="full" style="margin-top:1.5em; margin-left:20%; border:medium;">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <h3>Thank you for shopping with EBHAhair!</h3>
              <p>Order Numbar is : <?=$tradecode?></p>
              <p>We have received your enquiry and will respond to you within 24 hours. We will email you with a confirmation</p>
              <p>that we have received your enquiry</p>
              <p>For urgent enquiries please call us on one of the telephone numbers below.</p>
              <p></p>
              <p></p>
              <hr><p>Contact Us</p><hr>
              <p>Americas</p>
              <p>Mon-Fri : 9:00 a.m. - 5:00 p.m.(Central time)</p>
              <p>International Call : 1-847-324-3010</p>
              <p>Call : 847-621-2289</p>
              <p>Fax : 847-621-2291</p>
              <a href="index.php"> <input type="button" class="red-btn" value="Continue Shopping" name="preview"  style="background:#298BB8; margin-bottom:30px; font-size:1.2em;" ></a>
              </div> 
         </div>
      
    </div>
  </div>
  
  <!--body end--> 
  
  <!-- footer start-->
  
  <?php include('foot_new.php')?>
  
  <!--footer end  --> 
  
</div>



<!-- loader show start -->
<div id="loader_container" class="overlay-mask" style="">
  <div class="full" align="center" style="margin-top:6em;"> <img src="images/loader.gif" width="100" height="100" > </div>
</div>
<!-- loader show end  --> 

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>

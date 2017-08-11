<?php 
session_start(); 


require_once('../wp-admin/include/connectdb.php');
include('../wp-admin/pager.php');
///login start ///
/*if(isset($_POST['email_login'])){
	 
	 $email_login=$_POST['email_login'];
	  $pwd_login=$_POST['pwd_login'];
	 
	
	 
$stmt=$con_pdo->prepare("select * from member where `email`=:email_login and `pwd`=:pwd_login");
 
 $stmt->bindParam(':email_login',$email_login);
 $stmt->bindParam(':pwd_login',$pwd_login);
 
 $stmt->execute();
 
  $count=$stmt->rowCount();
 
 
 if($count>0){
	 
	 $user_info_row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
	 if($user_info_row['supplier']==1){
	
	$_SESSION['user_type']='Supplier';
		 
	 }
	 else{
		$_SESSION['user_type']='Buyer';	 
	 }
	 
	 $_SESSION['GOOD_SHOP_USERID']=$user_info_row['email'];
	 
	 $_SESSION['GOOD_SHOP_PART']='member';
	 
	 $_SESSION['member_id']=$user_info_row['member_id'];
	 

	 
	 	 
 }
 
 else{
echo '<script type="text/javascript">
alert("You are not login ! Please try again ");
</script>';	 
 }
 
 }
// login end //
*/

 $GOOD_SHOP_USERID= $_SESSION['GOOD_SHOP_USERID'];
 



$user_id=$_SESSION['member_id'];
if($user_id!=''){
	
if(isset($_POST['shipping_status_update']))
{
	
	$id = $_POST['shipping_status_id'];
	$shipping_status = $_POST['shipping_status'];
	mysql_query("update `trade_goods` set shipping_status ='$shipping_status' where id ='$id'");
   
}



if(isset($_POST['shipping_details_update']))
{
	
	$id = $_POST['trans_company_id'];
	$shipping_method = $_POST['trans_company'];
	$tracking_id = $_POST['tracking_id'];
	$tracking = $_POST['tracking'];
	
	mysql_query("update `product` set shipping_method ='$shipping_method' where id ='$id'");
   
   mysql_query("update `trade_goods` set tracking ='$tracking' where id ='$tracking_id'");
   
}


$stmt =mysql_query(dopaging("SELECT * FROM `trade_goods` where supplier_id = $user_id order by writeday desc" ,10));
 $stmt_1=mysql_query("SELECT * FROM `trade_goods` where supplier_id = $user_id order by writeday desc" );

//$wig_list_query=mysql_query(dopaging("SELECT * FROM `product` where user_id = $user_id",20));
//payment part--$sale_complete_amount//
//$sale_complete_amount=mysql_result(mysql_query("SELECT sum(t.payM)  FROM `trade` as t left join `trade_goods` as td on td.tradecode=t.tradecode  where td.supplier_id='$user_id' and t.order_status='Complete'
//"),0);
//total amount --$allsale_amount//
//$sale_complete_amount=mysql_result(mysql_query("SELECT sum(t.payM)  FROM `trade` as t left join `trade_goods` as td on td.tradecode=t.tradecode  where td.supplier_id='$user_id' and t.order_status='Complete'
//"),0);

$allsale_amount=mysql_result(mysql_query("SELECT sum(t.payM)  FROM `trade` as t left join `trade_goods` as td on td.tradecode=t.tradecode  where td.supplier_id='$user_id' 
"),0);


$hold_count= mysql_result(mysql_query("select count(id) from product where user_id='$user_id' and quantity='0'"),0);

$active_count= mysql_result(mysql_query("select count(id) from product where user_id='$user_id' and quantity='1'"),0);

//$sold_query = mysql_query("  SELECT * FROM `trade_goods` as td left join `product` as pd on td.id=pd.id where td.supplier_id='$user_id' ");

$return_count = mysql_result(mysql_query("SELECT count(distinct td.goodsId)    FROM `trade_goods` as td left join `product` as pd on td.id=pd.id   where td.supplier_id='$user_id' and return_issue IN (1,2,3,4,5)"),0);

$distinct_product_count= mysql_result(mysql_query("SELECT count(distinct td.goodsId)   FROM `trade_goods` as td left join `product` as pd on td.id=pd.id  where td.supplier_id='$user_id'  "),0);

$total_product_count=$hold_count+$active_count;

$unsold_count = $total_product_count-$distinct_product_count;
 
}





if($_GET['act']=='end_item'){
  $p_id = $_GET['p_id'];	
  $stock_item=mysql_result(mysql_query("select stock from product where id='$p_id' and user_id='$user_id'"),0);
 
$new_stock = preg_replace('/[0-9]/',0, $stock_item);

mysql_query("update product set quantity='0',stock='$new_stock' where id='$p_id' and user_id='$user_id'");

  header("location:index.php");
}

if(isset($_POST['act_type']) && $_POST['act_type']!=''){

 $act_type = $_POST['act_type'];
 $product_id = $_POST['product_id'];
foreach($product_id as $pro_id){
	if($act_type=='del'){
	
	$query="delete FROM `product` where id='$pro_id' and user_id='$user_id'";
	if(mysql_query($query)){

	mysql_query("delete  FROM `product_other_option` where product_id='$pro_id'");
		
	}
		
	}
	else{
	$stock_item=mysql_result(mysql_query("select stock from product where id='$pro_id' and user_id='$user_id'"),0);
 
$new_stock = preg_replace('/[0-9]/',0, $stock_item);

mysql_query("update product set quantity='0',stock='$new_stock' where id='$pro_id' and user_id='$user_id'");
	}
	
	
}

}


?>
<!doctype html>
<html>
<meta content="<p>Welcome  to Oakfield IT,your most dependable and one stop solution for your IT training, installation, implementation, recruitment and consulting needs. With over six years of training, work of experience, in-depth knowledge, industrial domain experience, business processes and exceptional technical understanding, we are able</p>" name="description">
<meta content="Oakfield ,education" name="keywords">
<meta content="Oakfield" name="author">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>My Products</title>

<!-- Bootstrap -->
<link href="../css/bootstrap.min.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
	
 function show_content_slide(cls){
 $("."+cls).slideToggle('fast');
 }
   
function show_content(cls){
$("."+cls).show(0);
}
function hide_content(cls){
	$("."+cls).hide(0);
}
	
function close_popup(id){
 //$(".overlay-mask").fadeOut('slow');	
 $("#"+id).fadeOut('slow');
}	
<? if($_SESSION['user_type']!='Supplier'){?>

$(document).ready(function(e) {
	
    $("#overlay-mask-1").fadeIn('slow');
	

});


function validate(){

var email=document.getElementById('email_login').value;
var pwd=document.getElementById('pwd_login').value
	
	if(email==''){
	alert('Please enter email !');
	document.getElementById('email_login').focus();
	return false;
		
	}
	
	if(pwd==''){
	alert('Please enter password !');
	document.getElementById('pwd_login').focus();
	return false;
		
	}
	
}

<? } ?>
function update_action(act_type){
	$("#act_type").val(act_type);
if($('.small-hidden').is(':visible'))
{
// alert('smallhiden');
 $('.small-hidden input').prop('disabled', false);
  $('.full-hidden input').prop('disabled', true);
  
}  
if($('.full-hidden').is(':visible'))
{
  // alert('fullhiden');
    $('.full-hidden input').prop('disabled', false);
	$('.small-hidden input').prop('disabled', true);
} 

if($('input[name="product_id[]"]:checked').length == 0){
		alert('please check  atleast one product');
		return false
	}

else{
$("#indexform").submit();
	
}
	
	
}


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
	background: transparent url("https://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/br_down.png") no-repeat right center;
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
	list-style: outside none none;
	position: absolute;
	width: 90%;
}
.vertical-menu > li {
	padding: 0.5em 0;
}
#body_container {
	//background-image: url("images/strip.png");
	//background-repeat: repeat-x;
	background-color: #fff;
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
	border-right: 0px;
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
	background-image: url('../images/flower_strip.png');
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
.input-xm{
	width:21%;
}

.dotted-class{
	border-bottom: 1px dotted #999;
    display: inline-block;
    height: 1px;
}

.bg-dotted{
	background-image:url('../images/dotted_img.png');
	background-repeat:repeat-x;
	width:100%;
	height:3px;
	margin:.5em 0;

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
.small-padding-hidden {
	padding-top: 0px !important;
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
.text-right-small div{
	text-align:left !important;
}
.border-bottom-small{
	border-right:0px !important;
	border-bottom:1px solid #eeeeee;
	margin-bottom: 2em;
    padding-bottom: 2em;
}
}
</style>
<link href="../css/custom.css" rel="stylesheet">
</head>
<body>
<div class="full"> 
  <!--header start-->
  
  <?php include('header_supplier.php')?>
  
<!--header end--> 

<!--body start-->
<div class="full" id="body_container">
<? if($_SESSION['user_type']=='Supplier'){?>
  <div class="container">
<div class="row">
<!-- left menu start -->
<div class="col-lg-2">
<div class="full">
<div class="full" style="border-bottom:1px solid #929597;">
<h3 class="h3"><span><img src="../images/supplier_right_arrow.png">&nbsp;</span>Supplier</h3>
</div>
<div class="full text-left" style="line-height:1.6em;">
<span>All Selling Products</span><Br>
<span><a href="add_product.php">Upload Product</a></span><Br>
<span>Bulk Upload Products</span><Br>
<span>Scheduled &nbsp;(<?=$hold_count?>)</span><Br>
<span>Active &nbsp; (<?=$active_count?>)</span><Br>
<span>Sold&nbsp; (<?=$distinct_product_count?>)</span><Br>
<span>Unsold &nbsp; (<?=$unsold_count?>)</span><Br>

<span>Returns (<?=$return_count?>)</span><Br>

</div>
<div class="full" style="border-bottom:1px solid #929597; margin-top:1em;">
<h3 class="h3"><span><img src="../images/supplier_right_arrow.png">&nbsp;</span>My Account</h3>
</div>

<div class="full text-left" style="line-height:1.6em;">
<span>Sold</span>
<span>sold(<?=$distinct_product_count?>)</span>
<div class="row" style="border-bottom:1px solid #D0D2D3;">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">Amount</div>
<?php
 $count_1=0;	
					   
					   
					   while($trade_goods_row_1=mysql_fetch_assoc($stmt_1)){
					         $count_1++;
     $product_row_1=mysql_fetch_assoc(mysql_query("SELECT * FROM `product` where id='$trade_goods_row_1[goodsId]'"));
     $total_product_amount += $trade_goods_row_1['price']*$trade_goods_row_1['cnt'];
					   }
					   
?>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">$<?=number_format($total_product_amount,2)?></div>
</div>

<span style="font-weight:bold; margin-top:1em; display:inline-block">Payments</span>
<div class="row" style="">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">Received</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">$<?=number_format($total_product_amount,2)?></div>
</div>
<div class="row" style="border-bottom:1px solid #D0D2D3;">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">Not received</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">$</div> <!--=$allsale_amount-$sale_complete_amount -->
</div>


<div class="row" style=" margin-top:1.4em;">
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">Total sales :</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">$<?=number_format($total_product_amount,2)?></div>
</div>
</div>


</div>
</div>
<!-- left menu end   -->


<!-- right  menu start  -->
<div class="col-lg-10">
<form method="post" action="" name="indexform" id="indexform" >
<input type="hidden" name="act_type" id="act_type" value="" >

<!-- for large size start -->
<div class="full" style="margin-top:2em;">

<div class="row text-center small-hidden" >
<div class="col-lg-2" style="padding-left:10px; padding-right:10px; width:120px;">Picture</div>
<div class="col-lg-1" style="padding-left:10px; padding-right:10px; width:50px;">Model</div>
<div class="col-lg-1" style="padding-left:10px; padding-right:10px;">Date</div>
<div class="col-lg-1" style="padding-left:10px; padding-right:10px;">Tradecode</div>
<div class="col-lg-1" style="padding-left:10px; padding-right:10px;">Price</div>
<div class="col-lg-1" style="padding-left:10px; padding-right:10px; width:50px;">Qty.</div>
<div class="col-lg-2" style="padding-left:10px; padding-right:10px;">Shipping Status</div>
<div class="col-lg-2" style="padding-left:10px; padding-right:10px;">Shipping Details</div>
<div class="col-lg-1" style="padding-left:10px; padding-right:10px;">Return</div>
<div class="col-lg-1" style="padding-left:10px; padding-right:10px;">payment</div>

</div>
<div class="bg-dotted"></div>
<?php
	 
	                   $count=0;	
					   
					   
					   while($trade_goods_row=mysql_fetch_assoc($stmt)){
					   $count++;
                     		   $product_row=mysql_fetch_assoc(mysql_query("SELECT * FROM `product` where id='$trade_goods_row[goodsId]'"));
			                   
			 if (strpos($product_row['images'],',') !== false) {
  $product_img=explode(',',$product_row['images']);
  $product_img=$product_img[0];
}
else{
  $product_img=$product_row['images'];	
}
		
	$option1 = explode('-',$trade_goods_row['option1']);
	
	$color_option= $option1[1];
	
	$option2 = explode('-',$trade_goods_row['option2']);
		
     $length_option= $option2[1];
	 
			 
		    ?> 
     

<div class="row text-center small-hidden" >
<div class="col-lg-2" style=" min-height:110px;padding-left:10px; padding-right:10px; width:120px;">
<div class="col-lg-1" style=" padding-top:25px;"><input type="checkbox" name="product_id[]" value="<?=$product_row['id']?>" ></div>
<div class="col-lg-8" style="padding:0px;">

<img src="../product_img/<?=$product_img?>" width="65" height="65"  style="border:1px solid #CACACA;" ></div>
</div>
<div class="col-lg-1" style=" min-height:110px; padding-top:25px; padding-left:0px; padding-right:10px; width:50px;"><?=$product_row['product_name']?></div>
<div class="col-lg-1" style=" min-height:110px;padding-top:25px; padding-left:10px; padding-right:10px;"><?=$trade_goods_row['writeday']?></div>
<div class="col-lg-1" style=" min-height:110px;padding-top:25px; padding-left:10px; padding-right:0px;"><?=$trade_goods_row['tradecode']?></div>
<div class="col-lg-1" style=" min-height:110px;padding-top:25px; padding-left:20px; padding-right:0px; width:50px;">$<?=$trade_goods_row['price']?></div>
<div class="col-lg-1" style=" min-height:110px;padding-top:25px; padding-left:10px; padding-right:10px;"><?=$trade_goods_row['cnt']?></div>

<form name="form1" action="" method="post">
<div class="col-lg-2" style=" min-height:110px;padding-top:25px; padding-left:10px; padding-right:10px;">
<input type="hidden" name="shipping_status_id" value="<?=$trade_goods_row['id'] ?>" />
<select name="shipping_status" style="width:125px">
                      <option value="0">Select</option>
                      <option value="1" <?php if($trade_goods_row['shipping_status'] =='1'){ ?> selected <?php } ?>>Not Ship Yet</option>
                      <option value="2" <?php if($trade_goods_row['shipping_status'] =='2'){ ?> selected <?php } ?>>Ship Completed</option>
                      <option value="3" <?php if($trade_goods_row['shipping_status'] =='3'){ ?> selected <?php } ?> >Out of Stock</option>
                      </select><br>
                      <input type="submit" value="Update" name="shipping_status_update">
</div>
</form>

<form name="form2" action="" method="post">
<div class="col-lg-2" style=" min-height:110px;padding-top:5px; padding-left:10px; padding-right:10px;">
<input type="hidden" name="trans_company_id" value="<?=$trade_goods_row['goodsId']?>" />

Trans Company <select name="trans_company">
<option value ="USPS" <?php if($product_row['shipping_method'] =='USPS'){ ?> selected <?php } ?>>USPS</option>
<option value ="SINA SHIPPING" <?php if($product_row['shipping_method'] =='SINA SHIPPING'){ ?> selected <?php } ?>>SINA SHIPPING</option>
<option value ="UPS" <?php if($product_row['shipping_method'] =='UPS'){ ?> selected <?php } ?>>UPS</option>
<option value ="DHL" <?php if($product_row['shipping_method'] =='DHL'){ ?> selected <?php } ?>>DHL</option>
<option value ="Fedex" <?php if($product_row['shipping_method'] =='Fedex'){ ?> selected <?php } ?>>Fedex</option>
<option value ="FREE SHIPPING" <?php if($product_row['shipping_method'] =='FREE SHIPPING'){ ?> selected <?php } ?>>FREE SHIPPING</option>
</select>
<br />
<input type="hidden" name="tracking_id" value="<?=$trade_goods_row['id'] ?>" />
Tracking <input  type="text" name="tracking" id="" style="width:95px;" value="<?=$trade_goods_row['tracking'] ?>" />
<input type="submit" value="Update" name="shipping_details_update">
</div>
</form>

<div class="col-lg-1" style=" min-height:110px;padding-top:25px;padding-left:10px; padding-right:10px;">

<select name="retuen_issue" style="width:80px;">
                  <option value="0">Select</option>
                  <option value="1" <?php if($trade_goods_row['return_issue'] =='1'){ ?> selected <?php } ?>>Not Return</option>
                  <option value="2" <?php if($trade_goods_row['return_issue'] =='2'){ ?> selected <?php } ?>>Missing Item</option>
                  <option value="3" <?php if($trade_goods_row['return_issue'] =='3'){ ?> selected <?php } ?>>Wrong Shipment</option>
                  <option value="4" <?php if($trade_goods_row['return_issue'] =='4'){ ?> selected <?php } ?>>Quality Issue</option>
                  <option value="5" <?php if($trade_goods_row['return_issue'] =='5'){ ?> selected <?php } ?>>Defective Product</option>
                  <option value="6" <?php if($trade_goods_row['return_issue'] =='6'){ ?> selected <?php } ?>>Damaged Product</option>
                  </select>
</div>
<div class="col-lg-1" style=" min-height:110px;padding-top:25px;padding-left:10px; padding-right:10px;">

<select name="retuen_issue" style="width:80px;">
                  
                  <option value="0" <?php if($trade_goods_row['return_issue'] =='1'){ ?> selected <?php } ?>>notpaid</option>
                  <option value="1" <?php if($trade_goods_row['return_issue'] =='2'){ ?> selected <?php } ?>>cancel</option>
                  <option value="2" <?php if($trade_goods_row['return_issue'] =='3'){ ?> selected <?php } ?>>connected</option>
</select></div>
</div>
<div class="full small-hidden">
<div class="col-lg-5 text-center">Category:<?=$product_row['category']?> &nbsp;&nbsp; 
<? if($color_option!=''){ echo "Color : $color_option"; }  if($length_option!=''){ echo " &nbsp; Length : $length_option"; } ?></div>
<div class="col-lg-6 text-left"> DropShip:<?=$product_row['dropship']?>
</div>
</div>



<!-- for small size start  -->
<div class="full full-hidden" style="margin-top:2em; line-height:2em; border-top:2px solid #000;">

<div class="row">
<div class="col-sm-2 col-xs-3">Picture</div>
<div class="col-sm-10 col-xs-9">
<div class="col-sm-1 col-xs-1  full-hidden"><input type="checkbox" name="product_id[]" value="<?=$product_row['id']?>" class="text-left"></div>
<div class="col-sm-10 col-xs-10">

<img src="../product_img/<?=$product_img?>" class="" width="150" height="150" >
</div>
</div>
</div>
<div class="row" >
<div class="col-sm-6 col-xs-6">Model</div>
<div class="col-sm-6 col-xs-6"><?=$product_row['product_name']?> </div>
</div>
<div class="row" >
<div class="col-sm-6 col-xs-6">Price</div>
<div class="col-sm-6 col-xs-6">$<?=$product_row['msrp_price']?> </div>
</div>
<div class="row" >
<div class="col-sm-6 col-xs-6">WholeSale Price</div>
<div class="col-sm-6 col-xs-6">$<?=$product_row['wholesale_price']?> </div>
</div>
<div class="row" >
<div class="col-sm-6 col-xs-6">Min</div>
<div class="col-sm-6 col-xs-6">1 </div>
</div>
<div class="row" >
<div class="col-sm-6 col-xs-6">Category</div>
<div class="col-sm-6 col-xs-6"><select name="" class="arrow-down-cls full" style="border:1px solid #A9A9A9;">
<option value="<?=$product_row['category']?>"><?=$product_row['category']?></option>
</select> </div>
</div>
<div class="row" >
<div class="col-sm-6 col-xs-6">Options</div>
<div class="col-sm-6 col-xs-6">Qty:43</div>
</div>
<div class="row" >
<div class="col-sm-6 col-xs-6">Shipping</div>
<div class="col-sm-6 col-xs-6">$5.99</div>
</div>
<div class="row" >
<div class="col-sm-6 col-xs-6">Dropship</div>
<div class="col-sm-6 col-xs-6">No </div>
</div>
<div class="row" >
<div class="col-sm-6 col-xs-6">Action</div>
<div class="col-sm-6 col-xs-6">Question(<?=$ques_count?>)<br>
End Item<br>
<!--Customer Order<br>
Large Order<br>
--><a href="edit_product.php?p_id=<?=$product_row['id']?>" style="color:inherit;">Edit</a>
 </div>
</div>

</div>
<!-- for small size end   -->

<div class="bg-dotted small-hidden"></div>

<?php  }  ?>

</form>
</div>

<!-- for large size end -->



<!--<div class="row">
<div class="col-lg-9 col-md-9 col-sm-7 col-xs-7" style="font-size:1.3em;">
 <a href="javascript:void(0)" onClick="update_action('del')">DELETE</a> | <a href="javascript:void(0)" onClick="update_action('end')">
 END ITEM </a> </div>
<div class="col-lg-3 col-md-3 col-sm-5 col-xs-5">
<a href="add_product.php" style="color:inherit;"><div style="color:#FFF; text-align:center;" class="red-btn">Upload Product</div></a>
</div>
</div>
-->
<div class="full" align="center"  style="margin:.5em 0;"><?php  echo rightpaging(); ?></div>
</div>


</div>
<!-- right menu end  -->
</div>
  </div>
  
  <? } ?>
</div>

<!--body end--> 

<!-- footer start-->
<?php include('footer.php')?>

<!--footer end  -->

</div>

<!--login popup start-->
<? if($_SESSION['user_type']!='Supplier'){?>

<div id="overlay-mask-1" class="overlay-mask" style="">
  
 
  <div class="overlay iframe-content"><a class="close close-icon" onClick="close_popup('overlay-mask-1')">
  <span id="close_button" style="position: absolute; text-align: center; width: 100%;">X</span></a>
    <div class="content" style="border:2px solid #97cf00; padding:1em;"> 
    <div class="row" style="width:98%; padding:2em 0;;">
   
     
      <div class="col-lg-12 col-xs-12 col-xs-12">
       <form name="login_form" action="" method="post" onSubmit="return validate()">
    <div class="full" style="background:#FBFBFB; border:1px solid #E5E5E5; padding:5%;">
     <h3 class="h3">ALREADY REGISTERED ?</h3><hr>
     <div class="full" style="color:#999999; margin-top:1em;">
  
   <div class="" style="font-size:1em; color:#000; margin:1em 0;">
 Email Address
   </div>
   <div class="form-group"><input type="email" id="email_login" name="email_login" class="form-control"></div>
   
    <div class="" style="font-size:1em; color:#000; margin:1em 0;">
 Password
   </div>
   <div class="form-group"><input type="password" name="pwd_login" id="pwd_login" class="form-control"></div>
   
   <div class="" style="margin-top:2em;">
   <span style="text-decoration:underline;"> Forgot Your Password ?</span><br>
  <button type="submit" class="blue-btn glyphicon glyphicon-lock" style="background:#268BB9; color:#FFF;">
  <span class="" style="font-family:sans-serif;">SIGN IN</span>
  </button>
   
   </div>
     </div>
     </div> 
     </form>  
      </div>
    
    
    </div>
    
    </div>
    </div>
  
    
    </div>
    <? } ?>
<!-- login popup end -->

<!--right sidebar start-->
<div id="at4-share" class="addthis_32x32_style atss atss-right addthis-animated slideInRight at4-show"><a class="at4-share-btn at-svc-facebook" href="#"><img src="../images/fb.png" ></a> <a class="at4-share-btn at-svc-twitter" href="#"><img src="../images/tw.png" ></a><a class="at4-share-btn at-svc-zingme" href="#"><img src="../images/ymoo.png" ></a><a class="at4-share-btn at-svc-linkedin" href="#"><img src="../images/z.png" ></a><a class="at4-share-btn at-svc-favorites" href="#"><img src="../images/p.png" ></a><a class="at4-share-btn at-svc-google_plusone_share" href="#"><img src="../images/plus.png" ></a> 
  <!--<div id="at4-scc" class="at-share-close-control ats-transparent at4-show at4-hide-content" title="Hide">
    <div class="at4-arrow at-right">Hide</div>
  </div>--> 
</div>

<!--right sidebar end



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="../js/bootstrap.min.js"></script>
</body>
</html>

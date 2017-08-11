<?php
session_start();

 $member_id=$_SESSION['member_id'];
 
 $GOOD_SHOP_USERID =$_SESSION['GOOD_SHOP_USERID'];

require_once('wp-admin/include/connectdb.php');

$user_row=mysql_fetch_assoc(mysql_query("SELECT * FROM `member` where member_id='$member_id'"));

$country_query=mysql_query("SELECT * FROM `country` where country_name!='' order by country_Id asc");

$country_query2=mysql_query("SELECT * FROM `country` where country_name!='' order by country_Id asc");

if($user_row['state']!=''){

$state_name=mysql_result(mysql_query("SELECT state_name FROM `state` where state_id=$user_row[state]"),0);

}

$category=mysql_query("SELECT * FROM `category` where category_name!='' order by category_name ASC ");

$mail_variable=false;


if(isset($_POST['email'])){

   $company_name = $_POST['company_name'];
   $address1 = $_POST['address1'];
   $address2 = $_POST['address2'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $zipcode = $_POST['zipcode'];
   $country = $_POST['country'];
   $email = $_POST['email'];
   $cel = $_POST['cel'];
   
   $rcompany_name = $_POST['rcompany_name'];
   $raddress1 = $_POST['raddress1'];
   $raddress2 = $_POST['raddress2'];
   $rcity = $_POST['rcity'];
   $rstate =$_POST['rstate'];
   $rzipcode = $_POST['rzipcode'];
   $rcountry = $_POST['rcountry'];
   $remail =$_POST['remail'];
   $rcel = $_POST['rcel'];
   $description = $_POST['description'];
   $pay = $_POST['pay'];
    $preview_page_length=count($_POST['product_category']);
  
   $product_category_preview=$_POST['product_category'];
   $product_name_preview=$_POST['product_name'];
   $product_length_preview=$_POST['product_length'];
   $product_color_preview=$_POST['product_color'];
   $product_quantity_preview =$_POST['product_quantity'];
   $product_dropship_preview=$_POST['product_dropship'];
 
   

 $product_category=implode(',',$_POST['product_category']); 
 $product_name=implode(',',$_POST['product_name']);
 $product_length=implode(',',$_POST['product_length']);
 $product_color=implode(',',$_POST['product_color']);
 $product_quantity =  implode(',',$_POST['product_quantity']);
 $product_dropship=implode(',',$_POST['product_dropship']);
 $time=time();
}
 if(isset($_POST['submit'])){
 $insert=mysql_query("INSERT INTO `custom_order`( `user_id`, `company_name`, `address1`, `address2`, `city`, `state`, `country`, `zip`, `email`, `phone`, `rcompany_name`, `raddress1`, `raddress2`, `rcity`, `rstate`, `rcountry`, `rzip`, `remail`, `rphone`, `description`, `pay_method`, `product_type`, `product_name`, `product_length`, `product_color`,`product_quantity`, `custom_package`, `writeday`) VALUES ('$member_id','$company_name','$address1','$address2','$city','$state','$country','$zipcode','$email','$cel','$rcompany_name','$raddress1',
'$raddress2','$rcity','$rstate','$rcompany_name','$rzipcode','$remail','$rcel','$description','$pay','$product_category','$product_name',
'$product_length','$product_color','$product_quantity','$product_dropship','$time')");
	
	$message_body ="<html><body><table width='900' cellpadding='5' cellspacing='5' style='border:2px solid #000;'>
	 <tr><td style='background:#155597; margin:5px;' colspan='2' height='100'>
  <table>
  <tr><td width='30%'><img style='border:0px; background:#155970;' src='https://fahair.com/images/logo1.png'> </td>
  <td height='70%'><h3 style='color:#fff;'>Custom Order</h3></td></tr>
  </table>
  </td></tr>
<tr>
<td width='450'>
<h2>Buyer Information</h2>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr>
<th width='50%'>Company Name</th><td width='50%'>$company_name</td>
</tr>
<tr>
<th width='50%'>Street Address</th><td width='50%'>$address1</td>
</tr>
<tr>
<th width='50%'>Street Address Line 2 </th><td width='50%'>$address2</td>
</tr>
<tr>
<th width='50%'>City</th><td width='50%'>$city</td>
</tr>
<tr>
<th width='50%'>State / Province</th><td width='50%'>$state</td>
</tr>
<tr>
<th width='50%'>Postal / Zip Code</th><td width='50%'>$zipcode</td>
</tr>
<tr>
<th width='50%'>Country</th><td width='50%'>$country</td>
</tr>
<tr>
<th width='50%'>E-mail</th><td width='50%'>$email</td>
</tr>
<tr>
<th width='50%'>Phone</th><td width='50%'>$cel</td>
</tr>
</table>
</td>
<td width='450'>
<h2>Shipping Information</h2>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr>
<th width='50%'>Company Name</th><td width='50%'>$rcompany_name</td>
</tr>
<tr>
<th width='50%'>Street Address</th><td width='50%'>$raddress1</td>
</tr>
<tr>
<th width='50%'>Street Address Line 2 </th><td width='50%'>$raddress2</td>
</tr>
<tr>
<th width='50%'>City</th><td width='50%'>$rcity</td>
</tr>
<tr>
<th width='50%'>State / Province</th><td width='50%'>$rstate</td>
</tr>
<tr>
<th width='50%'>Postal / Zip Code</th><td width='50%'>$rzipcode</td>
</tr>
<tr>
<th width='50%'>Country</th><td width='50%'>$rcountry</td>
</tr>
<tr>
<th width='50%'>E-mail</th><td width='50%'>$remail</td>
</tr>
<tr>
<th width='50%'>Phone</th><td width='50%'>$rcel</td>
</tr>
</table>
</td>
</tr>
<tr><td colspan='2' height='10'></td></tr>
<tr><td width='50%'>Description </td><td width='50%'>$description</td></tr>

<tr><td colspan='2' height='10'></td></tr>
<tr><td width='50%'>Payment Method </td><td width='50%'>$pay</td></tr>
<tr><td width='50%'>Product Type</td><td width='50%'>$product_category</td></tr>
<tr><td width='50%'>Product Name </td><td width='50%'>$product_name</td></tr>
<tr><td width='50%'>Length </td><td width='50%'>$product_length</td></tr>
<tr><td width='50%'>Color</td><td width='50%'>$product_color</td></tr>
<tr><td width='50%'>Quantity</td><td width='50%'>$product_quantity</td></tr>
<tr><td width='50%'>Custom Package </td><td width='50%'>$product_dropship</td></tr>
</table></body></html>";

$forward_to='order@beautco.com';
$forward_subject='Custom Order query submitted.';

 $headers =  "From:beautco.com\r\n";
		 $headers .= 'MIME-Version: 1.0' . "\r\n";
         $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
mail($forward_to, $forward_subject,$message_body, $headers);
header('Location: contactus_after_preview.php');

$mail_variable =true ;

}

?>
<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Custom Order</title>

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
function infoEqual()
{
	var form=document.custom_orderForm;
	if(form.eql.checked){		//addrss of customer and shipping address is the same
		form.rcompany_name.value	= form.company_name.value;	
     	form.raddress1.value	= form.address1.value;
		form.raddress2.value	= form.address2.value;	
		form.rcity.value	= form.city.value;
		form.rstate.value	= form.state.value;
			form.rzipcode.value		= form.zipcode.value;
		form.rcountry.selectedIndex = form.country.selectedIndex;
		
	
		form.remail.value	= form.email.value;
		form.rcel.value	= form.cel.value;	

	}else{
	
		form.rcompany_name.value	= "";
		form.raddress1.value	= "";	
		form.raddress2.value	= "";	
		form.rcity.value	= "";
		form.rstate.value	= "";	
		form.rzipcode.value	= "";	
			form.rcountry.selectedIndex = 0;
		form.remail.value	= "";	
			form.rcel.value	= "";


	}
}	
 
 
 function add_option_row(){
  var html=$("#all_option_div").html();	
  
 var new_html="<div class='full'  style='color:#000;border-bottom:2px solid #B3B3B3;'>"+html+"</div>"
 $("#all_option_div").after(new_html);

 	 
 }
 
 function pass_val(id){
var val=	$("#"+id).val();
 $("#"+id).attr('value', val);

}

 function ask_supplier(){
 jQuery("#overlay-mask-3").fadeIn('slow');
// $("#overlay-mask-3").show();
 
}




 
 function close_popup(id){
 //jQuery(".overlay-mask").fadeOut('slow');	
 jQuery("#"+id).fadeOut('slow');
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
	border-right: 1px solid #eee;
	list-style: outside none none;
 position: absolute;
  display:none;
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
.col-lg-6{
		border-left:0px !important;
		border-right:0px !important;
	}
	.small-border-hddn{
border-left:0px !important;
		border-right:0px !important;
}

}
@media(max-width:990px){
	.small-text-left {
	text-align: left !important;
}
.form-group{
	width:95% !important;
}
.col-lg-6{
		border-left:0px !important;
		border-right:0px !important;
	}
}
@media(max-width:1199px){
.small-text-left {
	text-align: left !important;
}
.form-group{
	width:95% !important;
} 
}
 @media (max-width: 426px) {
	
	.form-group{
	width:95% !important;
} 
	 
	.col-lg-6{
		border-left:0px !important;
		border-right:0px !important;
	}
.small-border-hddn{
border-left:0px !important;
		border-right:0px !important;
}
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
.small-text-left {
	text-align: left !important;
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
.no-border{
	border:0;
}
#loader_container{
	display:none;
}
input{
	margin-bottom:0px;
}
.form-group{
	margin-bottom:0px;
}
.col-lg-6{
	padding-top:1px;
	padding-bottom:1px;
}
</style>
<link href="css/custom.css" rel="stylesheet">
</head>
<body>
<div class="full"> 
  <!--header start-->
  <?php include('header.php')?>

<!--header end--> 

<!--body start-->
<div align="center" class="full" id="">
<form method="post" action="" name="custom_orderForm">
  <div class="container" >
  <div class="full" style=" background:#155970;">
  <div class="col-lg-2 col-sm-6 col-md-6 col-xs-6">
 <img src="images/logo_1.png" class="img-thumbnail" style="border:0px; background:#155970;" >       
  </div>
  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6"><h2 class="h2" style="color:#FFF; height:50px;">Custom Order</h2></div>
  <? if($mail_variable==true){?>
      <br>
      <h3 class="h3 full" style="color:#FFF; height:50px; text-align:center;">Thanking You. One of our Adminisitrator will contact you as soon as 
      possible.</h3> <? } ?> 
  
  </div>
  
  <div class="full small-text-left" style="margin-top:1.5em;">
  
  <div class="full">
  <!-- Buyer Information left side start -->
  <div class="col-lg-6">
  <div class="full" style="border:2px solid #E5E5E5;">
  
  
  <div class="full" style="border-bottom:2px solid #E5E5E5;">
    <ul><li>Buyer Information</li></ul>
</div>
  <div class="full" style="border-bottom:2px solid #E5E5E5; min-height:20px;"></div>
  <div class="full" style="border-bottom:2px solid #E5E5E5;">
  <div class="col-lg-6"><input type="text" class="form-group" name="company_name" value="<?=$user_row['company_name']?>" ></div><div class="col-lg-6">Company Name</div>
  </div>
   <div class="full" style="border-bottom:2px solid #E5E5E5;">
  <div class="col-lg-6"><input type="text" class="form-group" name="address1" value="<?=$user_row['address1']?>" ></div><div class="col-lg-6">Street Address</div>
  </div>
  <div class="full" style="border-bottom:2px solid #E5E5E5;">
  <input type="text" class="form-group" value="<?=$user_row['address2']?>" name="address2" style="width:96%; margin:0 2%;"><br>
  Street Address Line 2
  </div>
   <div class="full" style="border-bottom:2px solid #E5E5E5;">
  <div class="col-lg-6" style="border-right:2px solid #e5e5e5;">
  <input type="text" class="form-group" value="<?=$user_row['city']?>" name="city" ><br>City</div>
  <div class="col-lg-6"><input type="text" value="<?=$state_name?>" name="state" class="form-group" ><br>State / Province</div>
  </div>
   <div class="full" style="border-bottom:2px solid #E5E5E5;">
  <div class="col-lg-6" style="border-right:2px solid #e5e5e5;">
  <input type="text" class="form-group" name="zipcode"  value="<?=$user_row['zipcode']?>"><br>Postal / Zip Code</div>
  <div class="col-lg-6"><select name="country" class="form-group">
  <option>Please Select</option>
  <?php
	  while ($country_result = mysql_fetch_assoc($country_query)) {
	?>	
	<option value="<?=$country_result['country_Id']?>" <? if($user_row['country']==$country_result['country_Id']){?>
	 selected<? } ?>><?=$country_result['country_name']?></option>
	
	<?php } ?>  
  </select><br>Country</div>
  </div>
   <div class="full" style="border-bottom:2px solid #E5E5E5;">
  <div class="col-lg-6" >E-mail</div>
  <div class="col-lg-6" style="border-left:2px solid #e5e5e5;"><input type="email" class="form-group" name="email" value="<?=$user_row['email']?>" ></div>
  </div>
   <div class="full" style="">
  <div class="col-lg-6">Phone</div>
  <div class="col-lg-6" style="border-left:2px solid #e5e5e5;"><input type="text" class="form-group" name="cel" value="<?=$user_row['cel']?>" ></div>
  </div>
  
  
  </div>
  </div>
  <!-- Buyer Information left side end-->
  
  
   <!--Shipping  Information left side start -->
   
   
  <div class="col-lg-6">
  
   <div class="full" style="border:2px solid #E5E5E5;">
  
  
  <div class="full" style="border-bottom:2px solid #E5E5E5;">
    <ul><li>Shipping Information <input type="checkbox" name="eql" value="checkbox" onClick="javascript:infoEqual();">Same as Buyer information</li></ul>
</div>
  <div class="full" style="border-bottom:2px solid #E5E5E5; min-height:20px;"></div>
  <div class="full" style="border-bottom:2px solid #E5E5E5;">
  <div class="col-lg-6"><input type="text" name="rcompany_name" class="form-group" ></div><div class="col-lg-6">Company Name</div>
  </div>
   <div class="full" style="border-bottom:2px solid #E5E5E5;">
  <div class="col-lg-6"><input type="text" name="raddress1" class="form-group" ></div><div class="col-lg-6">Street Address</div>
  </div>
  <div class="full" style="border-bottom:2px solid #E5E5E5;"><input type="text" name="raddress2" class="form-group" style="width:96%; margin:0 2%;"><br>
  Street Address Line 2
  </div>
   <div class="full" style="border-bottom:2px solid #E5E5E5;">
  <div class="col-lg-6" style="border-right:2px solid #e5e5e5;"><input type="text" name="rcity" class="form-group" ><br>City</div>
  <div class="col-lg-6"><input type="text" name="rstate" class="form-group" ><br>State / Province</div>
  </div>
   <div class="full" style="border-bottom:2px solid #E5E5E5;">
  <div class="col-lg-6" style="border-right:2px solid #e5e5e5;"><input type="text" name="rzipcode" class="form-group" ><br>Postal / Zip Code</div>
  <div class="col-lg-6"><select name="rcountry" class="form-group">
  <option>Please Select</option>
  <?php
	  while ($country_result2 = mysql_fetch_assoc($country_query2)) {
	?>	
	<option value="<?=$country_result2['country_name']?>" <? if($user_row['country']==$country_result2['country_Id']){?>
	 selected<? } ?>><?=$country_result2['country_name']?></option>
	
	<?php } ?>  
  </select><br>Country</div>
  </div>
   <div class="full" style="border-bottom:2px solid #E5E5E5;">
  <div class="col-lg-6">E-mail</div>
  <div class="col-lg-6" style="border-left:2px solid #e5e5e5;"><input type="email" name="remail" class="form-group" ></div>
  </div>
   <div class="full" style=" ">
  <div class="col-lg-6" >Phone</div>
  <div class="col-lg-6" style="border-left:2px solid #e5e5e5;"><input type="text" name="rcel" class="form-group" ></div>
  </div>
  
  
  </div>       
         
         
  </div>
  <!-- Shipping  information right side end  -->
  
  </div>
  
  <div class="full" style="margin:.5em 0;">
  Describe <br>
  <textarea class="full" name="description" rows="6"></textarea> </div>
  
  <div class="full" style="margin:.5em 0;">
  <div class="col-lg-3 col-sm-5 col-xs-5 col-md-5">Payment Method </div>
  <div class="col-lg-9 col-sm-7 col-xs-7 col-md-7"><select name="pay" id="p_type" class="form-group">
          <option selected="selected" value="Credit Card">Credit Card</option>
          <option value="Paypal">Paypal</option>
          <option value="Wire Transfer">Wire Transfer</option>
          <option value="Western Union">Western Union</option></select></div>
  </div>
  
  <div class="full" style="border:2px solid #B3B3B3;">
  <div class="full" style="border-bottom:2px solid #B3B3B3;">
  <div class="col-lg-3 col-sm-3 col-xs-3 small-padding-hidden small-border-hddn" style="border-right:2px solid #B3B3B3;">Product Type</div>
  <div class="col-lg-2 col-sm-2 col-xs-2 small-padding-hidden small-border-hddn" style="border-right:2px solid #B3B3B3;">Product Name</div>
  <div class="col-lg-3 col-sm-3 col-xs-3 small-padding-hidden small-border-hddn" style="border-right:2px solid #B3B3B3;">Length</div>
  <div class="col-lg-1 col-sm-1 col-xs-1 small-padding-hidden small-border-hddn" style="border-right:2px solid #B3B3B3;">Color</div>
   <div class="col-lg-1 col-sm-1 col-xs-1 small-padding-hidden small-border-hddn" style="border-right:2px solid #B3B3B3;">Quantity</div>
  <div class="col-lg-2 col-sm-2 col-xs-2 small-padding-hidden small-border-hddn" style="">Custom Package</div>
  </div>
 
 
    <div class="full" id="all_option_div" style="border-bottom:2px solid #B3B3B3;">
  <div class="col-lg-3 col-sm-3 col-xs-3 small-padding-hidden small-border-hddn" style="border-right:2px solid #B3B3B3;">
  <select name="product_category[]" id="product_category" style="min-height:26px;" class="form-group" onBlur="pass_val('product_category')">
    <option value="">Select</option>
  <?php
  while($category_row=mysql_fetch_assoc($category)){
	  ?>
    <option value="<?=$category_row['category_name']?>"><?=$category_row['category_name']?></option>  
      <?
  }
  ?> 
    

  </select></div>
  <div class="col-lg-2 col-sm-2 col-xs-2 small-padding-hidden  small-border-hddn" style="border-right:2px solid #B3B3B3;">
  <input type="text" name="product_name[]" id="product_name" onBlur="pass_val('product_name')" placeholder="Product Name" ></div>
  <div class="col-lg-3 col-sm-3 col-xs-3 small-padding-hidden  small-border-hddn" style="border-right:2px solid #B3B3B3;">
   <input type="text" name="product_length[]" id="product_length" onBlur="pass_val('product_length')" placeholder="Length" >
  </div>
  <div class="col-lg-1 col-sm-1 col-xs-1 small-padding-hidden  small-border-hddn" style="border-right:2px solid #B3B3B3;">
   <input type="text" name="product_color[]" id="product_color" onBlur="pass_val('product_color')" size="3" placeholder="Color" >
  </div>
   <div class="col-lg-1 col-sm-1 col-xs-1 small-padding-hidden  small-border-hddn" style="border-right:2px solid #B3B3B3;">
   <input type="text" name="product_quantity[]" id="product_quantity" onBlur="pass_val('product_quantity')" size="3" placeholder="Quantity" >
  </div>
  <div class="col-lg-2 col-sm-2 col-xs-2 small-padding-hidden  small-border-hddn" style=""><select name="product_dropship[]" id="" onBlur="pass_val('product_dropship')">
  <option value="No">No</option>
  <option value="Yes">Yes</option>
  </select></div>
  </div>
  
   <div class="full" style="">
  <div class="col-lg-4 col-sm-4 col-xs-4 small-padding-hidden  small-border-hddn" style="border-right:2px solid #B3B3B3;">
  <img src="https://fahair.com/images/add_icon.jpg" style="cursor:pointer;" onClick="add_option_row()" ></div>
  <div class="col-lg-2 col-sm-2 col-xs-2 small-padding-hidden  small-border-hddn" style="border-right:2px solid #B3B3B3;min-height: 23px;"></div>
  <div class="col-lg-3 col-sm-3 col-xs-3 small-padding-hidden  small-border-hddn" style="border-right:2px solid #B3B3B3;min-height: 23px;"></div>
  <div class="col-lg-1 col-sm-1 col-xs-1 small-padding-hidden  small-border-hddn" style="border-right:2px solid #B3B3B3;min-height: 23px;"></div>
  <div class="col-lg-2 col-sm-2 col-xs-2 small-padding-hidden  small-border-hddn" style="min-height: 23px;"></div>
  </div>
   
  </div>
 
  <div class="full" style="margin-top:1.5em;">
  <div class="col-lg-8 col-md-6 col-sm-6 col-xs-6 text-center">
  <input type="submit" class="red-btn" value="Custom Order" name="submit" style="font-size:1.2em;" >
  </div>
  
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
      <input type="submit" class="red-btn" value="PREVIEW" name="preview"  style="background:#298BB8; font-size:1.2em;" >
    </div>
  </div>
  
  </div>


  </div>
  </form>
</div>

<!--body end--> 

<!-- footer start-->

<?php include('footer.php')?>

<!--footer end  -->

</div>

<!--right sidebar start-->



<!--right sidebar start-->
<div id="at4-share" class="addthis_32x32_style atss atss-right addthis-animated slideInRight at4-show"><a class="at4-share-btn at-svc-facebook" href="#"><img src="images/fb.png" ></a> <a class="at4-share-btn at-svc-twitter" href="#"><img src="images/tw.png" ></a><a class="at4-share-btn at-svc-zingme" href="#"><img src="images/ymoo.png" ></a><a class="at4-share-btn at-svc-linkedin" href="#"><img src="images/z.png" ></a><a class="at4-share-btn at-svc-favorites" href="#"><img src="images/p.png" ></a><a class="at4-share-btn at-svc-google_plusone_share" href="#"><img src="images/plus.png" ></a> 
  <!--<div id="at4-scc" class="at-share-close-control ats-transparent at4-show at4-hide-content" title="Hide">
    <div class="at4-arrow at-right">Hide</div>
  </div>--> 
</div>

<!--right sidebar end -->


<!-- Preview section start -->
<form action="" method="post">
<div id="overlay-mask-3" class="overlay-mask" style="">
  <div class="overlay iframe-content" style="border:5px solid #fff; font-size:1.2em;">
  <a class="close close-icon" onClick="close_popup('overlay-mask-3')">
  <span id="close_button" style="margin-left:0.5em;">X</span></a>
   
 <div class="container" style="padding:1em;">
<div class="full"> 

 
<div class="full" style="border:1px solid #E7E7E7; margin:.7em; padding:.7em;"> 
<div class="full">

<div class="full">
<div class="col-lg-6" style="margin-bottom: 20px;"><img class="img-responsive" width="300" height="200" style="border:1px solid #EEEEEE;" src="images/logo.png"></div>
<div class="col-lg-6" style="margin-bottom: 20px;"><h1 style="margin-top: 0px; margin-bottom: 0px;">Custom Order</h1><br>
<span style="margin-top:0px;">Invoice No:<br></span>
<span>Date:<?= date('d M Y') ?></span>
</div>

<div class="full">
<div class="col-lg-4"  style="padding-left: 10px; height: 25px; padding-top: 0px; padding-bottom: 0px; background:#999">Bill To</div>
<div class="col-lg-2"></div>
<div class="col-lg-4" style="padding-left: 10px; height: 25px; padding-top: 0px; padding-bottom: 0px; background:#999"">Bill To</div>
<div class="col-lg-2"></div>
</div>


<div class="full">
<div class="col-lg-6"><?php echo $user_row['f_name']." ".$user_row['l_name']?></div>
<div class="col-lg-6"><?php echo $user_row['f_name']." ".$user_row['l_name']?></div>
</div>

<div class="full">
<div class="col-lg-6" id="company_name1"><input type="hidden" name="company_name" value="<?=$company_name?>">
<?=$company_name?></div>
<div class="col-lg-6" id="rcompany_name1"><input type="hidden" name="rcompany_name" value="<?=$rcompany_name?>">
<?=$rcompany_name?>
</div>
</div>

<div class="full">
<div class="col-lg-6" id="address11"><input type="hidden" name="address1" value="<?=$address1?>"><?=$address1?></div>
<div class="col-lg-6" id="raddress11"><input type="hidden" name="raddress1" value="<?=$raddress1?>"><?=$raddress1?></div>
</div>

<div class="full">
<input type="hidden" name="city" value="<?=$city?>">
<input type="hidden" name="rcity" value="<?=$rcity?>">
<input type="hidden" name="state" value="<?=$state?>">
<input type="hidden" name="rstate" value="<?=$rstate?>">
<input type="hidden" name="zipcode" value="<?=$zipcode?>">
<input type="hidden" name="rzipcode" value="<?=$rzipcode?>">
<input type="hidden" name="address2" value="<?=$address2?>">
<input type="hidden" name="country" value="<?=$country?>">
<input type="hidden" name="raddress2" value="<?=$raddress2?>">
<input type="hidden" name="rcountry" value="<?=$rcountry?>">
<input type="hidden" name="remail" value="<?=$remail?>">


<div class="col-lg-6" id ="city1"><?=$city."-".$state."-".$zipcode?></div>
<div class="col-lg-6" id= "rcity1"><?=$rcity."-".$rstate."-".$rzipcode?></div>
</div>

<div class="full">
<input type="hidden" name="cel" value="<?=$cel?>">
<input type="hidden" name="rcel" value="<?=$rcel?>">
<div class="col-lg-6" id ="cel1"><?=$cel?></div>
<div class="col-lg-6" id ="rcel1"><?=$rcel?></div>
</div>

<input type="hidden" name="email" value="<?=$email?>">
<div class="full">
<div class="col-lg-6" id="email1"><?=$email?></div>
<div class="col-lg-6"></div>
</div>

<div class="full">
<input type="hidden" name="pay" value="<?=$pay?>">
<div class="col-lg-6" style="margin-top:15px;"><span style="text-align:center">PAYMENT METHOD</span></div>
<div class="col-lg-6" style="margin-top:15px;"><span style="text-align:center"><?=$pay?></span></div>
</div>

<div class="full" style="border:2px solid #B3B3B3;">
  <div class="full" style="border-bottom:2px solid #B3B3B3;">
 <div class="col-lg-3 small-border-hddn" style="border-right:2px solid #B3B3B3;">Product Type</div>
  <div class="col-lg-2 small-border-hddn" style="border-right:2px solid #B3B3B3;">Product Name</div>
  <div class="col-lg-3 small-border-hddn" style="border-right:2px solid #B3B3B3;">Length</div>
  <div class="col-lg-1 small-border-hddn" style="border-right:2px solid #B3B3B3;">Color</div>
   <div class="col-lg-1 small-border-hddn" style="border-right:2px solid #B3B3B3;">Quantity</div>
  <div class="col-lg-2 small-border-hddn" style="">Custom Package</div>
  </div>
   <input type="hidden" name="product_category[]" value="<?=$product_category?>">
   <input type="hidden" name="product_name[]" value="<?=$product_name?>">
   <input type="hidden" name="product_length[]" value="<?=$product_length?>">
   <input type="hidden" name="product_color[]" value="<?=$product_color?>">
   <input type="hidden" name="product_quantity[]" value="<?=$product_quantity?>">
   <input type="hidden" name="product_dropship[]" value="<?=$product_dropship?>">
   
  <?php for($i=0;$i<$preview_page_length;$i++) {?> 
  
   <div class="full" id="all_option_div_<?=$i?>" style="border-bottom:2px solid #B3B3B3;">
   <div class="col-lg-3 small-border-hddn" style="border-right:2px solid #B3B3B3;">
   <?=$product_category_preview[$i]?>
   </div>
   <div class="col-lg-2 small-border-hddn" style="border-right:2px solid #B3B3B3;">
   <?=$product_name_preview[$i]?>
   </div>
   <div class="col-lg-3 small-border-hddn" style="border-right:2px solid #B3B3B3;">
   <?=$product_length_preview[$i]?>
   </div>
   <div class="col-lg-1 small-border-hddn" style="border-right:2px solid #B3B3B3;">
   <?=$product_color_preview[$i]?>
   </div>
   <div class="col-lg-1 small-border-hddn" style="border-right:2px solid #B3B3B3;">
   <?=$product_quantity_preview[$i]?>
   </div>
  
  <div class="col-lg-2 small-border-hddn" style="">
  <?=$product_dropship_preview[$i]?>
  </div>
  </div>
</div>
<?php } ?>
</div>


<div class="full" style="margin:.5em 0;">
  Describe <br>
  <input type="hidden" name="description" value="<?=$description?>">
  <textarea class="full" name="description_1" rows="6"><?=$description?></textarea> </div>

<div class="full">
<div class="col-lg-6">
<input type="submit"  class="red-btn" style="background:#0065B0; color:#FFF; padding:.3em .7em;" value="Send" name="submit"> </div> 
<div class="col-lg-6">
  <input type="button" value="Close" class="red-btn"onclick="close_popup('overlay-mask-3')" style="background:#0065B0; color:#FFF; padding:.3em .7em;"> </div>
</div>
</div>


 </div>
 </div>

 </div>
 
 </div>
 </div>
</form
><!-- Preview section end -->

<!--right sidebar end -->



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
<?php if(isset($_POST['preview'])) { ?>
//$("#overlay-mask-3").show();
ask_supplier();
<?php } ?>
</script>

</body>
</html>

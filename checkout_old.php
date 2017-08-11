<?php
session_start();
 $member_id=$_SESSION['member_id'];
// echo "$member_id";
 $GOOD_SHOP_USERID =$_SESSION['GOOD_SHOP_USERID'];
 //echo "$GOOD_SHOP_USERID";
require_once('wp-admin/include/connectdb.php');
require_once('ups_rate1.php');
require_once('usps_shipping.php');
$total_P =str_replace(',','',$_POST['total_P']);
$total_weight = $_POST['total_weight'];
//echo"$total_weight";
/*
if($total_weight!=0){
	$total_weight=$total_weight/8;
	$total_weight=number_format($total_weight,2);
	$response=explode('.',$total_weight);
	$ponds=$response[0];
	//echo "$ponds-";
    $onces=$response[1]*8;
	//echo "$onces";
}	*/
$ponds=$total_weight;
$onces=0;
//echo "ponds $ponds--waight $total_weight";
$member_query=mysql_query("SELECT * FROM `member` where member_id='$member_id'");
$member_row=mysql_fetch_assoc($member_query);
$iam=$member_row['i_am'];
$verifystatus=$member_row['verify_status'];
$state=$member_row['state'];
//echo $iam;
 $rzip = $member_row['zipcode'];
 $ups_country=mysql_result(mysql_query("select country_name from country where country_Id='$member_row[country]'"),0);
if($ups_country=='United States'){	 
$ups_country="US" ;
}
$country_query=mysql_query("SELECT * FROM `country` where country_name!='' order by country_Id asc");
$country_query2=mysql_query("SELECT * FROM `country` where country_name!='' order by country_Id asc");
//get price of product other country 
$check_othercountry_product=false;
$shipping_charge=0;
$cart_goods_query = mysql_query("select * from cart where userid='$GOOD_SHOP_USERID'");
while($cart_goods_row=mysql_fetch_assoc($cart_goods_query)){
$query=mysql_query("SELECT * FROM `product` where  place_origin!='USA' and id='$cart_goods_row[goodsId]'");

$other_count=mysql_num_rows($query);
if($other_count>0){
 $check_othercountry_product=true;
  $product_row=mysql_fetch_assoc($query);
 $shipping_charge +=$product_row['shipping_price'];
 }
}

if($total_weight==0){
	$shipping_charge=0;
}
$query=mysql_query("SELECT * FROM `product` where  place_origin!='USA'");
if($total_weight!=0){
if($ups_country=='US'){
$USPSParcelRate=USPSParcelRate_local($ponds,$onces,$rzip);
$Alluspsprice_list=USPSParcelRate_local_All($ponds,$onces,$rzip);
$usps_servicepost_charge = USPSParcelRate_service_post($ponds,$onces,$rzip);
$ship_price=$USPSParcelRate;
//echo $ship_price;
$resck=number_format($ship_price,2);
$draw=$resck;
//echo $draw;
//echo $iam;
if($iam=='generalmember')
{
//echo $resck;
if($resck>35)
{
	$draw=0;
	//echo "hiii";
}
else
{
	//echo "hlo";
	$draw=$resck;
}
}
$ups_three_day = get_UPS_Price_Ups_three_day($rzip,$ups_country,$total_weight);
   $ups_gnd=  get_UPS_Price_Ups_GND($rzip,$ups_country,$total_weight);
    $ups_2da=  get_UPS_Price_Ups_2da($rzip,$ups_country,$total_weight);
	$ship_price=$ups_gnd;
	
	 
	
}
if($ups_country!='US'){
	$USPSParcelRate=USPSParcelRate_international($ponds,$onces,$ups_country);
	
	$usps_international_all= USPSParcelRate_international_All($ponds,$onces,$ups_country);
	$ship_price=$USPSParcelRate;
}
}

if($total_weight==0){
$ship_price=0;	
}
//echo "$_SESSION[level]";
if($_SESSION['level']==0 && $total_P>35 && $ups_country=='US' and ($state!='AI'or $state!='HI')){
$ship_price=0;
$draw_free=0;
$ship_over35=1;
}

$payM=$total_P+$ship_price;

//making ordering code
srand(time());
$time = substr(time(),3,7);
for($i=0;$i<3;$i++)
{
$asc=rand()%26+65;
$c.=chr($asc);
}
$tradecode=$c.$time;
//echo $tradecode;
?>
<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Checkout Page</title>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<!--Bootstrap-->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$("#card_number").keydown(function (e) {
// Allow: backspace, delete, tab, escape, enter and .
if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
// Allow: Ctrl+A
(e.keyCode == 65 && e.ctrlKey === true) || 
// Allow: home, end, left, right, down, up
(e.keyCode >= 35 && e.keyCode <= 40)) {
// let it happen, don't do anything
return;
}
// Ensure that it is a number and stop the keypress
if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
e.preventDefault();
}
});

$("#cvv").keydown(function (e) {
// Allow: backspace, delete, tab, escape, enter and .
if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
// Allow: Ctrl+A
(e.keyCode == 65 && e.ctrlKey === true) || 
// Allow: home, end, left, right, down, up
(e.keyCode >= 35 && e.keyCode <= 40)) {
// let it happen, don't do anything
return;
}
// Ensure that it is a number and stop the keypress
if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
e.preventDefault();
}
});
});
	
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

$(document).ready(function(e) {
	setTimeout(function() {
    $("#overlay-mask-1").fadeIn('slow');}, 5000);
	$(".paypalForm-cls :input").prop("disabled", true);	

});

function update_form(formname){
	 if(formname=='paypal'){
$(".authorizeFrm-cls :input").prop("disabled", true);	
$(".paypalForm-cls :input").prop("disabled", false); 
$("#pay_method_select").val('paypal');
	 }
	 if(formname=='authorize'){
$(".paypalForm-cls :input").prop("disabled", true);	
$(".authorizeFrm-cls :input").prop("disabled", false); 		
$("#pay_method_select").val('creditcard'); 
	 }
 }

function edit_info(cls){
	$("."+cls+" :input").toggleClass("no-border");	
	}

$(document).ready(function(e) {
    
	if($("#country").val()=='230'  || $("#country").val()=='45')	{
		$("#state_div").show('fast');	
				
	   $("#state").load("get_state.php?act=select&st_id=<?=$member_row['state']?>&cid="+$("#country").val());	
			
			}
			else{
		$("#state_div").hide('fast');		
			}
			
			if($("#ship_country").val()=='230'  || $("#ship_country").val()=='45')	{
		$("#ship_state_div").show('fast');	
				
	   $("#ship_state").load("get_state.php?act=select&st_id=<?=$member_row['state']?>&cid="+$("#ship_country").val());	
			
			}
			else{
		$("#ship_state_div").hide('fast');		
			}

});

function update_rate(rate,shiping_name){
	$("#service_choose").val('');
	$("#service_choose").val(shiping_name);
	var new_tax=rate;
	
	
	var total=$("#totalM").val();
	$("#ship_price_hidden").val('');
	$("#ship_price_hidden").val(new_tax);
	<? if($check_othercountry_product==true){ ?>
	var other_country_charge=<?=$shipping_charge?>;
	var new_total=parseFloat(total)+parseFloat(new_tax)+parseFloat(other_country_charge);
	<? }
	else{
	?>
	var new_total=parseFloat(total)+parseFloat(new_tax);
	<? } ?>
	new_total=new_total.toFixed(2);
	$(".tax_span").html('');
	$(".tax_span").html(new_tax);
	$(".total_span").html('');
	$(".total_span").html(new_total);
	$("#payM").val(new_total);
	$("#amount_paypal").val(new_total);
}

function update_zip(){
 var zipcode= $("#ship_zipcode").val();
 var ship_country = $("#ship_country").val();
 var total_weight = $("#total_weight").val();
 
 $("#loader_container").show();
  
$.post("ajax_update_price.php",{zipcode:zipcode,ship_country:ship_country,total_weight:total_weight}).done(function(data){
	
	$("#shipping_price_container").html(data);
	var ajax_ship_price=$("#ajax_ship_price").val();
	var total=$("#totalM").val();
	$("#ship_price_hidden").val('');
	$("#ship_price_hidden").val(ajax_ship_price);
	<? if($check_othercountry_product==true){ ?>
	var other_country_charge=<?=$shipping_charge?>;
	var new_total=parseFloat(total)+parseFloat(ajax_ship_price)+parseFloat(other_country_charge);
	<? }
	else{
	?>
	var new_total=parseFloat(total)+parseFloat(ajax_ship_price);
	<? } ?>
	new_total=new_total.toFixed(2);
	$(".tax_span").html('');
	$(".tax_span").html(ajax_ship_price);
	$(".total_span").html('');
	$(".total_span").html(new_total);
	$("#payM").val(new_total);
	$("#amount_paypal").val(new_total);
	
	$("#loader_container").hide();
	
	//alert(data);
});
 	
}

function pickup(id){
var storeid=id;

//window.location="http://fahair.com/pickup_store.php?store_id="+id+"&tradecode=<?=$tradecode;?>&totalP=<?=$total_P?>";
document.getElementById("form_id").action = "pickup_store.php?store_id="+id+"&tradecode=<?=$tradecode;?>&totalP=<?=$total_P?>";
document.getElementById("pp").click();
var x = document.getElementsByName('form_id');
//alert(x);
x[0].submit();
//alert("dhirendra");
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
@media (min-width: 1024px) {
#hid{ display:none;}	}
@media (max-width: 726px) {
	.small-padding-zero {
	padding: 0px !important;

}

}
 @media (max-width: 426px) {
	 .header{ min-height: 1px !important;}
.wsmenucontainer{ min-height: 1px !important;}
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
.no-border{
	border:0;
}
#loader_container{
	display:none;
}
.full-hddn-990{
	display:none;
}
.small-hddn-990{
	display:block;
}
@media (max-width: 768px){
.full-hddn-990{
	display:block;
}
.small-hddn-990{
	display:none;
}
}
@media (min-width: 200px) and (max-width: 768px) {

.ordersumarry {
	margin-top: 2em;
	display:none;
}


}

@media (min-width: 768px) and (max-width: 1224px) {

.ordersumarry {
	margin-top: 2em;
	display:none;
}


}

</style>
<link href="css/custom.css" rel="stylesheet">
</head>

<body>
<div class="full"> 
  <!--header start-->
 <?php include'index_header.php'?>

<!--header end--> 

<!--body start-->
<div class="full" id="body_container">
  <div class="container">
    <div class="row" style="padding:1em; color:#606060;"> Home / Checkout<br>
    </div>
  </div>
  <div style=" background:#DEDEDE; height:1px;margin:.9em 0;" class="full"></div>
  <div class="full row">
    <div class="container" style="margin-top:1em;">
      <h3 class="h3">Checkout</h3>
      <div class="full"> 
        <!-- left side start -->
        <div class="col-lg-9">
      
      <form method="post" action="checkout_process.php" id="form_id"  name="form_id">  
          <input type="hidden" name="totalM" id="totalM" value="<?=$total_P?>">
           <input  type="hidden" name="payM" id="payM" value="<?=$payM?>">
           <input type="hidden" name="ship_price_hidden" id="ship_price_hidden" value="<?=$ship_price?>">
           <input type="hidden" name="tradecode" value="<?= $tradecode;?>" >
           <input type="hidden" name="pay_method_select" id="pay_method_select" value="creditcard" >
           <input type="hidden" name="total_weight" id="total_weight" value="<?=$total_weight?>" >
           <input type="hidden" name="shipping_charge_other_countery" id="shipping_charge_other_countery" value="<?=$shipping_charge?>" >
          <div class="full" style="border:2px solid #CFD0D1; padding:1em; background:#FFF;">
            <div class="row">
              <div class="col-lg-6 col-sm-6 col-xs-6 small-padding-zero"><img src="images/1.png"><span style="font-size:1.5em; color:#82B440; font-weight:bold;">Billing Details</span> <span class="red-btn" style="background:#E5E5E5; color:#666666; padding-left:12px; padding:10px 18px; border:1px solid #DDDDDD; cursor:pointer;" onClick="edit_info('bill-cls')"> Edit</span> </div>
              <div class="col-lg-6 col-sm-6 col-xs-6 small-hddn-990 small-padding-zero"><img src="images/2.png" ><span style="font-size:1.5em; color:#82B440; font-weight:bold;">Shipping Details</span> <span class="red-btn" style="background:#E5E5E5; color:#666666; padding-left:12px; padding:10px 18px; border:1px solid #DDDDDD; cursor:pointer;" onClick="edit_info('ship-cls')">Edit</span> </div>
            </div>
            
            <hr>
            <div class="full" style="color:#6F6666; font-size:1.2em;">
              <div class="col-lg-6 col-sm-6 col-xs-12 small-padding-zero bill-cls">
                <div class="col-lg-10" style="padding:.3em inherit; margin:.4em 0;">
                
         <input type="text"  value="<?=$member_row['f_name']?>" name="name1" class="full no-border"
         placeholder="First Name" style=""></div>
         <div class="col-lg-10" style="padding:.3em inherit; margin:.4em 0;">
                
         <input type="text"  value="<?=$member_row['l_name']?>" name="name2" class="full no-border"
         placeholder="Last Name" style=""></div>
         
                <div class="col-lg-10" style="padding:.3em inherit;margin:.4em 0;">
   <input type="text" value="<?=$member_row['address1']?>" class="full no-border" name="address1" placeholder="Address 1"></div>
                <div class="col-lg-10" style="padding:.3em inherit;margin:.4em 0;">
  <input type="text" value="<?=$member_row['address2']?>" class="full no-border" name="address2" placeholder="Address 2"> </div>
                <div class="col-lg-10" style="padding:.3em inherit;margin:.4em 0;">
  <input type="text" value="<?=$member_row['city']?>" class="full no-border" name="city" placeholder="City"></div>
                <div class="col-lg-10" style="padding:.3em inherit;margin:.4em 0;">
  <input type="text" value="<?=$member_row['zipcode']?>" class="full no-border" name="zipcode" placeholder="Zipcode" ></div>
             <div class="col-lg-10" style="padding:.3em inherit;margin:.4em 0;"> 
           
             <select class="full no-border" name="country" id="country">
       <option value="">Select Country</option>		 
		
	<?php
	  while ($country_result = mysql_fetch_assoc($country_query)) {
	?>	
	<option value="<?=$country_result['country_Id']?>" <? if($member_row['country']==$country_result['country_Id']){?>
	 selected<? } ?>><?=$country_result['country_name']?></option>
	
	<?php } ?>      
             </select>
         <script type="text/javascript">
			$("#country").change(function(){
			if($("#country").val()=='230'  || $("#country").val()=='45')	{
		$("#state_div").show('fast');	
	$("#state").load("get_state.php?act=select&st_id=<?=$member_row['state']?>&cid="+$("#country").val());				
	
	    	//$("#state").load("get_state.php?c_id="+$("#country").val());
			
			}
			else{
		$("#state_div").hide('fast');		
			}
						});		

                                       </script>     
            </div>
            
                <div class="col-lg-10" id="state_div" style="padding:.3em inherit;margin:.4em 0;"> 
        <select class="full no-border" name="state" id="state">
   <option value=""></option>     
        </select>    
            </div>
            
              </div>
              <div class="col-lg-6 col-sm-6 col-xs-12 small-padding-zero ship-cls">
             <div class="col-lg-10 full-hddn-990" style="padding:.3em inherit; margin:.4em 0;">
     <img src="images/2.png" ><span style="font-size:1.5em; color:#82B440; font-weight:bold;">Shipping Details</span> <span class="red-btn" style="background:#E5E5E5; color:#666666; padding-left:12px; padding:10px 18px; border:1px solid #DDDDDD; cursor:pointer;" onClick="edit_info('ship-cls')">Edit</span>        
             </div> 
                <div class="col-lg-10" style="padding:.3em inherit; margin:.4em 0;">
                       <input type="text"  value="<?=$member_row['f_name']?>" name="ship_name1" class="full no-border"
         placeholder="First Name" style=""></div>
         <div class="col-lg-10" style="padding:.3em inherit; margin:.4em 0;">
                
         <input type="text"  value="<?=$member_row['l_name']?>" name="ship_name2" class="full no-border"
         placeholder="Last Name" style=""></div>
                <div class="col-lg-10" style="padding:.3em inherit;margin:.4em 0;">
   <input type="text" value="<?=$member_row['address1']?>" class="full no-border" name="ship_address1" placeholder="Address 1"></div>
                <div class="col-lg-10" style="padding:.3em inherit;margin:.4em 0;">
  <input type="text" value="<?=$member_row['address2']?>" class="full no-border" name="ship_address2" placeholder="Address 2"> </div>
                <div class="col-lg-10" style="padding:.3em inherit;margin:.4em 0;">
  <input type="text" value="<?=$member_row['city']?>" class="full no-border" name="ship_city" placeholder="City"></div>
                <div class="col-lg-10" style="padding:.3em inherit;margin:.4em 0;">
  <input type="text" value="<?=$member_row['zipcode']?>" class="full no-border" name="ship_zipcode" id="ship_zipcode" placeholder="Zipcode" ></div>
             <div class="col-lg-10" style="padding:.3em inherit;margin:.4em 0;"> 
           
             <select class="full no-border" name="ship_country" id="ship_country">
       <option value="">Select Country</option>		 
		
	<?php
	  while ($country_result2 = mysql_fetch_assoc($country_query2)) {
	?>	
	<option value="<?=$country_result2['country_Id']?>" <? if($member_row['country']==$country_result2['country_Id']){?>
	 selected<? } ?>><?=$country_result2['country_name']?></option>
	
	<?php } ?>      
             </select>
         <script type="text/javascript">
			$("#ship_country").change(function(){
			if($("#ship_country").val()=='230'  || $("#ship_country").val()=='45')	{
		$("#ship_state_div").show('fast');	
	$("#ship_state").load("get_state.php?act=select&st_id=<?=$member_row['state']?>&cid="+$("#ship_country").val());				
	
	    	//$("#state").load("get_state.php?c_id="+$("#country").val());
			
			}
			else{
		$("#ship_state_div").hide('fast');		
			}
						});		

                                       </script>     
            </div>
            
                <div class="col-lg-10" id="ship_state_div" style="padding:.3em inherit;margin:.4em 0;"> 
        <select class="full no-border" name="ship_state" id="ship_state">
   <option value=""></option>     
        </select>    
            </div>
              
            </div>
            </div>
            
         <div align="center" class="full">
         <input type="button" style="padding-left:1.5em; padding-right:1.5em;" value="Update" class="red-btn"
        <? if($total_weight!=0) {?> onClick="update_zip()" <? } ?>  name="update">   
              </div>   
          </div>
           <div class="full" style="border:2px solid #CFD0D1; padding:1em; background:#FFF; margin-top:3em;">
            <div class="row">
              <div class="col-lg-10"><img src="images/3.png"><span style="font-size:1.5em; color:#82B440; font-weight:bold;">
             Choose shipping or pickup</span> </div>
        </div>
         
         <?php
		 
		 $id1 = $idss[0];
$store = mysql_query("SELECT * FROM `Manage_Store` where store_id='$id1'");
//echo "SELECT * FROM `Manage_Store` where store_id='$id1'";
?>

<hr>
<div class="col-lg-12 col-xs-12">
<div class="col-lg-6 col-xs-12" id="shipping_price_container">
 <?  if($ups_country=='US'){ ?> 
<? if($ship_over35==1){ ?>
   <!-- for shoping over $35 shiping price us zero--> 
<div class="full" style="padding:.5em 0;"> 
 <div class="col-lg-9 col-sm-9 col-xs-9">
 <input type="radio" name="shipping_type" value="<?=$draw_free?>" 
 onclick="update_rate(<?=$draw_free?>,'Priority Mail Express 1-Day')"  checked="checked" >
   <input type="hidden" name="service_choose" id="service_choose" value="free shipping w/35 order"  />
    
 Free shipping w/$35 order </div>
  <div class="col-lg-3">$<?=$draw_free?></div>
  </div>
  <? } ?>
<div class="full" style="padding:.5em 0;">
  <div class="col-lg-9 col-sm-9 col-xs-12"><input type="radio" name="shipping_type" onClick="update_rate(<?=$ups_gnd?>,'UPS Ground')"  value="<?=$ups_gnd?>"><font size="+1"><b>&nbsp;&nbsp;$<?=$ups_gnd?></b></font><font  style="font-size:12px"><br /><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UPS Ground</span></font></div>
  
  </div>
   
   <div class="full" style="padding:.5em 0;">
  <div class="col-lg-9 col-sm-9 col-xs-12"><input type="radio" name="shipping_type"  onclick="update_rate(<?=$ups_2da?>,'UPS 2nd Day Air')"  value="<?=$ups_2da?>"><font size="+1"><b>&nbsp;&nbsp;$<?=$ups_2da?></b></font><font  style="font-size:12px"><br /><h5>&nbsp;&nbsp;&nbsp;&nbsp;UPS 2nd Day Air</h5></font></div>
  
  </div>
  
  <div class="full" style="padding:.5em 0;">
  <div class="col-lg-9 col-sm-9 col-xs-12"><input type="radio" name="shipping_type"  onclick="update_rate(<?=$usps_servicepost_charge?>,'USPS Standard')"  value="<?=$usps_servicepost_charge?>"><font size="+1"><b>&nbsp;&nbsp;$<?=$usps_servicepost_charge?></b></font><font  style="font-size:12px"><br /><h5>&nbsp;&nbsp;&nbsp;&nbsp;USPS Piroity 2day</h5></font></div>
  
  </div>
  
  <hr id="hid">
  <? }else { ?>
   <!-- for international start -->
 <div class="full" style="padding:.5em 0;">
  <div class="col-lg-9 col-sm-9 col-xs-9"><input type="radio" name="shipping_type" 
   onclick="update_rate(<?=$ship_price?>,'Priority Mail International')" checked  value="<?=$ship_price?>"> 
   
   Priority Mail International</div>
  <div class="col-lg-3">$<?=$ship_price?></div>
  </div>
   <div class="full" style="padding:.5em 0;">
  <div class="col-lg-9 col-sm-9 col-xs-12"><input type="radio" name="shipping_type" 
   onclick="update_rate(<?=$usps_international_all['26']['POSTAGE']?>,'Priority Mail Express International')" 
    value="<?=$usps_international_all['1']['POSTAGE']?>">
   
    Priority Mail Express International</div>
  <div class="col-lg-3">$<?=number_format($usps_international_all['26']['POSTAGE'],2)?></div>
  </div>
  
  <? } ?>
  
</div>       
 
  
<div class="col-lg-6 col-xs-12">
<?  if($_SESSION['level']!=2){ ?>
<?
for ($t=0; $t<3; $t++)
{

$pickup_storid=$arr1[$t]['id'];
$row=mysql_fetch_array(mysql_query("select * from store where id=$pickup_storid"));
$row1=mysql_fetch_array(mysql_query("select * from Pickup where store_id=$pickup_storid"));
?> 

<div  style="width:100%; clear:both;">
  <div style="float:left; margin-top:10px;"> <input type="radio" onClick="pickup(<?=$row['id']?>)" name="pay_option" checked=""></div>
   <div style="float:left; width: 162px;">&nbsp;&nbsp;<b style="color:#000; font-size:18px;"><?=$row['s_name']?></b> <br> <font style="font-size:12px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=$row['s_location']?></font>  <br><font style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FREE pickup</font><br> 
</div>
</div>

<?php } } ?>


        </div>
       
    
        </div>
        </div>
      
        
       
     <!-- shipping method start  -->
       <div class="full" style="border:2px solid #CFD0D1; padding:1em; background:#FFF; margin-top:3em;">
            <div class="row">
              <div class="col-lg-10"><img src="images/3.png"><span style="font-size:1.5em; color:#82B440; font-weight:bold;">
             Shipping Method</span> </div>
        </div>
         <hr>
         
        
         
         
         
      
  
 <!-- for other country manufacture shipping cost -->
  <? if($total_weight!=0){ ?>    
 <? if($check_othercountry_product==true){?>
<!--  <div class="full" style="padding:.5em 0; color:#82B440; font-size:1.3em;">
  <div class="col-lg-9 col-sm-9 col-xs-9">Shipping Cost for other country </div>
  <div class="col-lg-3">$<?=number_format($shipping_charge,2)?></div>
  </div>-->
  
 <? } 
  }
 ?>
 <!-- for other country manufacture shipping cost --> 
 
 
 <div class="full" style="padding:.5em 0; font-size:1.2em;">
 <div class=" col-lg-9 col-sm-9 col-xs-7">Total Amount</div>
 <div class="col-lg-3 col-xs-3 col-sm-3">$<?=number_format($total_P,2)?></div>
 </div>
 <div class="full" style="padding:.5em 0;font-size:1.2em;">
 <div class=" col-lg-9 col-sm-9 col-xs-7">Ship Amount</div>
 <div class="col-lg-3 col-xs-3 col-sm-3">$<span class="tax_span"><?=number_format($ship_price,2)?></span></div>
 </div>
 <div class="full" style="padding:.5em 0;font-size:1.2em; font-weight:bold;">
 <div class=" col-lg-9 col-sm-9 col-xs-7">Pay Amount</div>
 <div class="col-lg-3 col-xs-3 col-sm-3">$<span class="total_span"><?=number_format($total_P+$ship_price,2)?></span></div>
 </div>
 
          </div>  
     <!-- shipping method end -->  
       
          
          <!-- payment info start -->
          <div class="full" style="border:2px solid #CFD0D1; padding:1em; background:#FFF; margin-top:3em;">
            <div class="row">
              <div class="col-lg-10"><img src="images/3.png"><span style="font-size:1.5em; color:#82B440; font-weight:bold;">
             Payment Method</span> <span class="red-btn" style="background:#BCD79A; color:#fff; padding-left:12px; font-weight:bold; 
        padding:10px 18px; ">Upload</span> </div>
        </div>
         <hr>
    <div class="full">
    <div class="col-lg-7" style="border:1px solid #9ECAED; padding:.7em;">
  <div class="full">
  <div class="col-lg-1 col-sm-1 col-xs-1"><input type="radio" checked name="pay_option" onClick="update_form('authorize')" ></div>
    <div class="col-lg-11 col-sm-11 col-xs-11 authorizeFrm-cls">
    	
  <div class="full"><img src="images/card_demo.png" ></div>  
  
  <div class="full" style="margin-top:1em;"><span>Card Type</span><br>
  <select name="card_type" class="form-control" >
 <option value="visa" selected="selected">Visa</option>
 <option value="mastercard">MasterCard</option>
 <option value="discover">Discover</option>
 <option value="amex">American Express</option>
 </select>
  </div>  
  
  <div class="full" style="margin-top:1em;"><span>Card Number</span><br>
 <input type="text" class="form-control" name="card_number" id="card_number">
  </div>  
  <div class="row" style="margin-top:1em;">
 <div class="col-lg-6 col-sm-6 col-xs-6"><span>Expiry date</span><br>

<div style="float:left"> <input type="text" size="3" name="card_month" placeholder="MM" style="border-radius:5px; border:1px solid #BDC3CB; height:40px; margin-right:2px;"> &nbsp;&nbsp;</div> 
<div style="float:left"><input type="text" name="card_year" size="3"placeholder="YYYY" style="border-radius:5px; border:1px solid #BDC3CB; height:40px; "></div>
 </div> 
 <div class="col-lg-6 col-sm-6 col-xs-6">
 <span>Security Code</span><br>
 <input type="text" name="cvv" id="cvv" size="5" style="border-radius:5px; border:1px solid #BDC3CB; height:40px;">
  &nbsp;<img src="images/card_demo2.png" >
 </div> 
  </div>
 <div class="full" style="margin-top:1em;">
 <div style="text-align:center; font-size:1.3em;">
 <input type="submit" name="" value="PAY NOW" style="text-align:center;" class="red-btn" >
 </div>
 </div> 
  <div class="full" style="margin-top:1em; text-align:center; color:#626DAC;">
Cancel
 </div> 

    </div>
  </div>  
    </div>
    
    <div class="col-lg-5 small-margin-2">
    <div class="full"  style="border:1px solid #9ECAED; padding:.7em;">
    <div class="full" align="center">
    <input type="radio" name="pay_option" onClick="update_form('paypal')" ><img src="images/checkout_paypal.png" class="img-thumbnail" style="border:0;"></div>
    
    <div class="row paypalForm-cls" align="center" style="margin:2em;">
   
<input type="submit" name="" style="text-align:center; font-size:1.3em; background:#268BB9;"
 class="red-btn" value="PAY By Paypal" id="pp" >

  
    </div>
    </div>
    </div>
    </div>   
          </div>
          <!-- payment info  end  --> 

       </form>
       
     
        </div>
        <!-- left side end --> 
        
        <!-- right side start -->
        <div class="col-lg-3 small-margin-2 ordersumarry">
          <div class="full" style="background:#FBFBFB; border:1px solid #E1E8ED; padding:.7em; border-radius:5px;">
            <h4 class="h4 text-left">Order Summary</h4>
            <hr style="margin:5px 0; ">
            <div class="row" style="padding:.5em 0;">
              <div class="col-lg-6 col-sm-6 col-xs-6 dotted-text">Booker - Selling eBo</div>
              <div class="col-lg-6 col-sm-6 col-xs-6">$<?=number_format($total_P,2)?></div>
            </div>
            <hr style="margin:5px 0; ">
            <div class="row" style="padding:.5em 0;">
              <div class="col-lg-6 col-sm-6 col-xs-6 dotted-text">Shipping</div>
              <div class="col-lg-6 col-sm-6 col-xs-6">$<span class="tax_span"><?=$ship_price?></span></div>
            </div>
            <hr style="margin:5px 0; ">
            <div class="row" style="padding:.5em 0;">
              <div class="col-lg-6 col-sm-6 col-xs-6 dotted-text">
                <h4 class="h4">Total:</h4>
              </div>
              <?php $total_amount=$total_P+$ship_price; ?>
              <div class="col-lg-6 col-sm-6 col-xs-6">
                <h4 class="h4">$<span class="total_span"><?=number_format($total_amount,2)?></span></h4>
              </div>
            </div>
          </div>
        </div>
        <!-- right side end --> 
      </div>
    </div>
  </div>
</div>

<!--body end--> 

<!-- footer start-->

<?php include'foot.php'?>
<!--footer end  -->

</div>

<!--right sidebar start-->

<!--right sidebar end -->

<!-- loader show start -->
<div id="loader_container" class="overlay-mask" style="">
 
 <div class="full" align="center" style="margin-top:6em;">
 <img src="images/loader.gif" width="100" height="100" >
 </div>
 </div>
<!-- loader show end  -->


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>

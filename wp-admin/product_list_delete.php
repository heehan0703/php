<?php

session_start();

require_once('include/connectdb.php');




if($_SESSION["ADMIN_ID"]==""){
	
header("location:login.php");	
	
	exit;
	 } 
	/* 
	  $limit=16;
	 $sql= ("select * from designs where prod_id='0' order by id DESC");
     $result=mysql_query(dopaging($sql,$limit));


 $cat_id=$_GET['cat_id'];  
 $query=mysql_query("SELECT * FROM `subcategory` where cat_id='$cat_id' ");
 */
 
$id=$_GET['id'];

if(isset($_POST['submit']))
{
	$query3=mysql_query("delete from `product` where id='$id'");
}

 $query1 = mysql_query("select * from `product` where id = '$id'");
 $query2 = mysql_fetch_array($query1);
 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Delete Product</title>

<link href="style/style.css" rel="stylesheet" type="text/css" />
<link href="style/design.css" rel="stylesheet" type="text/css"  />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
 function show_span(){
var cat3=$("#category3").val();	 
 $("#sub_subcat_span").html(cat3);
 }
 
 function show_name(id){
	 var id=id;
	 var file1=$("#"+id).val();
 $("#text_"+id).val(file1);
 
 }

function readURL(input,id) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#div_'+id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}



function remove_img(id){
	var id=id;
	$("#"+id).val('');
	$("#text_"+id).val('');
	$("#div_"+id).attr('src','images/no_img.jpg');
}
    
    function check_it(id){
	if($("#checkbox_"+id).prop('checked') == true){
    //do something
	$("#select_"+id).removeAttr("disabled");
}	
else{
	$("#select_"+id).attr("disabled","true");
}
	}
	
	function Validation(){
var supplier_code,category1,category2,product_name,product_code,manufacture_price,wholesale_price,msrp_price,delivery_time,
dropship,shipping_method,shipping_price,place_origin,package_weight,package_unit,csv_file;	
supplier_code =  $("#supplier_code").val();
category1= $("#category1").val();
category2= $("#category2").val();
product_name= $("#product_name").val();
product_code= $("#product_code").val();
var img=$("#file1").val();
manufacture_price= $("#manufacture_price").val();
wholesale_price= $("#wholesale_price").val();
msrp_price=$("#msrp_price").val();
delivery_time= $("#delivery_time").val();
dropship= $("#dropship").val();
shipping_method=  $("#shipping_method").val();
shipping_price= $("#shipping_price").val();
place_origin= $("#place_origin").val();
 package_weight= $("#package_weight").val();
package_unit= $("#package_unit").val();
csv_file=$("#csv_file").val();
 
 if(supplier_code==''){
alert('Please enter supplier code');
$("#supplier_code").focus();
return false	 
 }
  if(category1==''){
alert('Please select category first');
$("#category1").focus();
return false	 
 }
   if(category2==''){
alert('Please select category second');
$("#category2").focus();
return false	 
 }
  if(product_name==''){
alert('Please enter product name');
$("#product_name").focus();
return false	 
 }
  if(product_code==''){
alert('Please enter product code');
$("#product_code").focus();
return false	 
 }
  if(img==''){
alert('Please upload a image');
$("#file1").focus();
return false	 
 }
  if(manufacture_price==''){
alert('Please enter manufacture price');
$("#manufacture_price").focus();
return false	 
 }
  if(wholesale_price==''){
alert('Please enter wholesale price');
$("#wholesale_price").focus();
return false	 
 }
  if(msrp_price==''){
alert('Please enter msrp price');
$("#msrp_price").focus();
return false	 
 }
  if(delivery_time==''){
alert('Please select delivery time');
$("#delivery_time").focus();
return false	 
 }
  if(dropship==''){
alert('Please select dropship');
$("#dropship").focus();
return false	 
 }
  if(shipping_method==''){
alert('Please select shipping method');
$("#shipping_method").focus();
return false	 
 }
  if(shipping_price==''){
alert('Please enter shipping price');
$("#shipping_price").focus();
return false	 
 }
  if(place_origin==''){
alert('Please select place origin');
$("#place_origin").focus();
return false	 
 }
  if(package_weight==''){
alert('Please enter package weight');
$("#package_weight").focus();
return false	 
 }
  if(package_unit==''){
alert('Please select package unit');
$("#package_unit").focus();
return false	 
 }
  if(csv_file==''){
alert('Please upload option csv file');
$("#csv_file").focus();
return false	 
 }
 if($("#confirmsubmit").prop('checked') != true){
alert('please check acknowledge checkbox !');
return false
 }
else{ 
 $("#product_form").submit();		
}
	}
	
	function slide_option(){
 $("#option_setup_div").slideToggle('slow');
	}
	// option_setup_div
var global_count=0;	

function add_new_option(){
	$("#other_option_set").val('1');
	
	var option=$("#new_option_text").val();
	var content ="<div class='col-lg-1 border-class zero-padding '><div class='full border-bottom' style='min-height:24px;'>"+option+"</div></div>";
	var new_content="<div class='col-lg-1 border-class zero-padding'><div class='full border-bottom ' style='min-height:24px;'><input type='text' class='full' value='' name='"+option+"[]' placeholder='"+option+"'></div></div>";
	$(".stock_div").after(content);
	$(".stock_div_val").after(new_content);
	$(".overlay-mask").hide();
	global_count++;
	//alert(global_count);
	$("#option_hidden"+global_count).val(option);
	$("#total_option_hidden").val(global_count);
	
}



function add_option_row(){
	//$(".input-cls").removeAttr("id");
	//$(".input-cls").removeAttr("onblur");
 var html=$("#all_option_div").html();	
 
var html = html.replace("hide_content()", "delete_row(this)"); 
  
 var new_html="<div class='full full-class'  style='color:#000;'>"+html+"</div>"
 $("#all_option_div").after(new_html);
}

function show_option_setup(){
	$("#new_option_text").val('');
$("#overlay-mask-1").show();	
}

function hidden_option_setup(){
	//$("#other_option_set").val('0');
$("#overlay-mask-1").hide();
}

$(document).ready(function(e) {
    if($("#file_option_checked").prop('checked') == true){
//alert('file option checked');
$(".file-option-clss").attr("disabled", false);
$(".other-option-clss :input").attr("disabled", true);
}
else{
//alert('other option cheecked');	
$(".file-option-clss").attr("disabled", true);
$(".other-option-clss :input").attr("disabled", false);
}
});

function update_check_option(obj){
	 var cbs = document.getElementsByName("choose_option");
    for (var i = 0; i < cbs.length; i++) {
        cbs[i].checked = false;
    }
    obj.checked = true;
	
if($("#file_option_checked").prop('checked') == true){
//alert('file option checked');
$(".file-option-clss").attr("disabled", false);
$(".other-option-clss :input").attr("disabled", true);
}
else{
//alert('other option cheecked');	
$(".file-option-clss").attr("disabled", true);
$(".other-option-clss :input").attr("disabled", false);
}
	
}

function delete_row(obj){

//$('.'+cls).parent().prop('className').html('');	
//$('.'+cls).parents(this).prop('className').val();
$(obj).closest('div.full-class').html('');
}


function pass_val(id){
var val=	$("#"+id).val();
 $("#"+id).attr('value', val);

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
	content: "?";
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
.full-margin{
	margin:2em;
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
	list-style: outside none none;
	position: absolute;
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
.input-xm{
	width:21%;
}

.dotted-class{
	border-bottom: 1px dotted #999;
    display: inline-block;
    height: 1px;
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
.full-margin{
	margin:0em;
}
}
.border-class{
	border: 1px solid #e1e1e1;
}
.border-bottom{
	border-bottom:1px solid #e1e1e1;
	margin:.5em 0;
}
.zero-padding{
	padding:0px !important;
	line-height:1.2em;
}
.dotted-text{
	overflow: hidden !important;
    text-overflow: ellipsis;
    white-space: nowrap !important;
}
#option_setup_div{
	display:none;
}
</style>

</head>



<body style="font-size:16px;">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td><? include('header.php')?></td>

  </tr>

  <tr>

    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td width="20%" valign="top"><? include('left_menu.php');?></td>

        <td width="80%" valign="top"><table width="100%" border="0" cellspacing="10" cellpadding="0">

          
          <tr>

            <td>

              <table width="100%" border="0" cellspacing="10" cellpadding="0">

                <tr>

                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                      <td class="lite-blue-bx"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                        <tr>

                          <td width="1%" ><img src="images/lft-menu-hd-corner-1.png" width="10" height="35" /></td>

                          <td width="99%" class="blue-bx-topmid-bg" ><table width="100%" border="0" cellspacing="5" cellpadding="0">

                            <tr>

                              <td align="left" class="white-18">Delete Product</td>

                            </tr>

                          </table></td>
                           
                          <td width="0%" ><img src="images/lft-menu-hd-corner-2.png" width="10" height="35" /></td>

                        </tr>

                        <tr>

                          <td >&nbsp;</td>

                          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                            <tr>

                             <td colspan="4"></td>
                              
                       
                            </tr>
 
                      <tr>
                      <td>
                       <form id="product_delete_form" name="product_delete_form" method="POST" action="" onsubmit="return validate_form()">
                      <table width="100%" cellpadding="3" cellspacing="3">
                      
                     
     <tr>
     <td width="30%" align="left">Supplier Code</td>
     <td width="40%" align="left">
     <input type="text" name="supplier_code" id="supplier_code" class="form-group" value ="<?=$query2['supplier_code']?>" disabled></td>
    </tr>
       
       <tr>
     <td width="30%" align="left">Product Name </td>
     <td width="40%" align="left">
     <input type="text" name="product_name" id="product_name" class="form-group" value ="<?=$query2['product_name']?>" disabled></td>
      </tr>

        <tr>
     <td width="30%" align="left">Product Code </td>
     <td width="40%" align="left">
     <input type="text" name="product_code" id="product_code" class="form-group" value ="<?=$query2['product_code']?>" disabled></td>
      </tr>


 <tr>
     <td width="30%" align="left"><input type="checkbox" disabled id="checkbox_hair_type" name="checkbox_hair_type"  value="1" onClick="check_it('hair_type')" 
	 <?php if($query2['hair_type_check']== 1){?>   checked <?php }  ?>>Hair Type </td>
     <td width="40%" align="left">
     <select id="select_hair_type" name="select_hair_type" disabled> 
             
		     <option value="1" <?php if($query2['hair_type_value']=='1'){?> selected <?php } ?>>Human Hair</option>
            <option value="2" <?php if($query2['hair_type_value']=='2'){?> selected <?php } ?>>Syntheric Hair</option>
            <option value="3" <?php if($query2['hair_type_value']=='3'){?> selected <?php } ?>>Remy Hair</option>
            <option value="4" <?php if($query2['hair_type_value']=='4'){?> selected <?php } ?>>Human Hair Blend</option>
          </select>
		</td>
      </tr>


 <tr>
     <td width="30%" align="left">Min. Order Quantity  </td>
     <td width="40%" align="left">
     <input type="text" value="<?=$query2['quantity']?>" id="quantity" name="quantity" class="form-group" disabled>
       <select name="quantity_type" disabled>
               <option value="" disabled >Select </option>
		      <option value="Pieces" <?php if($query2['quantity_type']=='Pieces'){?> selected <?php } ?>>Pieces</option>
              <option value="Box" <?php if($query2['quantity_type']=='Box') {?> selected<?php } ?>>Box</option>
              <option value="Bottle" <?php if($query2['quantity_type']=='Bottle') {?> selected <?php } ?>>Bottle</option>
          </select>
		</td>
      </tr>

      <tr>
      <td colspan="2"> Price</td>
      </tr>
     <tr>
     <td width="30%" align="left">Manufacture price </td>
     <td width="40%" align="left">
     $<input type="text" style="width:25%;" value="<?=$query2['manufacture_price']?>" name="manufacture_price" id="manufacture_price" disabled>
     </td>
      </tr>

<tr>
     <td width="30%" align="left">Wholesale price (*List Price) </td>
     <td width="40%" align="left">
     $<input type="text" style="width:25%;" value="<?=$query2['wholesale_price']?>" name="wholesale_price" id="wholesale_price" disabled></td>
      </tr>

<tr>
     <td width="30%" align="left">Msrp price</td>
     <td width="40%" align="left">
     $<input type="text" style="width:25%;" value="<?=$query2['msrp_price']?>" id="msrp_price" name="msrp_price" disabled></td>
      </tr>

<tr>
     <td width="30%" align="left"><input type="checkbox" id="checkbox_discount_option" name="checkbox_discount_option" value="1" onClick="check_it('discount_option')"
      <?php if($query2['discount_option_check']== 1){?>   checked <?php }  ?> disabled> Discount option </td>
     <td width="40%" align="left">
     <select id="select_discount_option" name="select_discount_option" disabled>
              <option value="" >Select</option>
             <option  value="300_5" <?php if($query2['discount_option_value']=='300_5'){?> selected <?php } ?>>$300 more Order 5% OFF</option>
            <option value="500_8" <?php if($query2['discount_option_value']=='500_8'){?> selected <?php } ?>>$500 more Order 8% OFF</option>
            <option value="1000_10" <?php if($query2['discount_option_value']=='1000_10'){?> selected <?php } ?>>$1000 more Order 10% OFF</option>
</select></td>
      </tr>


<tr>
     <td width="30%" align="left"><input type="checkbox" disabled
onClick="check_it('special_promotion')" id="checkbox_special_promotion" name="checkbox_special_promotion" value="1" <?php if($query2['special_promotion_check']== 1){?>   checked <?php } ?>>Special promotion </td>
     <td width="40%" align="left">
     <input type="text" size="5" id="select_special_promotion" name="select_special_promotion" disabled value="<?=$query2['special_promotion_value']?>" >
% OFF of Wholesale price</td>
      </tr>


      <tr>
      <td colspan="2"> Shipping</td>
      </tr>
<tr>
     <td width="30%" align="left">Delivery Time </td>
     <td width="40%" align="left">
     <select name="delivery_time" id="delivery_time" disabled>
          <option value="" style="color:#999">Select Unit Type</option>
          <option value="2nd Shipping" <?php if($query2['delivery_time']=='2nd Shipping'){?> selected <?php } ?>>2nd Shipping</option>
          <option value="3-7 Business Days" <?php if($query2['delivery_time']=='3-7 Business Days'){?> selected <?php } ?>>3-7 Business Days</option>
          <option value="7-14 Business Days" <?php if($query2['delivery_time']=='7-14 Business Days'){?> selected <?php } ?>>7-14 Business Days</option>
          <option value="14-25 Business Days" <?php if($query2['delivery_time']=='14-25 Business Days'){?> selected <?php } ?>>14-25 Business Days</option>
          <option value="45 Business Days" <?php if($query2['delivery_time']=='45 Business Days'){?> selected <?php } ?>>45 Business Days</option>
          <option value="60 Business Days" <?php if($query2['delivery_time']=='60 Business Days'){?> selected <?php } ?>>60 Business Days</option>
          <option value="90 Business Days" <?php if($query2['delivery_time']=='90 Business Days'){?> selected <?php } ?>>90 Business Days</option>
</select></td>
      </tr>


<tr>
     <td width="30%" align="left">Dropship</td>
     <td width="40%" align="left">
     <select name="dropship" id="dropship" disabled>
        <option value="">Select</option>
             <option value="Yes" <?php if($query2['dropship']=='Yes'){?> selected <?php } ?>>Yes</option>
             <option value="No" <?php if($query2['dropship']=='No'){?> selected <?php } ?>>No</option></select></td>
      </tr>


<tr>
     <td width="30%" align="left">Shipping Method </td>
     <td width="40%" align="left">
     <select name="shipping_method" id="shipping_method" disabled>
  <!--<option value="">Select shipping</option>-->
          <option value="USPS" <?php if($query2['shipping_method']=='USPS'){?> selected <?php } ?> >USPS</option>
          <option  value="SINA SHIPPING" <?php if($query2['shipping_method']=='SINA SHIPPING'){?> selected <?php } ?>>SINA SHIPPING</option>
          <option value="UPS" <?php if($query2['shipping_method']=='UPS'){?> selected <?php } ?>>UPS</option>
          <option value="DHL" <?php if($query2['shipping_method']=='DHL'){?> selected <?php } ?>>DHL</option>
          <option value="Fedex" <?php if($query2['shipping_method']=='Fedex'){?> selected <?php } ?>>Fedex</option>
          <option value="FREE SHIPPING" <?php if($query2['shipping_method']=='FREE SHIPPING'){?> selected <?php } ?>>FREE SHIPPING</option>
</select></td>
      </tr>


<tr>
     <td width="30%" align="left">Shipping Price/unit </td>
     <td width="40%" align="left">
     <input type="text" size="4" value="<?= $query2['shipping_price'] ?>" name="shipping_price" id="shipping_price" disabled> or Calculate<br>
<input type="text" size="4" value="" disabled >+</td>
      </tr>

<tr>
     <td width="30%" align="left">Place of Origin: </td>
     <td width="40%" align="left">
     <select name="place_origin" id="place_origin" disabled>
    <!--<option value="">Select Orgin</option>-->
          <option value="China" <?php if($query2['place_origin']=='China'){?> selected <?php } ?>>China</option>
          <option value="India" <?php if($query2['place_origin']=='India'){?> selected <?php } ?>>India</option>
          <option value="Malaysia" <?php if($query2['place_origin']=='Malaysia'){?> selected <?php } ?>>Malaysia</option>
          <option value="Vietnam" <?php if($query2['place_origin']=='Vietnam'){?> selected <?php } ?>>Vietnam</option>
          <option value="USA" <?php if($query2['place_origin']=='USA'){?> selected <?php } ?>>USA</option>
          <option value="Canada" <?php if($query2['place_origin']=='Canada'){?> selected <?php } ?>>Canada</option>
</select></td>
      </tr>

<tr>
     <td width="30%" align="left">Package Weight /unit: </td>
     <td width="40%" align="left">
     <input type="text" size="4" name="package_weight" id="package_weight" value ="<?=$query2['package_weight']?>" disabled >
 <select name="package_unit" id="package_unit" disabled>
 <option value="">Select Option</option>
 <option value="Ib" <?php if($query2['package_unit']=='Ib'){?> selected <?php } ?>>Ib</option>
            <option value="g" <?php if($query2['package_unit']=='g'){?> selected <?php } ?>>g</option>
            <option value="Kg" <?php if($query2['package_unit']=='Kg'){?> selected <?php } ?>>Kg</option>
            <option value="Oz" <?php if($query2['package_unit']=='Oz'){?> selected <?php } ?>>Oz</option></select>
</td>
      </tr>

<tr><td colspan="2">  <input  type="submit" value="Delete" name="submit" onclick="alert('Want to Delete Product?')"/></td></tr>

                      </table>
                      </form>
                      </td>
                      </tr>
                                        
                          

                            <tr>

                              <td colspan="10">&nbsp;</td>

                            </tr>

                            <tr>

                              <td colspan="11"><table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
                                	<td colspan="2" align="left">
                                   <font size="+2"> <?php // echo leftpaging(); ?> </font>
                                    </td>
                                </tr>					
                               

                              </table></td>

                            </tr>

                          </table></td>

                          <td >&nbsp;</td>

                        </tr>

                        <tr>

                          <td >&nbsp;</td>

                       <td  align="left"></td>

                        </tr>

                      </table></td>

                    </tr>

                  </table></td>

                </tr>

                <tr>

                  <td>&nbsp;</td>

                </tr>

              </table>

           </td>

          </tr>

          <tr>

            <td>&nbsp;</td>

          </tr>

        </table></td>

      </tr>

   </td>

  </tr>
  

  <tr>

    <td><? include('footer.php')?></td>

  </tr>

</table>


</body>

</html>


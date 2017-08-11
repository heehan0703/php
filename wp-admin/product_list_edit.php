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
$category=mysql_query("SELECT * FROM `category` where category_name!='' order by category_name ASC "); 
$id=$_GET['id'];
if(isset($_POST['product_name']))
{
	$product_id = $_POST['product_id'];
	$category1=$_POST['category1'];
	$category2=$_POST['category2'];
	$category3=$_POST['category3'];
	$supplier_code= $_POST['supplier_code'];
	$product_name= $_POST['product_name'];
	$seo_tags=$_POST['Tag_words'];
	 $product_code= $_POST['product_code'];
	 $hair_type	= implode(",",$_POST['hair_type']);	
    $hair_type_length = implode(",",$_POST['hair_type_length']);	
    $hair_type_style = implode(",",$_POST['hair_type_style']);	
	$quantity=$_POST['quantity'];
	$quantity_type=$_POST['quantity_type'];
	$manufacture_price=$_POST['manufacture_price'];
	$wholesale_price=$_POST['wholesale_price'];
	$msrp_price=$_POST['msrp_price'];
	$checkbox_discount_option=$_POST['checkbox_discount_option'];
	$select_discount_option=$_POST['select_discount_option'];
	$checkbox_special_promotion=$_POST['checkbox_special_promotion'];
	$select_special_promotion=$_POST['select_special_promotion'];
	$delivery_time=$_POST['delivery_time'];
	$dropship=$_POST['dropship'];
	$shipping_method=$_POST['shipping_method'];
	$shipping_price=$_POST['shipping_price'];
	$place_origin=$_POST['place_origin'];
	$package_weight=$_POST['package_weight'];
	$package_unit=$_POST['package_unit'];
	$description1=$_POST['description'];
	$description=substr($description1,0,1001);
											  
   
   if(isset($_FILES['csv_file'])){
	 $mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
if(in_array($_FILES['csv_file']['type'],$mimes)){
	
	$file=$_FILES['csv_file'];
  			$name_fi=time().$file['name'];

		move_uploaded_file($file['tmp_name'],'../csv/'.$name_fi);


$row = 1;
if (($handle = fopen("..csv/".$name_fi, "r")) !== FALSE) {
	
	fgetcsv($handle, 1000, ",");
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
       // echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
		$count=0;
        for ($c=0; $c < $num; $c++) {
           $count++;
		   
		   if($count>5){
		   $count=0;
		   }
		   if($count==1){
			 $sku .=$data[$c].",";
			   
			   
		   }
		    if($count==2){
			 $length .=$data[$c].",";
			   
			   
		   }
		    if($count==3){
			 $color .=$data[$c].",";
			   
			   
		   }
		   if($count==4){
			 $price .=$data[$c].",";
			   
			   
		   }
		    if($count==5){
			 $stock .=$data[$c].",";
			   
			   
		   }
		   
        }
		
    }
    fclose($handle);
}
 $sku=rtrim($sku,',');
 $length=rtrim($length,',');
 $color=rtrim($color,',');
 $price=rtrim($price,',');
 $stock=rtrim($stock,',');	 
 }
 }
 else{
	
	$sku = implode(',',$_POST['sku_option']);
	$length = implode(',',$_POST['length_option']);
	$color = implode(',',$_POST['color_option']);
	$price = implode(',',$_POST['price_option']);
	$stock = implode(',',$_POST['stock_option']);
	$length_unit = implode(',',$_POST['length_unit']);

 }
 

 
$insert=" update `product` set  `category`='$category1', `subcategory`='$category2', `sub_subcategory`='$category3', 
`product_name`='$product_name',`hair_type`='$hair_type',`hair_type_length`='$hair_type_length',`hair_type_style`='$hair_type_style', `quantity`='$quantity', `quantity_type`='$quantity_type', `manufacture_price`='$manufacture_price', `wholesale_price`='$wholesale_price', `msrp_price`='$msrp_price', `discount_option_check`='$checkbox_discount_option', `discount_option_value`='$select_discount_option', `special_promotion_check`='$checkbox_special_promotion',`special_promotion_value`='$select_special_promotion',`delivery_time`='$delivery_time', `dropship`='$dropship',`shipping_method`='$shipping_method', `shipping_price`='$shipping_price', `place_origin`='$place_origin', `package_weight`='$package_weight', `package_unit`='$package_unit', `description`='$description',`sku`='$sku',`length`='$length',`color`='$color',`price`='$price',`stock`='$stock',`length_size`='$length_unit',seo_tags='$seo_tags'  where id='$id'";

/*echo " update `product` set  `category`='$category1', `subcategory`='$category2', `sub_subcategory`='$category3', 
`product_name`='$product_name',`hair_type`='$hair_type',`hair_type_length`='$hair_type_length',`hair_type_style`='$hair_type_style', `quantity`='$quantity', `quantity_type`='$quantity_type', `manufacture_price`='$manufacture_price', `wholesale_price`='$wholesale_price', `msrp_price`='$msrp_price', `discount_option_check`='$checkbox_discount_option', `discount_option_value`='$select_discount_option', `special_promotion_check`='$checkbox_special_promotion',`special_promotion_value`='$select_special_promotion',`delivery_time`='$delivery_time', `dropship`='$dropship',`shipping_method`='$shipping_method', `shipping_price`='$shipping_price', `place_origin`='$place_origin', `package_weight`='$package_weight', `package_unit`='$package_unit', `description`='$description',`sku`='$sku',`length`='$length',`color`='$color',`price`='$price',`stock`='$stock',`length_size`='$length_unit'  where id='$id'";
header("location: http://beautco.com/wp-admin/product_list.php"); 
 */
 //exit;
 
 mysql_query($insert);
 
 }
$query1 = mysql_query("select * from `product` where id = '$id'");
$query2 = mysql_fetch_array($query1);

  
 $hair_type	= explode(",",$query2['hair_type']);	
 $hair_type_length = explode(",",$query2['hair_type_length']);	
 $hair_type_style = explode(",",$query2['hair_type_style']);	

$product_img=explode(',',$query2['images']); 

$product_img0=$product_img[0];
$product_img1=$product_img[1];
$product_img2=$product_img[2];
$product_img3=$product_img[3];

$new_name_1=str_replace(" ","",$query2['subcategory']);
$new_name_1=str_replace("/","_",$new_name_1);
	
	 $color_option = $query2['color'];
	 $color_option =  rtrim($color_option,',');
	$sku_option	= explode(",",$query2['sku']);	
	$length_option	= explode(",",$query2['length']);
	$color_option	= explode(",",$color_option);
	$price_option	= explode(",",$query2['price']);
	$stock_option = explode(",",$query2['stock']);
	
	$length_size_option	= explode(",",$query2['length_size']);
		
		
		
		//print_r($color_option);
		
	 $length_option_count=count(array_filter($color_option));	

 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Edit Product</title>

<link href="style/style.css" rel="stylesheet" type="text/css" />
<link href="style/design.css" rel="stylesheet" type="text/css"  />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="../ckeditor/ckeditor.js"></script>
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
 
 /*if($("#confirmsubmit").prop('checked') != true){
alert('please check acknowledge checkbox !');
return false
 }
else{ 
 $("#product_form").submit();		
}*/
	}
	
	function slide_option(){
 $(".option_setup_div").slideToggle('slow');
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
  
 var new_html="<tr class='option_setup_div' style='color:#000;'>"+html+"</tr>"
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
$(obj).closest('tr.option_setup_div').html('');
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
<link href="../css/custom.css" rel="stylesheet">
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

                              <td align="left" class="white-18">Edit Product</td>

                            </tr>

                          </table></td>
                           
                          <td width="0%" ><img src="images/lft-menu-hd-corner-2.png" width="10" height="35" /></td>

                        </tr>

                        <tr>

                          <td >&nbsp;</td>

                          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                            <tr>

                             <td colspan="8"></td>
                              
                       
                            </tr>
 
                      <tr>
                      <td>
                       <form id="product_edit_form" name="product_edit_form" method="POST" action="" onsubmit="return Validation()" enctype="multipart/form-data">
                       
                       <input type="hidden" name="product_id" value="<?=$id?>" >
                      <table width="100%" cellpadding="3" cellspacing="3">
                      
                     
     <tr>
     <td width="30%" align="left" colspan="4">Supplier Code</td>
     <td width="40%" align="left" colspan="4">
     <input type="text" value="<?=$query2['supplier_code']?>" name="supplier_code" id="supplier_code" class="form-group" readonly ></td>
    </tr>
       
      <tr>
     <td width="30%" align="left" colspan="4">Category</td>
     <td width="40%" align="left" colspan="4">
     <select id="category1" name="category1">
	
     <option value="">Select Option</option> 
     <?php while($cat_row=mysql_fetch_assoc($category)){ ?> 
<option value="<?=$cat_row['category_name']?>"  <?php if($cat_row['category_name']== $query2['category']){?>selected <?php }  ?>><?=$cat_row['category_name']?></option>	 
	  <?php } ?>      
	</select>&nbsp; 
	
	        <script type="text/javascript">
			$("#category1").change(function(){	
		    		
	    	$("#category2").load("get_subcategory.php?cat_name="+encodeURIComponent($("#category1").val())+"&level=1");
			});		

           </script>  
		  
		  <select id="category2" name="category2">
          <option value="<?=$query2['subcategory']?>"><?=$query2['subcategory']?></option>   
		  
          </select>
          &nbsp;
          <script type="text/javascript">
			$("#category2").change(function(){	
				
		    		
	    	$("#category3").load("get_subcategory.php?sub_name="+encodeURIComponent($("#category2").val())+"&level=2");
			
			
			
			});		

                                       </script>  
		   
          
            <select id="category3" name="category3" onChange="show_span();">
      <option value="">Select Option</option>    
		  
          </select>

     </td>
     </tr>
    
       
       
       <tr>
     <td width="30%" align="left" colspan="4">Product Name </td>
     <td width="40%" align="left" colspan="4">
     <input type="text" value="<?php echo htmlentities($query2['product_name']);?>" name="product_name" id="product_name" class="form-group"></td>
      </tr>
     
     <tr>
     <td width="30%" align="left" colspan="4">Product Code </td>
     <td width="40%" align="left" colspan="4">
     <input type="text" name="product_code" id="product_code" class="form-group" value ="<?=$query2['product_code']?>"></td>
     </tr>
    
     <tr>
     <td width="30%" align="left" colspan="4">Products Tag words </td>
     <td width="40%" align="left" colspan="4">
     <input type="text" name="Tag_words" id="product_code" class="form-group" value ="<?=$query2['seo_tags']?>" style="width:220px"></td>
     </tr>
     
     
     <tr>
     <td width="30%" align="left" colspan="4">Product Image-1 </td>
     <td width="40%" align="left" colspan="4">
     <input type="text" value="" id="text_file1" readonly class="form-group">
     <input type="file" id="file1"  name="file[]" accept="image/*" onChange="show_name('file1');readURL(this,'file1');" style="display:inline-block; max-width:80px;">
    </td> </tr>
     
     <tr>
     <td width="30%" align="left" colspan="4">Product Image-2 </td>
     <td width="40%" align="left" colspan="4">
     <input type="text" value="" id="text_file2" readonly  class="form-group">
     <input type="file" id="file2" name="file[]" onChange="show_name('file2');readURL(this,'file2');" 
     accept="image/*" style="display:inline-block; max-width:80px;">

        </td></tr>
     
     <tr>
     <td width="30%" align="left" colspan="4">Product Image-3</td>
     <td width="40%" align="left" colspan="4">
     <input type="text" value="" id="text_file3" readonly  class="form-group">
     <input type="file" id="file3" name="file[]" onChange="show_name('file3');readURL(this,'file3');"
      accept="image/*"   style="display:inline-block; max-width:80px;">
     </td></tr>
     
     <tr>
     <td width="30%" align="left" colspan="4">Product Image-4</td>
     <td width="40%" align="left" colspan="4">
     <input type="text" value="" id="text_file4" readonly  class="form-group">
     <input type="file" id="file4"  name="file[]" onChange="show_name('file4');readURL(this,'file4');" 
     accept="image/*"   style="display:inline-block; max-width:80px;">

     </td></tr>
    
     <tr>
     <td width="30%" align="left" colspan="4">Gallery picture-1</td>
     <td width="40%" align="left"colspan="4">
     <img border="0" align="absmiddle" data="picData" id="div_file1"
      width="77" height="77" src="../product_img/<?=$product_img0?>" title="Photo" alt="Photo"><br />
     <a href="javascript:{}"><img border="0" src="http://pics.ebaystatic.com/aw/pics/icon/iconInactMoveLt_16x16.gif" alt=""></a>
     <a onclick="ebay.run(this.id,'onclick');return false;" id="moverightLnk0" href="javascript:{}"><img border="0" id="moveright0" src="http://pics.ebaystatic.com/aw/pics/icon/iconInactMoveRt_16x16.gif" alt=""></a><a onclick="remove_img('file1')" id="removeimageLnk0" href="javascript:void(0)"><img border="0" id="removeimage0" src="http://pics.ebaystatic.com/aw/pics/icon/iconTrashcan_16x16.gif" title="Remove" alt="Remove"></a>
     </td></tr>

     <tr>
     <td width="30%" align="left" colspan="4">Gallery picture-2</td>
     <td width="40%" align="left" colspan="4">
     <img border="0" align="absmiddle" data="picData" id="div_file2"
      width="77" height="77" src="../product_img/<?=$product_img1?>" title="Photo" alt="Photo"><br />
      <a href="javascript:{}"><img border="0" src="http://pics.ebaystatic.com/aw/pics/icon/iconInactMoveLt_16x16.gif" alt=""></a><a onclick="ebay.run(this.id,'onclick');return false;" id="moverightLnk0" href="javascript:{}"><img border="0" id="moveright0" src="http://pics.ebaystatic.com/aw/pics/icon/iconInactMoveRt_16x16.gif" alt=""></a><a onclick="remove_img('file2')" id="removeimageLnk0" href="javascript:void(0)"><img border="0" id="removeimage0" src="http://pics.ebaystatic.com/aw/pics/icon/iconTrashcan_16x16.gif" title="Remove" alt="Remove"></a>
     </td></tr>

      <tr>
     <td width="30%" align="left" colspan="4">Gallery picture-3</td>
     <td width="40%" align="left" colspan="4">
     <img border="0" align="absmiddle" data="picData" id="div_file3"
      width="77" height="77" src="../product_img/<?=$product_img2?>" title="Photo" alt="Photo"><br />
      <a href="javascript:{}"><img border="0" src="http://pics.ebaystatic.com/aw/pics/icon/iconInactMoveLt_16x16.gif" alt=""></a><a onclick="ebay.run(this.id,'onclick');return false;" id="moverightLnk0" href="javascript:{}"><img border="0" id="moveright0" src="http://pics.ebaystatic.com/aw/pics/icon/iconInactMoveRt_16x16.gif" alt=""></a><a onclick="remove_img('file3')" id="removeimageLnk0" href="javascript:void(0)"><img border="0" id="removeimage0" src="http://pics.ebaystatic.com/aw/pics/icon/iconTrashcan_16x16.gif" title="Remove" alt="Remove"></a>
     </td></tr>

      <tr>
     <td width="30%" align="left" colspan="4">Gallery picture-4</td>
     <td width="40%" align="left" colspan="4">
    <img border="0" align="absmiddle" data="picData" id="div_file4" 
    width="77" height="77" src="../product_img/<?=$product_img3?>" title="Photo" alt="Photo"><br />
    <a href="javascript:{}"><img border="0" src="http://pics.ebaystatic.com/aw/pics/icon/iconInactMoveLt_16x16.gif" alt=""></a><a onclick="ebay.run(this.id,'onclick');return false;" id="moverightLnk0" href="javascript:{}"><img border="0" id="moveright0" src="http://pics.ebaystatic.com/aw/pics/icon/iconInactMoveRt_16x16.gif" alt=""></a><a onclick="remove_img('file4')" id="removeimageLnk0" href="javascript:void(0)"><img border="0" id="removeimage0" src="http://pics.ebaystatic.com/aw/pics/icon/iconTrashcan_16x16.gif" title="Remove" alt="Remove"></a>
     </td></tr>

     
     
     

 <tr>
     <td width="30%" align="left" colspan="3">
   <input type="checkbox" id="checkbox_hair_type" name="hair_type[]"  onClick="check_it('hair_type')" value="1">Hair Type<br />
   <input name="hair_type[]" type="checkbox" value="human hair"  <?php if(in_array('human hair',$hair_type)){?> checked="checked" <?php } ?> /> human hair <br />
    <input name="hair_type[]" type="checkbox" value="synthetic hair"  <?php if(in_array('synthetic hair',$hair_type)){?> checked="checked" <?php } ?> /> synthetic hair <br />
    <input name="hair_type[]" type="checkbox" value="remy hair"  <?php if(in_array('remy hair',$hair_type)){?> checked="checked" <?php } ?> /> remy hair <br />
    <input name="hair_type[]" type="checkbox"  value="human hair blant"  <?php if(in_array('human hair blant',$hair_type)){?> checked="checked" <?php } ?>/> human hair blant <br />
           	   
     
      </td>
     <td width="20%" align="left" colspan="2">
     <input name="hair_type_length[]" type="checkbox"  style="background-color:#999; margin-left:16px">length <br />
     <input name="hair_type_length[]" type="checkbox" value="bob"  <?php if(in_array('bob',$hair_type_length)){?> checked="checked" <?php } ?> /> bob <br />
    <input name="hair_type_length[]" type="checkbox" value="long"  <?php if(in_array('long',$hair_type_length)){?> checked="checked" <?php } ?>/>long <br />
    <input name="hair_type_length[]" type="checkbox" value="medium"  <?php if(in_array('medium',$hair_type_length)){?> checked="checked" <?php } ?> /> mediom <br />
   
    		</td>
             <td width="20%" align="left" colspan="1">
     <input name="hair_type_style[]" type="checkbox"  style="background-color:#999; margin-left:16px">style <br />
    <input name="hair_type_style[]" type="checkbox" value="bob cut"  <?php if(in_array('bob cut',$hair_type_style)){?> checked="checked" <?php } ?> /> bob cut <br />
    <input name="hair_type_style[]" type="checkbox" value="layered cut"  <?php if(in_array('layered cut',$hair_type_style)){?> checked="checked" <?php } ?> /> layered cut <br />
    <input name="hair_type_style[]" type="checkbox" value="loose body cut"  <?php if(in_array('loose body cut',$hair_type_style)){?> checked="checked" <?php } ?>/> loose body cut <br />
    <input name="hair_type_style[]" type="checkbox"  value="loose deep cut"  <?php if(in_array('loose deep cut',$hair_type_style)){?> checked="checked" <?php } ?>/> loose deep cut <br />
     <input name="hair_type_style[]" type="checkbox" value="small wave"  <?php if(in_array('small wave',$hair_type_style)){?> checked="checked" <?php } ?> />small wave  <br />
    <input name="hair_type_style[]" type="checkbox" value="sprial curl"  <?php if(in_array('sprial curl',$hair_type_style)){?> checked="checked" <?php } ?> /> sprial curl<br />
    <input name="hair_type_style[]" type="checkbox" value="straight"  <?php if(in_array('straight',$hair_type_style)){?> checked="checked" <?php } ?> /> straight <br />
  
    		</td>
    
      


      </tr>


 <tr>
     <td width="30%" align="left" colspan="4">Min. Order Quantity  </td>
     <td width="40%" align="left" colspan="4">
     <input type="text" value="<?=$query2['quantity']?>" id="quantity" name="quantity" class="form-group" >
       <select name="quantity_type">
               <option value="" >Select </option>
		      <option value="Pieces" <?php if($query2['quantity_type']=='Pieces'){?> selected <?php } ?>>Pieces</option>
              <option value="Box" <?php if($query2['quantity_type']=='Box') {?> selected<?php } ?>>Box</option>
              <option value="Bottle" <?php if($query2['quantity_type']=='Bottle') {?> selected <?php } ?>>Bottle</option>
          </select>

		
		</td>
      </tr>

      <tr>
      <td colspan="8" align="center"><h3>Price</h3></td>
      </tr>
     <tr>
     <td width="30%" align="left" colspan="4">Manufacture price </td>
     <td width="40%" align="left" colspan="4">
     $<input type="text" style="width:10%;" value="<?=$query2['manufacture_price']?>" name="manufacture_price" id="manufacture_price" >
     </td>
      </tr>

     <tr>
     <td width="30%" align="left" colspan="4">Wholesale price (*List Price) </td>
     <td width="40%" align="left" colspan="4">
     $<input type="text" style="width:10%;" value="<?=$query2['wholesale_price']?>" name="wholesale_price" id="wholesale_price"></td>
     </tr>

     <tr>
     <td width="30%" align="left" colspan="4">Msrp price</td>
     <td width="40%" align="left" colspan="4">
     $<input type="text" style="width:10%;" value="<?=$query2['msrp_price']?>" id="msrp_price" name="msrp_price"></td>
     </tr>

<tr>
     <td width="30%" align="left" colspan="4">
     <input type="checkbox" id="checkbox_discount_option" name="checkbox_discount_option" value="1" onClick="check_it('discount_option')"
      <?php if($query2['discount_option_check']== 1){?>   checked <?php }  ?>> Discount option </td>
     <td width="40%" align="left">
     <select id="select_discount_option" name="select_discount_option">
              <option value="" >Select</option>
             <option  value="300_5" <?php if($query2['discount_option_value']=='300_5'){?> selected <?php } ?>>$300 more Order 5% OFF</option>
            <option value="500_8" <?php if($query2['discount_option_value']=='500_8'){?> selected <?php } ?>>$500 more Order 8% OFF</option>
            <option value="1000_10" <?php if($query2['discount_option_value']=='1000_10'){?> selected <?php } ?>>$1000 more Order 10% OFF</option>
</select>    </td>
      </tr>


<tr>
     <td width="30%" align="left" colspan="4">
     <input type="checkbox" 
onClick="check_it('special_promotion')" id="checkbox_special_promotion" name="checkbox_special_promotion" value="1" <?php if($query2['special_promotion_check']== 1){?>   checked <?php } ?>>Special promotion </td>
     <td width="40%" align="left">
     <input type="text" size="5" id="select_special_promotion" name="select_special_promotion"  value="<?=$query2['special_promotion_value']?>" >
% OFF of Wholesale price    </td>
      </tr>


      <tr>
      <td colspan="8" align="center"><h3> Shipping</h3></td>
      </tr>
<tr>
     <td width="30%" align="left" colspan="4">Delivery Time </td>
     <td width="40%" align="left" colspan="4">
    <select name="delivery_time" id="delivery_time">
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
     <td width="30%" align="left" colspan="4">Dropship</td>
     <td width="40%" align="left" colspan="4">
     <select name="dropship" id="dropship" >
     <option value="">Select</option>
     <option value="Yes" <?php if($query2['dropship']=='Yes'){?> selected <?php } ?>>Yes</option>
      <option value="No" <?php if($query2['dropship']=='No'){?> selected <?php } ?>>No</option></select></td>
      </tr>


<tr>
     <td width="30%" align="left" colspan="4">Shipping Method </td>
     <td width="40%" align="left" colspan="4">
     <select name="shipping_method" id="shipping_method">
  <option value="USPS" <?php if($query2['shipping_method']=='USPS'){?> selected <?php } ?> >USPS</option>
          <option  value="SINA SHIPPING" <?php if($query2['shipping_method']=='SINA SHIPPING'){?> selected <?php } ?>>SINA SHIPPING</option>
          <option value="UPS" <?php if($query2['shipping_method']=='UPS'){?> selected <?php } ?>>UPS</option>
          <option value="DHL" <?php if($query2['shipping_method']=='DHL'){?> selected <?php } ?>>DHL</option>
          <option value="Fedex" <?php if($query2['shipping_method']=='Fedex'){?> selected <?php } ?>>Fedex</option>
          <option value="FREE SHIPPING" <?php if($query2['shipping_method']=='FREE SHIPPING'){?> selected <?php } ?>>FREE SHIPPING</option>
</select>
  </td>
      </tr>


<tr>
     <td width="30%" align="left" colspan="4">Shipping Price/unit </td>
     <td width="40%" align="left" colspan="4">
    <input type="text" size="4" value="<?= $query2['shipping_price'] ?>" name="shipping_price" id="shipping_price" > or Calculate<br>
<input type="text" size="4" value="" >+</td>
      </tr>

<tr>
     <td width="30%" align="left" colspan="4">Place of Origin: </td>
     <td width="40%" align="left" colspan="4">
     <select name="place_origin" id="place_origin">
     <option value="China" <?php if($query2['place_origin']=='China'){?> selected <?php } ?>>China</option>
          <option value="India" <?php if($query2['place_origin']=='India'){?> selected <?php } ?>>India</option>
          <option value="Malaysia" <?php if($query2['place_origin']=='Malaysia'){?> selected <?php } ?>>Malaysia</option>
          <option value="Vietnam" <?php if($query2['place_origin']=='Vietnam'){?> selected <?php } ?>>Vietnam</option>
          <option value="USA" <?php if($query2['place_origin']=='USA'){?> selected <?php } ?>>USA</option>
          <option value="Canada" <?php if($query2['place_origin']=='Canada'){?> selected <?php } ?>>Canada</option>
</select></td>
      </tr>

<tr>
     <td width="30%" align="left" colspan="4">Package Weight /unit: </td>
     <td width="40%" align="left" colspan="4">
    <input type="text" size="4" name="package_weight" id="package_weight" value="<?=$query2['package_weight']?>" >
 <select name="package_unit" id="package_unit">
  <option value="">Select Option</option>
 <option value="Ib" <?php if($query2['package_unit']=='Ib'){?> selected <?php } ?>>Ib</option>
            <option value="g" <?php if($query2['package_unit']=='g'){?> selected <?php } ?>>g</option>
            <option value="Kg" <?php if($query2['package_unit']=='Kg'){?> selected <?php } ?>>Kg</option>
            <option value="Oz" <?php if($query2['package_unit']=='Oz'){?> selected <?php } ?>>Oz</option></select>
</td>
      </tr>
      
      <tr>
      <td width="30%" align="left" colspan="4">Add Options </td>
      <td width="40%" align="left" colspan="4">
      <img class="img-thumbnail" src="http://beautco.com/images/addoptionsetup.jpg" style="border:0px; padding:0;
       cursor:pointer;" onClick="slide_option()">
     </td> </tr>
     
     <tr class="option_setup_div">
      <td width="30%" align="left" colspan="4"><input type="checkbox" name="choose_option" id="file_option_checked" onClick="update_check_option(this)" >
       Upload Files <input style="display:inline-block" type="file" class="file-option-clss"> </td>
      <td width="20%" align="left" colspan="2"><a href="">sample download</a></td>
      <td width="20%" align="left" colspan="2"><a href="javascript:void(0)" onClick="show_option_setup()">Add Option setup</a></td>
      </tr>
     
     <tr class="option_setup_div">
     <td align="left"><input type="checkbox" name="choose_option" id="other_option_check" onClick="update_check_option(this)" checked></td>
     
     <td align="left">Sku or UPC</td>
     <td align="left">Length(Weight,Size)</td>
     <td align="left">Color</td>
     <td align="left">Price</td>
     <td align="left">Stock</td>
     <td align="left">Delete</td>
     </tr>
     <? for($i=0;$i<$length_option_count;$i++) { ?>
     <tr class="option_setup_div" id="all_option_div">
     <td align="left"></td>
     
     <td align="left"><input type="text" class="full input-cls" value="<?=$sku_option[$i]?>" id="sku_1" onBlur="pass_val('sku_1')" name="sku_option[]" placeholder="Sku"></td>
     <td align="left"><input type="text" class="full input-cls" style="width: 50px;" value="<?=$length_option[$i]?>" id="length_1" onBlur="pass_val('length_1')" name="length_option[]" placeholder="length">
     /<select id="length_unit" name="length_unit[]">
<option value="Inch" <? if($length_size_option[$i]=='Inch'){?> selected <? }?> >Inch</option>
<option value="Ib" <? if($length_size_option[$i]=='Ib'){?> selected <? }?>>Ib</option>
<option value="S" <? if($length_size_option[$i]=='S'){?> selected <? }?>>S</option>
<option value="M" <? if($length_size_option[$i]=='M'){?> selected <? }?>>M</option>
<option value="L" <? if($length_size_option[$i]=='L'){?> selected <? }?>>L</option>
<option value="XL" <? if($length_size_option[$i]=='XL'){?> selected <? }?>>XL</option>
</select></div>
     </td>
     <td align="left"><input type="text" class="full input-cls" value="<?=$color_option[$i]?>" id="color_1" onBlur="pass_val('color_1')" name="color_option[]" placeholder="Color"></td>
     <td align="left"><input type="text" class="full input-cls" id="price_1" value="<?=$price_option[$i]?>" onBlur="pass_val('price_1')" name="price_option[]" placeholder="Price"></td>
     <td align="left"><input type="text" class="full input-cls" id="stock_1" value="<?=$stock_option[$i]?>" onBlur="pass_val('stock_1')" name="stock_option[]" placeholder="Stock"></td>
     <td align="left"><img width="20" height="20"  src="http://beautco.com/images/delete_button.jpg" style="cursor:pointer;" onClick="hide_content()"></td>
     </tr>
     <?php } ?>
     <tr class="option_setup_div">
     <td align="center" colspan="8">
     <input type="text" value="+add" onClick="add_option_row()" style="border:0px; cursor:pointer;" >
     </td>
     </tr>
     
     <tr>
     <td colspan="8" align="center"><h3>Detailed Description</h3></td>
     </tr>

     <tr>
     <td colspan="8" a>
     <textarea class="ckeditor" cols="80" id="description" name="description" rows="5" onkeyup="" >
			<?=$query2['description']?>
			</textarea><br /> Only 1000 Charcter Valid 	</td>
     </tr>


<tr><td colspan="8" align="center">  <input  type="submit" value="Edit Product" name="submit"/></td></tr>

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


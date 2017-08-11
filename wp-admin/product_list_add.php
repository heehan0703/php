<?php

session_start();

require_once('include/connectdb.php');
require_once('../include/function.php');
if($_SESSION["ADMIN_ID"]==""){
	
header("location:login.php");	

	
	exit;
	 } 
	 
	$member_id = $_GET['member_id'];
	$email = $_GET['email'];

$category=mysql_query("SELECT * FROM `category` where category_name!='' order by category_name ASC ");	

if(isset($_POST['product_name'])){
	
	
	
	$supplier_code=$email;
	$category1=$_POST['category1'];
	$category2=$_POST['category2'];
	$category3=$_POST['category3'];
	$product_name=$_POST['product_name'];
	$product_code=$_POST['product_code'];
	$seo_tags=$_POST['seo_tags'];
		$hair_type= implode(",",$_POST['hair_type']);
	$hair_type_length= implode(",",$_POST['hair_type_length']);
	$hair_type_style=implode(",",$_POST['hair_type_style']);
	$quantity=$_POST['quantity'];
	$product_type=$_POST['product_type'];
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
	$description=$_POST['description'];
    $upload_multiple_file=upload_multiple_file('file','../product_img/');
	
 
 if(isset($_FILES['csv_file'])){
	 $mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
if(in_array($_FILES['csv_file']['type'],$mimes)){
	
	$file=$_FILES['csv_file'];
  			$name_fi=time().$file['name'];

		move_uploaded_file($file['tmp_name'],'../csv/'.$name_fi);


$row = 1;
if (($handle = fopen("../csv/".$name_fi, "r")) !== FALSE) {
	
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

 }
 
 
$insert="INSERT INTO `product` set `product_code`='$product_code',`user_id`='$member_id',`supplier_code`='$supplier_code', `category`='$category1', `subcategory`='$category2', `sub_subcategory`='$category3', 
`product_name`='$product_name', `hair_type_style`='$hair_type_style', `hair_type_length`='$hair_type_length',
`hair_type`='$hair_type', `quantity`='$quantity', `quantity_type`='$product_type', `manufacture_price`='$manufacture_price', `wholesale_price`='$wholesale_price', `msrp_price`='$msrp_price', `discount_option_check`='$checkbox_discount_option', `discount_option_value`='$select_discount_option', `special_promotion_check`='$checkbox_special_promotion',           `special_promotion_value`='$select_special_promotion', `delivery_time`='$delivery_time', `dropship`='$dropship', `shipping_method`='$shipping_method', `shipping_price`='$shipping_price', `place_origin`='$place_origin',
 `package_weight`='$package_weight', `package_unit`='$package_unit', `description`='$description' ,".
 $upload_multiple_file.",`sku`='$sku',`length`='$length',`color`='$color',`price`='$price',`stock`='$stock',seo_tags='$seo_tags'";
 
 

 //exit;
 
 mysql_query($insert);
 
 $product_latest_id=mysql_insert_id();
 
 //echo $insert;

 if(isset($_POST['other_option_set']) && $_POST['other_option_set']==1){
  	
	  
	  if($_POST['total_option_hidden']>0){
		   
		  $j=0;
		for($k=0;$k<=$_POST['total_option_hidden'];$k++){
			//print_r($_POST['option_hidden'.$j]);
			$option_name=$_POST['option_hidden'.$j];
			//print_r($_POST[$vim]);
			$count_option=count($_POST[$option_name]);
			for($x=0;$x<$count_option;$x++){
				$option_value=$_POST[$option_name][$x];
			//echo "<br><br>".$_POST[$vim][$x]."vimal<br><br>";
	mysql_query("INSERT INTO `product_other_option`( `product_id`, `product_code`, `user_id`, `option_name`, `option_value`) VALUES 
		('$product_latest_id','$product_code','$GOOD_SHOP_USERID','$option_name','$option_value')");
			}
		
			$j++;
		}  
	  }  
 } 
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>ADD Product</title>

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

                              <td align="left" class="white-18">Add Product</td>

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
                      <table width="100%" cellpadding="3" cellspacing="3">
                      
                     
     <tr>
     <td width="30%" align="left" colspan="4">Supplier Code</td>
     <td width="40%" align="left" colspan="4">
     <input type="text" value="<?=$email?>" name="supplier_code" id="supplier_code" class="form-group"  ></td>
    </tr>
       
      <tr>
     <td width="30%" align="left" colspan="4">Category</td>
     <td width="40%" align="left" colspan="4">
     <select id="category1" name="category1">
	 <option value="">Select Option</option> 
     <?php while($cat_row=mysql_fetch_assoc($category)){ ?> 
     <option value="<?=$cat_row['category_name']?>"><?=$cat_row['category_name']?></option>	 
	 <?php } ?>      
	</select>&nbsp; 
	
	        <script type="text/javascript">
			$("#category1").change(function(){	
		    		
	    	$("#category2").load("../get_subcategory.php?cat_name="+encodeURIComponent($("#category1").val())+"&level=1");
			});		

           </script>  
		  
		  <select id="category2" name="category2">
          <option value="">Select Category</option>    
		  
          </select>
          &nbsp;
          <script type="text/javascript">
			$("#category2").change(function(){	
				
		    		
	    	$("#category3").load("../get_subcategory.php?sub_name="+encodeURIComponent($("#category2").val())+"&level=2");
			
			
			
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
     <input type="text" value="" name="product_name" id="product_name" class="form-group" style="width:220px"></td>
      </tr>
     
     <tr>
     <td width="30%" align="left" colspan="4">Product Code </td>
     <td width="40%" align="left" colspan="4">
     <input type="text" name="product_code" id="product_code" class="form-group" value ="<?=$query2['product_code']?>" style="width:220px"></td>
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
      width="77" height="77" src="../images/no_img.jpg" title="Photo" alt="Photo"><br />
     <a href="javascript:{}"><img border="0" src="http://pics.ebaystatic.com/aw/pics/icon/iconInactMoveLt_16x16.gif" alt=""></a>
     <a onclick="ebay.run(this.id,'onclick');return false;" id="moverightLnk0" href="javascript:{}"><img border="0" id="moveright0" src="http://pics.ebaystatic.com/aw/pics/icon/iconInactMoveRt_16x16.gif" alt=""></a><a onclick="remove_img('file1')" id="removeimageLnk0" href="javascript:void(0)"><img border="0" id="removeimage0" src="http://pics.ebaystatic.com/aw/pics/icon/iconTrashcan_16x16.gif" title="Remove" alt="Remove"></a>
     </td></tr>

     <tr>
     <td width="30%" align="left" colspan="4">Gallery picture-2</td>
     <td width="40%" align="left" colspan="4">
     <img border="0" align="absmiddle" data="picData" id="div_file2"
      width="77" height="77" src="../images/no_img.jpg" title="Photo" alt="Photo"><br />
      <a href="javascript:{}"><img border="0" src="http://pics.ebaystatic.com/aw/pics/icon/iconInactMoveLt_16x16.gif" alt=""></a><a onclick="ebay.run(this.id,'onclick');return false;" id="moverightLnk0" href="javascript:{}"><img border="0" id="moveright0" src="http://pics.ebaystatic.com/aw/pics/icon/iconInactMoveRt_16x16.gif" alt=""></a><a onclick="remove_img('file2')" id="removeimageLnk0" href="javascript:void(0)"><img border="0" id="removeimage0" src="http://pics.ebaystatic.com/aw/pics/icon/iconTrashcan_16x16.gif" title="Remove" alt="Remove"></a>
     </td></tr>

      <tr>
     <td width="30%" align="left" colspan="4">Gallery picture-3</td>
     <td width="40%" align="left" colspan="4">
     <img border="0" align="absmiddle" data="picData" id="div_file3"
      width="77" height="77" src="../images/no_img.jpg" title="Photo" alt="Photo"><br />
      <a href="javascript:{}"><img border="0" src="http://pics.ebaystatic.com/aw/pics/icon/iconInactMoveLt_16x16.gif" alt=""></a><a onclick="ebay.run(this.id,'onclick');return false;" id="moverightLnk0" href="javascript:{}"><img border="0" id="moveright0" src="http://pics.ebaystatic.com/aw/pics/icon/iconInactMoveRt_16x16.gif" alt=""></a><a onclick="remove_img('file3')" id="removeimageLnk0" href="javascript:void(0)"><img border="0" id="removeimage0" src="http://pics.ebaystatic.com/aw/pics/icon/iconTrashcan_16x16.gif" title="Remove" alt="Remove"></a>
     </td></tr>

      <tr>
     <td width="30%" align="left" colspan="4">Gallery picture-4</td>
     <td width="40%" align="left" colspan="4">
    <img border="0" align="absmiddle" data="picData" id="div_file4" 
    width="77" height="77" src="../images/no_img.jpg" title="Photo" alt="Photo"><br />
    <a href="javascript:{}"><img border="0" src="http://pics.ebaystatic.com/aw/pics/icon/iconInactMoveLt_16x16.gif" alt=""></a><a onclick="ebay.run(this.id,'onclick');return false;" id="moverightLnk0" href="javascript:{}"><img border="0" id="moveright0" src="http://pics.ebaystatic.com/aw/pics/icon/iconInactMoveRt_16x16.gif" alt=""></a><a onclick="remove_img('file4')" id="removeimageLnk0" href="javascript:void(0)"><img border="0" id="removeimage0" src="http://pics.ebaystatic.com/aw/pics/icon/iconTrashcan_16x16.gif" title="Remove" alt="Remove"></a>
     </td></tr>

     
     
     

 <tr>
     <td width="20%" align="left" colspan="4">
     
    <input type="checkbox" id="checkbox_hair_type" name="hair_type"  onClick="check_it('hair_type')" value="1">Hair Type<br />
   
    <input name="hair_type[]" type="checkbox" value="human hair" /> human hair <br />
    <input name="hair_type[]" type="checkbox" value="synthetic hair" /> synthetic hair <br />
    <input name="hair_type[]" type="checkbox" value="remy hair" /> remy hair <br />
    <input name="hair_type[]" type="checkbox"  value="human hair blant"/> human hair blant <br />
           	   
     
      </td>
     <td width="20%" align="left" colspan="4">
     <input name="hair_type_length" type="checkbox"  style="background-color:#999; margin-left:16px">length <br />
     <input name="hair_type_length[]" type="checkbox" value="bob" /> bob <br />
    <input name="hair_type_length[]" type="checkbox" value="long"/>long <br />
    <input name="hair_type_length[]" type="checkbox" value="mediom" /> mediom <br />
   
    		</td>
             <td width="20%" align="left" colspan="4">
     <input name="hair_type_style[]" type="checkbox"  style="background-color:#999; margin-left:16px">style <br />
    <input name="hair_type_style[]" type="checkbox" value="bob cut" /> bob cut <br />
    <input name="hair_type_style[]" type="checkbox" value="layered cut" /> layered cut <br />
    <input name="hair_type_style[]" type="checkbox" value="loose body cut"/> loose body cut <br />
    <input name="hair_type_style[]" type="checkbox"  value="loose deep cut"/> loose deep cut <br />
     <input name="hair_type_style[]" type="checkbox" value="small wave" />small wave  <br />
    <input name="hair_type_style[]" type="checkbox" value="sprial curl" /> sprial curl<br />
    <input name="hair_type_style[]" type="checkbox" value="straight" /> straight <br />
  
    		</td>
    
      </tr>


 <tr>
     <td width="30%" align="left" colspan="4">Min. Order Quantity  </td>
     <td width="40%" align="left" colspan="4">
     <input type="text" value="1" id="quantity" name="quantity" class="form-group">
       <select name="product_type">
		    <option value="Pieces">Pieces</option>
              <option value="Box">Box</option>
              <option value="Bottle">Bottle</option>
          </select>
		
		</td>
      </tr>

      <tr>
      <td colspan="8" align="center"><h3>Price</h3></td>
      </tr>
     <tr>
     <td width="30%" align="left" colspan="4">Manufacture price </td>
     <td width="40%" align="left" colspan="4">
     $<input type="text" style="width:10%;" value="" name="manufacture_price" id="manufacture_price" >
     </td>
      </tr>

     <tr>
     <td width="30%" align="left" colspan="4">Wholesale price (*List Price) </td>
     <td width="40%" align="left" colspan="4">
     $<input type="text" style="width:10%;" value="" name="wholesale_price" id="wholesale_price"></td>
     </tr>

     <tr>
     <td width="30%" align="left" colspan="4">Msrp price</td>
     <td width="40%" align="left" colspan="4">
     $<input type="text" style="width:10%;" value="" id="msrp_price" name="msrp_price"></td>
     </tr>

<tr>
     <td width="30%" align="left" colspan="4">
     <input type="checkbox" id="checkbox_discount_option" name="checkbox_discount_option" value="1" onClick="check_it('discount_option')"> Discount option </td>
     <td width="40%" align="left" colspan="4">
     <select disabled id="select_discount_option" name="select_discount_option">
     <option selected="selected" value="300_5">$300 more Order 5% OFF</option>
            <option value="500_8">$500 more Order 8% OFF</option>
            <option value="1000_10">$1000 more Order 10% OFF</option>
      </select>
     </td>
      </tr>


<tr>
     <td width="30%" align="left" colspan="4">
     <input type="checkbox" 
onClick="check_it('special_promotion')" id="checkbox_special_promotion" name="checkbox_special_promotion" value="1" >Special promotion
      </td>
     <td width="40%" align="left" colspan="4">
     <input type="text" size="5" id="select_special_promotion" name="select_special_promotion" disabled >% OFF of Wholesale price
    </td>
      </tr>


      <tr>
      <td colspan="8" align="center"><h3> Shipping</h3></td>
      </tr>
<tr>
     <td width="30%" align="left" colspan="4">Delivery Time </td>
     <td width="40%" align="left" colspan="4">
     <select name="delivery_time" id="delivery_time">
 <option value="" style="color:#999">Select Unit Type</option>
          <option value="2nd Shipping">2nd Shipping</option>
          <option value="3-7 Business Days">3-7 Business Days</option>
          <option value="7-14 Business Days">7-14 Business Days</option>
          <option value="14-25 Business Days">14-25 Business Days</option>
          <option value="45 Business Days">45 Business Days</option>
          <option value="60 Business Days">60 Business Days</option>
          <option value="90 Business Days">90 Business Days</option>
</select></td>
      </tr>


<tr>
     <td width="30%" align="left" colspan="4">Dropship</td>
     <td width="40%" align="left" colspan="4">
     <select name="dropship" id="dropship" >
     <option value="">Select</option>
     <option value="Yes">Yes</option>
     <option value="No">No</option></select>
      </tr>


<tr>
     <td width="30%" align="left" colspan="4">Shipping Method </td>
     <td width="40%" align="left" colspan="4">
     <select name="shipping_method" id="shipping_method">
  <option value="">Select shipping</option>
          <option value="USPS">USPS</option>
          <option  value="SINA SHIPPING">SINA SHIPPING</option>
          <option value="UPS">UPS</option>
          <option value="DHL">DHL</option>
          <option value="Fedex">Fedex</option>
          <option value="FREE SHIPPING">FREE SHIPPING</option>
</select></td>
      </tr>


<tr>
     <td width="30%" align="left" colspan="4">Shipping Price/unit </td>
     <td width="40%" align="left" colspan="4">
    <input type="text" size="4" value="" name="shipping_price" id="shipping_price" > or Calculate<br>
<input type="text" size="4" value="" >+</td>
      </tr>

<tr>
     <td width="30%" align="left" colspan="4">Place of Origin: </td>
     <td width="40%" align="left" colspan="4">
     <select name="place_origin" id="place_origin">
    <option value="">Select Orgin</option>
          <option value="China">China</option>
          <option value="India">India</option>
          <option value="Malaysia">Malaysia</option>
          <option value="Vietnam">Vietnam</option>
          <option value="USA">USA</option>
          <option value="Canada">Canada</option>
</select>
</td>
      </tr>

<tr>
     <td width="30%" align="left" colspan="4">Package Weight /unit: </td>
     <td width="40%" align="left" colspan="4">
    <input type="text" size="4" name="package_weight" id="package_weight" >
 <select name="package_unit" id="package_unit">
 <option value="">Select Option</option>
 <option value="Ib">Ib</option>
            <option value="g">g</option>
            <option value="Kg">Kg</option>
            <option value="Oz">Oz</option></select>
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
       Upload Files <input style="display:inline-block" name="csv_file" type="file" class="file-option-clss"> </td>
      <td width="20%" align="left" colspan="2"><a href="sample_product_upload.csv">sample download</a></td>
      <td width="20%" align="left" colspan="2"><a href="javascript:void(0)" onClick="show_option_setup()">Add Option setup</a></td>
      </tr>
     
     <tr class="option_setup_div">
     <td align="left"><input type="checkbox" name="choose_option" id="other_option_check" onClick="update_check_option(this)" checked></td>
     <td align="left">Product Name</td>
     <td align="left">Sku or UPC</td>
     <td align="left">Length</td>
     <td align="left">Color</td>
     <td align="left">Price</td>
     <td align="left">Stock</td>
     <td align="left">Delete</td>
     </tr>
     
     <tr class="option_setup_div" id="all_option_div">
     <td align="left"></td>
     <td align="left"><input type="text" class="full input-cls" value="" id="name_1" onBlur="pass_val('name_1')" name="product_name_option[]" placeholder="Product Name"></td>
     <td align="left"><input type="text" class="full input-cls" value="" id="sku_1" onBlur="pass_val('sku_1')" name="sku_option[]" placeholder="Sku"></td>
     <td align="left"><input type="text" class="full input-cls" value='' id="length_1" onBlur="pass_val('length_1')" name="length_option[]" placeholder="length"></td>
     <td align="left"><input type="text" class="full input-cls" value="" id="color_1" onBlur="pass_val('color_1')" name="color_option[]" placeholder="Color"></td>
     <td align="left"><input type="text" class="full input-cls" id="price_1" value="" onBlur="pass_val('price_1')" name="price_option[]" placeholder="Price"></td>
     <td align="left"><input type="text" class="full input-cls" id="stock_1" value="" onBlur="pass_val('stock_1')" name="stock_option[]" placeholder="Stock"></td>
     <td align="left"><img width="20" height="20"  src="http://beautco.com/images/delete_button.jpg" style="cursor:pointer;" onClick="hide_content()"></td>
     </tr>
     
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
     <textarea class="ckeditor" cols="80" id="description" name="description" rows="10">
			
			</textarea>	</td>
     </tr>


<tr><td colspan="8" align="center">  <input  type="submit" value="Add Product" name="submit"/></td></tr>

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


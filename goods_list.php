<?php
session_start();
require_once('wp-admin/include/connectdb.php');
function full_path()
{
    $s = &$_SERVER;
    $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
    $sp = strtolower($s['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    $port = $s['SERVER_PORT'];
    $port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
    $host = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
    $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
    $uri = $protocol . '://' . $host . $s['REQUEST_URI'];
    $segments = explode('?', $uri, 2);
    $url = $segments[0];
    return $url;
}
$url=full_path();

if($url){
$_SESSION['continus']=$url;
//$_SESSION['continus']=$url;
}
//print_r($_SESSION);
include('pager_ajax.php');
if(isset($_GET['cat'])){
	$cattext = $_GET['cat'];
	//echo "$cattext";
	if($cattext=='CLIP-IN-ROLL' or $cattext=='clip-in-roll'){
	 $cattext="CLIP-IN ROLL";
	 }
	 if($cattext=='TOP-PIECES' or $cattext=='top-pieces')
	 {
	$cattext="TOP PIECES";
	 }
	 if($cattext=='HAIR-PIECES' or $cattext=='hair-pieces')
	 {
	$cattext="HAIR PIECES";
	 }
	$product_query_start ="SELECT * FROM `product` where category='$cattext'";
	
	$wig_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='$cattext'"),0);
	
   $catrow=mysql_fetch_array(mysql_query("SELECT * FROM `category` where category_name='$cattext'"));
  
   $pagetitle= $catrow['page_title'];

$wig_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$wig_id'");
}
$text_show = $cattext;

if(isset($_GET['sub'])){
	$subcat=$_GET['sub'];
	$subcat=str_replace("-", " ", $subcat);
	$product_query_start = "SELECT * FROM `product` where subcategory='$subcat'";
	$stmt = mysql_fetch_assoc(mysql_query("SELECT `category`.id,`category`.category_name  FROM `category`  left join  `subcategory` on `category`.id=`subcategory`.cat_id where `subcategory`.name='$subcat'"));
	$text_show = $stmt['category_name'];
$wig_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$stmt[id]'");
}
if(isset($_GET['sub']) && $_GET['cat_id']){
	
$cat_idd = $_GET['cat_id'];

$catt_namee=mysql_result(mysql_query("SELECT category_name FROM `category` where id='$cat_idd'"),0);

$subcat=$_GET['sub'];

$subcat=str_replace("-", " ", $subcat);

$product_query_start = "SELECT * FROM `product` where subcategory='$subcat' and category='$catt_namee'";

//$product_query = mysql_query("SELECT * FROM `product` where subcategory='$subcat' and category='$catt_namee'");

$text_show = $catt_namee;
$subcatrow=mysql_fetch_array(mysql_query("SELECT * FROM `subcategory` where cat_id='$cat_idd' and name='$subcat'"));
$pagetitle=$subcatrow['page_title'];

$msrp_price = $_POST['msrp_price'];
$wholesale_price = $_POST['wholesale_price'];

//echo $text_show;
$wig_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$cat_idd'");
}

if(isset($_POST['start_pr']) && $_POST['start_pr']!=''){
	$start_pr = $_POST['start_pr'];
	$last_pr = $_POST['last_pr'];
	
	 if($_SESSION['verify_status']==1){

$product_query_start .= " and wholesale_price BETWEEN $start_pr AND $last_pr ";	
		 
	 }
	else{
$product_query_start .= " and msrp_price BETWEEN $start_pr AND $last_pr ";
	}
	
}
if(isset($_POST['price_order']) && $_POST['price_order']!='' ){
	
	$price_order = $_POST['price_order'];
	$product_query_start .=" order by wholesale_price $price_order ";	
		
}

if(isset($_POST['id_order']) && $_POST['id_order'] ){

	$id_order = $_POST['id_order'];
	$product_query_start .=" order by id desc ";	
}

//echo $product_query_start;
//exit;
 $product_query1 =  mysql_query($product_query_start);
 
 $product_query =  mysql_query(dopaging($product_query_start,15));
 $product_query2 =  mysql_query(dopaging($product_query_start,15));
 

 
 $_SESSION["text_show"] =$text_show;
 $_SESSION["subcat"] =$subcat;
 //echo $text_show;
 if($subcat == '')
 {
	 //	echo "SELECT count(*) from product where hair_type_length like '%bob%' and category = '$text_show'";
$count_bob = mysql_result(mysql_query("SELECT count(*) from product where hair_type_length like '%bob%' and category = '$text_show'"),0);
$count_mediom = mysql_result(mysql_query("SELECT count(*) from product where hair_type_length like '%mediom%' and category = '$text_show'"),0);
$count_long = mysql_result(mysql_query("SELECT count(*) from product where hair_type_length like '%long%' and category = '$text_show'"),0);

$count_bob_cut = mysql_result(mysql_query("SELECT count(*) from product where hair_type_style like '%bob cut%' and category = '$text_show'"),0);
$count_layered_cut = mysql_result(mysql_query("SELECT count(*) from product where hair_type_style like '%layered cut%' and category = '$text_show'"),0);
$count_loose_body_wave = mysql_result(mysql_query("SELECT count(*) from product where hair_type_style like '%loose body cut%' and category = '$text_show'"),0);
$count_loose_deep_wave = mysql_result(mysql_query("SELECT count(*) from product where hair_type_style like '%loose deep cut%' and category = '$text_show'"),0);
$count_small_wave = mysql_result(mysql_query("SELECT count(*) from product where hair_type_style like '%small wave%' and category = '$text_show'"),0);
$count_sprial_curl = mysql_result(mysql_query("SELECT count(*) from product where hair_type_style like '%sprial curl%' and category = '$text_show'"),0);
$count_straight = mysql_result(mysql_query("SELECT count(*) from product where hair_type_style like '%straight%' and category = '$text_show'"),0);

 }
 else{
	// echo "SELECT count(*) from product where hair_type_length like '%bob%' and category = '$text_show' and subcategory = '$subcat'  ";
$count_bob = mysql_result(mysql_query("SELECT count(*) from product where hair_type_length like '%bob%' and category = '$text_show' and subcategory = '$subcat'  "),0);
$count_mediom = mysql_result(mysql_query("SELECT count(*) from product where hair_type_length like '%mediom%' and category = '$text_show' and subcategory = '$subcat' "),0);
$count_long = mysql_result(mysql_query("SELECT count(*) from product where hair_type_length like '%long%' and category = '$text_show' and subcategory = '$subcat'  "),0);

$count_bob_cut = mysql_result(mysql_query("SELECT count(*) from product where hair_type_style like '%bob cut%' and category = '$text_show' and subcategory = '$subcat'  "),0);
$count_layered_cut = mysql_result(mysql_query("SELECT count(*) from product where hair_type_style like '%layered cut%' and category = '$text_show' and subcategory = '$subcat'  "),0);
$count_loose_body_wave = mysql_result(mysql_query("SELECT count(*) from product where hair_type_style like '%loose body cut%' and category = '$text_show' and subcategory = '$subcat'  "),0);
$count_loose_deep_wave = mysql_result(mysql_query("SELECT count(*) from product where hair_type_style like '%loose deep cut%' and category = '$text_show' and subcategory = '$subcat'  "),0);
$count_small_wave = mysql_result(mysql_query("SELECT count(*) from product where hair_type_style like '%small wave%' and category = '$text_show' and subcategory = '$subcat'  "),0);
$count_sprial_curl = mysql_result(mysql_query("SELECT count(*) from product where hair_type_style like '%sprial curl%' and category = '$text_show' and subcategory = '$subcat'  "),0);
$count_straight = mysql_result(mysql_query("SELECT count(*) from product where hair_type_style like '%straight%' and category = '$text_show' and subcategory = '$subcat'  "),0);
 }
$j=0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EBHA product list</title>
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
		
		<!-- Google Font -->
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,500.00,700,300' rel='stylesheet' type='text/css'>
		
		<!-- all css here -->
		<!-- bootstrap v3.3.6 css -->
        <link rel="stylesheet" href="/shopick/css/bootstrap.min.css">
		<!-- animate css -->
        <link rel="stylesheet" href="/shopick/css/animate.css">
		<!-- jquery-ui.min css -->
        <link rel="stylesheet" href="/shopick/css/jquery-ui.min.css">
		<!-- meanmenu css -->
        <link rel="stylesheet" href="/shopick/css/meanmenu.min.css">
		<!-- nivo-slider css -->
        <link rel="stylesheet" href="/shopick/lib/css/nivo-slider.css">
		<!-- owl.carousel css -->
        <link rel="stylesheet" href="/shopick/css/owl.carousel.css">
		<!-- flaticon css -->
        <link rel="stylesheet" href="/shopick/css/shopick-icon.css">
		<!-- pe-icon-7-stroke css -->
        <link rel="stylesheet" href="/shopick/css/pe-icon-7-stroke.css">
		<!-- lightbox css -->
        <link rel="stylesheet" href="/shopick/css/lightbox.min.css">
		<!-- style css -->
		
        
         <link rel="stylesheet" href="/shopick/fstyle.css">
		<!-- responsive css -->
        <link rel="stylesheet" href="/shopick/css/responsive.css">
        <style type="text/css">
.main-menu ul li .submenu li:hover a, .subwigs span a:hover {
  padding-left: 20px;
}
.main-menu ul li .submenu .submenu-title a, .subwigs span .subwigs-title  {
  border-bottom: 1px solid #f6416c;
  color: #f6416c;
  display: block;
  font-size: 13px;
  font-weight: 500;
  padding-bottom: 0;
  text-transform: uppercase;
}
.main-menu ul li .submenu, .main-menu ul li .subwigs {
  opacity: 0;
  transform: scaleY(0);
  transform-origin: 0 0 0;
}
.main-menu ul li:hover .submenu, .main-menu ul li:hover .subwigs {
  opacity: 1;
  transform: scaleY(1);
  z-index: 999999;
}
.main-menu ul li .submenu li.submenu-title a:before,
.subwigs span .subwigs-title:before,
.subwigs-photo a::before {
  display: none;
}
.main-menu ul li .subwigs {
    background: #fff none repeat scroll 0 0;
    border-top: 2px solid #f6416c;
    box-shadow: 2px 6px 8px 6px rgba(0, 0, 0, 0.13);
    left: -100px;
    padding: 30px;
    position: absolute;
    width: 340px;
    z-index: 9;
}

.subwigs span {
    float: left;
    padding-right: 30px;
    width: 95%;
}
.subwigs span a {
  color: #000;
  display: block;
  font-size: 12px;
  line-height: 40px;
  position: relative;
}
.subwigs span a::before {
  color: #f6416c;
  content: "\e905";
  font-family: shopick;
  opacity: 0;
  position: absolute;
  transition: all 0.3s ease 0s;
  left: 0;
}
.subwigs span a:hover::before {
  opacity: 1;
}


/* for subweaves  */
.main-menu ul li .submenu li:hover a, .subweaves span a:hover {
  padding-left: 20px;
}
.main-menu ul li .submenu .submenu-title a, .subweaves span .subwigs-title  {
  border-bottom: 1px solid #f6416c;
  color:#003300;
  display: block;
  font-size: 13px;
  font-weight: 500;
  padding-bottom: 0;
  text-transform: uppercase;
}
.main-menu ul li .submenu, .main-menu ul li .subweaves {
  opacity: 0;
  transform: scaleY(0);
  transform-origin: 0 0 0;
}
.main-menu ul li:hover .submenu, .main-menu ul li:hover .subweaves {
  opacity: 1;
  transform: scaleY(1);
  z-index: 999999;
}
.main-menu ul li .submenu li.submenu-title a:before,
.subweaves span .subweaves-title:before,
.subweaves-photo a::before {
  display: none;
}
.main-menu ul li .subweaves {
    background: #fff none repeat scroll 0 0;
    border-top: 2px solid #f6416c;
    box-shadow: 2px 6px 8px 6px rgba(0, 0, 0, 0.13);
    left: -100px;
    padding: 30px;
    position: absolute;
    width: 340px;
    z-index: 9;
}

.subweaves span {
    float: left;
    padding-right: 30px;
    width: 95%;
}
.subweaves span a {
  color: #000;
  display: block;
  font-size: 12px;
  line-height: 40px;
  position: relative;
}
.subweaves span a::before {
  color: #f6416c;
  content: "\e905";
  font-family: shopick;
  opacity: 0;
  position: absolute;
  transition: all 0.3s ease 0s;
  left: 0;
}
.subweaves span a:hover::before {
  opacity: 1;
}
.smallscreen{
display:none;
}
.bigscreen{
display:block;
}
.widget-brand ul li{
display: inline-flex;

}
@media (min-width:600px) and (max-width:899px){
.showing{
margin-right: 25px;
}
.widget-brand ul li a{
font-size:12px;
}
}
@media (min-width:266px) and (max-width:600px){
.smallscreen{
display:block;
}
.bigscreen{
display:none;
}

}
</style>
<base href="/" />
<script src="/shopick/js/vendor/modernizr-2.8.3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script language="javascript">
function dhirendra(page)
{ 

//alert("dhirendra");
 
 var option=$("#sort_data :selected").text();
 var numberofproduct=$("#productnum option:selected").text();
  var paging="pagenum.php?<?=$_SERVER['QUERY_STRING']?>&page="+page;
	  if(option=='Defult Value')
  {
  var urlo="default.php?page="+page;
$.ajax({
        type: "POST",
        url: urlo,
        data: { param8: option, productnum:numberofproduct }
      }).done(function( msg ) {
	  //alert(msg);
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
	 $.ajax({
        type: "POST",
        url: paging,
        data: { param8: option, productnum:numberofproduct }
      }).done(function( msg ) {
		  
		   $("#pagenumber_bottom").html(msg);
		    $("#pagenumber").html(msg);
			
			 $(window).scrollTop();
			 jQuery("#focusdiv").attr("tabindex",-1).focus();
			 
			
			//document.getElementById('pagenumber').scrollIntoView();
		   
		   //$(".product_container").css("display","none");
		   
		  
     });
 }
 //alert(option);
  if (option=='Hightest Rating')
  {
var urlo="rating.php?page="+page;

$.ajax({
        type: "POST",
        url: urlo,
        data: { param8: option, productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
  $.ajax({
        type: "POST",
        url: paging,
        data: { param8: option,productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#pagenumber").html(msg);
		   $("#pagenumber_bottom").html(msg);
		   
		    $(window).scrollTop();
			 jQuery("#focusdiv").attr("tabindex",-1).focus();
		   
		   //$(".product_container").css("display","none");
		   
		  
     });
  
  
  }
  	  
	  
/////////////////////Low to High/////////////////////////
	// alert(option);  
	  if (option=='Price:Low to High')
  {
	 
	  
var urlo="low.php?page="+page;

$.ajax({
        type: "POST",
        url: urlo,
        data: { param: option, productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		  
		 
		  
     });
	 
	  $.ajax({
        type: "POST",
        url: paging,
        data: { param8: option, productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#pagenumber").html(msg);
		   $("#pagenumber_bottom").html(msg);
		   //$(".product_container").css("display","none");
		    $(window).scrollTop();
			 jQuery("#focusdiv").attr("tabindex",-1).focus();		  
     });
	 
	 
  }
  
  ///////////////////////////////High to Low///////////////////
	  
	  if (option=='Price:High to Low')
  {
 var urlo="high.php?page="+page;
$.ajax({
        type: "POST",
        url: urlo,
        data: { param1: option, productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
	 $.ajax({
        type: "POST",
        url: paging,
        data: { param8: option, productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#pagenumber").html(msg);
		   $("#pagenumber_bottom").html(msg);
		   //$(".product_container").css("display","none");
		    $(window).scrollTop();
			 jQuery("#focusdiv").attr("tabindex",-1).focus();
		   
		  
     });
	 
  }
	  
////////////////////////////////////A to Z/////////////////

if (option=='A to Z')
  {
 var urlo="a_to_z.php?page="+page;

$.ajax({
        type: "POST",
        url: urlo,
        data: { param2: option, productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
$.ajax({
        type: "POST",
        url: paging,
        data: { param8: option, productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#pagenumber").html(msg);
		   $("#pagenumber_bottom").html(msg);
		   //$(".product_container").css("display","none");
		    $(window).scrollTop();
			 jQuery("#focusdiv").attr("tabindex",-1).focus();
		  
     });
	 
	 
  }

//////////////////////////////////Z to A//////////////////////////////////////

if (option=='Z to A')
  {


 var urlo="z_to_a.php?page="+page;
$.ajax({
        type: "POST",
        url: urlo,
        data: { param3: option, productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
  $.ajax({
        type: "POST",
        url: paging,
        data: { param8: option, productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#pagenumber").html(msg);
		   $("#pagenumber_bottom").html(msg);
		   //$(".product_container").css("display","none");
		   
		    $(window).scrollTop();
			 jQuery("#focusdiv").attr("tabindex",-1).focus();
		   
		  
     });
  }
  
 
  
 ////////////////////////////////Best Selling////////////////////////////////// 

 
  if (option=='Best Sellers')
  {
var urlo="best_selling.php?page="+page;

$.ajax({
        type: "POST",
        url: urlo,
        data: { param6: option, productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
	  $.ajax({
        type: "POST",
        url: paging,
        data: { param8: option, productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#pagenumber").html(msg);
		   $("#pagenumber_bottom").html(msg);
		   //$(".product_container").css("display","none");
		   
		    $(window).scrollTop();
			 jQuery("#focusdiv").attr("tabindex",-1).focus();
		  
     });
	 
  }
////////////////////////////////////New Arrival//////////////////////////////////////////////////////

  
   if (option=='New Arrivals')
  {
var urlo="best_arrival.php?page="+page;
$.ajax({
        type: "POST",
        url: urlo,
        data: { param7: option, productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
	  $.ajax({
        type: "POST",
        url: paging,
        data: { param8: option, productnum:numberofproduct}
      }).done(function( msg ) {
		   $("#pagenumber").html(msg);
		   $("#pagenumber_bottom").html(msg);
		   //$(".product_container").css("display","none");
		   
		   $(window).scrollTop();
			 jQuery("#focusdiv").attr("tabindex",-1).focus();
     });
	 
  }
  

/////////////////////////////////////////////////////////////////////////

}

$(document).ready( function ()
{
  
 $('#sort_data').change(function()
 {
	 
	   var option=$("#sort_data :selected").text();
	
  
  if (option=='Hightest Rating')
  {

$.ajax({
        type: "POST",
        url: "rating.php",
        data: { param8: option }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
  }
  	  
     });	  
     });
	 
$(document).ready( function ()
{
  
 $('#sort_data').change(function()
 {
	 
	   var numberofproduct=$("#productnum option:selected").text();
	
	   var option=$("#sort_data :selected").text()
	//alert(option);
  
  if(option=='Price:Low to High')
  {
	 // alert("dhirendra");

$.ajax({
        type: "POST",
        url: "low.php",
        data: { param: option,productnum:numberofproduct}
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		  
		 
		  
     });
	 
  }
  	  
     });	  
     });
	
	
	
	 $(document).ready( function ()
{
  
 $('#sort_data').change(function()
 {
	  var numberofproduct=$("#productnum option:selected").text();
	   var option=$("#sort_data :selected").text()
	
  
  if (option=='Price:High to Low')
  {

$.ajax({
        type: "POST",
        url: "high.php",
        data: { param1: option,productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
  }
  	  
     });	  
     });
	 
	  $(document).ready( function ()
{
  
 $('#sort_data').change(function()
 {
	  var numberofproduct=$("#productnum option:selected").text();
	   var option=$("#sort_data :selected").text()
	
  
  if (option=='A to Z')
  {
//alert(option);
$.ajax({
        type: "POST",
        url: "a_to_z.php",
        data: { param2: option,productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
  }
  	  
     });	  
     });
	 
	 
	   $(document).ready( function ()
{
  
 $('#sort_data').change(function()
 {
	  var numberofproduct=$("#productnum option:selected").text();
	   var option=$("#sort_data :selected").text()
	
  
  if (option=='Z to A')
  {
//alert(option);
$.ajax({
        type: "POST",
        url: "z_to_a.php",
        data: { param3: option,productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
  }
  	  
     });	  
     });
	 
	 $(document).ready( function ()
{
  
 $('#sort_data').change(function()
 {
	  var numberofproduct=$("#productnum option:selected").text();
	   var option=$("#sort_data :selected").text()
	
  
  if (option=='Best Sellers')
  {
//alert("dhirendra");

$.ajax({
        type: "POST",
        url: "best_selling.php",
        data: { param6: option,productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
  }
  	  
     });	  
     });
	 
	 	 $(document).ready( function ()
{
  
 $('#sort_data').change(function()
 {
	  var numberofproduct=$("#productnum option:selected").text();
	   var option=$("#sort_data :selected").text()
	
  
  if (option=='New Arrivals')
  {

$.ajax({
        type: "POST",
        url: "best_arrival.php",
        data: { param7: option,productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
  }
  	  
     });	  
     });
	 	 	 
/////////////////////////////////////for bottom sorting /////////////////////////////////////

$(document).ready( function ()
{
  
 $('#sort_data_bottom').change(function()
 {
	 
	   var option=$("#sort_data_bottom :selected").text()
	
  
  if (option=='Hightest Rating')
  {

$.ajax({
        type: "POST",
        url: "rating.php",
        data: { param8: option }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
  }
  	  
     });	  
     });

$(document).ready( function ()
{
  
 $('#sort_data_bottom').change(function()
 {
	 
	   var numberofproduct=$("#productnum option:selected").text();
	
	   var option=$("#sort_data_bottom :selected").text()
	//alert(option);
  
  if(option=='Price:Low to High')
  {
	 // alert("dhirendra");

$.ajax({
        type: "POST",
        url: "low.php",
        data: { param: option,productnum:numberofproduct}
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		  
		 
		  
     });
	 
  }
  	  
     });	  
     });
	
	
	
	 $(document).ready( function ()
{
  
 $('#sort_data_bottom').change(function()
 {
	  var numberofproduct=$("#productnum option:selected").text();
	   var option=$("#sort_data_bottom :selected").text()
	
  
  if (option=='Price:High to Low')
  {

$.ajax({
        type: "POST",
        url: "high.php",
        data: { param1: option,productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
  }
  	  
     });	  
     });
	 
	  $(document).ready( function ()
{
  
 $('#sort_data_bottom').change(function()
 {
	  var numberofproduct=$("#productnum option:selected").text();
	   var option=$("#sort_data_bottom :selected").text()
	
  
  if (option=='A to Z')
  {
//alert(option);
$.ajax({
        type: "POST",
        url: "a_to_z.php",
        data: { param2: option,productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
  }
  	  
     });	  
     });
	 
	 
	   $(document).ready( function ()
{
  
 $('#sort_data_bottom').change(function()
 {
	  var numberofproduct=$("#productnum option:selected").text();
	   var option=$("#sort_data_bottom :selected").text()
	
  
  if (option=='Z to A')
  {
//alert(option);
$.ajax({
        type: "POST",
        url: "z_to_a.php",
        data: { param3: option,productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
  }
  	  
     });	  
     });
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 $(document).ready( function ()
{
  
 $('#sort_data_bottom').change(function()
 {
	  var numberofproduct=$("#productnum option:selected").text();
	   var option=$("#sort_data_bottom :selected").text()
	
  
  if (option=='Best Sellers')
  {
//alert("dhirendra");

$.ajax({
        type: "POST",
        url: "best_selling.php",
        data: { param6: option,productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
  }
  	  
     });	  
     });
	 
	 	 $(document).ready( function ()
{
  
 $('#sort_data_bottom').change(function()
 {
	  var numberofproduct=$("#productnum option:selected").text();
	   var option=$("#sort_data_bottom :selected").text()
	
  
  if (option=='New Arrivals')
  {

$.ajax({
        type: "POST",
        url: "best_arrival.php",
        data: { param7: option,productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
  }
  	  
     });	  
     });
	 
	 
	 
///////////////////////////////////	 end of bottom sorting //////////////////////////	 
</script>	

<script type="text/javascript">

$(document).ready(function(){
    $("#large_list").click(function(){
        $(".large_product").addClass("full");
    });
	 $("#small_list").click(function(){
	$(".large_product").removeClass("full");
		$(".large_product").removeClass("text-center");
		$(".product_container").removeClass("product_container_margin");
		});
});


		$(".large_product").addClass("text-center");
		$(".product_container").addClass("product_container_margin");
/*$(document).ready(function(){
$(".hair_type").on('click', function () {
    var checkbox_value = "";
    $(":checkbox").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            checkbox_value += $(this).val() + ",";
        }
    });
    alert(checkbox_value);
	 $.ajax({
        type: "POST",
        url: "some.php",
        data: { param: sel }
      }).done(function( msg ) {
             alert(msg);
     });
});
});*/
	
	$(document).ready(function(){
$('.hair_type').click(function() {
    var sel,msg = [];
	sel =$('input[type=checkbox]:checked').map(function(_, el) {
        return $(el).val();
    }).get();
        
		
		
		
		
	 $.ajax({
        type: "POST",
        url: "some.php",
        data: { param: sel }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
})
});


$(document).ready(function(){
$('.hair_type_style').click(function() {
    var sel,msg = [];
	sel =$('input[type=checkbox]:checked').map(function(_, el) {
        return $(el).val();
    }).get();
        
		
		//alert(sel);
		
		
	 $.ajax({
        type: "POST",
        url: "some_process.php",
        data: { param1: sel }
      }).done(function(msg) {
		   $("#select_product_list_1").html(msg);
		  // alert(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
})
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



function validate(){
	var start_pr = $("#start_pr").val();
	var end_pr = $("#last_pr").val();
	if(start_pr==''){
	alert('Please enter starting price !');
	$("#start_pr").focus();
	return false	
	}
	if(end_pr==''){
	alert('Please enter last price !');
	$("#last_pr").focus();
	return false	
	}
	
}

function sent_price_form(act){
	$("#price_order").val(act);
	$("#price_order_form").submit();
	
	
}
function id_order_form(){
	$("#id_order_form").submit();
}

function show(){
 $("#overlay-mask-8").fadeIn('slow');	
 
}
function check()
{
	//alert("dhirendra");
	var login = document.getElementById("email_login").value;
	var pass = document.getElementById("pwd_login").value;
	
	if(login=="")
	{
     // alert("please enter the username");
	  document.getElementById("uerror").innerHTML="Please enter the username";
	 
		}else if(pass==""){
		//alert("please enter the password");
		 document.getElementById("perror").innerHTML="Please enter the password";
		}else{
		
					   $.ajax({
						  url: 'ajax_login.php',
					 data: {
					  email: login,
					  pass: pass
					   },
					 error: function() {
						 $('#info').html('<p>An error has occurred</p>');
						   },
					 success: function(data) {
					  //alert(data);
					   if(data=='sucess'){
					    document.location.href="index.php"
						}else{
						 document.getElementById("berror").innerHTML="Username and Password do not match ";
						}
					
					},
					type: 'POST'
				   });
		
		
		
		}
		
		
		
	//alert("login"+login);
	return false;
	
}

function test(event)
{
  if(event.keyCode==13){
   check();
   }
}
    </script>
    
     <script src="js_page/index.js"></script>  
     
     
  <script language="javascript">
 
 function searchstore(){
var x = document.forms["searchform"]["address"].value;
if (x == null || x == "") {
        alert("Address must be filled out");
        return false;
    }else{
    document.forms["searchform"].submit();
	}
}
	

 $(document).ready( function ()
{
  
 $('#productnum').change(function()
 {
	  var numberofproduct=$("#productnum option:selected").text();
	  var option=$("#sort_data :selected").text();
	  var paging="pagenum.php?<?=$_SERVER['QUERY_STRING']?>";
	  
$.ajax({
        type: "POST",
        url: "productnumber.php",
        data: { param6: option,productnum:numberofproduct,sorted:option }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");		  
            });	   
     
	 
	 $.ajax({
        type: "POST",
        url: paging,
        data: { param8: option, productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#pagenumber").html(msg);
		   $("#pagenumber_bottom").html(msg);
		   //$(".product_container").css("display","none");
  
     });
	 
	 	  
     });	
	 
	  
	  
	  });	
	  
	  
	   $(document).ready( function ()
{
  
 $('#productnum_bottom').change(function()
 {
	  var numberofproduct=$("#productnum_bottom option:selected").text();
	  var option=$("#sort_data :selected").text();
	  var paging="pagenum.php?<?=$_SERVER['QUERY_STRING']?>";
	  
$.ajax({
        type: "POST",
        url: "productnumber.php",
        data: { param6: option,productnum:numberofproduct,sorted:option }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");		  
            });	   
     
	 
	 $.ajax({
        type: "POST",
        url: paging,
        data: { param8: option, productnum:numberofproduct }
      }).done(function( msg ) {
		   $("#pagenumber").html(msg);
		   $("#pagenumber_bottom").html(msg);
		   //$(".product_container").css("display","none");
  
     });
	 
	 	  
     });	
	 
	  
	  
	  });	
	

 </script>

    
		
			
</head>

    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		
		<!-- HEADER-AREA START -->
      <?php include'header-new.php'?>

			
		<!-- HEADER-AREA END -->
<div class="container">
								<h3>Shop</h3>
								<ul>
									<li><a href="./index.php">home</a>&nbsp;/&nbsp;<?=$text_show;?></li>
									<li></li>
								</ul>
							</div>
						</div>
		<!-- PAGE-CONTENT START -->
		<section class="page-content">
			<!-- PAGE-BANNER START -->
			<!--<div class="page-banner-area margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="page-banner-menu">
								<h2 class="page-banner-title">Shop</h2>
								<ul>
									<li><a href="index.php">home</a></li>
									<li><?=$text_show;?></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>-->
			<!-- PAGE-BANNER END -->
			<!-- SHOP-AREA START -->
			<div class="shop-area margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<span class="shop-border"></span>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<!-- widget-categories start -->
							<aside class="widget widget-categories">
								<h5>categories</h5>
								<ul>
									 <?php while($wig_row=mysql_fetch_assoc($wig_query)){ 
		    $producturl11=preg_replace('/[^A-Za-z0-9\-]/', '-', $wig_row['name']);
 
            $producturl11=str_replace('--', '-', $producturl11);
            $producturl11=strtolower(rtrim($producturl11, "-"));
		$side_URL="/".str_replace(' ', '-',strtolower($text_show))."/".$producturl11."/";
		
		?>  
                                    <li><a href="<?=$side_URL?>" title="<?=$wig_row['name']?>"><?=$wig_row['name']?></a></li>
                                    
                                    
                                    <? } ?>
                                    
                                    
                                   
								</ul>
							</aside>
							<!-- widget-categories end -->
							<!-- shop-filter start -->
					 <!--		<aside class="widget shop-filter">
								<h3 class="sidebar-title">&nbsp;</h3>
							</aside>
                            
                            -->
                            
							<!-- shop-filter end -->
							<!-- widget-color start -->
						 <!--	<aside class="widget widget-color">
								<h5 class="sidebar-title">&nbsp;</h5>
						  </aside>
                          
                           -->
                          
<!-- widget-color end -->
							<!-- widget-brand start -->
							<aside class="widget widget-brand">
							  <h5 class="sidebar-title">Brand</h5>
								<ul>
									<li><input type="checkbox">
								  <a href="./search_result.php?search_text=JA">D&eacute;ja Human Hair </a></li>
									<li><input type="checkbox">
								  <a href="./search_result.php?search_text=shani">Shanic&eacute;e Unprocessed </a></li>
                                  <li><input type="checkbox">
                                  <a href="./wigs/"> Evotwin Human Hair Wigs</a></li>
									<li><input type="checkbox">
								  <a href="./braids/"> Ah-Fresh Briads</a></li>
								</ul>
							</aside>
							<!-- widget-brand end -->
							<!-- widget-top-brand start -->
						<!--	<aside class="widget top-rated hidden-sm">
								<h5 class="sidebar-title">&nbsp;</h5>
							</aside>
                            
                            -->
                            
							<!-- widget-top-brand end -->
						</div>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
							<!-- Shop-Content start -->
							<div class="shop-content">
								<!-- product-toolbar start -->
								<div class="product-toolbar">
									<!-- Shop-menu -->
									<div class="shop-menu view-mode">
										<a class="grid-view active" href="#grid-view" data-toggle="tab"><i class="sp-grid-view"></i></a>
										<a class="list-view" href="#list-view" data-toggle="tab"><i class="sp-list-view"></i></a>
									</div>
									<div class="short-by hidden-xs">
										<span>short by</span>
										<select class="shop-select" id="sort_data"   name="order_by">
											<option value="" >Defult Value</option>
               <option value="">Price:Low to High</option>
                <option value="">Price:High to Low</option>
                 <option value="">A to Z</option> 
                 <option value="">Z to A</option>
                  <option value="">Hightest Rating</option>
                   <option value="">Best Sellers</option>
                    <option value="">New Arrivals</option>
										</select>
									</div>
									<div class="short-by showing hidden-xs">
										<span>showing</span>
										<select class="shop-select" id="productnum">
											
											<option value="15">15</option>
											<option value="14">24</option>
											<option value="30">30</option>
											<option value="45">45</option>
										</select>
									</div>
									<!-- pagination -->
									<div class="shop-pagination">
                                    
                                    
										<ul>
                                         <span id="pagenumber"> <?php  echo rightpaging(); ?></span>
											
										</ul>
									</div>
								</div>
								<!-- product-toolbar end -->
								<!-- Shop-product start -->
								<div class="tab-content"  tabindex="-1"  id="focusdiv">
									<div role="tabpanel" class="tab-pane active" id="grid-view">
                                    
                                      <div class="row shop-grid" id="select_product_list_1"></div>
                                    
										<div class="row shop-grid product_container">
											<!-- Single-product start -->
                                             <?php $c=0;
	   while($product_row=mysql_fetch_assoc($product_query)){ 
	   $c++; 
	    if (strpos($product_row['images'],',') !== false) {
  $product_img=explode(',',$product_row['images']);
$product_img=$product_img[0];
}
else{
  $product_img=$product_row['images'];	
}

  
 $producturl1=preg_replace('/[^A-Za-z0-9\-]/', '-', $product_row['product_name']);
 
 $producturl1=str_replace('--', '-', $producturl1);
   $producturl1=strtolower(rtrim($producturl1, "-"));
	   
	   ?>
                                            
											<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="overflow:hidden;">
												<div class="single-product">
													<div class="product-photo" style="min-height:360px;">
														<a href="./<?=$producturl1?>-<?=$product_row['id']?>.html" title="<?=$product_row['product_name'];?>">
															<img class="primary-photo" src="/product_img/<?=$product_img?>" alt="<?=$product_row['product_name'];?>" />
															<img class="secondary-photo" src="/product_img/<?=$product_img?>" alt="<?=$product_row['product_name'];?>" />
														</a>
														<div class="pro-action">
															
															<a href="./<?=$producturl1?>-<?=$product_row['id']?>.html" class="action-btn" title="<?=$product_row['product_name'];?>"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
															
														</div>
													</div>
													<div class="product-brief" style="min-height:130px; padding-left:2px; padding-right:0px;" >
														<h2><a href="./<?=$producturl1?>-<?=$product_row['id']?>.html" title="<?=$product_row['product_name'];?>"><?=$product_row['product_name'];?></a></h2>
                                                        
                                                        
														  <?php if(($_SESSION['i_am']=='Wholesaler' and $_SESSION['verify_status']==1) or ($_SESSION['i_am']=='ISR' and $_SESSION['verify_status']==1)) {?> <h3 style="font-size:12px">Msrp<strike>$<?=number_format((float)$product_row['regular_price'], 2, '.', '')?></strike>&nbsp; <span style="font-size:14px; color:#F00;">wholesale&nbsp;$<?=number_format((float)$product_row['manufacture_price'], 2, '.', '')?></span> </h3> 
														  <? }else if(($_SESSION['i_am']=='Salon' and $_SESSION['verify_status']==1)){?> 
														  
                                                          <h3 style="font-size:11px">Regular Price:<strike>$<?=number_format((float)$product_row['regular_price'], 2, '.', '')?></strike>&nbsp; <span style="font-size:12px; color:#F00;">Salon Price:&nbsp;$<?=number_format((float)$product_row['msrp_price'], 2, '.', '')?></span> </h3>
                                                          
														  <? }else if(($_SESSION['i_am']=='Agent' and $_SESSION['verify_status']==1)){?> 
														  
                                                          <h3 style="font-size:11px">Regular Price:<strike>$<?=number_format((float)$product_row['regular_price'], 2, '.', '')?></strike>&nbsp; <span style="font-size:12px; color:#F00;">Agent Price:&nbsp;$<?=number_format((float)$product_row['agentprice1'], 2, '.', '')?></span> </h3>
                                                          
														  <? }else{ ?>
                                                          
                                                          
                                                        <h3 style="font-size:11px">Regular Price:<strike>$<?=number_format((float)$product_row['regular_price'], 2, '.', '')?></strike>&nbsp; <span style="font-size:14px; color:#F00;">MSRP&nbsp;$<?=number_format((float)$product_row['wholesale_price'], 2, '.', '')?></span> </h3>
                                                             <? }?> 
													</div>
												</div>
											</div>		
											<!-- Single-product end -->
    <? } ?>                                         
											
										
											
											
											
											
											
											
										</div>
									</div>
									<div role="tabpanel" class="tab-pane" id="list-view"> 
										<div class="row shop-list">
											<?php $c=0;
	   while($product_row=mysql_fetch_assoc($product_query2)){ 
	   $c++; 
	    if (strpos($product_row['images'],',') !== false) {
  $product_img=explode(',',$product_row['images']);
$product_img=$product_img[0];
}
else{
  $product_img=$product_row['images'];	
}
$product_img=str_replace(' ', '', $product_img);
  
 $producturl1=preg_replace('/[^A-Za-z0-9\-]/', '-', $product_row['product_name']);
 
 $producturl1=str_replace('--', '-', $producturl1);
   $producturl1=strtolower(rtrim($producturl1, "-"));
	   
	   ?>
                                    
                                            
                                            <!-- Single-product start -->
											<div class="col-md-12">
												<div class="single-product">
													<div class="product-photo">
														<a href="./<?=$producturl1?>-<?=$product_row['id']?>.html" title="<?=$product_row['product_name'];?>">
															<img class="primary-photo" src="./product_img/<?=$product_img?>" alt="<?=$product_row['product_name'];?>" />
															<img class="secondary-photo" src="./product_img/<?=$product_img?>" alt="<?=$product_row['product_name'];?>" />
														</a>
														<div class="pro-action">
															
															<a href="#" class="action-btn"><i class="sp-shopping-cart" title="<?=$product_row['product_name'];?>"></i><span>Add to cart</span></a>
															
														</div>
													</div>
													<div class="product-brief" >
														<h2><a href="./<?=$producturl1?>-<?=$product_row['id']?>.html" title="<?=$product_row['product_name'];?>"><?=$product_row['product_name'];?></a></h2>
														<h3>&nbsp;</h3>
														<div class="pro-quick-view">
														  <div class="quick-view">
															  <a href="#" data-toggle="modal"  data-target="#productModal" title="Quick View">Quick View</a>
															</div>
															<div class="pro-rating">
																<a href="#"><i class="sp-star rating-1"></i></a>
																<a href="#"><i class="sp-star rating-1"></i></a>
																<a href="#"><i class="sp-star rating-1"></i></a>
																<a href="#"><i class="sp-star rating-1"></i></a>
																<a href="#"><i class="sp-star rating-2"></i></a>
															</div>
														</div>
													</div>
												</div>	
											</div>
											<!-- Single-product end -->
                                        <? } ?>    
                                            
											
											
											
										</div>
									</div>
								</div>
								<!-- Shop-product end -->
								<!-- product-toolbar start -->
								<div class="product-toolbar btm-border">
									<!-- Shop-menu -->
									<div class="shop-menu view-mode">
										<a class="grid-view active" href="#grid-view" data-toggle="tab"><i class="sp-grid-view"></i></a>
										<a class="list-view" href="#list-view" data-toggle="tab"><i class="sp-list-view"></i></a>
									</div>
									<div class="short-by hidden-xs">
										<span>short by</span>
										<select class="shop-select" id="sort_data_bottom"   name="order_by">
											<option value="" >Defult Value</option>
               <option value="">Price:Low to High</option>
                <option value="">Price:High to Low</option>
                 <option value="">A to Z</option> 
                 <option value="">Z to A</option>
                  <option value="">Hightest Rating</option>
                   <option value="">Best Sellers</option>
                    <option value="">New Arrivals</option>
										</select>
									</div>
									<div class="short-by showing hidden-xs">
										<span>showing</span>
										<select class="shop-select" id="productnum_bottom">
											
											<option value="15">15</option>
											<option value="14">24</option>
											<option value="30">30</option>
											<option value="45">45</option>
										</select>
									</div>
									<!-- Pagination -->
									<div class="shop-pagination">
										<ul>
											<span id="pagenumber_bottom"> <?php  echo rightpaging(); ?></span>
										</ul>
									</div>
								</div>
								<!-- product-toolbar end -->
							</div>
							<!-- Shop-Content end -->
						</div>
					</div>
				</div>
			</div>
			<!-- SHOP-AREA END -->
			<!-- BANNER-AREA START -->
			<div class="banner-area fix margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="best-product-banner"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- BANNER-AREA END -->
			<!-- BANNER-AREA START -->
			<div class="banner-area fix margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="banner-photo"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- BANNER-AREA END -->
			<!-- SERVICE-AREA START -->
			<!--<div class="service-area margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="single-service">
								<div class="service-icon">
									<i class="sp-transport"></i>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="single-service">
								<div class="service-icon">
									<i class="sp-head-phone"></i>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="single-service">
								<div class="service-icon">
									<i class="sp-business"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>-->
			<!-- SERVICE-AREA END -->
		</section>
		<!-- PAGE-CONTENT END -->
		
		<!-- FOOTER-AREA START -->
		 <div class="col-lg-12" style="margin:0px; padding:0px" >
<?php include'foot-new.php'?>
</div>
<!--login popup start-->

<div id="overlay-mask-1" class="overlay-mask" style="" onKeyPress="test(event)">
  

  <div class="overlay iframe-content"><a class="close close-icon" onClick="close_popup('overlay-mask-1')">
  <span id="close_button" style="position: absolute; text-align: center; width: 100%;">X</span></a>
    <div class="content"> 
    <div class="row">
  
   
    
      <div class="col-lg-12 col-xs-12 col-xs-12">
       <form name="login_form" action="" method="post" id="loginform'" onSubmit="return_validate()" autocomplete="on">
        
    <div class="full" style="background:#FBFBFB; border:1px solid #E5E5E5; padding:5%;">
     <div class="full"><img class="img-responsive" src="images/logo1.png" alt="ebhahair logo"></div>
  
   
     <h3 class="h3">Member Login</h3><hr>
     <div class="full" style="color:#999999; margin-top:1em;">
     <div id="berror" style="color:#FF0000" ></div>
  
   <div id="uerror" style="color:#FF0000" ></div>
   <div class="form-group"><input type="email" placeholder="email" id="email_login" name="email_login" class="form-control"></div>
   
   
   <div id="perror" style="color:#FF0000" ></div>
   <div class="form-group"><input type="password" placeholder="password" name="pwd_login" id="pwd_login" class="form-control"></div>
   
   
   <div class="" style="margin-top:2em;">
   <button type="button"  class="blue-btn glyphicon glyphicon-lock" onClick="check()" style="background:#268BB9; color:#FFF; width: 85%;">
  <span class="" style="font-family:sans-serif;" >SIGN IN</span>
  </button>
  <br>
   <span style="text-decoration:underline;"> <a href ="forget_password.html">Forgot Your Password ?</a></span><br>
   
  
   <br>
    <button type="button" class="blue-btn glyphicon glyphicon-lock" style="background:#268BB9; color:#FFF; width: 85%;" onClick="close_popup('overlay-mask-1')">
  <span class="" style="font-family:sans-serif;">Cancel</span>
  </button>
   </div>
     </div>
     </div> 
     </form>  
      </div>
    </div>
   <div style="border:0px solid #97cf00; padding:1em;" class="content"> 
    <div style="width:98%; padding:0;;" class="row">
    <div class="col-lg-12 col-xs-12 col-xs-12 text-center">
      <strong> <a href="/register.html" target="_blank">NEW MEMBER REGISTER</a></strong>
      </div>
      </div>
      </div>
     
    </div>
    </div>
  
    
    </div>
<!-- login popup end -->

    </body>
</html>

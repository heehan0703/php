<?php
session_start();
require_once('wp-admin/include/connectdb.php');
include('pager_ajax.php');
if(isset($_GET['subsubcat'])){
	$cattext = $_GET['subsubcat'];
	$subcatID=$_GET['subcat'];
	$catid=$_GET['cat'];
	
	$product_query_start ="SELECT * FROM `product` where sub_subcategory='$cattext'";
	
$querycat=mysql_fetch_array(mysql_query("SELECT * FROM `category` where id='$catid'"));


$querySUB=mysql_fetch_array(mysql_query("SELECT * FROM `subcategory` where id='$subcatID'"));

if(isset($subcatID)){
    $product_query_start =$product_query_start."and subcategory='$querySUB[name]'";
	}
}

$text_show = $cattext;

//echo $text_show;
if(isset($_GET['sub'])){
	$subcat=$_GET['sub'];
	
	$product_query_start = "SELECT * FROM `product` where subcategory='$subcat'";
	
	$stmt = mysql_fetch_assoc(mysql_query("SELECT `category`.id,`category`.category_name  FROM `category`  left join  `subcategory` on `category`.id=`subcategory`.cat_id where `subcategory`.name='$subcat'"));
	
	$text_show = $stmt['category_name'];

$wig_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$stmt[id]'");
}

if(isset($_GET['sub']) && $_GET['cat_id']){
	
$cat_idd = $_GET['cat_id'];

$catt_namee=mysql_result(mysql_query("SELECT category_name FROM `category` where id='$cat_idd'"),0);

$subcat=$_GET['sub'];



$product_query_start = "SELECT * FROM `product` where subcategory='$subcat' and category='$catt_namee'";

//$product_query = mysql_query("SELECT * FROM `product` where subcategory='$subcat' and category='$catt_namee'");

$text_show = $catt_namee;

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
 $product_query =  mysql_query(dopaging($product_query_start,20));
 

 
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


/*$wig_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='$cattext'"),0);

$wig_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$wig_id'");
*/
/*$lace_wig_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='lace wig'"),0);

$lace_wig_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$lace_wig_id'");

$weaving_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='WEAVING'"),0);

$weaving_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$weaving_id'");

$remy_hair_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='remy hair'"),0);

$remy_hair_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$remy_hair_id'");

$hair_piece_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='hair piece'"),0);

$hair_piece_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$hair_piece_id'");

$hair_care_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='hair care'"),0);

$hair_care_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$hair_care_id'");

$beauty_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='beauty'"),0);

$beauty_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$beauty_id'");
 */
$j=0;
$robin=mysql_query("SELECT * FROM rating where goods_id=$id ORDER BY id DESC LIMIT 3;"); 
?>

<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>goods list</title>

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

function dhirendra(page)
{
	 var option=$("#sort_data :selected").text()
	// alert("dhirendra");
	 
	 ////////////////////default//////////////////
	 if (option=='Defult Value')
  {
var urlo="subsubdefault.php?page="+page+"&subsubcat=<?=$cattext?>";
var paging="subsubpagenum.php?page="+page+"&subsubcat=<?=$cattext?>";
$.ajax({
        type: "POST",
        url: urlo,
        data: { param8: option }
      }).done(function( msg ) {
		 // alert(msg);
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });	
	 
	 $.ajax({
        type: "POST",
        url: paging,
        data: { param8: option }
      }).done(function( msg ) {
		   $("#pagenumber").html(msg);
		   //$(".product_container").css("display","none");
		   
		  
     });
	   
  }
   
 // alert(urlo);
 //alert("dhirendra");
 ////// for best rating //////////////////////
 if (option=='Best Rating')
  {
var urlo="rating.php?page="+page;
var paging="pagenum.php?page="+page;
$.ajax({
        type: "POST",
        url: urlo,
        data: { param8: option }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
  $.ajax({
        type: "POST",
        url: paging,
        data: { param8: option }
      }).done(function( msg ) {
		   $("#pagenumber").html(msg);
		   //$(".product_container").css("display","none");
		   
		  
     });
  
  
  }
  	  
	  
/////////////////////Low to High/////////////////////////
	  
	  if (option=='Low to High')
  {
	  
var urlo="low.php?page="+page;
var paging="pagenum.php?page="+page;

$.ajax({
        type: "POST",
        url: urlo,
        data: { param: option }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		  
		 
		  
     });
	 
	  $.ajax({
        type: "POST",
        url: paging,
        data: { param8: option }
      }).done(function( msg ) {
		   $("#pagenumber").html(msg);
		   //$(".product_container").css("display","none");
		   
		  
     });
	 
	 
  }
  
  ///////////////////////////////High to Low///////////////////
	  
	  if (option=='High to Low')
  {
 var urlo="high.php?page="+page;
var paging="pagenum.php?page="+page;

$.ajax({
        type: "POST",
        url: urlo,
        data: { param1: option }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
	 $.ajax({
        type: "POST",
        url: paging,
        data: { param8: option }
      }).done(function( msg ) {
		   $("#pagenumber").html(msg);
		   //$(".product_container").css("display","none");
		   
		  
     });
	 
  }
	  
////////////////////////////////////A to Z/////////////////

if (option=='A to Z')
  {
 var urlo="a_to_z.php?page="+page;
var paging="pagenum.php?page="+page;

$.ajax({
        type: "POST",
        url: urlo,
        data: { param2: option }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
$.ajax({
        type: "POST",
        url: paging,
        data: { param8: option }
      }).done(function( msg ) {
		   $("#pagenumber").html(msg);
		   //$(".product_container").css("display","none");
		   
		  
     });
	 
	 
  }

//////////////////////////////////Z to A//////////////////////////////////////

if (option=='Z to A')
  {


 var urlo="z_to_a.php?page="+page;
var paging="pagenum.php?page="+page;

$.ajax({
        type: "POST",
        url: urlo,
        data: { param3: option }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
  $.ajax({
        type: "POST",
        url: paging,
        data: { param8: option }
      }).done(function( msg ) {
		   $("#pagenumber").html(msg);
		   //$(".product_container").css("display","none");
		   
		  
     });
  }
  
 
  
 ////////////////////////////////Best Selling////////////////////////////////// 
 
  if (option=='Best Selling')
  {
var urlo="best_selling.php?page="+page;
var paging="pagenum.php?page="+page;

$.ajax({
        type: "POST",
        url: urlo,
        data: { param6: option }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
	  $.ajax({
        type: "POST",
        url: paging,
        data: { param8: option }
      }).done(function( msg ) {
		   $("#pagenumber").html(msg);
		   //$(".product_container").css("display","none");
		   
		  
     });
	 
  }
////////////////////////////////////New Arrival//////////////////////////////////////////////////////

  
   if (option=='New Arrival')
  {
var urlo="best_arrival.php?page="+page;
var paging="pagenum.php?page="+page;
$.ajax({
        type: "POST",
        url: urlo,
        data: { param7: option }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
	  $.ajax({
        type: "POST",
        url: paging,
        data: { param8: option }
      }).done(function( msg ) {
		   $("#pagenumber").html(msg);
		   //$(".product_container").css("display","none");
		   
		  
     });
	 
  }
  

/////////////////////////////////////////////////////////////////////////
	  
 
  
  
   }



///////////////////////end of function dhirendra///////////////////////



$(document).ready( function ()
{
  
 $('#sort_data').change(function()
 {
	 
	   var option=$("#sort_data :selected").text()
	
  
  if (option=='Best Rating')
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
	 
	   var option=$("#sort_data :selected").text()
	
  
  if (option=='Low to High')
  {
	  

$.ajax({
        type: "POST",
        url: "low.php",
        data: { param: option }
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
	 
	   var option=$("#sort_data :selected").text()
	
  
  if (option=='High to Low')
  {

$.ajax({
        type: "POST",
        url: "high.php",
        data: { param1: option }
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
	 
	   var option=$("#sort_data :selected").text()
	
  
  if (option=='A to Z')
  {

$.ajax({
        type: "POST",
        url: "a_to_z.php",
        data: { param2: option }
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
	 
	   var option=$("#sort_data :selected").text()
	
  
  if (option=='Z to A')
  {

$.ajax({
        type: "POST",
        url: "z_to_a.php",
        data: { param3: option }
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
	 
	   var option=$("#sort_data :selected").text()
	
  
  if (option=='Best Selling')
  {

$.ajax({
        type: "POST",
        url: "best_selling.php",
        data: { param6: option }
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
	 
	   var option=$("#sort_data :selected").text()
	
  
  if (option=='New Arrival')
  {

$.ajax({
        type: "POST",
        url: "best_arrival.php",
        data: { param7: option }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
		   $(".product_container").css("display","none");
		   
		  
     });
	 
  }
  	  
     });	  
     });
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
        
		
		
		
		
	 $.ajax({
        type: "POST",
        url: "some_process.php",
        data: { param1: sel }
      }).done(function( msg ) {
		   $("#select_product_list_1").html(msg);
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

$(document).ready(function(e) {
	setTimeout(function() {
    $("#overlay-mask-1").fadeIn('slow');}, 5000);
	

});

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



    </script>
   
<style type="text/css">
@import url(//fonts.googleapis.com/css?family=Lato:400,700,900);
.blue-12:hover{
	text-decoration:underline !important;;
}
.product_container_margin
{
	margin:2px;
 
}
.overlay-mask {
	background: none repeat scroll 0 0 rgba(28, 45, 50, 0.8);
	/* [disabled]bottom: 0; */
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
	border-right:1px solid #eee;
	list-style: outside none none;
	position: absolute;
	width: 90%;
	display:none;
}
.vertical-menu > li {
	padding: 0.5em 0;
}
.vertical-submenu {
	background: none repeat scroll 0 0 #fff;
	color: #000;
	float: left;
	border-right: 1px solid #eee;
	list-style: outside none none;
	//position: absolute;
	width: 90%;
}
.vertical-submenu > li {
	padding: 0.5em 0;
}
#body_container {
	background-image: url("images/strip.png");
	background-repeat: repeat-x;
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
	border-right:2px solid #fff;
	width:101%;
	
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

.blue-12:hover{
	text-decoration:underline !important;;
}

.product_list{
	display: none;
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
    <div class="row" style="padding:1em;"> 
   <a style="color:inherit;" href="index.php"> Home</a> / 
   <a style="color:inherit;" href="goods_list.php?cat_id=<?=$querycat['id']?>&sub=<?=$subcat_row['name']?>"> <?=$querycat['category_name'];?> </a> /
   <a style="color:inherit;" href="goods_list.php?cat_id=<?=$querycat['id']?>&sub=<?=$querySUB['name']?>"> <?=$querySUB['name'];?> </a> /
   
   <a style="color:inherit;" href="subproduct.php?subsubcat=<?=$text_show?>&subcat=<?=$querySUB['id']?>&cat=<?=$querycat['id']?>"> <?=$text_show?></a> 
  <br>
     </div>
     </div>
     
    <div class="full" style=" background:#DEDEDE; height:1px;margin:.9em 0;"></div>
    
     <div class="container">
    <div class="row" style="padding:1em 0;">
   <!--list item start -->
 
   <!--category and their product start-->
   
    <div class="full">
    <!-- left bar start -->
      <div class="col-lg-2 small-hidden" style="padding-left:0px;">
      <div class="full">
        <div class="full category_title" style="background:#883866; color:#FFF;"><?=$text_show?></div>
        <ul class="vertical-submenu" style="padding-left:5%; width:100%; color:#828282; font-size:.9em;">
      
        
        </ul>
        </div>
 <div class="container" style="border:thin groove #CCC; margin-top:13px; width:180px">
   <div style="background-color:#999; margin-left:-16px; margin-right:-16px">  HAIR TYPE <br /></div>
    <input type="checkbox" class="hair_type" value="bob" /> short (<?=$count_bob?>) <br />
    <input type="checkbox" class="hair_type" value="long" /> long (<?=$count_long?>)<br />
    <input type="checkbox" class="hair_type" value="mediom" /> medium (<?=$count_mediom?>)<br />
   
   
  
</div>

 
 <div class="container" style="border:thin groove #CCC; margin-top:13px; width:180px">
   <div style="background-color:#999; margin-left:-16px; margin-right:-16px">  style <br /></div>
    <input type="checkbox" class="hair_type_style" value="bob cut" /> bob cut (<?=$count_bob_cut?>) <br />
    <input type="checkbox" class="hair_type_style" value="layered cut" /> layered cut(<?=$count_layered_cut?>)<br />
    <input type="checkbox" class="hair_type_style" value="loose body cut" /> loose body wave (<?=$count_loose_body_wave?>)<br />
   <input type="checkbox" class="hair_type_style" value="loose deep cut" /> loose deep wave (<?=$count_loose_deep_wave?>) <br />
    <input type="checkbox" class="hair_type_style" value="small wave" /> small wave (<?=$count_small_wave?>)<br />
    <input type="checkbox" class="hair_type_style" value="sprial curl" /> spiral curl (<?=$count_sprial_curl?>)<br />
    <input type="checkbox" class="hair_type_style" value="straight" /> straight (<?=$count_straight?>) <br />
     
   
  
</div>       

      </div>
      <!-- left bar end -->
      
      <!-- right side content start -->
       
      
      <div class="col-lg-10 small-padding-hidden" style="padding-top:45px;">
    <form action="" method="post" id="price_order_form">
    <input type="hidden" name="price_order" id="price_order" value="" >
    </form> 
      <form action="" method="post" id="id_order_form">
    <input type="hidden" name="id_order" id="id_order" value="desc" >
    </form>   
  <div class="full" style=" padding-bottom:30px;">
  <div class="row">
  
  <div class="col-lg-1 col-sm-1 col-xs-1"></div>
  </div>
  <div class="row" style="padding-top:.6em;">
 <div class="col-lg-6 col-sm-6 col-xs-12">sort by  <select id="sort_data"  onChange="filter_user()" name="order_by">
              <option value="" >Defult Value</option>
               <option value="">Low to High</option>
                <option value="">High to Low</option>
                 <option value="">A to Z</option> 
                 <option value="">Z to A</option>
                  <option value="">Best Rating</option>
                   <option value="">Best Selling</option>
                    <option value="">New Arrival</option>
             
            </select></div>
 <div class="col-lg-4 col-sm-6 col-xs-12 text-right">View as 
 <span class="glyphicon glyphicon-th-list" id="small_list" style="border:1px solid #DDDDDD; color:#0194E8; background:#fff; padding:3px; cursor:pointer;"></span> 
 <span class="glyphicon glyphicon-th-large" id="large_list" style="border:1px solid #DDDDDD; background:#fff; color:#0194E8; padding:3px; cursor:pointer;"></span></div> <span id="pagenumber"> <?php  echo rightpaging(); ?></span>
  </div> 
  </div>
      
      
      <div class="full" id="select_product_list_1"></div>
       <div class="full" >
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
	   
	   ?>
<a href="goods_detail.php?goods_Id=<?=$product_row['id']?>" style="color:inherit;">
        <div class="col-lg-3 col-md-3 large_product">
        <div class="product_container ">
        <div class="full" align="center"><img src="product_img/<?=$product_img?>" class="img-thumbnail" style="height:200px !important" ></div>
            <div class="full"><span><?=$product_row['product_name']?></span></div>
           <div class="full"><span> <?php echo $product_row['subcategory']?></span></div>
           <?php  
		  $idx =$product_row['id'];
		    $q=mysql_query("select * from rating where goods_id=$idx");
			//echo $q;
 while($qq=mysql_fetch_assoc( $q)){
	 
		 $output = $qq['vid'];
//echo $output;
$st = $qq['star'];
$out = $qq['star'];
//echo $out;
//echo $output;
$out2=5-$out;
?>
 <div class="full"><span>  <?php for($i=0; $i<$out; $i++) { ?>
            <img src="index.PNG" style="height:20px; width:20px;"> <?php  } ?> <?php for($i=0; $i<$out2; $i++) { ?>  <img src="index1.PNG" style="height:15px; width:15px;"> <?php  } ?></span></div><? } ?>
            <div class="full" style="overflow:hidden;">
            
            <?php if($_SESSION['i_am'] =='Wholesaler') {?>
               <div class="col-lg-4 col-sm-4 col-xs-4"><strike>$<?=$product_row['msrp_price']?> </strike></div>
               <div class="col-lg-4 col-sm-4 col-xs-4" style="color:#F00"><?=$product_row['wholesale_price']?></div>
               <div class="col-lg-4 col-sm-4 col-xs-4"><img src="images/cart.png" ></div></div>
               <div class="full" style="font-weight: 600;"></div></div>
               <? } else {?>
               <div class="col-lg-8 col-sm-8 col-xs-8"><strike>$<?php echo$product_row['regular_price']?></strike><span style="font-size:14px; color:#F00;">
              $<?php echo $product_row['msrp_price']?> </span></div>
              <div class="col-lg-4 col-sm-4 col-xs-4"><img src="images/cart.png" ></div></div>
               <div class="full" style="font-weight: 600;">
              </div></div>
               <? }?>
     </div>
        </a>
        <?php if($c==4){ ?></div><div class="full" style="margin:3em 0;">
        <?php $c=0;}?>
      
    <?php } ?>   

        
      </div> <?php  echo rightpaging(); ?>
      </div>
      <!-- right side content end   -->
   
    
 
          
    </div>
    <!--category and their product end-->
 
  
  <!-- list item end  -->
    
     
    </div>
    
    
    
   
  </div>
</div>

<!--body end--> 

<!-- footer start-->

<?php include'index_footer.php'?>

<!--footer end  -->

</div>

<!--right sidebar start-->


<!--right sidebar end



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>

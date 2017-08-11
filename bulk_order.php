<?php
session_start();

 $member_id=$_SESSION['member_id'];
 
 $GOOD_SHOP_USERID =$_SESSION['GOOD_SHOP_USERID'];

require_once('wp-admin/include/connectdb.php');
/*
 $category=mysql_query("SELECT * FROM `category` where category_name!='' order by category_name ASC ");
 
 if(isset($_POST['category1'])){
//print_r($_POST);
 $quantity=$_POST['quantity'];
 $supplier_id = $_POST['supplier_id'];
 $product_id = $_POST['product_id'];
 $price = $_POST['price'];
 $description = $_POST['description'];
 
 $color_option= $_POST['color'];
		$length_option= $_POST['length_option'];
	 
	 for($j=0;$j<count($quantity);$j++){
	
	if($quantity[$j]>0){
	
	$chek_qry = "select * from cart where userid='$GOOD_SHOP_USERID' and goodsId=$product_id[$j] and option1='Color-$color_option[$j]' and option2='Length-$length_option[$j]'  ";				

					if(mysql_num_rows(mysql_query($chek_qry)) > 0){		//if the same item exists in cart, only quantity increases
		$add_cart_qry = mysql_query("update cart set point=point/cnt*(cnt+$quantity[$j]),cnt=cnt+$quantity[$j],message='$description' where userid='$GOOD_SHOP_USERID' and goodsId=$product_id[$j] and option1='Color-$color_option[$j]' and option2='Length-$length_option[$j]' ");				
						
					}else{
					$add_cart_qry = mysql_query("insert into cart(userid,goodsId,supplier_id,cnt,option1,option2,price,point,writeday,price_old,message) values('$GOOD_SHOP_USERID','$product_id[$j]','$supplier_id[$j]','$quantity[$j]','Color-$color_option[$j]','Length-$length_option[$j]',
'$price[$j]','', now(),'','$description' )");
					
											
					}

	}
		 
	 }
	 
	 header("location:cart.php");
	 
 }
 */

if(isset($_FILES['file2'])) 
   {
	if (substr($_FILES['file2']['name'],-3,3) == "csv")
	{	
	 $file=$_FILES['file2'];
	 $name_fi=time().$file['name'];
     move_uploaded_file($file['tmp_name'],'csv/'.$name_fi);
	}
}
?>
<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bulk Order</title>

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

function show_name(id){
	 var id=id;
	 var file1=$("#"+id).val();
 $("#text_"+id).val(file1);
 
 }

function readURL(input,id) {

    if (input.files && input.file1) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#div_'+id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.file1);
    }
}


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
 	
 
 function multi_cart()
{
	//var form=document.goodsForm;
	var form=document.bulkorder_form;

	var multi_cnt = document.getElementsByName('quantity[]');
	var count = 0;
	for (i=0; i<multi_cnt.length; i++) {
		if (multi_cnt[i].value > 0) {
			count++;
		}
	}
	if (!count) {
		alert('Quantity for the item is incorrect');
		return false;
	}
	
	form.action="";
	form.submit();
}

 function find_search(){
 var cat1 = $("#category1").val();   
 var cat2 = $("#category2").val();  
 var cat3 = $("#category3").val(); 
 var bulk_order_search =$("#bulk_order_search").val();
 if(bulk_order_search==''){
alert('Please enter text to search');
$("#bulk_order_search").focus();
return false	 
 }
 else{ 
 $("#loader_container").show();
 
 $.post("ajax.php",{bulk_order_search:bulk_order_search,bulk_cat1:cat1,bulk_cat2:cat2,bulk_cat3:cat3}).done(function(data){
	 
	 $("#search_container").html(data);
//alert(data);	 
 $("#loader_container").hide();
 });
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
.col-lg-6 {
	border-left: 0px !important;
	border-right: 0px !important;
}
.small-border-hddn {
	border-left: 0px !important;
	border-right: 0px !important;
}
}
 @media (max-width: 426px) {
.col-lg-6 {
	border-left: 0px !important;
	border-right: 0px !important;
}
.small-border-hddn {
	border-left: 0px !important;
	border-right: 0px !important;
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
input {
	margin-bottom: 0px;
}
.form-group {
	margin-bottom: 0px;
}
.col-lg-6 {
	padding-top: 1px;
	padding-bottom: 1px;
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
  <div class="full" id="">
  <form method="post" action="" name="bulkorder_form" enctype="multipart/form-data" >
    
    <div class="container" style="">
         <div class="full" style=" background:#17B4BB;">
                    <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
                    <img src="images/logo_1.png" class="img-thumbnail" style="border:0px; background:#17B4BB;" >                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
                    <h2 class="h2" style="color:#FFF; height:50px;">Bulk Order</h2>
                    </div>
          </div> 
         <div class="full" style="margin-top:1.5em; margin-left:20%; border:medium;">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              Upload File :<input type="text" value="" id="text_file2" readonly  class="form-group"><input type="file" id="file2" name="file2" 
          onChange="show_name('file2');readURL(this,'file2');"  style="display:inline-block; max-width:80px;">
          
              
              <a href="bull_order_excel.php">Product List Download</a><br>
              <input type="submit" value="Upload File" name="submit" onClick="alert("file sucessfully upload")" style="margin-top:20px; margin-bottom:20px; margin-left:20%">
              </div> 
         </div>
    </div>
    </form>
  </div>
  
  <!--body end--> 
  
  <!-- footer start-->
  
  <?php include('foot.php')?>
  
  <!--footer end  --> 
  
</div>

<!-- loader show start -->
<div id="loader_container" class="overlay-mask" style="">
 
 <div class="full" align="center" style="margin-top:6em;">
 <img src="images/loader.gif" width="100" height="100" >
 </div>
 </div>
<!-- loader show end  -->

<!--right sidebar start-->


<!--right sidebar end --> 



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>

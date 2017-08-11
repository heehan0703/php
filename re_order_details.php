<?php
session_start();

 $member_id=$_SESSION['member_id'];
 
 $trade_code=$_GET['trade_code'];
 
 $GOOD_SHOP_USERID =$_SESSION['GOOD_SHOP_USERID'];

require_once('wp-admin/include/connectdb.php');

$query=mysql_query("SELECT * FROM `trade` where userid='$GOOD_SHOP_USERID' and tradecode='$trade_code'");

$count=mysql_num_rows($query);

 $trade_row= mysql_fetch_assoc(mysql_query("SELECT * FROM `trade` where userid='$GOOD_SHOP_USERID' and tradecode='$trade_code' "));
 
 if($count>0){
$stmt =mysql_query("SELECT * FROM `trade_goods` where tradecode='$trade_row[tradecode]'");	
	 
 }
 
 if(isset($_POST['tradecode'])){
 $tradecode =  $_POST['tradecode'];
$multi_cnt =$_POST['multi_cnt'];	 
 $message = $_POST['message'];
 
 $trade_goods_query = mysql_query("select * from `trade_goods` where userid='$GOOD_SHOP_USERID' and tradecode='$tradecode'");
	$count=0;
	while($trade_goods_row = mysql_fetch_array($trade_goods_query))
	{
		$cnt=$multi_cnt[$count];
		
		$chek_qry = "select * from cart where userid='$GOOD_SHOP_USERID' and goodsId='$trade_goods_row[goodsId]' and   option1='$trade_goods_row[option1]' and option2='$trade_goods_row[option2]'  ";				

					if(mysql_num_rows(mysql_query($chek_qry)) > 0){		//if the same item exists in cart, only quantity increases
		$add_cart_qry = mysql_query("update cart set point=point/cnt*(cnt+$cnt),cnt=cnt+$cnt,message='$message' where userid='$GOOD_SHOP_USERID' and goodsId=$trade_goods_row[goodsId] and option1='$trade_goods_row[option1]' and option2='$trade_goods_row[option2]' ");				
						
					}else{
		$add_cart_qry = mysql_query("insert into cart(userid, goodsId,supplier_id,cnt,option1,option2,price,point,writeday,price_old,message) values('$GOOD_SHOP_USERID','$trade_goods_row[goodsId]','$trade_goods_row[supplier_id]','$cnt','$trade_goods_row[option1]','$trade_goods_row[option2]', '$trade_goods_row[price]','', now(),'','$message' )");
					
						
					
					}
		//echo $add_cart_qry."<br><Br>";
	
	$count++;
	
	}
	header("location:cart.php");
 
 }

?>
<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Re Order</title>

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
 function re_order(Channel){
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

//var form=document.goodsForm;
	var form=document.bulkform;

	var multi_cnt = document.getElementsByName('multi_cnt[]');
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
	form.target="";
	form.submit();
 
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
  <form name="bulkform" id="bulkform" method="post">
 <input type="hidden" name="tradecode" value="<?=$trade_row['tradecode']?>" readonly>
 
    <div class="container" style="">
      <div class="full" style=" background:#873865;">
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
     <img src="images/re_order-logo.png" class="img-thumbnail" style="border:0px; background:#873865;" >       
        </div>
        <div class="col-lg-8 col-md-6 col-xs-6 col-xs-6">
          <h2 class="h2" style="color:#FFF; height:50px;">Re-Order</h2>
        </div>
      </div>
      <div class="full" style="margin-top:1.5em;">
        <div class="full" style="background:#F4F4F4; padding:.5em;"> <b>My Order History</b> </div>
        <!-- shopping cart list header start -->
        <div class="full small-hidden" style="background:#E8E8E8; border-top:1px solid #FFF; margin-top:2em;
         border-bottom:1px solid #fff;">
          <div class="col-lg-4" align="center" style="border-right:1px solid #FFF; padding:.5em 0;">Product</div>
          <div class="col-lg-2" align="center" style="border-right:1px solid #FFF; padding:.5em 0;">Option</div>
          <div class="col-lg-2" align="center" style="border-right:1px solid #FFF; padding:.5em 0;">Price</div>
          <div class="col-lg-2" align="center" style="border-right:1px solid #FFF; padding:.5em 0;">Quantity</div>
          <div class="col-lg-2" align="center" style="border-right:1px solid #FFF; padding:.5em 0;">Subtotal</div>
        </div>
        <!-- shopping cart list header end --> 
        <!-- shopping cart list start -->
        
        <div class="full"> 
      <? if($count>0){
		 while($trade_goods_row=mysql_fetch_assoc($stmt)){
			 
$product_row=mysql_fetch_assoc(mysql_query("SELECT * FROM `product` where id='$trade_goods_row[goodsId]'"));

if (strpos($product_row['images'],',') !== false) {
  $product_img=explode(',',$product_row['images']);
$product_img=$product_img[0];
}
else{
  $product_img=$product_row['images'];	
}			  

$color=explode('-',$trade_goods_row['option1']);
$color=$color[1];

$length=explode('-',$trade_goods_row['option2']);
$length=$length[1];

$subtotal +=$trade_goods_row['cnt']*$trade_goods_row['price'];
		  ?>  
        
          <!-- for large screen start -->
          
          <div class="full small-hidden" style=" border-bottom:1px solid #CCCCCC; padding:.7em 0;">
            <div class="col-lg-4" align="center" style=" padding:.5em 0;">
              <div class="full">
                <div class="col-lg-5">
                <a href="goods_detail.php?goods_Id=<?=$product_row['id']?>"><img width="83" height="74" alt="" src="product_img/<?=$product_img?>"></a></div>
                <div class="col-lg-7" style="padding-top:1em;"><a href=""><?=$product_row['product_name']?></a></div>
              </div>
            </div>
            <div class="col-lg-2" align="center" style=" padding:.5em 0;padding-top:1em;">COLORS <span 
 style="background:#DDFFFB; min-height:20px; min-width:25px;display:inline-block;"><?=$color?></span>
 <br>
              Length<span style="background:#DDFFFB; min-height:20px; min-width:25px;display:inline-block;"><?=$length?></span> </div>
            <div class="col-lg-2" align="center" style="padding:.5em 0;padding-top:1em;">$<?=$trade_goods_row['price']?></div>
            <div class="col-lg-2" align="center" style=" padding:.5em 0;">
              <input type="text" value="<?=$trade_goods_row['cnt']?>" size="2" name="multi_cnt[]"  >
              <br><br>
              <input type="button" class="red-btn" value="Update" style="background:#2685B3; padding:.2em;">
                           </div>
            
            <div class="col-lg-2" align="center" style=" padding:.5em 0;padding-top:1em;">$
			<?=$trade_goods_row['cnt']*$trade_goods_row['price']?></div>
           
          </div>
          
        
      
          <!-- for largge screen end --> 
          
      <!-- for small screen start -->
      <div class="full full-hidden" style="background:#fafafa; border-bottom:1px solid #ccc; padding:.7em 0;">
      <div class="full" style="padding:.7em 0;">
      <div class="col-md-5 col-sm-5 col-xs-5">
     <a href="goods_detail.php?goods_Id=<?=$product_row['id']?>">  
      <img width="83" height="74" alt="" src="product_img/<?=$product_img?>"></a></div>
      <div class="col-md-7 col-sm-7 col-xs-7"><a href=""><?=$product_row['product_name']?></a></div>
      </div>
       <div class="full" style="padding:.7em 0;">
      <div class="col-md-5 col-sm-5 col-xs-5">Option</div>
      <div class="col-md-7 col-sm-7 col-xs-7">COLORS<span style="background:#DDFFFB; min-height:20px; min-width:25px; display:inline-block;
      "><?=$color?></span><br>
Length<span style="background:#DDFFFB; min-height:20px; min-width:25px; display:inline-block;"><?=$length?></span><br>      
      </div>
      </div>
       <div class="full" style="padding:.7em 0;">
      <div class="col-md-5 col-sm-5 col-xs-5">Price</div>
      <div class="col-md-7 col-sm-7 col-xs-7">$<?=$trade_goods_row['price']?> </div>
      </div>
      <div class="full" style="padding:.7em 0;">
      <div class="col-md-5 col-sm-5 col-xs-5">Quantity</div>
      <div class="col-md-7 col-sm-7 col-xs-7"><input type="text" value="<?=$trade_goods_row['cnt']?>" size="2" name="multi_cnt[]">
       <input type="button" class="red-btn" value="Update" style="background:#2685B3; padding:.2em;">
     
         </div>
      </div>
       <div class="full" style="padding:.7em 0;">
      <div class="col-md-5 col-sm-5 col-xs-5">Total</div>
      <div class="col-md-7 col-sm-7 col-xs-7">$<?=$trade_goods_row['cnt']*$trade_goods_row['price']?>  </div>
      </div>
       
      
      </div>
 
      
      <!-- for small screen end -->   
      
      <? } 
	  }?> 
     <div class="full text-right" style=" padding:.5em 0; background:#E7E7E7; border:1px solid #ccc;">
    <b> Subtotal 	  $ <?=$subtotal?></b>
     </div>     
          
        </div>
      
        <!-- shopping cart list end --> 
        
        
      <!-- ordering info start -->
      <div class="full" style="margin-top:1.5em; padding:.7em 0; background:#CCCCCC; border-top:1px solid #666666;">
      <b>Ordering Information</b>
      </div>
    <div class="full" style="border-bottom:1px solid #FFF;">
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="background:#F5F5F5;padding:.3em 0; text-align:center;"> Ordering Code</div>
    <div class="col-lg-7 col-md-5 col-sm-7 col-xs-7" style="padding:.3em 0;"><?=$trade_row['tradecode']?></div>
    </div>
    
   <div class="full" style="border-bottom:1px solid #666666;">
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="background:#F5F5F5;padding:.3em 0; text-align:center;">  Date</div>
    <div class="col-lg-7 col-md-5 col-sm-7 col-xs-7" style="padding:.3em 0;"><?=date("Y-m-d H:i:s",$trade_row['writeday']);?> </div>
    </div>
     <div class="full" style="border-bottom:1px solid #666666; ">
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="background:#F5F5F5;padding:.3em 0; text-align:center;">   Status</div>
    <div class="col-lg-7 col-md-5 col-sm-7 col-xs-7" style="padding:.3em 0;"><b>Confirming Payment</b></div>
    </div>
   <!-- ordering info end -->
   
   <!-- payment info start --> 
    <div class="full" style="margin-top:1.5em; padding:.7em 0; background:#CCCCCC; border-top:1px solid #666666;">
      <b> Payment Information</b>
      </div>
    <div class="full" style="border-bottom:1px solid #FFF;">
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="background:#F5F5F5;padding:.3em 0; text-align:center;">  Subtotal</div>
    <div class="col-lg-7 col-md-5 col-sm-7 col-xs-7" style="padding:.3em 0;">$<?=$trade_row['totalM']?></div>
    </div>
    
   <div class="full" style="border-bottom:1px solid #FFF;">
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="background:#F5F5F5;padding:.3em 0; text-align:center;"> Shipping Price</div>
    <div class="col-lg-7 col-md-5 col-sm-7 col-xs-7" style="padding:.3em 0;">$<?=$trade_row['shipM']?></div>
    </div>
     <div class="full" style="border-bottom:1px solid #FFF; ">
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="background:#F5F5F5;padding:.3em 0; text-align:center;">   Tax</div>
    <div class="col-lg-7 col-md-5 col-sm-7 col-xs-7" style="padding:.3em 0;"><b>$0.00</b></div>
    </div>
    
     <div class="full" style="border-bottom:1px solid #FFF;">
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="background:#F5F5F5;padding:.3em 0; text-align:center;">   Used Points</div>
    <div class="col-lg-7 col-md-5 col-sm-7 col-xs-7" style="padding:.3em 0;">$0.00</div>
    </div>
    
    <div class="full" style="border-bottom:1px solid #FFF;">
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="background:#F5F5F5;padding:.3em 0; text-align:center;">Shipping Other Country</div>
    <div class="col-lg-7 col-md-5 col-sm-7 col-xs-7" style="padding:.3em 0;">$<?=$trade_row['shipotherM']?></div>
    </div>

    
   <div class="full" style="border-bottom:1px solid #666666;">
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="background:#F5F5F5;padding:.3em 0; text-align:center;"> Total amount you will pay</div>
    <div class="col-lg-7 col-md-5 col-sm-7 col-xs-7" style="padding:.3em 0;">$<?=$trade_row['totalM']+$trade_row['shipM']+$trade_row['shipotherM']?></div>
    </div>
     <div class="full" style="border-bottom:1px solid #666666;">
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="background:#F5F5F5;padding:.3em 0; text-align:center;">    Payment Method</div>
    <div class="col-lg-7 col-md-5 col-sm-7 col-xs-7" style="padding:.3em 0;"><b><?=$trade_row['paymethod']?></b></div>
    </div>
   <!-- payment info end --> 
      
      <div class="full" style="margin-top:2em; ">
    Message<br>
    <textarea class="full" rows="7" name="message"></textarea>  
      </div>
    <div class="full" style="margin-top:1.5em;margin-bottom:4em;">
  <div class="col-lg-8 col-md-6 col-sm-6 col-xs-6 text-center">
  <input type="button" class="red-btn" value="RE ORDER" style="font-size:1.2em;padding:.3em 1.2em;" onClick="re_order('cart')" >
  </div>
  
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
      <input type="button" class="red-btn" value="CANCEL" onClick="window.history.back();" style="background:#298BB8; font-size:1.2em; padding:.3em 1.2em;" >
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



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>

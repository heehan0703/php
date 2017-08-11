<?php
session_start();

 $member_id=$_SESSION['member_id'];
 
 $GOOD_SHOP_USERID =$_SESSION['GOOD_SHOP_USERID'];

require_once('wp-admin/include/connectdb.php');

//$tradecode=$_GET['tradecode'];



$cart_goods_query = mysql_query("select * from cart where userid='$GOOD_SHOP_USERID'"); //numbers of items in cart
/*if(isset($_POST['id'])){
    //connect to the db etc...
    mysql_query("UPDATE  `card` SET  `cnt` = '".$_POST['cnt']."'   WHERE `id`='".$_POST['id']."'") or die(mysql_error());

    //this'll send the new statistics to the jquery code
    $query = mysql_query("SELECT FROM `card` WHERE `id`='".$_POST['id']."'")or die(mysql_error());
    $cart_goods_row = mysql_fetch_assoc($query);
}*/
?>
<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dropship</title>

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
function update_dropship(val,cartid,userid){
				var grand_total=$("#grand_total").html();
	$.post("ajax.php",{dropship_val:val,cart_id:cartid,uid:userid});	
				
				if(val==1){
				var packimg=$("#packimages").val();
				var new_val=parseInt(packimg)+1;
				$("#packimages").val(new_val);	
				}
				else{
			var packimg=$("#packimages").val();
				var new_val=packimg-1;
				if(new_val<0){
				new_val=0;	
				}
				$("#packimages").val(new_val);			
				}
				$("#final_total").html(parseFloat(new_val)+parseFloat(grand_total));
				$("#total_P").val(parseFloat(new_val)+parseFloat(grand_total));
			}
			
 function update_count(price,counter,c_id,uid){
		var count=$("#cnt_"+counter).val();
		var packimages =$("#packimages").val();
		if(count<1){
			count=1;
		$("#cnt_"+counter).val(1);
		}
	var subtotal=parseFloat(count)*parseFloat(price);	
	
	$("#subtotal_span_"+counter).html(subtotal);	
	$.post("ajax.php",{cart_id:c_id,count:count,userid:uid}).done(function(data){

   $("#grand_total").html(data);
	//alert(data);	
	$("#final_total").html(parseFloat(packimages)+parseFloat(data));
	});
		
	}			
    </script>
<style type="text/css">
@import url(//fonts.googleapis.com/css?family=Lato:400,700,900);
.dropship_span{
	display:none;
}
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
@media (max-width:990px){
.img_class_width{
	width:200px !important;
	height:200px !important;	
}
.dropship_span{
	display:block;
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
  <form method="post" action="dropship_process.php" enctype="multipart/form-data" >
    <div class="container" style="">
      <div class="full" style=" background:#45743E;">
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
    
    <img src="images/logo_1.png" class="img-thumbnail" style="border:0px; background:#45743E;" >          
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
          <h2 class="h2" style="color:#FFF; height:50px;">Dropship Request</h2>
        </div>
      </div>
      <div class="full" style="margin-top:1.5em;">
        <div class="full" style="background:#F4F4F4; padding:.5em;"> <b>My Shopping Cart</b> </div>
        <!-- shopping cart list header start -->
        <div class="full small-hidden" style="background:#F4F4F4; border-top:1px solid #FFF; border-bottom:1px solid #fff;">
          <div class="col-lg-5 col-md-5" align="center" style="border-right:1px solid #FFF; padding:.5em 0;">Item Description</div>
          <div class="col-lg-3 col-md-3" align="center" style="border-right:1px solid #FFF; padding:.5em 0;">Option</div>
          <div class="col-lg-1 col-md-1" align="center" style="border-right:1px solid #FFF; padding:.5em 0;">Price</div>
          <div class="col-lg-1 col-md-1" align="center" style="border-right:1px solid #FFF; padding:.5em 0;">Quantity</div>
          <div class="col-lg-1 col-md-1" align="center" style="border-right:1px solid #FFF; padding:.5em 0;">Total</div>
          <div class="col-lg-1 col-md-1" align="center" style=" padding:.5em 0;">Dropship</div>
        </div>
        <!-- shopping cart list header end --> 
        <!-- shopping cart list start -->
        <div class="full"> 
          <!-- for large screen start -->
          
          <?php $cart_cnt=0; 

 while($cart_goods_row=mysql_fetch_assoc($cart_goods_query)){
	
	//$cnt=$cart_goods_row['id']; 
	$cart_cnt++;
	$goods_info= mysql_fetch_assoc(mysql_query("SELECT * FROM `product` where id='$cart_goods_row[goodsId]'"));
	
	if (strpos($goods_info['images'],',') !== false) {
  $product_img=explode(',',$goods_info['images']);
$product_img=$product_img[0];
}
else{
  $product_img=$goods_info['images'];	
}
 $total_weight +=$goods_info['package_weight']*$cart_goods_row['cnt'];

$sub_total +=$cart_goods_row['price']*$cart_goods_row['cnt'];

$card_all_id .=$cart_goods_row['id'].",";
	?>

          <div class="full" style="background:#FAFAFA; border-bottom:1px solid #CCCCCC">
            <div class="col-lg-5 col-md-5" align="center" style=" padding:.5em 0;">
              <div class="full">
                <div class="col-lg-5 col-md-5">
      <a href="goods_detail.php?goods_Id=<?=$cart_goods_row['id']?>"><img width="83" class="img_class_width" height="74" alt="" src="product_img/<?=$product_img?>">
      </a></div>
                <div class="col-lg-7 col-md-7" style="padding-top:1em;"><?=$goods_info['product_name']?></div>
              </div>
            </div>
           <?php 
		   $product_color=explode("-",$cart_goods_row['option1']);
		   $product_length=explode("-",$cart_goods_row['option2']);
		   
		    ?>
            <div class="col-lg-3 col-md-3" align="center" style=" padding:.5em 0;padding-top:1em;"><?=$product_color[0]?> 
            <span style="background:#DDFFFB; min-height:20px; min-width:25px;display:inline-block;"><?=$product_color[1]?></span> 
            <br>
              <?=$product_length[0]?><span style="background:#DDFFFB; min-height:20px; min-width:25px;display:inline-block;"><?=$product_length[1]?></span> </div>
            <div class="col-lg-1 col-md-1" align="center" style="padding:.5em 0;padding-top:1em;">$<?=$cart_goods_row['price']?></div>
            <div class="col-lg-1 col-md-1" align="center" style=" padding:.5em 0;">
              <input type="text" name="cnt" id="cnt_<?=$cart_cnt?>" value="<?=$cart_goods_row['cnt']?>" size="2" >
              <br>
              <input type="button" class="red-btn" id="button" name="button" value="Update" onClick="update_count('<?=$cart_goods_row['price']?>','<?=$cart_cnt?>','<?=$cart_goods_row['id']?>','<?=$cart_goods_row['userid']?>')" style="background:#2685B3; padding:.2em;">
            </div>
          
            <div class="col-lg-1 col-md-1" align="center" style=" padding:.5em 0;padding-top:1em;">$ <span id="subtotal_span_<?=$cart_cnt?>">
			<?=$cart_goods_row['cnt']*$cart_goods_row['price']?> </span></div>
            <div class="col-lg-1 col-md-1" align="center" style=" padding:.5em 0;padding-top:1em;">
            <span class="dropship_span">Dropship</span>
              <select id="Particulars" name="Particulars" onChange="update_dropship(this.value,'<?=$cart_goods_row['id']?>','<?=$cart_goods_row['userid']?>')">
                <option value="0" <? if($cart_goods_row['dropship']==0){?> selected<? }?>>No</option>
                <option value="1" <? if($cart_goods_row['dropship']==1){?> selected<? }?>>Yes</option>
              </select>
            </div>
            </div>
            
                   
          <?php }
		  $card_all_id=rtrim($card_all_id,',');
		
		  ?>
          
          
           
          
                 
      <!-- for small screen end -->    
     <div class="full" style=" padding:1.2em 0; background:#FAFAFA;">
    <div class="col-lg-7 col-md-2 col-sm-2 col-xs-2"></div>
    <div class="col-lg-5 col-md-10 col-sm-10 col-xs-10"><b> SubTotal--$ <span id="grand_total"><?=$sub_total?></span></b></div> 
     </div>     
          
        </div>
        <!-- shopping cart list end --> 
       <div class="full" style="margin-top:2.5em;" id="ship_cart_header">
      <img width="300" height="48" src="https://fahair.com/images/upload_shipping.jpg"> <h3 class="h3">.pdf .jpg file only</h3>
       </div> 
       
      <div class="full">
      <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">Upload Files</div>
      <div class="col-lg-10 col-md-9 col-sm-8 col-xs-8"><input type="file" name="file[]" style="display:inline-block;" ><img width="100" height="23" src="https://fahair.com/images/add_icon.jpg" style="cursor:pointer;" onClick="add_img_option()"></div>
      </div> 
      <script type="text/javascript">
	  function add_img_option(){
	$("#ship_cart_header").after('<div class="full"><div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">Upload Files</div><div class="col-lg-10 col-md-9 col-sm-8 col-xs-8"><input type="file" name="file[]" style="display:inline-block;" ></div></div>');	  
	  }
      </script> 
   <div class="full">*Dropship $1/each Shipping Label</div>
   
   <div class="full">
   <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 text-right"><b>Dropship Fee</b></div>
   <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"><b><input type="text" value="0" readonly style="border:0px;" name="packimages" id="packimages" /></b></div>
      </div>   
     
    <div class="full">
   <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 text-right"><b>TOTAL</b></div>
   <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"><b>$<span id="final_total"><?=$sub_total?></span></b></div>
      </div>  
      
      <div class="full" style="margin-top:2em; ">
    Message<br>
    <textarea class="full" name="message" rows="7"></textarea>  
    <input type="hidden" name="total_P" id="total_P" value="<?=number_format($sub_total,2);?>" >
 <input type="hidden" name="total_weight" value="<?=$total_weight?>" >
 <input type="hidden" name="card_all_id" value="<?=$card_all_id?>" >
      </div>
    <div class="full" style="margin-top:1.5em;margin-bottom:4em;">
  <div class="col-lg-8 col-md-6 col-sm-6 col-xs-6 text-center">
  <input type="submit" class="red-btn" value="SUBMIT" style="font-size:1.2em;padding:.3em 1.2em;" >
  </div>
  
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
      <input type="button" class="red-btn" value="CANCEL" style="background:#298BB8; font-size:1.2em; padding:.3em 1.2em;" >
    </div>
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

<!--right sidebar start-->


<!--right sidebar end --> 


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>

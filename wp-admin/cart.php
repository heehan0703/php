<?php
session_start();
//print_r($_SESSION);
require_once('wp-admin/include/connectdb.php');
 $GOOD_SHOP_USERID= $_SESSION['GOOD_SHOP_USERID'];
//echo $GOOD_SHOP_USERID;

	if(empty($GOOD_SHOP_USERID)){	//registering non-member session id
		$GOOD_SHOP_USERID	= time();
		$GOOD_SHOP_NAME		= "non-member";
		$GOOD_SHOP_PART		= "guest";
		$GOOD_SHOP_LEVEL		= 0;
		$GOOD_SHOP_CART		= $GOOD_SHOP_USERID;
		/*
		@session_register("GOOD_SHOP_USERID") or die("session_register err");
		@session_register("GOOD_SHOP_NAME") or die("session_register err");
		@session_register("GOOD_SHOP_LEVEL") or die("session_register err");
		@session_register("GOOD_SHOP_PART") or die("session_register err");
		@session_register("GOOD_SHOP_CART") or die("session_register err");
		*/
		
		$_SESSION['GOOD_SHOP_USERID'] = $GOOD_SHOP_USERID;
		//echo $GOOD_SHOP_USERID;
		$_SESSION['GOOD_SHOP_NAME'] = $GOOD_SHOP_NAME;
		$_SESSION['GOOD_SHOP_LEVEL'] = $GOOD_SHOP_LEVEL;
		$_SESSION['GOOD_SHOP_PART'] = $GOOD_SHOP_PART;
		$_SESSION['GOOD_SHOP_CART'] = $GOOD_SHOP_CART;
		//echo "mmm";
	}
	
	//echo "$GOOD_SHOP_CART--dhirendra $GOOD_SHOP_USERID";
	
	if($_SESSION['GOOD_SHOP_CART']!=$GOOD_SHOP_USERID)
	{
		//echo "update cart set userid=$GOOD_SHOP_USERID where userid='$_SESSION[GOOD_SHOP_CART]'";
	mysql_query("update cart set userid='$GOOD_SHOP_USERID' where userid='$_SESSION[GOOD_SHOP_CART]'");
	}
	

	
	$act =$_GET['act'];
	$bulk_order =$_GET['bulk_order'];

	if($act=="add"){//adding in cart
	//echo "hello";
	 $cap=$_POST['cap'];
	// echo "$cap";
	$capsize1=$_POST['ist'];
	$capsize2=$_POST['sect'];
	$capsize3=$_POST['thi'];
	$capsize4=$_POST['first'];
	$capsize5=$_POST['sec'];
	$capsize6=$_POST['third'];
	//echo "$cap_fst"."dhirendra";
	$cap1=$_POST['a'];
   $cap2=$_POST['b'];
  $lengt=$_POST['lengt'];
	$cnt=$_POST['cnt'];
	$goodsId = $_POST['goodsId'];	
	$price =$_POST['price'];
	
	
	$channel=$_REQUEST['channel'];
	$multi_cnt=$_POST['multi_cnt'];
	$multi_goods = $_POST['multi_goods'];
	$supplier_id = $_POST['supplier_id'];
	$option_index=$_POST['index_option'];
	//echo "$option_index--dhirendra";
		

		$color_option= 'Color-'.$_POST['color_option'];
		$length_option= 'Length-'.$_POST['length_option'];
		//echo $_POST['length_option']."dhirendra";
       
		$chek_qry = "select * from cart where userid='$GOOD_SHOP_USERID' and goodsId=$goodsId and ";
		$chek_qry.= "option1='$color_option' and option2='$length_option'  ";
 if(empty($bulk_order))
		{
			
		
			$count_query=mysql_query($chek_qry);
			$count=mysql_num_rows($count_query);
		
		
		if($count>0){		//if the same item exists in cart, only quantity increases
			$add_cart_qry = "update cart set point=point/cnt*(cnt+$cnt),cnt=cnt+$cnt where userid='$GOOD_SHOP_USERID' and goodsId=$goodsId and";
			$add_cart_qry.= "option1='$color_option' and option2='$length_option' ";
		}else{									//add in cart
			$add_cart_qry = "insert into cart(userid, goodsId,supplier_id,cnt,option1,option2,price,point,writeday,price_old,length,capsize1,capsize,capsize3,capsize4,capsize5,capsize6,cap,	option_index)";
			$add_cart_qry.= "values('$GOOD_SHOP_USERID','$goodsId','$supplier_id','$cnt','$color_option','$length_option',";
			
	$add_cart_qry.= "'$price','$point', now(),'','$lengt','$capsize1','$capsize2','$capsize3','$capsize4','$capsize5','$capsize6','$cap','$option_index')";
			//echo "$add_cart_qry";
			
		
		}
		

		if(mysql_query($add_cart_qry)){
			if($channel == "cart")	header("location:cart.php");
			else{
				if($GOOD_SHOP_PART =="member")	header("location:checkout.php");					//member placing an order
				else							header("location:login.php");		//non-member placing an order
			}
		}
		
		}
	else
		{
			
			$arCartIdx = array();
			//Bulk Order
			
			
			for($i=0;$i<count($multi_cnt);$i++)
			{
				$cnt = $multi_cnt[$i];
				if($cnt > 0)
				{
					$multi_info = explode('@@',$multi_goods[$i]);
					
					$color	= $multi_info[0];
					$color_option= 'Color-'.$color;
					$price		= $multi_info[1];
					$price_old		= $multi_info[2];
					
					$length_option= 'Length-'.$multi_info[3];
			
		 $option1 = $goods_info_row['partName1']."¡¹¡¸".$option4;//item option  ex) color¡¹¡¸yellow 
	 $option2 = $goods_info_row['partName2']."¡¹¡¸".$priceopt[$i];
		if(!empty($option3)) $option3 = $goods_info_row['partName3']."¡¹¡¸".$option3;
		if($goods_info_row['bOptionPrice']) $option4 = $goods_info_row['optionPriceName']."¡¹¡¸".$priceoption;
					
					
	$chek_qry = "select * from cart where userid='$GOOD_SHOP_USERID' and goodsId=$goodsId and ";
		$chek_qry.= "option1='$color_option' and option2='$length_option'  ";				

					if(mysql_num_rows(mysql_query($chek_qry)) > 0){		//if the same item exists in cart, only quantity increases
					
		$add_cart_qry = "update cart set point=point/cnt*(cnt+$cnt),cnt=cnt+$cnt where userid='$GOOD_SHOP_USERID' and goodsId=$goodsId and";
			$add_cart_qry.= " option1='$color_option' and option2='$length_option' ";				
						
					}else{
						
						$cap1=$_POST['a'];
$cap2=$_POST['b'];
$cap=$_POST['cap'];
$capsize1=$_POST['ist'];
	$capsize2=$_POST['sect'];
	$capsize3=$_POST['thi'];
	$capsize4=$_POST['first'];
	$capsize5=$_POST['sec'];
	$capsize6=$_POST['third'];
$lengt=$_POST['lengt'];
$option_index=$_POST['index_option'];
					$add_cart_qry = "insert into cart(userid, goodsId,supplier_id,cnt,option1,option2,price,point,writeday,price_old,length,capsize1,capsize,capsize3,capsize4,capsize5,capsize6,cap,option_index)";
			$add_cart_qry.= "values('$GOOD_SHOP_USERID','$goodsId','$supplier_id','$cnt','$color_option','$length_option',";
			
			$add_cart_qry.= "'$price','$point', now(),'$price_old','$lengt','$capsize1','$capsize2','$capsize3','$capsize4','$capsize5','$capsize6','$cap'.'$option_index')";
					
						
					
					}
					
					mysql_query($add_cart_qry);

					$arCart = mysql_fetch_array(mysql_query($chek_qry));
					$arCartIdx[] = $arCart['id'];
					$arCart = null;
				}
			}

									if($channel == "cart")
									{
										
										header("location:cart.php");
									}
									else
									{
										if($GOOD_SHOP_PART =="member")
										{
											header("location:checkout.php");				//member placing an order
										}
										else
										{
											header("location:login.php");		//non-member placing an order
										}
									}
		}	
		
	}
	
	if($act =="del"){//deleting in cart
	  $cartId=$_REQUEST['cartId'];

		mysql_query("delete from cart  where id=$cartId");
		header("location:cart.php");
	}
	
	if($act=="edit"){
		$cartId=$_REQUEST['cartId'];
		$cnt=$_POST['cnt'];
		
	//	echo "update cart set cnt = $cnt where id=$cartId";
		$edit_qry = mysql_query("update cart set cnt = $cnt where id=$cartId");
		header("location:cart.php");
	}
	
	
	if($act =="wishlist"){//deleting in cart
	  $cartId=$_REQUEST['cartId'];

$cart_query=mysql_fetch_assoc(mysql_query("select * from cart  where id='$cartId'"));
	
	mysql_query("INSERT INTO `wishlist`(`userid`, `goodsId`, `supplier_id`, `option1`, `option2`, `price`, `point`) VALUES ('$cart_query[userid]','$cart_query[goodsId]','$cart_query[supplier_id]','$cart_query[option1]','$cart_query[option2]','$cart_query[price]','$cart_query[point]')");
	
		mysql_query("delete from cart  where id=$cartId");
		header("location:wishlist.php");
	}
	
	
	if($act=="edit"){
		$cart_row = mysql_fetch_array(mysql_query("select * from cart where idx=$cartIdx",$dbp));
		$goods_row = mysql_fetch_array(mysql_query("select * from goods where idx=$cart_row[goodsIdx]",$dbp));
		$edit_qry = mysql_query("update cart set cnt = $cnt,point=$goods_row[point]*$cnt where idx=$cartIdx");
	}
	
	
	
	
	 $cart_goods_query = mysql_query("select * from cart where userid='$GOOD_SHOP_USERID'"); //numbers of items in cart
	
	$cart_item_count = mysql_num_rows($cart_goods_query);
	
	
	if(isset($_POST['email_login'])){
	 
	 $email_login=$_POST['email_login'];
	  $pwd_login=$_POST['pwd_login'];
	 
	
	 
$stmt=$con_pdo->prepare("select * from member where `email`=:email_login and `pwd`=:pwd_login and supplier=0");
 
 $stmt->bindParam(':email_login',$email_login);
 $stmt->bindParam(':pwd_login',$pwd_login);
 
 $stmt->execute();
 
  $count=$stmt->rowCount();
 

 if($count>0){
	 
	 $user_info_row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
	 if($user_info_row['supplier']==1){
	
	$_SESSION['user_type']='Supplier';
		 
	 }
	 else{
		$_SESSION['user_type']='Buyer';	 
	 }
	 
	 $_SESSION['GOOD_SHOP_USERID']=$user_info_row['email'];
	 
	 $_SESSION['GOOD_SHOP_PART']='member';
	 
	 $_SESSION['member_id']=$user_info_row['member_id'];
	 
	 $_SESSION['company_name'] = $user_info_row['company_name'];
	 
	 $_SESSION['verify_status'] = $user_info_row['verify_status'];
	 
	 $_SESSION['i_am'] = $user_info_row['i_am'];
	 echo $user_info_row['level'];
	 $_SESSION['level']=$user_info_row['level'];
	 
	
if($url=='cart'){
header("location:cart.php");
exit;	
}
	 	 
 }
 
 else{
echo '<script type="text/javascript">

</script>';	 

 

 }
 
 
 
 }

	
?>
<!doctype html>
<html><head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cart</title>

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
	
 function show_content_slide(cls){
	 if(!$('.small-hidden').is(':visible'))
     {
        $("."+cls).slideToggle('fast');
 }
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
 <?php /*?><?php  
if($_SESSION['GOOD_SHOP_PART']!='member'){

?>
user_not_login=true
$(document).click(function(e) {
	setTimeout(function() {
    $("#overlay-mask-1").fadeIn('slow');}, 1000);
	

});

<? } ?><?php */?>





function cartDel(Obj)
{
	Obj.action = "cart.php?act=del";
	Obj.submit();
}


function add_wish(Obj)
{
	Obj.action = "cart.php?act=wishlist";
	Obj.submit();
}


function sendcheckout_send(){
$("#sendcheckout").submit();	

}
function show(){
 $("#overlay-mask-1").fadeIn('slow');	
 
}



/* function update_count(price,counter,c_id,uid){
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
*/

function cartEdit(Obj,limitCnt)
{
	var Cnt = Obj.cnt.value;
	if(Cnt=="" || Cnt=="0" || Cnt==0 ){
		alert("Quantity is not correct.");
		Obj.cnt.focus();
	}else if(Cnt > limitCnt){
		alert("We're sorry. This item is sold out/out of stock.\n\nIn stock : "+limitCnt);
		Obj.cnt.focus();
	}else{
		Obj.action = "cart.php?act=edit";
		Obj.submit();
	}
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
					    document.location.href="cart.php"
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

    </script>
    
    
    

<!-- menu part start-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<!--Bootstrap-->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<!--Bootstrap-->

<!--Main Menu File-->
<link rel="stylesheet" type="text/css" media="all" href="css/color-theme.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/webslidemenu.css" />
<script type="text/javascript" src="js/webslidemenu.js"></script>
<!--Main Menu File-->

<!-- font awesome -->
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" />
<!-- font awesome -->

<!--For Demo Only (Remove below css file and Javascript) -->
<link rel="stylesheet" type="text/css" media="all" href="css/demo.css" />
<script type='text/javascript'>
jQuery(document).ready(function() {
    jQuery(".gry, .blue, .green, .red, .orange, .yellow, .purple, .pink, .whitebg, .tranbg").on("click", function() {
        jQuery(".wsmenu")
            .removeClass()
            .addClass('wsmenu pm_' + $(this).attr('class') );       
    });
	
	jQuery(".blue-grdt, .gry-grdt, .green-grdt, .red-grdt, .orange-grdt, .yellow-grdt, .purple-grdt, .pink-grdt").on("click", function() {
        jQuery(".wsmenu")
            .removeClass()
            .addClass('wsmenu pm_' + $(this).attr('class') );       
    });
});
</script>

<!--menu part end -->
    
  
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
	width: 31%;
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

body, html { overflow-x:hidden; }

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
	display:none;
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
.dotted-text{
	overflow: hidden !important;
    text-overflow: ellipsis;
    white-space: nowrap !important;
}
 @media (max-width: 426px) {
.full-hidden {
	display: block;
}
#a{
	margin-right:40px;
	margin-bottom:5px;}
	#b{
	margin-right:30px;}
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
.text-right-small div {
	text-align: left !important;
}
.border-bottom-small {
	border-right: 0px !important;
	border-bottom: 1px solid #eeeeee;
	margin-bottom: 2em;
	padding-bottom: 2em;
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
	overflow-y:auto;
	overflow-x:hidden;
}
.overlay.iframe-content {
	border: 2em solid #fff;
	border-radius: 6px;
	box-sizing: content-box;
	padding: 0;
	width:31%;
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


}

@media (min-width: 320px) and (max-width: 400px) {
 .prodetail{
 text-align:left;
 }
 }
 
 .prodetail{
 text-align:center;
 }
 .checkout{ padding-bottom:10px;}
 
 }
 
</style>

</head>
<body>
<?php include'var1.php'?>
<div class="full"> 
  <!--header start-->


<!--header end--> 

<!--body start-->
<div class="full" id="body_container">
  <div class="container">
    <div class="row" style="padding:1em; color:#606060;"> Home / Cart<br>
    </div>
</div>
<div style=" background:#DEDEDE; height:1px;margin:.9em 0;" class="full"></div>

<div class="full row" align="center" style=" margin:0px auto">
<div class="container" >
<!-- left menu start -->
<div class="col-lg-8 col-sm-12 col-sx-12"  >
<div class="full" style="border:1px solid #DDDDDD; background:#FCFCFC;" align="center">
<h4 class="h4" style="background:#EEEEEE; margin:0px; padding:10px;">Cart</h4>
<!-- item list start -->


<!-- item count start-->
<?php $cart_cnt=0; 

 while($cart_goods_row=mysql_fetch_assoc($cart_goods_query)){
	
	$cart_cnt++;
	
	//echo "SELECT * FROM `product` where id='$cart_goods_row[goodsId]'";
	$goods_info= mysql_fetch_assoc(mysql_query("SELECT * FROM `product` where id='$cart_goods_row[goodsId]'"));
	
	if (strpos($goods_info['images'],',') !== false) {
  $product_img=explode(',',$goods_info['images']);
$product_img=$product_img[0];
}
else{
  $product_img=$goods_info['images'];	
}
if($cart_goods_row['dropship']==0){

$total_weight +=$goods_info['package_weight']*$cart_goods_row['cnt'];	
}
if($total_weight==''){
	$total_weight=0;
}


  if($_SESSION['level']==2){
	  ///for dealer price////////////
	   
	   $userprice=explode(',',$goods_info['wholesaleprice2']);
	   $price1=$userprice[$cart_goods_row['option_index']];
	   
	   if(count($userprice)<=1){
	   $userprice=$goods_info['wholesale_price'];
	   $price1=$userprice;
	    }
	 
	 
		$price=$price1;
		
		  $sub_total +=$price*$cart_goods_row['cnt'];
		
  }else{
	    
		$userprice=explode(',',$goods_info['price']);
		$price=$userprice[$cart_goods_row['option_index']];
		//echo count($userprice);
		if(count($userprice)<=1){
	   $userprice=$goods_info['msrp_price'];
	    $price=$userprice;
		
		
		}
		
		$price1=$price;
				
		  $sub_total +=$price*$cart_goods_row['cnt'];
		 
	    }


 
$length_opt_val = explode('Length-',$cart_goods_row['option2']);

$length_opt_val = $length_opt_val[1];
 
 $quantity = $goods_info['quantity'];

if($goods_info['min_quantity']==''){
$min_quantity =1;	
}
else{
$min_quantity = $goods_info['min_quantity'];	
}

	?>

 <form name="cartForm<?=$cart_cnt?>" method="post">
		<input type="hidden" name="cartId" value="<?=$cart_goods_row['id']?>">
<div class="row" style="background:#FCFCFC; margin:10px 15px;">
<div class="col-lg-4"><img class="" src="product_img/<?=$product_img?>" width="150" height="150" ></div>
<div class="col-lg-8">

<div class="row">
<div class="col-lg-3 text-left" style="padding:0px;"><span style="color:#6A64D0;"><?=$goods_info['product_name']?>
</span><br>
<span style="color:#333;">Min Order: <?=$min_quantity?> / <?=$goods_info['quantity_type']?></span><br>
<span style="color:#333;">Dropship: <?=$goods_info['dropship']?></span>
</div>

<div class="col-lg-7 col-sm-12 col-xs-12 prodetail" style="padding:0px;">
<div class="row" style="text-align:center;">
        <div class="col-lg-4 col-xs-3">Quantity:&nbsp;</div><div class="col-lg-1 col-xs-1 text-left" ><input type="text" size="4" name ="cnt" cnt_<?=$cart_cnt?> value="<?=$cart_goods_row['cnt']?>" ></div>
         <div class="col-lg-1 col-xs-1 text-left"> <input type="button" class="red-btn" id="button" name="button" value="Update" 
         onClick="javascript:cartEdit(document.cartForm<?=$cart_cnt?>, <?=$quantity?>);" style="background:#2685B3; padding:.2em;  margin-left:4.4em;"> </div>
         
         <div class="col-lg-6 col-xs-6 text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
 
</div>
<div class="row">

<span> Cap Size: <?=str_replace('-',' ',$cart_goods_row['cap'])?>, Lace Color:<?=$cart_goods_row['length'];?>
		<?=str_replace('-',':',$cart_goods_row['option1'])?>, <?=str_replace('-',':',$cart_goods_row['option2'])?></span>  

</div>
<div>
<div>
<input  type="checkbox" name="M_E_Price">Shipping
</div>
<div>
<input  type="checkbox" name="M_E_Price">Pickup
</div>
</div>
</div>


<div class="col-lg-2 text-right">
    <div class="row">
            <div class="col-lg-12 col-xs-6 text-left">
               <span > <b>Price </b></span>
            </div>
            <div class="col-lg-12 col-xs-6">
                $<span id="subtotal_span_<?=$cart_cnt?>"><?=$cart_goods_row['cnt']*$price1?>
            </span>
            </div>
    </div>

</div>
</div>
<div class="row">
<div class="col-lg-4 col-xs-2 text-left" style="padding:0px;"></div>
<div class="col-lg-4 col-xs-5 text-right" style="padding:0px; color:#0654BA;">
<a href="javascript:cartDel(document.cartForm<?=$cart_cnt?>);">Remove </a> &nbsp; <span style="color:#999;">|</span></div>
<div class="col-lg-4 col-xs-5 text-left" style="padding:0px; color:#0654BA;">
<a href="javascript:add_wish(document.cartForm<?=$cart_cnt?>)">Save for later </a></div>
</div>
</div>
</div>

<div class="full dotted-class"></div>
</form>
<?php } ?>




<!-- item count end  -->

<!-- item list end  -->
<!--
<div class="full" style="background:#EEEEEE; padding:.5em; padding-bottom:1em;">
<div class="full"><div class="col-lg-7 text-left"><b>You'll get this offer:</b> Buy 2,get 1 at 5% off | <span style="color:#0654BA;">
See all offers</span></div>
<div class="col-lg-5 text-right" style="color:#E15F31;">-$0.55</div></div>
<div class="full"><div class="col-lg-7 text-left"></div>
<div class="col-lg-5 text-left" style=""><span style="color:#0654BA;">Standard(3-7 business days)</span>
&nbsp;<span class="glyphicon glyphicon-arrow-down" style="color:#000;"></span><br>
USPS First Class Package &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span style="color:#000;">+22.50</span>
</div></div>

</div>
-->

</div>

<!-- best 4 choose start-->


<!-- best 4 choose end -->
<div  class="row" style="margin-top:1em;">
<div class="col-lg-7 col-xs-11 pull-right" style="background:#fff; border:1px solid #DDDDDD; padding:.5em; margin-right:12px; border-radius:5px;">
<div class="full text-right" style="padding:.5em; line-height:2em;">Subtotal &nbsp;&nbsp; <b>$ 
 <span id="grand_total"><?=number_format($sub_total,2)?></span></b><br>

</div>
<hr style="margin:2px 0;">
<div class="full text-right" style="padding:.5em; line-height:2em;"><h4 class="h4" style="font-weight:bold;">Total: $
<?=number_format($sub_total,2)?></h4>
</div>
<div class="full" style="margin:1em; ">
<div class="col-lg-6 col-xs-12  checkout text-center" style="padding-right:5px;" id="a">
 <a href="harish_contain.php" style="text-decoration:none;"><div style="background:#268BB9; color:#FFF; text-align:center;" class="red-btn">Continue shopping</div>
 </a> </div>
 <div class="col-lg-6 col-xs-12 " >
 <form method="post" id="sendcheckout" name="sendcheckout"  action="checkout.php">
 <input type="hidden" name="total_P" value="<?=number_format($sub_total,2);?>" >
 <input type="hidden" name="total_weight" value="<?=$total_weight?>" >
  <div style="text-align:center;">
  <? if($_SESSION['GOOD_SHOP_PART']=='member') {?>
  <input type="submit" name="submit_botton" class="red-btn" value="PROCEED TO CHECKOUT" >
  <? } else{?>
 <span class="red-btn" id="b" style="display:inline-block; cursor:pointer;" onClick="show()">PROCEED TO CHECKOUT</span>
  <? } ?>
  </div> 
  </form>
</div></div>

</div>
</div>


</div>
<!-- left menu end-->

<!-- right menu start-->

<div align="center" class="col-lg-3">
 <form method="post" id="sendcheckout" name="sendcheckout"  action="checkout.php">
 <input type="hidden" name="total_P" value="<?=number_format($sub_total,2);?>" >
 <input type="hidden" name="total_weight" value="<?=$total_weight?>" >

<div class="full" style="border:1px solid #DDDDDD; border-radius:5px; background:#fff; padding:.4em; min-height:24em;">
<h3 class="h3 text-left" style="margin-top:0 !important; margin-bottom:0;">Cart summary</h3>
<span class="full text-left" style="display:inline-block;">(<?=$cart_item_count?> items)</span>
<hr style="margin:5px 0;">
<h3 class="h3 text-left" style="margin-top:10px !important;">Total: $<?=number_format($sub_total,2)?></h3>
<div class="full col-lg-12">   <? if($_SESSION['GOOD_SHOP_PART']=='member') {?>
  <input type="submit" name="submit_botton" class="red-btn" value="PROCEED TO CHECKOUT" >
  <? } else{?>
 <span class="red-btn" style="display:inline-block; cursor:pointer;" onClick="show()">PROCEED TO CHECKOUT</span>
  <? } ?></div>

</div>

</form>
<div class="full" style="border:1px solid #DDDDDD; border-radius:5px; background:#fff; padding:.4em; min-height:24em;
 margin-top:3em;">
<hr style="margin:5px 0;">

<h3 class="h3 text-center" style="margin-top:10px !important;">MONEY BACK GUARANTEE</h3>
<div class="full col-lg-10 text-left">
Covers your purchase price plus original shipping on virtually all items. Get the item you ordered or get your money back.<br>
<span style="text-decoration:underline">learn more</span>
</div>

</div>

</div>
<!-- right menu end  -->
</div>
</div>

</div>

<!--body end--> 

<!-- footer start-->

 <?php include'foot.php'?>

<!--footer end  -->

</div>

<!--right sidebar start-->


<!--right sidebar end



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<?php if($_GET['data']=='false'){ ?>
<script type="text/javascript">

</script>
<style type="text/css">
body{
	display:none;
}
</style>
<?php } ?>
<script src="js/bootstrap.min.js"></script>
<!--login popup start-->

<div id="overlay-mask-1" class="overlay-mask" style="">
  

  <div class="overlay iframe-content"><a class="close close-icon" onClick="close_popup('overlay-mask-1')">
  <span id="close_button" style="position: absolute; text-align: center; width: 100%;">X</span></a>
    <div class="content"> 
    <div class="row">
  
   
    
      <div class="col-lg-12 col-xs-12 col-xs-12">
       <form name="login_form" action="" method="post" id="loginform'" onSubmit="return_validate()">
        
    <div class="full" style="background:#FBFBFB; border:1px solid #E5E5E5; padding:5%;">
     <div class="full"><img class="img-responsive" src="images/logo_1.png"></div>
  
   
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
   <span style="text-decoration:underline;"> <a href ="forget_password.php">Forgot Your Password ?</a></span><br>
   
  
   <br>
    <button type="submit" class="blue-btn glyphicon glyphicon-lock" style="background:#268BB9; color:#FFF; width: 85%;">
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
      <strong> <a href="/register.php" target="_blank">NEW MEMBER REGISTER</a></strong>
      </div>
      </div>
      </div>
     
    </div>
    </div>
  
    
    </div>
<!-- login popup end -->

</body>
</html>

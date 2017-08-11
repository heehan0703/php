<?php 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Cache-Control: no-store");
session_start();
//print_r($_SESSION);
require_once('./wp-admin/include/connectdb.php');

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
			$carts= mysql_insert_id();
			
			$_SESSION["cart_id"] = "$carts" ;
			
			//echo $_SESSION["cart_id"];
			if($channel == "cart")	header("location:cart.php");
			else{
				if($GOOD_SHOP_PART =="member")	header("location:checkout_new.php");					//member placing an order
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
						//echo "ID of the last inserted  is: ". mysql_insert_id();
					

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
											header("location:checkout_new.php");				//member placing an order
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
	
	
	//echo "select * from cart where userid='$GOOD_SHOP_USERID'";
	
	 $cart_goods_query = mysql_query("select * from cart where userid='$GOOD_SHOP_USERID'"); //numbers of items in cart
	
	$cart_item_count = mysql_num_rows($cart_goods_query);
	//echo "$cart_item_count";
	
	
	if(isset($_POST['email_login'])){
	 
	 $email_login=$_POST['email_login'];
	  $pwd_login=$_POST['pwd_login'];
	 
	$rowdata=mysql_query("select * from member where `email`=$email_login and `pwd`=$pwd_login and supplier=0");
	
	
// $stmt->bindParam(':email_login',$email_login);
// $stmt->bindParam(':pwd_login',$pwd_login);	 
//$stmt=$con_pdo->prepare("select * from member where `email`=:email_login and `pwd`=:pwd_login and supplier=0");
//echo "select * from member where `email`=:email_login and `pwd`=:pwd_login and supplier=0"; 

 
 //$stmt->execute();
 
 $count=mysql_num_rows($rowdata);
 
  //$count=$stmt->rowCount();
 

 if($count>0){
	 
	 //$user_info_row = $stmt->fetch(PDO::FETCH_ASSOC);
	  $user_info_row = mysql_fetch_array($rowdata);
	 
	 
	 if($user_info_row['supplier']==1){
	
	$_SESSION['user_type']='Supplier';
		 
	 }
	 else{
		$_SESSION['user_type']='Buyer';	 
	 }
	 
	 $_SESSION['GOOD_SHOP_USERID']=$user_info_row['email'];
	 
	 $_SESSION['GOOD_SHOP_PART']='member';
	 
	 $_SESSION['member_id']=$user_info_row['member_id'];
	 $_SESSION['my_shop']=$user_info_row['my_shop'];
	 
	 $_SESSION['company_name'] = $user_info_row['company_name'];
	 
	 $_SESSION['verify_status'] = $user_info_row['verify_status'];
	 
	 $_SESSION['i_am'] = $user_info_row['i_am'];
	 
	 $_SESSION['level']=$user_info_row['level'];
	 
	 if($_SESSION['i_am']=="ISR" and $user_info_row['verify_status']!='1'){
	 $_SESSION['i_am']="";
	 }
	 
	
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
	<script language="javascript">
function test(event)
{
  if(event.keyCode==13){
   check();
   }
}
</script>
<style type="text/css">
.select-cls{
	color:#FFF !important;
	background:#B20024 !important;
}
</style>   
<!doctype html>
<html class="no-js" lang="">
       <head>
       <meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>EBHAHAIR.COM || CART</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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

@media (min-width:266px) and (max-width:600px){
.smallscreen{
display:block;
}
.bigscreen{
display:none;
}

}
</style>
        
		<!-- modernizr css -->
       <base href="/" />
        <script src="/shopick/js/vendor/modernizr-2.8.3.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
	

        </script>
        
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





function cartDelin(Obj)
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
    
    <script language="javascript">
function test(event)
{
  if(event.keyCode==13){
   check();
   }
}
</script>
        



<script type="text/javascript">
function dhirendra(page)
{  



	 var option=$("#sort_data :selected").text();
	 var numberofproduct=$("#productnum option:selected").text();
	 
	 var paging="pagenum.php?<?=$_SERVER['QUERY_STRING']?>&page="+page;
	 
	 ////////////////////default//////////////////
	 if (option=='Defult Value')
  {
   var urlo="default.php?page="+page;
 
$.ajax({
        type: "POST",
        url: urlo,
        data: { param8: option, productnum:numberofproduct }
      }).done(function( msg ) {
	 // alert(msg);
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
	   
  }
   
 // alert(urlo);
 //alert("dhirendra");
 ////// for best rating //////////////////////
 if (option=='Best Rating')
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
		   //$(".product_container").css("display","none");
		   
		  
     });
  
  
  }
  	  
	  
/////////////////////Low to High/////////////////////////
	  
	  if (option=='Low to High')
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
		   
		  
     });
	 
	 
  }
  
  ///////////////////////////////High to Low///////////////////
	  
	  if (option=='High to Low')
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
		   
		  
     });
  }
  
 
  
 ////////////////////////////////Best Selling////////////////////////////////// 

 
  if (option=='Best Selling')
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
		   
		  
     });
	 
  }
////////////////////////////////////New Arrival//////////////////////////////////////////////////////

  
   if (option=='New Arrival')
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



 
    </head>

    <body>
    
    
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		
		<!-- HEADER-AREA START -->
         <?php include'header-new.php'?>
		<!-- HEADER-AREA END -->
 
		<!-- PAGE-CONTENT START -->
		<section class="page-content">
<div class="container">
								<h3>Shopping Cart</h3>
								<ul>
									<li><a href="./index.html">home</a>&nbsp;/&nbsp; Shoping Cart</li>
									
								</ul>
							</div>
			<!-- PAGE-BANNER START -->
			<!--<div class="page-banner-area photo-3 margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="page-banner-menu">
								<h2 class="page-banner-title">Shopping Cart</h2>
								<ul>
									<li><a href="index.html">home</a></li>
									<li>Shoping Cart</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>-->
			<!-- PAGE-BANNER END -->
           
			<!-- SHOPPING-CART-AREA START -->
			<div class="shopping-cart-area margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							
								<div class="table-content table-responsive">
									<table>
										<thead>
											<tr>
												<th class="product-thumbnail">Image</th>
												<th class="product-name">Name</th>
												
											  <th class="product-price">price</th> 
                                               
												<th class="product-quantity">Quantity</th>
                                                <th class="">(length & color)</th>
                                               
												  <th class="product-subtotal">Subtotal</th> 
                                               
												<th class="product-remove">Remove</th>
											</tr>
										</thead>
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


  if(($_SESSION['i_am']=='Wholesaler' and $_SESSION['verify_status']==1) or ($_SESSION['i_am']=='ISR' and $_SESSION['verify_status']==1)){
	  ///for dealer price////////////
	   
	   $userprice=explode(',',$goods_info['wholesaleprice2']);
	   $price1=$userprice[$cart_goods_row['option_index']];
	   
	   if(count($userprice)<=1){
	   $userprice=$goods_info['manufacture_price'];
	   $price1=$userprice;
	    }
	 
	 
		$price=$price1;
		
		  $sub_totalnew +=$price*$cart_goods_row['cnt'];
		
  }else if(($_SESSION['i_am']=='Salon' and $_SESSION['verify_status']==1)){ 
        $userprice=explode(',',$goods_info['price']);
		$price=$userprice[$cart_goods_row['option_index']];
		//echo count($userprice);
		if(count($userprice)<=1){
	   $userprice=$goods_info['msrp_price'];
	    $price=$userprice;
		
		
		}
          $price1=$price;
				
		  $sub_totalnew +=$price*$cart_goods_row['cnt'];
  
  }else if(($_SESSION['i_am']=='Agent' and $_SESSION['verify_status']==1)){ 
        $userprice=explode(',',$goods_info['agent_price']);
		$price=$userprice[$cart_goods_row['option_index']];
		//echo count($userprice);
		if(count($userprice)<=1){
	   $userprice=$goods_info['agentprice1'];
	    $price=$userprice;
		
		
		}
          $price1=$price;
				
		  $sub_totalnew +=$price*$cart_goods_row['cnt'];
  
  }else{
	    
		$userprice=explode(',',$goods_info['manufactureprice2']);
		$price=$userprice[$cart_goods_row['option_index']];
		echo count($userprice);
		if(count($userprice)<=1){
	   $userprice=$goods_info['wholesale_price'];
	  // echo "$userprice";
	    $price=$userprice;
		
		
		}
		
		$price1=$price;
				
		  $sub_totalnew +=$price*$cart_goods_row['cnt'];
		 
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

$producturl1=preg_replace('/[^A-Za-z0-9\-]/', '-', $goods_info['product_name']);
 
 $producturl1=str_replace('--', '-', $producturl1);
   $producturl1=strtolower(rtrim($producturl1, "-"));

	?>
										<tbody>
										<form name="cartForm<?=$cart_cnt?>" method="post">
		<input type="hidden" name="cartId" value="<?=$cart_goods_row['id']?>">
        	<tr>
												<td class="product-thumbnail"><a href="#"><img src="product_img/<?=$product_img?>" alt="" /></a></td>
												<td class="product-name"><a href="#"><?=$goods_info['product_name']?></a>
                                                <br>
<span style="color:#333;">Min Order: <?=$min_quantity?> / <?=$goods_info['quantity_type']?></span><br>
<span style="color:#333;">Dropship: <?=$goods_info['dropship']?></span>
                                                </td>
											
												<td class="product-price"><span class="amount">$ <?=number_format($price1,2)?></span></td>
                                              
                                                
												<td class="product-quantity">
          <input type="text" size="4" name ="cnt" cnt_<?=$cart_cnt?> value="<?=$cart_goods_row['cnt']?>" />
    <input type="button" class="red-btn" id="button" name="button" value="Update" 
         onClick="javascript:cartEdit(document.cartForm<?=$cart_cnt?>, <?=$quantity?>);" style="background:#2685B3; padding:.2em; color:#FFFFFF; "/>
                                                </td>
                                                <td class=""><?=str_replace('-',':',$cart_goods_row['option2'])?> ,<?=str_replace('-',':',$cart_goods_row['option1'])?></td>
                                               
												 <td class="product-subtotal">$<span id="subtotal_span_<?=$cart_cnt?>"><?=number_format($cart_goods_row['cnt']*$price1,2)?></td> 
                                               
												<td class="product-remove"><a href="javascript:cartDelin(document.cartForm<?=$cart_cnt?>);"><i class="pe-7s-close"></i></a></td>
											</tr>
                                            </form>
										</tbody>
										<!-- item list start -->
                                        <? } ?>

<!-- item count start-->
         
                                        
                                      
									</table>
								</div>
								<div class="row">
									<div class="col-md-12">
										<!--<div class="coupon">
											<input type="submit" value="update cart" />
											<span>do you have coupon code</span>
											<input type="text" />
										</div> -->
									</div>
								</div>
								<div class="row">
									<div class="col-md-5 col-md-offset-7">
										<div class="cart-totals">
										<!--	<h2>Total</h2>  --> 
											<div class="table-cart table-responsive">
												<table>
													<tbody class="cart-totals-list">
													
                                                    	<tr>
															<th>Subtotal</th>
															<td>$ <span id="grand_total"><?=number_format($sub_totalnew,2)?></span></td>
														</tr>
                                                      
                                                        
														<!-- <tr>
															<th>Discount</th>
															<td><span>no discount or coupon code</span></td>
														</tr> -->
														
														<tr class="cart-total">
															<th>Total</th>
															<td>$<?=number_format($sub_totalnew,2)?></td>
														</tr>
                                                        
                                                      
													</tbody>
												</table>
												<div class="we-proceed-to-checkout">
													<form method="post" id="sendcheckout" name="sendcheckou"  action="./checkout-new.php">
                                                    <input type="hidden" name="total_P" value="<?=number_format($sub_totalnew,2);?>" >
                                                     <input type="hidden" name="total_weight" value="<?=$total_weight?>" >
                                                     <div style="text-align:center;">
                                                        
                                                               <span class="red-btn" id="b" style="display:inline-block; float:Right; background:#FFFFFF; cursor:pointer;" > <input type="submit" name="submit_botton" class="red-btn" value="Procced to checkout" ></span>
                                                               
                                                                
                                                               
                                                                
                                                                    </div> 
                                                             </form><br><br>
                                                   <div align="right"> <a href="<?=$_SESSION['continus']?>">Continue shopping</a></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							
						</div>
					</div>
				</div>
			</div>
			<!-- SHOPPING-CART-AREA END -->
			<!-- BRAND-LOGO-AREA START -->
			<div class="brand-logo-area margin-bottom-80">
				<div class="container">

					<div class="row"></div>
				</div>
			</div>
			<!-- BRAND-LOGO-AREA END -->
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
     <div class="full"><img class="img-responsive" src="images/logo1.png"></div>
  
   
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

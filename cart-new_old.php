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
			$carts= mysql_insert_id();
			
			$_SESSION["cart_id"] = "$carts" ;
			
			//echo $_SESSION["cart_id"];
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
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Cart || Shopick</title>
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
		<link rel="stylesheet" href="/shopick/style.css">
		<!-- responsive css -->
        <link rel="stylesheet" href="/shopick/css/responsive.css">
		<!-- modernizr css -->
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
        
        <!-- new files end --->
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
  color: #f6416c;
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

</style>

        
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
			<!-- PAGE-BANNER START -->
			<div class="page-banner-area photo-3 margin-bottom-80">
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
			</div>
			<!-- PAGE-BANNER END -->
			<!-- SHOPPING-CART-AREA START -->
			<div class="shopping-cart-area margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<form action="#">
								<div class="table-content table-responsive">
									<table>
										<thead>
											<tr>
												<th class="product-thumbnail">Image</th>
												<th class="product-name">Name</th>
												<th class="product-edit">Edit</th>
												<th class="product-price">price</th>
												<th class="product-quantity">Quantity</th>
                                                <th class="">(length & color)</th>
												<th class="product-subtotal">Subtotal</th>
												<th class="product-remove">Remove</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="product-thumbnail"><a href="#"><img src="img/cart/1.jpg" alt="" /></a></td>
												<td class="product-name"><a href="#">BABY NEW STYLE JACKETS</a></td>
												<td class="product-edit"><a href="#">Edit</a></td>
												<td class="product-price"><span class="amount">$350.00</span></td>
												<td class="product-quantity"><input type="text" value="1" /></td>
                                                <td class=""></td>
												<td class="product-subtotal">$350.00</td>
												<td class="product-remove"><a href="#"><i class="pe-7s-close"></i></a></td>
											</tr>
										</tbody>
										<tbody>
											<tr>
												<td class="product-thumbnail"><a href="#"><img src="img/cart/2.jpg" alt="" /></a></td>
												<td class="product-name"><a href="#">BABY NEW STYLE JACKETS</a></td>
												<td class="product-edit"><a href="#">Edit</a></td>
												<td class="product-price"><span class="amount">$350.00</span></td>
												<td class="product-quantity"><input type="text" value="1" /></td>
                                                <td class=""></td>
												<td class="product-subtotal">$350.00</td>
												<td class="product-remove"><a href="#"><i class="pe-7s-close"></i></a></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="coupon">
											<input type="submit" value="update cart" />
											<span>do you have coupon code</span>
											<input type="text" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5 col-md-offset-7">
										<div class="cart-totals">
											<h2>Total</h2>
											<div class="table-cart table-responsive">
												<table>
													<tbody class="cart-totals-list">
														<tr>
															<th>Subtotal</th>
															<td>$700.00</td>
														</tr>
														<tr>
															<th>Discount</th>
															<td><span>no discount or coupon code</span></td>
														</tr>
														<tr>
															<th>Shipping</th>
															<td><p>free shipping</p></td>
														</tr>
														<tr class="cart-total">
															<th>Total</th>
															<td>$700.00</td>
														</tr>
													</tbody>
												</table>
												<div class="we-proceed-to-checkout">
													<a href="#">proceed to chackout</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- SHOPPING-CART-AREA END -->
			<!-- BRAND-LOGO-AREA START -->
			<div class="brand-logo-area margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-5 col-sm-12">
							<div class="brand-brief">
								<h2 class="border-left-right">they are with us</h2>
								<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
							</div>
						</div>
						<div class="col-md-7 col-sm-12">
							<div class="brand-logo fix">
								<div class="single-logo">
									<img src="img/brand/1.png" alt="" />
								</div>
								<div class="single-logo">
									<img src="img/brand/2.png" alt="" />
								</div>
								<div class="single-logo">
									<img src="img/brand/3.png" alt="" />
								</div>
								<div class="single-logo">
									<img src="img/brand/4.png" alt="" />
								</div>
								<div class="single-logo">
									<img src="img/brand/5.png" alt="" />
								</div>
								<div class="single-logo">
									<img src="img/brand/6.png" alt="" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- BRAND-LOGO-AREA END -->
		</section>
		<!-- PAGE-CONTENT END -->	
		
		<!-- FOOTER-AREA START -->
		<div class="col-lg-12" style="margin:0px; padding:0px" >
<?php include'foot-new.php'?>
</div>

    </body>
</html>

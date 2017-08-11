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
}

//echo $_SESSION['cart_continus_url'];

  $url = $_GET['url'];
  $id=$_GET['goods_Id'];
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
	 $_SESSION['my_shop']=$user_info_row['my_shop'];
	 
	 $_SESSION['company_name'] = $user_info_row['company_name'];
	 
	 $_SESSION['verify_status'] = $user_info_row['verify_status'];
	 $_SESSION['level'] = $user_info_row['level'];
	 
	 $_SESSION['i_am'] = $user_info_row['i_am'];
	 
	
if($url=='cart'){
header("location:cart.php");
exit;	
} 
 }
 
 else{
echo '<script type="text/javascript">
alert("You are not login ! Please try again ");
</script>';	 
 }
 }

$best_sale_query=mysql_query("SELECT * FROM `product` order by product_seen DESC limit 10");
$new_arrival=mysql_query("SELECT * FROM `product` order by sale_amount DESC limit 6"); 
$new_arrivals=mysql_query("SELECT * FROM `product` order by id DESC limit 3"); 
$j=0;
?>
 
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Wigs,Hair Weaves,Remy Hair,Lace Front Wig,Human hair wigs,Lace wigs,top pieces,Hair top pieces - fahair.com</title>
<meta charset="utf-8">
<meta name="google-site-verification" content="IPN9G8baQEC_AcYXBpt6JNWitx7C6-1sLG8Ft1Ok_HE" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="Robots" content="All">
<meta name="Description" content="Wigs,Hair Weaves,Remy Hair,Lace Front Wig,Human hair wigs,Lace wigs,top pieces,Hair top pieces - fahair.com">
<meta name="Keywords" content="Wigs,Hair Weaves,Remy Hair,Lace Front Wig,Human hair wigs,Lace wigs,top pieces,Hair top pieces - fahair.com">

</head>

<!--- new files   ---->

<!-- Google Font -->
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,500.00,700,300' rel='stylesheet' type='text/css'>
		
		<!-- all css here -->
		<!-- bootstrap v3.3.6 css -->
        <link rel="stylesheet" href="shopick/css/bootstrap.min.css">
		<!-- animate css -->
        <link rel="stylesheet" href="shopick/css/animate.css">
		<!-- jquery-ui.min css -->
        <link rel="stylesheet" href="shopick/css/jquery-ui.min.css">
		<!-- meanmenu css -->
        <link rel="stylesheet" href="shopick/css/meanmenu.min.css">
		<!-- nivo-slider css -->
        <link rel="stylesheet" href="shopick/lib/css/nivo-slider.css">
		<!-- owl.carousel css -->
        <link rel="stylesheet" href="shopick/css/owl.carousel.css">
		<!-- flaticon css -->
        <link rel="stylesheet" href="shopick/css/shopick-icon.css">
		<!-- pe-icon-7-stroke css -->
        <link rel="stylesheet" href="shopick/css/pe-icon-7-stroke.css">
		<!-- lightbox css -->
        <link rel="stylesheet" href="shopick/css/lightbox.min.css">
		<!-- style css -->
		<link rel="stylesheet" href="shopick/style.css">
		<!-- responsive css -->
        <link rel="stylesheet" href="shopick/css/responsive.css">
		<!-- modernizr css -->
        <script src="shopick/js/vendor/modernizr-2.8.3.min.js"></script>


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



    

<body>
<?php include'header-new.php'?>

<div>



<!-- PAGE-CONTENT START -->
		<section class="page-content">
			<!-- SLIDER-AREA START -->
			<div class="slider-area margin-bottom-80">
				<div class="bend niceties preview-2">
					<div id="ensign-nivoslider" class="slides">	
						<img src="images/fa_hair_title1.jpg" alt="" title="#slider-direction-1"  />
						<img src="images/fa_hair_title2.jpg" alt="" title="#slider-direction-2"  />
						<img src="images/fa_hair_title3.jpg" alt="" title="#slider-direction-3"  />
					</div>
					<!-- direction 1 -->
					<div id="slider-direction-1" class="t-cn slider-direction">
						<div class="slider-progress"></div>
						<div class="slider-content t-lfl s-tb">
							<div class="title-container s-tb-c title-compress">
								<div class="slider-1">
									<div class="wow fadeInUpBig" data-wow-duration="1.2s" data-wow-delay="0.5s">
										<h1 class="title1">Andrea Silky Hair Weaving</h1>
									</div>
									<div class="image wow fadeInUpBig" data-wow-duration="1.5s" data-wow-delay="0.7s">
										<span><img src="shopick/img/slider/slider-1/slider-border.png" alt="" /></span>
									</div>
									<div class="wow fadeInUpBig" data-wow-duration="1.8s" data-wow-delay="0.9s">
										<p class="slider-brief">100% VIRGIN REMY HUMAN HAIR</p>
									</div>
									<div class="wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="1.1s">
										<a href="https://fahair.com/andrea-silky-virgin-human-hair-weaving-16-24-33.html" class="shop-now">shop now</a>
									</div>
								</div>
							</div>
						</div>	
					</div>
					<!-- direction 2 -->
					<div id="slider-direction-2" class="slider-direction">
						<div class="slider-progress"></div>
						<div class="slider-content t-lfl s-tb">
							<div class="title-container s-tb-c title-compress">
								<div class="slider-1">
									<div class="wow fadeInUpBig" data-wow-duration="1.2s" data-wow-delay="0.5s">
										<h1 class="title1">SHEREE BRAZILIAN REMY HUMAN HAIR </h1>
									</div>
									<div class="image wow fadeInUpBig" data-wow-duration="1.5s" data-wow-delay="0.7s">
										<span><img src="shopick/img/slider/slider-1/slider-border.png" alt="" /></span>
									</div>
									<div class="wow fadeInUpBig" data-wow-duration="1.8s" data-wow-delay="0.9s">
										<p class="slider-brief">SHEREE BZ SILKY YAKY</p>
									</div>
									<div class="wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="1.1s">
										<a href="https://fahair.com/weaves/human-hair-weaves/" class="shop-now">shop now</a>
									</div>
								</div>
							</div>
						</div>		
					</div>
					<!-- direction 3 -->
					<div id="slider-direction-3" class="slider-direction">
						<div class="slider-progress"></div>
						<div class="slider-content t-lfl s-tb">
							<div class="title-container s-tb-c title-compress">
								<div class="slider-1">
									<div class="wow fadeInUpBig" data-wow-duration="1.2s" data-wow-delay="0.5s">
										<h1 class="title1">DUCHESS HUMAN HAIR WIGS</h1>
									</div>
									<div class="image wow fadeInUpBig" data-wow-duration="1.5s" data-wow-delay="0.7s">
										<span><img src="shopick/img/slider/slider-1/slider-border.png" alt="" /></span>
									</div>
									<div class="wow fadeInUpBig" data-wow-duration="1.8s" data-wow-delay="0.9s">
										<p class="slider-brief">100% human hair product from the brand Duchess.</p>
									</div>
									<div class="wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="1.1s">
										<a href="https://fahair.com/wigs/" class="shop-now">shop now</a>
									</div>
								</div>
							</div>
						</div>		
					</div>
				</div>			
			</div>
			<!-- SLIDER-AREA END -->
			<!-- BANNER-AREA START -->
			<div class="banner-area fix margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<div class="single-banner fix">
								<div class="banner-photo padding-0 pull-left col-md-6 col-sm-6 col-xs-12">
									<a href="#"><img src="images/fahair_silky_banner.jpg" alt="andrea silky weaving" /></a>
								</div>
								<div class="banner-brief banner-brief-right col-md-6 col-sm-6">
									<h2>Luxary<span> Silky Weaving </span></h2>
									<h2 class="line-bottom"><span> 100% </span> VIRGIN REMY HUMAN HAIR</h2>
									<a href="https://fahair.com/andrea-silky-virgin-human-hair-weaving-16-24-33.html" class="shop-now">shop now</a>
								</div>
							</div>
							<div class="single-banner fix">
								<div class="banner-brief banner-brief-left col-md-6 col-sm-6">
									<h2>Sheree <span> Silky Yaky </span></h2>
									<h2 class="line-bottom"><span> 100% </span> BRAZILIAN HUMAN HAIR</h2>
									<a href="#" class="shop-now">shop now</a>
								</div>
								<div class="banner-photo padding-0 pull-right col-md-6 col-sm-6 col-xs-12">
									<a href="https://fahair.com/weaves/human-hair-weaves/"><img src="images/fahair_sheree_blue.jpg" alt="SHEREE BRAZILIAN HUMAN HAIR" /></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- BANNER-AREA END -->
			<!-- NEW-COLLECTION START -->
			<div class="new-collection-area fix margin-bottom-80">
				<div class="row">
					<div class="col-md-12">
						<div class="section-title text-center">
							<h2 class="border-left-right-btm">New Collection</h2>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-6 padding-0">
					<div class="single-collection">
						<div class="collection-photo">
							<a href="#"><img src="images/fahair_top_pieces.jpg" alt="" /></a>
						</div>
						<div class="collection-brief">
							<div class="text-right">
								<span class="new">new</span>
							</div>
							<h2>TOP <br />
						  PIECES</h2>
							<ul>
								<li>100% HUMAN HAIR</li>
								<li>COVER FOR THINNER HAIR AND FLAT CROWN</li>
								<li>COVER FOR CROWN HAIR LOSS</li>
								<li>VOLUME ON THE CROWN</li>
							</ul>
						  <a href="https://fahair.com/top-pieces/" class="shop-now active-shop-now">shop now</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-6 padding-0">
					<div class="single-collection">
						<div class="collection-photo">
							<a href="#"><img src="images/fahair_duchess_wig.jpg" alt="" /></a>
						</div>
					  <div class="collection-brief">
							<div class="text-right">
								<span class="new">new</span>
							</div>
							<h2>DUCHESS <br />
						  HUMAN HAIR WIGS</h2>
						  <ul>
							  <li>100% HUMAN HAIR</li>
							  <li>HAND MADE/ LACE WIGS AND WIGS</li>
						  </ul>
						  <a href="https://fahair.com/wigs/" class="shop-now active-shop-now">shop now</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 hidden-md hidden-sm padding-0 ">
					<div class="single-collection">
						<div class="collection-photo">
							<a href="#"><img src="images/fahair_synthetic_wig.jpg" alt="" /></a>
						</div>
					  <div class="collection-brief">
							<div class="text-right">
								<span class="new">new</span>
							</div>
							<h2>PANDORA<br />
						  SYNTHETIC HAIR WIGS</h2>
						  <ul>
							  <li>HIGH FIBER SYNTHETIC WIGS</li>
							  <li>LACE WIGS</li>
						  </ul>
						  <a href="https://fahair.com/wigs/" class="shop-now active-shop-now">shop now</a>
						</div>
					</div>
				</div>
		  </div>
			<!-- NEW-COLLECTION END -->
			<!-- PRODUCT-AREA START -->
			<div class="product-area">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="section-title text-center">
								<h2 class="border-left-right-btm">All Product's</h2>
							</div>
						</div>
					</div>
				</div>
				<div id="active-product" class="product-slider">
					<!-- Single-product start -->
					<? while($new_arrival1=mysql_fetch_assoc($best_sale_query)){
 if (strpos($new_arrival1['images'],',') !== false) {
  $new_arrival1_img=explode(',',$new_arrival1['images']);
$new_arrival1_img=$new_arrival1_img[0];
}
else{
  $new_arrival1_img=$new_arrival1['images'];	
}
 $producturl1=preg_replace('/[^A-Za-z0-9\-]/', '-', $new_arrival1['product_name']);
 
 $producturl1=str_replace('--', '-', $producturl1);
   $producturl1=strtolower(rtrim($producturl1, "-"));
    
 ?>
                    <div class="single-product">
						<div class="product-photo">
							<a href="/<?=$producturl1?>-<?=$new_arrival1['id']?>.html">
								<img class="primary-photo" src="./thumbnail-new-all.php?thumb=<?=$new_arrival1_img?>" alt="" />
								<!--<img class="secondary-photo" src="shopick/img/product/5.jpg" alt="" />-->
							</a>
							<div class="pro-action">
								<a href="#" class="action-btn"><i class="sp-heart"></i><span>Wishlist</span></a>
								<a href="#" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
								<a href="#" class="action-btn"><i class="sp-compare-alt"></i><span>Compare</span></a>
							</div>
						</div>
						<div class="product-brief">
							<div class="pro-rating">
								<a href="#"><i class="sp-star rating-1"></i></a>
								<a href="#"><i class="sp-star rating-1"></i></a>
								<a href="#"><i class="sp-star rating-1"></i></a>
								<a href="#"><i class="sp-star rating-1"></i></a>
								<a href="#"><i class="sp-star rating-2"></i></a>
							</div>
							<h2><a href="/<?=$producturl1?>-<?=$new_arrival1['id']?>.html"><?=$new_arrival1['product_name']?></a></h2>
							<h3>$<?php echo $new_arrival1['msrp_price']?></h3>
						</div>
					</div>	
                    
              <? } ?>      
					<!-- Single-product end -->
					
					
				</div>
			</div>
			<!-- PRODUCT-AREA END -->
			<!-- PROMOTIONAL-BANNER START -->
			<div class="promotional-banner-area clearfix margin-bottom-80">
				<div class="promotional-banner">
					<!-- Single-promo start -->
					<div class="col-md-6 col-sm-12 padding-0">
						<div class="single-promo-banner promo-banner-1">
							<img src="images/fahair_sale_banner.jpg" alt="" /> 
                             
						  <div class="promo-banner-brief">
								<h2>sale !</h2>
								<h3>up to <span>30%</span>  off</h3>
								<h4>best products</h4>
								<a class="shop-now active-shop-now" href="#">shop now</a>
							</div>
						</div>
					</div>
					<!-- Single-promo End -->
					<!-- Single-promo start -->
					<div class="col-md-6 col-sm-12 padding-0">
						<div class="single-promo-banner promo-banner-2">
							<img src="images/fahair_sale_banner2.jpg" alt="" /> 
						  <div class="promo-banner-brief">
								<div class="count-down">
									<div class="timer">
										<div data-countdown="2020/12/31"></div>
									</div> 
								</div>
								<div class="upcomming-brief">
								 <h2>upcomming best collection</h2>
								 <h3><span>Heat Frienly</span> wigs collection</h3>
								
								 <a class="shop-now" href="#">pre order</a>
								</div>
							</div>
						</div>
					</div>
					<!-- Single-promo End -->
				</div>
			</div>
			<!-- PROMOTIONAL-BANNER END -->
			<!-- BEST-SELL-AREA START -->
			<div class="best-sell-area">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="section-title text-center">
								<h2 class="border-left-right-btm">Best Sell</h2>
							</div>
						</div>
					</div>				
					<div class="row">
						<div class="col-md-12">
							<!-- best-sell-menu -->
							<ul role="tablist" class="best-sell-menu">
								<li role="presentation" class="active"><a href="#men" role="tab" data-toggle="tab">Men</a></li>
								<li role="presentation"><a href="#women"  role="tab" data-toggle="tab">Women</a></li>
								<li role="presentation"><a href="#accessories"  role="tab" data-toggle="tab">Accessories</a></li>
							</ul>
							<!-- best-sell-product -->
							<div class="tab-content best-sell-product">
								<div role="tabpanel" class="tab-pane fade in active" id="men">
									<div class="row">
										<div class="col-md-4 col-sm-4 col-xs-12">
											<!-- Single-product start -->
											 <? 
											 $i=0;
											 while($new_arrival1=mysql_fetch_assoc($new_arrival)){
 if (strpos($new_arrival1['images'],',') !== false) {
  $new_arrival1_img=explode(',',$new_arrival1['images']);
$new_arrival1_img=$new_arrival1_img[0];
}
else{
  $new_arrival1_img=$new_arrival1['images'];	
}
 $producturl1=preg_replace('/[^A-Za-z0-9\-]/', '-', $new_arrival1['product_name']);
 
 $producturl1=str_replace('--', '-', $producturl1);
   $producturl1=strtolower(rtrim($producturl1, "-"));
   $i++;
    
 ?>
                                            <div class="single-product">
												<div class="product-photo">
													<a href="/<?=$producturl1?>-<?=$new_arrival1['id']?>.html">
														<img class="primary-photo" src="./thumbnailindex2.php?thumb=<?=$new_arrival1_img?>" alt="" style="height:400px;" />
														<img class="secondary-photo" src="./thumbnailindex2.php?thumb=<?=$new_arrival1_img?>" alt="" style="height:400px;" />
													</a>
													<div class="pro-action">
														<a href="#" class="action-btn"><i class="sp-heart"></i><span>Wishlist</span></a>
														<a href="#" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
														<a href="#" class="action-btn"><i class="sp-compare-alt"></i><span>Compare</span></a>
													</div>
												</div>
												<div class="product-brief">
													<h2><a href="/<?=$producturl1?>-<?=$new_arrival1['id']?>.html"><?=$new_arrival1['product_name']?></a></h2>
													<div class="product-brief-inner">
														<h3>$<?php echo $new_arrival1['msrp_price']?></h3>
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
											<!-- Single-product end -->
                                            <? if($i==1){ $i=0;?> 
                                            </div>
										<div class="col-md-4 col-sm-4 col-xs-12">
                                        
                                            <? } }  ?>
                                            
											
										
											
											
										
											
										</div>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="women">
									<div class="row">
										<div class="col-md-4 col-sm-4 col-xs-12">
											<!-- Single-product start -->
											<div class="single-product">
												<div class="product-photo">
													<a href="#">
														<img class="primary-photo" src="shopick/img/best-sell/6.jpg" alt="" />
														<img class="secondary-photo" src="shopick/img/best-sell/1.jpg" alt="" />
													</a>
													<div class="pro-action">
														<a href="#" class="action-btn"><i class="sp-heart"></i><span>Wishlist</span></a>
														<a href="#" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
														<a href="#" class="action-btn"><i class="sp-compare-alt"></i><span>Compare</span></a>
													</div>
												</div>
												<div class="product-brief">
													<h2><a href="#">Women's Fashion</a></h2>
													<div class="product-brief-inner">
														<h3>$500.00</h3>
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
											<!-- Single-product end -->
											<!-- Single-product start -->
											<div class="single-product">
												<div class="product-photo">
													<a href="#">
														<img class="primary-photo" src="shopick/img/best-sell/4.jpg" alt="" />
														<img class="secondary-photo" src="shopick/img/best-sell/1.jpg" alt="" />
													</a>
													<div class="pro-action">
														<a href="#" class="action-btn"><i class="sp-heart"></i><span>Wishlist</span></a>
														<a href="#" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
														<a href="#" class="action-btn"><i class="sp-compare-alt"></i><span>Compare</span></a>
													</div>
												</div>
												<div class="product-brief">
													<h2><a href="#">Women's Fashion</a></h2>
													<div class="product-brief-inner">
														<h3>$450.00</h3>
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
											<!-- Single-product end -->
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<!-- Single-product start -->
											<div class="single-product">
												<div class="product-photo">
													<a href="#">
														<img class="primary-photo" src="shopick/img/best-sell/5.jpg" alt="" />
														<img class="secondary-photo" src="shopick/img/best-sell/2.jpg" alt="" />
													</a>
													<div class="pro-action">
														<a href="#" class="action-btn"><i class="sp-heart"></i><span>Wishlist</span></a>
														<a href="#" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
														<a href="#" class="action-btn"><i class="sp-compare-alt"></i><span>Compare</span></a>
													</div>
												</div>
												<div class="product-brief">
													<h2><a href="#">Randomised Words</a></h2>
													<div class="product-brief-inner">
														<h3>$500.00</h3>
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
											<!-- Single-product end -->
											<!-- Single-product start -->
											<div class="single-product">
												<div class="product-photo">
													<a href="#">
														<img class="primary-photo" src="shopick/img/best-sell/5.jpg" alt="" />
														<img class="secondary-photo" src="shopick/img/best-sell/1.jpg" alt="" />
													</a>
													<div class="pro-action">
														<a href="#" class="action-btn"><i class="sp-heart"></i><span>Wishlist</span></a>
														<a href="#" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
														<a href="#" class="action-btn"><i class="sp-compare-alt"></i><span>Compare</span></a>
													</div>
												</div>
												<div class="product-brief">
													<h2><a href="#">Randomised Words</a></h2>
													<div class="product-brief-inner">
														<h3>$500.00</h3>
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
											<!-- Single-product end -->
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<!-- Single-product start -->
											<div class="single-product">
												<div class="product-photo">
													<a href="#">
														<img class="primary-photo" src="shopick/img/best-sell/4.jpg" alt="" />
														<img class="secondary-photo" src="shopick/img/best-sell/1.jpg" alt="" />
													</a>
													<div class="pro-action">
														<a href="#" class="action-btn"><i class="sp-heart"></i><span>Wishlist</span></a>
														<a href="#" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
														<a href="#" class="action-btn"><i class="sp-compare-alt"></i><span>Compare</span></a>
													</div>
												</div>
												<div class="product-brief">
													<h2><a href="#">Women's Fashion</a></h2>
													<div class="product-brief-inner">
														<h3>$450.00</h3>
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
											<!-- Single-product end -->
											<!-- Single-product start -->
											<div class="single-product">
												<div class="product-photo">
													<a href="#">
														<img class="primary-photo" src="shopick/img/best-sell/6.jpg" alt="" />
														<img class="secondary-photo" src="shopick/img/best-sell/2.jpg" alt="" />
													</a>
													<div class="pro-action">
														<a href="#" class="action-btn"><i class="sp-heart"></i><span>Wishlist</span></a>
														<a href="#" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
														<a href="#" class="action-btn"><i class="sp-compare-alt"></i><span>Compare</span></a>
													</div>
												</div>
												<div class="product-brief">
													<h2><a href="#">Randomised Words</a></h2>
													<div class="product-brief-inner">
														<h3>$500.00</h3>
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
											<!-- Single-product end -->
										</div>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="accessories">
									<div class="row">
										<div class="col-md-4 col-sm-4 col-xs-12">
											<!-- Single-product start -->
											<div class="single-product">
												<div class="product-photo">
													<a href="#">
														<img class="primary-photo" src="shopick/img/best-sell/1.jpg" alt="" />
														<img class="secondary-photo" src="shopick/img/best-sell/6.jpg" alt="" />
													</a>
													<div class="pro-action">
														<a href="#" class="action-btn"><i class="sp-heart"></i><span>Wishlist</span></a>
														<a href="#" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
														<a href="#" class="action-btn"><i class="sp-compare-alt"></i><span>Compare</span></a>
													</div>
												</div>
												<div class="product-brief">
													<h2><a href="#">Randomised Words</a></h2>
													<div class="product-brief-inner">
														<h3>$500.00</h3>
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
											<!-- Single-product end -->
											<!-- Single-product start -->
											<div class="single-product">
												<div class="product-photo">
													<a href="#">
														<img class="primary-photo" src="shopick/img/best-sell/4.jpg" alt="" />
														<img class="secondary-photo" src="shopick/img/best-sell/1.jpg" alt="" />
													</a>
													<div class="pro-action">
														<a href="#" class="action-btn"><i class="sp-heart"></i><span>Wishlist</span></a>
														<a href="#" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
														<a href="#" class="action-btn"><i class="sp-compare-alt"></i><span>Compare</span></a>
													</div>
												</div>
												<div class="product-brief">
													<h2><a href="#">Women's Fashion</a></h2>
													<div class="product-brief-inner">
														<h3>$450.00</h3>
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
											<!-- Single-product end -->
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<!-- Single-product start -->
											<div class="single-product">
												<div class="product-photo">
													<a href="#">
														<img class="primary-photo" src="shopick/img/best-sell/2.jpg" alt="" />
														<img class="secondary-photo" src="shopick/img/best-sell/4.jpg" alt="" />
													</a>
													<div class="pro-action">
														<a href="#" class="action-btn"><i class="sp-heart"></i><span>Wishlist</span></a>
														<a href="#" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
														<a href="#" class="action-btn"><i class="sp-compare-alt"></i><span>Compare</span></a>
													</div>
												</div>
												<div class="product-brief">
													<h2><a href="#">Randomised Words</a></h2>
													<div class="product-brief-inner">
														<h3>$500.00</h3>
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
											<!-- Single-product end -->
											<!-- Single-product start -->
											<div class="single-product">
												<div class="product-photo">
													<a href="#">
														<img class="primary-photo" src="shopick/img/best-sell/5.jpg" alt="" />
														<img class="secondary-photo" src="shopick/img/best-sell/1.jpg" alt="" />
													</a>
													<div class="pro-action">
														<a href="#" class="action-btn"><i class="sp-heart"></i><span>Wishlist</span></a>
														<a href="#" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
														<a href="#" class="action-btn"><i class="sp-compare-alt"></i><span>Compare</span></a>
													</div>
												</div>
												<div class="product-brief">
													<h2><a href="#">Randomised Words</a></h2>
													<div class="product-brief-inner">
														<h3>$500.00</h3>
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
											<!-- Single-product end -->
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<!-- Single-product start -->
											<div class="single-product">
												<div class="product-photo">
													<a href="#">
														<img class="primary-photo" src="shopick/img/best-sell/3.jpg" alt="" />
														<img class="secondary-photo" src="shopick/img/best-sell/5.jpg" alt="" />
													</a>
													<div class="pro-action">
														<a href="#" class="action-btn"><i class="sp-heart"></i><span>Wishlist</span></a>
														<a href="#" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
														<a href="#" class="action-btn"><i class="sp-compare-alt"></i><span>Compare</span></a>
													</div>
												</div>
												<div class="product-brief">
													<h2><a href="#">Women's Fashion</a></h2>
													<div class="product-brief-inner">
														<h3>$450.00</h3>
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
											<!-- Single-product end -->
											<!-- Single-product start -->
											<div class="single-product">
												<div class="product-photo">
													<a href="#">
														<img class="primary-photo" src="shopick/img/best-sell/6.jpg" alt="" />
														<img class="secondary-photo" src="shopick/img/best-sell/2.jpg" alt="" />
													</a>
													<div class="pro-action">
														<a href="#" class="action-btn"><i class="sp-heart"></i><span>Wishlist</span></a>
														<a href="#" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
														<a href="#" class="action-btn"><i class="sp-compare-alt"></i><span>Compare</span></a>
													</div>
												</div>
												<div class="product-brief">
													<h2><a href="#">Randomised Words</a></h2>
													<div class="product-brief-inner">
														<h3>$500.00</h3>
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
											<!-- Single-product end -->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- BEST-SELL-AREA END -->
			<!-- ALL-PRODUCT-VIEW START --><!-- ALL-PRODUCT-VIEW END -->
			<!-- FEATURED-AREA START -->
			<div class="featured-area margin-bottom-80">
				<div class="container">
					<div class="row cus-row-1">
						<div class="single-featured single-featured-1 featured-link">
							<a href="#"><img src="shopick/img/featured/1.jpg" alt="" /></a>
							<div class="featured-brief">
								<a href="#"><i class="sp-arrow-long-right"></i></a>
							</div>
						</div>
						<div class="single-featured single-featured-2">
							<div class="single-featured-inner featured-link">
								<a href="#"><img src="shopick/img/featured/2.jpg" alt="" /></a>
								<div class="featured-brief">
									<a href="#"><i class="sp-arrow-long-right"></i></a>
								</div>
							</div>
							<div class="single-featured-inner featured-link">
								<a href="#"><img src="shopick/img/featured/3.jpg" alt="" /></a>
								<div class="featured-brief">
									<a href="#"><i class="sp-arrow-long-right"></i></a>
								</div>
							</div>
						</div>
						<div class="single-featured single-featured-1 featured-link">
							<a href="#"><img src="shopick/img/featured/4.jpg" alt="" /></a>
							<div class="featured-brief">
								<a href="#"><i class="sp-arrow-long-right"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- FEATURED-AREA END -->
			<!-- BRAND-LOGO-AREA START --><!-- BRAND-LOGO-AREA END -->
			<!-- TESTIMONIAL-AREA START -->
			<div class="testimonial-area margin-bottom-80">
				<div class="testimonial">
					<h2><sup><i class="sp-quote"></i></sup> they love us</h2>
					<div class="testimonial-border">
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<div class="active-testimonial">
										<div class="single-testimonial">
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="client-photo">
													<img src="shopick/img/testimonial/1.png" alt="" />
												</div>
											</div>
											<div class="col-md-8 col-sm-8 col-xs-12">
												<div class="client-opinion">
													<h3>jorina doe</h3>
													<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has rootsContrary to popular belief, Lorem Ipsum is not simply random text. It has roots. Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots Contrary to popular belief, </p>
												</div>
											</div>
										</div>
										<div class="single-testimonial">
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="client-photo">
													<img src="shopick/img/testimonial/1.png" alt="" />
												</div>
											</div>
											<div class="col-md-8 col-sm-8 col-xs-12">
												<div class="client-opinion">
													<h3>jorina doe</h3>
													<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has rootsContrary to popular belief, Lorem Ipsum is not simply random text. It has roots. Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots Contrary to popular belief, </p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- TESTIMONIAL-AREA END -->
			<!-- SERVICE-AREA START -->
			<div class="service-area margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="single-service">
								<div class="service-icon">
									<i class="sp-transport"></i>
								</div>
								<div class="service-brief">
									<h3>free shipping</h3>
									<p>There are many variations of passages of Lorem Ipsum available, alteration</p>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="single-service">
								<div class="service-icon">
									<i class="sp-head-phone"></i>
								</div>
								<div class="service-brief">
									<h3>help line</h3>
									<p>(+112) 1925184203 - call any time for any support Lorem Ipsum available, alteration </p>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="single-service">
								<div class="service-icon">
									<i class="sp-business"></i>
								</div>
								<div class="service-brief">
									<h3>money back guarantee</h3>
									<p>There are many variations of passages of Lorem Ipsum available, alteration</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- SERVICE-AREA END -->
			<!-- BLOG-AREA START -->
			<div class="blog-area margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="section-title text-center">
								<h2>from blog</h2>
							</div>
						</div>
					</div>			
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="single-blog">
								<div class="blog-photo">
									<a href="#"><img src="shopick/img/blog/1.jpg" alt="" /></a>
									<div class="blog-post-date">
										<span>15th</span>
										<span>Jan</span>
									</div>
								</div>
								<div class="blog-brief">
									<p>Lorem ipsum dolr sit amet, It is not simply random text. It has roots...</p>
									<div class="like-comment">
										<a href="#"><i class="sp-like"></i>120 like</a>
										<a href="#"><i class="sp-comment"></i>60 comment</a>
									</div>
									<a class="shop-now" href="#">Read more</a>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="single-blog">
								<div class="blog-photo">
									<a href="#"><img src="shopick/img/blog/2.jpg" alt="" /></a>
									<div class="blog-post-date">
										<span>13th</span>
										<span>Feb</span>
									</div>
								</div>
								<div class="blog-brief">
									<p>Lorem ipsum dolr sit amet, It is not simply random text. It has roots...</p>
									<div class="like-comment">
										<a href="#"><i class="sp-like"></i>120 like</a>
										<a href="#"><i class="sp-comment"></i>60 comment</a>
									</div>
									<a class="shop-now" href="#">Read more</a>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="single-blog">
								<div class="blog-photo">
									<a href="#"><img src="shopick/img/blog/3.jpg" alt="" /></a>
									<div class="blog-post-date">
										<span>25th</span>
										<span>Feb</span>
									</div>
								</div>
								<div class="blog-brief">
									<p>Lorem ipsum dolr sit amet, It is not simply random text. It has roots...</p>
									<div class="like-comment">
										<a href="#"><i class="sp-like"></i>120 like</a>
										<a href="#"><i class="sp-comment"></i>60 comment</a>
									</div>
									<a class="shop-now" href="#">Read more</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- BLOG-AREA END -->
			<!-- SUBSCRIBE-AREA START -->
			<div class="suscribe-area margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="subscribe">
								<div class="subscribe-brief">
									<h3>enter your email address</h3>
									<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
								</div>
								<div class="subscribe-form">
									<form action="#">
										<input type="text" placeholder="Enter email to subscribe" />
										<button type="submit">Submit</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- SUBSCRIBE-AREA START END -->
		</section>
		<!-- PAGE-CONTENT END -->

  










  <div class="col-lg-12" style="margin:0px; padding:0px" >
<?php include'foot-new.php'?>
</div>
  <!--login popup start-->

  
</body>
</html>

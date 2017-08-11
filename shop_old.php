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
 $product_query2 =  mysql_query(dopaging($product_query_start,20));
 

 
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


<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Shop || Shopick</title>
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
			<div class="page-banner-area margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="page-banner-menu">
								<h2 class="page-banner-title">Shop</h2>
								<ul>
									<li><a href="index.html">home</a></li>
									<li>Shop Grid</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- PAGE-BANNER END -->
			<!-- SHOP-AREA START -->
			<div class="shop-area margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<span class="shop-border"></span>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
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
							<aside class="widget shop-filter">
								<h3 class="sidebar-title">price</h3>
								<div class="info_widget">
									<div id="slider-range"></div>
									<div id ="amount">
										<input type ="text" name ="first_price" class="first_price" />
										<input type ="text" name ="last_price" class="last_price"/>
									</div>
									<button class="shop-now">Filter</button>
								</div>						
							</aside>
							<!-- shop-filter end -->
							<!-- widget-color start -->
							<aside class="widget widget-color">
								<h5 class="sidebar-title">colore</h5>
								<ul>
									<li><a class="color-1" href="#"></a></li>
									<li><a class="color-2" href="#"></a></li>
									<li><a class="color-3" href="#"></a></li>
									<li><a class="color-4" href="#"></a></li>
									<li><a class="color-5" href="#"></a></li>
								</ul>
							</aside>
							<!-- widget-color end -->
							<!-- widget-brand start -->
							<aside class="widget widget-brand">
								<h5 class="sidebar-title">Brand</h5>
								<ul>
									<li><input type="checkbox" /><a href="#">Country Road</a></li>
									<li><input type="checkbox" /><a href="#">H&M Home</a></li>
									<li><input type="checkbox" /><a href="#">Urban outfitters</a></li>
									<li><input type="checkbox" /><a href="#">Zara home</a></li>
								</ul>
							</aside>
							<!-- widget-brand end -->
							<!-- widget-top-brand start -->
							<aside class="widget top-rated hidden-sm">
								<h5 class="sidebar-title">top rated</h5>
								<div class="sidebar-product">
									<!-- Single-product start -->
									<div class="single-product">
										<div class="product-photo">
											<a href="#">
												<img class="primary-photo" src="/shopick/img/sidebar/1.png" alt=""/> 
											</a>
										</div>
										<div class="product-brief">
											<h2><a href="#">Randomised Words</a></h2>
											<h3>$500.00 <span>$244.00</span></h3>
										</div>
									</div>	
									<!-- Single-product end -->
									<!-- Single-product start -->
									<div class="single-product">
										<div class="product-photo">
											<a href="#">
												<img class="primary-photo" src="/shopick/img/sidebar/2.png" alt=""/> 
											</a>
										</div>
										<div class="product-brief">
											<h2><a href="#">CLEO POURER</a></h2>
											<h3>$500.00 <span>$244.00</span></h3>
										</div>
									</div>	
									<!-- Single-product end -->
									<!-- Single-product start -->
									<div class="single-product">
										<div class="product-photo">
											<a href="#">
												<img class="primary-photo" src="/shopick/img/sidebar/3.png" alt=""/> 
											</a>
										</div>
										<div class="product-brief">
											<h2><a href="#">TAM SPREADER</a></h2>
											<h3>$500.00 <span>$244.00</span></h3>
										</div>
									</div>	
									<!-- Single-product end -->
									<!-- Single-product start -->
									<div class="single-product">
										<div class="product-photo">
											<a href="#">
												<img class="primary-photo" src="/shopick/img/sidebar/4.png" alt=""/> 
											</a>
										</div>
										<div class="product-brief">
											<h2><a href="#">MARCEL THROW</a></h2>
											<h3>$500.00 <span>$244.00</span></h3>
										</div>
									</div>	
									<!-- Single-product end -->
									<!-- Single-product start -->
									<div class="single-product">
										<div class="product-photo">
											<a href="#">
												<img class="primary-photo" src="/shopick/img/sidebar/5.png" alt=""/> 
											</a>
										</div>
										<div class="product-brief">
											<h2><a href="#">RLIE EXTRA SMALL</a></h2>
											<h3>$500.00 <span>$244.00</span></h3>
										</div>
									</div>	
									<!-- Single-product end -->
								</div>
							</aside>
							<!-- widget-top-brand end -->
						</div>
						<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
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
										<select class="shop-select">
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
										<select class="shop-select">
											<option value="1">9</option>
											<option value="1">15</option>
											<option value="1">24</option>
											<option value="1">30</option>
											<option value="1">45</option>
										</select>
									</div>
									<!-- pagination -->
									<div class="shop-pagination">
										<ul>
											<li class="active"><a href="#">1</a></li>
											<li><a href="#">2</a></li>
											<li><a href="#">3</a></li>
											<li><a href="#"><i class="sp-arrow-bold-right"></i></a></li>
										</ul>
									</div>
								</div>
								<!-- product-toolbar end -->
								<!-- Shop-product start -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="grid-view">
										<div class="row shop-grid">
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
                                            
											<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
												<div class="single-product">
													<div class="product-photo">
														<a href="#">
															<img class="primary-photo" src="./product_img/<?=$product_img?>" alt="" />
															<img class="secondary-photo" src="./product_img/<?=$product_img?>" alt="" />
														</a>
														<div class="pro-action">
															<a href="#" class="action-btn"><i class="sp-heart"></i><span>Wishlist</span></a>
															<a href="#" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
															<a href="#" class="action-btn"><i class="sp-compare-alt"></i><span>Compare</span></a>
														</div>
													</div>
													<div class="product-brief">
														<h2><a href="#"><?=$producturl1;?></a></h2>
														<h3>$500.00</h3>
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

  
 $producturl1=preg_replace('/[^A-Za-z0-9\-]/', '-', $product_row['product_name']);
 
 $producturl1=str_replace('--', '-', $producturl1);
   $producturl1=strtolower(rtrim($producturl1, "-"));
	   
	   ?>
                                    
                                            
                                            <!-- Single-product start -->
											<div class="col-md-12">
												<div class="single-product">
													<div class="product-photo">
														<a href="#">
															<img class="primary-photo" src="./product_img/<?=$product_img?>" alt="" />
															<img class="secondary-photo" src="./product_img/<?=$product_img?>" alt="" />
														</a>
														<div class="pro-action">
															<a href="#" class="action-btn"><i class="sp-heart"></i><span>Wishlist</span></a>
															<a href="#" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
															<a href="#" class="action-btn"><i class="sp-compare-alt"></i><span>Compare</span></a>
														</div>
													</div>
													<div class="product-brief">
														<h2><a href="#"><?=$producturl1;?></a></h2>
														<h3>$500.00</h3>
														<div class="porduct-desc">
															<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, temporamet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
														</div>
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
										<select class="shop-select">
											<option value="1">default</option>
											<option value="1">default</option>
											<option value="1">default</option>
											<option value="1">default</option>
											<option value="1">default</option>
										</select>
									</div>
									<div class="short-by showing hidden-xs">
										<span>showing</span>
										<select class="shop-select">
											<option value="1">9</option>
											<option value="1">15</option>
											<option value="1">24</option>
											<option value="1">30</option>
											<option value="1">45</option>
										</select>
									</div>
									<!-- Pagination -->
									<div class="shop-pagination">
										<ul>
											<li class="active"><a href="#">1</a></li>
											<li><a href="#">2</a></li>
											<li><a href="#">3</a></li>
											<li><a href="#"><i class="sp-arrow-bold-right"></i></a></li>
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
							<div class="best-product-banner">
								<a href="#"><img src="/shopick/img/banner/best-product-banner.jpg" alt="" /></a>
							</div>
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
							<div class="banner-photo">
								<a href="#"><img src="/shopick/img/banner/4.jpg" alt="" /></a>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="banner-6">
								<div class="section-title-2">
									<h2 class="border-left-rights">product description</h2>
								</div>
								<h3><a href="#">Slim Oxford Shirt</a></h3>
								<span class="main-price">$144.44</span> <span class="old-price-2">$288.00</span>
								<p>An oxford shirt sharp and reliable essential. durable woven texture in premium two-ply cotton, it is the perfect complement to suiting and urban knits. </p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- BANNER-AREA END -->
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
									<p>w/ $35 order</p>
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
									<p>(847)621-2289 </p>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="single-service">
								<div class="service-icon">
									<i class="sp-business"></i>
								</div>
								<div class="service-brief">
									<h3>High quality guarantee</h3>
									<p>&nbsp;</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- SERVICE-AREA END -->
		</section>
		<!-- PAGE-CONTENT END -->
		
		<!-- FOOTER-AREA START -->
		 <div class="col-lg-12" style="margin:0px; padding:0px" >
<?php include'foot-new.php'?>
</div>


    </body>
</html>

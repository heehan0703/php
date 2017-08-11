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
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"atsho1IWNa10WR", domain:"ebha.fahair.com",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=atsho1IWNa10WR" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Enterprise of Black Hair Alliance(EBHA): Wigs,Hair Weaves,Remy Hair,Lace Front Wig,Human hair wigs,Lace wigs,top pieces,Hair top pieces </title>
<meta charset="utf-8">
<meta name="google-site-verification" content="IPN9G8baQEC_AcYXBpt6JNWitx7C6-1sLG8Ft1Ok_HE" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="Robots" content="All">
<meta name="Description" content="BLACKS DO, BLACK BUSINESS">
<meta name="Keywords" content="Wigs,Hair Weaves,Remy Hair,Lace Front Wig,Human hair wigs,Lace wigs,top pieces,Hair top pieces Enterprise of Black Hair Alliance(EBHA)">
<link href="https://plus.google.com/https://plus.google.com/106349946779034831935" rel="publisher" />
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
       <!-- <link rel="stylesheet" href="shopick/style.css"> -->
		 <link rel="stylesheet" href="shopick/fstyle.css"> 
		<!-- responsive css -->
        <link rel="stylesheet" href="shopick/css/responsive.css">
		<!-- modernizr css -->
        <script src="shopick/js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script language="javascript">
		$(document).ready(function() {

    $("#subbuttonnew").click(function () {
 var email=document.getElementById('subscrib').value;
 var str=email;
 var valid=1;
		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		
	   	       if(email=='' || email==' ')
			       {
					alert("Please Enter Your Email Address");
					document.getElementById('subscrib').focus();
					valid=0;
					return false
					}
				if (str.indexOf(at)==-1){
					alert('Please Insert a valid  email address');
					document.getElementById("subscrib").focus();
					valid=0;
					return false
					}
				if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
					alert('Please Insert a valid  email address');
					document.getElementById("subscrib").focus();
					valid=0;
					return false
					}
				if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
					alert('Please Insert a valid  email address');
					document.getElementById("subscrib").focus();
					valid=0;
					return false
					}
				if (str.indexOf(at,(lat+1))!=-1){
					alert('Please Insert a valid  email address');
					document.getElementById("subscrib").focus();
					valid=0;
					return false
					}
				if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
					alert('Please Insert a valid  email address');
					document.getElementById("subscrib").focus();
					valid=0;
					return false
					}
				if (str.indexOf(dot,(lat+2))==-1){
					alert('Please Insert a valid  email address');
					document.getElementById("subscrib").focus();
					valid=0;
					return false
					}
				if (str.indexOf(" ")!=-1){
					alert('Please Insert a valid  email address');
					document.getElementById("subscrib").focus();
					valid=0;
					return false
					}
			if(valid){		
       $.ajax({
  type: "POST",
  url: "ajax-subscribe.php",
  data: {email: email},
  success: function(){ 
  $(".subscribe-brief").html("You have subscribed sucessfully .Thank You");
  $('#subscrib').val("");
  
  }
     });
	 }  
    });
});
		
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
        
     <script src="js_page/index.js"></script>   

<script language="javascript">
function test(event)
{
  if(event.keyCode==13){
   check();
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

/*----------------------------------
 9. Testimonials-Area
----------------------------------*/
.testimonials-area {
	background: rgba(0, 0, 0, 0) url("img/bg/testimonial-bg.jpg") no-repeat scroll center center / cover;
	overflow: hidden;
	position: relative;
	background-image: url(images/EBHA_BOBSA_W.png);
}
.testimonials-area .testimonials{
  background: rgba(0, 0, 0, 0.8) ;
  padding: 70px 0;
}
.testimonials-area .container {position: relative;}
.testimonials-area .container::before, .testimonials-area .container::after {
  content: "";
  display: block;
  height: 100%;
  position: absolute;
  top: 0;
  width: 100%;
  z-index: 999;
}

.upcomming-product-area {
  margin-top: 55px;
  position: relative;
}
.upcomming-product {
  padding: 0;
  position: relative;
}
.upcomming-product::before {
  background: #000 none repeat scroll 0 0;
  content: "";
  height: 100%;
  opacity: 0.7;
  position: absolute;
  width: 100%;
}
.upcomming-about {
  position: absolute;
  right: 250px;
  top: 50%;
  transform: translateY(-50%);
  width: 502px;
}
.upcomming-product.upcomming-product-2 .upcomming-about {
  left: 250px;
}
.upcomming-about h2 {
  color: #fff;
  font-size: 48px;
  font-weight: 900;
  line-height: 52px;
  margin-bottom: 25px;
  text-transform: uppercase;
}
.upcomming-about p {
  color: #fff;
  margin-bottom: 35px;
}
.shop-now i {
  border-left: 1px solid #fff;
  display: inline-block;
  float: right;
  font-size: 24px;
  height: 32px;
  line-height: 31px;
  width: 33px;
  transition: all 0.3s ease 0s;
}
.shop-now:hover i {
  border-left: 1px solid transparent;
}
.count-down {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translateY(-50%) translateX(-50%);
}
.count-down .timer {
  overflow: hidden;
  width: 200px;
}
.cdown {
  background: #32c4d1 none repeat scroll 0 0;
  color: #fff;
  float: left;
  font-size: 35px;
  font-weight: 900;
  height: 100px;
  line-height: 39px;
  padding-top: 15px;
  text-align: center;
  width: 50%;
}
.cdown p {
  margin:0;
  font-size:24px;
  line-height: 28px;
  font-weight:normal;
  text-transform: capitalize;
}
.cdown.hour, .cdown.minutes {
	background: #fff;
	color: #32c4d1;
}


</style>

<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js gt-ie8">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Poison</title>

<!--=================================
Meta tags
=================================-->

<meta name="description" content="">
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta name="viewport" content="minimum-scale=1.0, width=device-width, maximum-scale=1, user-scalable=no" />

<!--=================================
Style Sheets
=================================-->
<!--Google Fonts-->
<link href="css" rel='stylesheet' type='text/css'>
<link href="css" rel='stylesheet' type='text/css'>
<!--Plugins CSS Files-->
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/owl.theme.css">
<link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="assets/css/owl.transitions.css">
<link rel="stylesheet" type="text/css" href="assets/css/jquery.vegas.css">
<link rel="stylesheet" type="text/css" href="assets/css/animations.css">
<link rel="stylesheet" type="text/css" href="assets/css/bigvideo.css">
<link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
<!--custom styles for Poison-->
<link rel="stylesheet" href="assets/css/main.css">

<!--
<link rel="stylesheet" type="text/css" href="assets/css/colors/color1.css">
<link rel="stylesheet" type="text/css" href="assets/css/colors/color2.css">
<link rel="stylesheet" type="text/css" href="assets/css/colors/color3.css">
<link rel="stylesheet" type="text/css" href="assets/css/colors/color4.css">
<link rel="stylesheet" type="text/css" href="assets/css/colors/color5.css">
<link rel="stylesheet" type="text/css" href="assets/css/colors/color6.css">
<link rel="stylesheet" type="text/css" href="assets/css/colors/color7.css">
-->


<script src="assets/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>

<body data-spy="scroll" data-target="#sticktop" data-offset="70">
<!--=====================================
Preloader
========================================-->
<div id="jSplash">
	<figure class="preload_logo">
		<img src="assets/img/basic/logo2.png" alt=""/>
	</figure>
</div>
<div class="wide_layout box-wide">
    <!--=================================
    Vegas Slider Images 
    =================================-->
    <ul class="vegas-slides hidden" data-speed="6000">
      <li><img data-fade='2000' src="assets/img/BG/banner1.jpg" alt="" /></li>
      <li><img data-fade='2000' src="assets/img/BG/parallax2.jpg" alt="" /></li>
      <li><img data-fade='2000' src="assets/img/BG/banner3.jpg" alt="" /></li>
      <li><img data-fade='2000' src="assets/img/BG/parallax5.jpg" alt="" /></li>
    </ul>
    <!--================
     Banner
    ====================-->
    <section id="section_1" class="banner hero_section">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="hero_content animatedParent animateLoop">
              <h1 class="animated bounceInDown">EBHA<span class="primary_color">.</span></h1>
              <h4 class="animated bounceInLeft ">Enterprise of Black Hair Alliance</h4>
              <a class="ScrollTo animated bounceInUp" href="#section_2"><i class="fa fa-angle-down"></i></a> 
           </div>
          </div>
        </div>
      </div>
           
     <!--=================================
    JPlayer (Audio Player)
    =================================-->
      <!--Do not edit this section Unless you have to modify HTML structure of Playlist-->
      <div class="rock_player pre_sticky">
      <div class="sticky_player" data-sticky="true">
        <div class="play_list" style="background-color:rgb(204,19,19); padding-top:20px; padding-bottom:20px; width:100%; display:none; position:absolute; left:0; bottom:100%; z-index:1;">
          <div class="list_scroll" style="overflow:hidden;">
            <div class="container ">
              <ul class="music_widget player_data">
                <li class="music_row_header">
                  <div class="column_one"> # </div>
                  <div class="column_two"> &nbsp;<!--no header for picture column--> 
                  </div>
                  <div class="column_three"> track name </div>
                  <div class="column_four"> genre </div>
                  <div class="column_five"> composer </div>
                  <div class="column_six"> length </div>
                  <div class="column_seven"> &nbsp;<!--no header for play column--> 
                  </div>
                  <div class="column_eight"> &nbsp;<!--no header for btn column--> 
                  </div>
                </li>
                <li class="music_row">
                  <div class="column_one track_index"></div>
                  <div class="column_two track_thumb"></div>
                  <div class="column_three track_title"></div>
                  <div class="column_four track_genre"></div>
                  <div class="column_five track_composer"></div>
                  <div class="column_six track_length"></div>
                  <div class="column_seven"> <a class="play_it" href="#"><span class="fa fa-play"></span></a> <a href="#"><span class="fa fa-plus"></span></a> <a class="itunesLink" href="#"><span class="fa fa-download"></span></a> </div>
                  <div class="column_eight"> <a class="btn btn_watch_video" href="#">watch video</a> </div>
                </li>
                <!--music row-->
                
                <li class="music_row">
                  <div class="column_one track_index"></div>
                  <div class="column_two track_thumb"></div>
                  <div class="column_three track_title"></div>
                  <div class="column_four track_genre"></div>
                  <div class="column_five track_composer"></div>
                  <div class="column_six track_length"></div>
                  <div class="column_seven"> <a class="play_it" href="#"><span class="fa fa-play"></span></a> <a href="#"><span class="fa fa-plus"></span></a> <a class="itunesLink" href="#"><span class="fa fa-download"></span></a> </div>
                  <div class="column_eight"> <a class="btn btn_watch_video" href="#">watch video</a> </div>
                </li>
                <!--music row-->
                <li class="music_row">
                  <div class="column_one track_index"></div>
                  <div class="column_two track_thumb"></div>
                  <div class="column_three track_title"></div>
                  <div class="column_four track_genre"></div>
                  <div class="column_five track_composer"></div>
                  <div class="column_six track_length"></div>
                  <div class="column_seven"> <a class="play_it" href="#"><span class="fa fa-play"></span></a> <a href="#"><span class="fa fa-plus"></span></a> <a class="itunesLink" href="#"><span class="fa fa-download"></span></a> </div>
                  <div class="column_eight"> <a class="btn btn_watch_video" href="#">watch video</a> </div>
                </li>
                <!--music row-->
                <li class="music_row">
                  <div class="column_one track_index"></div>
                  <div class="column_two track_thumb"></div>
                  <div class="column_three track_title"></div>
                  <div class="column_four track_genre"></div>
                  <div class="column_five track_composer"></div>
                  <div class="column_six track_length"></div>
                  <div class="column_seven"> <a class="play_it" href="#"><span class="fa fa-play"></span></a> <a href="#"><span class="fa fa-plus"></span></a> <a class="itunesLink" href="#"><span class="fa fa-download"></span></a> </div>
                  <div class="column_eight"> <a class="btn btn_watch_video" href="#">watch video</a> </div>
                </li>
                <!--music row-->
                <li class="music_row">
                  <div class="column_one track_index"></div>
                  <div class="column_two track_thumb"></div>
                  <div class="column_three track_title"></div>
                  <div class="column_four track_genre"></div>
                  <div class="column_five track_composer"></div>
                  <div class="column_six track_length"></div>
                  <div class="column_seven"> <a class="play_it" href="#"><span class="fa fa-play"></span></a> <a href="#"><span class="fa fa-plus"></span></a> <a class="itunesLink" href="#"><span class="fa fa-download"></span></a> </div>
                  <div class="column_eight"> <a class="btn btn_watch_video" href="#">watch video</a> </div>
                </li>
                <!--music row-->
              </ul>
              <!--music_widget--> 
            </div>
            <!--container--> 
          </div>
        </div>
		     
            <a href="#" class="playlist_expander fa fa-bars"></a> </div>
        </div>
      </div></div>
    </section>
	    <!--//banner--> 
    <!--=========================
     Header
    ===========================-->
    <header>
      <nav id="sticktop" class="navbar navbar-default" data-sticky="true">

<?php include'header-new.php'?>
<div>



<!-- PAGE-CONTENT START -->
		<section class="page-content">
			<!-- SLIDER-AREA START -->
			<div class="slider-area margin-bottom-80">
				<div class="bend niceties preview-2">
					<div id="ensign-nivoslider" class="slides">	
					     <img src="fa_hair_title4.jpg" alt="" title="#slider-direction-1"  />
						<img src="fa_hair_title1.jpg" alt="" title="#slider-direction-2"  />
									<img src="fa_hair_title3.jpg" alt="" title="#slider-direction-3"  />
					</div>
					<!-- direction 1 -->
					<div id="slider-direction-1" class="t-cn slider-direction">
						<div class="slider-progress"></div>
						<div class="slider-content t-lfl s-tb">
							<div class="title-container s-tb-c title-compress">
								<div class="slider-1">
									<div class="wow fadeInUpBig" data-wow-duration="1.2s" data-wow-delay="0.5s">
										<h1 class="title1">Enterprise of Black Hair Alliance(EBHA)</h1>
                                        <BR><!--<IMG SRC="images/EBHA_BOBSA-01.png">-->
									</div>
									<div class="image wow fadeInUpBig" data-wow-duration="1.5s" data-wow-delay="0.7s">
										<span><a href="http://ebha.fahair.com/"><img src="slider-border.png" alt="" border="0" /></a></span>
									</div>
									<div class="wow fadeInUpBig" data-wow-duration="1.8s" data-wow-delay="0.9s">
										<p class="slider-brief">Dedicated to a shared effort to create and develop <br>a beauty industry that bridges with the black community</p>
									</div>
									<div class="wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="1.1s">
										<a href="http://ebha.fahair.com/" class="shop-now">shop now</a>
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
										<h1 class="title1"><font color="#FFFFFF">The Best Hair Wholesaler </font></h1><BR><!--<IMG SRC="images/EBHA_BOBSA_W.png">-->
									</div>
									<div class="image wow fadeInUpBig" data-wow-duration="1.5s" data-wow-delay="0.7s">
										<span><a href="http://ebha.fahair.com"><img src="slider-border.png" alt="" border="0" /></a></span>
									</div>
									<div class="wow fadeInUpBig" data-wow-duration="1.8s" data-wow-delay="0.9s">
										<p class="slider-brief">Assistance with Opening a Beauty Supply,<br>
Store or an Online Beauty Supply Store, <br>
Receive management and technical Support.</p><BR>
									</div>
									<div class="wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="1.1s">
										<a href="http://ebha.fahair.com/braids/" class="shop-now">shop now</a>
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
										<h1 class="title1">Weaves,Wigs,Braids&amp;Pieces</h1><BR>
									</div>
									<div class="image wow fadeInUpBig" data-wow-duration="1.5s" data-wow-delay="0.7s">
										<span><a href="http://ebha.fahair.com/wigs/"><img src="slider-border.png" alt="" border="0" /></a></span>
									</div>
									<div class="wow fadeInUpBig" data-wow-duration="1.8s" data-wow-delay="0.9s">
										<p class="slider-brief">100% human hair product.</p>
									</div>
									<div class="wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="1.1s">
										<a href="http://ebha.fahair.com/wigs/" class="shop-now">shop now</a>
									</div>
								</div>
							</div>
						</div>		
					</div>
				</div>			
			</div>
			<!-- SLIDER-AREA END -->
			<!-- BANNER-AREA START -->
		<!--	<div class="banner-area fix margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<div class="single-banner fix">
								<div class="banner-photo padding-0 pull-left col-md-6 col-sm-6 col-xs-12">
									<a href="http://ebha.fahair.com/andrea-silky-virgin-human-hair-weaving-16-24-33.html"><img src="images/fahair_silky_banner.jpg" alt="andrea silky weaving" border="0" /></a>
								</div>
								<div class="banner-brief banner-brief-right col-md-6 col-sm-6">
									<h2>Luxary<span> Silky Weaving </span></h2>
									<h2 class="line-bottom"><span> 100% </span> VIRGIN REMY HUMAN HAIR</h2>
									<a href="http://ebha.fahair.com/andrea-silky-virgin-human-hair-weaving-16-24-33.html" class="shop-now">shop now</a>
								</div>
							</div>
							<div class="single-banner fix">
								<div class="banner-brief banner-brief-left col-md-6 col-sm-6">
									<h2>Sheree <span> Silky Yaky </span></h2>
									<h2 class="line-bottom"><span> 100% </span> BRAZILIAN HUMAN HAIR</h2>
									<a href="http://ebha.fahair.com/weaves/human-hair-weaves/" class="shop-now">shop now</a>
								</div>
								<div class="banner-photo padding-0 pull-right col-md-6 col-sm-6 col-xs-12">
									<a href="http://ebha.fahair.com/weaves/human-hair-weaves/"><img src="images/fahair_sheree_blue.jpg" alt="SHEREE BRAZILIAN HUMAN HAIR" border="0" /></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> -->
			<!-- BANNER-AREA END -->
            <div class="col-lg-12 col-md-12 col-sm-12" style="margin:0px; padding:0px;">
            
                    <div   class="col-lg-2 col-md-12 col-sm-12">
                   <!-- left-->
                    </div>
                    <div  class="col-lg-8 col-md-12 col-sm-12">
                    <!-- NEW-COLLECTION START -->
			<div class="new-collection-area fix margin-bottom-80">
				
				<div class="col-lg-4 col-md-6 col-sm-6 padding-0">
					<div class="single-collection">
						<div class="collection-photo">
							<a href="http://ebha.fahair.com/top-pieces/"><img src="EBHA_EVOTWIN.jpg" alt="" border="0" /></a>
						</div>
						<div class="collection-brief">
							<div class="text-right">
								<span class="new">new WIGS</span>
							</div>
							<!--<h2>EBHA</h2>
							<ul>
								<li>EBHA</li>
								
						  </ul>-->
						  <a href="http://ebha.fahair.com/top-pieces/" class="shop-now active-shop-now">shop now</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-6 padding-0">
					<div class="single-collection">
						<div class="collection-photo">
							<a href="http://ebha.fahair.com/wigs/"><img src="EBHA_DEJA.jpg" alt="" border="0" /></a>
						</div>
					  <div class="collection-brief">
							<div class="text-right">
								<span class="new">new WEFT</span>
							</div>
							<!--<h2>EBHA</h2>
						  <ul>
							  <li>100% HUMAN HAIR</li>
					    </ul>-->
						  <a href="http://ebha.fahair.com/wigs/" class="shop-now active-shop-now">shop now</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 hidden-md hidden-sm padding-0 ">
					<div class="single-collection">
						<div class="collection-photo">
							<a href="http://ebha.fahair.com/wigs/"><img src="EBHA_BRAID.jpg" alt="" border="0" /></a>
						</div>
					  <div class="collection-brief">
							<div class="text-right">
								<span class="new">new BRAID</span>
							</div>

   <!--<div Align="RIGHT"> <h2>EBHA </div>
  <li>HIGH-FIBER SYNTHETIC WIGS</li>-->
</ul>
						  <a href="http://ebha.fahair.com/wigs/" class="shop-now active-shop-now">shop now</a>
						</div>
					</div>
				</div>
		  </div>
			<!-- NEW-COLLECTION END -->
                    </div>
                    <div  class="col-lg-2 col-md-12 col-sm-12 bigscreen" style="text-align:center; margin-top:0; margin-right:auto; margin-bottom:0; margin-left:auto;">
                             

               <!-- Place this tag in your head or just before your close body tag. -->
<script src="https://apis.google.com/js/platform.js" async defer></script>

<!-- Place this tag where you want the widget to render. -->
<div class="g-page" data-width="200" data-href="//plus.google.com/u/0/106349946779034831935" data-rel="publisher"></div>


                    </div>
            
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12">
            
                    <p>&nbsp;</p>
                    <div   class="col-lg-2 col-md-12 col-sm-12">
                    <!-- left part  -->
                    </div>
                    <div  class="col-lg-8 col-md-12 col-sm-12 text-center">
                    <!-- PRODUCT-AREA START -->
			
            
            <!-- BEST-SELL-AREA START -->
			<div class="best-sell-area fix style-2">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
							<div class="section-title-2" style="margin-left:-130px;">
								<h2 class="border-left-rights" style="border-bottom:2px solid #000000;">BEST SELL PRODUCTS</h2>
							</div>
						</div>
						<div class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
							<!-- best-sell-menu -->
							<ul role="tablist" class="">
								<!--<li role="presentation" class="active"><a href="#men" role="tab" data-toggle="tab">Men</a></li>
								<li role="presentation"><a href="#women"  role="tab" data-toggle="tab">Women</a></li>
								<li role="presentation"><a href="#accessories"  role="tab" data-toggle="tab">Accessories</a></li>-->
							</ul>
							<!-- best-sell-product -->
						</div>
					</div>				
					<div class="row">
						<div class="col-md-12">
							<div class="tab-content best-sell-product">
								<div role="tabpanel" class="tab-pane fade in active" id="men">
									<div class="row">
										<div class="active-best-sell navigation-top-right">
											<div class="col-md-12">
												<!-- Single-product start -->
                                                <!-- Single-product start -->
																	<? 
                                                                    $i=0;
                                                                    while($new_arrival1=mysql_fetch_assoc($best_sale_query)){
                                                                    $i++;
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
															<img class="primary-photo" src="../../../../thumbnail-new-all.php?thumb=<?=$new_arrival1_img?>" alt="" />
															<img class="secondary-photo" src="../../../../thumbnail-new-all.php?thumb=<?=$new_arrival1_img?>" alt="" />
														</a>
														<div class="pro-action">
														<a href="/<?=$producturl1?>-<?=$new_arrival1['id']?>.html" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
														
														</div>
													</div>
													<div class="product-brief">
														<h2><a href="#"><?=$new_arrival1['product_name']?></a></h2>
														<div class="product-brief-inner">
															<!-- <h3>$500.00</h3> -->
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
                                                <? if($i==2) { $i=0;?>
                                                </div>
                                                <div class="col-md-12">
                                                <? } ?>
                                               <? } ?> 
												<!-- Single-product end -->
												
											</div>
																					
										</div>
									</div>
								</div>
								
								
							</div>
						</div>
					</div>
				</div>
			</div>
           
            
			<!-- PRODUCT-AREA END -->
                    </div>
                    
                     
                    <div  class="col-lg-2 col-md-12 col-sm-12 bigscreen" style="text-align:center; margin-top:0; margin-right:auto; margin-bottom:0; margin-left:auto;">
                   
                   <!-- facebook widget --->
                   <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=472642119533141";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-page" data-href="https://www.facebook.com/Ebhahair-Community-1719560798365150/" data-tabs="timeline" data-width="200" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Ebhahair-Community-1719560798365150/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Ebhahair-Community-1719560798365150/">Ebhahair-Community</a></blockquote></div>
                   
                   
                    </div>
            
            </div>
            
			
			
			<!-- PROMOTIONAL-BANNER START -->
			<!--<div class="promotional-banner-area clearfix margin-bottom-80">
				<div class="promotional-banner">-->
					<!-- Single-promo start -->
					<!-- <div class="col-md-6 col-sm-12 padding-0">
						<div class="single-promo-banner promo-banner-1">-->
							<!--<img src="images/fahair_sale_banner.jpg" alt="" />--> 
                             
						  <!--<div class="promo-banner-brief">
								<h2>sale !</h2>
								<h3>up to <span>30%</span>  off</h3>
								<h4>best products</h4>
								<a class="shop-now active-shop-now" href="#">shop now</a>
							</div>
						</div>
					</div>-->
					<!-- Single-promo End -->
					<!-- Single-promo start -->
					<!-- <div class="col-md-6 col-sm-12 padding-0">
						<div class="single-promo-banner promo-banner-2">-->
							<!--<img src="images/fahair_sale_banner2.jpg" alt="" /> -->
						  <!--<div class="promo-banner-brief">
								<div class="count-down">
									<div class="timer">
										<div data-countdown="2020/12/31"></div>
									</div> 
								</div>-->
								<!--<div class="upcomming-brief">
								 <h2>upcomming best collection</h2>
								 <h3><span>Heat Frienly</span> wigs collection</h3>
								
								 <a class="shop-now" href="#">pre order</a>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>-->
			<!-- PROMOTIONAL-BANNER END -->--&gt;
<!-- TESTIMONIALS-AREA START -->
			<div class="testimonials-area style-2">
				<div class="testimonials">
					<div class="container">
						<div class="row">
							<div class="active-testimonial-carousel navigation-bottom">
								<div class="col-md-12">
									<div>
										<font color="white"><h1><b>Mission Statement</b></h1>
										<h3><img src="EBHA_BOBSA_W.png" alt="" />										</h3>
										<p>MISSION STATEMENT<br>
										  Enterprise of Black Hair Alliance(EBHA) is dedicated to a  shared effort to create and develop a beauty industry that bridges with the  black community. Our vision embraces the belief that our alliance will provide  meaningful opportunities for all parties to generate revenues and manifest  premium products and brands. <br>
									    Our collaboration will enable the black community to fully  realize the potential opportunities in committing to the creation of industry  brands that will bring price and recognition to everyone involved in this  collaboration. </p></font>
</div>
								</div>
								<div class="col-md-12">
									<div>
									<font color="white"><h1><b>Vision Statement</b></H1>
										<h3>&nbsp;</h3>
										<div class="author-photo">
											<img src="EBHA_BOBSA_W.png" alt="" />
										</div>
										<p>VISION STATEMENT<br>
									    Collectively, now is the time to boldly go ¡°outside the box¡±  to realize and embrace a set of objectives that will insure a strong business  future for the black community. Yes, we can do it collectively!</p></font>
</div>
							  </div>
						  </div>
						</div>
					</div>
				</div>
			</div>
			<!-- TESTIMONIALS-AREA END -->
			<!-- BEST-SELL-AREA START -->
			<div class="best-sell-area">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="section-title-2" style="margin-left:-130px;">
								<h2 class="border-left-rights" style="border-bottom:2px solid #000000;">New Arrivals</h2>
							</div>
						</div>
					</div>				
					<div class="row">
						<div class="col-md-12">
							<!-- best-sell-menu -->
							<!--<ul role="tablist" class="best-sell-menu">
								<li role="presentation" class="active"><a href="#men" role="tab" data-toggle="tab">Men</a></li>
								<li role="presentation"><a href="#women"  role="tab" data-toggle="tab">Women</a></li>
								<li role="presentation"><a href="#accessories"  role="tab" data-toggle="tab">Accessories</a></li>
							</ul>-->
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
														<img class="primary-photo" src="../../../../thumbnailindex-new-2.php?thumb=<?=$new_arrival1_img?>" alt="" style="WIDTH:300px;"/>
														<img class="secondary-photo" src="../../../../thumbnailindex-new-2.php?thumb=<?=$new_arrival1_img?>" alt="" style="WIDTH:300px;" />
													</a>
													<div class="pro-action">
														
														<a href="/<?=$producturl1?>-<?=$new_arrival1['id']?>.html" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
														
													</div>
												</div>
												<div class="product-brief">
													<h2><a href="/<?=$producturl1?>-<?=$new_arrival1['id']?>.html"><?=$new_arrival1['product_name']?></a></h2>
													<div class="product-brief-inner">
														<!--<h3>$<?php echo $new_arrival1['msrp_price']?></h3>-->
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
								
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- BEST-SELL-AREA END -->
			<!-- ALL-PRODUCT-VIEW START --><!-- ALL-PRODUCT-VIEW END -->
			<!-- FEATURED-AREA START --><!-- FEATURED-AREA END -->
			<!-- BRAND-LOGO-AREA START --><!-- BRAND-LOGO-AREA END -->
			<!-- TESTIMONIALS-AREA START -->
			<div class="testimonials-area style-2">
				<div class="testimonials">
					<div class="container">
						<div class="row">
							<div class="active-testimonial-carousel navigation-bottom">
								<div class="col-md-12">
									<div class="single-testimonial"><font color="#FFFFFF">
										<H1>Why partner with EBHA ?</H1></font>
										<h3><img src="EBHA_BOBSA_W.png" alt="" />										</h3>
										<font color="#FFFFFF">
										<p><br>
										
Assistance with opening a beauty supply, Store or an Online Beauty Supply Store, Receive management and technical support, website hosting, certificate of membership EBHA decal, The circle Newsletter National/International Exposure Access to Exclusive Products.

In addition to exclusive benefits for beauty supply store owners, beauty distributors, manufactures, Distributors/Wholesalers, Salons, Braiding Specialists, Barber Students. </p></font>
</div>
								</div>
								<div class="col-md-12">
									<div class="single-testimonial">
										<font color="#FFFFFF"><h1>Purpose</h1></font>
										<h3>&nbsp;</h3>
										<div class="author-photo"><img src="EBHA_BOBSA_W.png" alt="" /></div>
									<font color="#FFFFFF">	
									  
-To establish the EBHA school of Cosmetology:

How? This is really where it all starts. EBHA will establish a beauty school with the development of a strong education team that knows about hair as well as how to instruct new entrepreneurs in all aspects of retailing, areas that are lacking in salons and barber shops. 
The EBHA professional staff will change the culture of the salon and barber shop business mindset by transforming their thinking to become more business minded to insure success.
To establish the EBHA beauty Academy:
How? Working closely with public high schools and community colleges in selected areas in the united states, EBHA would serve as boot camps in the public education arenas. </font>
</div>
							  </div>
						  </div>
						</div>
					</div>
				</div>
			</div>
			<!-- TESTIMONIALS-AREA END -->
			<!-- SERVICE-AREA START -->
            
            
            <BR><Br>
            
		  <div class="service-area margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="single-service">
								<div class="service-icon">
									<i class="sp-transport"></i>
								</div>
								<div class="service-brief">
									<h3>EBHA</h3>
									<p>EBHA!!!! </p>
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
									<p>info@ebhahair.com</p>
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
			<!-- SERVICE-AREA END --><!-- BLOG-AREA END -->
			<!-- SUBSCRIBE-AREA START -->
			<div class="suscribe-area margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="subscribe">
								<div class="subscribe-brief">
									<h3>enter your email address</h3>
									<p>Join Fa fashion News letter, We will send new products infomation, coupons, etc..</p>
								</div>
								<div class="subscribe-form">
								<!--	<form action="#"> -->
										<input type="text" placeholder="Enter email to subscribe" id="subscrib" value="" />
										<button type="submit" id="subbuttonnew">Submit</button>
								<!--	</form>  -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- SUBSCRIBE-AREA START END -->
		</section>
		<!-- PAGE-CONTENT END -->

  

 <div  class="col-lg-0col-md-12 col-sm-12 smallscreen" style="text-align:center; margin-top:0; margin-right:auto; margin-bottom:0; margin-left:auto;">
  <!-- Place this tag in your head or just before your close body tag. -->
<script src="https://apis.google.com/js/platform.js" async defer></script>

<!-- Place this tag where you want the widget to render. -->
<div class="g-page" data-width="200" data-href="//plus.google.com/u/0/106349946779034831935" data-rel="publisher"></div>

 <!-- facebook widget --->
                   <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=472642119533141";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-page" data-href="https://www.facebook.com/Ebhahair-Community-1719560798365150/" data-tabs="timeline" data-width="200" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Ebhahair-Community-1719560798365150/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Ebhahair-Community-1719560798365150/">Ebhahair-Community</a></blockquote></div>

 </div>








  <div class="col-lg-12" style="margin:0px; padding:0px;">
<?php include'foot-new.php'?>
</div>
  <!--login popup start-->

  
  
</body>
</html>

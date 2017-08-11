<?php
session_start();
//print_r($_SESSION);
require_once('wp-admin/include/connectdb.php');
$getid=$_GET['id'];
$latlog=mysql_fetch_assoc(mysql_query("select * from store where id='$getid'"));
$lat=$latlog['lat'];
//echo $lat;
$lng=$latlog['lng'];
$_SESSION['member_id'];
//echo $lng;
if($_GET['mystore']==true)
{
$_SESSION['my_shop']=$getid;
	if($_SESSION['member_id']){
	$userid=$_SESSION['member_id'];
	mysql_query("update member set my_shop='$getid' where member_id='$userid'");
	}
}
?>
<html>
<head>
<!doctype html>
<html class="no-js" lang="">
    <head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>100-bulk-human-hair-wholesale- About FaHair.com</title>

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
		<!-- modernizr css -->
         <base href="/" />
        <script src="/shopick/js/vendor/modernizr-2.8.3.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">


   
function show_content(cls){
$("."+cls).show(0);
}
function hide_content(cls){
	$("."+cls).hide(0);
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
	content: "?";
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
	list-style: outside none none;
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
	border-right: 0px;
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
}
@media (min-width: 100px) and (max-width: 500px) {
.wsmenucontainer {
min-height: 0px !important; 
}

}
</style>


<link href="css/custom.css" rel="stylesheet">

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
.time{
padding-left:0px;
font-size:12px;
}
.day{
padding-left:0px;
font-size:10px;
}


}

/*----------------------------------
 9. Testimonials-Area
----------------------------------*/
.testimonials-area {
	background: rgba(0, 0, 0, 0) url("img/bg/testimonial-bg.jpg") no-repeat scroll center center / cover;
	overflow: hidden;
	position: relative;
	background-image: url(images/parallax1.jpg);
}
.testimonials2 {
	background: rgba(0, 0, 0, 0) url("img/bg/testimonial-bg.jpg") no-repeat scroll center center / cover;
	overflow: hidden;
	position: relative;
	background-image: url(images/parallax2.jpg);
    padding: 70px 0
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

.owl-controls {

display:none;
}
</style>



<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>store front -EBHAHAIR.com</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<!--Bootstrap-->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyB0FmqpdpeQ_QGHTJ5q8U-nzQT0dSvjQsY&callback=initialize" async="" defer="defer" type="text/javascript"></script>
<!--<script src="https://maps.google.com/maps/api/js"></script>-->
<!-- all css here -->
<!-- AIzaSyBe4Zh7zuphzoYlo5iuBdbnZN3eu7GRP8s  -->
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
		<!-- modernizr css -->
        <script src="/shopick/js/vendor/modernizr-2.8.3.min.js"></script>

<link href="css/bootstrap.min.css" rel="stylesheet">
      
<style type="text/css">
@media (min-width: 100px) and (max-width: 500px) {
.wsmenucontainer {
min-height: 0px !important; 
}
}

</style>
 


<script  language="javascript">
var markers = new Array();
var map;
var locations = [['<?=$latlog[s_name]?>', <?=$lat?>, <?=$lng?>]];
var iconURLPrefix = 'https://maps.google.com/mapfiles/ms/icons/';

var icons = [
  iconURLPrefix + 'red-dot.png',
  iconURLPrefix + 'green-dot.png',
  iconURLPrefix + 'green-dot.png',
  iconURLPrefix + 'red-dot.png',
  iconURLPrefix + 'purple-dot.png',
  iconURLPrefix + 'green-dot.png'
]
var iconsLength = icons.length;
var myCenter=new google.maps.LatLng(<?=$lat; ?>,<?= $lng; ?>);

function initialize() {
  map = new google.maps.Map(document.getElementById('googleMap'), {
    zoom: 12,
    center: new google.maps.LatLng(<?=$lat;?>,<?=$lng;?>),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    mapTypeControl: false,
    streetViewControl: false,
    panControl: false,
    zoomControlOptions: {
      position: google.maps.ControlPosition.LEFT_BOTTOM
    }
  });
google.maps.event.addDomListener(window, "resize", function() {
   var center = map.getCenter();
   google.maps.event.trigger(map, "resize");
   map.setCenter(center); 
});


  var infowindow = new google.maps.InfoWindow({
    maxWidth: 400
  });

  var iconCounter = 0;

  // Add the markers and infowindows to the map
  for (var i = 0; i < locations.length; i++) {
    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(<?=$lat;?>, <?=$lng;?>),
      map: map,
      icon: icons[iconCounter],
      title: 'Click to zoom'
    });

    markers.push(marker);

    google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {

      return function() {
        infowindow.setContent(locations[i][0]);
        infowindow.open(map, marker);
        map.setZoom(12);
        //map.setCenter(marker.getPosition());	
      }
    })(marker, i));

    google.maps.event.addListener(marker, 'click', (function(marker, i) {

      return function() {
        infowindow.setContent(locations[i][0]);
        infowindow.open(map, marker);
        map.setZoom(12);
       // map.setCenter(marker.getPosition());
      }
    })(marker, i));


    iconCounter++;
    // We only have a limited number of possible icon colors, so we may have to restart the counter
    if (iconCounter >= iconsLength) {
      iconCounter = 0;
    }

  }
  var marker=new google.maps.Marker({
  position:myCenter,
  });

marker.setMap(map);
  autoCenter();
}
 $(document).ready(function(){
google.maps.event.addDomListener(window, 'load', initialize);
 });
 
 function triggerClick(i) {
  google.maps.event.trigger(markers[i], 'click');
  
  //map.getBounds();	
}
function autoCenter() {
  //  Create a new viewpoint bound
  var bounds = new google.maps.LatLngBounds();
  //  Go through each...
  for (var i = 0; i < markers.length; i++) {
    bounds.extend(markers[i].position);
  }
  //  Fit these bounds to the map
  map.fitBounds(bounds);
}
</script>

</head>
<body onLoad="triggerClick(0)">
<div>
<?php include'header-new.php'?>

  </div>
  <!--header start-->
 <div class="full">
  
<!--body start-->
<div class="full" style="background-color:white;">
   <?php 
     $store=mysql_fetch_assoc(mysql_query("select * from store where id='$getid'"));
   ?>    

  <div class="container">
    <div class="row" style="padding:1em;">
  <a style="color:inherit;" > target </a> /
  <a style="color:inherit;" > find a city</a>/ 
  <a style="color:inherit;"> <?=$store['s_name'];?></a>
    </div>
     <div class="row" style="padding:1em;">
     <a style="color:inherit;"> <H1><b><?= $store['s_name'];?></b></H1></a>
     </div>
  </div>
   <div class="full" style=" background:#DEDEDE; height:3px;margin:.9em 0;"></div>
  <div class="container"  style="padding-left:0px; padding-right:0px;">
    <div class="row" > 
      <!--list item start --> 
      
      <!--category and their product start-->
      <div class="full">
       <!-- left part start --> 
        <div class="col-lg-6 col-md-6">
        
       
        <br>
        <div class="full" align="center">
<div id="googleMap" style="height:380px;"></div>  
</div>
       
       </div>
         <!-- left part end --> 
          <!-- right part start --> 
        <div class="col-lg-6 col-md-12">
          <div style="width:100%">
         
              
               <div class="row" style="padding:.1em .1em;">
          <div  style="color:#999;  padding-left: 0px; padding-right: 0px;"><b>  <?=$store['s_location']?> <?=$store['s_city']?> <?=$store['s_state']?> <?=$store['zip']?></b> </div><br>
                     <p>Phone: <?=$store['s_phone']?></p>
                     <br>
                     <div class="row"><p><b>&nbsp;&nbsp;&nbsp;&nbsp;Opening Times</b> </p></div> <br>
                   <div class="row" style="margin-left:0px; margin-right:0px;padding-left:0px; padding-right:0px; text-align:center"> 
                   
                     <?php 
     $time=mysql_query("select * from store_times where store_id='$getid'");
	 
	 
	  while($times=mysql_fetch_assoc($time)){
   ?>    

 <div class="day" style=" width:30%; float:left; text-align:justify;"><b><?= $times['day']?></b> </div>
           <div class="time" style="width:70%;"><?=$times['open_time']?>&nbsp;to&nbsp;<?= $times['close_time']?>  </div>
         <?php } ?>  
         </p>
           </div>
               </div>
              
              <div class="row" style="padding:.3em .5em;"> this is my store  </div>
              
                
                  
              
             <div class="row" style=" background:#DEDEDE; height:2px;margin:.9em 0;"></div>
           
                
               <div class="row">
               
             <?php 
			 $add=mysql_fetch_assoc(mysql_query("select * from adds where store_id='$getid' order by id DESC"));
			 
			 ?>  
                              
         <div class="col-lg-4 col-sm-5 col-xs-5" ><img src="./storeadsimages/<?=$add['add_image']?>"> </div>
     <div class="col-lg-8 col-sm-5 col-xs-5" style="color:#999; ">
     <b><?=$add['add_name']?></b> <br><br> <p><a href="store_add.php?store_id=<?=$add['store_id']?>">view the ad</a></p></div>
           
               
               
               </div>  
               
             <div class="row" style=" background:#DEDEDE; height:2px;margin:.9em 0;"></div>
               
                 
                   <div class="row">
               
                <?php 
			 $coupon=mysql_fetch_assoc(mysql_query("select * from coupon where store_id='$getid' order by id DESC"));
			 
			 ?>  
                              
         <div class="col-lg-4 col-sm-5 col-xs-5" ><img src="./couponimages/<?=$coupon['image']?>" style="height:127px; width:127px;"></div>
           <div class="col-lg-8 col-sm-5 col-xs-5" style="color:#999; z-index: 1 ">
           <b><?=$coupon['code']?></b> <br><br> <p><a href="store_coupon.php?store_id=<?=$coupon['store_id']?>">view the ad</a></p></div>
           
               
               
               </div>    
                 
                   </div>
                   
         
        
       
        
          </div>
           
            
          </div>
          <!-- right part end --> 
     
          
   
        </div>
        </div>
        
        </div>
 
  </form>
</div>

<!--body end--> 

<!-- footer start-->
<div>
<?php include'foot-new.php'?>
</div>
<!--footer end  -->






<!-- bulk order start -->


</body>
</html>




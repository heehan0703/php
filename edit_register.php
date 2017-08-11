<?php
 session_start();
 
 $member_id=$_SESSION['member_id'];
 
 $GOOD_SHOP_USERID =$_SESSION['GOOD_SHOP_USERID'];
 
 require_once('wp-admin/include/connectdb.php');
 
 if($member_id==''){
header("index.php");
exit;	 
 }
 
 $country_query=$con_pdo->query("SELECT * FROM `country` where country_name!='' order by country_id ASC");
 
$user_row = mysql_fetch_assoc(mysql_query("SELECT * FROM `member` where member_id='$member_id'"));

$count_id=$user_row['country'];
$state = mysql_query("select * from state where country_id=$count_id");
// echo $state['state_name'];

$tel=explode('-',$user_row['tel']);
 
 $cel=explode('-',$user_row['cel']);
  ?>
<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Account</title>

<!-- Bootstrap -->
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

$(document).ready(function(e) {
	
	var country_name =<?=$user_row['country']?> ;
	
	if(country_name=='230'  || country_name=='45')	{
		$("#state_div").show('fast');	
				
	    	//$("#state").load("get_state.php?c_id="+country_name);
			
			}
			else{
		$("#state_div").hide('fast');		
			}
	

});


function Validate(){

var email,pass,conf_pass,country,address1,address2,city,zipcode,f_name,l_name,com_name,tel1,tel2,tel3,cel1,cel2,cel3;
email=document.getElementById('email').value;
pass=document.getElementById('pass').value;
conf_pass=document.getElementById('conf_pass').value;
country=document.getElementById('country').value;
address1=document.getElementById('address1').value;
address2=document.getElementById('address2').value;
city=document.getElementById('city').value;
zipcode=document.getElementById('zipcode').value;
f_name=document.getElementById('f_name').value;
l_name=document.getElementById('l_name').value;
com_name=document.getElementById('com_name').value;
tel1=document.getElementById('tel1').value;
tel2=document.getElementById('tel2').value;
tel3=document.getElementById('tel3').value;
cel1=document.getElementById('cel1').value;
cel2=document.getElementById('cel2').value;
cel3=document.getElementById('cel3').value;

if(email==''){
alert('Please enter email!');
document.getElementById('email').focus();
return false;

}
if(pass==''){
alert('Please enter password!');
document.getElementById('pass').focus();
return false;

}
if(conf_pass==''){
alert('Please enter confirm password!');
document.getElementById('conf_pass').focus();
return false;

}
if(conf_pass!=pass){
alert('password donot match !');
document.getElementById('conf_pass').value='';
document.getElementById('conf_pass').focus();
return false;

}
if(country==''){
alert('Please select country!');
document.getElementById('country').focus();
return false;

}
if(address1==''){
alert('Please enter address1!');
document.getElementById('address1').focus();
return false;

}
if(address2==''){
alert('Please enter address2!');
document.getElementById('address2').focus();
return false;

}
if(city==''){
alert('Please enter city!');
document.getElementById('city').focus();
return false;

}if(zipcode==''){
alert('Please enter zipcode!');
document.getElementById('zipcode').focus();
return false;

}if(f_name==''){
alert('Please enter first name!');
document.getElementById('f_name').focus();
return false;

}if(l_name==''){
alert('Please enter last name!');
document.getElementById('l_name').focus();
return false;

}if(com_name==''){
alert('Please enter company name!');
document.getElementById('com_name').focus();
return false;

}if(tel1==''){
alert('Please enter telephone number!');
document.getElementById('tel1').focus();
return false;

}if(tel2==''){
alert('Please enter telephone number!');
document.getElementById('tel2').focus();
return false;

}if(tel3==''){
alert('Please enter telephone number!');
document.getElementById('tel3').focus();
return false;

}if(cel1==''){
alert('Please enter cell number!');
document.getElementById('cel1').focus();
return false;

}if(cel2==''){
alert('Please enter cell number!');
document.getElementById('cel2').focus();
return false;

}if(cel3==''){
alert('Please enter cell number!');
document.getElementById('cel3').focus();
return false;

}


}


function check_email(){

	var email=document.getElementById('email').value;

$.post( "ajax.php", { email_check:email })
.done(function( data ) {
if(data=='1'){
	alert('Email is already  exist !')
document.getElementById('email').value='';
document.getElementById('email').focus();
return false;



}

});

}


    </script>
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
.title1{
font-size:18px;
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
	content: "";
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
.vertical-menu{
	display:none;
}
</style>
<link href="css/custom.css" rel="stylesheet">
</head>
<body>
<?php include'header-new.php'?>
<div class="full"> 
  <!--header start-->
  

<!--header end--> 

<!--body start-->
<div class="full" id="body_container">
  <div class="container">
  
    <div class="row" style="padding:1em;"> <span class="glyphicon glyphicon-home"></span>&nbsp;Home &nbsp;&nbsp;/&nbsp;Authentication<br>
      <span style="color:#222222">UPDATE AN ACCOUNT</span> </div>
    <hr>
    <div class="row" style="padding:1em 0;border:1px solid #E5E5E5; background:#FBFBFB;">
   <div class=" text-left text-uppercase" style="width:98%; margin:0 1%;">
   <h4 class="h4" style="color:#000;">Your Personal information</h4> 
   <hr> </div>
      <div class="row form-group " style="width:96%; margin:1% 2%; background:#FFF; padding:1%;">
     
	 <form name="register" action="edit_register_process.php" method="post" onSubmit="return Validate()">
        <div class="col-lg-8 col-sm-12 col-xs-12 border-bottom-small text-right-small" style="border-right:1px solid #EEEEEE;">
       <div class="full" style="width:95%; margin:0em 0em 2em 1em; margin-left:3%;">
    <span style="color:#999999; font-weight:bold;" >Update Your Account</span> &nbsp;
    <span class="dotted-class" style="width:65%;"></span>
    </div>   
      
         <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Email:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="email" name="email" id="email" value="<?=$user_row['email']?>" readonly class="form-control" onBlur="check_email()" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
            <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Create Password:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="password" name="pass" id="pass" value="<?=$user_row['pwd']?>" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
            <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Re-enter Password:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
<input type="password" name="conf_pass" id="conf_pass" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Business Location:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
         <select name="country" id="country"  class="form-control" style="width:80%">
<option value="" selected="selected">Select Country</option>		 
		
	<?php
	  while ($country_result = $country_query->fetch(PDO::FETCH_ASSOC)) {
	?>	
	<option value="<?=$country_result['country_Id']?>" <? if($user_row['country']==$country_result['country_Id']){?> selected <? }?> ><?=$country_result['country_name']?></option>
	
	<?php } ?>
	
		 </select>
      <script type="text/javascript">
			$("#country").change(function(){
			if($("#country").val()=='230'  || $("#country").val()=='45')	{
		$("#state_div").show('fast');	
				
	    	$("#state").load("get_state.php?c_id="+$("#country").val());
			
			}
			else{
		$("#state_div").hide('fast');		
			}
						});		

                                       </script>       
          </div>
          </div>
           <div class="full" id="state_div" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"> </div>
         <div class="col-lg-8 col-sm-12 col-xs-12">
        <select name="state" id="state"  class="form-control" style="width:80%" >
<option value="" selected="selected">Select State</option>	
<?php
	  while ($state_result = mysql_fetch_assoc($state)) {
	?>	
	<option value="<?=$state_result['state_id']?>" <? if($user_row['state']==$state_result['state_id']){?> selected <? }?> ><?=$state_result['state_name']?></option>
	
	<?php } ?>	
		</select>
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Address:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
       <input type="text" name="address1" id="address1" value="<?=$user_row['address1']?>" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Address 2:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="text" name="address2" id="address2" value="<?=$user_row['address2']?>" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> City:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="text" name="city" id="city" class="form-control" value="<?=$user_row['city']?>" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Zipcode:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="text" name="zipcode" id="zipcode"value="<?=$user_row['zipcode']?>" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
         <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> I am a:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
          <? if($_SESSION['i_am']=='Agent'){?>
          <input type="radio" name="i_am" value="Agent" class="radio-inline"  checked >Agent
          <? }else{ ?>
         <input type="radio" name="i_am" value="Wholesaler" class="radio-inline" <? if($user_row['i_am']=='Wholesaler'){?>
          checked="checked" <? } ?> >Wholesaler  <input type="radio" name="i_am" value="Internet Dealer" 
		  <? if($user_row['i_am']=='Internet Dealer'){?> checked="checked" <? } ?> class="radio-inline" >Internet Dealer
          <input type="radio" name="i_am"  <? if($user_row['i_am']=='Beaurty Supply Owner'){?> checked="checked" <? } ?>  value="Beaurty Supply Owner" class="radio-inline" >Beauty Supply Owner
          <? } ?>
          
          </div>
          </div>
    <div class="full" style="width:95%; margin:3em 0em 2em 1em; margin-left:3%;">
    <span style="color:#999999; font-weight:bold;" >Add Your Contact Information</span> &nbsp;
    <span class="dotted-class" style="width:65%;"></span>
    </div>   
       
        <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> contact Name:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
       <input type="text"  class="form-control" name="f_name" id="f_name" value="<?=$user_row['f_name']?>" placeholder="First Name" style="width:40%; float:left"  >
       <input type="text" class="form-control" name="l_name" id="l_name" value="<?=$user_row['l_name']?>" placeholder="Last Name" style="width:40%;float:left" >
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Company Name:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
       <input type="text" name="com_name" value="<?=$user_row['company_name']?>" id="com_name" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
       
          </div>
          </div>
          
            <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Tel:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
       <input type="text" name="tel1" id="tel1" class="input-xm" value="<?=$tel[0]?>" style="border:1px solid #000000" >-
       <input type="text" name="tel2" id="tel2" value="<?=$tel[1]?>" class="input-xm" placeholder="Area" style="border:1px solid #000000">- 
	   <input type="text" name="tel3" id="tel3" class="input-group-sm" placeholder="Number" value="<?=$tel[2]?>" style="border:1px solid #000000">       
          </div>
          </div>
         
          <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Cell:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
       <input type="text" name="cel1" id="cel1" value="<?=$cel[0]?>" class="input-xm" style="border:1px solid #000000" >-
       <input type="text" name="cel2" id="cel2" value="<?=$cel[1]?>" class="input-xm" placeholder="Area" style="border:1px solid #000000">- 
	   <input type="text" name="cel3" id="cel3" value="<?=$cel[2]?>" class="input-group-sm" placeholder="Number" style="border:1px solid #000000">       
          </div>
          </div>  
        
      
      <div class="full text-center">
        <div class="col-lg-4 col-sm-12 col-xs-12 text-right"></div>
           <div class="col-lg-8 col-sm-12 col-xs-12 text-left" style="padding:.5em 0;">
      <input type="submit" value="Update Account" class="blue-btn">
      </div>
      </div> 
          
        <div class="full text-center">
        <div class="col-lg-4 col-sm-12 col-xs-12 text-right"></div>
           <div class="col-lg-8 col-sm-12 col-xs-12 text-left" style="padding:0px;">
     Upon creating my account I agree to:<br>
     <input type="checkbox" class="checkbox-inline"><span style="color:#429AC2;">The EBHAhair.com Membership Agreement ;</span>
   <br>
      <input type="checkbox" class="checkbox-inline"> Receive emails relating to membership and services from  <span style="color:#429AC2;">EBHAhair.com</span>
     
      </div>
      </div>   
          
        </div>
    </form>
    <!--right portion start-->    
        <div class="col-lg-4 col-sm-12 col-xs-12">
   <div class="full" style="">
    <span style="color:#999999; font-weight:bold;" >Or Using other account</span> <br>
    <span class="dotted-class" style="width:100%;"></span>
    </div>  
    <div class="full">
Already a Member ? <span style="color:#476FD5;">Sign in here</span>
    </div>
   
   <div class="full" style="background:#F8F8F8; margin-top:.7em; border-top:1px dotted #999; padding:1% 0% 0% 3%;">
   
   <h4 class="h4" style="color:#9B9B9B;">Thank You Join EBHAhair.com</h4>
   <div class="full" style="padding:.3em 0;">
   <input type="checkbox" class="checkbox-inline" >Over 2 Million Supplier From Manufacture
   </div>
    <div class="full" style="padding:.3em 0;">
   <input type="checkbox" class="checkbox-inline" >Safe and simple Trade Solutions
   </div>
    <div class="full" style="padding:.3em 0;">
   <input type="checkbox" class="checkbox-inline" >Inspection & Return Free
   </div>
  <div class="full text-right"  >
  <img src="images/tri.png" class="" >
  </div>
   
   </div> 
   
       <div style="height:100">&nbsp; </div>
        <div style="height:100">&nbsp; </div>
         <div style="height:100">&nbsp; </div>
          <? if($_SESSION['i_am']!='Agent'){?>
         <div style="width:70%; margin-left:30px;">
              <div ><font style="font-size:22px"><b>My EBHA credit</b></font> </div>   
              <div style="height:100">&nbsp; </div>
              <div  style="background:#92d14f; text-align:center; width:80%; height:25px; border:2px solid #000000;"><span style=" color:#FFFFFF; font-size:18px" ><b> $ <?=$user_row['account_credit']?></b></span> </div>  
              <div style="height:100">&nbsp; </div>
            <div ><font style="font-size:22px"><b>referral code:</b></font> </div>   
              <div style="height:10">&nbsp; </div>
              <div  style="background:#000000; text-align:center; width:80%; height:25px; border:2px solid #000000;"><span style=" color:#FFFFFF; font-size:18px" ><b>  <?=$user_row['refcode']?></b></span> </div>  
              
                
          </div>
          <? } ?>
        </div>
       
        
    <!-- right portion end-->    
        
      </div>
    <div class="full text-right" style="color:#F00; padding-right:1em;"><sup><img src="images/star_red.png" ></sup>Required Filed</div>  
      
    </div>
  </div>
</div>

<!--body end--> 

<!-- footer start-->

<?php include'foot-new.php'?>
<!--footer end  -->

</div>

<!--right sidebar start-->

<!--right sidebar end



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>

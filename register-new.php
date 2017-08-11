<? ob_start();if(basename($_SERVER['REQUEST_URI'])==='register.php'){header("location:https://fahair.com/register.html",  true,  301 );exit;}ob_flush();?>
<?
 session_start();
 require_once('wp-admin/include/connectdb.php');
 $country_query=$con_pdo->query("SELECT * FROM `country` where country_name!='' order by country_id asc");  
 $account_email = $_GET['account_email'];

?>
<!doctype html>
<html>
<head>
<meta content="<p>Welcome to ebhahair.com</p>" name="description">
<meta content="Human Hair Extensions, wigs" name="keywords">
<meta content="Human Hair Extensions" name="author">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Register Page</title>


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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Bootstrap -->
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

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
	
	function ask_supplier(){
    jQuery("#overlay-mask-3").fadeIn('slow');
}

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
	setTimeout(function() {
    $("#overlay-mask-1").fadeIn('slow');}, 5000);
	

});


function Validate(){


var email=document.getElementById('email').value;
var pass=document.getElementById('pass').value;
var conf_pass=document.getElementById('conf_pass').value;
var country=document.getElementById('country').value;
var address1=document.getElementById('address1').value;
var city=document.getElementById('city').value;
var zipcode=document.getElementById('zipcode').value;
var f_name=document.getElementById('f_name').value;
var l_name=document.getElementById('l_name').value;
//var com_name=document.getElementById('com_name').value;
var tel1=document.getElementById('tel1').value;
var tel2=document.getElementById('tel2').value;
var tel3=document.getElementById('tel3').value;
var captcha=document.getElementById('captcha').value;
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

}
/*if(com_name==''){
alert('Please enter company name!');
document.getElementById('com_name').focus();
return false;

}*/if(tel1==''){
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

}if(captcha1==''){
alert('Please enter captcha!');
document.getElementById('captcha1').focus();
return false;

}

	
	if(!$("#checkbox2").is(":checked")) {
        alert("Please accept Receive emails relating to membership and services from Fahair.com");
        return false;
    }



}


function check_email(){

	var email=document.getElementById('email').value;

$.post( "ajax.php", { email_check:email })
.done(function( data ) {
if(data==1){
	alert('Email is already  exist !')
document.getElementById('email').value='';
document.getElementById('email').focus();
return false;



}

});

}
</script>
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
input[type="checkbox"] {
  transform:scale(1.3, 1.3);
}
.header-area {
    background: #fff none repeat scroll 0 0;
}
</style>
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
      <span style="color:#222222">CREATE AN ACCOUNT</span> </div>
    <hr>
    <div class="row" style="padding:1em 0;border:1px solid #E5E5E5; background:#FBFBFB;">
   <div class=" text-left text-uppercase" style="width:98%; margin:0 1%;">
   <h4 class="h4" style="color:#000;">Your Personal information</h4> 
   <hr> </div>
      <div class="row form-group " style="width:96%; margin:1% 2%; background:#FFF; padding:1%;">
     
     
	 <form name="register" action="register_process.php"  method="post" onSubmit="return Validate()">
        <div class="col-lg-8 col-sm-12 col-xs-12 border-bottom-small text-right-small" style="border-right:1px solid #EEEEEE;">
       <div class="full" style="width:95%; margin:0em 0em 2em 1em; margin-left:3%;">
    <span style="color:#999999; font-weight:bold;" >Create Your Account</span> &nbsp;
    <span class="dotted-class" style="width:65%;"></span>
    </div>   
      
         <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Email:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="email" name="email" id="email" value="<?=$account_email?>" class="form-control" onBlur="check_email()" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
            <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Create Password:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="password" name="pass" id="pass" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
            <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Re-enter Password:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="password" name="conf_pass" id="conf_pass" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Shipping Address:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
         <select name="country" id="country" style="width:80%;" class="form-control">
<option value="" selected="selected">Select Country</option>		 
		
	<?php
	  while ($country_result = $country_query->fetch(PDO::FETCH_ASSOC)) {
	?>	
	<option value="<?=$country_result['country_Id']?>"><?=$country_result['country_name']?></option>
	
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
        <select name="state" id="state" style="width:80%;" class="form-control" >
<option value="" selected="selected">Select State</option>		
		</select>
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Address:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="text" name="address1" id="address1" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"> Address 2:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="text" name="address2" id="address2" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> City:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="text" name="city" id="city" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Zipcode:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="text" name="zipcode" id="zipcode" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
         
    <div class="full" style="width:95%; margin:3em 0em 2em 1em; margin-left:3%;">
    <span style="color:#999999; font-weight:bold;" >Add Your Contact Information</span> &nbsp;
    <span class="dotted-class" style="width:65%;"></span>
    </div>   
       
        <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Contact Name:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
          <div  class="row">
                <div class="col-lg-4 col-sm-12 col-xs-12" ><input type="text"  name="f_name" id="f_name" placeholder="First Name" class="form-control" > </div>
                <div class="col-lg-4 col-sm-12 col-xs-12"  style="text-align:left"><input type="text"  name="l_name" id="l_name" placeholder="Last Name" class="form-control" ></div>
                <div class="col-lg-4 col-sm-12 col-xs-12" >&nbsp;</div>
          </div> 
         
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
         <!-- <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Company Name:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
       <input type="text" name="com_name" id="com_name" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
       
          </div>
          </div>
          -->
          
            <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Tel:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <div  class="row">
                  <div class="col-lg-12 col-sm-12 col-xs-12"><input type="text" name="tel1" id="tel1" class="input-xm" style="width:45px; display:inline; border:1px solid gray" >-<input type="text" name="tel2" id="tel2" class="input-xm" placeholder="Area" style="width:45px; display:inline;border:1px solid gray">-<input type="text" name="tel3" id="tel3" class="input-group-sm" placeholder="Number" style="width:100px;margin-left:0px; display:inline;border:1px solid gray"></div>
                           
             </div>      
          </div>
          </div>
         
          <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"> Cell:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
           <div  class="row">
          <div class="col-lg-12 col-sm-12 col-xs-12">
                   <input type="text" name="cel1" id="cel1" class="input-xm" style="width:45px; display:inline;border:1px solid gray" >-<input type="text" name="cel2" id="cel2" class="input-xm" placeholder="Area" style="width:45px; display:inline;border:1px solid gray">-<input type="text" name="cel3" id="cel3" class="input-group-sm" placeholder="Number" style="width:100px;margin-left:0px; display:inline;border:1px solid gray">              </div>
           </div>      
          </div>
          </div>  
        
        <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Code shown:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
          <img src="captcha.php" id="captcha" class="input-group-sm" style="border:1px solid #DDDDDD; width:150px; margin-bottom:10px;"/>
    <span class="glyphicon glyphicon-repeat" onClick="document.getElementById('captcha').src='captcha.php?'+Math.random();" style="cursor:pointer;"></span>      
          <br>
          
       <input type="text" name="captcha1" id="captcha1" class="form-control"  style=" width:35%"  >
          </div>
          </div>
          
          
           <div class="col-lg-4 col-sm-12 col-xs-12 text-right">&nbsp;</div>
          <div class="col-lg-8 col-sm-12 col-xs-12 text-left" style="float:left;">
       <input  type="checkbox" name="bhha" id="bhha"  style=""> <span><font style="color:#000000; font-size:14px"> Become a EBHA:</font><font style="color:#FF0000; font-size:14px">No need license</font></span>
          </div>
          </div>
          
          
          
      <div class="full text-center">
        <div class="col-lg-4 col-sm-12 col-xs-12 text-right"></div>
           <div class="col-lg-8 col-sm-12 col-xs-12 text-left" style="padding:.5em 0;">
      <input type="submit" value="Create  Account" name="submit" class="blue-btn">
      </div>
      </div> 
          
        <div class="full text-center">
        <div class="col-lg-4 col-sm-12 col-xs-12 text-right"></div>
           <div class="col-lg-8 col-sm-12 col-xs-12 text-left" style="padding:0px;">
     Upon creating my account I agree to:<br>
     
   
      <input type="checkbox" class="checkbox-inline" id="checkbox2"> Receive emails relating to membership and services from  <br/>&nbsp; 
     
      </div>
      </div>   
      <div>&nbsp; </div>    
        </div>
    </form>
    <!--right portion start-->    
        <div class="col-lg-4 col-sm-12 col-xs-12">
 

   
 
   </div> 
          
        </div>
        
    <!-- right portion end-->    
        
      </div>
    <div class="full text-right" style="color:#F00; padding-right:1em; padding-bottom: 16px;"><sup><img src="images/star_red.png" ></sup>Required Filed</div>  
      
    </div>
  </div>
</div>

<!--body end--> 

<!-- footer start-->
<div class="col-lg-12" style="margin:0px; padding:0px" >
<?php include'foot-new.php'?>
</div>
<!--footer end  -->

</div>

<!--right sidebar start-->
<!-- <div id="at4-share" class="addthis_32x32_style atss atss-right addthis-animated slideInRight at4-show"><a class="at4-share-btn at-svc-facebook" href="#"><img src="images/fb.png" ></a> <a class="at4-share-btn at-svc-twitter" href="#"><img src="images/tw.png" ></a><a class="at4-share-btn at-svc-zingme" href="#"><img src="images/ymoo.png" ></a><a class="at4-share-btn at-svc-linkedin" href="#"><img src="images/z.png" ></a><a class="at4-share-btn at-svc-favorites" href="#"><img src="images/p.png" ></a><a class="at4-share-btn at-svc-google_plusone_share" href="#"><img src="images/plus.png" ></a> 
  <!--<div id="at4-scc" class="at-share-close-control ats-transparent at4-show at4-hide-content" title="Hide">
    <div class="at4-arrow at-right">Hide</div>
  </div>--> 
<!--</div> -->

<!--right sidebar end
<!-- register alert-->
<div id="overlay-mask-3" class="overlay-mask" style="">
  <div class="overlay iframe-content" style="border:5px solid #fff; font-size:1.2em;">
  <a class="close close-icon" onClick="close_popup('overlay-mask-3')">
  <span id="close_button" style="margin-left:0.5em;">X</span></a>
   
 <div class="container" style="padding:1em;">
<div class="full"> 
<h1>Conditions of Use</h1>
<hr>

<p>Welcome to Fahair.com.  Wholesale Services LLC and/or its affiliates ("Fahair Wholesale") provide website features and other products and services to you when you visit or shop at fahair.com, use fahair Wholesale products or services, use fahair Wholesale applications for mobile, or use software provided by fahair Wholesale in connection with any of the foregoing (collectively, " Wholesale Services").  Wholesale provides the  Wholesale Services subject to the following conditions.</p>
<h4>By using  Wholesale Services, you agree to these conditions. Please read them carefully.</h4>
<p>We offer a wide range of  Wholesale Services, and sometimes additional terms may apply. When you use an Wholesale Service you also will be subject to the guidelines, terms and agreements applicable to that  Wholesale Service ("Service Terms"). If these Conditions of Use are inconsistent with the Service Terms, those Service Terms will control.</p>
<h3>PRIVACY</h3>
<p>Please review our Privacy Notice, which also governs your use of  Wholesale Services, to understand our practices.</p>
<h3>ELECTRONIC COMMUNICATIONS</h3>
<p>When you use any  Wholesale Service, or send e-mails to us, you are communicating with us electronically. You consent to receive communications from us electronically. We will communicate with you by e-mail or by posting notices on this site or through the other  Wholesale Services. You agree that all agreements, notices, disclosures and other communications that we provide to you electronically satisfy any legal requirement that such communications be in writing.</p>
<h3>COPYRIGHT</h3>
<p>All content included in or made available through any  Wholesale Service, such as text, graphics, logos, button icons, images, audio clips, digital downloads, and data compilations is the property of  Wholesale or its content suppliers and protected by United States and international copyright laws. The compilation of all content included in or made available through any  Wholesale Service is the exclusive property of  Wholesale and protected by U.S. and international copyright laws.</p>
<h3>TRADEMARKS</h3>
<p>Graphics, logos, page headers, button icons, scripts, and service names included in or made available through any  Wholesale Service are trademarks or trade dress of  Wholesale in the U.S. and other countries.  Wholesale's trademarks and trade dress may not be used in connection with any product or service that is not  Wholesale's, in any manner that is likely to cause confusion among customers, or in any manner that disparages or discredits  Wholesale. All other trademarks not owned by  Wholesale that appear in any  Wholesale Service are the property of their respective owners, who may or may not be affiliated with, connected to, or sponsored by  Wholesale.</p>
<h3>PATENTS</h3>
<p>One or more patents owned by  Wholesale apply to the  Wholesale Services and to the features and services accessible via the  Wholesale Services. Portions of the  Wholesale Services operate under license of one or more patents</p>
<h3>REVIEWS, COMMENTS, COMMUNICATIONS, AND OTHER CONTENT</h3>
<p>Visitors may post reviews, comments, photos, and other content; send e-cards and other communications; and submit suggestions, ideas, comments, questions, or other information, so long as the content is not illegal, obscene, threatening, defamatory, invasive of privacy, infringing of intellectual property rights, or otherwise injurious to third parties or objectionable and does not consist of or contain software viruses, political campaigning, commercial solicitation, chain letters, mass mailings, or any form of "spam." You may not use a false e-mail address, impersonate any person or entity, or otherwise mislead as to the origin of a card or other content.  Wholesale reserves the right (but not the obligation) to remove or edit such content, but does not regularly review posted content.</p>
<p>If you do post content or submit material, and unless we indicate otherwise, you grant  Wholesale a nonexclusive, royalty-free, perpetual, irrevocable, and fully sublicensable right to use, reproduce, modify, adapt, publish, translate, create derivative works from, distribute, and display such content throughout the world in any media. You grant  Wholesale and sublicensees the right to use the name that you submit in connection with such content, if they choose. You represent and warrant that you own or otherwise control all of the rights to the content that you post; that the content is accurate; that use of the content you supply does not violate this policy and will not cause injury to any person or entity; and that you will indemnify  Wholesale for all claims resulting from content you supply.</p><p>  Wholesale has the right but not the obligation to monitor and edit or remove any activity or content.  Wholesale takes no responsibility and assumes no liability for any content posted by you or any third party.</p>
<h3>COPYRIGHT COMPLAINTS</h3>
<p> Wholesale respects the intellectual property of others.
 If you believe that your work has been copied in a way that constitutes copyright infringement, 
 please follow our <span style="color: #03C"> Notice and Procedure for Making Claims of Copyright Infringement.</span></p>
<h3>RISK OF LOSS</h3>
<p>All items purchased from  Wholesale are made pursuant to a shipment contract. This means that the risk of loss and title for such items pass to you upon our delivery to the carrier.</p>
<h3>RETURNS& REFUNDS</h3>
<p>Buyer may return most new, unopened items within 30 days of delivery for a full refund.  Wholesale also pay the return shipping costs if the return is a result of our error (you received an incorrect or defective item, etc.).</p>
<p>If buyer is shipping from abroad you must ensure that the customs form indicates you are "Returning Product for Exchange or Repair." We will not be liable for any customs charge for returned items. If items are sent back with customs charges they NOT be accepted/collected from the delivery company in possession.</p>
<p>You should expect to receive your refund within four weeks of giving your package to the return shipper, however, in many cases you will receive a refund more quickly. This time period includes the transit time for us to receive your return from the shipper (5 to 10 business days), the time it takes us to process your return once we receive it (3 to 5 business days), and the time it takes your bank to process our refund request (5 to 10 business days).</p>
<p>If you need to return an item, simply login to your account, view the order using the "Complete Orders" link under the My Account menu and click the Return Item(s) button. We'll notify you via e-mail of your refund once we've received and processed the returned item.</p>
<p>To return an item: You need to sign into your account and click on the "completed orders" tab. There you can request a return through the automated system. All returns are required to go through this process before returning to  Wholesale. You will receive an automated email with the return address and reference number.</p><p> Any returns without this authorisation will be rejected. Your name and order number must be with the package to process the return.</p>
<h3>PRODUCT DESCRIPTIONS</h3>
<p> Wholesale attempts to be as accurate as possible. However,  Wholesale does not warrant that product descriptions or other content of any  Wholesale Service is accurate, complete, reliable, current, or error-free. If a product offered by  Wholesale itself is not as described, your sole remedy is to return it in unused condition.</p>
<h3>PRICING</h3>
<p>Except where noted otherwise, the Manufacturer’s Suggested Retail Price “MSRP”displayed for products on any  Wholesale Service represents the full retail price listed on the product itself, suggested by the manufacturer or supplier, or estimated in accordance with standard industry practice; or the estimated retail value for a comparably featured item offered elsewhere.</p><p> The MSRP is a comparative price estimate and may or may not represent the prevailing price in every area on any particular day.</p><p> For certain items that are offered as a set, the MSRP may represent "open-stock" prices, which means the aggregate of the manufacturer's estimated or suggested retail price for each of the items included in the set. Where an item is offered for sale by one of our merchants, the MSRP may be provided by the merchant.</p>
<p>With respect to items sold by  Wholesale, Wholesale price will be displayed with verified account, such as Business owner’s account or Distributer’s account.</p><p> Wholesale price also will be determined by manufacture and  Wholesale does not have or own authority to change the price. Despite our best efforts, a small number of the items in our catalog may be mispriced. If the correct price of an item sold by  Wholesale is higher than our stated price, we will, at our discretion, either contact you for instructions before shipping or cancel your order and notify you of such cancellation. Other merchants may follow different policies in the event of a mispriced item.</p>
<p>We generally do not charge your credit card until after your order has entered the shipping process or, for digital products, until we make the digital product available to you.</p>
<h3>CUSTOM ORDER</h3>
<p>Each buyer or business owner with verified account is able to request Custom Order to the manufacture. Minimum quantity is required for 1000 item for each custom order and if the manufacture accepts the order,  Wholesale will send a confirmation letter to who request the order.</p><p> The entire process will be taken at least two or three month for delivery depends on the manufacture’s ability. During this process,  Wholesale will update every progress to the buyer or business owner each time. </p>
<h3>BULK ORDER</h3>
<p>Bulk Order is an option for buyers or business owner who already have purchased large amount of product and for convenient usage, buyers are available to order large amount of product by uploading the suggested document file to  Wholesale web server.</p> 
<h3>SAMPLE ORDER</h3>
<p>Buyer or business owner members are able to request each samples with no minimum order required.</p> 
<h3 style="color:#F00">DROPSHIP REQUEST</h3>

<h3>SHIPPING,</h3> 
<p> Wholesale can ship to virtually any address in the world. Note that there are restrictions on some products, and some products cannot be shipped to international destinations.When Buyer or Business owner members place an order,  Wholesale will get a real-time shipping quotes and delivery dates for you based on the availability of your items and the shipping options you choose.</p><p> Depending on the shipping provider you choose, shipping date estimates may appear on the shipping quotes page.</p>
<p>Please also note that the shipping rates for many items we sell are weight-based. The weight of any such item can be found on its detail page. To reflect the policies of the shipping companies we use, all weights will be rounded up to the next full 100 grams.</p>
<h3> WHOLESALE SOFTWARE TERMS</h3>
<p>In addition to these Conditions of Use, the terms found here apply to any software (including any updates or upgrades to the software and any related documentation) that we make available to you from time to time for your use in connection with  Wholesale Services (the " Wholesale Software").<p>
<h3>OTHER BUSINESSES</h3>
<p>Parties other than  Wholesale operate stores, provide services, or sell product lines on this site. In addition, we provide links to the sites of affiliated companies and certain other businesses.</p><p> We are not responsible for examining or evaluating, and we do not warrant the offerings of, any of these businesses or individuals or the content of their Web sites.</p><p>  Wholesale does not assume any responsibility or liability for the actions, product, and content of all these and any other third parties.</p><p> You should carefully review their privacy statements and other conditions of use.</p>
<span style="color:#F00">
<h3>DISCLAIMER OF WARRANTIES AND LIMITATION OF LIABILITY</h3>
<p>THE  WHOLESALE SERVICES AND ALL INFORMATION, CONTENT, MATERIALS, PRODUCTS (INCLUDING SOFTWARE) AND OTHER SERVICES INCLUDED ON OR OTHERWISE MADE AVAILABLE TO YOU THROUGH THE  WHOLESALE SERVICES ARE PROVIDED BY  WHOLESALE ON AN "AS IS" AND "AS AVAILABLE" BASIS, UNLESS OTHERWISE SPECIFIED IN WRITING.  WHOLESALE MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND, EXPRESS OR IMPLIED, AS TO THE OPERATION OF THE  WHOLESALE SERVICES, OR THE INFORMATION, CONTENT, MATERIALS, PRODUCTS (INCLUDING SOFTWARE) OR OTHER SERVICES INCLUDED ON OR OTHERWISE MADE AVAILABLE TO YOU THROUGH THE  WHOLESALE SERVICES, UNLESS OTHERWISE SPECIFIED IN WRITING. YOU EXPRESSLY AGREE THAT YOUR USE OF THE  WHOLESALE SERVICES IS AT YOUR SOLE RISK.</p><p>
TO THE FULL EXTENT PERMISSIBLE BY APPLICABLE LAW,  WHOLESALE DISCLAIMS ALL WARRANTIES, EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE.</p><p>  WHOLESALE DOES NOT WARRANT THAT THE  WHOLESALE SERVICES, INFORMATION, CONTENT, MATERIALS, PRODUCTS (INCLUDING SOFTWARE) OR OTHER SERVICES INCLUDED ON OR OTHERWISE MADE AVAILABLE TO YOU THROUGH THE  WHOLESALE SERVICES,  WHOLESALE'S SERVERS OR ELECTRONIC COMMUNICATIONS SENT FROM  WHOLESALE ARE FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS.</p><p>  WHOLESALE WILL NOT BE LIABLE FOR ANY DAMAGES OF ANY KIND ARISING FROM THE USE OF ANY  WHOLESALE SERVICE, OR FROM ANY INFORMATION, CONTENT, MATERIALS, PRODUCTS (INCLUDING SOFTWARE) OR OTHER SERVICES INCLUDED ON OR OTHERWISE MADE AVAILABLE TO YOU THROUGH ANY  WHOLESALE SERVICE, INCLUDING, BUT NOT LIMITED TO DIRECT, INDIRECT, INCIDENTAL, PUNITIVE, AND CONSEQUENTIAL DAMAGES, UNLESS OTHERWISE SPECIFIED IN WRITING.</p><p>
CERTAIN STATE LAWS DO NOT ALLOW LIMITATIONS ON IMPLIED WARRANTIES OR THE EXCLUSION OR LIMITATION OF CERTAIN DAMAGES.<p><p> IF THESE LAWS APPLY TO YOU, SOME OR ALL OF THE ABOVE DISCLAIMERS, EXCLUSIONS, OR LIMITATIONS MAY NOT APPLY TO YOU, AND YOU MIGHT HAVE ADDITIONAL RIGHTS.<p>
<h3>DISPUTES</h3>
<h2>
Any dispute or claim relating in any way to your use of any  Wholesale Service, or to any products or services sold or distributed by  Wholesale or through .com will be resolved by binding arbitration, rather than in court, except that you may assert claims in small claims court if your claims qualify.</h2><p> The Federal Arbitration Act and federal arbitration law apply to this agreement.</p>
<h2>There is no judge or jury in arbitration, and court review of an arbitration award is limited. However, an arbitrator can award on an individual basis the same damages and relief as a court (including injunctive and declaratory relief or statutory damages), and must follow the terms of these Conditions of Use as a court would.</h2>
<p>To begin an arbitration proceeding, you must send a letter requesting arbitration and describing your claim to our registered agent Corporation Service Company____________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________
We each agree that any dispute resolution proceedings will be conducted only on an individual basis and not in a class, consolidated or representative action. If for any reason a claim proceeds in court rather than in arbitration we each waive any right to a jury trial. We also both agree that you or we may bring suit in court to enjoin infringement or other misuse of intellectual property rights.</p>
<h3>APPLICABLE LAW</h3>
<p>By using any  Wholesale Service, you agree that the Federal Arbitration Act, applicable federal law, and the laws of the state of Washington, without regard to principles of conflict of laws, will govern these Conditions of Use and any dispute of any sort that might arise between you and  Wholesale.</p>
<h3>SITE POLICIES, MODIFICATION, AND SEVERABILITY</h3>
<p>Please review our other policies, such as our pricing policy, posted on this site. These policies also govern your use of  Wholesale Services. We reserve the right to make changes to our site, policies, Service Terms, and these Conditions of Use at any time. If any of these conditions shall be deemed invalid, void, or for any reason unenforceable, that condition shall be deemed severable and shall not affect the validity and enforceability of any remaining condition.</p>
</span>
<p>https://www.fahair.com</p>


 </div>

 </div>
 
 </div>
 </div>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>
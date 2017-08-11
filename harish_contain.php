<?php
session_start();
require_once('wp-admin/include/connectdb.php');
  $url = $_GET['url'];
  $id=$_GET['goods_Id'];
//echo  $id;
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
//echo '<script type="text/javascript">
//window.location="index.php";
//</s
	 	 
 }
 
 else{
echo '<script type="text/javascript">
alert("You are not login ! Please try again ");
</script>';	 
 }
 
 
 
 }

$wig_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='wig'"),0);

$wig_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$wig_id'");

$wig_query_1=mysql_query("SELECT * FROM `subcategory` where cat_id='$wig_id'");

$lace_wig_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='lace wig'"),0);

$lace_wig_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$lace_wig_id'");

$lace_wig_query_1=mysql_query("SELECT * FROM `subcategory` where cat_id='$lace_wig_id'");

$weaving_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='WEAVING'"),0);

$weaving_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$weaving_id'");

$weaving_query_1=mysql_query("SELECT * FROM `subcategory` where cat_id='$weaving_id'");

$remy_hair_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='remy hair'"),0);

$remy_hair_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$remy_hair_id'");

$remy_hair_query_1=mysql_query("SELECT * FROM `subcategory` where cat_id='$remy_hair_id'");

$hair_piece_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='hair piece'"),0);

$hair_piece_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$hair_piece_id'");

$hair_piece_query_1=mysql_query("SELECT * FROM `subcategory` where cat_id='$hair_piece_id'");

$hair_care_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='hair care'"),0);

$hair_care_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$hair_care_id'");

$hair_care_query_1=mysql_query("SELECT * FROM `subcategory` where cat_id='$hair_care_id'");

$beauty_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='beauty'"),0);

$beauty_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$beauty_id'");

$beauty_query_1=mysql_query("SELECT * FROM `subcategory` where cat_id='$beauty_id'");

$best_sale_query=mysql_query("SELECT * FROM `product` order by product_seen DESC limit 4");
$new_arrival=mysql_query("SELECT * FROM `product` order by id DESC limit 4"); 
$new_arrivals=mysql_query("SELECT * FROM `product` order by id DESC limit 10"); 
$sales_and=mysql_query("SELECT * FROM `product` where category='SALES_AND_DEALS' order by id DESC limit 10"); 

$j=0;
$robin=mysql_query("SELECT * FROM rating where goods_id=$id ORDER BY id DESC LIMIT 3;"); 


?>
 
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

 
<title></title>
</head>
    
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
    
    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<!-- bxSlider Javascript file -->
<script src="bx/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="bx/jquery.bxslider.css" rel="stylesheet" />



  
  <script language="javascript">
  var j = jQuery.noConflict();

         j(document).ready(function() 
         {
            j('.bxslider').bxSlider({
                pagerCustom: '#bx-pager',
                mode: 'fade'
            });

         });  
		 j(function ($) {
  $(document).ready(function(){
  $('.slider1').bxSlider({
    slideWidth: 200,
    minSlides: 2,
    maxSlides: 5,
    slideMargin: 1
  });
});
});
  </script>

<script type="text/javascript">

var user_not_login;
 user_not_login=false;

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
<?php  
if($_SESSION['GOOD_SHOP_PART']!='member'){

?>
user_not_login=true
$(document).ready(function(e) {
	setTimeout(function() {
    $("#overlay-mask-1").fadeIn('slow');}, 1000);
	

});

<? } ?>

<!--if(user_not_login==true){
	//setInterval(function(){  $("#overlay-mask-1").fadeIn(); }, 1000);
//}-->

function validate(){

var email=document.getElementById('email_login').value;
var pwd=document.getElementById('pwd_login').value
	
	if(email==''){
	alert('Please enter email !');
	document.getElementById('email_login').focus();
	return false;
		
	}
	
	if(pwd==''){
	alert('Please enter password !');
	document.getElementById('pwd_login').focus();
	return false;
		
	}
	
}

function show_item(id,countt){
$(".add_hidden_"+countt).addClass("hidden-class");
$(".li-cls-"+countt).removeClass("active-menu");
$("#li_"+id).addClass("active-menu");
$(".div_"+id).removeClass("hidden-class");
	
}


    </script>


<style type="text/css">
@media (max-width: 468px) {

}
@media (min-width: 1024px) {
		#quad{width:1379px;}
		#top{
		top: -250px;
	}
	
	#pi{
		height: 160px;
	}
		}
#sds{margin-top: -82px;}
.product_container{
height: 430px; 
		}
#isha{padding-left: 0px; padding-right: 0px;}
#ishu{padding-left: 0px; padding-right: 0px;}
#ish{ padding-left: 0px; padding-right: 0px;}
#japan{ width:25%;}
#sales_and{ width:20%;}
#best_sale_query{ width:20%;}
.s{ style="margin-top:0px; margin-left:30px;"}
		.hk{ width:300px;
}
body, html { overflow-x:hidden; background-color:white !important;}
kar{
margin-left: 70px;
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
.product-item_sale {
    font-size: 9px;
    height: 71px;
    line-height: 35px;
    position: absolute;
    right: 132px;
    text-align: center;
    top: -25px;
    width: 70px;
}
.circle {
    border-radius: 100%;
}
.customBgColor {
    background-color:#C60;
}
.image{
	height:506;
	width:1497;
	}
	h2.title {
    font-size: 50px;
    letter-spacing: 2px;
    line-height: 100%;
    padding-bottom: 15px;
    text-align: center;
}
h5.tittle{
	line-height:100%;
	text-align:center;
	font-size:16px;
	color:#906;
	}
	.downside{
		margin-top:-550px;
		}
		.img-thumbnail {
    background-color: lightgray;
	
		}
		.ka{ 
	width: 80%; 
    overflow: hidden; 
   
    text-overflow: ellipsis;
	text-align:center;
 
	 
	}
	.star{
			height:10px;
			width:10px;
			
			}
			.size{
				font-size:24px;}

 @media (min-width: 266px) and (max-width: 1024px) {
	
	 #sds{margin-top: -198px;}
	 .product_container{
		
		 width:120px;
		 height: 280px; 
		}
	 #isha{ margin-top:-46px !important;padding-left: 0px; padding-right: 0px;}
	  #ishu{ padding-left: 0px; padding-right: 0px;}
#ish{ padding-left: 0px; padding-right: 0px;}	
.header{ min-height: 1px !important;}
.wsmenucontainer{ min-height: 1px !important;}

.hk{ width:50px;
}

#sales_and{ width:100%;}
#best_sale_query{ width:100%;}

.pitem {
   width: 50px; height: 50px; margin-left: 105px;
}
.img-thumbnail{
	
	height: 120px;
	
	}
	.ka{ 
	width:100%; 
    overflow: hidden; 
   
    text-overflow: ellipsis;
	text-align:center;
 font-size:8px;
	 
	}
	.star{
		height:6px;
		width:6px;
		}
	
	



.hk{ width:150px;
}
#japan{ width:50%; margin-top: 40px;}
#sales_and{ width:100%;}
#best_sale_query{ width:100%;}

.secondimg{
	height:270px;
	width:309px;
	}
	.img-thumbnail{
	
	height: 150px !important;
	background-color: lightgray;
	}
	
		
		
			.shopbtan{
				width: 50px;
				 height: 20px;
				
				}
				

				
				.star{
					height:5px ;
					width:5px;
					}
					.product{
		margin-top:-40%;
		}
		.seemore{
			height:46px;
			width:230px;
			margin-top:20px;
			
		
			}
			.bgblack{
		 height: 540;
		}
		.downside{
			margin-top:-760;
			
			
			}
			
			.seemore2{
			height:46px;
			width:230px;
			margin-top:123px;
		
			
			
		
			}
			.newarrivals{
				width: 254px; 
				margin-top: -20px;
				}
				.line{
					
					width: 270px; 
					height: 9px;
					}
					.size{
						font-size:10px;
						}
						
					    .test:nth-child(3) {
							display:none;
						}
							.test:nth-child(4) {
							display:none;
						
							}
 			      
			}
			
	
					
</style>
<body>
<div>
<?php include'header-new.php'?></div>
<div class="full">

<div class="col-lg-12" style="margin-top: 10px;  padding-left: 0px; padding-right: 0px;" align="center">
<img src="images/new.jpg" class="secondimg" style="width:1379px;" >
</div>
<div class="row"><div class="col-lg-12 col-xs-12" id="isha">
<div style="border-right:1px solid #EEEEEE; " class="col-lg-12 product " id="pi">
<div align="center">
<div id="quad">
<div class="col-lg-12" id="top">
<div class="col-lg-1" ></div>
<div class="col-lg-10" style="padding-left: 0px; padding-right: 0px;">
   <? while($new_arrival1=mysql_fetch_assoc($best_sale_query)){
		  
		  
 if (strpos($new_arrival1['images'],',') !== false) {
  $new_arrival1_img=explode(',',$new_arrival1['images']);
$new_arrival1_img=$new_arrival1_img[0];
}
else{
  $new_arrival1_img=$new_arrival1['images'];	
}
 ?>
   <a class="test"style="color:inherit;" href="goods_detail.php?goods_Id=<?php echo $new_arrival1['id']?>">
      
        <div class="col-xs-6 col-lg-3 <? if($row==1){ ?> col-lg-offset-1" <? } ?> align="center"  style="padding-left:0px;">
          <div class="product_container" style="background:#E6E6E6; ">
<div class="full" align="center"><span class="product-item_sale"></span> <img src="product_img/<?php echo$new_arrival1_img?>" class="img-thumbnail" style="height:250px;"></div>
<div class="full ka"><span> <?php echo $new_arrival1['product_name']?>...</span></div>
              <div class="full" style="overflow:hidden;">
            
               <?php if($_SESSION['member_id']){ if($_SESSION['verify_status']==1){ ?>
               <div class="col-lg-12 " align="right"><strike>$<?php echo $new_arrival1['msrp_price']?></strike>   </div>
               <div class="col-lg-12 " align="right"><span style="color:#FF0000; font-size:20px">Wholesale</span> <span style="font-size:26px;">$<b><?php echo $new_arrival1['wholesale_price']?></b> </span>
              </div>
            
              <? } else {?>
              <div class="col-lg-12 col-md-8" align="right"><strike> $<?php echo $new_arrival1['regular_price']?> </strike>&nbsp; &nbsp; </div><div class="col-lg-12 col-md-8" align="right"><span style="font-size:26px; color:#F00;">
             $<b><?php echo $new_arrival1['msrp_price']?> </b></span> </div>
            
               <? } } ?>
              
            </div>
                <?php  
		  $idx =$new_arrival1['id'];
		    $q=mysql_query("select * from rating where goods_id=$idx");
			
			//echo "select * from rating where goods_id=$idx";
			$numberofrating=mysql_num_rows($q);
			//echo "$numberofrating";
			$star=0;
			//echo $q;
 while($qq=mysql_fetch_assoc( $q)){
	 
  $output = $qq['vid'];
  
  $star=$star+$qq['star'];
//echo $output;
//$st = $qq['star'];
//$out = $qq['star'];
//echo $out;
//echo $output;
//$out2=5-$out;
 }
 
 $average=0;
// echo $star;
 $average=$star/$numberofrating;
 
 
$average=round($average);
//echo "$average";
 $out=$average;
 $out2=5-$out;

?>



 <div class="full">
<span>  <?php for($i=0; $i<$out; $i++) { ?>
            <img src="images/star.PNG"  class="star"> <?php  } ?> <?php for($i=0; $i<$out2; $i++) { ?> 
             <img src="images/fuse-star.PNG"  class="star"> <?php  } ?> <?=$out?>.0
<img src="images/purchage-yellow.png" style="margin-top: 10px; margin-bottom: 17px;" class="shopbtan"></span>
       </div>    
</div>
        </div>
<? } ?><br>
       </a>
      </div>
  <div class="col-lg-1" ></div>
  </div>
</div>
</div>
  </div>            
</div></div> 
 <div class="col-lg-12" >
 <p style="text-align: center; margin-top: 42px; margin-bottom: 53px;"><img src="images/see.png" class="seemore"></p></div> 
 
 <div class="col-lg-12">
 
<h2 class="title font-additional font-weight-bold text-uppercase wow zoomIn" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: zoomIn;">UN<b style="color:red;">BEAT</b>ABLE <b style="color:#000;">HAIR</b> DEALS</h2>
<h5 class="tittle">Giving you best sale offers in town!view it is a very affortable price</h5>
 
 </div>
 
 <div class="col-lg-12" style="margin-top: 148px; padding-left: 0px; padding-right: 0px;" align="center">
 <p style="text-align: center; margin-top: 42px; margin-bottom: 53px;"><img src="images/bgblack.png" class="bgblack" style="width:1379px;" ></p></div>
 
 <div class="row"><div class="col-lg-12 col-xs-12 downside" id="ishu">
<div style="border-right:1px solid #EEEEEE; " class="col-lg-12">
<div align="center">
<div id="quad">
<div class="col-lg-12">
<div class="col-lg-1" ></div>
<div class="col-lg-10" style="padding-left: 0px; padding-right: 0px;">

   <? while($new_arrival1=mysql_fetch_assoc($new_arrival)){
		  
		  
 if (strpos($new_arrival1['images'],',') !== false) {
  $new_arrival1_img=explode(',',$new_arrival1['images']);
$new_arrival1_img=$new_arrival1_img[0];
}
else{
  $new_arrival1_img=$new_arrival1['images'];	
}
		
 
		   ?>
    
   <a  style="color:inherit;" href="goods_detail.php?goods_Id=<?php echo $new_arrival1['id']?>">
      
        <div class="col-xs-6 col-lg-3 <? if($row==1){ ?> col-lg-offset-1" <? } ?> align="center" id="japan"  style="padding-left:0px;">
          <div class="product_container" style="background:#E6E6E6; ">
<div class="full" align="center"><span class="product-item_sale"></span> <img src="product_img/<?php echo$new_arrival1_img?>" class="img-thumbnail" style="height:250px;"></div>
<div class="full ka"><span> <?php echo $new_arrival1['product_name']?>...</span></div>
              <div class="full" style="overflow:hidden;">
            
               <?php  if($_SESSION['member_id']){ if($_SESSION['verify_status']==1){ ?>
               <div class="col-lg-12 " align="right"><strike>$<?php echo $new_arrival1['msrp_price']?></strike>   </div>
               <div class="col-lg-12 " align="right"> <span style="color:#FF0000; font-size:20px">Wholesale</span> <span style="font-size:26px;">$<b><?php echo $new_arrival1['wholesale_price']?></b> </span>
              </div>
            
              <? } else {?>
              <div class="col-lg-12 col-md-8" align="right"><strike> $<?php echo $new_arrival1['regular_price']?> </strike>&nbsp; &nbsp; </div><div class="col-lg-12 col-md-8" align="right"><span style="font-size:26px; color:#F00;">
             $<b><?php echo $new_arrival1['msrp_price']?> </b></span> </div>
            
               <? } } ?>
              
            </div>
                <?php  
		  $idx =$new_arrival1['id'];
		    $q=mysql_query("select * from rating where goods_id=$idx");
			
			//echo "select * from rating where goods_id=$idx";
			$numberofrating=mysql_num_rows($q);
			//echo "$numberofrating";
			$star=0;
			//echo $q;
 while($qq=mysql_fetch_assoc( $q)){
	 
  $output = $qq['vid'];
  
  $star=$star+$qq['star'];
//echo $output;
//$st = $qq['star'];
//$out = $qq['star'];
//echo $out;
//echo $output;
//$out2=5-$out;
 }
 
 $average=0;
// echo $star;
 $average=$star/$numberofrating;
 
 
$average=round($average);
//echo "$average";
 $out=$average;
 $out2=5-$out;

?>



 <div class="full">
<span>  <?php for($i=0; $i<$out; $i++) { ?>
            <img src="images/star.PNG"  class="star"> <?php  } ?> <?php for($i=0; $i<$out2; $i++) { ?> 
             <img src="images/fuse-star.PNG"  class="star"> <?php  } ?> <?=$out?>.0
<img src="images/purchage-yellow.png" style="margin-top: 10px; margin-bottom: 17px;" class="shopbtan"></span>
       </div>    
</div>
        </div>
<? } ?><br>
       </a>
      </div>
  <div class="col-lg-1" ></div>
  </div>
</div>
</div>
  </div>            
</div></div>
 
 
 <div class="col-lg-12"  id="sds">
 <p style="text-align: center;"><img src="images/see_more_3.png" class="seemore2"></p></div>
 
 
  <div class="col-lg-12" style="margin-top: 70px;">
 <p style="text-align: center;"><img src="images/new-arrivals.png" class="newarrivals"></p></div>
 

  
  <div class="col-lg-12">
  <p style="text-align: center;"><img src="images/hrline.png" class="line"></p>
</div>
 


 
 
 <div style="border-right:1px solid #EEEEEE;"class="col-lg-12">
<div class="col-lg-1" ></div>


	  
   <div class="col-lg-10 slider1">

								
   <? while($new_arrival1=mysql_fetch_assoc($new_arrivals)){
		  
		  
 if (strpos($new_arrival1['images'],',') !== false) {
  $new_arrival1_img=explode(',',$new_arrival1['images']);
$new_arrival1_img=$new_arrival1_img[0];
}
else{
  $new_arrival1_img=$new_arrival1['images'];	
}
		
 
		   ?>
   
  
        <a style="color:inherit;" href="goods_detail.php?goods_Id=<?php echo $new_arrival1['id']?>">
      
        <div class="col-lg-3 col-md-2 slide" id="japan" style="width:100%;">
          <div class="product_container"  >
          
          
            <div class="full" align="center"><img src="product_img/<?php echo$new_arrival1_img?>" class="img-thumbnail" 
            style="height:200px" ></div>
            
            
            
      <div class="full ka" align="center"><b style="color:#000"> <?php echo $new_arrival1['product_name']?>..</b></div>
              <div class="full" style="overflow:hidden;">
            
               <?php if($_SESSION['member_id']){ if($_SESSION['verify_status']==1){ ?>
               <div class="col-lg-12 col-md-4" align="left"><strike>$<?php echo $new_arrival1['msrp_price']?></strike>   
               <span  class="size">$<b><?php echo $new_arrival1['wholesale_price']?></b> </span>
              </div>
            
              <? } else {?>
              <div class="col-lg-12 col-md-8" align="left"><strike> $<?php echo $new_arrival1['regular_price']?> </strike>&nbsp; &nbsp;<span style="color:#F00;" class="size">
             $<b><?php echo $new_arrival1['msrp_price']?> </b></span> </div>
            
               <? } } ?>
              
            </div>
                <?php  
		  $idx =$new_arrival1['id'];
		    $q=mysql_query("select * from rating where goods_id=$idx");
			
			//echo "select * from rating where goods_id=$idx";
			$numberofrating=mysql_num_rows($q);
			//echo "$numberofrating";
			$star=0;
			//echo $q;
 while($qq=mysql_fetch_assoc( $q)){
	 
  $output = $qq['vid'];
  
  $star=$star+$qq['star'];
//echo $output;
//$st = $qq['star'];
//$out = $qq['star'];
//echo $out;
//echo $output;
//$out2=5-$out;
 }
 
 $average=0;
// echo $star;
 $average=$star/$numberofrating;
 
 
$average=round($average);
//echo "$average";
 $out=$average;
 $out2=5-$out;

?>



 <div class="full">
 
 
 <span>  <?php for($i=0; $i<$out; $i++) { ?>
 <img src="images/star.PNG" style="height:10px; width:10px; display:inline;"> <?php  } ?> <?php for($i=0; $i<$out2; $i++) { ?> 
  <img src="images/fuse-star.png" style="height:10px; width:10px; display:inline;"> <?php  } ?> <?=$out?>.0
			
		</span>
           
           
           <img src="images/purchas.png" style="margin-top: 10px; margin-bottom: 17px;">
           
       </div>    
           
               </div>
        </div>
       
      <? } ?><br>
       </a>
     </div>
       
      


              
              </div>
 
     </div>
       

</div>
<div class="col-lg-12" style="margin:0px; padding:0px" >
  <?php include'foot-new.php'?>
  </div>
  <!--login popup start-->

<div id="overlay-mask-1" class="overlay-mask" style="">
  
 
  <div class="overlay iframe-content"><a class="close close-icon" onClick="close_popup('overlay-mask-1')">
  <span id="close_button" style="position: absolute; text-align: center; width: 100%;">X</span></a>
    <div class="content" style="border:2px solid #97cf00; padding:1em;"> 
    <div class="row" style="width:98%; padding:2em 0;;">
    <div class="col-lg-4 col-xs-12 col-xs-12">
    <div class="full"><img class="img-responsive" src="images/logo1.png"></div>
    <div class="full text-left" style="margin-top:1em; color:#756660;">
    Wholesale Members Only.<br>
    Wholesale allows you to purchase<br>
    Beauty Products for business,<br>
    resale use.<br>
    <a href="about_us.php" style="text-decoration:none;" ><input type="button" class="red-btn" value="About Us" ></a>
    
    </div>
    </div>
     <div class="col-lg-4 col-sm-12 col-xs-12">
     <form action="wholesale_register.php" method="get" >
     <div class="full" style="background:#FBFBFB; border:1px solid #E5E5E5; padding:5%; height:27em;">
     <h3 class="h3">CREATE AN ACCOUNT</h3><hr>
     <div class="full" style="color:#999999; margin-top:1em;">
   Please enter your email address to create an account.
   <div style="font-size:1em; color:#000; margin:1em 0;">
 Email Address
   </div>
   <div class="form-group"><input type="text" name="account_email" id="account_email" class="form-control"></div>
   
   <div class="" style="margin-top:2em;">
  <button type="submit" class="blue-btn glyphicon glyphicon-user" style="background:#268BB9;">
  <span class="" style="color:#FFF">CREATE DEALER ACCOUNT</a></span>
  </button>
   
   </div>
    
     </div>
     
    
     </div>
    </form>
     </div>
      <div class="col-lg-4 col-xs-12 col-xs-12">
       <form name="login_form" action="" method="post" onSubmit="return validate()">
    <div class="full" style="background:#FBFBFB; border:1px solid #E5E5E5; padding:5%;">
     <h3 class="h3">ALREADY REGISTERED ?</h3><hr>
     <div class="full" style="color:#999999; margin-top:1em;">
  
   <div class="" style="font-size:1em; color:#000; margin:1em 0;">
 Email Address
   </div>
   <div class="form-group"><input type="email" id="email_login" name="email_login" class="form-control"></div>
   
    <div class="" style="font-size:1em; color:#000; margin:1em 0;">
 Password
   </div>
   <div class="form-group"><input type="password" name="pwd_login" id="pwd_login" class="form-control"></div>
   
   <div class="" style="margin-top:2em;">
   <span style="text-decoration:underline;"> <a href ="forget_password.php">Forgot Your Password ?</a></span><br>
  <button type="submit" class="blue-btn glyphicon glyphicon-lock" style="background:#268BB9; color:#FFF;">
  <span class="" style="font-family:sans-serif;">SIGN IN</span>
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
      <strong>If you are Beauty Supplier,Please go to <a href="https://ebhahair.com/wholesale_register.php?account_email=" target="_blank">Dealer register page</a></strong>
      </div>
      </div>
      </div>
     
    </div>
    </div>
  
    
    </div>
<!-- login popup end -->
</body>
</html>

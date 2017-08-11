<?php
session_start();

require_once('wp-admin/include/connectdb.php');
$email =$_GET['email'];
 
 if(isset($_POST['email_login'])){
	 
	  $email_login=$_POST['email_login'];
	  $pwd_login=$_POST['pwd_login'];
	 
	
	 
$stmt=$con_pdo->prepare("select * from member where `email`=:email_login and `pwd`=:pwd_login " );
 
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
	 $_SESSION['level'] = $user_info_row['level'];

	 

echo '<script type="text/javascript">
window.location="index.php";
</script>';	 
	 	 
 }
 
 else{
echo '<script type="text/javascript">
alert("You email or password not match! Please try again ");
</script>';	 
 }
 
 }

 
 $country_query=$con_pdo->query("SELECT * FROM `country` where country_name!='' order by country_id asc");
  
 $account_email = $_GET['account_email'];
 
  ?>
<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sign In</title>

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


    </script>
<style type="text/css">
@import url(//fonts.googleapis.com/css?family=Lato:400,700,900);
P
{
	font-family:Georgia, "Times New Roman", Times, serif;
}

.vertical-menu
   {
	   display:none;
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
</style>
<link href="css/custom.css" rel="stylesheet">
</head>
<body>
<div class="full"> 
  <!--header start-->
  

<!--header end--> 

<!--body start-->
<div class="full" id="body_container">
  <div class="container">
  
    
    
    
      <div class="row form-group " style="width:96%; margin:1% 2%; background:#FFF; padding:1%; border: 2px solid #090">
     
	
        <div class="col-lg-8 col-sm-12 col-xs-12 border-bottom-small text-right-small" style="border-right:1px solid #EEEEEE;">
       <div class="full" style="width:95%; margin:0em 0em 2em 1em; margin-left:3%;">
    <h3 align="center">Welcome to Ebhahair.com</h3>
    </div>   
      
         <div class="full" style="margin:.7em 0;">
         
            <p><strong>Thank you for your registeration with ebhahair.com</strong></p>
            <p><strong>If you wish to continue as business membership please follow one of the steps below.</strong></p>
           
          </div>
          
          
            <div class="full" style="margin:.7em 0;">
         
         <p><strong>step A - attach (file attach form need it, jpg, png format) ONE of the business</strong></p>
         <p><strong>documentation down below</strong></p>
                   </div>
            <div class="full" style="margin:.7em 0;">
          <p style="color:#690"><strong>a.State Tax Resale Certificate</strong></p>
          <p style="color:#690"><strong>b.Business Certificate or License</strong></p>
                    </div>
           <div class="full" style="margin:.7em 0;">
          <p><strong>step B - Fax(847-621-2291) or E-mail (info@ebhahair.com) your copy of certificate or license </strong></p>
          </div>
          
          
           <div class="full" style="margin:.7em 0;">
          <p><strong>A confirmation letter will be sent to you after the review of your document.</strong></p>
         <p><strong> This process will take few hours after we recieve your document.</strong>
        </p>
          </div>
 
  <div class="full" style="margin:.7em 0;">
          <p><strong>Please be advised that major of ebhahair.com Products only for the qualified re-sellers in</strong></p>
          <p><strong>beauty industry and beauty product related category.</strong></p>
          <p><strong>ex) nail salon, cosmetic profession, beauty profession, salon owner etc..</strong></p>
        
          </div>
 
  <div class="full" style="margin:.7em 0;">
          <p><strong>If you are not a business owner nor own one of the business category above</strong></p>
          <p><strong>You will be able to check all the products with Retail Price</strong></p>
          <p><strong> only until your application is confirmed.</strong></p>
          </div>
 
              
          
        </div>
    
    <!--right portion start-->  
      
        <div class="col-lg-4 col-sm-12 col-xs-12">
         <form name="login_form" action="" method="post" onSubmit="return validate()">
        <div class="full">
<h3 align="center">Sign in here</h3>
    </div>

   <div class="full" style="margin-top:2em;">
    <div class="col-lg-3"><sup><img src="images/star_red.png" ></sup> Email:</div>
          <div class="col-lg-9 col-sm-12 col-xs-12">
            <input type="email" name="email_login" id="email_login" value="<?=$email?>" class="form-control" onBlur="check_email()" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
  </div>  
  
    <div class="full" style="margin-top:2em;">
    <div class="col-lg-3"><sup><img src="images/star_red.png" ></sup> Password:</div>
          <div class="col-lg-9 col-sm-12 col-xs-12">
            <input type="password" name="pwd_login" id="pwd_login" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
  </div>  
  <div class="full" style="text-align:center;">
        <div class="full" style="margin-top:2em;">
 <span style="text-decoration:underline;"> Forgot Your Password ?</span><br>
  <button type="submit" class="blue-btn glyphicon glyphicon-log-in" style="background:#268BB9; color:#FFF;">
  <span class="" style="font-family:sans-serif;">SIGN IN</span>
  </button>
  
    </div>
          
        </div>
        </form>
        
        
      </div>
      <!-- right portion end-->
    </div>
  </div>
</div>

<!--body end--> 

<!-- footer start-->


<!--footer end  -->

</div>

<!--right sidebar start-->

<!--right sidebar end



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>

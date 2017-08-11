<?php
 session_start();

 require_once('wp-admin/include/connectdb.php');
 
  $member_id=$_SESSION['member_id'];
 
 $GOOD_SHOP_USERID =$_SESSION['GOOD_SHOP_USERID'];
 
 
 
  
 if(isset($_POST['pass']) && $_POST['pass']!='' && $_POST['pass']==$_POST['conf_pass']){ 
  

  
  $email=$_POST['email'];
  $pass =$_POST['pass'];
  $country =$_POST['country'];
  $state=$_POST['state'];
 
  $address1 =$_POST['address1'];
  $address2 =$_POST['address2'];
  $city =$_POST['city'];
  $zipcode = $_POST['zipcode'];
  $f_name = $_POST['f_name'];
  $l_name = $_POST['l_name'];
  $com_name =$_POST['com_name'];
  $tel =$_POST['tel1'].'-'.$_POST['tel2'].'-'.$_POST['tel3'];
  $cel =$_POST['cel1'].'-'.$_POST['cel2'].'-'.$_POST['cel3']; 
  $main_product = $_POST['main_product1'].'-'.$_POST['main_product2'].'-'.$_POST['main_product3'];
  
  $paypal_account = $_POST['paypal_account'];
  
 
 $stmt=mysql_query("update  member set `f_name`='$f_name', `l_name`='$l_name', `email`='$email', `pwd`='$pass', `address1`='$address1', `address2`='$address2', `city`='$city', `state`='$state', `country`='$country', `zipcode`='$zipcode', `main_product`='$main_product', `company_name`='$com_name', `tel`='$tel', `cel`='$cel',`paypal_account`='$paypal_account' where member_id='$member_id' and email='$GOOD_SHOP_USERID' ");
 

 
 header("location:supplier_account.php");
 
  }
 
 $country_query=mysql_query("SELECT * FROM `country` where country_name!='' order by country_id asc");
 
 
  $user_row=mysql_fetch_assoc(mysql_query("SELECT * FROM `member` where member_id='$member_id' and email='$GOOD_SHOP_USERID'"));


 $main_product=explode('-',$user_row['main_product']);
 
 $tel=explode('-',$user_row['tel']);
 
 $cel=explode('-',$user_row['cel']);
 
  ?>
<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Business Info</title>

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

$(document).ready(function(e) {
	var country_val=<?=$user_row['country']?>;
    if(country_val=='230'  || country_val=='45')	{
		$("#state_div").show('fast');	
				
	    	$("#state").load("get_state.php?c_id="+country_val);
			
			}
			else{
		$("#state_div").hide('fast');		
			}
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
	


function Validate(){

var pass,conf_pass,country,address1,address2,city,zipcode,f_name,l_name,com_name,tel1,tel2,tel3,cel1,cel2,cel3,paypal_account;

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
paypal_account=document.getElementById('paypal_account').value;

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
if(paypal_account==''){
alert('Please enter paypal account!');
document.getElementById('paypal_account').focus();
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
	content: "";
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
  <? include('header_supplier.php')?>

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
     
	 <form name="register" action="" method="post" onSubmit="return Validate()">
        <div class="col-lg-8 col-sm-12 col-xs-12 border-bottom-small text-right-small" style="border-right:1px solid #EEEEEE;">
       <div class="full" style="width:95%; margin:0em 0em 2em 1em; margin-left:3%;">
    <span style="color:#999999; font-weight:bold;" >Create Your Account</span> &nbsp;
    <span class="dotted-class" style="width:65%;"></span>
    </div>   
      
         <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Email:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="email" name="email" id="email" value="<?=$user_row['email']?>" readonly class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
            <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Create Password:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="password" name="pass" id="pass" class="form-control" value="<?=$user_row['pwd']?>" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
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
         <select name="country" id="country">
<option value="" selected="selected">Select Country</option>		 
		
	<?php
	  while ($country_result = mysql_fetch_assoc($country_query)) {
	?>	
	<option value="<?=$country_result['country_Id']?>" <? if($user_row['country']==$country_result['country_Id']){ ?> selected<? }?> >
	<?=$country_result['country_name']?></option>
	
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
        <select name="state" id="state" >
<option value="" selected="selected">Select State</option>		
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
            <input type="text" name="city" id="city" class="form-control"  value="<?=$user_row['city']?>" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Zipcode:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="text" name="zipcode" id="zipcode" class="form-control"  value="<?=$user_row['zipcode']?>" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
          <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Main Product:</div>
         <div class="col-lg-8 col-sm-12 col-xs-12">
    <input type="text" class="input-xm" name="main_product1" id="main_product1" value="<?=$main_product[0]?>">-
    <input type="text" placeholder="" class="input-xm" name="main_product2" value="<?=$main_product[1]?>" id="main_product2">-
    <input type="text" placeholder="" class="input-group-sm" name="main_product3" id="main_product3" value="<?=$main_product[2]?>">
          </div>
          </div>
    <div class="full" style="width:95%; margin:3em 0em 2em 1em; margin-left:3%;">
    <span style="color:#999999; font-weight:bold;" >Add Your Contact Information</span> &nbsp;
    <span class="dotted-class" style="width:65%;"></span>
    </div>   
       
        <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> contact Name:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
       <input type="text" class="input-group-sm" name="f_name" id="f_name" placeholder="First Name" value="<?=$user_row['f_name']?>"  >
       <input type="text" class="input-group-sm" name="l_name" id="l_name" placeholder="Last Name" value="<?=$user_row['l_name']?>" >
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Company Name:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
       <input type="text" name="com_name" id="com_name" value="<?=$user_row['company_name']?>" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
       
          </div>
          </div>
          
            <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Tel:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
       <input type="text" name="tel1" id="tel1" class="input-xm" value="<?=$tel[0]?>" >-
       <input type="text" name="tel2" id="tel2" class="input-xm" placeholder="Area" value="<?=$tel[1]?>">- 
	   <input type="text" name="tel3" id="tel3" class="input-group-sm" placeholder="Number" value="<?=$tel[2]?>">       
          </div>
          </div>
         
          <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Cell:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
       <input type="text" name="cel1" id="cel1" class="input-xm" value="<?=$cel[0]?>" >-
       <input type="text" name="cel2" id="cel2" class="input-xm" placeholder="Area" value="<?=$cel[0]?>">- 
	   <input type="text" name="cel3" id="cel3" class="input-group-sm" placeholder="Number" value="<?=$cel[0]?>">       
          </div>
          </div>  
          
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="images/star_red.png" ></sup> Paypal Account:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
       <input type="text" name="paypal_account" id="paypal_account" value="<?=$user_row['paypal_account']?>" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
       
          </div>
          </div>
     
      <div class="full text-center">
        <div class="col-lg-4 col-sm-12 col-xs-12 text-right"></div>
           <div class="col-lg-8 col-sm-12 col-xs-12 text-left" style="padding:.5em 0;">
      <input type="submit" value="Update Wholesale Account" class="blue-btn">
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
   
   <h4 class="h4" style="color:#9B9B9B;">For Beauty Wholesaler Only !</h4>
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
          
        </div>
        
    <!-- right portion end-->    
        
      </div>
    <div class="full text-right" style="color:#F00; padding-right:1em;"><sup><img src="images/star_red.png" ></sup>Required Filed</div>  
      
    </div>
  </div>
</div>

<!--body end--> 

<!-- footer start-->

<? include('footer.php')?>
<!--footer end  -->

</div>

<!--right sidebar start-->
<div id="at4-share" class="addthis_32x32_style atss atss-right addthis-animated slideInRight at4-show"><a class="at4-share-btn at-svc-facebook" href="#"><img src="images/fb.png" ></a> <a class="at4-share-btn at-svc-twitter" href="#"><img src="images/tw.png" ></a><a class="at4-share-btn at-svc-zingme" href="#"><img src="images/ymoo.png" ></a><a class="at4-share-btn at-svc-linkedin" href="#"><img src="images/z.png" ></a><a class="at4-share-btn at-svc-favorites" href="#"><img src="images/p.png" ></a><a class="at4-share-btn at-svc-google_plusone_share" href="#"><img src="images/plus.png" ></a> 
  <!--<div id="at4-scc" class="at-share-close-control ats-transparent at4-show at4-hide-content" title="Hide">
    <div class="at4-arrow at-right">Hide</div>
  </div>--> 
</div>

<!--right sidebar end



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>

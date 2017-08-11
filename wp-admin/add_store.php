<?php
session_start();
require_once('include/connectdb.php');
  $ids=$_GET['id'];
$country_query=$con_pdo->query("SELECT * FROM `country` where country_name!='' order by country_id asc");
$state_query=$con_pdo->query("SELECT * FROM `state` where state_name!='' order by state_id asc");
  $act=$_GET['act'];
  if($ids and $act=='edit'){
    $storeinfo =mysql_fetch_array( mysql_query("SELECT * FROM store where id = $ids"));
	 $storetimemonday=mysql_fetch_array( mysql_query("SELECT * FROM store_times where store_id =$ids and day='MONDAY'"));
	 $storetimetuesday=mysql_fetch_array( mysql_query("SELECT * FROM store_times where store_id =$ids and day='TUESDAY'"));
	 $storetimewednesday=mysql_fetch_array( mysql_query("SELECT * FROM store_times where store_id =$ids and day='WEDNESDAY'"));
	 $storetimethrusday=mysql_fetch_array( mysql_query("SELECT * FROM store_times where store_id =$ids and day='THURSDAY'"));
	 $storetimefriday=mysql_fetch_array( mysql_query("SELECT * FROM store_times where store_id =$ids and day='FRIDAY'"));
	 $storetimesaturday=mysql_fetch_array( mysql_query("SELECT * FROM store_times where store_id =$ids and day='SATURDAY'"));
	 $storetimesunday=mysql_fetch_array( mysql_query("SELECT * FROM store_times where store_id =$ids and day='SUNDAY'"));
	 
	 $adsquery=mysql_query("select * from ads where store_id='$ids'");
	 
	 $copunquery=mysql_query("select * from coupon where store_id='$ids'");
	 
	 $rowstateedit=mysql_fetch_array(mysql_query("select * from state where state_name='$storeinfo[s_state]'"));
	
	
 }
 $s_state_id = $_POST['s_state'];
$rowstate=mysql_fetch_array(mysql_query("select * from state where state_id='$s_state_id'"));
 $s_state= $rowstate['state_name'];
 $s_name = $_POST['s_name'];
 $password = $_POST['password'];
  $country = $_POST['country'];
$b_name = $_POST['b_name'];
$s_location =  $_POST['s_location'];
$s_city = $_POST['s_city'];

$zip = $_POST['zip'];
$s_phone = $_POST['s_phone'];
$address =$_POST['s_city'].",".$_POST['s_state'];
 $target_path1 = "../storeadsimages/";    // file upload path 
 $addimagename1=time().basename( $_FILES['banner_image1']['name']);
 $target_path1 = $target_path1.$addimagename1;
 $S1 =move_uploaded_file($_FILES['banner_image1']['tmp_name'],$target_path1);
  $target_path2 = "../storeadsimages/";    // file upload path 
  $addimagename2=time().basename( $_FILES['banner_image2']['name']);
 $target_path2 = $target_path2.$addimagename2;
 $S2 =move_uploaded_file($_FILES['banner_image2']['tmp_name'],$target_path2);
  $target_path3 = "../couponimages/";    // file upload path 
    $couponimagename1=time().basename( $_FILES['banner_image3']['name']);
 $target_path3 = $target_path3.$couponimagename1;
 $S3 =move_uploaded_file($_FILES['banner_image3']['tmp_name'],$target_path3);
  $target_path4 = "../couponimages/";    // file upload path 
  $couponimagename2=time().basename( $_FILES['banner_image4']['name']);
 $target_path4 = $target_path4.$couponimagename2;
 $S4 =move_uploaded_file($_FILES['banner_image4']['tmp_name'],$target_path4);
 
  $MONDAY = $_POST['MONDAY'];
  
  $TUESDAY = $_POST['TUESDAY'];
  $WEDNESDAY = $_POST['WEDNESDAY'];
  $THURSDAY = $_POST['THURSDAY'];
  $FRIDAY = $_POST['FRIDAY'];
  $SATURDAY = $_POST['SATURDAY'];
  $SUNDAY = $_POST['SUNDAY'];
  $open1 = $_POST['open1'];
  $open2 = $_POST['open2'];
  $open3 = $_POST['open3'];
  $open4 = $_POST['open4'];
  $open5 = $_POST['open5'];
  $open6 = $_POST['open6'];
  $open7 = $_POST['open7'];
  $close1 = $_POST['close1'];
  $close2 = $_POST['close2'];
  $close3 = $_POST['close3'];
  $close4 = $_POST['close4'];
  $close5 = $_POST['close5'];
  $close6 = $_POST['close6'];
  $close7 = $_POST['close7'];
//$address ='Mountain View, CA';

// We get the JSON results from this request
$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$zip.'&sensor=false');
// We convert the JSON to an array
$geo = json_decode($geo, true);
// If everything is cool
if ($geo['status'] = 'OK') {
  // We set our values
  $latitude = $geo['results'][0]['geometry']['location']['lat'];
  $longitude = $geo['results'][0]['geometry']['location']['lng'];
// echo "$latitude--$longitude";
}
echo  mysqli_insert_id($con); 

if(isset($_POST['submit'])){
if($act=='edit'){
	 $sql = "UPDATE store SET `s_name`='$s_name', s_location='$s_location', s_phone='$s_phone', s_city='$s_city', s_state='$s_state', zip='$zip',banner_image='$target_path ', password='$password',lat='$latitude', lng='$longitude', country='$country', b_name='$b_name',state_id='$s_state_id' WHERE id=$ids";
	 //echo "$sql";
	mysql_query($sql);
	if(basename( $_FILES['banner_image1']['name']!='') and $act=='edit'){
	$adsid1=$_POST['adsid1'];
	$sqlbanner1="UPDATE adds SET add_image=$addimagename1' where store_id='$ids' and id='$adsid1'";
	mysql_query($sqlbanner1);
	
	}
	
	if(basename( $_FILES['banner_image2']['name']!='') and $act=='edit'){
	$adsid2=$_POST['adsid2'];
	$sqlbanner2="UPDATE adds SET add_image='$addimagename2' where store_id='$ids' and id='$adsid2'";
	mysql_query($sqlbanner2);
	
	}
	if(basename( $_FILES['banner_image3']['name']!='') and $act=='edit'){
	$copunid1=$_POST['copunid1'];
	$sqlcoupon1="UPDATE coupon SET image='$couponimagename1' where store_id='$ids' and id='$copunid1'";
	mysql_query($sqlcoupon1);
	}
	
	
if(basename($_FILES['banner_image4']['name']!='') and $act=='edit'){
	$copunid2=$_POST['copunid2'];
	$sqlcoupon2="UPDATE coupon SET image='$couponimagename2' where store_id='$ids' and id='$copunid2'";
	mysql_query($sqlcoupon2);
	}
	
	if($MONDAY!='' and $act=='edit'){
	$sql5 = " UPDATE store_times SET open_time='$open1', close_time='$close1' where day='$MONDAY' and store_id='$ids'";
	 
mysql_query($sql5);
	}
	if($TUESDAY!='' and $act=='edit'){
	$sql6 = "UPDATE store_times SET open_time='$open2', close_time='$close2' where day='$TUESDAY' and store_id='$ids' ";
   mysql_query($sql6);
	}
	if($WEDNESDAY!='' and $act=='edit'){
	$sql7 = "UPDATE store_times SET open_time='$open3', close_time='$close4' where day='$WEDNESDAY' and store_id='$ids'";
mysql_query($sql7);
	}
	if($THURSDAY!='' and $act=='edit'){
	$sql8 = "UPDATE store_times SET open_time='$open4', close_time='$close4' where day='$THURSDAY' and store_id='$ids'";
mysql_query($sql8);
	}
	if($FRIDAY!='' and $act=='edit'){
	$sql9 = "UPDATE store_times SET open_time='$open5', close_time='$close5' where day='$FRIDAY' and store_id='$ids'";
mysql_query($sql9);
	}
	if($SATURDAY!='' and $act=='edit'){
	$sql10 = "UPDATE store_times SET open_time='$open6', close_time='$close6' where day='$SATURDAY' and store_id='$ids'";
mysql_query($sql10);
	}
	if($SUNDAY!='' and $act=='edit'){
	$sql11 = " UPDATE store_times SET open_time='$open7', close_time='$close7' where day='$SUNDAY' and store_id='$ids'";
mysql_query($sql11);
	}
	
	
	}else{
	 $sql = "INSERT INTO store (s_name, password, b_name, s_location, s_city, s_state, zip, s_phone,lat,lng,country,state_id) VALUES ('$s_name', '$password', '$b_name','$s_location','$s_city', '$s_state','$zip','$s_phone','$latitude','$longitude','$country','$s_state_id')";

	  mysql_query($sql);
	 $storeid= mysql_insert_id();
	 
if($target_path1!=' '){
	$sql1 = "INSERT INTO adds (add_image,store_id) VALUES ('$addimagename1','$storeid')";
	mysql_query($sql1);
	}
	
	
	
	if($target_path2!=' '){
	$sql2 = "INSERT INTO adds (add_image,store_id) VALUES ('$addimagename2','$storeid')";
	mysql_query($sql2);
	}
	
	
	

if($target_path3!=' '){
	$sql3 = "INSERT INTO coupon (image,store_id) VALUES ('$couponimagename1','$storeid')";
mysql_query($sql3);
	}
	
	
	
	
	if($target_path4!=' '){
	$sql4 = "INSERT INTO coupon (image,store_id) VALUES ('$couponimagename2','$storeid')";
mysql_query($sql4);
	}


if($MONDAY!=''){
	$sql5 = "INSERT INTO store_times (open_time,close_time,day,store_id) VALUES ('$open1','$close1','$MONDAY','$storeid')";
	 
mysql_query($sql5);
	}
	if($TUESDAY!=''){
	$sql6 = "INSERT INTO store_times (open_time,close_time,day,store_id) VALUES ('$open2','$close2','$TUESDAY','$storeid')";
mysql_query($sql6);
	}
	if($WEDNESDAY!=''){
	$sql7 = "INSERT INTO store_times (open_time,close_time,day,store_id) VALUES ('$open3','$close4','$WEDNESDAY','$storeid')";
mysql_query($sql7);
	}
	if($THURSDAY!=''){
	$sql8 = "INSERT INTO store_times (open_time,close_time,day,store_id) VALUES ('$open4','$close4','$THURSDAY','$storeid')";
mysql_query($sql8);
	}
	if($FRIDAY!=''){
	$sql9 = "INSERT INTO store_times (open_time,close_time,day,store_id) VALUES ('$open5','$close5','$FRIDAY','$storeid')";
mysql_query($sql9);
	}
	if($SATURDAY!=''){
	$sql10 = "INSERT INTO store_times (open_time,close_time,day,store_id) VALUES ('$open6','$close6','$SATURDAY','$storeid')";
mysql_query($sql10);
	}
	if($SUNDAY!=''){
	$sql11 = "INSERT INTO store_times (open_time,close_time,day,store_id) VALUES ('$open7','$close7','$SUNDAY','$storeid')";
mysql_query($sql11);
	}
	  
}
//  $sql2 = "INSERT INTO adds (image1, image2) VALUES ('$target_path1', '$target_path2')";

header("location:http://fahair.com/wp-admin/store.php?tab=store");	
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>ADD Product</title>

<link href="style/style.css" rel="stylesheet" type="text/css" />
<link href="style/design.css" rel="stylesheet" type="text/css"  />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="../ckeditor/ckeditor.js"></script>

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
	opas_city: 1;
	position: absolute;
	right: -2em;
	top: -2em;
	width: 32px;
}
.overlay .close-icon {
	cursor: pointer;
	float: right;
}
.full-margin{
	margin:2em;
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
	background: transparent url("http://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/br_down.png") no-repeat right center;
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
.full-margin{
	margin:0em;
}
}
.border-class{
	border: 1px solid #e1e1e1;
}
.border-bottom{
	border-bottom:1px solid #e1e1e1;
	margin:.5em 0;
}
.zero-padding{
	padding:0px !important;
	line-height:1.2em;
}
.dotted-text{
	overflow: hidden !important;
    text-overflow: ellipsis;
    white-space: nowrap !important;
}
#option_setup_div{
	display:none;
}
</style>
<link href="../css/custom.css" rel="stylesheet">
</head>



<body style="font-size:16px;">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td><? include('header.php')?></td>

  </tr>

  <tr>

    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td width="20%" valign="top"><? include('left_menu.php');?></td>

        <td width="80%" valign="top"><table width="100%" border="0" cellspacing="10" cellpadding="0">

          
          <tr>

            <td>

              <table width="100%" border="0" cellspacing="10" cellpadding="0">

                <tr>

                  <td width="100%"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                      <td class="lite-blue-bx"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                        <tr>

                          <td   ><img src="images/lft-menu-hd-corner-1.png" width="10" height="35" /></td>

                          <td width="99%" class="blue-bx-topmid-bg" ><table width="100%" border="0" cellspacing="5" cellpadding="0">

                            <tr>

                              <td align="left" class="white-18"> Add Store </td>

                            </tr>

                          </table></td>
                           
                          <td width="0%" ><img src="images/lft-menu-hd-corner-2.png" width="10" height="35" /></td>

                        </tr>
                        
                        
                        <tr><td  colspan="3" align="center" width="100%">
                         
                         <form  method="post" enctype="multipart/form-data" autocomplete="off" >
                         <?
						$adsqueryrow1=mysql_fetch_array($adsquery);
						$adsqueryrow2=mysql_fetch_array($adsquery);
						 
						 ?>
                         <input type="hidden" value="<?=$adsqueryrow1['id']?>" name="adsid1" />
                         <input type="hidden" value="<?=$adsqueryrow1['id']?>" name="adsid2" />
                         
                         <?
						 $copunqueryrow1=mysql_fetch_array($copunquery);
						 $copunqueryrow2=mysql_fetch_array($copunquery);
						 ?>
                        <input type="hidden" value="<?=$copunqueryrow1['id']?>" name="copunid1" />
                         <input type="hidden" value="<?=$copunqueryrow1['id']?>" name="copunid2" />
               
          
          
          
     <div class="col-lg-12">
       <div class="col-lg-6" align="left"><br />
     
      <b>Business Information</b>
     
          </div>
     
       <div class="col-lg-6">
     
      <div > <font size="+1">Store Name *</font>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input  type="text" name="s_name" maxlength="50" size="30"  value="<?=$storeinfo['s_name']?>" style="height:25px;" autocomplete="off" >
                                    </div><br />
                                    <div > <font size="+1">Store Password *</font>
                                        <input  type="password" name="password" maxlength="50" size="30" value="<?=$storeinfo['password']?>" style="height:25px;"></div>
                                        <br />
<div> <font size="+1">Business Name</font><br /><input  type="text" name="b_name" maxlength="70" size="30" value="<?=$storeinfo['b_name']?>" style="height:25px; width:400px;"></div>
<br />
 <div><font size="+1">Country/Region</font><br /><select name="country" style="width:400px; height:30px;" id="country" >
  <option value="" selected="selected" >Select Country</option>		 
		
	<?php
	  while ($country_result = $country_query->fetch(PDO::FETCH_ASSOC)) {
	?>	
	<option value="<?=$country_result['country_Id']?>" <? if($country_result['country_Id']==$storeinfo['country']){?> selected="selected" <? }?>><?=$country_result['country_name']?></option>
	
	<?php } ?>

</select>

 <script type="text/javascript">
			$("#country").change(function(){
			if($("#country").val()=='230'  || $("#country").val()=='45')	{
		$("#state_div").show('fast');	
				
	    	$("#state").load("../get_state.php?c_id="+$("#country").val());
			
			}
			else{
		$("#state_div").hide('fast');		
			}
						});		

                                       </script> 
</div>
                                    <br />
                                     <div><font size="+1">Street Address</font><br />
                                          <input  type="text" name="s_location" maxlength="50" size="30"  value="<?=$storeinfo['s_location']?>" style="height:25px; width:400px;">
                                     </div><br />
                                   
                                  
                                     <div><font size="+1">City</font><br /><input  type="text" name="s_city" maxlength="50" size="30"  value="<?=$storeinfo['s_city']?>" style="height:25px;width:400px;"></div>
                                    <br />
                                        <div class="col-lg-6">
                                    <div class="col-lg-3"><font size="+1">State</font><br />
                                     <select  name="s_state" id="state" style="height:25px; width:400px;" >
                                      <option value="" selected="selected" >Select State</option>		 
		
	<?php
	  while ($state_result = $state_query->fetch(PDO::FETCH_ASSOC)) {
	?>	
	<option value="<?=$state_result['state_id']?>" <? if($state_result['state_name']==$storeinfo['s_state']){?> selected="selected" <? }?>><?=$state_result['state_name']?></option>
	
	<?php } ?>
                                       	
		                              </select>
                                    
</div>
<div class="col-lg-3"><font size="+1">ZIP code</font><br /><input  type="text" name="zip" maxlength="50" size="30"  value="<?=$storeinfo['zip']?>"  style="height:25px;width:400px;"> </div></div><br />
 <div><font size="+1">Main Business Phone</font><br /><input  type="text" name="s_phone" maxlength="50" size="30"  value="<?=$storeinfo['s_phone']?>" style="height:25px;width:400px;"></div>
                                    
                                    
                                    
          </div>
          <div class="col-lg-12">
       <div class="col-lg-6" align="left" >
      <b>ADD Image</b></div>
       <div class="col-lg-6" align="center">
                                        
                                        <div style="margin-bottom:10px;"><input  type="file" name="banner_image1" maxlength="50" size="30">
  </div>
                                  
                                    <div><input  type="file" name="banner_image2" maxlength="50" size="30">
  </div>
  <div class="col-lg-3" align="left">
      <b>coupon Image</b></div>
                                     <div style="margin-bottom:10px;"><input  type="file" name="banner_image3" maxlength="50" size="30">
  </div>
                                    <div><input  type="file" name="banner_image4" maxlength="50" size="30">
  </div>         
                            </div></div>
                           
                                     <div class="col-lg-12">
       <div class="col-lg-6" align="left">
      <b>Opening Hours</b></div>
       <div class="col-lg-6" align="center">
          <input  type="text" name="MONDAY" placeholder="Day" style="height:25px;width:170px;" value="MONDAY">&nbsp;
          <input type="text" name="open1"  placeholder="Opening Time" style="height:25px;width:90px;" value="<?=$storetimemonday['open_time']?>"/>-<input type="text" name="close1"  placeholder="Closing Time" style="height:25px;width:85px;" value="<?=$storetimemonday['close_time']?>"/><br /><br />
          <input  type="text" name="TUESDAY" placeholder="Day" style="height:25px;width:170px;" value="TUESDAY">&nbsp;
          <input type="text" name="open2" placeholder="Opening Time" style="height:25px;width:90px;" value="<?=$storetimetuesday['open_time']?>" />-<input type="text" name="close2" style="height:25px;width:85px;" placeholder="Closing Time"  value="<?=$storetimetuesday['close_time']?>"/><br /><br />
          
          <input  type="text" name="WEDNESDAY" placeholder="Day" style="height:25px;width:170px;" value="WEDNESDAY" >&nbsp;
          <input type="text"name="open3" placeholder="Opening Time" style="height:25px;width:90px;" value="<?=$storetimewednesday['open_time']?>" />-<input type="text" name="close3" style="height:25px;width:85px;" placeholder="Closing Time" value="<?=$storetimewednesday['close_time']?>" /><br /><br />
          
          <input  type="text" name="THURSDAY" placeholder="Day" style="height:25px;width:170px;" value="THURSDAY">&nbsp;
          <input type="text"name="open4" placeholder="Opening Time" style="height:25px;width:90px;" value="<?=$storetimethrusday['open_time']?>" />-<input type="text" name="close4" style="height:25px;width:85px;" placeholder="Closing Time" value="<?=$storetimethrusday['close_time']?>"/><br /><br />
          
          <input  type="text" name="FRIDAY" placeholder="Day" style="height:25px;width:170px;" value="FRIDAY">&nbsp;
          <input type="text" name="open5" placeholder="Opening Time" style="height:25px;width:90px;" value="<?=$storetimefriday['open_time']?>"/>-<input type="text" name="close5" style="height:25px;width:85px;" placeholder="Closing Time" value="<?=$storetimefriday['close_time']?>"/><br /><br />
          
          <input  type="text" name="SATURDAY" placeholder="Day" style="height:25px;width:170px;" value="SATURDAY">&nbsp;
          <input type="text"  name="open6" placeholder="Opening Time" style="height:25px;width:90px;" value="<?=$storetimesaturday['open_time']?>"/>-<input type="text" name="close6" style="height:25px;width:85px;" placeholder="Closing Time" value="<?=$storetimesaturday['close_time']?>"/><br /><br />
          
          <input  type="text" name="SUNDAY" placeholder="Day" style="height:25px;width:170px;" value="SUNDAY">&nbsp;
          <input type="text" name="open7" placeholder="Opening Time" style="height:25px;width:90px;" value="<?=$storetimesunday['open_time']?>"/>-<input type="text" name="close7" style="height:25px;width:85px;" placeholder="Closing Time" value="<?=$storetimesunday['close_time']?>" /><br /></div></div>                  
          </div>
                  
                  <div class="col-lg-12"  style="margin-top:10px;">
                   <input type="submit" value="Submit" name="submit">
                  </div>       </form>
                        
                        
                        
                        
                        </td> </tr>
                        
                        
                        
                        </table></td></tr>
                        
                        


     <tr>

            <td>&nbsp;</td>

          </tr>

        </table></td>

      </tr>

   </td>

  </tr>
  

  <tr>

    <td><? include('footer.php')?></td>

  </tr>

</table>


</body>

</html>


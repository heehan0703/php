<?
ini_set('display_errors', '1');
session_start();
header("Cache-Control: no cache");
session_cache_limiter("private_no_expire");
require_once('../wp-admin/include/connectdb.php');
if(!$_SESSION['ISR_ID']){
header("location:signin.php");
}
$mem_id=$_SESSION['ISR_ID'];
//echo "dhirecndra";
$name=$_SESSION['ISR_NAME'];
$product=mysql_query("select * from product ");


$resultpopup=mysql_query("select * from member where ISR=$mem_id");

$buyer_id=$_POST['user'];
//echo "test--$buyer_id";
$row_buyer=mysql_fetch_array(mysql_query("select * from member where member_id='$buyer_id'"));
$_SESSION['buyer_type']=$row_buyer['i_am'];
$_SESSION['buyer_id']=$buyer_id;


if($_POST['search_text']){
$searchcat=$_POST['search_cat'];
$search_text=$_POST['search_text'];
//echo "select * from product where category='$searchcat 'product_name like '%$search_text%' or description like '%$search_text%'";
if(!$search_text){
$product=mysql_query("select * from product where category='$searchcat'");
}else{
  $product=mysql_query("select * from product where category='$searchcat' and product_name like '%$search_text%' or description like '%$search_text%'");
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>EBHA-ISR / INVENTORY</title>
  <meta name="description" content="EBHA-ISR / INVENTORY" />
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="images/logo.png">
  <meta name="apple-mobile-web-app-title" content="Flatkit">
  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" sizes="196x196" href="images/logo.png">
  
  <!-- style -->
  <link rel="stylesheet" href="css/animate.css/animate.min.css" type="text/css" />
  <link rel="stylesheet" href="css/glyphicons/glyphicons.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/material-design-icons/material-design-icons.css" type="text/css" />
  <link rel="stylesheet" href="css/ionicons/css/ionicons.min.css" type="text/css" />
  <link rel="stylesheet" href="css/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="css/bootstrap/dist/css/bootstrap.min.css" type="text/css" />

  <!-- build:css css/styles/app.min.css -->
  <link rel="stylesheet" href="css/styles/app.css" type="text/css" />
  <link rel="stylesheet" href="css/styles/style.css" type="text/css" />
  <!-- endbuild -->
  <link rel="stylesheet" href="css/styles/font.css" type="text/css" />
   <style type="text/css">
   .overlay-mask{background:none repeat scroll 0 0 rgba(28, 45, 50, 0.8);bottom:0;height:100%;left:0;position:fixed;right:0;top:0;width:100%;z-index:999999;display:none;overflow-y:auto;overflow-x:hidden;}
.overlay.iframe-content{border:2em solid #fff;border-radius:6px;box-sizing:content-box;padding:0;width:23%;}
.overlay{background:none repeat scroll 0 0 #fff;border-radius:3px;box-shadow:0 1px 3px rgba(23, 74, 104, 0.35), 0 0 32px rgba(60, 82, 93, 0.35);box-sizing:border-box;margin:50px auto 0;padding:30px;position:relative;}
.overlay.iframe-content .title{border:medium none;margin:0;position:absolute;}
.overlay .title{border-bottom:1px solid #e2e8ea;margin-bottom:20px;}
.overlay .close-icon{font:32px Dingbatz;color:#b3c5d0;content:"?";display:block;font:bold 20px "Dingbatz";position:absolute;right:0;}
.overlay.iframe-content .close-icon{background:none repeat scroll 0 0 #000;border-radius:32px;color:white;height:32px;opacity:1;position:absolute;right:-2em;top:-2em;width:32px;}
.overlay .close-icon{cursor:pointer;float:right;}
.projecthead{
font-size: 100%;
}

.img1{
 height:85px; width:auto;

}

@media only screen and (max-width:600px) {  
}

@media screen and (max-width: 640px) {
	table {
		overflow-x: auto;
		display: block;
	}
	.text-right {
    text-align: left;
}
.img1{
width:100%; max-width:100%;
height:auto;

}
.projecthead{
font-size: 50%;
}
	
	html, body{
    height:100%;
    width:100%;
    padding:0;
    margin:0;
}
.imagew{
}
}

  </style>
  <script  type="text/javascript">
function searchsub()
{
var searchtext=$("#search_text").val();
var obj="document.searchproduct";
if(!searchtext){
    alert ("please Enter the search text");
	$("#search_text").focus();
	//document.searchproduct.search_text.focus();
	return false;
	}else{
	
	
	document.searchproduct.action = "inventory.php";
	document.forms["searchproduct"].submit();
	//$("#searchproduct").submit();
	//var x = document.getElementsByClassName("searchproduct");
//x[0].submit();
		//document.searchproduct.submit();
		//document.getElementById("searchproduct").submit();
	}
}

function show(){$("#overlay-mask-1").fadeIn('slow');}
 </script>   
   <script type="text/javascript">
  function show(){$("#overlay-mask-1").fadeIn('slow');}
  
  function subpopup(){
  $("#pop_form").submit();
 
  }
  
  </script>
  
</head>

<body>
 <div class="app" id="app">

<!-- ############ LAYOUT START-->

<?php include'isr_left.php'?>
  <!-- content -->
  <div id="content" class="app-content box-shadow-z2 bg " role="main">
    <div class="app-header white bg b-b">
          <div class="navbar" data-pjax>
                <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up p-r m-a-0">
                  <i class="ion-navicon"></i>
                </a>
                <div class="navbar-item pull-left h5" id="pageTitle">Product List</div>
                <!-- nabar right -->
                <ul class="nav navbar-nav pull-right">
                  <li class="nav-item dropdown pos-stc-xs">
                    <a class="nav-link" data-toggle="dropdown">
                      <i class="ion-android-search w-24"></i>
                    </a>
                    <div class="dropdown-menu text-color w-md animated fadeInUp pull-right">
                      <!-- search form -->
                      <form class="navbar-form form-inline navbar-item m-a-0 p-x v-m" role="search">
                        <div class="form-group l-h m-a-0">
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search projects...">
                            <span class="input-group-btn">
                              <button type="submit" class="btn white b-a no-shadow"><i class="fa fa-search"></i></button>
                            </span>
                          </div>
                        </div>
                      </form>
                      <!-- / search form -->
                    </div>
                  </li>
                  <li class="nav-item dropdown pos-stc-xs">
                    <a class="nav-link clear" data-toggle="dropdown">
                      <i class="ion-android-notifications-none w-24"></i>
                      <span class="label up p-a-0 danger"></span>
                    </a>
                    <!-- dropdown -->
                    <div class="dropdown-menu pull-right w-xl animated fadeIn no-bg no-border no-shadow">
                        <div class="scrollable" style="max-height: 220px">
                          <ul class="list-group list-group-gap m-a-0">
                            <li class="list-group-item dark-white box-shadow-z0 b">
                              <span class="pull-left m-r">
                                <img src="images/a0.jpg" alt="..." class="w-40 img-circle">
                              </span>
                              <span class="clear block">
                                Use awesome <a href="#" class="text-primary">animate.css</a><br>
                                <small class="text-muted">10 minutes ago</small>
                              </span>
                            </li>
                            <li class="list-group-item dark-white box-shadow-z0 b">
                              <span class="pull-left m-r">
                                <img src="images/a1.jpg" alt="..." class="w-40 img-circle">
                              </span>
                              <span class="clear block">
                                <a href="#" class="text-primary">Joe</a> Added you as friend<br>
                                <small class="text-muted">2 hours ago</small>
                              </span>
                            </li>
                            <li class="list-group-item dark-white text-color box-shadow-z0 b">
                              <span class="pull-left m-r">
                                <img src="images/a2.jpg" alt="..." class="w-40 img-circle">
                              </span>
                              <span class="clear block">
                                <a href="#" class="text-primary">Danie</a> sent you a message<br>
                                <small class="text-muted">1 day ago</small>
                              </span>
                            </li>
                          </ul>
                        </div>
                    </div>
                    <!-- / dropdown -->
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link clear" data-toggle="dropdown">
                      <span class="avatar w-32">
                        <img src="images/a3.jpg" class="w-full rounded" alt="...">
                      </span>
                    </a>
                    <div class="dropdown-menu w dropdown-menu-scale pull-right">
                      <a class="dropdown-item" href="profile.html">
                        <span>Profile</span>
                      </a>
                      <a class="dropdown-item" href="setting.html">
                        <span>Settings</span>
                      </a>
                      <a class="dropdown-item" href="app.inbox.html">
                        <span>Inbox</span>
                      </a>
                      <a class="dropdown-item" href="app.message.html">
                        <span>Message</span>
                      </a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="docs.html">
                        Need help?
                      </a>
                      <a class="dropdown-item" href="signout.php">Sign out</a>
                    </div>
                  </li>
                </ul>
                <!-- / navbar right -->
          </div>
    </div>
   
	
                                 

                            

    <div class="app-body" style="height:100%;  right:0; top:0; z-index:1; visibility:visible; visibility:; visibility: margin:0 auto; text-align:center;">
	<br><div align="center" style=" margin:0 auto; text-align:center;"><table align="center" style=" margin:0 auto;"><tr>

                             
                              
                                 <td  align="center" class="white-18" style=" margin:0 auto;">
                       <form  name="searchproduct" method="post" class="searchproduct" id="searchproduct"  onSubmit="" >        
                               <select style="height:25px;" name="search_cat">
                               <option value="">All Categories</option>
                                                   <option value="Weaves">WEAVES</option>   
                      <option value="WIGS">WIGS</option>  
                      <option value="TOP PIECES">TOP PIECES</option>  
                      <option value="HAIR PIECES">HAIR PIECES</option>  
                      <option value="BRAIDS">BRAIDS</option>  
            
     
                               </select><input type="text" name="search_text" placeholder="Search..."  id="search_text" />
                                <input  type="button" value="Search" style="border:0px; background:#2992C1; color:#fff; height:25px; cursor:pointer;" onClick="searchsub()" />
                               </form>
                               </td>
                                
                               
                               </tr></table></div>

    <div id="datatable" style="width:100%">
    <script  type="text/javascript">
 
 function cart_add(Obj)
{
//alert("dhirendra");
	Obj.action = "cart.php?act=add";
	Obj.submit();
}

  
  </script>
  
  
 
  
  
      <table class="table  " style="width:100%; padding:0px; margin:0px; table-layout:fixed"  width="100%" border="0" cellspacing="0" cellpadding="0">
        
        
        
            <tr>
            <td  style="width:45%;padding:0px; margin:0px;" ><span class="projecthead"><b>PRODUCT NAME</b></span></td>
            <td style="width:20%;padding:0px; margin:0px;" class="imagew"><span class="projecthead"><b>IMAGE</b></span></td>
            <td style="width:10%;padding:0px; margin:0px;" ><span class="projecthead"><b>CATEGORY</b></span></td>
                    <? if($_SESSION['buyer_type']=="Agent"){ ?> <td  style="width:10%;padding:0px; margin:0px;" ><span class="projecthead" ><b>AGENT PRICE</b></span></td> <? } ?>
                        <td style="width:10%;padding:0px; margin:0px;" ><span class="projecthead" ><b>MSRP </b></span></td>
            <td style="width:5%;padding:0px; margin:0px;"><span class="projecthead"><b>DETAIL</b></span></td>
                    </tr>
       
       
                  <?
				  $cart_cnt=0;
				   while($productrow=mysql_fetch_array($product)){
				  $cart_cnt++;
				  
				   if (strpos($productrow['images'],',') !== false) {
  $product_img=explode(',',$productrow['images']);
  $product_img=$product_img[0];
}
else{
  $product_img=$productrow['images'];	
}
				   ?>  
                   <form name="cartForm<?=$cart_cnt?>" method="post" id="cartForm<?=$cart_cnt?>">
		     
                  <tr>
            <td style="width:45%;padding:0px; margin:0px;"><span class="projecthead"><?=$productrow['product_name']?></span></td>
            <td style="width:20%;padding:0px; margin:0px; text-align:center;" class="imagew"><img src="../product_img/<?=$product_img?>" border="0" class="img1" ></td>
            <td style="width:15%;padding:0px; margin:0px; padding-left:4px;"><span class="projecthead"><?=$productrow['category']?></span></td>
                      <? if($_SESSION['buyer_type']=="Agent"){ ?>    <td  style="width:10%;padding:0px; margin:0px;" ><span class="projecthead">$<? $wholesaleprice= number_format((float)$productrow['agentprice1'], 2, '.', '');  ?><?=$wholesaleprice?></span></td> <? }?>
                        <td  style="width:10%;padding:0px; margin:0px;" ><span class="projecthead">$
					<? 	$msrp= number_format((float)$productrow['wholesale_price'], 2, '.', '');  ?>
						
						<?=$msrp?></span></td>
            <td style="width:5%;padding:0px; margin:0px;"><input  type="hidden" name="goodsId" value="<?=$productrow['id']?>"><span class="projecthead"><font color="#0070C0"><a href="inventory_detail.php?productid=<?=$productrow['id']?>">INVENTORY&nbsp;&nbsp; </a> <!--<a href="javascript:cart_add(document.cartForm<?=$cart_cnt?>);"  > ORDER</a></font></span>--></td>
                    </tr>
                    </form>
                     <? } ?>
                    
                  
        
      </table>
    </div>          
  </div>
       <div align="center"> <p><span class="red-18" style="box-sizing: border-box; display: inline-block; width: 30px; border: 2px solid blue; line-height: 25px; text-align: center; vertical-align: middle; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space:
normal; widows: 2; word-spacing:
0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><b style="box-sizing: border-box; font-weight: 700;">1</b></span><span style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: right; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width:
0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span></span><span class="blue-12" onClick="dhirendra(2)" style="box-sizing: border-box; display: inline-block; width: 30px; border: 2px solid black; line-height: 25px; text-align: center; vertical-align: middle; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps:
normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">&nbsp;2&nbsp;</span><span style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align:
right; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span></span><span class="blue-12" onClick="dhirendra(3)" style="box-sizing: border-box; display: inline-block; width: 30px; border: 2px solid black; line-height: 25px; text-align: center; vertical-align: middle; color: rgb(51, 51, 51); font-family: &quot;Helvetica
Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">&nbsp;3&nbsp;</span><span style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style:
normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: right; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span></span><span class="blue-12" onClick="dhirendra(4)" style="box-sizing: border-box; display: inline-block; width: 30px;
border: 2px solid black; line-height: 25px; text-align: center; vertical-align: middle; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">&nbsp;4&nbsp;</span><span
style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: right; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span></span><span
class="blue-12" onClick="dhirendra(5)" style="box-sizing: border-box; display: inline-block; width: 30px; border: 2px solid black; line-height: 25px; text-align: center; vertical-align: middle; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2;
word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">&nbsp;5&nbsp;</span><span style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: right; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color:
rgb(255, 255, 255); display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span></span><span class="blue-12" onClick="dhirendra(6)" style="box-sizing: border-box; display: inline-block; width: 30px; border: 2px solid black; line-height: 25px; text-align: center; vertical-align: middle; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight:
normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">&nbsp;6&nbsp;</span><span style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: right; text-indent:
0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span></span><span class="blue-12" onClick="dhirendra(7)" style="box-sizing: border-box; display: inline-block; width: 30px; border: 2px solid black; line-height: 25px; text-align: center; vertical-align: middle; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica,
Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">&nbsp;7&nbsp;</span></p></DIV>
        <p><!-- ############ PAGE END-->
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>


    </div>
  </div>
  <!-- / -->

  
  <!-- ############ SWITHCHER START-->
   
<!-- ############ SWITHCHER END-->

<!-- ############ LAYOUT END-->
</div>
<!-- build:js scripts/app.min.js -->
<!-- jQuery -->
  <script src="libs/jquery/dist/jquery.js"></script>
<!-- Bootstrap -->
  <script src="libs/tether/dist/js/tether.min.js"></script>
  <script src="libs/bootstrap/dist/js/bootstrap.js"></script>
<!-- core -->
  <script src="libs/jQuery-Storage-API/jquery.storageapi.min.js"></script>
  <script src="libs/PACE/pace.min.js"></script>
  <script src="libs/jquery-pjax/jquery.pjax.js"></script>
  <script src="libs/blockUI/jquery.blockUI.js"></script>
  <script src="libs/jscroll/jquery.jscroll.min.js"></script>

  <script src="scripts/config.lazyload.js"></script>
  <script src="scripts/ui-load.js"></script>
  <script src="scripts/ui-jp.js"></script>
  <script src="scripts/ui-include.js"></script>
  <script src="scripts/ui-device.js"></script>
  <script src="scripts/ui-form.js"></script>
  <script src="scripts/ui-modal.js"></script>
  //<script src="scripts/ui-nav.js"></script>
  <script src="scripts/ui-list.js"></script>
  <script src="scripts/ui-screenfull.js"></script>
  <script src="scripts/ui-scroll-to.js"></script>
  <script src="scripts/ui-toggle-class.js"></script>
  
  
<!-- endbuild -->

<!--login popup start-->

<div id="overlay-mask-1" class="overlay-mask" style="" onKeyPress="test(event)">
  

  <div class="overlay iframe-content" style="height:200px;">
    <div class="content" style="float:left; "> 
      <div class="row">
  
   
    
      <div class="col-lg-12 col-xs-12 col-xs-12">
       <form name="pop_form" action="./inventory.php" method="post"   autocomplete="on"  id="pop_form">
        
    <div class="full" style="background:#FBFBFB; border:1px solid #E5E5E5; padding:5%;">
     <div class="full"></div>
  
   
     <h3 class="h3">Select Buyer</h3>
     <select style="width:250px; height:30px; background:#999999; border:1px solid #000000" name="user">
     <? while($userrowpopup=mysql_fetch_array($resultpopup)){ ?>
     <option value="<?=$userrowpopup['member_id']?>"><?=$userrowpopup['f_name']?>&nbsp;<?=$userrowpopup['l_name']?> &nbsp;( <?=$userrowpopup['i_am']?>) </option>
	 <? } ?>
     </select>
     <div class="full" style="color:#999999; margin-top:1em;">
     
     <div id="berror" style="color:#FF0000" ></div>
  
   <div id="uerror" style="color:#FF0000" ></div>
   <div class="form-group">
   
   
   
   
   </div>
   
   
   <div id="perror" style="color:#FF0000" ></div>
  
   
   
   <div class="" style="margin-top:2em;">
   
   <div style=" text-align:center width:100%">
   <div style="margin-bottom:10px;">
   <button type="button"  class="blue-btn glyphicon " onClick="subpopup()" style="background:#268BB9; color:#FFF; width:85%; height:35px;">
   <span class="" style="font-family:sans-serif;" > INVENTORIES</span>
   </button>
   </div>
   <div>
       
       <a href="./add-buyer.php"><button type="button"  class="blue-btn glyphicon "  style="background:#268BB9; color:#FFF; width: 85%;height:35px;">
      <span class="" style="font-family:sans-serif;" >ADD BUYER</span>
      </button></a>
  </div>
  
   </div>
   
 
   
   </div>
     </div>
     </div> 
     </form>  
      </div>
    </div>
   
     
  </div>
    </div>
  
    
    </div>
<!-- login popup end -->

</body>
</html>

 
<?
ini_set('display_errors', '1');
session_start();
require_once('../wp-admin/include/connectdb.php');
if(!$_SESSION['ISR_ID']){
header("location:signin.php");
}
$mem_id=$_SESSION['ISR_ID'];
//echo "dhirecndra";
$name=$_SESSION['ISR_NAME'];
$product=mysql_query("select * from product ");

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
  <title>aside - Bootstrap 4 web application</title>
  <meta name="description" content="Responsive, Bootstrap, BS4" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
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
  .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th {
    padding-left: 0px;
    padding-right: 0px;
	 

    
}

@media only screen and (max-width:600px) {

    .projecthead {
	font-size:8px;
	
    }
	.projectheadprice{
	width:10px;
	padding-left:0px;
	padding-right:0px;
	margin-left:0px;
	margin-right:0px;
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
                <div class="navbar-item pull-left h5" id="pageTitle">Dashboard</div>
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
                      <a class="dropdown-item" href="signin.html">Sign out</a>
                    </div>
                  </li>
                </ul>
                <!-- / navbar right -->
          </div>
    </div>
    <div class="app-footer white bg p-a b-t" style="background-color:rgb(240,240,240); padding-top:1; padding-right:; padding-bottom:1; padding-left:; border-top-width:1px; border-top-style:solid; position:absolute; left:0; bottom:0; z-index:1010; padding-right:; padding-bottom:1; padding-left:; border-top-width:1px; padding-right:; padding-bottom:1; padding-left:; border-top-width:1px; padding-right:; padding-bottom:1; padding-left:; border-top-width:1px; padding-right:; padding-bottom:1; padding-left:; border-top-width:1px; padding-right:; padding-bottom:1; padding-left:; border-top-width:1px;
padding-right:; padding-bottom:1; padding-left:; border-top-width:1px;
padding-right:; padding-bottom:1; padding-left:; border-top-width:1px;
padding-right:; padding-bottom:1; padding-left:; border-top-width:1px;
padding-right:; padding-bottom:1; padding-left:; border-top-width:1px;
padding-right:; padding-bottom:1; padding-left:; border-top-width:1px;
padding-right:; padding-bottom:1; padding-left:; border-top-width:1px;
padding-right:; padding-bottom:1; paddi">
      <div class="pull-right text-sm text-muted">Version 1.0.1</div>
      <span class="text-sm text-muted">&copy; Copyright.</span>
    </div>
	
                                 

                            

    <div class="app-body" style="height:100%;  right:0; top:0; z-index:1; visibility:visible; visibility:; visibility:;">
	<br><div align="center"><table><tr>

                             
                              
                                 <td align="left" class="white-18">
                       <form  name="searchproduct" method="post" class="searchproduct" id="searchproduct"  onSubmit="" >        
                               <select style="height:25px;" name="search_cat">
                               <option value="">All Categories</option>
                                                   <option value="Weaves">Weaves</option>  
                      <option value="CLIP-IN ROLL">CLIP-IN ROLL</option>  
                      <option value="WIGS">WIGS</option>  
                      <option value="TOP PIECES">TOP PIECES</option>  
                      <option value="HAIR PIECES">HAIR PIECES</option>  
                      <option value="CLIP-IN ROLL">CLIP-IN ROLL</option>  
            
     
                               </select><input type="text" name="search_text" placeholder="Search..."  id="search_text" />
                                <input  type="button" value="Search" style="border:0px; background:#2992C1; color:#fff; height:25px; cursor:pointer;" onClick="searchsub()" />
                               </form>
                               </td>
                                <td align="left" class="white-18">Product List</td>
                               
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
      <table class="table table-striped white b-a" style=" width:100%; padding:0px; margin:0px;"  cellpadding="0" cellspacing="">
        
        
        
            <tr>
            <td  style="width:40%" ><span class="projecthead"><b>PRODUCT NAME</b></span></td>
            <td style="width:20%"><span class="projecthead"><b>IMAGE</b></span></td>
            <td style="width:15%" ><span class="projecthead"><b>CATEGORY</b></span></td>
                        <td  style="width:10%" ><span class="projecthead" ><b>PRICE</b></span></td>
                        <td style="width:10%" ><span class="projecthead" ><b>SALON PRICE</b></span></td>
            <td style="width:5%"><span class="projecthead"><b>DETAIL</b></span></td>
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
            <td style="width:45%"><span class="projecthead"><?=$productrow['product_name']?></span></td>
            <td style="width:20%"><img src="../product_img/<?=$product_img?>" border="0"  style=" height:85px; width:auto" ></td>
            <td style="width:15%"><span class="projecthead"><?=$productrow['category']?></span></td>
                        <td  style="width:10%" ><span class="projecthead"><?=$productrow['msrp_price']?></span></td>
                        <td  style="width:10%" ><span class="projecthead"><?=$productrow['wholesale_price']?></span></td>
            <td style="width:5%"><input  type="hidden" name="goodsId" value="<?=$productrow['id']?>"><span class="projecthead"><font color="#0070C0"><a href="inventory_detail.php?productid=<?=$productrow['id']?>">INVENTORY&nbsp;&nbsp; </a> <a href="javascript:cart_add(document.cartForm<?=$cart_cnt?>);"  > ORDER</a></font></span></td>
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
    </div>
  </div>
  <!-- / -->

  
  <!-- ############ SWITHCHER START-->
    <div id="switcher">
      <div class="switcher dark-white" id="sw-theme">
        <a href="#" data-ui-toggle-class="active" data-ui-target="#sw-theme" class="dark-white sw-btn">
          <i class="fa fa-gear text-muted"></i>
        </a>
        <div class="box-header">
          <a href="https://themeforest.net/item/aside-dashboard-ui-kit/17903768?ref=flatfull" class="btn btn-xs rounded danger pull-right">BUY</a>
          <strong>Theme Switcher</strong>
        </div>
        <div class="box-divider"></div>
        <div class="box-body">
          <p id="settingLayout" class="hidden-md-down">
            <label class="md-check m-y-xs" data-target="folded">
              <input type="checkbox">
              <i></i>
              <span>Folded Aside</span>
            </label>
            <label class="m-y-xs pointer" data-ui-fullscreen data-target="fullscreen">
              <span class="fa fa-expand fa-fw m-r-xs"></span>
              <span>Fullscreen Mode</span>
            </label>
          </p>
          <p>Colors:</p>
          <p data-target="color">
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md">
              <input type="radio" name="color" value="primary">
              <i class="primary"></i>
            </label>
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md">
              <input type="radio" name="color" value="accent">
              <i class="accent"></i>
            </label>
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md">
              <input type="radio" name="color" value="warn">
              <i class="warn"></i>
            </label>
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md">
              <input type="radio" name="color" value="success">
              <i class="success"></i>
            </label>
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md">
              <input type="radio" name="color" value="info">
              <i class="info"></i>
            </label>
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md">
              <input type="radio" name="color" value="warning">
              <i class="warning"></i>
            </label>
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md">
              <input type="radio" name="color" value="danger">
              <i class="danger"></i>
            </label>
          </p>
          <p>Themes:</p>
          <div data-target="bg" class="clearfix">
            <label class="radio radio-inline m-a-0 ui-check ui-check-lg">
              <input type="radio" name="theme" value="">
              <i class="light"></i>
            </label>
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-lg">
              <input type="radio" name="theme" value="grey">
              <i class="grey"></i>
            </label>
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-lg">
              <input type="radio" name="theme" value="dark">
              <i class="dark"></i>
            </label>
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-lg">
              <input type="radio" name="theme" value="black">
              <i class="black"></i>
            </label>
          </div>
        </div>
      </div>
    </div>
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

</body>
</html>

 
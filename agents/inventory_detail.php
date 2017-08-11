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



$product_id=$_GET['productid'];
$product=mysql_query("select * from product where id=$product_id");

$product_row=mysql_fetch_array($product);

 if (strpos($product_row['images'],',') !== false) {
  $product_img=explode(',',$product_row['images']);
  $product_img=$product_img[0];
}
else{
  $product_img=$product_row['images'];	
}

 $color_option = $product_row['color'];
	 $color_option =  rtrim($color_option,',');
	$sku_option	= explode(",",$product_row['sku']);	
	$length_option	= explode(",",$product_row['length']);
	$color_option	= explode(",",$color_option);
	$price_option	= explode(",",$product_row['price']);
	$price_option	= explode(",",$product_row['manufactureprice2']);
	$stock_option = explode(",",$product_row['stock']);
	
	$agent_price=explode(",",$product_row['agent_price']);
	
	$length_size_option	= explode(",",$product_row['length_size']);
		//print_r($color_option);	
	 $length_option_count=count(array_filter($color_option));
	// echo "$length_option_count";
	 
	// $color_size_option	= explode(",",$query2['color']);
	 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>EBHA-ISR_INVENTORY DETAIL</title>
  <meta name="description" content="EBHA-ISR_INVENTORY DETAIL" />
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
  
  .projecthead{
font-size: 100%;
}
.img1{
 height:85px; width:auto;

}
.list{
font-size:18px;
}
  
  @media screen and (max-width: 640px) {
  .projecthead{
font-size: 65%;
}


.img1{
width:100%; max-width:100%;
height:auto;

}
.input-cls{
width:40px;
}
.list{
font-size:16px;
}

}
  </style>
  
</head>
<body>
 <div class="app" id="app">

<!-- ############ LAYOUT START-->

 <!-- ############ LAYOUT START-->

<?php include'isr_left.php'?>


  <!-- content -->
  <div id="content" class="app-content box-shadow-z2 bg pjax-container" role="main">
    <div class="app-header white bg b-b">
          <div data-pjax>
                <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up p-r m-a-0">
                  <i class="ion-navicon"></i>
                </a>
                <div id="pageTitle">INVENTORY</div>
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
                      
                      <div class="dropdown-divider"></div>
                     
                      <a class="dropdown-item" href="signin.html">Sign out</a>
                    </div>
                  </li>
                </ul>
                <!-- / navbar right -->
          </div>
    </div>
    
	
                                 

                            

    <div class="app-body" style="height:100%;  right:0; top:0; z-index:1; visibility:visible; visibility:; visibility:;">
	<br><div align="center"><table align="center" style=" margin:0 auto;"><tr>

                             
                              
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

    <div class="table-responsive">
    <script  type="text/javascript">
 
 function cart_add(Obj)
{
//alert("dhirendra");
	Obj.action = "cart.php?act=addall";
	Obj.submit();
}

  
  </script>
      <table class="table table-striped white b-a" width="1664">
        
                    <tr>
            <td style="padding:0px; margin:0px; text-align:center;" width="450"><span class="projecthead"><b>PRODUCT NAME</b></span></td>
            <td width="195" style="padding:0px; margin:0px; text-align:center;"><span class="projecthead"><b>IMAGE</th>
            <td style="width:120px;padding:0px; margin:0px; text-align:center;" width="250"><span class="projecthead"><b>CATEGORY</b></span></td>
                       <? if($_SESSION['buyer_type']=="Agent"){ ?>  <th width="190" style="width:140px;padding:0px; margin:0px; text-align:center;"><span class="projecthead"><b>AGENT PRICE</b></span></td> <? } ?>
                        <th width="164" style="width:140px;padding:0px; margin:0px; text-align:center;"><span class="projecthead"><b>MSRP</b></span></td>
           
                    </tr>
       
       <form method="post" action="cart.php" name="cartForm1" >
                    <tr>
            <td width="450" style="padding:0px; margin:0px; text-align:center;"><span class="projecthead"><?=$product_row['product_name']?></span></td>
            <td width="195" style="padding:0px; margin:0px; text-align:center;"><span class="projecthead"><img src="../product_img/<?=$product_img?>"  border="0" class="img1"></span></td>
            <td width="250" style="padding:0px; margin:0px; text-align:center;"><span class="projecthead"><?=$product_row['category']?></td>
                       <? if($_SESSION['buyer_type']=="Agent"){ ?>  <td width="190" style="padding:0px; margin:0px; text-align:center;"><span class="projecthead">$<?=number_format((float)$product_row['agentprice1'], 2, '.', '')?></span></td> <? } ?>
                        <td width="164" style="padding:0px; margin:0px; text-align:center;"><span class="projecthead">$<?=number_format((float)$product_row['wholesale_price'], 2, '.', '')?></span></td>
           
                    </tr>
       </form>             
                  
        
      </table>
    </div> 
	<div class="">
      <table class="table" style="width:100%; padding:0px; margin:0px; table-layout:fixed"  width="100%" border="0" cellspacing="0" cellpadding="0">
        
                    <tr>
            <td style="padding:0px; margin:0px; text-align:center;"  width="20%"><span class="projecthead"><b>SKU</b></span></td>
            <td width="10%" style="padding:0px; margin:0px; text-align:center;"><span class="projecthead"><b>LENGTH</b></span></td>
            <td style="padding:0px; margin:0px; text-align:center;" width="10%"><span class="projecthead"><b>COLOR</b></span></td>
                     <? if($_SESSION['buyer_type']=="Agent"){ ?>    <th width="10%" style="padding:0px; margin:0px; text-align:center;"><span class="projecthead"><b>AGENT PRICE</b></span></td> <? } ?>
                        <th width="10%" style="padding:0px; margin:0px; text-align:center;"><span class="projecthead"><b>MSRP</b></span></td>
                        <th width="10%" style="padding:0px; margin:0px; text-align:center;"><span class="projecthead"><b>STOCK</b></span></td>
           <td style="padding:0px; margin:0px; text-align:center;" width="20%"><span class="projecthead"><b>ORDER</b></span></td>
                    </tr>
        <form method="post" action="cart.php" name="cartFormdetail" >
           <? 
		   $cart_cnt=1;
		   
		   for($i=0;$i<$length_option_count;$i++) { $cart_cnt++; ?>
        
                    <tr>
            <td width="20%" style="padding:0px; margin:0px; text-align:center;"><span class="projecthead"><?=$sku_option[$i]?></span></td>
            <td width="10%" style="padding:0px; margin:0px; text-align:center;"><span class="projecthead"><?=$length_option[$i]?></span></td>
            <td width="10%" style="padding:0px; margin:0px; text-align:center;"><span class="projecthead"><?=$color_option[$i]?></span></td>
                       <? if($_SESSION['buyer_type']=="Agent"){ ?>  <td width="10%" style="padding:0px; margin:0px; text-align:center;"><span class="projecthead">$ <?=number_format((float)$agent_price[$i], 2, '.', '')?></span></td> <? } ?>
                        <td width="10%" style="padding:0px; margin:0px; text-align:center;"><span class="projecthead">$<?=number_format((float)$price_option[$i], 2, '.', '')?></span></td>
                        <td width="10%" style="padding:0px; margin:0px; text-align:center;"><span class="projecthead"><?=$stock_option[$i]?></span></td>
            <td width="20%"><font color="#0070C0"> 
            <input  type="hidden" name="goodsId" value="<?=$product_row['id']?>">
            
            <input  type="hidden" name="index_option[]" value="<?=$i?>">
            
            
            
            <input  type="hidden" name="length_option[]" value="<?=$length_option[$i]?>">
            <input  type="hidden" name="color_option[]" id="color_option" value="<?=$color_option[$i]?>" >
            
            
            <input type="text" class="full input-cls" id="stock_1" value="0"  name="cnt[]" >&nbsp;</font></td>
                    </tr>
                  
                   <? } ?> 
                   
                   
              <tr> 
              
              <td  width="400"  align="right" colspan="3" ><a href="./inventory.php"  ><font color="#FF0000"   style="background:#003300" class="list">
              <input type="button" value="List" style="background:#717171; color:#FFFFFF"> </font></a></td>
              <td  style="margin-left:10px;" ><a href="javascript:cart_add(document.cartFormdetail);"  ><font color="#FF0000" class="list"  style="background:#003300">
              <input type="button" value="Add To Cart" style="background:#717171; color:#FFFFFF"> </font></a></td>      
					<td>&nbsp;</td> 
                    <td>&nbsp;</td> 
                    </tr>   	    
				</form>  	   
                  
        
      </table><BR>

<!-- PAGE-BANNER END -->
			
</p>
    </div>
  </div>
  <!-- / -->

  
 
<!-- ############ LAYOUT END-->
</div>
<!-- build:js scripts/app.min.js -->
<!-- jQuery -->
<script src="libs/jquery/dist/jquery.js">
</script>
<!-- Bootstrap -->
<script src="libs/tether/dist/js/tether.min.js">
</script>
<script src="libs/bootstrap/dist/js/bootstrap.js">
</script>
<!-- core -->
<script src="libs/jQuery-Storage-API/jquery.storageapi.min.js">
</script>
<script src="libs/PACE/pace.min.js">
</script>
<script src="libs/jquery-pjax/jquery.pjax.js">
</script>
<script src="libs/blockUI/jquery.blockUI.js">
</script>
<script src="libs/jscroll/jquery.jscroll.min.js">
</script>
<script src="scripts/config.lazyload.js">
</script>
<script src="scripts/ui-load.js">
</script>
<script src="scripts/ui-jp.js">
</script>
<script src="scripts/ui-include.js">
</script>
<script src="scripts/ui-device.js">
</script>
<script src="scripts/ui-form.js">
</script>
<script src="scripts/ui-modal.js">
</script>
<script src="scripts/ui-nav.js">
</script>
<script src="scripts/ui-list.js">
</script>
<script src="scripts/ui-screenfull.js">
</script>
<script src="scripts/ui-scroll-to.js">
</script>
<script src="scripts/ui-toggle-class.js">
</script>
<script src="scripts/ui-taburl.js">
</script>
<script src="scripts/app.js">
</script>
<script src="scripts/ajax.js">
</script>
<!-- endbuild -->
</body>
</html>

 
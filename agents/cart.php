<?
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
$GOOD_SHOP_USERID=$_SESSION['tempuser'];

	$act =$_GET['act'];
	


if($_SESSION['buyer_id']){
$GOOD_SHOP_USERID=$_SESSION['buyer_id'];
}
	
	$bulk_order =$_GET['bulk_order'];
	
	
	if($act=="addall"){

	
	$goodsId = $_POST['goodsId'];
	$supplier_id = $_POST['supplier_id'];
	$option_index=$_POST['index_option'];
	$length_option = $_POST['length_option'];
	//var_dump($option_index);
$color_option = $_POST['color_option'];
$cnt = $_POST['cnt'];

  for($x = 0; $x < count($length_option); $x++ )
    {
       if($cnt[$x]>0){
	   $lenghtx=$length_option[$x];
	   $color_optionx =$color_option[$x];
	   $cntx =$cnt[$x];
	   
	   $option_indexx=$option_index[$x];
	  // echo "dhirendra--$option_indexx";
	   
	   $chek_qry = "select * from cart where userid='$GOOD_SHOP_USERID' and goodsId=$goodsId and ";
		$chek_qry.= "option1='$color_optionx' and option2='$lenghtx'";
	  
	  $count=mysql_num_rows(mysql_query($chek_qry));
	  if(!$count){
	  
	  $add_cart_query="insert into cart set userid='$GOOD_SHOP_USERID',goodsId='$goodsId',supplier_id='$supplier_id',cnt='$cntx',option1='$color_optionx',option2='$lenghtx',price='$price',point='$point',writeday='now()',price_old='',length='$lenghtx',capsize1='$capsize1',capsize='$capsize2',capsize3='$capsize3',capsize4='$capsize4',capsize5='$capsize5',capsize6='$capsize6',cap='$cap',option_index='$option_indexx',ISRID='$mem_id'";
	  
	 mysql_query($add_cart_query);
	  }else{
	  
	     $add_cart_qry = "update cart set point=point/cnt*(cnt+$cntx),cnt=cnt+$cntx where userid='$GOOD_SHOP_USERID' and goodsId=$goodsId and";
			$add_cart_qry.= "option1='$color_optionx' and option2='$lenghtx' ";
	  
	  mysql_query($add_cart_qry);
	      }
	  
	  
	  
	  
	   }
	   
	    
    }


	
//exit();	
	}
	

	if($act=="add"){//adding in cart	
	$goodsId = $_POST['goodsId'];	
	//echo "hello";
	 $cap=$_POST['cap'];
	// echo "$cap";
	$capsize1=$_POST['ist'];
	$capsize2=$_POST['sect'];
	$capsize3=$_POST['thi'];
	$capsize4=$_POST['first'];
	$capsize5=$_POST['sec'];
	$capsize6=$_POST['third'];
	//echo "$cap_fst"."dhirendra";
	$cap1=$_POST['a'];
   $cap2=$_POST['b'];
  $lengt=$_POST['lengt'];
// echo "dhirendra--$lengt";
  if(!$_POST['cnt']){
  
	$cnt=1;
	}else{
	$cnt=$_POST['cnt'];
	}
	
	
	//echo "dhirendra--$goodsId";	
	$price =$_POST['price'];
	
	
	$channel=$_REQUEST['channel'];
	$multi_cnt=$_POST['multi_cnt'];
	$multi_goods = $_POST['multi_goods'];
	$supplier_id = $_POST['supplier_id'];
	$option_index=$_POST['index_option'];
	//echo "$option_index--dhirendra";
		

		$color_option= 'Color-'.$_POST['color_option'];
		$length_option= 'Length-'.$_POST['length_option'];
		//echo $_POST['length_option']."dhirendra";
		
       
		$chek_qry = "select * from cart where userid='$GOOD_SHOP_USERID' and goodsId=$goodsId and ";
		$chek_qry.= "option1='$color_option' and option2='$length_option'  ";
 if(empty($bulk_order))
		{
			
		
			$count_query=mysql_query($chek_qry);
			$count=mysql_num_rows($count_query);
		
		
		if($count>0){		//if the same item exists in cart, only quantity increases
			$add_cart_qry = "update cart set point=point/cnt*(cnt+$cnt),cnt=cnt+$cnt where userid='$GOOD_SHOP_USERID' and goodsId=$goodsId and";
			$add_cart_qry.= "option1='$color_option' and option2='$length_option' ";
		}else{									//add in cart
			$add_cart_qry = "insert into cart(userid, goodsId,supplier_id,cnt,option1,option2,price,point,writeday,price_old,length,capsize1,capsize,capsize3,capsize4,capsize5,capsize6,cap,	option_index,ISRID)";
			$add_cart_qry.= "values('$GOOD_SHOP_USERID','$goodsId','$supplier_id','$cnt','$color_option','$length_option',";
			
	$add_cart_qry.= "'$price','$point', now(),'','$lengt','$capsize1','$capsize2','$capsize3','$capsize4','$capsize5','$capsize6','$cap','$option_index','$mem_id')";
			//echo "$add_cart_qry";
		}
		

		if(mysql_query($add_cart_qry)){
			$carts= mysql_insert_id();
			
			$_SESSION["cart_id"] = "$carts" ;
			
			//echo $_SESSION["cart_id"];
			if($channel == "cart")	header("location:cart.php");
			else{
				
			}
		}
		
		}
	else
		{
			
			$arCartIdx = array();
			//Bulk Order
			
			
			for($i=0;$i<count($multi_cnt);$i++)
			{
				$cnt = $multi_cnt[$i];
				if($cnt > 0)
				{
					$multi_info = explode('@@',$multi_goods[$i]);
					
					$color	= $multi_info[0];
					$color_option= 'Color-'.$color;
					$price		= $multi_info[1];
					$price_old		= $multi_info[2];
					
					$length_option= 'Length-'.$multi_info[3];
			
		 $option1 = $goods_info_row['partName1']."¡¹¡¸".$option4;//item option  ex) color¡¹¡¸yellow 
	 $option2 = $goods_info_row['partName2']."¡¹¡¸".$priceopt[$i];
		if(!empty($option3)) $option3 = $goods_info_row['partName3']."¡¹¡¸".$option3;
		if($goods_info_row['bOptionPrice']) $option4 = $goods_info_row['optionPriceName']."¡¹¡¸".$priceoption;
					
					
	$chek_qry = "select * from cart where ISR-ID='$mem_id' and goodsId=$goodsId and ";
		$chek_qry.= "option1='$color_option' and option2='$length_option'  ";				

					if(mysql_num_rows(mysql_query($chek_qry)) > 0){		//if the same item exists in cart, only quantity increases
					
		$add_cart_qry = "update cart set point=point/cnt*(cnt+$cnt),cnt=cnt+$cnt where userid='$GOOD_SHOP_USERID' and goodsId=$goodsId and";
			$add_cart_qry.= " option1='$color_option' and option2='$length_option' ";				
						
					}else{
						
						$cap1=$_POST['a'];
$cap2=$_POST['b'];
$cap=$_POST['cap'];
$capsize1=$_POST['ist'];
	$capsize2=$_POST['sect'];
	$capsize3=$_POST['thi'];
	$capsize4=$_POST['first'];
	$capsize5=$_POST['sec'];
	$capsize6=$_POST['third'];
$lengt=$_POST['lengt'];
$option_index=$_POST['index_option'];

					$add_cart_qry = "insert into cart(userid, goodsId,supplier_id,cnt,option1,option2,price,point,writeday,price_old,length,capsize1,capsize,capsize3,capsize4,capsize5,capsize6,cap,option_index,ISRID)";
			$add_cart_qry.= "values('$GOOD_SHOP_USERID','$goodsId','$supplier_id','$cnt','$color_option','$length_option',";
			
			$add_cart_qry.= "'$price','$point', now(),'$price_old','$lengt','$capsize1','$capsize2','$capsize3','$capsize4','$capsize5','$capsize6','$cap'.'$option_index','$mem_id')";
				
				
					}
					
					mysql_query($add_cart_qry);
						//echo "ID of the last inserted  is: ". mysql_insert_id();
					

					$arCart = mysql_fetch_array(mysql_query($chek_qry));
					
					$arCartIdx[] = $arCart['id'];
				
					$arCart = null;
				}
			}

									if($channel == "cart")
									{
										
										header("location:cart.php");
									}
									else
									{
										if($GOOD_SHOP_PART =="member")
										{
											header("location:checkout_new.php");				//member placing an order
										}
										else
										{
											header("location:login.php");		//non-member placing an order
										}
									}
		}	
		
	}
	
if($act =="del"){//deleting in cart
	  $cartId=$_POST['cartId'];
		mysql_query("delete from cart  where id=$cartId");
		header("location:cart.php");
	}	
if($act=="edit"){
		$cartId=$_REQUEST['cartId'];
		$cnt=$_POST['cnt'];
		
	//	echo "update cart set cnt = $cnt where id=$cartId";
		$edit_qry = mysql_query("update cart set cnt = $cnt where id=$cartId");
		header("location:cart.php");
	}
		
	
//echo "select * from cart where ISR-ID='$mem_id'";
$cart_goods_query = mysql_query("select * from cart where  ISRID='$mem_id' and userid='$GOOD_SHOP_USERID'"); //numbers of items in cart
	
$cart_item_count = mysql_num_rows($cart_goods_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>EBHA-ISR_CART</title>
  <meta name="description" content="EBHA-ISR_CART" />
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
  
  <link rel="stylesheet" href="../shopick/css/pe-icon-7-stroke.css">
   <link rel="stylesheet" href="../shopick/fstyle.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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
.table-responsive{
width:95%;
float:right;
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
	.table-responsive{
width:100%;
float:right;
}
}
  </style>
  <script type="text/javascript">
  
  function cartDel(Obj)
{
	Obj.action = "cart.php?act=del";
	Obj.submit();
}
function cartEdit(Obj,limitCnt)
{
	var Cnt = Obj.cnt.value;
	if(Cnt=="" || Cnt=="0" || Cnt==0 ){
		alert("Quantity is not correct.");
		Obj.cnt.focus();
	}else if(Cnt > limitCnt){
		alert("We're sorry. This item is sold out/out of stock.\n\nIn stock : "+limitCnt);
		Obj.cnt.focus();
	}else{
		Obj.action = "cart.php?act=edit";
		Obj.submit();
	}
}


 
</script>


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
  <div id="content" class="app-content box-shadow-z2 bg pjax-container" role="main">
    <div class="app-header white bg b-b">
          <div class="navbar" data-pjax>
                <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up p-r m-a-0">
                  <i class="ion-navicon"></i>
                </a>
                <div class="navbar-item pull-left h5" id="pageTitle">&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</div>
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
                       
                               </td>
                                <td align="left" class="white-18">&nbsp;&nbsp;&nbsp;&nbsp;<b><a href="/inventory.php">Product List </a></b></td>
                               </tr></table></div>

    <div id="datatable" style=""  class="table-content table-responsive">
      <table class="table table-striped white b-a" style=" width:100%; padding:0px; margin:0px;"  cellpadding="0" cellspacing="">
        
        
        
            <tr>
            <td  style="width:20%; text-align:center" ><span class="projecthead"><b>IMAGE</b></span></td>
            <td style="width:35%;text-align:center"><span class="projecthead"><b>PRODUCT NAME</b></span></td>
            <? if($_SESSION['buyer_type']=="Agent"){ ?>
                 <td style="width:10%;text-align:center" ><span class="projecthead"><b>AGENT PRICE</b></span></td>
            <? }else{ ?>
                 <td style="width:10%;text-align:center" ><span class="projecthead"><b>MSRP</b></span></td>
            <? } ?>
            <td  style="width:10%;text-align:center" ><span class="projecthead" ><b>QUANTITY</b></span></td>
           <td style="width:10%;text-align:center" ><span class="projecthead" ><b>LENGTH & COLOR</b></span></td>
            <td style="width:10%;text-align:center"><span class="projecthead"><b>SUBTOTAL</b></span></td>
            <td style="width:5%;text-align:center"><span class="projecthead"><b>REMOVE</b></span></td>
                    </tr>
       
       
                 <?php $cart_cnt=0; 

 while($cart_goods_row=mysql_fetch_assoc($cart_goods_query)){
	
	$cart_cnt++;
	
	//echo "SELECT * FROM `product` where id='$cart_goods_row[goodsId]'";
	$goods_info= mysql_fetch_assoc(mysql_query("SELECT * FROM `product` where id='$cart_goods_row[goodsId]'"));
	
	if (strpos($goods_info['images'],',') !== false) {
  $product_img=explode(',',$goods_info['images']);
$product_img=$product_img[0];
}
else{
  $product_img=$goods_info['images'];	
}
if($cart_goods_row['dropship']==0){

$total_weight +=$goods_info['package_weight']*$cart_goods_row['cnt'];	
}
if($total_weight==''){
	$total_weight=0;
}


  if($_SESSION['buyer_type']=="Agent"){
	  ///for dealer price////////////
	   
	   $userprice=explode(',',$goods_info['agent_price']);
	   $price1=$userprice[$cart_goods_row['option_index']];
	   
	   if(count($userprice)<=1){
	   $userprice=$goods_info['agentprice1'];
	   $price1=$userprice;
	    }
	 
	 
		$price=$price1;
		
		
		
		  $sub_totalnew +=$price*$cart_goods_row['cnt'];
		
  }else{
	    
		$userprice=explode(',',$goods_info['manufactureprice2']);
		$price=$userprice[$cart_goods_row['option_index']];
		//echo count($userprice);
		if(count($userprice)<=1){
	   $userprice=$goods_info['msrp_price'];
	    $price=$userprice;
		
		
		
		}
		
		$price1=$price;
		
		
				
		  $sub_totalnew +=$price*$cart_goods_row['cnt'];
		 
	    }


 
$length_opt_val = explode('Length-',$cart_goods_row['option2']);

$length_opt_val = $length_opt_val[1];
 
 $quantity = $goods_info['quantity'];

if($goods_info['min_quantity']==''){
$min_quantity =1;	
}
else{
$min_quantity = $goods_info['min_quantity'];	
}

$producturl1=preg_replace('/[^A-Za-z0-9\-]/', '-', $goods_info['product_name']);
 
 $producturl1=str_replace('--', '-', $producturl1);
   $producturl1=strtolower(rtrim($producturl1, "-"));

	?>  
    <form name="cartForm<?=$cart_cnt?>" method="post">
		<input type="hidden" name="cartId" value="<?=$cart_goods_row['id']?>">
                  <tr>
               
            <td style="width:15%"><img src="../product_img/<?=$product_img?>" border="0"  style="height:85px; width:auto" ></td>
            <td style="width:35%"><span class="projecthead"><?=$goods_info['product_name']?><?=$cart_goods_row['option_index']?></span>
            <br>
<span class="projecthead">Min Order: <?=$min_quantity?> / <?=$goods_info['quantity_type']?></span><br>
<span class="projecthead">Dropship: <?=$goods_info['dropship']?></span>
            </td>
            <td style="width:10%"><span class="amount">$<?=number_format((float)$price1, 2, '.', '')?></span></td>
             <td  style="width:10%" ><input type="text" size="4" name ="cnt" cnt_<?=$cart_cnt?> value="<?=$cart_goods_row['cnt']?>" />
                                                 <input type="button" class="red-btn" id="button" name="button" value="Update" 
         onClick="javascript:cartEdit(document.cartForm<?=$cart_cnt?>, <?=$quantity?>);" style="background:#2685B3; padding:.2em; color:#FFFFFF; "/></td>
            <td  style="width:10%" ><span class="projecthead"><?=str_replace('-',':',$cart_goods_row['option2'])?> ,<?=str_replace('-',':',$cart_goods_row['option1'])?></span></td>
            <td style="width:10%">$<span id="subtotal_span_<?=$cart_cnt?>"><?=number_format((float)$cart_goods_row['cnt']*$price1, 2, '.', '')?></td>
            
            <td style="width:5%" class="product-remove"><span class="projecthead"><a href="javascript:cartDel(document.cartForm<?=$cart_cnt?>);"><i class="pe-7s-close"></i></a></span></td>
                    </tr>
                 </form>   
                     <? } ?>
                    
                  
        
      </table>
    </div> 
    <div class="row">
									<div class="col-md-12">
										<!--<div class="coupon">
											<input type="submit" value="update cart" />
											<span>do you have coupon code</span>
											<input type="text" />
										</div> -->
									</div>
								</div>
    
    <div class="row">
									<div class="col-md-5 col-md-offset-7" style="float:right">
										<div class="cart-totals" >
											<h2>Total</h2>
											<div class="table-cart table-responsive">
                                            <table>
													<tbody class="cart-totals-list">
														<tr>
															<th>Subtotal</th>
															<td>$ <span id="grand_total"><?=number_format($sub_totalnew,2)?></span></td>
														</tr>
														<!-- <tr>
															<th>Discount</th>
															<td><span>no discount or coupon code</span></td>
														</tr> -->
														
														<tr class="cart-total">
															<th>Total</th>
															<td>$<?=number_format($sub_totalnew,2)?></td>
														</tr>
													</tbody>
												</table>
												<div class="we-proceed-to-checkout">
													<form method="post" id="sendcheckout" name="sendcheckou"  action="checkout.php">
                                                    <input type="hidden" name="total_P" value="<?=number_format($sub_totalnew,2);?>" >
                                                     <input type="hidden" name="total_weight" value="<?=$total_weight?>" >
                                                     <div style="text-align:center;">
                                                         <? if($_SESSION['GOOD_SHOP_PART']=='member') {?>
                                                               <span class="red-btn" id="b" style="display:inline-block; float:Right; background:#FFFFFF; cursor:pointer;" > <input type="submit" name="submit_botton" class="red-btn" value="PROCEED TO CHECKOUT" ></span>
                                                                 <? } else{?>
                                                           <span class="red-btn" id="b" style="display:inline-block; float:Right; background:#FFFFFF; cursor:pointer;" > <input type="submit" name="submit_botton" class="red-btn" value="PROCEED TO CHECKOUT" ></span>
                                                                  <? } ?>
                                                                    </div> 
                                                             </form><br><br>
                                                   <div align="right"> <a href="inventory.php">Continue shopping</a></div>
                                            </div>
                                         </div>
                                     </div> 
   </div>                                                                         
    
    
             
  </div>
       
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
  <script src="scripts/ui-nav.js"></script>
  <script src="scripts/ui-list.js"></script>
  <script src="scripts/ui-screenfull.js"></script>
  <script src="scripts/ui-scroll-to.js"></script>
  <script src="scripts/ui-toggle-class.js"></script>
  <script src="scripts/ui-taburl.js"></script>
  <script src="scripts/app.js"></script>
  <script src="scripts/ajax.js"></script>
<!-- endbuild -->

</body>
</html>

 
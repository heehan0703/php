<?php
session_start();
include('pager.php');

$text_show=$_SESSION["text_show"] ;
$subcat=$_SESSION["subcat"] ;
    $id=$_GET['goods_Id'];

require_once('wp-admin/include/connectdb.php');
$value = $_POST['param'];
$productnum=$_POST['productnum'];
//echo $value;
$count_value =count($value);
//echo $count_value;
if($subcat == '')
{
$a= "SELECT * FROM `product` where category = '$text_show' ORDER BY `product`.`wholesale_price` ASC";
//echo "SELECT * FROM `product` where category = '$text_show' ORDER BY `product`.`wholesale_price` ASC";
}
else
{
$a= "SELECT * FROM `product` where category = '$text_show' and subcategory='$subcat' ORDER BY `product`.`wholesale_price` ASC";

}
$j=0;
$robin=mysql_query("SELECT * FROM rating where goods_id=$id ORDER BY id DESC LIMIT 3;"); 


//for($i=1; $i < $count_value; $i++)
//{
//$a.=" or ORDER BY `product`.`wholesale_price` ASC";
//echo $a;
//}
//$a.=")";
$product_query= mysql_query(dopaging($a,$productnum)); 

//echo $product_query;
?>  

   <?php $c=0;
	   while($product_row=mysql_fetch_assoc($product_query)){ 
	   $c++; 
	    if (strpos($product_row['images'],',') !== false) {
  $product_img=explode(',',$product_row['images']);
$product_img=$product_img[0];
}
else{
  $product_img=$product_row['images'];	
}

  
 $producturl1=preg_replace('/[^A-Za-z0-9\-]/', '-', $product_row['product_name']);
 
 $producturl1=str_replace('--', '-', $producturl1);
   $producturl1=strtolower(rtrim($producturl1, "-"));
	   
	   ?>
                                            
											<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
												<div class="single-product">
													<div class="product-photo" style="min-height:360px;">
														<a href="/<?=$producturl1?>-<?=$product_row['id']?>.html">
															<img class="primary-photo" src="/product_img/<?=$product_img?>" alt="" />
															<img class="secondary-photo" src="/product_img/<?=$product_img?>" alt="" />
														</a>
														<div class="pro-action">
															
															<a href="/<?=$producturl1?>-<?=$product_row['id']?>.html" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
															
														</div>
													</div>
													<div class="product-brief" style="min-height:130px; padding-left:2px; padding-right:0px;">
														<h2><a href="/<?=$producturl1?>-<?=$product_row['id']?>.html"><?=$producturl1;?></a></h2>
														 <?php if(($_SESSION['i_am']=='Wholesaler' and $_SESSION['verify_status']==1) or ($_SESSION['i_am']=='ISR' and $_SESSION['verify_status']==1)) {?> 
                       <h3 style="font-size:12px">Msrp<strike>$<?=number_format((float)$product_row['regular_price'], 2, '.', '')?></strike>&nbsp; <span style="font-size:14px; color:#F00;">wholesale&nbsp;$<?=number_format((float)$product_row['manufacture_price'], 2, '.', '')?></span> </h3> 
					   <? }else if(($_SESSION['i_am']=='Salon' and $_SESSION['verify_status']==1)){?> 
														  
                                                          <h3 style="font-size:11px">Regular Price:<strike>$<?=number_format((float)$product_row['regular_price'], 2, '.', '')?></strike>&nbsp; <span style="font-size:12px; color:#F00;">Salon Price:&nbsp;$<?=number_format((float)$product_row['msrp_price'], 2, '.', '')?></span> </h3>
                                                          
														  <? }else{ ?>
                                                          
                                                          
                                                        <h3 style="font-size:11px">Regular Price:<strike>$<?=number_format((float)$product_row['regular_price'], 2, '.', '')?></strike>&nbsp; <span style="font-size:14px; color:#F00;">MSRP&nbsp;$<?=number_format((float)$product_row['wholesale_price'], 2, '.', '')?></span> </h3>
                                                             <? }?> 
													</div>
												</div>
											</div>		
											<!-- Single-product end -->
    <? } ?>                                         
     
     
     
    

  


<?php
session_start();

$text_show=$_SESSION["text_show"] ;
$subcat=$_SESSION["subcat"] ;
include('pager.php');
  
require_once('wp-admin/include/connectdb.php');

$value = $_POST['param1'];
$count_value =count($value);


if($subcat == '')
{
//$a= "select * from product where category = '$text_show' and ( hair_type_style like '%$value[0]%' ";
$a= "select * from product where category = '$text_show' and (product_name like '%$value[0]%' or description like '%$value[0]%'";
}
else
{
//$a= "select * from product where category = '$text_show' and subcategory='$subcat' and ( hair_type_style like '%$value[0]%' ";
$a= "select * from product where category = '$text_show' and subcategory='$subcat' and (product_name like '%$value[0]%' or description like '%$value[0]%'";
}


for($i=1; $i < $count_value; $i++)
{
$a.=" or product_name like '%$value[$i]%' or description like '%$value[$i]%'";
}
$a.=")";
$product_query= mysql_query(dopaging($a,9));

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
													<div class="product-photo">
														<a href="/<?=$producturl1?>-<?=$product_row['id']?>.html">
															<img class="primary-photo" src="/product_img/<?=$product_img?>" alt="" />
															<img class="secondary-photo" src="/product_img/<?=$product_img?>" alt="" />
														</a>
														<div class="pro-action">
															<a href="#" class="action-btn"><i class="sp-heart"></i><span>Wishlist</span></a>
															<a href="/<?=$producturl1?>-<?=$product_row['id']?>.html" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
															<a href="#" class="action-btn"><i class="sp-compare-alt"></i><span>Compare</span></a>
														</div>
													</div>
													<div class="product-brief">
														<h2><a href="/<?=$producturl1?>-<?=$product_row['id']?>.html"><?=$producturl1;?></a></h2>
														<h3> <?php if($_SESSION['level']==2) {?><strike>$<?=$product_row['msrp_price']?> </strike>&nbsp;&nbsp; <span style="font-size:14px; color:#F00;"> &nbsp;&nbsp;$<?=$product_row['wholesale_price']?> </span>  <? }else{ ?>  &nbsp;$<?=$product_row['msrp_price']?> <? }?></h3>
													</div>
												</div>
											</div>		
											<!-- Single-product end -->
    <? } ?>                                         
     
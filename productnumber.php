<?php
session_start();
$text_show=$_SESSION["text_show"] ;
$subcat=$_SESSION["subcat"] ;
  include('pager.php');
    $id=$_GET['goods_Id'];
require_once('wp-admin/include/connectdb.php');
$value = $_POST['param3'];
$productnum=$_POST['productnum'];
$count_value =count($value);
$sorted=$_POST['option'];
//echo $count_value;
if($subcat == '')
{
$a= "SELECT * FROM `product` where category = '$text_show' ORDER BY `product`.`wholesale_price` DESC";
//echo "SELECT * FROM `product` where category = '$text_show' ORDER BY `product`.`wholesale_price` ASC";

if($sorted=='New Arrival'){
	$a= "SELECT * FROM `product` where category = '$text_show' ORDER BY `product`.`wholesale_price` DESC";
	}elseif($sorted=='Best Rating'){
	$a= "SELECT * FROM `product` where category = '$text_show' ORDER BY `product`.`wholesale_price` DESC";
	}elseif($sorted=='Low to High'){
	
 $a= "SELECT * FROM `product` where category = '$text_show' ORDER BY `product`.`wholesale_price` ASC";
	
	}elseif($sorted=='High to Low'){
	$a= "SELECT * FROM `product` where category = '$text_show' ORDER BY `product`.`wholesale_price` DESC";
	}elseif($sorted=='A to Z'){
	$a= "SELECT * FROM `product` where category = '$text_show' ORDER BY `product`.`wholesale_price` ASC";
	}elseif($sorted=='Z to A'){
	$a= "SELECT * FROM `product` where category = '$text_show' ORDER BY `product`.`wholesale_price` DESC";
	
	}elseif($sorted=='Best Selling'){
	$a="SELECT * FROM `product` order by sale_amount DESC";
	
	}else{
	$a= "SELECT * FROM `product` where category = '$text_show' ";
	}

}
else
{

if($sorted=='New Arrival'){
	$a= "SELECT * FROM `product` where category = '$text_show' and subcategory='$subcat' ORDER BY  id DESC";
	}elseif($sorted=='Best Rating'){
	$a= "SELECT * FROM `product` where category = '$text_show' and subcategory='$subcat' ORDER BY product_name DESC";
	}elseif($sorted=='Low to High'){
	
 $a= "SELECT * FROM `product` where category = '$text_show' and subcategory='$subcat' ORDER BY `product`.`wholesale_price` ASC";
	
	}elseif($sorted=='High to Low'){
	$a= "SELECT * FROM `product` where category = '$text_show' and subcategory='$subcat' ORDER BY `product`.`wholesale_price` DESC";
	}elseif($sorted=='A to Z'){
	$a= "SELECT * FROM `product` where category = '$text_show' and subcategory='$subcat' ORDER BY product_name ASC";
	}elseif($sorted=='Z to A'){
	$a= "SELECT * FROM `product` where category = '$text_show' and subcategory='$subcat' ORDER BY product_name DESC";
	
	}elseif($sorted=='Best Selling'){
	$a= "SELECT * FROM `product` where category = '$text_show' and subcategory='$subcat' ORDER BY sale_amount DESC";
	
	}else{
	$a= "SELECT * FROM `product` where category = '$text_show' and subcategory='$subcat'";
	}



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
														<h2><a href="#"><?=$producturl1;?></a></h2>
														<h3>&nbsp;</h3>
													</div>
												</div>
											</div>		
											<!-- Single-product end -->
    <? } ?>                                         
     
  
     
     
    

  


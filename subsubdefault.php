<?php
session_start();
$text_show=$_SESSION["text_show"] ;
$subcat=$_SESSION["subcat"] ;
$subsubcat=$_GET['subsubcat'];
include('pager_ajax.php');

require_once('wp-admin/include/connectdb.php');
$value = $_POST['param8'];
$count_value =count($value);
if($subsubcat =='')
{
$a= "SELECT * FROM `product` where category = '$text_show' ";
}
else
{
$a= "SELECT * FROM `product` where sub_subcategory='$subsubcat'";

}

$product_query= mysql_query(dopaging($a,20));

$j=0;
$robin=mysql_query("SELECT * FROM rating ORDER BY rating DESC"); 
//$draw=mysql_fetch_assoc($robin);
//echo $product_query;
?>  
     <div class="full" >
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
	   
	   ?>
<a href="goods_detail.php?goods_Id=<?=$product_row['id']?>" style="color:inherit;">
        <div class="col-lg-3 col-md-3 large_product">
        
      <div class="product_container_1 ">
        <div class="full" align="center"><img src="product_img/<?=$product_img?>" class="img-thumbnail" style="height:200px !important" ></div>
            <div class="full"><span><?=$product_row['product_name']?></span></div>
           
            <div class="full"><span> <?php echo $product_row['subcategory']?> 
			 </span></div>
           <?php  
		  $idx =$product_row['id'];
		    $q=mysql_query("select * from rating where goods_id=$idx ORDER BY rating ASC");
			echo $q;
 while($qq=mysql_fetch_assoc($q)){
	 
		 $output = $qq['vid'];
//echo $output;
$st = $qq['star'];
$out = $qq['star'];
//echo $out;
//echo $output;
$out2=5-$out;
?>
 <div class="full"><span>  <?php for($i=0; $i<$out; $i++) { ?>
            <img src="index.PNG" style="height:20px; width:20px;"> <?php  } ?> <?php for($i=0; $i<$out2; $i++) { ?>  <img src="index1.PNG" style="height:15px; width:15px;"> <?php  } ?></span></div><? } ?>
            <div class="full" style="overflow:hidden;">
            
            <?php if($_SESSION['i_am'] =='Wholesaler') {?>
               <div class="col-lg-4 col-sm-4 col-xs-4"><strike>$<?=$product_row['msrp_price']?> </strike></div>
               <div class="col-lg-4 col-sm-4 col-xs-4" style="color:#F00"><?=$product_row['wholesale_price']?></div>
               <div class="col-lg-4 col-sm-4 col-xs-4"><img src="images/cart.png" ></div></div>
               <div class="full" style="font-weight: 600;"></div></div>
               <? } else {?>
               <div class="col-lg-8 col-sm-8 col-xs-8"><strike>$<?php echo$product_row['regular_price']?></strike><span style="font-size:14px; color:#F00;">
              $<?php echo $product_row['msrp_price']?> </span></div>
              <div class="col-lg-4 col-sm-4 col-xs-4"><img src="images/cart.png" ></div></div>
               <div class="full" style="font-weight: 600;">
              </div></div>
               <? }?>
     </div>
        </a>
        <?php if($c==4){ ?></div><div class="full" style="margin:3em 0;">
        <?php $c=0;}?>
      
    <?php } ?>   
      </div>
      </div>
  
     
     
    

  


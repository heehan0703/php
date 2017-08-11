<?php
session_start();
require_once('wp-admin/include/connectdb.php');
  $url = $_GET['url'];
  $id=$_GET['goods_Id'];
 if(isset($_POST['email_login'])){
   $email_login=$_POST['email_login'];
   $pwd_login=$_POST['pwd_login'];
$stmt=$con_pdo->prepare("select * from member where `email`=:email_login and `pwd`=:pwd_login and supplier=0");
 $stmt->bindParam(':email_login',$email_login);
 $stmt->bindParam(':pwd_login',$pwd_login);
 $stmt->execute();
  $count=$stmt->rowCount();
 
 if($count>0){
	 
	 $user_info_row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
	 if($user_info_row['supplier']==1){
	
	$_SESSION['user_type']='Supplier';
		 
	 }
	 else{
		$_SESSION['user_type']='Buyer';	 
	 }
	 
	 $_SESSION['GOOD_SHOP_USERID']=$user_info_row['email'];
	 
	 $_SESSION['GOOD_SHOP_PART']='member';
	 
	 $_SESSION['member_id']=$user_info_row['member_id'];
	 $_SESSION['my_shop']=$user_info_row['my_shop'];
	 
	 $_SESSION['company_name'] = $user_info_row['company_name'];
	 
	 $_SESSION['verify_status'] = $user_info_row['verify_status'];
	 $_SESSION['level'] = $user_info_row['level'];
	 
	 $_SESSION['i_am'] = $user_info_row['i_am'];
	 
	
if($url=='cart'){
header("location:cart.php");
exit;	
}
//echo '<script type="text/javascript">
//window.location="index.php";
//</s
	 	 
 }
 
 else{
echo '<script type="text/javascript">
alert("You are not login ! Please try again ");
</script>';	 
 }
 
 
 
 }

//$wig_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='wig'"),0);

//$wig_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$wig_id'");

//$wig_query_1=mysql_query("SELECT * FROM `subcategory` where cat_id='$wig_id'");

//$lace_wig_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='lace wig'"),0);

//$lace_wig_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$lace_wig_id'");

//$lace_wig_query_1=mysql_query("SELECT * FROM `subcategory` where cat_id='$lace_wig_id'");

//$weaving_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='WEAVING'"),0);

//$weaving_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$weaving_id'");

//$weaving_query_1=mysql_query("SELECT * FROM `subcategory` where cat_id='$weaving_id'");

//$remy_hair_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='remy hair'"),0);

//$remy_hair_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$remy_hair_id'");

//$remy_hair_query_1=mysql_query("SELECT * FROM `subcategory` where cat_id='$remy_hair_id'");

//$hair_piece_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='hair piece'"),0);

//$hair_piece_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$hair_piece_id'");

//$hair_piece_query_1=mysql_query("SELECT * FROM `subcategory` where cat_id='$hair_piece_id'");

//$hair_care_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='hair care'"),0);

//$hair_care_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$hair_care_id'");

//$hair_care_query_1=mysql_query("SELECT * FROM `subcategory` where cat_id='$hair_care_id'");

//$beauty_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='beauty'"),0);

//$beauty_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$beauty_id'");

//$beauty_query_1=mysql_query("SELECT * FROM `subcategory` where cat_id='$beauty_id'");

$best_sale_query=mysql_query("SELECT * FROM `product` order by product_seen DESC limit 4");
$new_arrival=mysql_query("SELECT * FROM `product` order by sale_amount DESC limit 4"); 
$new_arrivals=mysql_query("SELECT * FROM `product` order by id DESC limit 10"); 
//$sales_and=mysql_query("SELECT * FROM `product` where category='SALES_AND_DEALS' order by id DESC limit 10"); 
$j=0;
//$robin=mysql_query("SELECT * FROM rating where goods_id=$id ORDER BY id DESC LIMIT 3;"); 


?>
 
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<title>Wigs,Hair Extensions,Black Hair,Lace wigs,Remy Hair Wholesale</title>
</head>
    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<!-- bxSlider Javascript file -->
<script src="bx/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="bx/jquery.bxslider.css" rel="stylesheet" />

<script src="js_page/index.js"></script>
 
<link href="css_pages/index.css" rel="stylesheet" />

<body>
<?php include'index_header1.php'?>


<div class="full">
<div class="col-lg-12" style="margin-top: 10px;  padding-left: 0px; padding-right: 0px;" align="center">
<img src="images/new.jpg" class="secondimg" style="width:1200px;" >
</div>
<div class="row"><div class="col-lg-12 col-xs-12" id="isha">
<div style="border-right:1px solid #EEEEEE; " class="col-lg-12 product " id="pi">
<div align="center">
<div id="quad">
<div class="col-lg-12" id="top">
<div class="col-lg-1" ></div>
<div class="col-lg-10" style="padding-left: 0px; padding-right: 0px;">
 <? while($new_arrival1=mysql_fetch_assoc($best_sale_query)){
		  
		  
 if (strpos($new_arrival1['images'],',') !== false) {
  $new_arrival1_img=explode(',',$new_arrival1['images']);
$new_arrival1_img=$new_arrival1_img[0];
}
else{
  $new_arrival1_img=$new_arrival1['images'];	
}
 ?>
   <a class="test"style="color:inherit;" href="goods_detail.php?goods_Id=<?php echo $new_arrival1['id']?>">
      
        <div class="col-xs-6 col-md-4 col-sm-4  col-lg-3 <? if($row==1){ ?> col-lg-offset-1" <? } ?> align="center"  style="padding-left:0px;">
          <div class="product_container" style="background:#E6E6E6; ">
<div class="full" align="center"><span class="product-item_sale"><img src="images/buy.png" class="pitem"></span> <img src="./thumbnailindex2.php?thumb=<?=$new_arrival1_img?>" class="img-thumbnail" style="height:250px;"></div>
<div class="full ka"><span> <?php echo $new_arrival1['product_name']?>...</span></div>
              <div class="full" style="overflow:hidden;" >
            
               <?php if($_SESSION['verify_status']==1){ ?>
               <div class="col-lg-12 " align="right"><strike>$<?php echo $new_arrival1['msrp_price']?></strike>   </div>
               <div class="col-lg-12 " align="right"><span style="color:#FF0000; font-size:12px">Wholesale</span> <span style="font-size:26px;">$<b><?php echo $new_arrival1['wholesale_price']?></b> </span>
              </div>
            
              <? } else {?>
              <div class="col-lg-12 col-md-8" align="right" ><strike> $<?php echo $new_arrival1['regular_price']?> </strike>&nbsp; &nbsp; </div><div class="col-lg-12 col-md-8" align="right"><span style="font-size:26px; color:#F00;">
             $<b><?php echo $new_arrival1['msrp_price']?> </b></span> </div>
            
               <? } ?>
              
            </div>
                <?php  
		  $idx =$new_arrival1['id'];
		    $q=mysql_query("select * from rating where goods_id=$idx");
			
			//echo "select * from rating where goods_id=$idx";
			$numberofrating=mysql_num_rows($q);
			//echo "$numberofrating";
			$star=0;
			//echo $q;
 while($qq=mysql_fetch_assoc( $q)){
	 
  $output = $qq['vid'];
  
  $star=$star+$qq['star'];
//echo $output;
//$st = $qq['star'];
//$out = $qq['star'];
//echo $out;
//echo $output;
//$out2=5-$out;
 }
 
 $average=0;
// echo $star;
 $average=$star/$numberofrating;
 
 
$average=round($average);
//echo "$average";
 $out=$average;
 $out2=5-$out;

?>



 <div class="full">
<span>  <?php for($i=0; $i<$out; $i++) { ?>
            <img src="images/star.PNG"  class="star"> <?php  } ?> <?php for($i=0; $i<$out2; $i++) { ?> 
             <img src="images/fuse-star.PNG"  class="star"> <?php  } ?> <?=$out?>.0
<img src="images/purchage-yellow.png" style="margin-top: 10px; margin-bottom: 17px;" class="shopbtan"></span>
       </div>    
</div>
        </div>
<? } ?><br>
       </a>
      </div>
  <div class="col-lg-1" ></div>
  </div>
</div>
</div>
  </div>            
</div></div> 
 <div class="col-lg-12" >
 <p style="text-align: center; margin-top: 42px; margin-bottom: 53px;"><img src="images/see.png" class="seemore"></p></div> 
 
 <div class="col-lg-12">
 
<h2 class="title font-additional font-weight-bold text-uppercase wow zoomIn" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: zoomIn;">UN<b style="color:red;">BEAT</b>ABLE <b style="color:#000;">HAIR</b> DEALS</h2>
<h5 class="tittle">Giving you the best sale offers in town!view it is a very affortable price</h5>
 
 </div>
 
 <div class="col-lg-12" style="margin-top: 148px; padding-left: 0px; padding-right: 0px;" align="center">
 <p style="text-align: center; margin-top: 42px; margin-bottom: 53px;"><img src="images/bgblack.png" class="bgblack" style="width:1200px;" ></p></div>
 
 <div class="row"><div class="col-lg-12 col-xs-12 downside" id="ishu">
<div style="border-right:1px solid #EEEEEE; " class="col-lg-12">
<div align="center">
<div id="quad">
<div class="col-lg-12">
<div class="col-lg-1" ></div>
<div class="col-lg-10" style="padding-left: 0px; padding-right: 0px;">

   <? while($new_arrival1=mysql_fetch_assoc($new_arrival)){
		  
		  
 if (strpos($new_arrival1['images'],',') !== false) {
  $new_arrival1_img=explode(',',$new_arrival1['images']);
$new_arrival1_img=$new_arrival1_img[0];
}
else{
  $new_arrival1_img=$new_arrival1['images'];	
}
		
 
		   ?>
    
   <a  style="color:inherit;" href="goods_detail.php?goods_Id=<?php echo $new_arrival1['id']?>">
      
        <div class="col-xs-6 col-lg-3 <? if($row==1){ ?> col-lg-offset-1" <? } ?> align="center" id="japan"  style="padding-left:0px;">
          <div class="product_container" style="background:#E6E6E6; ">
<div class="full" align="center"><span class="product-item_sale"><img src="images/buy.png" class="pitem"></span> <img src="./thumbnailindex2.php?thumb=<?=$new_arrival1_img?>" class="img-thumbnail" style="height:250px;"></div>
<div class="full ka"><span> <?php echo $new_arrival1['product_name']?>...</span></div>
              <div class="full" style="overflow:hidden;">
            
               <?php if($_SESSION['verify_status']==1){ ?>
               <div class="col-lg-12 " align="right"><strike>$<?php echo $new_arrival1['msrp_price']?></strike>   </div>
               <div class="col-lg-12 " align="right"><span style="font-size:26px;">$<b><?php echo $new_arrival1['wholesale_price']?></b> </span>
              </div>
            
              <? } else {?>
              <div class="col-lg-12 col-md-8" align="right"><strike> $<?php echo $new_arrival1['regular_price']?> </strike>&nbsp; &nbsp; </div><div class="col-lg-12 col-md-8" align="right"><span style="font-size:26px; color:#F00;">
             $<b><?php echo $new_arrival1['msrp_price']?> </b></span> </div>
            
               <? } ?>
              
            </div>
                <?php  
		  $idx =$new_arrival1['id'];
		    $q=mysql_query("select * from rating where goods_id=$idx");
			
			//echo "select * from rating where goods_id=$idx";
			$numberofrating=mysql_num_rows($q);
			//echo "$numberofrating";
			$star=0;
			//echo $q;
 while($qq=mysql_fetch_assoc( $q)){
	 
  $output = $qq['vid'];
  
  $star=$star+$qq['star'];
//echo $output;
//$st = $qq['star'];
//$out = $qq['star'];
//echo $out;
//echo $output;
//$out2=5-$out;
 }
 
 $average=0;
// echo $star;
 $average=$star/$numberofrating;
 
 
$average=round($average);
//echo "$average";
 $out=$average;
 $out2=5-$out;

?>



 <div class="full">
<span>  <?php for($i=0; $i<$out; $i++) { ?>
            <img src="images/star.PNG"  class="star"> <?php  } ?> <?php for($i=0; $i<$out2; $i++) { ?> 
             <img src="images/fuse-star.PNG"  class="star"> <?php  } ?> <?=$out?>.0
<img src="images/purchage-yellow.png" style="margin-top: 10px; margin-bottom: 17px;" class="shopbtan"></span>
       </div>    
</div>
        </div>
<? } ?><br>
       </a>
      </div>
  <div class="col-lg-1" ></div>
  </div>
</div>
</div>
  </div>            
</div></div>
 
 
 <div class="col-lg-12"  id="sds">
 <p style="text-align: center;"><img src="images/see_more_3.png" class="seemore2"></p></div>
 
 
  <div class="col-lg-12" style="margin-top: 70px;">
 <p style="text-align: center;"><img src="images/new-arrivals.png" class="newarrivals"></p></div>
 

  
  <div class="col-lg-12">
  <p style="text-align: center;"><img src="images/hrline.png" class="line"></p>
</div>
 


 
 
 <div style="border-right:1px solid #EEEEEE;"class="col-lg-12">
<div class="col-lg-1" ></div>


	  
   <div class="col-lg-10 slider1">

								
   <? while($new_arrival1=mysql_fetch_assoc($new_arrivals)){
		  
		  
 if (strpos($new_arrival1['images'],',') !== false) {
  $new_arrival1_img=explode(',',$new_arrival1['images']);
$new_arrival1_img=$new_arrival1_img[0];
}
else{
  $new_arrival1_img=$new_arrival1['images'];	
}
		
 
		   ?>
   
  
        <a style="color:inherit;" href="goods_detail.php?goods_Id=<?php echo $new_arrival1['id']?>">
      
        <div class="col-lg-3 col-md-2 slide" id="japan" style="width:100%;">
          <div class="product_container" style="" >
          
          
            <div class="full" align="center"><img src="./thumbnailindex.php?thumb=<?=$new_arrival1_img?>" class="img-thumbnail" style="height:200px" ></div>
            
            
            
      <div class="full ka" align="center" style="min-height:20%"><b style="color:#000"> <?php echo $new_arrival1['product_name']?>..</b></div>
              <div class="full" style="overflow:hidden; " >
            
                    <?php if($_SESSION['verify_status']==1){ ?>
               <div class="col-lg-12 col-md-4" align="left"><strike>$<?php echo $new_arrival1['msrp_price']?></strike>  <br/>
                
               <span  class="size">$<b><?php echo $new_arrival1['wholesale_price']?></b> </span>
              </div>
            
              <? } else {?>
              <div class="col-lg-12 col-md-8" align="left" ><strike> $<?php echo $new_arrival1['regular_price']?> </strike>&nbsp; &nbsp;<span style="color:#F00;" class="size">
             $<b><?php echo $new_arrival1['msrp_price']?> </b></span> </div>
            
               <? } ?>
              
            </div>
                <?php  
		  $idx =$new_arrival1['id'];
		    $q=mysql_query("select * from rating where goods_id=$idx");
			
			//echo "select * from rating where goods_id=$idx";
			$numberofrating=mysql_num_rows($q);
			//echo "$numberofrating";
			$star=0;
			//echo $q;
 while($qq=mysql_fetch_assoc( $q)){
	 
  $output = $qq['vid'];
  
  $star=$star+$qq['star'];
//echo $output;
//$st = $qq['star'];
//$out = $qq['star'];
//echo $out;
//echo $output;
//$out2=5-$out;
 }
 
 $average=0;
// echo $star;
 $average=$star/$numberofrating;
 
 
$average=round($average);
//echo "$average";
 $out=$average;
 $out2=5-$out;

?>



 <div class="full">
 
 
 <span>  <?php for($i=0; $i<$out; $i++) { ?>
 <img src="images/star.PNG" style="height:10px; width:10px; display:inline;"> <?php  } ?> <?php for($i=0; $i<$out2; $i++) { ?> 
  <img src="images/fuse-star.png" style="height:10px; width:10px; display:inline;"> <?php  } ?> <?=$out?>.0
			
		</span>
           
           
           <img src="images/purchas.png" style="margin-top: 10px; margin-bottom: 17px;">
           
       </div>    
           
               </div>
        </div>
       
      <? } ?><br>
       </a>
     </div>
       </div>
      
<div class="col-lg-12" style="margin:0px; padding:0px" >
<?php include'foot.php'?>
</div>

 
              
              </div>
 
     
             
              
  <div>
 
  </div>
  
  </div>  
  <!--login popup start-->

<div id="overlay-mask-1" class="overlay-mask" style="">
  

  <div class="overlay iframe-content"><a class="close close-icon" onClick="close_popup('overlay-mask-1')">
  <span id="close_button" style="position: absolute; text-align: center; width: 100%;">X</span></a>
    <div class="content"> 
    <div class="row">
  
   
    
      <div class="col-lg-12 col-xs-12 col-xs-12">
       <form name="login_form" action="" method="post" id="loginform'" onSubmit="return_validate()">
        
    <div class="full" style="background:#FBFBFB; border:1px solid #E5E5E5; padding:5%;">
     <div class="full"><img class="img-responsive" src="images/logo1.png"></div>
  
   
     <h3 class="h3">Member Login</h3><hr>
     <div class="full" style="color:#999999; margin-top:1em;">
     <div id="berror" style="color:#FF0000" ></div>
  
   <div id="uerror" style="color:#FF0000" ></div>
   <div class="form-group"><input type="email" placeholder="email" id="email_login" name="email_login" class="form-control"></div>
   
   
   <div id="perror" style="color:#FF0000" ></div>
   <div class="form-group"><input type="password" placeholder="password" name="pwd_login" id="pwd_login" class="form-control"></div>
   
   
   <div class="" style="margin-top:2em;">
   <button type="button"  class="blue-btn glyphicon glyphicon-lock" onClick="check()" style="background:#268BB9; color:#FFF; width: 85%;">
  <span class="" style="font-family:sans-serif;" >SIGN IN</span>
  </button>
  <br>
   <span style="text-decoration:underline;"> <a href ="forget_password.php">Forgot Your Password ?</a></span><br>
   
  
   <br>
    <button type="button" class="blue-btn glyphicon glyphicon-lock" style="background:#268BB9; color:#FFF; width: 85%;" onClick="close_popup('overlay-mask-1')">
  <span class="" style="font-family:sans-serif;">Cancel</span>
  </button>
   </div>
     </div>
     </div> 
     </form>  
      </div>
    </div>
   <div style="border:0px solid #97cf00; padding:1em;" class="content"> 
    <div style="width:98%; padding:0;;" class="row">
    <div class="col-lg-12 col-xs-12 col-xs-12 text-center">
      <strong> <a href="/register.php" target="_blank">NEW MEMBER REGISTER</a></strong>
      </div>
      </div>
      </div>
     
    </div>
    </div>
  
    
    </div>
<!-- login popup end -->
  
</body>
</html>

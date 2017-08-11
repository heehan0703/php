<?php
session_start();

require_once('wp-admin/include/connectdb.php');

$subcat=$_GET['sub'];

if($subcat==''){
$subcat='Human Hair Ponytail';	
}

if(isset($_GET['search_text'])){
$search_text=$_GET['search_text'];
if(isset($_GET['search_cat']) && $_GET['search_cat']!=''){
$search_cat = $_GET['search_cat'];
 $search_query="select * from product where category='$search_cat' and (product_name like '%$search_text%' or description like '%$search_text%' )";
}
else{
$search_query="select * from product where product_name like '%$search_text%' or description like '%$search_text%' ";	
}
	
}
$product_query = mysql_query($search_query);

//$wig_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='wig'"),0);
//
//$wig_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$wig_id'");
//
//$lace_wig_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='lace wig'"),0);
//
//$lace_wig_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$lace_wig_id'");
//
//$weaving_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='WEAVING'"),0);
//
//$weaving_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$weaving_id'");
//
//$remy_hair_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='remy hair'"),0);
//
//$remy_hair_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$remy_hair_id'");
//
//$hair_piece_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='hair piece'"),0);
//
//$hair_piece_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$hair_piece_id'");
//
//$hair_care_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='hair care'"),0);
//
//$hair_care_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$hair_care_id'");
//
//$beauty_id=mysql_result(mysql_query("SELECT id FROM `category` where category_name='beauty'"),0);
//
//$beauty_query=mysql_query("SELECT * FROM `subcategory` where cat_id='$beauty_id'");
// 

?>

<!doctype html>
<html class="no-js" lang="">
    <head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Search Result</title>

<!-- Bootstrap -->
<!-- Google Font -->
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,500.00,700,300' rel='stylesheet' type='text/css'>
		
		<!-- all css here -->
		<!-- bootstrap v3.3.6 css -->
        <link rel="stylesheet" href="/shopick/css/bootstrap.min.css">
		<!-- animate css -->
        <link rel="stylesheet" href="/shopick/css/animate.css">
		<!-- jquery-ui.min css -->
        <link rel="stylesheet" href="/shopick/css/jquery-ui.min.css">
		<!-- meanmenu css -->
        <link rel="stylesheet" href="/shopick/css/meanmenu.min.css">
		<!-- nivo-slider css -->
        <link rel="stylesheet" href="/shopick/lib/css/nivo-slider.css">
		<!-- owl.carousel css -->
        <link rel="stylesheet" href="/shopick/css/owl.carousel.css">
		<!-- flaticon css -->
        <link rel="stylesheet" href="/shopick/css/shopick-icon.css">
		<!-- pe-icon-7-stroke css -->
        <link rel="stylesheet" href="/shopick/css/pe-icon-7-stroke.css">
		<!-- lightbox css -->
        <link rel="stylesheet" href="/shopick/css/lightbox.min.css">
		<!-- style css -->
		<link rel="stylesheet" href="/shopick/style.css">
        <link rel="stylesheet" href="/shopick/fstyle.css">
		<!-- responsive css -->
        <link rel="stylesheet" href="/shopick/css/responsive.css">
		<!-- modernizr css -->
        <script src="/shopick/js/vendor/modernizr-2.8.3.min.js"></script>
        
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <base href="/" />

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
	
 function show_content_slide(cls){
 $("."+cls).slideToggle('fast');
 }
   
function show_content(cls){
$("."+cls).show(0);
}
function hide_content(cls){
	$("."+cls).hide(0);
}
	
function close_popup(id){
 //$(".overlay-mask").fadeOut('slow');	
 $("#"+id).fadeOut('slow');
}	



    </script>
        <!-- new files end --->
<style type="text/css">
.main-menu ul li .submenu li:hover a, .subwigs span a:hover {
  padding-left: 20px;
}
.main-menu ul li .submenu .submenu-title a, .subwigs span .subwigs-title  {
  border-bottom: 1px solid #f6416c;
  color: #f6416c;
  display: block;
  font-size: 13px;
  font-weight: 500;
  padding-bottom: 0;
  text-transform: uppercase;
}
.main-menu ul li .submenu, .main-menu ul li .subwigs {
  opacity: 0;
  transform: scaleY(0);
  transform-origin: 0 0 0;
}
.main-menu ul li:hover .submenu, .main-menu ul li:hover .subwigs {
  opacity: 1;
  transform: scaleY(1);
  z-index: 999999;
}
.main-menu ul li .submenu li.submenu-title a:before,
.subwigs span .subwigs-title:before,
.subwigs-photo a::before {
  display: none;
}
.main-menu ul li .subwigs {
    background: #fff none repeat scroll 0 0;
    border-top: 2px solid #f6416c;
    box-shadow: 2px 6px 8px 6px rgba(0, 0, 0, 0.13);
    left: -100px;
    padding: 30px;
    position: absolute;
    width: 340px;
    z-index: 9;
}

.subwigs span {
    float: left;
    padding-right: 30px;
    width: 95%;
}
.subwigs span a {
  color: #000;
  display: block;
  font-size: 12px;
  line-height: 40px;
  position: relative;
}
.subwigs span a::before {
  color: #f6416c;
  content: "\e905";
  font-family: shopick;
  opacity: 0;
  position: absolute;
  transition: all 0.3s ease 0s;
  left: 0;
}
.subwigs span a:hover::before {
  opacity: 1;
}


/* for subweaves  */
.main-menu ul li .submenu li:hover a, .subweaves span a:hover {
  padding-left: 20px;
}
.main-menu ul li .submenu .submenu-title a, .subweaves span .subwigs-title  {
  border-bottom: 1px solid #f6416c;
  color: #f6416c;
  display: block;
  font-size: 13px;
  font-weight: 500;
  padding-bottom: 0;
  text-transform: uppercase;
}
.main-menu ul li .submenu, .main-menu ul li .subweaves {
  opacity: 0;
  transform: scaleY(0);
  transform-origin: 0 0 0;
}
.main-menu ul li:hover .submenu, .main-menu ul li:hover .subweaves {
  opacity: 1;
  transform: scaleY(1);
  z-index: 999999;
}
.main-menu ul li .submenu li.submenu-title a:before,
.subweaves span .subweaves-title:before,
.subweaves-photo a::before {
  display: none;
}
.main-menu ul li .subweaves {
    background: #fff none repeat scroll 0 0;
    border-top: 2px solid #f6416c;
    box-shadow: 2px 6px 8px 6px rgba(0, 0, 0, 0.13);
    left: -100px;
    padding: 30px;
    position: absolute;
    width: 340px;
    z-index: 9;
}

.subweaves span {
    float: left;
    padding-right: 30px;
    width: 95%;
}
.subweaves span a {
  color: #000;
  display: block;
  font-size: 12px;
  line-height: 40px;
  position: relative;
}
.subweaves span a::before {
  color: #f6416c;
  content: "\e905";
  font-family: shopick;
  opacity: 0;
  position: absolute;
  transition: all 0.3s ease 0s;
  left: 0;
}
.subweaves span a:hover::before {
  opacity: 1;
}
.header-area {
    background: #ffffff none repeat scroll 0 0;
}


@media (min-width:200px) and (max-width: 600px) {
 table{
 border-collapse: collapse;
    border-spacing: 0;
    table-layout: fixed;
    width: 100%;
    word-break: break-all;
	}

}



</style>
</head>
<body>
 <?php include'header-new.php'?>
<div class="full"> 
  <!--header start-->
<!--header end--> 

<!--body start-->
<div class="full" id="body_container">
  <div class="container">
  
    <div class="row" style="padding:1em;"> 
    <a style="color:inherit;" href="https://fahair.com"> Home </a>/ Search Result<br>
     </div>
     </div>
     
    <div class="full" style=" background:#DEDEDE; height:1px;margin:.9em 0;"></div>
    
     <div class="container">
    <div class="row" style="padding:1em 0;">
   <!--list item start -->
 
   <!--category and their product start-->
    <div class="full">
    <!-- left bar start -->
      <div class="col-lg-2 small-hidden" style="padding-left:0px;">
      
     
     
    
      
       
   
  
  
 
      
        
      </div>
      <!-- left bar end -->
      
      <!-- right side content start -->
      <div class="col-lg-10 small-padding-hidden" style="padding-top:45px;">
      
  <div class="full" style=" padding-bottom:30px;">
<!--  <div class="row">
  <div class="col-lg-3 col-sm-6 col-xs-12">Price:<input type="text" class="input-xm">-<input type="text" class="input-xm"></div>
  <div class="col-lg-3 col-sm-6 col-xs-12">Min Order:<input type="text" class="input-xm">-<input type="text" class="input-xm"></div>-->
  </div>
  <div class="row" style="padding-top:.6em;">
 <div class="col-lg-6 col-sm-6 col-xs-12"><span style="color:#FE758F;">Best Match</span> &nbsp; Price <i class="glyphicon glyphicon-sort"></i>&nbsp;Order &nbsp;<i class="glyphicon glyphicon-arrow-down"></i> </div>
 <div class="col-lg-4 col-sm-6 col-xs-12 text-right">View as <span class="glyphicon glyphicon-th-list" style="border:1px solid #DDDDDD; color:#AAAAAA; background:#fff; padding:3px;"></span>&nbsp;<span class="glyphicon glyphicon-th-large" style="border:1px solid #DDDDDD; background:#fff; color:#0194E8; padding:3px;"></span></div> 
  </div> 
  </div>
      
       <div class="full">
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
<a href="/<?=$producturl1?>-<?=$product_row['id']?>.html" style="color:inherit;" title="<?=strtolower($product_row['product_name'])?>">
        <div class="col-lg-3">
          <div class="product_container " style="border:2px solid #CCCCCC; border-radius:5px; padding:.5em; background:#FFF;">
        <div class="full" align="center"><img src="product_img/<?=$product_img?>" class="img-thumbnail" style="height:200px !important" alt="<?=strtolower($product_row['product_name'])?>" ></div>
            <div class="full"><span><?=$product_row['product_name']?></span></div>
            <div class="full" style="overflow:hidden;">
               <!-- <div class="col-lg-4 col-sm-4 col-xs-4"><strike>$<?=$product_row['regular_price']?> </strike></div> -->
               <!--<div class="col-lg-4 col-sm-4 col-xs-4" style="color:#F00"><?=$product_row['msrp_price']?></div> -->
              <div class="col-lg-4 col-sm-4 col-xs-4"><img src="images/cart.png" ></div></div>
               <div class="full" style="font-weight: 600;"><span style="color:#999;"> Min Order</span>&nbsp;
               <span style="color:#000;">1 Piece</span></div></div>
        </div>
        </a>
        <?php if($c==4){ ?></div><div class="full" style="margin:3em 0;">
        <?php $c=0;}?>
      
    <?php } ?>   

      </div>
      </div>
      <!-- right side content end   -->
   
    
   
          
    </div>
    <!--category and their product end-->
 
  
  <!-- list item end  -->
    
     
    </div>
    
    
    
    
  </div>
</div>

<!--body end--> 

<!-- footer start-->
<!--footer end  -->

</div>

 <div class="col-lg-12" style="margin:0px; padding:0px" >
<?php include'foot-new.php'?>
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

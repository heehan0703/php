<?php 
require_once('wp-admin/include/connectdb.php');
require_once('get_distance.php');
//$idss1
$addid=$_GET['id'];

$store_name=mysql_fetch_array(mysql_query("SELECT * FROM store where id = $addid;"));

$store_time=mysql_query("SELECT * FROM store_times where store_id= $addid ORDER BY FIELD('MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY', 'SUNDAY');");

?>
<!doctype html>
<html><head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cart</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">


<!--For Demo Only (Remove below css file and Javascript) -->
<link rel="stylesheet" type="text/css" media="all" href="css/demo.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- bxSlider Javascript file -->
<script src="bx/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->
<link href="bx/jquery.bxslider.css" rel="stylesheet" />

  
  <script language="javascript">
  $(document).ready(function(){
  $('.slider1').bxSlider({
    slideWidth: 200,
    minSlides: 2,
    maxSlides: 3,
    slideMargin: 10
  });
});
  </script>

  
<style type="text/css">
@import url(//fonts.googleapis.com/css?family=Lato:400,700,900);

#body_container {
	background-image: url("images/strip.png");
	background-repeat: repeat-x;
	background-color: #F5F5F5;
}

</style>

</head>
<body>
<?php //include'var1.php'?>
<div class="full"> 
  <!--header start-->


<!--header end--> 

<!--body start-->
<div class="full" id="body_container">
  <div class="container">
   
    <div class="slider1">
    <?php for ($z = 0; $z < 7; $z++) { ?>
      <div class="slide"><a href="store1_detail.php?id=<?=$idss[$z];?>"><?= $name[$z];?></a> </div>
     <?php } ?>
    
   </div>
</div>
<div style=" background:#DEDEDE; height:1px;margin:.9em 0;" class="full"></div>

<div class="full row" align="center" style=" margin:0px auto; background-color:#FFF;">
<div class="container" >
<!-- left menu start -->
<div class="col-lg-2 col-sm-12 col-sx-12"  >
SHOPE THIS STORE

</div>
<div class="col-lg-2 col-sm-12 col-sx-12"  >
SEARCH
</div>
<div class="col-lg-2 col-sm-12 col-sx-12"  >

WEEKLY ADS
</div>
<div class="col-lg-2 col-sm-12 col-sx-12"  >
ROLLBACK

</div>
<div class="col-lg-2 col-sm-12 col-sx-12"  >
COUPONS

</div>
<div class="col-lg-2 col-sm-12 col-sx-12"  >
<a href="store1_detail.php?id=<?= $addid;?>">
STORE HOURS AND SERVICES
</a>
</div>

</div>
</div>
<div class="full row" align="center" style=" margin:0px auto;">
<div class="container" >
<!-- left menu start -->

<div class="col-lg-8 col-sm-12 col-sx-12" align="left";>

<h3><?= $store_name['s_name'];?></h3>
<br>
<font><?= $store_name['s_phone'];?></font>
<br>
<font><?= $store_name['zip'];?><?= $store_name['s_location'];?> , <br><?= $store_name['s_city'];?>
<?= $store_name['s_state']?></font>
<br>
<h4>OPEN TIME</h4>
<div class="col-lg-6 col-sm-12 col-sx-12" align="left";>

 <?php while($store_t=mysql_fetch_array($store_time)){ ?>
<div class="col-lg-6 col-sm-12 col-sx-12" align="left";><h5><?= $store_t['day'];?></h5></div> <div class="col-lg-6 col-sm-12 col-sx-12" align="left";><h5><?= $store_t['open_time'];?>-<?= $store_t['close_time'];?></h5></div>
<?php } ?>
</div>
</div>
<!-- left menu end-->

<!-- right menu start-->

<div align="center" class="col-lg-3">


</div>
<!-- right menu end  -->
</div>
</div>

</div>

<!--body end--> 

<!-- footer start-->

 <?php include'foot.php'?>

<!--footer end  -->

</div>


<script src="js/bootstrap.min.js"></script>

</body>
</html>

<?php
session_start();
//print_r($_SESSION);
require_once('wp-admin/include/connectdb.php');
$getid=$_GET['id'];

?>


<html>
<head>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>store front</title>

<link rel="stylesheet" href="./colorbox/colorbox.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		


<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />

</head>
<body>


  <!--header start-->
 <div class="full"><?php include'var1.php'?>
  
<!--body start-->
<div class="full" style="background-color:white;">
   <?php 
     $store=mysql_fetch_assoc(mysql_query("select * from coupon where store_id='$getid'"));
   ?>    

  <div class="container">
    <div class="row" style="padding:1em;">
  <a style="color:inherit;" > target </a> /
  <a style="color:inherit;" > find a city</a>/ 
  <a style="color:inherit;"> <?= $store['s_name'];?></a>
    </div>
     <div class="row" style="padding:1em;">
     <a style="color:inherit;"> <b><?= $store['s_name'];?></b></a>
     </div>
  </div>
   <div class="full" style=" background:#DEDEDE; height:3px;margin:.9em 0;"></div>
  <div class="container">
    <div class="row" style="padding: 1em 10% 1em 10%;"> 
      <!--list item start --> 
      
      <!--category and their product start-->
      <div class="full">
       <!-- left part start --> 
        <div class="col-lg-6 col-md-6">
        
       <span style="color:#000;">
       back to result page
       </span>
        <br>
        <div class="full" align="center">
<div id="googleMap" style="height:380px;"></div>  
</div>
       
       </div>
         <!-- left part end --> 
          <!-- right part start --> 
        <div class="col-lg-6 col-md-6">
          <div>
         
              
               <div class="row" style="padding:.3em .5em;">
          <div  style="color:#999;  padding-left: 0px; padding-right: 0px;"><b> <?=$store['zip']?> <?=$store['s_location']?> <?=$store['s_city']?> <?=$store['s_state']?></b> </div><br>
                     <p><?=$store['s_phone']?></p>
                     <br>
                   <div class="row"> 
                   
                     <?php 
     $time=mysql_query("select * from store_times where store_id='$getid'");
	 
	 
	  while($times=mysql_fetch_assoc($time)){
   ?>    

 <div class="col-lg-3 col-sm-5 col-xs-5" style="color:#999; "><b><?= $times['day']?></b> </div>
           <div class="col-lg-9 col-sm-5 col-xs-5" style="color:#999; "><?= $times['open_time']?>&nbsp;t0&nbsp;<?= $times['close_time']?>  </div>
         <?php } ?>  
           </div>
               </div>
              
              <div class="row" style="padding:.3em .5em;"> this is my store  </div>
              
                
                  
              
             <div class="row" style=" background:#DEDEDE; height:2px;margin:.9em 0;"></div>
           
                
               <div class="row">
               
             <?php 
			 $add=mysql_fetch_assoc(mysql_query("select * from adds where store_id='$getid' order by id DESC"));
			 
			 ?>  
                              
         <div class="col-lg-4 col-sm-5 col-xs-5" ><img src="./storeadsimages/<?=$add['add_image']?>"> </div>
     <div class="col-lg-8 col-sm-5 col-xs-5" style="color:#999; ">
     <b><?=$add['add_name']?></b> <br><br> <p><a href="store_add.php?store_id=<?=$add['store_id']?>">view the ad</a></p></div>
           
               
               
               </div>  
               
             <div class="row" style=" background:#DEDEDE; height:2px;margin:.9em 0;"></div>
               
                 
                   <div class="row">
               
                <?php 
			 $coupon=mysql_fetch_assoc(mysql_query("select * from coupon where store_id='$getid' order by id DESC"));
			 
			 ?>  
                              
         <div class="col-lg-4 col-sm-5 col-xs-5" ><img src="./couponimages/<?=$coupon['image']?>" style="height:127px; width:127px;"></div>
           <div class="col-lg-8 col-sm-5 col-xs-5" style="color:#999; z-index: 1 ">
           <b><?=$coupon['code']?></b> <br><br> <p><a href="store_coupon.php?store_id=<?=$coupon['store_id']?>">view the ad</a></p></div>
           
               
               
               </div>    
                 
                   </div>
                   
         
        
       
        
          </div>
           
            
          </div>
          <!-- right part end --> 
     
          
   
        </div>
        </div>
        
        </div>
 
  </form>
</div>

<!--body end--> 

<!-- footer start-->
<div>
<?php include'foot.php'?>
</div>
<!--footer end  -->






<!-- bulk order start -->


</body>
</html>




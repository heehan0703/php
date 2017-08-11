<?
session_start();
require_once('wp-admin/include/connectdb.php');
require_once('get_distance.php');
$subcat=$_GET['sub'];
if($subcat==''){
$subcat='Human Hair Extension Factory Price';	
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
$cat_query=mysql_query("SELECT * FROM `category` where category_name!='' order by id asc");
$cat_query1=mysql_query("SELECT * FROM `category` where category_name!='' order by id asc");
$cat_query1_small=mysql_query("SELECT * FROM `category` where category_name!='' order by id asc");
$day = date("l");
$store1=mysql_fetch_assoc(mysql_query("SELECT * FROM store_times where day='$day' AND store_id='$idss[0]'"));
$store2=mysql_fetch_assoc(mysql_query("SELECT * FROM store_times where day='$day' AND store_id='$idss[1]'"));
$store3=mysql_fetch_assoc(mysql_query("SELECT * FROM store_times where day='$day' AND store_id='$idss[2]'"));
?>
<link rel="icon" href="favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
<script type="text/javascript">
 function show_account_menu(){
 jQuery("#account_menu").toggle();
}
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
function searchstore(){
var x = document.forms["searchform"]["address"].value;
if (x == null || x == "") {
        alert("Address must be filled out");
        return false;
    }else{
    document.forms["searchform"].submit();
	}
}

</script>


<style type="text/css">



</style>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-80000352-1', 'auto');
  ga('send', 'pageview');

</script>
<head>
<link rel="stylesheet" href="css_pages/var.css" >
</head>
<div>
<div  id="pro">
<div align="center">
<div id="dhi" >

<!--start first-->
<div class=" col-lg-3 col-sm-6 col-xs-6 down first sml-menu"  style="margin-top: 18px;">
<a href="https://www.facebook.com/fafashioninc/" target="_new"><i class="fa fa-facebook fa-2x" ></i></a>       
<a href="https://plus.google.com/u/0/+FaHair/posts" target="_new""><i class="fa fa-google-plus"></i></a>          
<a href="https://www.instagram.com/fa_hair_" target="_new""><i class="fa fa-instagram"></i></a>       
<a href="https://twitter.com/fahairinc" target="_new""><i class="fa fa-twitter"></i></a>  
<a href="https://www.youtube.com/channel/UC6UcxJO3BVD5CKOrpHiHhAg" target="_new"><i class="fa fa-youtube"></i> </a>      
<a href="https://www.linkedin.com/in/fa-hair-80122b120" target="_new"><i class="fa fa-linkedin"></i> </a>       
 </div> 
 
 <div class=" col-lg-2 col-sm-12 col-xs-2 down second " align="center" >
</div>
<div class=" col-lg-3 col-sm-12 down third car" align="right">
 <span> <a href="wishlist.php" >WISHLIST</a></span>
   <span><a href="cart.php" >MY CART</a></span>
     <span><a href="harish-contain.php" >DEALER</a></span>

 <? if($_SESSION['member_id']!=''){?>
        <span onclick="show_account_menu()" style=" cursor:pointer; color:#000000">ACCOUNT</span>
        <ul id="account_menu" style="right:83px;">
      <a href="edit_register.php" style="color:inherit;"> <li>Account information</li></a>
   <a href="buyer_order_history_list.php" style="color:inherit;"> <li>Order history</li></a>
    
      <a href="buyer_myaccount_message.php" style="color:inherit"><li>Message</li> </a> 
      <a href="logout.php" style="color:inherit"><li>Logout.</li> </a> 
        </ul>
        <? } 
		else {?>  <span onclick="window.location.href='register.html'" style=" cursor:pointer;">ACCOUNT</span><? } ?></div>
        
         <div class="col-lg-2 col-sm-12 col-xs-8 down four ">
<div class="dropdown" >
<img src="images/mystore-compressor.png"  onclick="myFunction()" class="dropbtn dump">
  <div id="myDropdown" class="dropdown-content">
    <?
	 if(!$_SESSION['latitude'] and !$_SESSION['longitude']){
	 ?>
     <hr class="hrclass">
    <a>
    <b>Find More stores</b>
    <form class="" method="post" action="/search_store.php" name="searchform" onsubmit="return searchstore()">
    <div>
   <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="text" class="form-control input-lg" placeholder="Search more stores here"  name="address" />
                    <span class="input-group-btn" style="background-color:darkgreen;" onclick="searchstore();">
                        <button class="btn btn-info btn-lg" type="button" style="color:white">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </div>
    </div>
   
     
     </form>    
    </a>
     
     <? }else{ ?>
  
    <a  style="background-color:#EF212D; color:#FFF;"><img src="images/homer.png" width="28" height="28" alt="homer" align="middle" > &nbsp;&nbsp;<font>My Current Store:</font><font><?php  echo ($city[0]); ?>...</font></a>
    <a href="store_front.php?id=<?php  echo ($idss[0]); ?>" id="a2"><font size="+1" color="#4C0608"><b><?php  echo ($name[0]); ?>..</b></font>
    <br/><b>Location:</b><font><?php  echo ($location[0]); ?><?php  echo ($city[0]); ?><?php  echo ($state[0]); ?></font><br/><b>Phone:</b> <?php  echo ($phone[0]); ?> <br/>
    <font color="#D20005">OPEN TODAY</font><font> <?= $store1['open_time'];?>- <?= $store1['close_time'];?></font></a> 
    <a href="" style="background-color:#DDF4D8;"><img src="images/locator.png" width="24" height="32" alt="locator" align="middle">&nbsp;&nbsp;<font><b>Stores Near you</b></font></a>
    <a href="store_front.php?id=<?php  echo ($idss[1]); ?>"><font><b><?php  echo ($name[1]); ?></b></font>
    <br><b>Location:</b><font><?php  echo ($location[1]); ?><?php  echo ($city[1]); ?><?php  echo ($state[1]); ?></font></br><b>Phone:</b> <?php  echo ($phone[1]); ?> <br/>
    <font color="#137100">OPEN TODAY</font><font><?= $store2['open_time'];?>- <?= $store2['close_time'];?></font></a>
    <p > <a href="store_front.php?id=<?=$idss[1]; ?>&mystore=true"><input type="image" name="submit" src="images/make1.jpg" alt="Submit" /></a></p>
    
    <hr class="hrclass">
   
    <a href="store_front.php?id=<?php  echo ($idss[2]); ?>"><font><b><?php  echo ($name[2]); ?></b></font>
    <br><b>Location:</b><font><?php  echo ($location[2]); ?><?php  echo ($city[2]); ?><?php  echo ($state[2]); ?></font></br><b>Phone:</b> <?php  echo ($phone[2]); ?> <br/>
    <font color="#137100">OPEN TODAY</font><font> <?= $store3['open_time'];?>- <?= $store3['close_time'];?></font></a>
    <p ><a href="store_front.php?id=<?=$idss[2];?>&mystore=true"><input type="image" name="submit" src="images/make1.jpg" alt="Submit" /></a></p>
    
    <hr class="hrclass">
    <a>
    <b>Find More stores</b>
    <form class="" method="post" action="/search_store.html" name="searchform" onsubmit="return searchstore()">
    <div>
   <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="text" class="form-control input-lg" placeholder="Search more stores here"  name="address" />
                    <span class="input-group-btn" style="background-color:darkgreen;" onclick="searchstore();">
                        <button class="btn btn-info btn-lg" type="button" style="color:white">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </div>
    </div>
   
     
     </form>    
    </a>
    <? } ?>
  </div>
</div>
       <? if($_SESSION['member_id']!=''){?> <a href="logout.php" style="color:inherit"> <img src="images/logout.png" class="dump"></a> <? }else{?>
        <img src="images/login-compressor.png" class="dump" onClick="show()"> <? } ?>
        </div>
       </div>
 </div>    
</div>
       
<!--end first-->

<div align="center">
<div class="row" id="dh"><!--start second-->
 <div class="col-lg-12 col-md-10 col-xs-12" id="z">
 <form method="get" action="search_result.php">
          <div class="col-lg-6 col-md-4 col-xs-10" align="center"><a href="https://fahair.com" ><img src="images/logo1-compressor.png" class="img-responsive dumpnew" alt="fa-hair"> </a></div>
          
          <div class="col-lg-2 col-md-2 col-xs-5" align="left">
         
           <select class="search-header glyphicon-arrow-down arrow-down-cls" id="dw1"  name="search_cat" >
              <option value="" style="color:#000;">Categories</option>
              <?php while($cat_row=mysql_fetch_assoc($cat_query)){ ?>
           <option value="<?=$cat_row['category_name']?>"><?=$cat_row['category_name']?></option>  
           <? } ?> 
            </select>
            
          </div>
          <div class="col-lg-3 col-md-4 col-xs-4" align="right" >
           <input id="pts_search_query_top" type="search"  placeholder="Search..." name="search_text"  >
           
          </div>
          <div class="col-lg-1 col-md-1 col-xs-3" align="right" >
          <input type="submit" src="images/search.png" id="pro3" value="SEARCH">
         
          </div>
     
          </form>
          </div>


</div><!--end second-->
</div>
  

        
<div style="margin-top: 20px;"  >
<!-- menu start -->
<?php include'me.php'?>
<!-- menu end -->
</div>

</div>

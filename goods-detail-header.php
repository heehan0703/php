<?
session_start();
require_once('wp-admin/include/connectdb.php');
require_once('get_distance.php');
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


$cat_query=mysql_query("SELECT * FROM `category` where category_name!='' order by id asc");

$cat_query1=mysql_query("SELECT * FROM `category` where category_name!='' order by id asc");

$cat_query1_small=mysql_query("SELECT * FROM `category` where category_name!='' order by id asc");
$day = date("l");
//echo $date;
 // echo $idss[0]; 
$store1=mysql_fetch_assoc(mysql_query("SELECT * FROM store_times where day='$day' AND store_id='$idss[0]'"));
$store2=mysql_fetch_assoc(mysql_query("SELECT * FROM store_times where day='$day' AND store_id='$idss[1]'"));
$store3=mysql_fetch_assoc(mysql_query("SELECT * FROM store_times where day='$day' AND store_id='$idss[2]'"));

 
?>

<script type="text/javascript">
 function show_account_menu(){
 jQuery("#account_menu").toggle();
}

/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
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

</script>


<style type="text/css">
#z{  margin-left: -89px;}
.four{
		 
		 margin-left:42px;
		 
		
		}
		@media (min-width: 1024px) {
		#dh{width:1379px;}
		#dhi{width:1409px;}
		}
@media (min-width: 266px) and (max-width: 1024px) {
	#z{  margin-left: 0px;}
	li.hoverTrigger {
	width:200px;
	    
}

.dropbtn dump{
		height:30px;
		width:45px;
		
	}
	
	.dump{
		height:30px;
		width:45px;
		
	}
#pes{ margin-left:20%; margin-top: -37px; margin-bottom: 12px;}

#k{
	display: inherit!important;
}
.first i{
	width:15px;
	}
	.down first{
	margin-left: -169px;
	
	}
	
	.four{
		 
		 margin-left:154px; margin-top:-29px !important;
		
		
		}
		.third{
			display:none;
			
			}
			
			.dumpnew{
			margin-left: 23px;
			margin-top: -33px; padding-bottom: 10px;
			}
			 .perso{
				 display:none;
				 }
#dw1{  width:100% !important;  background:url(/images/select-icon.png) no-repeat right #FFF; -moz-appearance: none; -webkit-appearance:none;}
#pts_search_query_top{ width:200% !important; margin-left: -31px;}
				 
.col-lg-3 i {
    font-size: large !important;
}			
.img-responsive dumpnew{ margin-top:0px;}
#pro {
		 height: 58px !important;
		
		}
	
}

#dw1{ width:116%; height: 37px; background:url(/images/select-icon.png) no-repeat right #FFF; -moz-appearance: none; -webkit-appearance:none;   }
#pts_search_query_top{width:135%; height:37px;}
#pro3{width:100%; height: 37px; }
#account_menu{
	background:#432F26;
	color:#FFF;
	padding-left:3px;
	position:absolute;	display:none;
	z-index:222222;
	padding:.3em;
}
#account_menu li{
	padding:.3em 0;
}
.sml-menu li{
	color:#FFF;
	border-bottom:1px solid #FFF;
	padding:.3em;
}

#k{
	display:none;
}

	#pro {
		background-image:url(images/top_menubg.png);
		background-repeat:repeat-x;
		 height: 60px;
		 
		}
	.col-lg-3  i{ font-size:x-large;

	
	}
	.down{
		margin-top:9px;
		left:3%;
		}

.dropbtn {
   
    cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
    background-color: #EF212D;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
	right:0px;
    background-color: #f9f9f9;
    min-width:400px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	z-index:10000;
	
}

.dropdown-content a { 
font-family:Arial, Helvetica, sans-serif;
	text-align: left;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
	
}

.dropdown a:hover {background-color: #f1f1f1;}
#a2:hover{ background-color: #f1f1f1 !important; }

.show {display:block;}

.search1
{
background: url(images/searchs.png);
height:49;
width:47;


} 
@media (min-width: 266px) and (max-width: 1024px) {
	.dropdown-content {
    
    min-width:200px;
   
	
}


	
.dropdown-content a {
	font-size:12px;


	width:200px;
	
}	
	}

#custom-search-input{
    padding: 3px;
    border: solid 1px #E4E4E4;
    border-radius: 6px;
    background-color: #fff;
}

#custom-search-input input{
    border: 0;
    box-shadow: none;
}

#custom-search-input button{
    margin: 2px 0 0 0;
    background: none;
    box-shadow: none;
    border: 0;
    color: #666666;
    padding: 0 8px 0 10px;
    border-left: solid 1px #ccc;
}

#custom-search-input button:hover{
    border: 0;
    box-shadow: none;
    border-left: solid 1px #ccc;
}

#custom-search-input .glyphicon-search{
    font-size: 23px;
}
.car{margin-top: 20px; margin-left: 3%; left: 70px;}
</style>


<!--Bootstrap-->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />

<!--Bootstrap-->

<!--Main Menu File-->
<link rel="stylesheet" type="text/css" media="all" href="css/color-theme.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/webslidemenu.css" />
<script type="text/javascript" src="js/webslidemenu.js"></script>
<!--Main Menu File-->

<!-- font awesome -->
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" />
<!-- font awesome -->

<!--For Demo Only (Remove below css file and Javascript) -->
<link rel="stylesheet" type="text/css" media="all" href="css/demo.css" />
<script type='text/javascript'>
$(document).ready(function() {
    $(".gry, .blue, .green, .red, .orange, .yellow, .purple, .pink, .whitebg, .tranbg").on("click", function() {
        $(".wsmenu")
            .removeClass()
            .addClass('wsmenu pm_' + $(this).attr('class') );       
    });
	
	$(".blue-grdt, .gry-grdt, .green-grdt, .red-grdt, .orange-grdt, .yellow-grdt, .purple-grdt, .pink-grdt").on("click", function() {
        $(".wsmenu")
            .removeClass()
            .addClass('wsmenu pm_' + $(this).attr('class') );       
    });
});
</script>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>index</title>
   </head>


 
    
 
<div class="container-fluid"  style="padding-left:0px; padding-right:0px;" >
<div class="row">
 <a href="harish-contain.php"><span id="k" style="margin-left: 19px; padding-left: 155px; margin-top: -31px;"> <strong style="margin-left: 25px;"> Dealer</strong></span></a> 
 </div>
 
<div class="row" id="pro">
<div align="center">
<div id="dhi">

<!--start first-->
<div class=" col-lg-3 col-sm-6 col-xs-6 down first sml-menu"  style="margin-top: 18px;">
<i class="fa fa-facebook fa-2x" ></i>       
<i class="fa fa-google-plus"></i>         
<i class="fa fa-instagram"></i>      
<i class="fa fa-twitter"></i> 
<i class="fa fa-yahoo"></i>          
<i class="fa fa-youtube"></i>      
<i class="fa fa-linkedin"></i>       
 </div> 
 
 <div class=" col-lg-2 col-sm-12 col-xs-2 down second " align="center" >
</div>
<div class=" col-lg-3 col-sm-12 down third car" align="right" style=" ">
 <span style="padding-right: 10px;" >    <a href="wishlist.php" style="color:#000000;">WISHLIST</a></span>
   <span style="padding-right: 10px;">    <a href="cart.php" style="color:#000000;">MY CART</a></span>
     <span style="padding-right: 10px;">  <a href="harish-contain.php" style="color:#000000;">DEALER</a></span>

 <? if($_SESSION['member_id']!=''){?>
        <span onclick="show_account_menu()" style=" cursor:pointer; color:#000000">ACCOUNT</span>
        <ul id="account_menu" style="right:83px;">
      <a href="edit_register.php" style="color:inherit;"> <li>Account information</li></a>
   <a href="buyer_order_history_list.php" style="color:inherit;"> <li>Order history</li></a>
    
      <a href="buyer_myaccount_message.php" style="color:inherit"><li>Message</li> </a> 
      <a href="logout.php" style="color:inherit"><li>Logout</li> </a> 
        </ul>
        <? } 
		else {?>  <span onclick="window.location.href='register.php'" style=" cursor:pointer;">ACCOUNT</span><? } ?></div>
         <div class=" col-lg-2 col-sm-12 col-xs-8 down four " align="left">
<div class="dropdown" >
<img src="images/mystore.png"  onclick="myFunction()" class="dropbtn dump">
  <div id="myDropdown" class="dropdown-content">
  
    <a  style="background-color:#EF212D; color:#FFF;"><img src="images/homer.png" width="28" height="28" alt="homer" align="middle" > &nbsp;&nbsp;<font>My Current Store:</font><font><?php  echo ($city[0]); ?>...</font></a>
    <a href="store_front.php?id=<?php  echo ($idss[0]); ?>" style="background-color:#F7EBED;" id="a2"><font size="+1" color="#4C0608"><b><?php  echo ($city[0]); ?><?php  echo ($name[0]); ?>..</b></font>
    <br/><b>Location:</b><font><?php  echo ($location[0]); ?><?php  echo ($city[0]); ?><?php  echo ($state[0]); ?></font><br/><b>Phone:</b> <?php  echo ($phone[0]); ?> <br/>
    <font color="#D20005">OPEN TODEY</font><font> <?= $store1['open_time'];?>- <?= $store1['close_time'];?></font></a> 
    <a href="" style="background-color:#DDF4D8;"><img src="images/locator.png" width="24" height="32" alt="locator" align="middle">&nbsp;&nbsp;<font><b>Stores Near you</b></font></a>
    <a href="store_front.php?id=<?php  echo ($idss[1]); ?>" style=""><font><b><?php  echo ($city[1]); ?><?php  echo ($name[1]); ?></b></font>
    <br><b>Location:</b><font><?php  echo ($location[1]); ?><?php  echo ($city[1]); ?><?php  echo ($state[1]); ?></font></br><b>Phone:</b> <?php  echo ($phone[1]); ?> <br/>
    <font color="#137100">OPEN TODEY</font><font><?= $store2['open_time'];?>- <?= $store2['close_time'];?></font>
    <p ><input type="image" name="submit" src="images/make1.jpg" alt="Submit" /></p>
    </a>
    <hr style="background-color:#C4DCC2;height:5px; margin:0px; border:none">
   
    <a href="store_front.php?id=<?php  echo ($idss[2]); ?>" style=""><font><b><?php  echo ($city[2]); ?> <?php  echo ($name[2]); ?></b></font>
    <br><b>Location:</b><font><?php  echo ($location[2]); ?><?php  echo ($city[2]); ?><?php  echo ($state[2]); ?></font></br><b>Phone:</b> <?php  echo ($phone[2]); ?> <br/>
    <font color="#137100">OPEN TODEY</font><font> <?= $store3['open_time'];?>- <?= $store3['close_time'];?></font>
    <p ><input type="image" name="submit" src="images/make1.jpg" alt="Submit" /></p>
    </a>
    <hr style="background-color:#C4DCC2;height:5px; margin:0px; border:none ">
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
  </div>
</div>
        <img src="images/logout.png" class="dump">
        </div>
       </div>
 </div>    
</div>
       
<!--end first-->

<div align="center">
<div class="row" style="margin-top: 54px; " id="dh"><!--start second-->
 <div class="col-lg-12 col-md-10 col-xs-12 "  style="margin-top: -8px;" id="z">
 <form method="get" action="search_result.php">
          <div class="col-lg-6 col-md-4 col-xs-10" align="center"><a href="index1.php" ><img src="images/logo1.PNG" class="img-responsive dumpnew" > </a></div>
          
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
         <a href="#"><img src="images/search.png" id="pro3" ></a>
          </div>
     
          </form>
          </div>


</div><!--end second-->
</div>

  

        
<div style="margin-top: 20px;"  >
<!-- menu start -->
<div class="wsmenucontainer clearfix" >
<div class="overlapblackbg"></div>
 

  <div class="wsmobileheader clearfix">
  <a id="wsnavtoggle" class="animated-arrow"><span></span></a>

  </div>
  
  <div class="header" align="center">
  <div class="wrapper clearfix bigmegamenu">
 

  <!--Main Menu HTML Code-->
      <nav class="wsmenu clearfix" style="float:left;">
                    <ul class="mobile-sub wsmenu-list">
                      <li ><a href="index.php" class="active"><i class="fa fa-home"></i><span class="hometext">Home</span></a></li>
                      
                      <li ><a href="#" style="width: 124px;" class="2">LACE WIG<span class="arrow"></span></a>
                        <div class="megamenu clearfix">
                          <ul class="col-lg-3 col-md-3 col-xs-12 link-list">
                            <li class="title"><a href="http://beautco.com/goods_list.php?cat=LACE%20WIG">All of LACE WIGS</a></li>
                            <li><a href="http://beautco.com/goods_list.php?cat_id=2&sub=FULL%20LACE%20WIGS"><i class="fa fa-arrow-circle-right"></i>FULL LACE WIGS</a></li>
                            <li><a href="http://beautco.com/goods_list.php?cat_id=2&sub=LACE%20FRONT%20WIGS"><i class="fa fa-arrow-circle-right"></i>LACE FRONT  WIGS</a></li>
                            <li><a href="http://beautco.com/goods_list.php?cat_id=2&sub=CELEBRITY%20WIGS"><i class="fa fa-arrow-circle-right"></i>CELEBRITY WIGS</a></li>
                            <li><a href="http://beautco.com/goods_list.php?cat_id=2&sub=%20AFFORDABLE%20WIGS"><i class="fa fa-arrow-circle-right"></i>AFFORDABLE WIGS</a></li>
                          </ul>
                           <div class="col-lg-3 col-md-3 col-xs-12">
                            <h3 class="title">Images </h3>
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                              <div class="carousel-inner" role="listbox">
                                <div class="item active"> <img src="images/lace.png"  style="width:300px; height:260px;">
                                  
                                </div>
                                
                             </div>
                           <li><a href="#" style="width: 124px;">WIGS<span class="arrow"></span></a>
                        <div class="megamenu clearfix">
                          <ul class="col-lg-3 col-md-3 col-xs-12 link-list">
                            <li class="title">HUMAN HAIR</li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>REMY HAIR WIG</a></li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>HUMAN HAIR WIG</a></li>
                          </ul>
                          <ul class="col-lg-3 col-md-3 col-xs-12 link-list">
                            <li class="title">SYNTHETIC HAIR</li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>SYNTHETIC HAIR WIG</a></li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>CLIP IN WIG</a></li>
                          </ul>
                           <div class="col-lg-3 col-md-3 col-xs-12">
                            <h3 class="title">Images </h3>
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                              <div class="carousel-inner" role="listbox">
                                <div class="item active"> <img src="images/wig.png" style="width:300px; height:260px;" >
                                  
                                </div>
                                <div class="item"><img src="images/wig2.png" style="width:300px; height:260px;" >
                                
                                </div>
                             </div>
                              
                              <li><a href="#" style="width: 124px;">REMY HAIR <span class="arrow"></span></a>
                        <div class="megamenu clearfix">
                          <ul class="col-lg-3 col-md-3 col-xs-12 link-list">
                            <li class="title"><a href="http://beautco.com/goods_list.php?cat=REMY%20HAIR">All of Remy Hair Weave</a></li>
                            <li><a href="http://beautco.com/goods_list.php?cat_id=4&sub=Unprocessed%20Remy%20Human%20Hair"><i class="fa fa-arrow-circle-right"></i>Unprocessed Remy Human Hair</a></li>
                            <li><a href="http://beautco.com/goods_list.php?cat_id=4&sub=Brazilian%20Remy"><i class="fa fa-arrow-circle-right"></i>Brazilian Remy</a></li>
                          </ul>
                          
                          <div class="col-lg-3 col-md-3 col-xs-12">
                            <h3 class="title">Images </h3>
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                              <div class="carousel-inner" role="listbox">
                                <div class="item active"> <img src="images/remy.png" style="width:300px; height:260px;"  >
                                  
                                </div>
                                
                             </div>
                              <li><a href="#" style="width: 124px;">SUNDRIES<span class="arrow"></span></a>
                        <div class="megamenu clearfix">
                          <ul class="col-lg-3 col-md-3 col-xs-12 link-list">
                            <li class="title"><a href="http://beautco.com/goods_list.php?cat=SUNDRIES">SUNDRIES</a></li>
                            <li><a href="http://beautco.com/goods_list.php?cat=SUNDRIES"><i class="fa fa-arrow-circle-right"></i>GENERAL</a></li>
                          </ul>
                          
                          <div class="col-lg-3 col-md-3 col-xs-12">
                            <h3 class="title">Images </h3>
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                              <div class="carousel-inner" role="listbox">
                                <div class="item active"> <img src="images/weave.png" style="width:300px; height:260px;">
                                  
                                </div>
                                
                             </div>
                              <li><a href="#" style="width: 124px;">BEAUTY<span class="arrow"></span></a>
                        <div class="megamenu clearfix">
                          <ul class="col-lg-3 col-md-3 col-xs-12 link-list">
                            <li class="title"><a href="http://beautco.com/goods_list.php?cat=BEAUTY">All of BEAUTY</a></li>
                            <li><a href="http://beautco.com/goods_list.php?cat_id=28&sub=SKIN%20CARE"><i class="fa fa-arrow-circle-right"></i>SKIN CARE</a></li>
                            <li><a href="http://beautco.com/goods_list.php?cat_id=28&sub=Mani/Pedi"><i class="fa fa-arrow-circle-right"></i>Mani/Pedi</a></li>
                            <li><a href="http://beautco.com/goods_list.php?cat_id=28&sub=COSMETIC"><i class="fa fa-arrow-circle-right"></i>COSMETIC</a></li>
                          </ul>
                          
                          <div class="col-lg-3 col-md-3 col-xs-12">
                            <h3 class="title">Images </h3>
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                              <div class="carousel-inner" role="listbox">
                                <div class="item active"> <img src="images/braids.png"style="width:300px; height:260px;">
                                 
                                </div>
                                
                             </div>
                              <li><a href="#" style="width: 124px;">HAIR PIECE<span class="arrow"></span></a>
                        <div class="megamenu clearfix">
                          <ul class="col-lg-3 col-md-3 col-xs-12 link-list">
                            <li class="title">PONYTAIL</li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>Human Hair Ponytail</a></li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>Synthetic Hair Ponytail</a></li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>Kid's Ponytail</a></li>
                          </ul>
                          <ul class="col-lg-3 col-md-3 col-xs-12 link-list">
                            <li class="title">PIECES</li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>Closure</a></li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>Bun / Dome</a></li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>Top Piece</a></li>
                          </ul>
                          <ul class="col-lg-3 col-md-3 col-xs-12 link-list">
                            <li class="title">EXTENSIONS</li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>Fusion Hair</a></li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>Clip & Tape-in Extensions</a></li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>Extension Tools</a></li>
                          </ul>
                          
                          <div class="col-lg-3 col-md-3 col-xs-12">
                            <h3 class="title">Images </h3>
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                              <div class="carousel-inner" role="listbox">
                                <div class="item active"> <img src="images/hairpiece.png" style="width:300px; height:260px;" >
                                  
                                </div>
                             </div>
                              <li><a href="#" style="width: 124px;">HAIR CARE <span class="arrow"></span></a>
                        <div class="megamenu clearfix">
                          <ul class="col-lg-3 col-md-3 col-xs-12 link-list">
                            <li class="title"><a href="http://beautco.com/goods_list.php?cat=HAIR%20CARE">All of HAIR CARE</a></li>
                            <li><a href="http://beautco.com/goods_list.php?cat_id=25&sub=Perm/Relaxer"><i class="fa fa-arrow-circle-right"></i>Perm/Relaxer</a></li>
                            <li><a href="http://beautco.com/goods_list.php?cat_id=25&sub=HAIR%20COLOR"><i class="fa fa-arrow-circle-right"></i>HAIR COLOR</a></li>
                            
                          </ul>
                           <ul class="col-lg-3 col-md-3 col-xs-12 link-list">
                            <li class="title"><a href="http://beautco.com/goods_list.php?cat_id=25&sub=STYLING%20PRODUCT">STYLING PRODUCT</a></li>
                           
                            <li><a href="http://beautco.com/goods_list.php?cat_id=25&sub=CONDITIONER"><i class="fa fa-arrow-circle-right"></i>CONDITIONER</a></li>
                            <li><a href="http://beautco.com/goods_list.php?cat_id=25&sub=TREATMENT"><i class="fa fa-arrow-circle-right"></i>TREATMENT</a></li>
                            <li><a href="http://beautco.com/goods_list.php?cat_id=25&sub=SHAMPOO"><i class="fa fa-arrow-circle-right"></i>SHAMPOOE</a></li>
                        
                          </ul>
                          <div class="col-lg-3 col-md-3 col-xs-12">
                            <h3 class="title">Images </h3>
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                              <div class="carousel-inner" role="listbox">
                                <div class="item active"> <img src="images/braids.png" style="width:300px; height:260px;" >
                                 
                                </div>
                                
                             </div>
                              <li><a href="#" style="width: 124px;">APPLIANCE <span class="arrow"></span></a>
                        <div class="megamenu clearfix">
                          <ul class="col-lg-3 col-md-3 col-xs-12 link-list">
                            <li class="title"><a href="http://beautco.com/goods_list.php?cat=APPLIANCE">All of APPLIANCE</a></li>
                            <li><a href="http://beautco.com/goods_list.php?cat_id=26&sub=ELECTRIC"><i class="fa fa-arrow-circle-right"></i>ELECTRIC</a></li>
                           
                          </ul>
                          
                          <div class="col-lg-3 col-md-3 col-xs-12">
                            <h3 class="title">Images </h3>
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                              <div class="carousel-inner" role="listbox">
                                <div class="item active"> <img src="images/braids.png" style="width:300px; height:260px;">
                                  
                                </div>
                                
                             </div>
                              <li><a href="#" style="width: 124px;">ACESSORIES <span class="arrow"></span></a>
                        <div class="megamenu clearfix">
                          <ul class="col-lg-3 col-md-3 col-xs-12 link-list">
                        
                            <li class="title">HUMAN HAIR</li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>REMY HAIR WIG</a></li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>HUMAN HAIR WIG</a></li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>SYNTHETIC HAIR WIG</a></li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>CLIP IN WIG</a></li>
                            
                          </ul>
                          <ul class="col-lg-3 col-md-3 col-xs-12 link-list">
                        
                            <li class="title">SYNTHETIC HAIR</li>
                           
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>SYNTHETIC HAIR WIG</a></li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>CLIP IN WIG</a></li>
                            
                          </ul>
                          
                          <div class="col-lg-3 col-md-3 col-xs-12">
                            <h3 class="title">Images </h3>
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                              <div class="carousel-inner" role="listbox">
                                <div class="item active"> <img src="images/wig.png" style="width:300px; height:260px;" >
                                 
                                </div>
                                <div class="item"><img src="images/wig2.png" style="width:300px; height:260px;">
                                  
                                </div>
                             </div>
                            <li><a href="#" style="width: 124px;">SALE&DEALS <span class="arrow"></span></a>
                        <div class="megamenu clearfix">
                          <ul class="col-lg-3 col-md-3 col-xs-12 link-list">
                            <li class="title">CLEARANCE</li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>Human Wig Sale</a></li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>Synthetic Wig Sale</a></li>
                          </ul>
                          <ul class="col-lg-3 col-md-3 col-xs-12 link-list">
                            <li class="title">WEAVES</li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>Buy one get one free</a></li>
                           
                          </ul>
                          <ul class="col-lg-3 col-md-3 col-xs-12 link-list">
                            <li class="title">LACE WIG</li>
                            <li><a href="#"><i class="fa fa-arrow-circle-right"></i>Lace Wig Sale</a></li>
                           
                          </ul>
                          
                          <div class="col-lg-3 col-md-3 col-xs-12">
                            <h3 class="title">Images </h3>
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                              <div class="carousel-inner" role="listbox">
                                <div class="item active"> <img src="images/braids.png" style="width:300px; height:260px;">
                                 
                                </div>
                                <div class="item"><img src="images/braids.png" style="width:300px; height:260px;">
                                  
                                </div>
                             </div>
                             
                             
                           
                    </ul>
                  </nav>
  <!--Menu HTML Code--> 
  
  
  
</div>
    
        
</div>


  
</div>

<!-- menu end -->
</div>

</div>


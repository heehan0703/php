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
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>index</title>
   </head>


 
    
 
<div class="container-fluid"  style="padding-left:0px; padding-right:0px;" >
<div class="row">
 <span id="k" style="margin-left: 19px; padding-left: 155px; margin-top: -31px;"> <strong style="margin-left: 25px;"> Dealer</strong></span> 
 </div>
 
<div class="row" id="pro">
<div align="center">
<div id="dhi">

<!--start first-->
<div class=" col-lg-3 col-sm-6 col-xs-6 down first sml-menu"  style="margin-top: 18px;">
<a href="https://www.facebook.com/fafashioninc/" target="_new"><i class="fa fa-facebook fa-2x" ></i></a>       
<a href="https://plus.google.com/u/0/+FaHair/ target="_new""><i class="fa fa-google-plus"></i></a>          
<a href="https://www.instagram.com/fa_hair_/ target="_new""><i class="fa fa-instagram"></i></a>       
<a href="https://twitter.com/fahairinc/ target="_new""><i class="fa fa-twitter"></i></a>  
<a href="https://groups.yahoo.com/neo/groups/fahair/" target="_new"><i class="fa fa-yahoo"></i></a>           
<a href="https://www.youtube.com/channel/UC6UcxJO3BVD5CKOrpHiHhAg" target="_new"><i class="fa fa-youtube"></i> </a>      
<a href="https://www.linkedin.com/in/fa-hair-80122b120" target="_new"><i class="fa fa-linkedin"></i> </a>       
 </div> 
 
 <div class=" col-lg-2 col-sm-12 col-xs-2 down second " align="center" >
</div>
<div class=" col-lg-3 col-sm-12 down third car" align="right" style=" ">
 <span style="padding-right: 10px;" >    <a href="wishlist.php" style="color:#000000;">WISH LIST</a></span>
   <span style="padding-right: 10px;">    <a href="cart.php" style="color:#000000;">MY CART</a></span>
     <span style="padding-right: 10px;">  <a href="dealer.php" style="color:#000000;">DEALER</a></span>

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
    <a href="store_front.php?id=<?php  echo ($idss[0]); ?>" style="background-color:#F7EBED;" id="a2"><font size="+1" color="#4C0608"><b><?php  echo ($city[0]); ?>&nbsp;&nbsp;<?php  echo ($name[0]); ?>..</b></font>
    <br/><b>Location:</b><font><?php  echo ($location[0]); ?><?php  echo ($city[0]); ?><?php  echo ($state[0]); ?></font><br/><b>Phone:</b> <?php  echo ($phone[0]); ?> <br/>
    <font color="#D20005">OPEN TODEY</font><font> <?= $store1['open_time'];?>- <?= $store1['close_time'];?></font></a> 
    <a href="" style="background-color:#DDF4D8;"><img src="images/locator.png" width="24" height="32" alt="locator" align="middle">&nbsp;&nbsp;<font><b>Stores Near you</b></font></a>
    <a href="store_front.php?id=<?php  echo ($idss[1]); ?>" style=""><font><b><?php  echo ($city[1]); ?><?php  echo ($name[1]); ?></b></font>
    <br><b>Location:</b><font><?php  echo ($location[1]); ?><?php  echo ($city[1]); ?><?php  echo ($state[1]); ?></font></br><b>Phone:</b> <?php  echo ($phone[1]); ?> <br/>
    <font color="#137100">OPEN TODAY</font><font><?= $store2['open_time'];?>- <?= $store2['close_time'];?></font>
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
        <a href="logout.php" style="color:inherit"> <img src="images/logout.png" class="dump"></a>
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
<?php include'me.php'?>
<!-- menu end -->
</div>

</div>

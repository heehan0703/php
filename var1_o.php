<?
require_once('get_distance.php');
$day = date("l");
$store1=mysql_fetch_assoc(mysql_query("SELECT * FROM store_times where day='$day' AND store_id='$idss[0]'"));
$store2=mysql_fetch_assoc(mysql_query("SELECT * FROM store_times where day='$day' AND store_id='$idss[1]'"));
$store3=mysql_fetch_assoc(mysql_query("SELECT * FROM store_times where day='$day' AND store_id='$idss[2]'"));
if($_SESSION['GOOD_SHOP_USERID']){
$GOOD_SHOP_USERID=$_SESSION['GOOD_SHOP_USERID'];
//echo "select * from cart where userid='$GOOD_SHOP_USERID'";
 $cart_goods_query = mysql_query("select * from cart where userid='$GOOD_SHOP_USERID'");
  $num=mysql_num_rows($cart_goods_query);
 }

?>

 <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		
		<!-- HEADER-AREA START -->
        <style  type="text/css">
		.dropdown{position:relative;display:inline-block;}
		.hrclass{background-color:#C4DCC2;height:5px;margin:0px;border:none}
          .mystore{
		  display:none;
		   position: absolute;
		   width:400px;
		   left: 169px;
		   background-color:#FFFFFF;
		   border-top:2px solid red;
		  }
		  .input-lg{
		  margin-left:2px;
		  margin-right:2px;
		  }
		  #custom-search-input{padding:3px;border:solid 1px #E4E4E4;border-radius:6px;background-color:#fff;}
		  #custom-search-input input{border:0;box-shadow:none;}
           #custom-search-input button{margin:2px 0 0 0;background:none;box-shadow:none;border:0;color:#666666;padding:0 8px 0 10px;}
           #custom-search-input button:hover{border:0;box-shadow:none;border-left:solid 1px #ccc;}
		  #custom-search-input .glyphicon-search{font-size:23px;}
          .header-mystore:hover .mystore{
		  display:block;
		  opacity: 1;
          transform: scaleY(1);
          z-index: 999999999;
		  }
		  .dropdown-content{position:absolute;right:0px;background-color:#f9f9f9;min-width:400px;overflow:auto;box-shadow:0px 8px 16px 0px rgba(0,0,0,0.2); line-height:15px;}
.dropdown-content a{font-family:Arial, Helvetica, sans-serif;text-align:left;color:black;padding:12px 16px;text-decoration:none;display:block;font-size:12px;}
.dropdown a:hover{background-color:#f1f1f1;}
		  #mobstore{
		  display:none;
		  }
		  #dealermob{
		  display:none;
		  }
		  .mobsearch{
		  display:none;
		  text-align:center;
		  }
		  @media (min-width:266px) and (max-width:600px){
		  .header-search {
		  text-align:center;
             margin: 0 auto;
			 float:none;
			 width:270px;
			 padding:0px 0px;
			 border-top:1px solid #666;
            }
		.header-search input {
           color: #fff;
           font-size: 12px;
           width: 200px;
           }
		  .mobsearch{
		  display:block;
		  }
		  #dealermob{
		  display:block;
		 
		  }
		  #mobstore{
		  display:block;
		  
		  }
		  .dropdown-content{position:absolute;right:0px;background-color:#f9f9f9;min-width:305px;overflow:auto;box-shadow:0px 8px 16px 0px rgba(0,0,0,0.2);left:0px; line-height:15px;}
		  .dropdown-content a{font-size:12px;width:305px;}
		  .header-mystore{
		  border-right:none;
		  padding: 5px 10px;
		  }
		  
		  #mobstore:hover .mystore{
		  display:block;
		  opacity: 1;
          transform: scaleY(1);
          z-index: 999999999;
		  }
		  .mystore{
		  display:none;
		   position: absolute;
		   width:275px;
		   left: -200px;
		   background-color:#FFFFFF;
		   border-top:2px solid red;
		  }
		  
		  #custom-search-input{padding:3px;border:solid 1px #E4E4E4;border-radius:6px;background-color:#fff;}
		  #custom-search-input input{border:0;box-shadow:none;}
           #custom-search-input button{margin:2px 0 0 0;background:none;box-shadow:none;border:0;color:#666666;padding:0 8px 0 10px;}
           #custom-search-input button:hover{border:0;box-shadow:none;border-left:solid 1px #ccc;}
		  #custom-search-input .glyphicon-search{font-size:23px;}
		  
		  /* --- Total Cart --- */
.total-cart {
 border: 1px solid #666;
  float:left;
  margin: 0px auto 0px;
  width: 90px;
}
.total-cart ul {}
.total-cart ul li {position:relative;}
.total-cart > ul > li > a {
  display: block;
  line-height: 24px;
  padding: 0 0 10px;
  text-align: center;
}
.total-cart ul li a span {
  color: #fff;
  display: block;
}
.total-cart-number {
  border-bottom: 1px solid #fff;
  padding-bottom: 4px;
}
.total-cart > ul > li > a i {
  color: #f6416c;
  display: block;
  font-size: 25px;
  margin-top: 8px;
  overflow: inherit;
}



/*---------------------------------------- */
		  
		  
 }
 </style>
  <script language="javascript">
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
<script language="javascript">
function searchstoremob(){
var x = document.forms["searchformmob"]["address"].value;
if (x == null || x == "") {
        alert("Address must be filled out");
        return false;
    }else{
    document.forms["searchformmob"].submit();
	}
}

</script>
      
        
        <header class="header-area">
			<!-- Header-Top Start -->
			<div class="header-top hidden-xs">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="header-top-left text-left">
								<ul>
									<li>
										<i class="sp-phone"></i>
										<span>847-621-2289</span>
									</li>
									<li>
										<i class="sp-email"></i>
										<span>info@fahair.com</span>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							
                            <div class="header-top-right pull-right">
								<ul>
									<li><a href="#">Account <span><i class="sp-gear"></i></span></a>
										<ul class="submenu">
                                            <li><a href="https://fahair.com/harish_contain.php">Dealer</a></li>
                                            <? if($_SESSION['member_id']!=''){?>
											<li><a href="edit_register.php">My Account mystore</a></li>
                                            <? }else{ ?>
                                            <li><span onclick="window.location.href='register.html'" style=" cursor:pointer;">My Account</span></li>
                                            <? } ?>
											<li><a href="./wishlist.php">Wishlist</a></li>
											<li><a href="https://fahair.com/checkout.php">Checkout</a></li>
											<li><? if($_SESSION['member_id']!=''){?><a href="logout.php" >Log out</a> <? } else {?> <a  onClick="show()" style=" cursor:pointer;">Log in <? } ?></a></li>
										</ul>
									</li>
								</ul>
								<div class="header-search">
									<form action="#">
										<input type="text" placeholder="Search..." />
										<button type="submit"><i class="sp-search"></i></button>
									</form>
								</div>
                                <div class="header-mystore"><font color="#FFFFFF">MY STORE</font>
                                    <div  class="mystore">
                                   <div id="myDropdown" class="dropdown-content">
    <?
	 if(!$_SESSION['latitude'] and !$_SESSION['longitude']){
	 ?>
    <a>
    <b>Find More stores</b>
    <form class="" method="post" action="/search_store.php" name="searchform" onsubmit="return searchstore()">
    <div>
   <div id="custom-search-input" style=" margin-right:2px;">
                <div class="input-group col-md-12">
                    <input type="text" class="form-control input-lg" placeholder="Search more stores here"  name="address" />
                    <span class="input-group-btn" style="background-color:darkgreen;" onclick="searchstore();">
                        <button class="btn btn-info btn-lg" type="button" style="color:white">
                            <i class="sp-search"></i>
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
                            <i class="sp-search"></i>
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
                                
                                </div>
                                
                                
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Header-Top End -->
            
            <!-- Main-Header Start -->
			<div class="main-header">
				<div class="container">
					<div class="row">
						<div class="col-md-2 col-sm-6 col-xs-12">
							<div class="logo">
								<a href="index.html"><img src="images/footer-logo-compressor.png" alt="" /></a>
							</div>
						</div>
						<div class="col-md-9 hidden-sm hidden-xs">
							<div class="main-menu pull-right">
								<nav>
									<ul>
										<li><a href="https://fahair.com/weaves/" title="human hair weaves">HH Weaves</a>
											<div class="subwigs">
                                                <span>
												<a class="subwigs-title" href="#">ALL OF HUMAN HAIR WEAVES</a>
												<a href="https://fahair.com/weaves/unprocessed-human-hair-weaves/" title="unprocessed chinese human hair">UNPROCESSED CHINESE HUMAN HAIR</a>
												<a href="https://fahair.com/weaves/human-hair-weaves/" title="human-hair-weaves">HUMAN HAIR WEAVES</a>
                                               <a href="https://fahair.com/weaves/remy-shunfa-hair-weaves/" title="remy human hair weaves">REMY HUMAN HAIR WEAVES</a>
                                                <a href="https://fahair.com/andrea-silky-virgin-human-hair-weaving-16-24-33.html" title="andrea silky virgin human hair weaving">SILKY REMY HUMAN HAIR</a>
                                               
											 </span>
                                          </div>
										</li>
										<li><a href="https://fahair.com/wigs/" title="wigs">WIGS</a>
                                          <div class="subweaves">
                                                <span>
												<a class="subwigs-title" >HUMAN HAIR WIGS</a>
												<a href="https://fahair.com/wigs/human-hair-lace-wigs/" title="human hair lace front">HUMAN HAIR LACE FRONT</a>
												<a href="https://fahair.com/wigs/human-hair-wigs/" title="human hair wigs">HUMAN HAIR WIGS</a>
                                              
                                               
											 </span>
                                              <span>
												<a class="subwigs-title" >HEAT-FRIENDLY WIGS</a>
												<a href="https://fahair.com/wigs/heat-friendly-lace-wigs/" title="lace front wigs">LACE FRONT WIGS</a>
												<a href="https://fahair.com/wigs/heat-friendly-wigs/" title="wigs">WIGS</a>
                                               
                                               
											 </span>
                                          </div>
                                        </li>
										<li><a href="https://fahair.com/clip-in-roll/" title="clip in">CLIP-IN</a></li>
										<li><a href="https://fahair.com/top-pieces/" title="top pieces">HH TOP PIECES</a>
                                             <div class="subweaves">
                                                <span>
												<a class="subwigs-title" >HUMAN HAIR TOP PIECES</a>
												<a href="https://fahair.com/top-pieces/human-hair-top-pieces/" title="human hair top pieces">HUMAN HAIR TOP PIECES</a>
												<a href="https://fahair.com/top-pieces/human-hair-closures/" title="human hair closures"> HUMAN HAIR CLOSURES</a>
                                              
                                               
											 </span>
                                              
                                          </div>
                                        
											
										</li>
										<li><a href="https://fahair.com/hair-pieces/" title="hair pieces">HAIR PIECES</a>
											<div class="subweaves">
                                                <span>
												<a class="subwigs-title" >SYNTHETIC HAIR TOP PIECES</a>
												<a href="https://fahair.com/hair-pieces/clip-in-top-pieces/"  title="clip in top pieces">CLIP-IN TOP PIECES</a>
												<a href="https://fahair.com/hair-pieces/clip-in-crown-toppers/" title="clip in crown toppers">CLIP-IN CROWN TOPPERS</a>
                                              
                                               
											 </span>
										</li>
										<li><a href="#">BRANDS</a>
                                          <div class="mega-menu">
												<span>
													<a class="mega-menu-title" href="#">SHEREE BRAZILIAN HUMAN HAIR</a>
													<a href="https://fahair.com/shree.html" title="shree Brazilian human hair"><img src="img/SHEREE-01-compressor.jpg" alt="shree Brazilian human hair"/></a>
												
												</span>
												<span>
													<a class="mega-menu-title" href="#">FA CHINESE UNPROCESSED HAIR</a>
													<a href="https://fahair.com/chinese-virgin-shun-fa.html" title="Fa chinese unprocessed hair"><img src="img/FA-01-compressor.jpg" alt="Fa chinese unprocessed hair"/></a>
													
												</span>
												<span>
													<a class="mega-menu-title" href="#">BRANDI LUXARY REMY HUMAN HAIR</a>
													<a href="https://fahair.com/brandi.html" title="brandi luxary remy human hair"><img src="img/BRANDI-01-compressor.jpg" alt="brandi luxary remy human hair"/></a>
											
												</span>
                                                
                                                <span>
													<a class="mega-menu-title" href="#">ANDREA CLIP & ROLL HAIR EXTENSIONS</a>
													<a href="https://fahair.com/clip-in-roll" title="andrea clip and roll hair extensions"><img src="img/CLIP-01-compressor.jpg" alt="andrea clip and roll hair extensions"/></a>
											
												</span>
                                                
                                                <span>
													<a class="mega-menu-title" href="#">ANDREA SILKY HAIR EXTENSIONS</a>
													<a href="https://fahair.com/silky.html" title="andrea silky hair extensions"><img src="img/SILKY-01-compressor.jpg" alt="andrea silky hair extensions"/> </a>
											
												</span>
                                                
                                                 <span>
													<a class="mega-menu-title" href="#">GREEN APPLE TOP PIECES</a>
													<a href="https://fahair.com/top-pieces/" title="green apple top pieces"><img src="img/TOP-01-compressor.jpg" alt="green apple top pieces"/> </a>
											
												</span>
                                                
                                                
												
											</div>
                                        </li>
										<li><a href="https://fahair.com/about_us.html" title="about the fahair.com">ABOUT US</a>
											<ul class="submenu">
												<li class="submenu-title"><a href="#">All pages</a></li>
												<li><a href="https://fahair.com/about_us.html" title="About Fa fashion">About Fa fashion</a></li>
												<li><a href="https://fahair.com/terms_of_use.html" title="Terms of Use">Terms of Use</a></li>
												<li><a href="https://fahair.com/how_to_order.html">How to place an order?</a></li>
												<li><a href="https://fahair.com/shipping_policy.html">Shipping Policy</a></li>
												<li><a href="https://fahair.com/returns.html">Return & Exchanges</a></li>
												<li><a href="https://fahair.com/faq.html">FAQt</a></li>
												<li><a href="https://fahair.com/factory.html">Factory Pictures</a></li>
												
											</ul>
										</li>
										<li><a href="https://fahair.com/dealer.html" title="dealer ship">DEALER SHIP</a></li>
									</ul>
								</nav>
							</div>
						</div>
                        <div class="col-md-1 col-sm-6 col-xs-12 mobsearch">
                          <div class="header-search">
									<form action="#" >
										<input type="text" placeholder="Search..." />
										<button type="submit"><i class="sp-search"></i></button>
									</form>
								</div>
                        
                        </div>
						<div class="col-md-1 col-sm-6 col-xs-12" >
                           <div  class="col-md-0 col-sm-0 col-xs-4"   style="padding-left:0px;"> 
                               <div class="total-cart" id="dealermob"> 
                                  <ul>
									<li ><a href="https://fahair.com/harish_contain.php" title="dealer ship"><font color="#FFFFFF" >Dealer </font> </a> </li>
                                  </ul> 
                                </div> 
                            </div>
							<div class="col-md-1 col-sm-6 col-xs-4" style="padding-left:0px;">
                            
                            <div class="total-cart">
								<ul>
									<li>
										<a href="#">
											<span class="total-cart-number"><?=$num;?> Item</span>
											<span><i class="sp-shopping-bag"></i></span>
										</a>
										<!-- Mini-cart-content Start -->
										<div class="total-cart-brief">
                                      <?   while($cart_goods_row=mysql_fetch_assoc($cart_goods_query)){
	
	$cart_cnt++;
	
	//echo "SELECT * FROM `product` where id='$cart_goods_row[goodsId]'";
	$goods_info= mysql_fetch_assoc(mysql_query("SELECT * FROM `product` where id='$cart_goods_row[goodsId]'"));
	      
		   if($_SESSION['level']==2){
	  ///for dealer price////////////
	   
	   $userprice=explode(',',$goods_info['wholesaleprice2']);
	   $price1=$userprice[$cart_goods_row['option_index']];
	   
	   if(count($userprice)<=1){
	   $userprice=$goods_info['wholesale_price'];
	   $price1=$userprice;
	    }
	 
	 
		$price=$price1;
		
		  $sub_total +=$price*$cart_goods_row['cnt'];
		
  }else{
	    
		$userprice=explode(',',$goods_info['price']);
		$price=$userprice[$cart_goods_row['option_index']];
		//echo count($userprice);
		if(count($userprice)<=1){
	   $userprice=$goods_info['msrp_price'];
	    $price=$userprice;
		
		
		}
		
		$price1=$price;
				
		  $sub_total +=$price*$cart_goods_row['cnt'];
		 
	    }
		   ?>
											<div class="cart-photo-details">
												<div class="cart-photo">
													<a href="#"><img src="img/total-cart/1.jpg" alt="" /></a>
												</div>
												<div class="cart-photo-brief">
													<a href="#"><?=$goods_info['product_name']?></a>
													<span>$<?=$cart_goods_row['cnt']*$price1?></span>
												</div>
												<div class="pro-delete">
													<a href="#"><i class="sp-circle-close"></i></a>
												</div>
											</div>
                                            <? } ?>
											
											<div class="cart-subtotal">
												<p>Total = $<?=number_format($sub_total,2)?></p>
											</div>
											<div class="cart-inner-btm">
												<a href="#">Checkout</a>
											</div>
										</div>
										<!-- Mini-cart-content End -->
									</li>
								</ul>
							</div>
                            </div>
                          <div class="col-md-0 col-sm-0 col-xs-4" style="padding-left:0px;"> 
                            <div class="total-cart" style="text-align:center;" id="mobstore">
                             
                             <span class="header-mystore"><font color="#FFFFFF"> MY STORE </font> </span>
                               <div  class="mystore">
                                   <div id="myDropdown" class="dropdown-content">
    <?
	 if(!$_SESSION['latitude'] and !$_SESSION['longitude']){
	 ?>
    <a>
    <b>Find More stores</b>
    <form class="" method="post" action="/search_store.php" name="searchformmob" onsubmit="return searchstoremob()">
    <div>
   <div id="custom-search-input" style="margin-right:2px;">
                <div class="input-group col-md-12">
                    <input type="text" class="form-control input-lg" placeholder="Search more stores here"  name="address" />
                    <span class="input-group-btn" style="background-color:darkgreen;" onclick="searchstoremob();">
                        <button class="btn btn-info btn-lg" type="button" style="color:white">
                            <i class="sp-search"></i>
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
    <form class="" method="post" action="/search_store.html" name="searchformmob" onsubmit="return searchstoremob()">
    <div>
   <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="text" class="form-control input-lg" placeholder="Search more stores here"  name="address" />
                    <span class="input-group-btn" style="background-color:darkgreen;" onclick="searchstoremob();">
                        <button class="btn btn-info btn-lg" type="button" style="color:white">
                            <i class="sp-search"></i>
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
                                    </div>
        
                             </div>
						</div>
					</div>
				</div>
			</div>
			<!-- Main-Header End -->
			<!-- Mobile-menu start -->
			<div class="mobile-menu-area hidden-md hidden-lg">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<div class="mobile-menu">
								<nav id="dropdown">
									<ul>
										<li><a href="index.html">HH WEAVES</a>
											<ul class="submenu">
                                           <li class="submenu-title"> <a class="subwigs-title" href="https://fahair.com/weaves/">ALL OF HUMAN HAIR WEAVES</a></li>
											<li><a href="https://fahair.com/weaves/unprocessed-human-hair-weaves/" title="unprocessed chinese human hair">UNPROCESSED CHINESE HUMAN HAIR</a></li>
												<li><a href="https://fahair.com/weaves/human-hair-weaves/" title="human-hair-weaves">HUMAN HAIR WEAVES</a></li>
                                              <li> <a href="https://fahair.com/weaves/remy-shunfa-hair-weaves/" title="remy human hair weaves">REMY HUMAN HAIR WEAVES</a></li>
                                               <li> <a href="https://fahair.com/andrea-silky-virgin-human-hair-weaving-16-24-33.html" title="andrea silky virgin human hair weaving">SILKY REMY HUMAN HAIR</a></li>
												
											</ul>
										</li>
										<li><a href="shop.html">WIGS</a>
                                         <ul class="submenu">
                                           <li class="submenu-title"> <a class="subwigs-title" >HUMAN HAIR WIGS</a> </li>
											<li><a href="https://fahair.com/wigs/human-hair-lace-wigs/" title="human hair lace front">HUMAN HAIR LACE FRONT</a></li>
											<li><a href="https://fahair.com/wigs/human-hair-wigs/" title="human hair wigs">HUMAN HAIR WIGS</a></li>
                                            
                                              <li> <a class="subwigs-title" >HEAT-FRIENDLY WIGS</a></li>
                                             
                                               <li> <a href="https://fahair.com/wigs/heat-friendly-lace-wigs/" title="lace front wigs">LACE FRONT WIGS</a></li>
                                                <li><a href="https://fahair.com/wigs/heat-friendly-wigs/" title="wigs">WIGS</a> </li>
                                               
												
											</ul>
                                        
                                        </li>
										<li><a href="https://fahair.com/clip-in-roll/" title="clip in">CLIP-IN</a></li>
										<li><a href="shop.html">HH TOP PIECES</a>
                                      <ul class="submenu">
                                            <li class="submenu-title"> <a class="subwigs-title" >HUMAN HAIR TOP PIECES</a> </li>
											<li><a href="https://fahair.com/top-pieces/human-hair-top-pieces/" title="human hair top pieces">HUMAN HAIR TOP PIECES</a></li>
											<li><a href="https://fahair.com/top-pieces/human-hair-closures/" title="human hair closures"> HUMAN HAIR CLOSURES</a></li>
									   </ul>
                                           </li>
										<li><a href="blog.html">HAIR PIECES</a>
											<ul class="submenu">
												<li class="submenu-title"><a class="subwigs-title" >SYNTHETIC HAIR TOP PIECES</a></li>
												<li><a href="https://fahair.com/hair-pieces/clip-in-top-pieces/"  title="clip in top pieces">CLIP-IN TOP PIECES</a></li>
												<li><a href="https://fahair.com/hair-pieces/clip-in-crown-toppers/" title="clip in crown toppers">CLIP-IN CROWN TOPPERS</a></li>
											</ul>
										</li>
										<li><a href="#">BRAND</a>
											<ul class="submenu">
												<li class="submenu-title">
                                                  <span>
													<a class="mega-menu-title" href="#">SHEREE BRAZILIAN HUMAN HAIR</a>
													<a href="https://fahair.com/shree.html" title="shree Brazilian human hair"><img src="img/SHEREE-01-compressor.jpg" alt="shree Brazilian human hair"/></a>
												
												   </span>
                                                </li>
												<li>
                                                   <span>
													<a class="mega-menu-title" href="#">FA CHINESE UNPROCESSED HAIR</a>
													<a href="https://fahair.com/chinese-virgin-shun-fa.html" title="Fa chinese unprocessed hair"><img src="img/FA-01-compressor.jpg" alt="Fa chinese unprocessed hair"/></a>
													
												</span>
												
                                                
                                                
                                                  
                                                </li>
												<li><span>
													<a class="mega-menu-title" href="#">BRANDI LUXARY REMY HUMAN HAIR</a>
													<a href="https://fahair.com/brandi.html" title="brandi luxary remy human hair"><img src="img/BRANDI-01-compressor.jpg" alt="brandi luxary remy human hair"/></a>
											
												</span></li>
												<li><span>
													<a class="mega-menu-title" href="#">ANDREA CLIP & ROLL HAIR EXTENSIONS</a>
													<a href="https://fahair.com/clip-in-roll" title="andrea clip and roll hair extensions"><img src="img/CLIP-01-compressor.jpg" alt="andrea clip and roll hair extensions"/></a>
											
												</span>
                                                
                                                
                                                </li>
												<li>
                                                <span>
													<a class="mega-menu-title" href="#">ANDREA SILKY HAIR EXTENSIONS</a>
													<a href="https://fahair.com/silky.html" title="andrea silky hair extensions"><img src="img/SILKY-01-compressor.jpg" alt="andrea silky hair extensions"/> </a>
											
												</span>
                                                
                                                
                                                </li>
												<li>
                                                 <span>
													<a class="mega-menu-title" href="#">GREEN APPLE TOP PIECES</a>
													<a href="https://fahair.com/top-pieces/" title="green apple top pieces"><img src="img/TOP-01-compressor.jpg" alt="green apple top pieces"/> </a>
											
												</span>
                                                </li>
												
											</ul>
										</li>
										<li><a href="https://fahair.com/about_us.html" title="about the fahair.com">ABOUT US</a>
                                        <ul class="submenu">
                                            <li><a href="https://fahair.com/about_us.html" title="About Fa fashion">About Fa fashion</a></li>
												<li><a href="https://fahair.com/terms_of_use.html" title="Terms of Use">Terms of Use</a></li>
												<li><a href="https://fahair.com/how_to_order.html">How to place an order?</a></li>
												<li><a href="https://fahair.com/shipping_policy.html">Shipping Policy</a></li>
												<li><a href="https://fahair.com/returns.html">Return & Exchanges</a></li>
												<li><a href="https://fahair.com/faq.html">FAQt</a></li>
												<li><a href="https://fahair.com/factory.html">Factory Pictures</a></li>
									   </ul>
                                        </li>
                                        <li><a href="https://fahair.com/dealer.html" title="dealer ship">DEALER SHIP</a></li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Mobile-menu end -->			
		</header>
		<!-- HEADER-AREA END -->
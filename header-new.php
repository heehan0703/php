<head>
    <meta charset="utf-8">
    <meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Enterprise of Black Hair Alliance(EBHA)</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="Robots" content="All">
<meta name="Description" content="Wigs,Hair Weaves,Remy Hair,Lace Front Wig,Human hair wigs,Lace wigs,top pieces,Hair top pieces - ebhahair.com">
<meta name="Keywords" content="Wigs,Hair Weaves,Remy Hair,Lace Front Wig,Human hair wigs,Lace wigs,top pieces,Hair top pieces - ebhahair.com">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-97999393-1', 'auto');
  ga('send', 'pageview');

</script>
  </head>
<?
require_once('get_distance.php');
$day = date("l");
$store1=mysql_fetch_assoc(mysql_query("SELECT * FROM store_times where day='$day' AND store_id='$idss[0]'"));
$store2=mysql_fetch_assoc(mysql_query("SELECT * FROM store_times where day='$day' AND store_id='$idss[1]'"));
$store3=mysql_fetch_assoc(mysql_query("SELECT * FROM store_times where day='$day' AND store_id='$idss[2]'"));
if($_SESSION['GOOD_SHOP_USERID']){
$GOOD_SHOP_USERID=$_SESSION['GOOD_SHOP_USERID'];
//echo "select * from cart where userid='$GOOD_SHOP_USERID'";
 $cart_goods_queryh = mysql_query("select * from cart where userid='$GOOD_SHOP_USERID'");
  $num=mysql_num_rows($cart_goods_queryh);
 }

if($act =="hedel"){//deleting in cart
	  $cartId=$_REQUEST['cartId'];

		mysql_query("delete from cart  where id=$cartId");
		header("location:cart.php");
	}
	
?>

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
           #custom-search-input button{
	margin:2px 0 0 0;
	background:none;
	box-shadow:none;
	border:0;
	color:#FFFFFF;
	padding:0 8px 0 10px;
}
           #custom-search-input button:hover{border:0;box-shadow:none;border-left:solid 1px #ccc;}
		  #custom-search-input .glyphicon-search{font-size:23px;}
          .header-mystore:hover .mystore{
		  display:block;
		  opacity: 1;
          transform: scaleY(1);
          z-index: 999999999;
		  }
		  .dropdown-content{position:absolute;right:0px;background-color:#f9f9f9;min-width:400px;overflow:auto;box-shadow:0px 8px 16px 0px rgba(0,0,0,0.2); line-height:15px;}
.dropdown-content a{
	font-family:Arial, Helvetica, sans-serif;
	text-align:left;
	color:#D6D6D6;
	padding:12px 16px;
	text-decoration:none;
	display:block;
	font-size:12px;
}
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
		  
@media (min-width:600px) and (max-width:899px){
.main-menu > nav > ul > li:hover > a{

font-size:12px;
}
.main-menu > nav > ul a{
font-size:12px;
}
.main-menu > nav > ul > li{
padding: 0 8px;
}
.header-top-left li{
padding: 18px 0px !important;
}	
.header-top-left li span {
    font-size: 10px !important ;
}
.ipad{
padding-left: 0px;
padding-right: 0px;
}
.header-mystore{
font-size:10px;
}
}	  
		
@media (min-width:900px) and (max-width:1000px){
.header-top-left li span {
    font-size: 10px !important;
}

.header-top-left li {
    border-right: 1px solid #666;
    color: #bdbdbd;
    display: inline-block;
    line-height: 1;
    padding: 18px 0px !important;;
}
.ipad{
padding-left: 0px;
padding-right: 0px;
}
.header-mystore{
font-size:10px;
}
}	
@media (min-width:1000px) and (max-width:1200px){	
.ipad{
padding-left: 5px;
padding-right: 5px;
}
.header-top-left li {
    border-right: 1px solid #666;
    color: #bdbdbd;
    display: inline-block;
    line-height: 1;
    padding: 18px 5px !important;;
}
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
           #custom-search-input button{
	margin:2px 0 0 0;
	background:none;
	box-shadow:none;
	border:0;
	color:#F0F0F0;
	padding:0 8px 0 10px;
}
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
.header-search input {
    color: #000000;
    font-size: 12px;
    width: 150px;
}


/*---------------------------------------- */
		  
		  
 }

.overlay-mask{background:none repeat scroll 0 0 rgba(28, 45, 50, 0.8);bottom:0;height:100%;left:0;position:fixed;right:0;top:0;width:100%;z-index:999999;display:none;overflow-y:auto;overflow-x:hidden;}
.overlay.iframe-content{border:2em solid #fff;border-radius:6px;box-sizing:content-box;padding:0;width:50%;}
.overlay{background:none repeat scroll 0 0 #fff;border-radius:3px;box-shadow:0 1px 3px rgba(23, 74, 104, 0.35), 0 0 32px rgba(60, 82, 93, 0.35);box-sizing:border-box;margin:50px auto 0;padding:30px;position:relative;}
.overlay.iframe-content .title{border:medium none;margin:0;position:absolute;}
.overlay .title{border-bottom:1px solid #e2e8ea;margin-bottom:20px;}
.overlay .close-icon{font:32px Dingbatz;color:#b3c5d0;content:"?";display:block;font:bold 20px "Dingbatz";position:absolute;right:0;}
.overlay.iframe-content .close-icon{background:none repeat scroll 0 0 #000;border-radius:32px;color:white;height:32px;opacity:1;position:absolute;right:-2em;top:-2em;width:32px;}
.overlay .close-icon{cursor:pointer;float:right;}
      
@media (min-width:266px) and (max-width:600px){
.overlay.iframe-content{border:2em solid #fff;border-radius:6px;box-sizing:content-box;padding:0;width:80%;}
}
	  
</style>
  <script language="javascript">
  function cartDel2(Obj)
{
	//alert("dhirendra");
	Obj.action = "cart.php?act=hedel";
	Obj.submit();
}

 function submitform(Obj){
 Obj.submit();
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
function cartDel(Obj)
{
	Obj.action = "deleteitem.php?act=del";
	Obj.submit();
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
function show(){$("#overlay-mask-1").fadeIn('slow');}
</script>

        
        <header class="header-area">
       
			<!-- Header-Top Start -->
			<div class="header-top hidden-xs">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6 ipad" >
							<div class="header-top-left text-left">
								<ul>
									<li>
										<i class="sp-star"></i> <a href="./register.html" title="SIGNUP LOYALTY PROGRAM"><span style="color:#003300;">SIGNUP_LOYALTY_PROGRAM</span></a></li>
									<li>
										<i class="sp-star"></i><a href="./agent_register.php" title="BECOME An Agent">
										<span style="color:#003300;">BECOME AN <b>AGENT</b></span></a>
									</li>
<li>
										<a href="https://ebhahair.com/agents/signin_old1.php" title="Signin">
										<span style="color:red; font-size: 12pt"><b>AGENT</b></span></a>
									</li>

								</ul>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 ipad ">
							
                            <div class="header-top-right pull-right">
								<ul>
									<li><a href="#" style="color:#003300;">Account <span><i class="sp-gear"></i></span></a>
										<ul class="submenu">
                                            
                                            <? if($_SESSION['member_id']!=''){?>
											<li><a href="./edit_register.html" style="color:#003300;">My Account</a></li>
                                            <? }else{ ?>
                                            <li><span onclick="window.location.href='./register.html'" style=" cursor:pointer;" title="my account">My Account</span></li>
                                            <? } ?>
											<li><a href="./isr/signin.html" style="color:#003300;" title="ISR Program">Agent</a></li>

											<li><a href="./loan.html" style="color:#003300;">Financing</a></li>
											<li><a href="./checkout-new.html" style="color:#003300;">Checkout</a></li>
<li><a href="./harish_contain.html" style="color:#003300;">Dealer</a></li>
											<li><? if($_SESSION['member_id']!=''){?><a href="./logout.html" style="color:#003300;">Log out</a> <? } else {?> <a  onClick="show()" style=" cursor:pointer;color:#003300;">Log in <? } ?></a></li>
										</ul>
									</li>
								</ul>
								<div class="header-search">
									<form method="get" action="search_result.html">
										<input type="text" placeholder="Search..."  name="search_text" style="color:#000000;"  />
										<button type="submit"><i class="sp-search"></i></button>
									</form>
								</div>


                                <div class="header-mystore"><li><font color="#black">MY STORE</font>
                                    <div  class="mystore">
                                   <div id="myDropdown" class="dropdown-content">
    <?
	 if(!$_SESSION['latitude'] and !$_SESSION['longitude']){
	 ?>
    <a>
    <b>Find More stores</b>
    <form class="" method="post" action="./search_store.html" name="searchform" onsubmit="return searchstore()">
    <div>
   <div id="custom-search-input" style="margin-right:2px;">
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
  
    <a style="background-color:#EF212D; color:#FFF;"><img src="images/homer.png" width="28" height="28" alt="homer" align="middle"> &nbsp;&nbsp;<font>My Current Store:</font><font><?php  echo ($city[0]); ?>...</font></a>
    <a href="./<?=str_replace("/", "", $name[0])?>/<?=$idss[0]?>/" id="a2"><font size="+1" color="#4C0608"><b><?php  echo ($name[0]); ?>..</b></font>
    <br/><b>Location:</b><font><?php  echo ($location[0]); ?><?php  echo ($city[0]); ?><?php  echo ($state[0]); ?></font><br/><b>Phone:</b> <?php  echo ($phone[0]); ?> <br/>
    <font color="#D20005">OPEN TODAY</font><font> <?= $store1['open_time'];?>- <?= $store1['close_time'];?></font></a> 
    <a href="" style="background-color:#DDF4D8;"><img src="images/locator.png" width="24" height="32" alt="locator" align="middle">&nbsp;&nbsp;<font><b>Stores Near you</b></font></a>
    <a href="./<?=str_replace("/", "", $name[1])?>/<?=$idss[1]?>/"><font><b><?php  echo ($name[1]); ?></b></font>
    <br><b>Location:</b><font><?php  echo ($location[1]); ?><?php  echo ($city[1]); ?><?php  echo ($state[1]); ?></font></br><b>Phone:</b> <?php  echo ($phone[1]); ?> <br/>
    <font color="#137100">OPEN TODAY</font><font><?= $store2['open_time'];?>- <?= $store2['close_time'];?></font></a>
    <p> <a href="./store_front.php?id=<?=$idss[1]; ?>&mystore=true"><input type="image" name="submit" src="images/make1.jpg" alt="Submit" /></a></p>
    
    <hr class="hrclass">
   
    <a href="./<?=str_replace("/", "", $name[2])?>/<?=$idss[2]?>/"><font><b><?php  echo ($name[2]); ?></b></font>
    <br><b>Location:</b><font><?php  echo ($location[2]); ?><?php  echo ($city[2]); ?><?php  echo ($state[2]); ?></font></br><b>Phone:</b> <?php  echo ($phone[2]); ?> <br/>
    <font color="#137100">OPEN TODAY</font><font> <?= $store3['open_time'];?>- <?= $store3['close_time'];?></font></a>
    <p><a href="./store_front.php?id=<?=$idss[2];?>&mystore=true"><input type="image" name="submit" src="images/make1.jpg" alt="Submit" /></a></p>
    
    <hr class="hrclass">
    <a>
    <b>Find More stores</b>
    <form class="" method="post" action="./search_store.html" name="searchform" onsubmit="return searchstore()">
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
						 <!-- Logo Start -->
                        <div class="col-md-3 col-sm-3">
                            <div class="logo" style="margin-top:20px;">
                                <a href="./"><img src="images/ebhahair.jpg" alt="ebhahair"></a>
                            </div>
                        </div>
                        <!-- Logo End -->
						<div class="col-md-8 col-sm-8 hidden-xs" style="margin-top:20px;">
							<div class="main-menu pull-right">
								<nav>
									<ul>
										<li><a href="./weaves/" title="human hair weaves">Weaves</a>
											<div class="subwigs">
                                                <span>
												<a href="./weaves/" title="all of human hair weaves">ALL OF HUMAN HAIR WEAVES</a>
																								
                                               
											 </span>
                                          </div>
										</li>
										<li><a href="./wigs/" title="wigs">WIGS</a>
                                          <div class="subweaves">
                                                <span>
												<a href="./wigs/" title="all of wigs">ALL OF WIGS</a>
												<!--<a class="subwigs-title">HUMAN HAIR WIGS</a>-->
												<a href="https://ebhahair.com/wigs/human-hair-wigs/" title="human hair lace front">HUMAN HAIR WIGS</a>
												<a href="https://ebhahair.com/wigs/synthetic-wigs/" title="human hair wigs">SYNTHETIC WIGS</a>
                                              
                                               
											 </span>
                                              <span>
												<!-- <a class="subwigs-title">SYNTHETIC WIGS</a>
												<a href="https://ebhahair.com/wigs/heat-friendly-lace-wigs/" title="lace front wigs">LACE FRONT WIGS</a>
												<a href="https://ebhahair.com/wigs/heat-friendly-wigs/" title="wigs">WIGS</a>-->
                                               
                                               
											 </span>
                                          </div>
                                        </li>
<li><a href="./braids/" title="braids">BRAIDS</a>
											<div class="subweaves">
                                                <span>
												<a href="./braids/" title="braids">BRAIDS</a>
												
                                               
											 </span>
										</li>

																				<li><a href="./top-pieces/" title="top pieces">TOP PIECES</a>
                                             <div class="subweaves">
                                                <span>
												<!--<a class="subwigs-title" href="https://ebhahair.com/top-pieces/">HUMAN HAIR TOP PIECES</a>-->
												
												<a href="./top-pieces/human-hair-closures/" title="human hair closures"> HUMAN HAIR CLOSURES</a>
												<a href="https://ebhahair.com/top-pieces/human-hair-topper/" title="human hair top pieces">HUMAN HAIR TOP PIECES</a>
                                              
                                               
											 </span>
                                              
                                          </div>
                                        
											
										</li>

										<li><a href="./hair-pieces/" title="hair pieces">HAIR PIECES</a>
											<div class="subweaves">
                                                <span>
												<a class="subwigs-title" href="./hair-pieces/">SYNTHETIC HAIR PIECES</a>
												
											 </span>
										</li>
										<!--<li><a href="#">BRANDS</a>
                                          <div class="mega-menu">
												<span>
													<a class="mega-menu-title" href="#">SHANICEE MYANMAR NATURAL HAIR</a>
													<a href="https://ebhahair.com/shree.html" title="shree Brazilian human hair"><img src="img/SHEREE-01-compressor.jpg" alt="shree Brazilian human hair"/></a>
												
												</span>
												<span>
													<a class="mega-menu-title" href="#">SHANICEE SHUNFA NATURAL HAIR</a>
													<a href="https://ebhahair.com/chinese-virgin-shun-fa.html" title="Fa chinese unprocessed hair"><img src="img/FA-01-compressor.jpg" alt="Fa chinese unprocessed hair"/></a>
													
												</span>
												
                                                
                                                <span>
													<a class="mega-menu-title" href="#">DEJA HUMAN HAIR</a>
													<a href="https://ebhahair.com/silky.html" title="andrea silky hair extensions"><img src="img/SILKY-01-compressor.jpg" alt="andrea silky hair extensions"/> </a>
											
												</span>
                                                
                                                 <span>
													<a class="mega-menu-title" href="#">AH-FREASH BRAIDS</a>
													<a href="https://ebhahair.com/top-pieces/" title="green apple top pieces"><img src="img/TOP-01-compressor.jpg" alt="green apple top pieces"/> </a>
											
												</span>
                                                
                                                
												
											</div>
                                        </li>
										<li><a href="https://ebhahair.com/about_us.html" title="about the EBHAHAIR.com">ABOUT US</a>
											<ul class="submenu">
												<li class="submenu-title"><a href="#">All pages</a></li>
												<li><a href="https://ebhahair.com/about_us.html" title="About Fa fashion">About ebha</a></li>
												<li><a href="https://ebhahair.com/terms_of_use.html" title="Terms of Use">Terms of Use</a></li>
												<li><a href="https://ebhahair.com/how_to_order.html">How to place an order?</a></li>
												<li><a href="https://ebhahair.com/shipping_policy.html">Shipping Policy</a></li>
												<li><a href="https://ebhahair.com/returns.html">Return & Exchanges</a></li>
												<li><a href="https://ebhahair.com/faq.html">FAQ</a></li>
												<li><a href="https://ebhahair.com/factory.html">Factory Pictures</a></li>
												
											</ul>
										</li>-->
										<li><a href="https://ebhahair.com/agent/" title="AGENT">AGENT</a>

											<!-- <ul class="submenu">
												<li><a href="./promotion.html" title="promotion">Promotion</a></li>
<li><a href="./openhouse.html">OPEN HOUSE</a></li>
												<li><a href="./factory.html" title="factory pictures">FACTORY PICTURES</a></li>
												<li><a href="./tradeshow.html" title="trade">TRADE SHOW</a></li>
												<li><a href="./media.html" title="videos">VIDEO</a></li>
											</ul>
										</li>-->
										<li><a href="https://ebhahair.com/wholesale_register.php" title="dealer ship">ACCOUNT</a>
<ul class="submenu">
												<li class="submenu-title"><a href="https://ebhahair.com/wholesale_register.php" title="dealer request">DEALER REQUEST</a></li>
<li class="submenu-title"><a href="https://ebhahair.com/agent_register.php" title="dealer request">Sign Up Agent</a></li>
<li class="submenu-title"><a href="https://ebhahair.com/register.html" title="dealer request">Sign Up Loyalty Program</a></li></ul>

</li>
									</ul>
								</nav>
							</div>
						</div>
                        <div class="col-md-1 col-sm-1 col-xs-12 mobsearch">
                          <div class="header-search">
									<form method="get" action="./search_result.html">
										<input type="text" placeholder="Search..."  name="search_text" style="color:#003300" />
										<button type="submit"><i class="sp-search"></i></button>
									</form>
								</div>
                        
                        </div>
						<div class="col-md-1 col-sm-1 col-xs-12">
                           <div  class="col-md-0 col-sm-0 col-xs-4"   style="padding-left:0px;"> 
                               <div class="total-cart" id="dealermob"> 
                                  <ul>
									<li><a href="./harish_contain.html" title="BECOME A BOSS"><font color="#003300">DEALER</font> </a> </li>
<li><a href="https://ebhahair.com/agents/signin_old1.php" title="Agent Program"><font color="#003300">Agent</font> </a> </li>

                                  </ul> 
                                </div> 
                            </div>
							<div class="col-md-1 col-sm-1 col-xs-4" style="padding-left:0px;">
                            
                            <div class="total-cart">
								<ul>
									<li>
										<a href="#" style="color:#003300">
                                        <? if($SubDomain){ ?>
                                            <span style="color:#000000;">Hair by</span>
											<span class="total-cart-number" style="color:#FF0000"><?=$SubDomain?></span>
                                            <? } ?>
											<span><i class="sp-shopping-bag"></i></span>
										</a>
										<!-- Mini-cart-content Start -->
										<div class="total-cart-brief">
                                      <?   while($cart_goods_row=mysql_fetch_assoc($cart_goods_queryh)){
	
	$cart_cnt++;
	
	//echo "SELECT * FROM `product` where id='$cart_goods_row[goodsId]'";
	$goods_info= mysql_fetch_assoc(mysql_query("SELECT * FROM `product` where id='$cart_goods_row[goodsId]'"));
	
	if (strpos($goods_info['images'],',') !== false) {
  $product_imgheader=explode(',',$goods_info['images']);
$product_imgheader=$product_imgheader[0];
}
else{
  $product_imgheader=$goods_info['images'];	
}
if($cart_goods_row['dropship']==0){

$total_weightheader +=$goods_info['package_weight']*$cart_goods_row['cnt'];	
}
if($total_weightheader==''){
	$total_weightheader=0;
}
	      
		   if($_SESSION['level']==2){
	  ///for dealer price////////////
	   
	   $userprice=explode(',',$goods_info['wholesaleprice2']);
	   $price1=$userprice[$cart_goods_row['option_index']];
	   
	   if(count($userprice)<=1){
	   $userprice=$goods_info['wholesale_price'];
	   $price1=$userprice;
	    }
	 
	 
		$price=$price1;
		
		  $sub_totalheader +=$price*$cart_goods_row['cnt'];
		
  }else{
	    
		$userprice=explode(',',$goods_info['price']);
		$price=$userprice[$cart_goods_row['option_index']];
		//echo count($userprice);
		if(count($userprice)<=1){
	   $userprice=$goods_info['msrp_price'];
	    $price=$userprice;
		
		
		}
		
		$price1=$price;
				
		  $sub_totalheader +=$price*$cart_goods_row['cnt'];
		 
	    }
		  $length_opt_val = explode('Length-',$cart_goods_row['option2']);

$length_opt_val = $length_opt_val[1];
 
 $quantity = $goods_info['quantity'];

if($goods_info['min_quantity']==''){
$min_quantity =1;	
}
else{
$min_quantity = $goods_info['min_quantity'];	
}

$producturl1=preg_replace('/[^A-Za-z0-9\-]/', '-', $goods_info['product_name']);
 
 $producturl1=str_replace('--', '-', $producturl1);
   $producturl1=strtolower(rtrim($producturl1, "-"));
		  
		   ?>
											<div class="cart-photo-details">
                                            <form name="haedercartForm<?=$cart_cnt?>" method="post">
                                              <input type="hidden" name="cartId" value="<?=$cart_goods_row['id']?>">
                                               <input type="hidden" name="URL" value="<?=$_SERVER['REQUEST_URI']?>">
                                             
                                              
												<div class="cart-photo">
													<!--<a href="#"><img src="img/total-cart/1.jpg" alt="" /></a> -->
												</div>
												<div class="cart-photo-brief">
													<a href="./<?=$producturl1?>-<?=$goods_info['id']?>.html"><?=$goods_info['product_name']?></a>
													 <? if($_SESSION['i_am']=='Wholesaler'){ ?><span>$<?=$cart_goods_row['cnt']*$price1?></span><? } ?>
												</div>
												<div class="pro-delete">
													<a href="javascript:cartDel(document.haedercartForm<?=$cart_cnt?>);"><i class="sp-circle-close"></i></a>
												</div>
                                                </form>
											</div>
                                            <? } ?>
											
											<div class="cart-subtotal">
                                            <? if($_SESSION['i_am']=='Wholesaler'){ ?>
												<p>Total = $<?=number_format($sub_totalheader,2)?></p>
                                                <? } ?>
											</div>
                                             <form method="post" id="sendcheckoutheader" name="sendcheckoutheader"  action="./checkout-new.php">
											<div class="cart-inner-btm">
                                           
                                                    <input type="hidden" name="total_P" value="<?=number_format($sub_totalheader,2);?>">
                                                     <input type="hidden" name="total_weight" value="<?=$total_weightheader?>">
                                                      <? if($_SESSION['GOOD_SHOP_PART']=='member') {?>
												<a href="javascript:submitform(document.sendcheckoutheader);">Checkout</a>
                                                 <? } else{?>
                                                 <a href="javascript:submitform(document.sendcheckoutheader);">Checkout</a>
                                                   <? } ?>
                                             
											</div>
                                            </form>
										</div>
										<!-- Mini-cart-content End -->
									</li>
								</ul>
							</div>
                            </div>
                          <div class="col-md-0 col-sm-0 col-xs-4" style="padding-left:0px;"> 
                            <div class="total-cart" style="text-align:center;" id="mobstore"><ul>

                             <li><? if($_SESSION['member_id']!=''){?><a href="./logout.html" style="color:#003300;">Log out</a> <? } else {?> <a  onClick="show()" style=" cursor:pointer;color:#003300;">Log in <? } ?></a></li>
										</ul>
<a href="./register.html" style="color:#003300;" title="LOYALTY PROGRAM">LOYALTY PROGRAM</a>
                            <!-- <span class="header-mystore"><font color="#003300"> MY STORE </font></span>
                             <div  class="mystore">
                                   <div id="myDropdown" class="dropdown-content">
    <?
	 if(!$_SESSION['latitude'] and !$_SESSION['longitude']){
	 ?>
    <a>
    <b>Find More stores</b>
    <form class="" method="post" action="./search_store.html" name="searchformmob" onsubmit="return searchstoremob()">
    <div>
   <div id="custom-search-input" style="margin-right:2px;">
                <div class="input-group col-md-12">
                    <input type="text" class="form-control input-lg" placeholder="Search more stores here"  name="address"  style="color:#003300" />
                    <span class="input-group-btn" style="background-color:darkgreen;" onclick="searchstoremob();">
                        <button class="btn btn-info btn-lg" type="button" style="color:green">
                            <i class="sp-search"></i>
                        </button>
                    </span>
                </div>
            </div>-->
    </div>
   
     
     </form>    
    </a>
     
     <? }else{ ?>
  
    <a  style="background-color:#EF212D; color:#FFF;"><img src="images/homer.png" width="28" height="28" alt="homer" align="middle"> &nbsp;&nbsp;<font>My Current Store:</font><font><?php  echo ($city[0]); ?>...</font></a>
    <a href="./store_front.php?id=<?php  echo ($idss[0]); ?>" id="a2"><font size="+1" color="#4C0608"><b><?php  echo ($name[0]); ?>..</b></font>
    <br/><b>Location:</b><font><?php  echo ($location[0]); ?><?php  echo ($city[0]); ?><?php  echo ($state[0]); ?></font><br/><b>Phone:</b> <?php  echo ($phone[0]); ?> <br/>
    <font color="#D20005">OPEN TODAY</font><font> <?= $store1['open_time'];?>- <?= $store1['close_time'];?></font></a> 
    <a href="./" style="background-color:#DDF4D8;"><img src="images/locator.png" width="24" height="32" alt="locator" align="middle">&nbsp;&nbsp;<font><b>Stores Near you</b></font></a>
    <a href="./store_front.php?id=<?php  echo ($idss[1]); ?>"><font><b><?php  echo ($name[1]); ?></b></font>
    <br><b>Location:</b><font><?php  echo ($location[1]); ?><?php  echo ($city[1]); ?><?php  echo ($state[1]); ?></font></br><b>Phone:</b> <?php  echo ($phone[1]); ?> <br/>
    <font color="#137100">OPEN TODAY</font><font><?= $store2['open_time'];?>- <?= $store2['close_time'];?></font></a>
    <p> <a href="./store_front.php?id=<?=$idss[1]; ?>&mystore=true"><input type="image" name="submit" src="images/make1.jpg" alt="Submit" /></a></p>
    
    <hr class="hrclass">
   
    <a href="./store_front.php?id=<?php  echo ($idss[2]); ?>"><font><b><?php  echo ($name[2]); ?></b></font>
    <br><b>Location:</b><font><?php  echo ($location[2]); ?><?php  echo ($city[2]); ?><?php  echo ($state[2]); ?></font></br><b>Phone:</b> <?php  echo ($phone[2]); ?> <br/>
    <font color="#137100">OPEN TODAY</font><font> <?= $store3['open_time'];?>- <?= $store3['close_time'];?></font></a>
    <p><a href="./store_front.php?id=<?=$idss[2];?>&mystore=true"><input type="image" name="submit" src="images/make1.jpg" alt="Submit" /></a></p>
    
    <hr class="hrclass">
    <a>
    <b>Find More stores</b>
    <form class="" method="post" action="./search_store.html" name="searchformmob" onsubmit="return searchstoremob()">
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
			<div class="mobile-menu-area hidden-sm hidden-md hidden-lg">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<div class="mobile-menu">
								<nav id="dropdown">
									<ul>
										<li><a href="./weaves/" title="human hair weaves">Weaves</a>
											<ul class="submenu">
                                           <li class="submenu-title"> <a class="subwigs-title" href="./weaves/" title="ALL OF HUMAN HAIR WEAVES">ALL OF HUMAN HAIR WEAVES</a></li>
												
											</ul>
										</li>
										<li><a href="./wigs/" title="wigs">WIGS</a>
                                         <ul class="submenu">
														
                                                                                        
                                              <li><a href="./wigs/" title="human hair wigs">HUMAN HAIR WIGS</a></li>
                                               <li><a href="https://ebhahair.com/wigs/synthetic-wigs/" title="wigs">SYNTHETIC WIGS</a></li>                                               
												
											</ul>
                                        
                                        </li>

<!--<li><a href="https://ebhahair.com/braids/" title="braids">BRAIDS</a>

											<ul class="submenu">
												<li class="submenu-title"><a class="subwigs-title" helf="https://ebhahair.com/braids/">ALL OF BRAIDS</a></li>
												
											</ul>
										</li>-->
										
										<li><a href="./top-pieces/" title="top pieces">TOP PIECES</a>

                                      <ul class="submenu">
                                           
											<li><a href="https://ebhahair.com/top-pieces/human-hair-topper/" title="human hair top pieces">HUMAN HAIR TOP PIECES</a></li>
											<li><a href="./top-pieces/human-hair-closures/" title="human hair closures"> HUMAN HAIR CLOSURES</a></li>
									   </ul>
                                           </li>
										<li><a href="https://ebhahair.com/hair-pieces/" title="hair pieces">HAIR PIECES</a>

											<ul class="submenu">
												<li class="submenu-title"><a class="subwigs-title" helf="https://ebhahair.com/hair-pieces/">ALL OF HAIR PIECES</a></li>
														</ul>
										</li>
										<li><a href="./braids/" title="braids">BRAIDS</a>

											<ul class="submenu">
												<li><a href="./braids/" title="all of braids">ALL OF BRAIDS</a></li>
												
											</ul>
										</li>


<li><a href="https://ebhahair.com/agent/" title="agent">AGENT</a>

											<!--<ul class="submenu">
												<li><a href="./promotion.html" title="promotion">PROMOTION</a></li>
<li><a href="./tradeshow.html">TRADE SHOW</a></li>

												
											</ul>-->
										</li>
										
				
                                        <li><a href="./wholesale_register.php" title="BECOME A BOSS">BECOME A BOSS</a>
<ul class="submenu">
												<li class="submenu-title"><a href="./harish_contain.html">DEALER</a></li>
									<li class="submenu-title"><a href="./agent_register.php" title="independ sale representative">Agent Sign up</a></li></ul>

</li>
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
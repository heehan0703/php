<?
ini_set('display_errors', '1');
session_start();
require_once('../wp-admin/include/connectdb.php');
//echo $_SESSION['ISR_ID'];
if($_SESSION['ISR_ID']){
$mem_id=$_SESSION['ISR_ID'];
//echo "dhirecndra";
$name=$_SESSION['ISR_NAME'];

$result=mysql_query("select * from member where ISR=$mem_id");

$resultpopup=mysql_query("select * from member where ISR=$mem_id");

$totalbuyer=mysql_num_rows($result);

$order=mysql_query("select * from trade where ISR=$mem_id");
$num_order=mysql_num_rows($order);

$ordermap=mysql_query("select FROM_UNIXTIME(writeday, '%M') AS m, COUNT(DISTINCT id) AS total from trade where ISR=$mem_id GROUP BY MONTH(writeday)");

}else{
header("location:signin.php");
}

$order=mysql_query("select * from trade where ISR=$mem_id order by id desc limit 5");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>EBHA-ISR / DASHBOARD</title>
  <meta name="description" content="EBHA-ISR / DASHBOARD" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="images/logo.png">
  <meta name="apple-mobile-web-app-title" content="Flatkit">
  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" sizes="196x196" href="images/logo.png">
  
  <!-- style -->
  <link rel="stylesheet" href="css/animate.css/animate.min.css" type="text/css" />
  <link rel="stylesheet" href="css/glyphicons/glyphicons.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/material-design-icons/material-design-icons.css" type="text/css" />
  <link rel="stylesheet" href="css/ionicons/css/ionicons.min.css" type="text/css" />
  <link rel="stylesheet" href="css/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="css/bootstrap/dist/css/bootstrap.min.css" type="text/css" />

  <!-- build:css css/styles/app.min.css -->
  <link rel="stylesheet" href="css/styles/app.css" type="text/css" />
  <link rel="stylesheet" href="css/styles/style.css" type="text/css" />
  <!-- endbuild -->
  <link rel="stylesheet" href="css/styles/font.css" type="text/css" />
   <style type="text/css">
   .overlay-mask{background:none repeat scroll 0 0 rgba(28, 45, 50, 0.8);bottom:0;height:100%;left:0;position:fixed;right:0;top:0;width:100%;z-index:999999;display:none;overflow-y:auto;overflow-x:hidden;}
.overlay.iframe-content{border:2em solid #fff;border-radius:6px;box-sizing:content-box;padding:0;width:23%;}
.overlay{background:none repeat scroll 0 0 #fff;border-radius:3px;box-shadow:0 1px 3px rgba(23, 74, 104, 0.35), 0 0 32px rgba(60, 82, 93, 0.35);box-sizing:border-box;margin:50px auto 0;padding:30px;position:relative;}
.overlay.iframe-content .title{border:medium none;margin:0;position:absolute;}
.overlay .title{border-bottom:1px solid #e2e8ea;margin-bottom:20px;}
.overlay .close-icon{font:32px Dingbatz;color:#b3c5d0;content:"?";display:block;font:bold 20px "Dingbatz";position:absolute;right:0;}
.overlay.iframe-content .close-icon{background:none repeat scroll 0 0 #000;border-radius:32px;color:white;height:32px;opacity:1;position:absolute;right:-2em;top:-2em;width:32px;}
.overlay .close-icon{cursor:pointer;float:right;}

@media only screen and (max-width:600px) {  
}

@media screen and (max-width: 640px) {
	table {
		overflow-x: auto;
		display: block;
	}
	.text-right {
    text-align: left;
}
	
}

  </style>
  <script type="text/javascript">
  function show(){$("#overlay-mask-1").fadeIn('slow');}
  
  function subpopup(){
  $("#pop_form").submit();
 
  }
  
  </script>
</head>
<body>
 <div class="app" id="app">

<!-- ############ LAYOUT START-->

<?php include'isr_left.php'?>
  
  <!-- content -->
  <div id="content" class="app-content box-shadow-z2 bg pjax-container" role="main">
    <div class="app-header white bg b-b">
          <div class="navbar" data-pjax>
                <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up p-r m-a-0">
                  <i class="ion-navicon"></i>
                </a>
                <div class="navbar-item pull-left h5" id="pageTitle">Dashboard</div>
                <!-- nabar right -->
                <ul class="nav navbar-nav pull-right">
                  <li class="nav-item dropdown pos-stc-xs">
                    <a class="nav-link" data-toggle="dropdown">
                      <i class="ion-android-search w-24"></i>
                    </a>
                    <div class="dropdown-menu text-color w-md animated fadeInUp pull-right">
                      <!-- search form -->
                      <form class="navbar-form form-inline navbar-item m-a-0 p-x v-m" role="search">
                        <div class="form-group l-h m-a-0">
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search projects...">
                            <span class="input-group-btn">
                              <button type="submit" class="btn white b-a no-shadow"><i class="fa fa-search"></i></button>
                            </span>
                          </div>
                        </div>
                      </form>
                      <!-- / search form -->
                    </div>
                  </li>
                  <li class="nav-item dropdown pos-stc-xs">
                    <a class="nav-link clear" data-toggle="dropdown">
                      <i class="ion-android-notifications-none w-24"></i>
                      <span class="label up p-a-0 danger"></span>
                    </a>
                    <!-- dropdown -->
                    <div class="dropdown-menu pull-right w-xl animated fadeIn no-bg no-border no-shadow">
                        <div class="scrollable" style="max-height: 220px">
                          <ul class="list-group list-group-gap m-a-0">
                            <li class="list-group-item dark-white box-shadow-z0 b">
                              <span class="pull-left m-r">
                                <img src="images/a0.jpg" alt="..." class="w-40 img-circle">
                              </span>
                              <span class="clear block">
                                Use awesome <a href="#" class="text-primary">animate.css</a><br>
                                <small class="text-muted">10 minutes ago</small>
                              </span>
                            </li>
                            <li class="list-group-item dark-white box-shadow-z0 b">
                              <span class="pull-left m-r">
                                <img src="images/a1.jpg" alt="..." class="w-40 img-circle">
                              </span>
                              <span class="clear block">
                                <a href="#" class="text-primary">Joe</a> Added you as friend<br>
                                <small class="text-muted">2 hours ago</small>
                              </span>
                            </li>
                            <li class="list-group-item dark-white text-color box-shadow-z0 b">
                              <span class="pull-left m-r">
                                <img src="images/a2.jpg" alt="..." class="w-40 img-circle">
                              </span>
                              <span class="clear block">
                                <a href="#" class="text-primary">Danie</a> sent you a message<br>
                                <small class="text-muted">1 day ago</small>
                              </span>
                            </li>
                          </ul>
                        </div>
                    </div>
                    <!-- / dropdown -->
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link clear" data-toggle="dropdown">
                      <span class="avatar w-32">
                        <img src="images/a3.jpg" class="w-full rounded" alt="...">
                      </span>
                    </a>
                    <div class="dropdown-menu w dropdown-menu-scale pull-right">
                      <a class="dropdown-item" href="profile.html">
                        <span>Profile</span>
                      </a>
                      <a class="dropdown-item" href="setting.html">
                        <span>Settings</span>
                      </a>
                      <a class="dropdown-item" href="app.inbox.html">
                        <span>Inbox</span>
                      </a>
                      <a class="dropdown-item" href="app.message.html">
                        <span>Message</span>
                      </a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="docs.html">
                        Need help?
                      </a>
                      <a class="dropdown-item" href="signout.php">Sign out</a>
                    </div>
                  </li>
                </ul>
                <!-- / navbar right -->
          </div>
    </div>
    <div class="app-footer white bg p-a b-t">
      <div class="pull-right text-sm text-muted">Version 1.0.1</div>
      <span class="text-sm text-muted">EBHA&copy; Copyright.</span>
    </div>
    <div class="app-body">

<!-- ############ PAGE START-->
<div class="row-col">
	<div class="col-lg b-r">
		<div class="row no-gutter">
			<div class="col-xs-6 col-sm-6 b-r b-b">
				<div class="padding">
					<div>
						<span class="pull-right"><i class="fa fa-caret-up text-primary m-y-xs"></i></span>
						<span class="text-muted l-h-1x"><i class="ion-ios-grid-view text-muted"></i></span>
					</div>
					<div class="text-center">
						<h2 class="text-center _600"><?=$totalbuyer?></h2>
						<p class="text-muted m-b-md"> Buyers</p>
						<div>
							<span data-ui-jp="sparkline" data-ui-options="[2,3,2,2,1,3,6,3,2,1], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
						</div>
					</div>
				</div>
	        </div>
	        <div class="col-xs-6 col-sm-6 b-r b-b">
				<div class="padding">
					<div>
						<span class="pull-right"><i class="fa fa-caret-up text-primary m-y-xs"></i></span>
						<span class="text-muted l-h-1x"><i class="ion-document text-muted"></i></span>
					</div>
					<div class="text-center">
						<h2 class="text-center _600"><?=$num_order?></h2>
						<p class="text-muted m-b-md">Orders</p>
						<div>
							<span data-ui-jp="sparkline" data-ui-options="[1,1,0,2,3,4,2,1,2,2], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
						</div>
					</div>
				</div>
	        </div>
	        
	        
        </div>
		<div class="padding">
			
	        
			<div class="row">
			    <div class="col-sm-6">
			        <div class="box">
			            <div class="box-header">
			              <span class="label success pull-right">52</span>
			              <h3>Buyers</h3>
			            </div>
			            <div class="p-b-sm">
				            <ul class="list no-border m-a-0">
                            <? while($userrow=mysql_fetch_array($result)){
							
							$alp=substr($userrow['f_name'],0,1);
							 ?>
                            
				              <li class="list-item">
				                <a href="#" class="list-left">
				                	<span class="w-40 avatar danger">
					                  <span><?=$alp?></span>
					                  <i class="on b-white bottom"></i>
					                </span>
				                </a>
				                <div class="list-body">
				                  <div><a href="#"><?=$userrow['f_name']?> <?=$userrow['l_name']?></a></div>
				                  <small class="text-muted text-ellipsis"><?=$userrow['i_am']?></small>
				                </div>
				              </li>
                              <? } ?>
                              
                              <?  while ($roworder=mysql_fetch_array($ordermap)){ ?>
                              
				              <li class="list-item">
				                <a href="#" class="list-left">
				                  <span class="w-40 avatar purple">
					                  <span>M</span>
					                  <i class="on b-white bottom"></i>
					              </span>
				                </a>
				                <div class="list-body">
				                  <div><a href="#">Mogen Polish</a></div>
				                  <small class="text-muted text-ellipsis"><?=$roworder['m']?>, <?=$roworder['total']?></small>
				                </div>
				              </li>
                              <? } ?>
                              
				              
				              
				            </ul>
			            </div>
			        </div>
			    </div>
			    <div class="col-sm-6">
					<div class="box">
			          <div class="box-header">
			            <h3>Orders</h3>
			            <small>Calculated in last 30 days</small>
			          </div>
			          <div class="box-tool">
				        <ul class="nav">
				          <li class="nav-item inline">
				            <a class="nav-link">
				              <i class="ion-android-sync m-x-xs"></i>
				            </a>
				          </li>
				          <li class="nav-item inline dropdown">
				            <a class="nav-link" data-toggle="dropdown">
				              <i class="ion-android-menu m-x-xs"></i>
				            </a>
				            <div class="dropdown-menu dropdown-menu-scale pull-right">
				              <a class="dropdown-item" href="#">This week</a>
				              <a class="dropdown-item" href="#">This month</a>
				              <a class="dropdown-item" href="#">This week</a>
				              <div class="dropdown-divider"></div>
				              <a class="dropdown-item">Today</a>
				            </div>
				          </li>
				        </ul>
				      </div>
				        <div>
			            <canvas data-ui-jp="chart" data-ui-options="
				            {
				              type: 'line',
				              data: {
				                  labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
				                  datasets: [
				                      {
				                          label: 'Dataset',
				                          data: [1, 1, 1, 1, 1, 22, 26],
				                          fill: true,
				                          backgroundColor: '#ef193c',
				                          borderColor: '#ef193c',
				                          borderWidth: 2,
				                          borderCapStyle: 'butt',
				                          borderDash: [],
				                          borderDashOffset: 0.0,
				                          borderJoinStyle: 'miter',
				                          pointBorderColor: '#ef193c',
				                          pointBackgroundColor: '#fff',
				                          pointBorderWidth: 2,
				                          pointHoverRadius: 4,
				                          pointHoverBackgroundColor: '#ef193c',
				                          pointHoverBorderColor: '#fff',
				                          pointHoverBorderWidth: 2,
				                          pointRadius: [0,4,4,4,4,4,0],
				                          pointHitRadius: 10,
				                          spanGaps: false
				                      }
				                  ]
				              },
				              options: {
				              	scales: {
				              		xAxes: [{
					                   display: false
					                }],
					                yAxes: [{
					                   display: false,
					                   ticks:{
					                   	 min: 0,
					                   	 max: 100
					               	   }
					                }]
				              	},
				              	legend: {
				              		display: false
				              	}
				              }
				            }
				            " height="150">
				            </canvas>
				      	</div>
				        <div class="box-body danger text-center p-b-md">
				        	<span class="dark-white rounded m-r p-x p-y-xs text-danger"><i class="fa fa-caret-down"></i> 25%</span>
				        	<span>Over last Month</span>
				        </div>
			        </div>
				</div>
			    <div class="col-sm-12">
			    	<div class="row-col b-a white m-b">
					    <div class="col-md-8">
					      
					    </div>
					    
					  </div>
			    </div>
			</div>
			
		</div>
	</div>
	<div class="col-lg w-lg w-auto-md white bg">
		<div>
			<div class="p-a">
				<h6 class="text-muted m-a-0">LATEST ORDERS</h6>
			</div>
            
			<div class="list inset">
            
            <div style="float:left; width:130px"><b>Customer </b> </div>
            <div style="float:left;width:70px"><b>Status</b></div>
            <div style="float:left;"><b>Pay&nbsp;Money</b></div>
            
              <? while($roworder=mysql_fetch_array($order)){ ?>
              <div style="clear:both;">
              <hr/>
               <div style="float:left; width:130px"><?=$roworder['name1']?><?=$roworder['name2']?> </div>
            <div style="float:left;width:70px"><? if ($roworder['order_status']==""){?>Pending <? }else{ ?> <?=$roworder['order_status']?> <? }?></div>
            <div style="float:left;"><?=number_format($roworder['totalM']+$roworder['shipM']+$roworder['shipotherM'],2)?></div>
            
            </div>
            
				
                <? } ?>
                
	            
	        </div>
	        
        </div>
	</div>
</div>

<div class="modal fade inactive" id="chat" data-backdrop="false">
  <div class="modal-right w-xxl dark-white b-l">
  	  <div class="row-col">
  	    <a data-dismiss="modal" class="pull-right text-muted text-lg p-a-sm m-r-sm">&times;</a>
  	    <div class="p-a b-b">
  	      <span class="h5">Chat</span>
  	    </div>
  	    <div class="row-row light">
  	      <div class="row-body scrollable hover">
  	        <div class="row-inner">
  	          <div class="p-a-md">
  	            <div class="m-b">
  	              <a href="#" class="pull-left w-40 m-r-sm"><img src="images/a2.jpg" alt="..." class="w-full img-circle"></a>
  	              <div class="clear">
  	                <div class="p-a p-y-sm dark-white inline r">
  	                  Hi John, What's up...
  	                </div>
  	                <div class="text-muted text-xs m-t-xs"><i class="fa fa-ok text-success"></i> 2 minutes ago</div>
  	              </div>
  	            </div>
  	            <div class="m-b">
  	              <a href="#" class="pull-right w-40 m-l-sm"><img src="images/a3.jpg" class="w-full img-circle" alt="..."></a>
  	              <div class="clear text-right">
  	                <div class="p-a p-y-sm success inline text-left r">
  	                  Lorem ipsum dolor soe rooke..
  	                </div>
  	                <div class="text-muted text-xs m-t-xs">1 minutes ago</div>
  	              </div>
  	            </div>
  	            <div class="m-b">
  	              <a href="#" class="pull-left w-40 m-r-sm"><img src="images/a2.jpg" alt="..." class="w-full img-circle"></a>
  	              <div class="clear">
  	                <div class="p-a p-y-sm dark-white inline r">
  	                  Good!
  	                </div>
  	                <div class="text-muted text-xs m-t-xs"><i class="fa fa-ok text-success"></i> 5 seconds ago</div>
  	              </div>
  	            </div>
  	            <div class="m-b">
  	              <a href="#" class="pull-right w-40 m-l-sm"><img src="images/a3.jpg" class="w-full img-circle" alt="..."></a>
  	              <div class="clear text-right">
  	                <div class="p-a p-y-sm success inline text-left r">
  	                  Dlor soe isep..
  	                </div>
  	                <div class="text-muted text-xs m-t-xs">Just now</div>
  	              </div>
  	            </div>
  	          </div>
  	        </div>
  	      </div>
  	    </div>
  	    <div class="p-a b-t">
  	      <form>
  	        <div class="input-group">
  	          <input type="text" class="form-control" placeholder="Say something">
  	          <span class="input-group-btn">
  	            <button class="btn white b-a no-shadow" type="button">SEND</button>
  	          </span>
  	        </div>
  	      </form>
  	    </div>
  	  </div>
  </div>
</div>

<!-- ############ PAGE END-->

    </div>
  </div>
  <!-- / -->

  
  <!-- ############ SWITHCHER START-->
    <!--<div id="switcher">
      <div class="switcher dark-white" id="sw-theme">
        <a href="#" data-ui-toggle-class="active" data-ui-target="#sw-theme" class="dark-white sw-btn">
          <i class="fa fa-gear text-muted"></i>
        </a>
        <div class="box-header">
          <a href="https://themeforest.net/item/aside-dashboard-ui-kit/17903768?ref=flatfull" class="btn btn-xs rounded danger pull-right">BUY</a>
          <strong>Theme Switcher</strong>
        </div>
        <div class="box-divider"></div>
        <div class="box-body">
          <p id="settingLayout" class="hidden-md-down">
            <label class="md-check m-y-xs" data-target="folded">
              <input type="checkbox">
              <i></i>
              <span>Folded Aside</span>
            </label>
            <label class="m-y-xs pointer" data-ui-fullscreen data-target="fullscreen">
              <span class="fa fa-expand fa-fw m-r-xs"></span>
              <span>Fullscreen Mode</span>
            </label>
          </p>
          <p>Colors:</p>
          <p data-target="color">
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md">
              <input type="radio" name="color" value="primary">
              <i class="primary"></i>
            </label>
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md">
              <input type="radio" name="color" value="accent">
              <i class="accent"></i>
            </label>
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md">
              <input type="radio" name="color" value="warn">
              <i class="warn"></i>
            </label>
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md">
              <input type="radio" name="color" value="success">
              <i class="success"></i>
            </label>
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md">
              <input type="radio" name="color" value="info">
              <i class="info"></i>
            </label>
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md">
              <input type="radio" name="color" value="warning">
              <i class="warning"></i>
            </label>
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-md">
              <input type="radio" name="color" value="danger">
              <i class="danger"></i>
            </label>
          </p>
          <p>Themes:</p>
          <div data-target="bg" class="clearfix">
            <label class="radio radio-inline m-a-0 ui-check ui-check-lg">
              <input type="radio" name="theme" value="">
              <i class="light"></i>
            </label>
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-lg">
              <input type="radio" name="theme" value="grey">
              <i class="grey"></i>
            </label>
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-lg">
              <input type="radio" name="theme" value="dark">
              <i class="dark"></i>
            </label>
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-lg">
              <input type="radio" name="theme" value="black">
              <i class="black"></i>
            </label>
          </div>
        </div>
      </div>
    </div>-->
  <!-- ############ SWITHCHER END-->

<!-- ############ LAYOUT END-->
  </div>

<!-- build:js scripts/app.min.js -->
<!-- jQuery -->
  <script src="libs/jquery/dist/jquery.js"></script>
<!-- Bootstrap -->
  <script src="libs/tether/dist/js/tether.min.js"></script>
  <script src="libs/bootstrap/dist/js/bootstrap.js"></script>
<!-- core -->
  <script src="libs/jQuery-Storage-API/jquery.storageapi.min.js"></script>
  <script src="libs/PACE/pace.min.js"></script>
  <script src="libs/jquery-pjax/jquery.pjax.js"></script>
  <script src="libs/blockUI/jquery.blockUI.js"></script>
  <script src="libs/jscroll/jquery.jscroll.min.js"></script>

  <script src="scripts/config.lazyload.js"></script>
  <script src="scripts/ui-load.js"></script>
  <script src="scripts/ui-jp.js"></script>
  <script src="scripts/ui-include.js"></script>
  <script src="scripts/ui-device.js"></script>
  <script src="scripts/ui-form.js"></script>
  <script src="scripts/ui-modal.js"></script>
  <script src="scripts/ui-nav.js"></script>
  <script src="scripts/ui-list.js"></script>
  <script src="scripts/ui-screenfull.js"></script>
  <script src="scripts/ui-scroll-to.js"></script>
  <script src="scripts/ui-toggle-class.js"></script>
  <script src="scripts/ui-taburl.js"></script>
  <script src="scripts/app.js"></script>
  <script src="scripts/ajax.js"></script>
<!-- endbuild -->

<!--login popup start-->

<div id="overlay-mask-1" class="overlay-mask" style="" onKeyPress="test(event)">
  

  <div class="overlay iframe-content" style="height:200px;">
    <div class="content" style="float:left; "> 
      <div class="row">
  
   
    
      <div class="col-lg-12 col-xs-12 col-xs-12">
       <form name="pop_form" action="./inventory.php" method="post"   autocomplete="on"  id="pop_form">
        
    <div class="full" style="background:#FBFBFB; border:1px solid #E5E5E5; padding:5%;">
     <div class="full"></div>
  
   
     <h3 class="h3">Select Buyer</h3>
     <select style="width:250px; height:30px; background:#999999; border:1px solid #000000" name="user">
     <? while($userrowpopup=mysql_fetch_array($resultpopup)){ ?>
     <option value="<?=$userrowpopup['member_id']?>"><?=$userrowpopup['f_name']?>&nbsp;<?=$userrowpopup['l_name']?> &nbsp;( <?=$userrowpopup['i_am']?>) </option>
	 <? } ?>
     </select>
     <div class="full" style="color:#999999; margin-top:1em;">
     
     <div id="berror" style="color:#FF0000" ></div>
  
   <div id="uerror" style="color:#FF0000" ></div>
   <div class="form-group">
   
   
   
   
   </div>
   
   
   <div id="perror" style="color:#FF0000" ></div>
  
   
   
   <div class="" style="margin-top:2em;">
   
   <div style=" text-align:center width:100%">
   <div style="margin-bottom:10px;">
   <button type="button"  class="blue-btn glyphicon " onClick="subpopup()" style="background:#268BB9; color:#FFF; width:85%; height:35px;">
   <span class="" style="font-family:sans-serif;" > INVENTORIES</span>
   </button>
   </div>
   <div>
       
       <a href="./add-buyer.php"><button type="button"  class="blue-btn glyphicon "  style="background:#268BB9; color:#FFF; width: 85%;height:35px;">
      <span class="" style="font-family:sans-serif;" >ADD BUYER</span>
      </button></a>
  </div>
  
   </div>
   
 
   
   </div>
     </div>
     </div> 
     </form>  
      </div>
    </div>
   
     
  </div>
    </div>
  
    
    </div>
<!-- login popup end -->
</body>
</html>

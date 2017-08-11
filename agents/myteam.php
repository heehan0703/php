<?
ini_set('display_errors', '1');
session_start();
require_once('../wp-admin/include/connectdb.php');
$mem_id=$_SESSION['ISR_ID'];
//echo "$mem_id";
$name=$_SESSION['ISR_NAME'];


$resultpopup=mysql_query("select * from member where ISR=$mem_id");
$agentdetail=mysql_fetch_array(mysql_query("select * from member where member_id=$mem_id"));


function calculatechildren($parentid,$depth=0){
$userdetail='';
$depth=$depth+1;
$margen=0;
for($i=0;$i<$depth;$i++){
$margen=$margen+20;
}
   $query=mysql_query("select * from member where parent_id='$parentid'");
   $num=mysql_num_rows($query);
		if($num){
			while($rowchildren=mysql_fetch_array($query)) {
			$userdetail .='<div style="margin-left:'.$margen.'px;">&nbsp;<img src="./images/sca.png">'.$rowchildren['Agent_code'].'<i class="icon ion-person icon-blue"></i>'.$rowchildren['f_name'].'&nbsp;'. $rowchildren['l_name'].'&nbsp;<i class="ion-star"></i>&nbsp;'.$rowchildren['agent_level'].'&nbsp;<i class="icon ion-email"></i>&nbsp;'.$rowchildren['email'].'&nbsp;<i class="icon ion-iphone"></i>&nbsp;'.$rowchildren['cel'].'&nbsp;<i class="icon ion-location"></i>&nbsp;'.$rowchildren['city'].'</div>';
			
			$userdetail .= calculatechildren($rowchildren['member_id'],$depth);
		    		
			} 
		}
return $userdetail;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>EBHA-Agent My Team</title>
  <meta name="description" content="EBHA-ISR_BUYER LIST" />
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

</style>
  <style type="text/css">
  .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th {
    padding-left: 0px;
    padding-right: 0px;
	 

    
}


.arrow-up {
  width: 0; 
  height: 0; 
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  
  border-bottom: 5px solid black;
}

.arrow-down {
  width: 0; 
  height: 0; 
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  
  border-top: 5px solid black;
}


.blue{
color:#0033CC;
}


@media only screen and (max-width:600px) {

  
}

@media screen and (max-width: 640px) {
	table {
		overflow-x: auto;
		display: block;
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

 <!-- ############ LAYOUT START-->

 <?php include'isr_left.php'?>
 
  <!-- / -->
  <!-- content -->
  <div id="content" class="app-content box-shadow-z2 bg pjax-container" role="main">
    <div class="app-header white bg b-b">
          <div class="navbar" data-pjax>
                <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up p-r m-a-0">
                  <i class="ion-navicon"></i>
                </a>
                <div class="navbar-item pull-left h5" id="pageTitle">My Team</div>
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
                      <a class="dropdown-item" href="signin.html">Sign out</a>
                    </div>
                  </li>
                </ul>
                <!-- / navbar right -->
          </div>
    </div>
    <div class="app-footer white bg p-a b-t" style="background-color:rgb(240,240,240); padding-top:1; padding-right:; padding-bottom:1; padding-left:; border-top-width:1px; border-top-style:solid; position:absolute; left:0; bottom:0; z-index:1010; padding-right:; padding-bottom:1; padding-left:; border-top-width:1px; padding-right:; padding-bottom:1; padding-left:; border-top-width:1px; padding-right:; padding-bottom:1; padding-left:; border-top-width:1px; padding-right:; padding-bottom:1; padding-left:; border-top-width:1px; padding-right:; padding-bottom:1; padding-left:; border-top-width:1px;
padding-right:; padding-bottom:1; padding-left:; border-top-width:1px;
padding-right:; padding-bottom:1; padding-left:; border-top-width:1px;
padding-right:; padding-bottom:1; padding-left:; border-top-width:1px;
padding-right:; padding-bottom:1; padding-left:; border-top-width:1px;
padding-right:; padding-bottom:1; padding-left:; border-top-width:1px;
padding-right:; padding-bottom:1; padding-left:; border-top-width:1px;
padding-right:; padding-bottom:1; paddi">
      <div class="pull-right text-sm text-muted">Version 1.0.1</div>
      <span class="text-sm text-muted">&copy; Copyright.</span>
    </div>
	
                                 

                            

    <div class="app-body" style="height:100%;  right:0; top:0; z-index:1; visibility:visible; visibility:; visibility:;">
	<br>
    <div align="left"><table><tr>

                              <td align="left" class="white-18"><font size="+2"><b>&nbsp;Hierarchy </b></font></td>
                              
                                 </tr></table>
                                 
                                 
         <hr/>                         
                                 
                                 
        </div>

    <div id="datatable" style="width:100%; ">
      <table class="table table-striped white b-a" style=" width:100%; padding:0px; margin:0px;overflow:scroll; background-color:#FFFFFF"  cellpadding="0" cellspacing="">
      
      <tr>
      
      <td style="width:350px;min-width:20px; background-color:#FFFFFF">&nbsp;
          <table  style="width:100%">
           <tr>  <td bgcolor="#FFFFFF" style=""> 
           <div style="float:left"> <div class="arrow-down" style="float:left; margin-top:10px"></div> 
                        <div style="float:left; padding-bottom:5px;"> <font color="#0099FF"> Expand All</font>   </div>  <div class="arrow-up" style="float:left;margin-top:10px"></div> <div style="float:left"> <span><font color="#0099FF">Collapse All </font></span> </div>  
                        
                        
                        
                        </td>    
                       
                          </tr>
          
          <? 
		  $agent_under=mysql_query("select * from member where parent_id='$mem_id'");
		  $parentid=$mem_id;
		  ?>
          
          <tr> <td>
          
             <table> 
                 <tr> <td bgcolor="#FFFFFF"><img src="./images/sca.png"> <?=$agentdetail['Agent_code']?><i class="icon ion-person icon-blue"></i> <?=$agentdetail['f_name']?> <?=$agentdetail['l_name']?> <i class="ion-star"></i>  <?=$agentdetail['agent_level']?>  <i class="icon ion-email"></i> <?=$agentdetail['email']?> <i class="icon ion-iphone"></i>  <?=$agentdetail['cel']?> <i class="icon ion-location"></i> <?=$agentdetail['city']?>  </td> </tr> 
                 
                 
                 
                 <tr><td> <?=calculatechildren($parentid); ?> </td> </tr>
                 
                 
                 
                 </table>
          
          
          
             </td> </tr>
          
          </table> 
      
      
      
      
      </td>
      <td style="width:120px;min-width:100px;background-color:#FFFFFF;">
           <table>
            <tr>
               <td><font size="+1"><b>Agent Details</b></font></td>
            </tr>
            
            <tr>
               <td ><b><?=$agentdetail['Agent_code']?></b> <br/><font color="#c500ff"> &nbsp; <?=$agentdetail['agent_level']?></font> </td>
            
            </tr>
            
             <tr>
             <td style="background-color:#FFFFFF" ><b><?=$agentdetail['f_name']?> <?=$agentdetail['l_name']?></b> <br/><?=$agentdetail['address1']?> 
             <br/><?=$agentdetail['city']?>  <?=$agentdetail['state']?> <?=$agentdetail['country']?> <?=$agentdetail['zipcode']?> </td>
            
            </tr>
            
             <tr>
             <td style="background-color:#FFFFFF" ><b>Communication</b> <br/><?=$agentdetail['email']?> 
             <br/>Cell:<?=$agentdetail['cel']?> <br/>Home: <?=$agentdetail['tel']?>  </td>
            
            </tr>
        
        
        
           </table>
      
      
      </td>
       
      
      </tr>
      
              
            
           
			
        
           
        
      </table>
    </div>          
  </div>
      
        <p><!-- ############ PAGE END-->
</p>
    </div>
  </div>
  <!-- / -->

  
  <!-- ############ SWITHCHER START-->
    <div id="switcher">
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
    </div>
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

 
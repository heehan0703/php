<?
ini_set('display_errors', '1');
session_start();
require_once('../wp-admin/include/connectdb.php');
$mem_id=$_SESSION['ISR_ID'];
//echo "dhirecndra";
$name=$_SESSION['ISR_NAME'];

if(isset($_POST['submit2']))
{    $uid =$_POST['uid'];
	$tradecode = $_POST['tradecode'];
	//echo "$tradecode";
	//var_dump($tradecode);
	
	$userid =$_POST['userid'];
	$order_status = $_POST['order_status'];
	
	mysql_query("update `trade` set order_status = '$order_status' where tradecode='$tradecode'");
 	//echo "update `trade` set order_status = '$order_status' where tradecode='$tradecode'";
	//exit();
}

$order=mysql_query("select * from trade where ISR=$mem_id order by id desc");

if($_GET['userid']){
$userid=$_GET['userid'];
$order=mysql_query("select * from trade where ISR=$mem_id and userid='$userid'");
//echo "select * from trade where ISR=$mem_id and userid=$userid";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>EBHA-ISR_ORDER LIST</title>
  <meta name="description" content="EBHA-ISR_ORDER LIST" />
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
  .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th {
    padding-left: 0px;
    padding-right: 0px;
	 

    
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
  
   <style type="text/css">
  
  .projecthead{
font-size: 100%;
}
.img1{
 height:85px; width:auto;

}

  
  @media screen and (max-width: 640px) {
  .projecthead{
font-size: 50%;
}


.img1{
width:100%; max-width:100%;
height:auto;

}
.input-cls{
width:40px;
}

}
  </style>
  
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
	<br><div align="center"><table><tr>

                              <td align="left" class="white-18"><font size="+2"><b>Order List</b></font></td>
                              
                                 </tr></table></div>

    <div id="datatable" style="width:100%; ">
      <table class="table  " style="width:100%; padding:0px; margin:0px; table-layout:fixed"  width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
              <td  style="width:7%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>  num</b></span></td>
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>Trade&nbsp;Code</b></span></td>
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>User&nbsp;Id</b></span></td>
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>Customer</b></span></td>
                   <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>Total&nbsp;Money</b></span></td>
                   <td  style="width:13%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>Ship&nbsp;Money</b></span></td>
                   <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>Pay&nbsp;Money</b></span></td>
                   <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>Pay&nbsp;Method</b></span></td>
                   <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>Details</b></span></td>
                   <td  style="width:10%;padding:0px; margin:0px;text-align:center;" ><span class="projecthead"><b>Status</b></span></td>
                    
                </tr>
            
            
            <? 
			$i=0;
			while($orderrow=mysql_fetch_array($order)){  $i++;
			
			 ?>
             <form action="" method="post" name="order<?=$i?>" >
             
                <tr>
                   <td  style="width:7%;padding:0px; margin:0px;text-align:center;"><span class="projecthead"><?=$i?></span></td>
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;"><span class="projecthead"><input  type="hidden" name='tradecode' id="tradecode" value="<?=$orderrow['tradecode']?>" /><?=$orderrow['tradecode']?></span></td>
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;"><span class="projecthead"><?=$orderrow['userid']?></span></td>
                   <td  style="width:10%;padding:0px; margin:0px;text-align:center;"><span class="projecthead"><?=$orderrow['name1']?> <?=$orderrow['name2']?></span></td>
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;"><span class="projecthead"><?=$orderrow['totalM']?></span></td>
                    <td  style="width:13%;padding:0px; margin:0px;text-align:center;"><span class="projecthead"><?=$orderrow['shipM']?></span></td>
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;"><span class="projecthead"><?=number_format($orderrow['totalM']+$orderrow['shipM']+$orderrow['shipotherM'],2)?></span></td>
                    
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;"><span class="projecthead"><?=$orderrow['paymethod']?></span></td>
                   <td  style="width:10%;padding:0px; margin:0px;text-align:center;"><span class="projecthead"><a href="order-detail.php?id=<?=$orderrow['id']?>">Details</a></span></td>
                    <td  style="width:10%;padding:0px; margin:0px;text-align:center;"><span class="projecthead"> <select name ="order_status" id ="order_status">
                                                    
                                                      <option vaule="Pending" <?php if($orderrow['order_status'] =='Pending'){ ?> selected <?php } ?>>Pending</option>
                                                      <option vaule="Paid" <?php if($orderrow['order_status'] =='Paid'){ ?> selected <?php } ?>>Paid</option>
                                                       <option vaule="Pickup" <?php if($orderrow['order_status'] =='Pickup'){ ?> selected <?php } ?>>Pickup</option>
                                                      <option vaule="Cancel" <?php if($orderrow['order_status'] =='Cancel'){ ?> selected <?php } ?>>Cancel</option>
                                                      <option value="Complete" <?php if($orderrow['order_status'] =='Complete'){ ?> selected <?php } ?>>Complete</option>
                                                        <option value="Not Paid" <?php if($orderrow['order_status'] =='Not Paid'){ ?> selected <?php } ?>>Not Paid</option>
                                                      </select>
					                                  <input type="submit" name="submit2" id="submit2" value="Update" onClick="return confirm('Are you sure you want to Update?')" /></span></td>
                    
                </tr>
            
            </form>
            <? } ?>
			
        
           
        
      </table>
    </div>          
  </div>
       <div align="center"> <p><span class="red-18" style="box-sizing: border-box; display: inline-block; width: 30px; border: 2px solid blue; line-height: 25px; text-align: center; vertical-align: middle; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space:
normal; widows: 2; word-spacing:
0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"><b style="box-sizing: border-box; font-weight: 700;">1</b></span><span style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: right; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width:
0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span></span><span class="blue-12" onClick="dhirendra(2)" style="box-sizing: border-box; display: inline-block; width: 30px; border: 2px solid black; line-height: 25px; text-align: center; vertical-align: middle; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps:
normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">&nbsp;2&nbsp;</span><span style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align:
right; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span></span><span class="blue-12" onClick="dhirendra(3)" style="box-sizing: border-box; display: inline-block; width: 30px; border: 2px solid black; line-height: 25px; text-align: center; vertical-align: middle; color: rgb(51, 51, 51); font-family: &quot;Helvetica
Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">&nbsp;3&nbsp;</span><span style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style:
normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: right; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span></span><span class="blue-12" onClick="dhirendra(4)" style="box-sizing: border-box; display: inline-block; width: 30px;
border: 2px solid black; line-height: 25px; text-align: center; vertical-align: middle; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">&nbsp;4&nbsp;</span><span
style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: right; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span></span><span
class="blue-12" onClick="dhirendra(5)" style="box-sizing: border-box; display: inline-block; width: 30px; border: 2px solid black; line-height: 25px; text-align: center; vertical-align: middle; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2;
word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">&nbsp;5&nbsp;</span><span style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: right; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color:
rgb(255, 255, 255); display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span></span><span class="blue-12" onClick="dhirendra(6)" style="box-sizing: border-box; display: inline-block; width: 30px; border: 2px solid black; line-height: 25px; text-align: center; vertical-align: middle; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight:
normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">&nbsp;6&nbsp;</span><span style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: right; text-indent:
0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); display: inline !important; float: none;"><span class="Apple-converted-space">&nbsp;</span></span><span class="blue-12" onClick="dhirendra(7)" style="box-sizing: border-box; display: inline-block; width: 30px; border: 2px solid black; line-height: 25px; text-align: center; vertical-align: middle; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica,
Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);">&nbsp;7&nbsp;</span></p></DIV>
        <p><!-- ############ PAGE END-->
</p>
    </div>
  </div>
  <!-- / -->

  
  <!-- ############ SWITHCHER START-->
   
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

</body>
</html>

 
<?
session_start();
require_once('wp-admin/include/connectdb.php');
if($_POST['email']){
$fullname=$_POST['fullname'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$job=$_POST['job'];

$num=mysql_num_rows(mysql_query("select * from newsletter_new where email='$email'"));
if($num){
$error="you have already signup in our community thanks ";
}else{

	$result=mysql_query("insert into newsletter_new set fullname='$fullname',email='$email',phone='$phone',job='$job'");
	if($result){
	header("location:welcome.php");
	}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>event-signup</title>
  <meta name="description" content="EBHA_SIGNUP" />
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
  <script language="javascript">
  function validation(){
  alert("dhirendra");
  return false;
  
  }
  
  </script>
</head>
<body>
  <div class="app" id="app">

<!-- ############ LAYOUT START-->

  <div class="padding">
    <div class="navbar">
      <div class="pull-center" style="position:absolute; left:50%; top:50%; z-index:1;">
        <!-- brand -->
        <a href="index.html" class="navbar-brand">
        	<div data-ui-include="'signup_1.jpg'"></div>
        	<img src="signup_1.jpg" alt="." width="357" height="203">
        	
        </a>
        <!-- / brand -->
      </div>
      <? if($error!=""){ ?>
     <div class="pull-center" style="position:absolute; left:50%; top:50%; z-index:1;"> <font color="#FF0000"><?=$error?> </font></div>
       <? } ?>
    </div>
  </div>
  
 
 
  <div class="b-t">
    <div class="center-block w-xxl w-auto-xs p-y-md text-center">
      <div class="p-a-md">
        
             <form name="form" action="" method="post" >
          <div class="form-group">
            <input type="Full Name" class="form-control" placeholder="Full Name" required name="fullname">
          </div>
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Email" required name="email">
          </div>
          <div class="form-group">
            <input type="Phone" class="form-control" placeholder="Phone" required name="phone">
          </div>
            <div class="form-group">
            <input type="Job" class="form-control" placeholder="Job" required name="job">
          </div>
          <div class="m-b-md text-sm">
            <span class="text-muted">By clicking Sign Up, I agree to the</span> 
            <a href="#">Terms of service</a> 
            <span class="text-muted">and</span> 
            <a href="#">Policy Privacy.</a>
          </div>
          <button type="submit" class="btn btn-lg black p-x-lg">Sign Up</button>
        </form>
       
      </div>
    </div>
  </div>

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

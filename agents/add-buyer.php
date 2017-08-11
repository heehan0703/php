<?
ini_set('display_errors', '1');
session_start();
require_once('../wp-admin/include/connectdb.php');
$mem_id=$_SESSION['ISR_ID'];
//echo "dhirecndra";
$name=$_SESSION['ISR_NAME'];
$country_query=$con_pdo->query("SELECT * FROM `country` where country_name!='' order by country_id asc");  
 $account_email = $_GET['account_email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>EBHA-ISR_ADD BUYER</title>
  <meta name="description" content="EBHA-ISR_ADD BUYER" />
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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
	.text-right {
    text-align: left !important;
}
	
}

  </style>
  
  <script language="javascript">
  function Validate(){
  
 // alert("dhirendra");

var email,pass,conf_pass,country,address1,city,zipcode,f_name,l_name,com_name,tel1,tel2,tel3,cel1,cel2,cel3,captcha1;
email=document.getElementById('email').value;
pass=document.getElementById('pass').value;
conf_pass=document.getElementById('conf_pass').value;
country=document.getElementById('country').value;
address1=document.getElementById('address1').value;
city=document.getElementById('city').value;
zipcode=document.getElementById('zipcode').value;
f_name=document.getElementById('f_name').value;
l_name=document.getElementById('l_name').value;
var social=document.getElementById('social').value;
var InstagramID=document.getElementById('InstagramID').value;
com_name=document.getElementById('com_name').value;
tel1=document.getElementById('tel1').value;
tel2=document.getElementById('tel2').value;
tel3=document.getElementById('tel3').value;

if(email==''){
alert('Please enter email!');
document.getElementById('email').focus();
return false;

}
if(pass==''){
alert('Please enter password!');
document.getElementById('pass').focus();
return false;

}
if(conf_pass==''){
alert('Please enter confirm password!');
document.getElementById('conf_pass').focus();
return false;

}
if(conf_pass!=pass){
alert('password donot match !');
document.getElementById('conf_pass').value='';
document.getElementById('conf_pass').focus();
return false;

}
if(country==''){
alert('Please select country!');
document.getElementById('country').focus();
return false;

}
if(address1==''){
alert('Please enter address1!');
document.getElementById('address1').focus();
return false;

}

if(city==''){
alert('Please enter city!');
document.getElementById('city').focus();
return false;

}if(zipcode==''){
alert('Please enter zipcode!');
document.getElementById('zipcode').focus();
return false;

}if(f_name==''){
alert('Please enter first name!');
document.getElementById('f_name').focus();
return false;

}if(social==''){
alert('Please enter the social id!');
document.getElementById('social').focus();
return false;

}if(InstagramID==''){
alert('Please enter Instagram ID!');
document.getElementById('InstagramID').focus();
return false;

}if(l_name==''){
alert('Please enter last name!');
document.getElementById('l_name').focus();
return false;

}if(tel1==''){
alert('Please enter telephone number!');
document.getElementById('tel1').focus();
return false;

}if(tel2==''){
alert('Please enter telephone number!');
document.getElementById('tel2').focus();
return false;

}if(tel3==''){
alert('Please enter telephone number!');
document.getElementById('tel3').focus();
return false;

}
if(!$("#checkbox1").is(":checked")) {
        alert("Please accept The ebhahair.com wholesale Membership Agreement");
        return false;
    }
	
	if(!$("#checkbox2").is(":checked")) {
        alert("Please accept Receive emails relating to membership and services from ebhahair.com");
        return false;
    }



}


function check_email(){

	var email=document.getElementById('email').value;

$.post( "ajax.php", { email_check:email })
.done(function( data ) {
if(data==1){
	alert('Email is already  exist !')
document.getElementById('email').value='';
document.getElementById('email').focus();
return false;



}

});

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
                <div class="navbar-item pull-left h5" id="pageTitle"></div>
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
	<br><div align="left"><table><tr>

                              <td align="left" class="white-18" style="color:#333333"><font size="+1" color="#333333"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CREATE AN ACCOUNT</b></font></td>
                              
                                 </tr></table></div>

 <div class="row form-group " style="width:96%; margin:1% 2%; background:#FFF; padding:1%;">
     
     
	 <form name="register" action="register_process_member.php"  method="post" onSubmit="return Validate()">
        <div class="col-lg-8 col-sm-12 col-xs-12 border-bottom-small text-right-small" style="">
       <div class="full" style="width:95%; margin:0em 0em 2em 1em; margin-left:3%;">
    <span style="color:#999999; font-weight:bold;" >Create Your Account</span> &nbsp;
    <span class="dotted-class" style="width:65%;"></span>
    </div>   
      
         <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> Email:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="email" name="email" id="email" value="<?=$account_email?>" class="form-control" onBlur="check_email()" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
            <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> Create Password:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="password" name="pass" id="pass" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
            <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> Re-enter Password:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="password" name="conf_pass" id="conf_pass" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
                    <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> Business Location:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
         <select name="country" id="country" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;">
  		 
		
	<?php
	  while ($country_result = $country_query->fetch(PDO::FETCH_ASSOC)) {
	?>	
	<option value="<?=$country_result['country_Id']?>" <? if($country_result['country_Id']==230){ ?>  selected  <? } ?> ><?=$country_result['country_name']?></option>
	
	<?php } ?>
	
		 </select>
      <script type="text/javascript">
			$("#country").change(function(){
			if($("#country").val()=='230'  || $("#country").val()=='45')	{
		$("#state_div").show('fast');	
				
	    	$("#state").load("get_state.php?c_id="+$("#country").val());
			
			}
			else{
		$("#state_div").hide('fast');		
			}
						});		

                                       </script>       
          </div>
          </div>
           <div class="full" id="state_div" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"> </div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
        <select name="state" id="state" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
        <? $query= mysql_query("select * from state where country_id='230'");  ?>
       <?  while($state_row=mysql_fetch_assoc($query)){ ?>
<option value="<?=$state_row['state_id']?>" <? if($st_id==$state_row['state_id']){?> selected="selected"<? } ?> >
<?=$state_row['state_name']?></option>	 
 <? } ?>
	
		</select>
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> Address:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="text" name="address1" id="address1" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"> Address 2:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="text" name="address2" id="address2" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> City:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="text" name="city" id="city" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> Zipcode:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="text" name="zipcode" id="zipcode" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
          <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> I am a:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
         <input type="radio" name="i_am" value="Agent" class="radio-inline" checked="checked" >An Agent
          <input type="radio" name="i_am" value="EBHA Member" class="radio-inline" >General Buyer
          </div>
          </div>
    <div class="full" style="width:95%; margin:3em 0em 2em 1em; margin-left:3%;">
    <span style="color:#999999; font-weight:bold;" >Add Your Contact Information</span> &nbsp;
    <span class="dotted-class" style="width:65%;"></span>
    </div>   
       
        <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> Contact Name:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12"><table><tr><td>
       <input type="text" class="input-group-sm" name="f_name" id="f_name" placeholder="First Name"  ></td><td><input type="text" class="input-group-sm" name="l_name" id="l_name" placeholder="Last Name" ></td></tr></table>
          </div>
          </div>
          
          
        <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup></sup> Company Name:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
       <input type="text" name="com_name" id="com_name" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
       
          </div>
          </div>
          
          
          <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> Social#:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
       <input type="text" name="social" id="social" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
       
          </div>
          </div>
          
          <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> Instagram ID:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
       <input type="text" name="InstagramID" id="InstagramID" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
       
          </div>
          </div>
          
          <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup></sup> Referral Person:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
       <input type="text" name="ReferralPerson" id="ReferralPerson" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
       
          </div>
          </div>
          
          
          
          
            <div class="full" style="margin:.9em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> Tel:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12"><input type="text" name="tel1" id="tel1" class="input-xm" >-<input type="text" name="tel2" id="tel2" class="input-xm" placeholder="">- 
	  <input type="text" name="tel3" id="tel3" class="input-group-sm" placeholder=""></table>       
          </div>
          </div>
         
          <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"> Cell:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
       <input type="text" name="cel1" id="cel1" class="input-xm" >-<input type="text" name="cel2" id="cel2" class="input-xm" placeholder="">- 
	   <input type="text" name="cel3" id="cel3" class="input-group-sm" placeholder="">       
          </div>
          </div>  
        
        <div class="full" style="margin:.7em 0;">
          
      <div class="full text-center">
        <div class="col-lg-4 col-sm-12 col-xs-12 text-right"></div>
           <div class="col-lg-8 col-sm-12 col-xs-12 text-left" style="padding:.5em 0;">
      <input type="submit" value="Create Agent Account" name="submit" class="blue-btn">
      </div>
      </div> 
          
        <div class="full text-center">
        <div class="col-lg-4 col-sm-12 col-xs-12 text-right"></div>
           <div class="col-lg-8 col-sm-12 col-xs-12 text-left" style="padding:0px;">
     Upon creating my account I agree to:<br>
     <input type="checkbox" class="checkbox-inline" id="checkbox1" checked><span style="color:#429AC2; cursor:pointer;" onClick="ask_supplier();">The Ebha wholesale Membership Agreement ;</span>
   <br>
      <input type="checkbox" class="checkbox-inline" id="checkbox2" checked> Receive emails relating to membership and services from  <span style="color:#429AC2;">Ebha</span>
     
      </div>
      </div>   
          
        </div>
    </form>
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
  <script language="javascript">
  
  function ask_supplier(){
    jQuery("#overlay-mask-3").fadeIn('slow');
}

function close_popup(id){
 //$(".overlay-mask").fadeOut('slow');	
 $("#"+id).fadeOut('slow');
}	
  </script>
<!-- endbuild -->


<!-- register alert-->
<div id="overlay-mask-3" class="overlay-mask" style="">
  <div class="overlay iframe-content" style="border:5px solid #fff; font-size:1.2em; width:50%">
  <a class="close close-icon" onClick="close_popup('overlay-mask-3')">
  <span id="close_button" style="margin-left:0.5em;">X</span></a>
   
 <div class="container" style="padding:1em;">
<div class="full"> 
<h1>Conditions of Use</h1>
<hr>

<p>Welcome to ebhahair.com.  Wholesale Services LLC and/or its affiliates ("ebhahair Wholesale") provide website features and other products and services to you when you visit or shop at ebhahair.com, use ebhahair.com Wholesale products or services, use ebhahair Wholesale applications for mobile, or use software provided by ebhahair Wholesale in connection with any of the foregoing (collectively, " Wholesale Services").  Wholesale provides the  Wholesale Services subject to the following conditions.</p>
<h4>By using  Wholesale Services, you agree to these conditions. Please read them carefully.</h4>
<p>We offer a wide range of  Wholesale Services, and sometimes additional terms may apply. When you use an Wholesale Service you also will be subject to the guidelines, terms and agreements applicable to that  Wholesale Service ("Service Terms"). If these Conditions of Use are inconsistent with the Service Terms, those Service Terms will control.</p>
<h3>PRIVACY</h3>
<p>Please review our Privacy Notice, which also governs your use of  Wholesale Services, to understand our practices.</p>
<h3>ELECTRONIC COMMUNICATIONS</h3>
<p>When you use any  Wholesale Service, or send e-mails to us, you are communicating with us electronically. You consent to receive communications from us electronically. We will communicate with you by e-mail or by posting notices on this site or through the other  Wholesale Services. You agree that all agreements, notices, disclosures and other communications that we provide to you electronically satisfy any legal requirement that such communications be in writing.</p>
<h3>COPYRIGHT</h3>
<p>All content included in or made available through any  Wholesale Service, such as text, graphics, logos, button icons, images, audio clips, digital downloads, and data compilations is the property of  Wholesale or its content suppliers and protected by United States and international copyright laws. The compilation of all content included in or made available through any  Wholesale Service is the exclusive property of  Wholesale and protected by U.S. and international copyright laws.</p>
<h3>TRADEMARKS</h3>
<p>Graphics, logos, page headers, button icons, scripts, and service names included in or made available through any  Wholesale Service are trademarks or trade dress of  Wholesale in the U.S. and other countries.  Wholesale's trademarks and trade dress may not be used in connection with any product or service that is not  Wholesale's, in any manner that is likely to cause confusion among customers, or in any manner that disparages or discredits  Wholesale. All other trademarks not owned by  Wholesale that appear in any  Wholesale Service are the property of their respective owners, who may or may not be affiliated with, connected to, or sponsored by  Wholesale.</p>
<h3>PATENTS</h3>
<p>One or more patents owned by  Wholesale apply to the  Wholesale Services and to the features and services accessible via the  Wholesale Services. Portions of the  Wholesale Services operate under license of one or more patents</p>
<h3>REVIEWS, COMMENTS, COMMUNICATIONS, AND OTHER CONTENT</h3>
<p>Visitors may post reviews, comments, photos, and other content; send e-cards and other communications; and submit suggestions, ideas, comments, questions, or other information, so long as the content is not illegal, obscene, threatening, defamatory, invasive of privacy, infringing of intellectual property rights, or otherwise injurious to third parties or objectionable and does not consist of or contain software viruses, political campaigning, commercial solicitation, chain letters, mass mailings, or any form of "spam." You may not use a false e-mail address, impersonate any person or entity, or otherwise mislead as to the origin of a card or other content.  Wholesale reserves the right (but not the obligation) to remove or edit such content, but does not regularly review posted content.</p>
<p>If you do post content or submit material, and unless we indicate otherwise, you grant  Wholesale a nonexclusive, royalty-free, perpetual, irrevocable, and fully sublicensable right to use, reproduce, modify, adapt, publish, translate, create derivative works from, distribute, and display such content throughout the world in any media. You grant  Wholesale and sublicensees the right to use the name that you submit in connection with such content, if they choose. You represent and warrant that you own or otherwise control all of the rights to the content that you post; that the content is accurate; that use of the content you supply does not violate this policy and will not cause injury to any person or entity; and that you will indemnify  Wholesale for all claims resulting from content you supply.</p><p>  Wholesale has the right but not the obligation to monitor and edit or remove any activity or content.  Wholesale takes no responsibility and assumes no liability for any content posted by you or any third party.</p>
<h3>COPYRIGHT COMPLAINTS</h3>
<p> Wholesale respects the intellectual property of others.
 If you believe that your work has been copied in a way that constitutes copyright infringement, 
 please follow our <span style="color: #03C"> Notice and Procedure for Making Claims of Copyright Infringement.</span></p>
<h3>RISK OF LOSS</h3>
<p>All items purchased from  Wholesale are made pursuant to a shipment contract. This means that the risk of loss and title for such items pass to you upon our delivery to the carrier.</p>
<h3>RETURNS& REFUNDS</h3>
<p>Buyer may return most new, unopened items within 30 days of delivery for a full refund.  Wholesale also pay the return shipping costs if the return is a result of our error (you received an incorrect or defective item, etc.).</p>
<p>If buyer is shipping from abroad you must ensure that the customs form indicates you are "Returning Product for Exchange or Repair." We will not be liable for any customs charge for returned items. If items are sent back with customs charges they NOT be accepted/collected from the delivery company in possession.</p>
<p>You should expect to receive your refund within four weeks of giving your package to the return shipper, however, in many cases you will receive a refund more quickly. This time period includes the transit time for us to receive your return from the shipper (5 to 10 business days), the time it takes us to process your return once we receive it (3 to 5 business days), and the time it takes your bank to process our refund request (5 to 10 business days).</p>
<p>If you need to return an item, simply login to your account, view the order using the "Complete Orders" link under the My Account menu and click the Return Item(s) button. We'll notify you via e-mail of your refund once we've received and processed the returned item.</p>
<p>To return an item: You need to sign into your account and click on the "completed orders" tab. There you can request a return through the automated system. All returns are required to go through this process before returning to  Wholesale. You will receive an automated email with the return address and reference number.</p><p> Any returns without this authorisation will be rejected. Your name and order number must be with the package to process the return.</p>
<h3>PRODUCT DESCRIPTIONS</h3>
<p> Wholesale attempts to be as accurate as possible. However,  Wholesale does not warrant that product descriptions or other content of any  Wholesale Service is accurate, complete, reliable, current, or error-free. If a product offered by  Wholesale itself is not as described, your sole remedy is to return it in unused condition.</p>
<h3>PRICING</h3>
<p>Except where noted otherwise, the Manufacturer’s Suggested Retail Price “MSRP”displayed for products on any  Wholesale Service represents the full retail price listed on the product itself, suggested by the manufacturer or supplier, or estimated in accordance with standard industry practice; or the estimated retail value for a comparably featured item offered elsewhere.</p><p> The MSRP is a comparative price estimate and may or may not represent the prevailing price in every area on any particular day.</p><p> For certain items that are offered as a set, the MSRP may represent "open-stock" prices, which means the aggregate of the manufacturer's estimated or suggested retail price for each of the items included in the set. Where an item is offered for sale by one of our merchants, the MSRP may be provided by the merchant.</p>
<p>With respect to items sold by  Wholesale, Wholesale price will be displayed with verified account, such as Business owner’s account or Distributer’s account.</p><p> Wholesale price also will be determined by manufacture and  Wholesale does not have or own authority to change the price. Despite our best efforts, a small number of the items in our catalog may be mispriced. If the correct price of an item sold by  Wholesale is higher than our stated price, we will, at our discretion, either contact you for instructions before shipping or cancel your order and notify you of such cancellation. Other merchants may follow different policies in the event of a mispriced item.</p>
<p>We generally do not charge your credit card until after your order has entered the shipping process or, for digital products, until we make the digital product available to you.</p>
<h3>CUSTOM ORDER</h3>
<p>Each buyer or business owner with verified account is able to request Custom Order to the manufacture. Minimum quantity is required for 1000 item for each custom order and if the manufacture accepts the order,  Wholesale will send a confirmation letter to who request the order.</p><p> The entire process will be taken at least two or three month for delivery depends on the manufacture’s ability. During this process,  Wholesale will update every progress to the buyer or business owner each time. </p>
<h3>BULK ORDER</h3>
<p>Bulk Order is an option for buyers or business owner who already have purchased large amount of product and for convenient usage, buyers are available to order large amount of product by uploading the suggested document file to  Wholesale web server.</p> 
<h3>SAMPLE ORDER</h3>
<p>Buyer or business owner members are able to request each samples with no minimum order required.</p> 
<h3 style="color:#F00">DROPSHIP REQUEST</h3>

<h3>SHIPPING,</h3> 
<p> Wholesale can ship to virtually any address in the world. Note that there are restrictions on some products, and some products cannot be shipped to international destinations.When Buyer or Business owner members place an order,  Wholesale will get a real-time shipping quotes and delivery dates for you based on the availability of your items and the shipping options you choose.</p><p> Depending on the shipping provider you choose, shipping date estimates may appear on the shipping quotes page.</p>
<p>Please also note that the shipping rates for many items we sell are weight-based. The weight of any such item can be found on its detail page. To reflect the policies of the shipping companies we use, all weights will be rounded up to the next full 100 grams.</p>
<h3> WHOLESALE SOFTWARE TERMS</h3>
<p>In addition to these Conditions of Use, the terms found here apply to any software (including any updates or upgrades to the software and any related documentation) that we make available to you from time to time for your use in connection with  Wholesale Services (the " Wholesale Software").<p>
<h3>OTHER BUSINESSES</h3>
<p>Parties other than  Wholesale operate stores, provide services, or sell product lines on this site. In addition, we provide links to the sites of affiliated companies and certain other businesses.</p><p> We are not responsible for examining or evaluating, and we do not warrant the offerings of, any of these businesses or individuals or the content of their Web sites.</p><p>  Wholesale does not assume any responsibility or liability for the actions, product, and content of all these and any other third parties.</p><p> You should carefully review their privacy statements and other conditions of use.</p>
<span style="color:#F00">
<h3>DISCLAIMER OF WARRANTIES AND LIMITATION OF LIABILITY</h3>
<p>THE  WHOLESALE SERVICES AND ALL INFORMATION, CONTENT, MATERIALS, PRODUCTS (INCLUDING SOFTWARE) AND OTHER SERVICES INCLUDED ON OR OTHERWISE MADE AVAILABLE TO YOU THROUGH THE  WHOLESALE SERVICES ARE PROVIDED BY  WHOLESALE ON AN "AS IS" AND "AS AVAILABLE" BASIS, UNLESS OTHERWISE SPECIFIED IN WRITING.  WHOLESALE MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND, EXPRESS OR IMPLIED, AS TO THE OPERATION OF THE  WHOLESALE SERVICES, OR THE INFORMATION, CONTENT, MATERIALS, PRODUCTS (INCLUDING SOFTWARE) OR OTHER SERVICES INCLUDED ON OR OTHERWISE MADE AVAILABLE TO YOU THROUGH THE  WHOLESALE SERVICES, UNLESS OTHERWISE SPECIFIED IN WRITING. YOU EXPRESSLY AGREE THAT YOUR USE OF THE  WHOLESALE SERVICES IS AT YOUR SOLE RISK.</p><p>
TO THE FULL EXTENT PERMISSIBLE BY APPLICABLE LAW,  WHOLESALE DISCLAIMS ALL WARRANTIES, EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE.</p><p>  WHOLESALE DOES NOT WARRANT THAT THE  WHOLESALE SERVICES, INFORMATION, CONTENT, MATERIALS, PRODUCTS (INCLUDING SOFTWARE) OR OTHER SERVICES INCLUDED ON OR OTHERWISE MADE AVAILABLE TO YOU THROUGH THE  WHOLESALE SERVICES,  WHOLESALE'S SERVERS OR ELECTRONIC COMMUNICATIONS SENT FROM  WHOLESALE ARE FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS.</p><p>  WHOLESALE WILL NOT BE LIABLE FOR ANY DAMAGES OF ANY KIND ARISING FROM THE USE OF ANY  WHOLESALE SERVICE, OR FROM ANY INFORMATION, CONTENT, MATERIALS, PRODUCTS (INCLUDING SOFTWARE) OR OTHER SERVICES INCLUDED ON OR OTHERWISE MADE AVAILABLE TO YOU THROUGH ANY  WHOLESALE SERVICE, INCLUDING, BUT NOT LIMITED TO DIRECT, INDIRECT, INCIDENTAL, PUNITIVE, AND CONSEQUENTIAL DAMAGES, UNLESS OTHERWISE SPECIFIED IN WRITING.</p><p>
CERTAIN STATE LAWS DO NOT ALLOW LIMITATIONS ON IMPLIED WARRANTIES OR THE EXCLUSION OR LIMITATION OF CERTAIN DAMAGES.<p><p> IF THESE LAWS APPLY TO YOU, SOME OR ALL OF THE ABOVE DISCLAIMERS, EXCLUSIONS, OR LIMITATIONS MAY NOT APPLY TO YOU, AND YOU MIGHT HAVE ADDITIONAL RIGHTS.<p>
<h3>DISPUTES</h3>
<h2>
Any dispute or claim relating in any way to your use of any  Wholesale Service, or to any products or services sold or distributed by  Wholesale or through .com will be resolved by binding arbitration, rather than in court, except that you may assert claims in small claims court if your claims qualify.</h2><p> The Federal Arbitration Act and federal arbitration law apply to this agreement.</p>
<h2>There is no judge or jury in arbitration, and court review of an arbitration award is limited. However, an arbitrator can award on an individual basis the same damages and relief as a court (including injunctive and declaratory relief or statutory damages), and must follow the terms of these Conditions of Use as a court would.</h2>
<p>To begin an arbitration proceeding, you must send a letter requesting arbitration and describing your claim to our registered agent Corporation Service Company____________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________
We each agree that any dispute resolution proceedings will be conducted only on an individual basis and not in a class, consolidated or representative action. If for any reason a claim proceeds in court rather than in arbitration we each waive any right to a jury trial. We also both agree that you or we may bring suit in court to enjoin infringement or other misuse of intellectual property rights.</p>
<h3>APPLICABLE LAW</h3>
<p>By using any  Wholesale Service, you agree that the Federal Arbitration Act, applicable federal law, and the laws of the state of Washington, without regard to principles of conflict of laws, will govern these Conditions of Use and any dispute of any sort that might arise between you and  Wholesale.</p>
<h3>SITE POLICIES, MODIFICATION, AND SEVERABILITY</h3>
<p>Please review our other policies, such as our pricing policy, posted on this site. These policies also govern your use of  Wholesale Services. We reserve the right to make changes to our site, policies, Service Terms, and these Conditions of Use at any time. If any of these conditions shall be deemed invalid, void, or for any reason unenforceable, that condition shall be deemed severable and shall not affect the validity and enforceability of any remaining condition.</p>
</span>
<p>https://www.ebhahair.com</p>


 </div>

 </div>
 
 </div>
 </div>

</body>
</html>

 
<?
ini_set('display_errors', '1');
session_start();
require_once('../wp-admin/include/connectdb.php');

if($_GET['id']){
$buyerid=$_GET['id'];
$resultbuyer=mysql_fetch_array(mysql_query("select * from member where member_id='$buyerid'"));
$tel = explode('-', $resultbuyer['tel']);
$cel = explode('-', $resultbuyer['cel']);
}
$countryid=$resultbuyer['country'];
$stateresult=mysql_query("SELECT * FROM `state` where country_id='$countryid'"); 
$mem_id=$_SESSION['ISR_ID'];
//echo "dhirecndra";
$name=$_SESSION['ISR_NAME'];
$country_query=$con_pdo->query("SELECT * FROM `country` where country_name!='' order by country_id asc");  
 $account_email = $_GET['account_email'];
 
  if(isset($_POST['email']) && $_POST['email']!='' && $_POST['pass']==$_POST['conf_pass']){ 
  

  
  $email=$_POST['email'];
  $pass =$_POST['pass'];
  $country =$_POST['country'];
  $state=$_POST['state'];
 
  $address1 =$_POST['address1'];
  $address2 =$_POST['address2'];
  $city =$_POST['city'];
  $zipcode = $_POST['zipcode'];
  $f_name = $_POST['f_name'];
  $l_name = $_POST['l_name'];
  $com_name =$_POST['com_name'];
  $tel =$_POST['tel1'].'-'.$_POST['tel2'].'-'.$_POST['tel3'];
  $cel =$_POST['cel1'].'-'.$_POST['cel2'].'-'.$_POST['cel3']; 
  $i_am = $_POST['i_am'];
  $time=time();
  
 
 $stmt=$con_pdo->prepare("update member set `f_name`=:f_name, `l_name`=:l_name, `email`=:email, `pwd`=:pwd, `address1`=:address1, `address2`=:address2, `city`=:city, `state`=:state, `country`=:country, `zipcode`=:zipcode, `i_am`=:i_am, `company_name`=:company_name, `tel`=:tel, `cel`=:cel, `registered_date`=:time,`ISR`=:ISR where member_id=:buyer_id");
 
 

 $stmt->bindParam(':f_name',$f_name);
 $stmt->bindParam(':l_name',$l_name);
 $stmt->bindParam(':email',$email);
 $stmt->bindParam(':pwd',$pass);
 $stmt->bindParam(':address1',$address1);
 $stmt->bindParam(':address2',$address2);
 $stmt->bindParam(':city',$city);
  $stmt->bindParam(':buyer_id',$buyerid);
 
 
 
 if($_POST['state']!=''){
 
 $stmt->bindParam(':state',$state);
 }
 else{
$stmt->bindParam(':state',$state='');	 
 }
 
 $stmt->bindParam(':country',$country);
 $stmt->bindParam(':zipcode',$zipcode);
 $stmt->bindParam(':i_am',$i_am);
 $stmt->bindParam(':company_name',$com_name);
 $stmt->bindParam(':tel',$tel);
 $stmt->bindParam(':cel',$cel);
 $stmt->bindParam(':time',$time);
 $stmt->bindParam(':ISR',$mem_id);
 $stmt->execute();
 header("location:buyer-list.php");
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>aside - Bootstrap 4 web application</title>
  <meta name="description" content="Responsive, Bootstrap, BS4" />
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
    text-align: left;
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

}if(l_name==''){
alert('Please enter last name!');
document.getElementById('l_name').focus();
return false;

}if(com_name==''){
alert('Please enter company name!');
document.getElementById('com_name').focus();
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
                <div class="navbar-item pull-left h5" id="pageTitle">&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</div>
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
     
     
	 <form name="register" action=""  method="post" onSubmit="return Validate()">
        <div class="col-lg-8 col-sm-12 col-xs-12 border-bottom-small text-right-small" style="border-right:1px solid #EEEEEE;">
       <div class="full" style="width:95%; margin:0em 0em 2em 1em; margin-left:3%;">
    <span style="color:#999999; font-weight:bold;" >Create Your Account</span> &nbsp;
    <span class="dotted-class" style="width:65%;"></span>
    </div>   
      
         <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> Email:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="email" name="email" id="email" value="<?=$resultbuyer['email']?>" class="form-control" onBlur="check_email()" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" >
          </div>
          </div>
            <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> Create Password:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="password" name="pass" id="pass" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" value="<?=$resultbuyer['pwd']?>" >
          </div>
          </div>
            <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> Re-enter Password:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="password" name="conf_pass" id="conf_pass" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" value="<?=$resultbuyer['pwd']?>" >
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> Business Location:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
         <select name="country" id="country" class="form-control" style="width:80%; ">
	 
		
	<?php
	  while ($country_result = $country_query->fetch(PDO::FETCH_ASSOC)) {
	?>	
	<option value="<?=$country_result['country_Id']?>" <? if($country_result['country_Id']==$resultbuyer['country']){ ?> selected <? } ?> ><?=$country_result['country_name']?></option>
	
	<?php } ?>
	
		 </select>
      <script type="text/javascript">
			$("#country").change(function(){
			if($("#country").val()=='230'  || $("#country").val()=='45')	{
		$("#state_div").show('fast');	
				
	    	$("#state").load("../get_state.php?c_id="+$("#country").val());
			
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
        <select name="state" id="state" class="form-control" style="width:80%; " >
        <? while($rowstate=mysql_fetch_array($stateresult)) {?>
<option value="<?=$rowstate['state_id']?>" <? if($rowstate['state_id']==$resultbuyer['state']) { ?> selected <? } ?>><?=$rowstate['state_name']?></option>

    <? } ?>		
		</select>
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> Address:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="text" name="address1" id="address1" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" value="<?=$resultbuyer['address1']?>" >
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"> Address 2:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="text" name="address2" id="address2" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" value="<?=$resultbuyer['address2']?>" >
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> City:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="text" name="city" id="city" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" value="<?=$resultbuyer['city']?>">
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> Zipcode:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
            <input type="text" name="zipcode" id="zipcode" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" value="<?=$resultbuyer['zipcode']?>" >
          </div>
          </div>
          <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> I am a:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
         <input type="radio" name="i_am" value="Wholesaler" class="radio-inline" <? if($resultbuyer['i_am']=="Wholesaler"){ ?> checked="checked" <? } ?> >Wholesaler  
          <input type="radio" name="i_am" value="Salon" class="radio-inline" <? if($resultbuyer['i_am']=="Salon"){ ?> checked="checked" <? } ?> >Salon
          </div>
          </div>
    <div class="full" style="width:95%; margin:3em 0em 2em 1em; margin-left:3%;">
    <span style="color:#999999; font-weight:bold;" >Add Your Contact Information</span> &nbsp;
    <span class="dotted-class" style="width:65%;"></span>
    </div>   
       
        <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> Contact Name:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12"><table><tr><td>
       <input type="text" class="input-group-sm" name="f_name" id="f_name" placeholder="First Name"  value="<?=$resultbuyer['f_name']?>" ></td><td><input type="text" class="input-group-sm" name="l_name" id="l_name" placeholder="Last Name" value="<?=$resultbuyer['l_name']?>" ></td></tr></table>
          </div>
          </div>
           <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> Company Name:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
       <input type="text" name="com_name" id="com_name" class="form-control" style="width:80%; float:left;border-radius: 3px 0px 0px 3px;" value="<?=$resultbuyer['company_name']?>" >
       
          </div>
          </div>
          
            <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"><sup><img src="../images/star_red.png" ></sup> Tel:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12"><input type="text" name="tel1" id="tel1" class="input-xm" value="<?=$tel[0]?>" >-<input type="text" name="tel2" id="tel2" class="input-xm" placeholder="Area" value="<?=$tel[1]?>">- 
	  <input type="text" name="tel3" id="tel3" class="input-group-sm" placeholder="Number" value="<?=$tel[2]?>"></table>       
          </div>
          </div>
         
          <div class="full" style="margin:.7em 0;">
          <div class="col-lg-4 col-sm-12 col-xs-12 text-right"> Cell:</div>
          <div class="col-lg-8 col-sm-12 col-xs-12">
       <input type="text" name="cel1" id="cel1" class="input-xm" value="<?=$cel[0]?>" >-<input type="text" name="cel2" id="cel2" class="input-xm" placeholder="Area" value="<?=$cel[0]?>">- 
	   <input type="text" name="cel3" id="cel3" class="input-group-sm" placeholder="Number" value="<?=$cel[0]?>">       
          </div>
          </div>  
        
        <div class="full" style="margin:.7em 0;">
          
      <div class="full text-center">
        <div class="col-lg-4 col-sm-12 col-xs-12 text-right"></div>
           <div class="col-lg-8 col-sm-12 col-xs-12 text-left" style="padding:.5em 0;">
      <input type="submit" value="edit an  Account" name="submit" class="blue-btn">
      </div>
      </div> 
          
        <div class="full text-center">
        <div class="col-lg-4 col-sm-12 col-xs-12 text-right"></div>
           
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
<!-- endbuild -->

</body>
</html>

 
<?
session_start();

require_once('include/connectdb.php');
$error=false;

if(isset($_POST['username'])){
$username=$_POST['username'];
$pass=$_POST['pass'];

$query=$con_pdo->prepare("select * from admin where admin_Id=:admin_id and admin_Pwd=:admin_pwd");

$query->bindParam(":admin_id",$username);
$query->bindParam(":admin_pwd",$pass);
$query->execute();

if($query->rowCount()>0){

$admin_row=$query->fetch(PDO::FETCH_BOTH);

$_SESSION['ADMIN_ID']=$admin_row['idx'];
$_SESSION['ADMIN_NAME']=$admin_row['admin_Id'];
//print_r($_SESSION);
//session_register("ADMIN_ID");
header("location:index.php");

}
else{
$error=true;	
}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin-Login form</title>
<link href="style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function validate_form(){
var username=document.getElementById('username').value;
var pass=document.getElementById('pass').value;

if(username==''){
alert('Please enter user name !');
document.getElementById('username').focus();
return false;
}
if(pass==''){
alert('Please enter password !');
document.getElementById('pass').focus();
return false;
}

	
}
</script>
<style type="text/css">
.border{
	background:#EFEFEF;
	border:0px;
	width:200px;
}
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top" class="loginform-bg"><table width="332" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="images/specer.png" width="1" height="240" /></td>
      </tr>
      <tr>
        <td><form id="form1" name="form1" method="post" action="">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><? if($error==true){?>
                <table width="328" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="loginform-drk-bl-br"><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><img src="images/icon-3.png" width="17" height="14" /><strong><span class="orng-11">&nbsp;Access Denied</span></strong><span class="litegry-10"> | username/password combination wrong</span></td>
                      </tr>
                    </table></td>
                  </tr>
                </table>
                <? } ?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><table width="328" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td colspan="3" height="55">
                  <img src="images/admin_icon.jpg" width="100%"/>
                  </td>
                </tr>
                <tr>
                  <td width="8" class="loginform-lft">&nbsp;</td>
                  <td width="310" class="loginform-mid"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                    <tr>
                      <td width="76" align="left" class="drkgry-12"><strong>Username:</strong></td>
                      <td colspan="2" align="left" class="loginform-textbx"><label for="textfield"></label>
                        <span class="lite-gry-br">
                          <input type="text" name="username" id="username" class="border"  />
                        </span></td>
                    </tr>
                    <tr>
                      <td align="left" class="drkgry-14"><strong class="drkgry-12">Password:</strong></td>
                      <td colspan="2" align="left" class="loginform-textbx"><span class="lite-gry-br-2">
                        <input type="password" name="pass" id="pass" class="border" />
                      </span></td>
                    </tr>
                   
                  </table></td>
                  <td width="10" class="loginform-rite">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top"><img src="images/loginfrom-corner-3.png" width="8" height="19" /></td>
                  <td class="loginform-butm"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="28%">&nbsp;</td>
                      <td width="26%"><input type="image" src="images/submit.png" width="80" height="27" onClick="javascript:
                      return validate_form(); "></td>
                      <td width="15%" align="center" valign="top"><!--<a href="#"><img src="images/back.png" width="38" height="21" /></a>--></td>
                      <td width="31%" align="left" valign="top"><!--<a href="fpass.php"><img src="images/forgotpassword.png" width="71" height="21" /></a>--></td>
                    </tr>
                  </table></td>
                  <td valign="top"><img src="images/loginfrom-corner-4.png" width="8" height="19" /></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
        </form></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

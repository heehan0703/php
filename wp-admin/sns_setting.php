<?php

session_start();

require_once('include/connectdb.php');




if($_SESSION["ADMIN_ID"]==""){
	
header("location:login.php");	
	
	exit;
	 } 
	 
	 if(isset($_POST['facebook']) && $_POST['twitter']!='' && $_POST['pinterest']!='' && $_POST['facebook']!='' &&
	  $_POST['instagram']!='' && $_POST['youtube']!=''){
		//facebook_link twitter_link youtube_link pinterest_link instagram_link
		$facebook = $_POST['facebook'];
		$twitter = $_POST['twitter'];
		$pinterest = $_POST['pinterest'];
		$instagram = $_POST['instagram'];
		$youtube = $_POST['youtube'];
		
	mysql_query("update admin set facebook_link='$facebook',twitter_link='$twitter',youtube_link='$youtube',pinterest_link='$pinterest',instagram_link='$instagram' 
	where idx=1 ");	
	
	}
	
	
	 
	$admin_row = mysql_fetch_assoc(mysql_query("SELECT * FROM `admin` where idx=1"));

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>SNS Setting</title>

<link href="style/style.css" rel="stylesheet" type="text/css" />
<link href="style/design.css" rel="stylesheet" type="text/css"  />

<style type="text/css">
table#t01 tr:nth-child(even) {
    background-color: #eee;
}
table#t01 tr:nth-child(odd) {
   background-color:#fff;
}

table#t02 tr:nth-child(even) {
    background-color: #eee;
}
table#t02 tr:nth-child(odd) {
   background-color:#fff;
}

</style>



</head>



<body style="font-size:16px;">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td><? include('header.php')?></td>

  </tr>

  <tr>

    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td width="20%" valign="top"><? include('left_menu.php');?></td>

        <td width="60%" valign="top"><table width="100%" border="0" cellspacing="10" cellpadding="0">
		      <tr>
			  <td><table width="100%" border="0" cellspacing="10" cellpadding="0">
			       <tr>
				       <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				    <tr>
               <td style="color:#CCC;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			        <tr>
                        <td width="100%"><table width="100%" border="0" cellspacing="0" cellpadding="0"
                          style="background-color:#CCC;">
						          <tr>
                                   <td align="left" style="color:#333; font-size:24px;">SNS Setting</a></span></td>

                                   </tr>
                          </table></td>
                          

                     </tr>

                     <tr>

                           <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                              <tr>

                                 <td colspan="7"></td>
                              
                       
                               </tr>

                              <tr>
                                 <td><table width="100%" id="t01" cellpadding="3" cellspacing="3" border="0" style="color:#333;">                           <form action="" method="post">
                                  
      <tr> <td>Facebook</td><td><input type="text" name="facebook" id="facebook" value="<?=$admin_row['facebook_link']?>" /> </td></tr>
    <tr><td>Twitter</td><td><input type="text" name="twitter" id="twitter" value="<?=$admin_row['twitter_link']?>" /></td></tr>
   <tr><td>Youtube</td><td><input type="text" name="youtube" id="youtube" value="<?=$admin_row['youtube_link']?>" /></td></tr>
  <tr><td>Pinterest</td><td><input type="text" name="pinterest" id="pinterest" value="<?=$admin_row['pinterest_link']?>" /></td></tr>
    <tr><td>Instagram</td><td><input type="text" name="instagram" id="instagram" value="<?=$admin_row['instagram_link']?>" /></td></tr>
     <tr><td colspan="2" align="center"><input type="submit" value="Save Change" name="submit" /></td></tr>
                                </form>
                              </table>
                      </td>
                      </tr>
                                        
                          

                            <tr>

                              <td colspan="10">&nbsp;</td>

                            </tr>

                            <tr>

                              <td colspan="7"><table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
                                	<td colspan="2" align="left">
                                   <font size="+2"> <?php // echo leftpaging(); ?> </font>
                                    </td>
                                </tr>					
                               

                              </table></td>

                            </tr>

                          </table></td>

                          <td >&nbsp;</td>

                        </tr>

                        <tr>

                          <td >&nbsp;</td>

                       <td  align="left"></td>

                        </tr>

                      </table></td>

                    </tr>

                  </table></td>

                </tr>

                <tr>

                  <td>&nbsp;</td>

                </tr>

              </table>

           </td>

          </tr>

          <tr>

            <td>&nbsp;</td>

          </tr>

        </table></td>
       </tr>

   

  
  

  <tr>

    <td><? include('footer.php')?></td>

  </tr>

</table>


</body>

</html>


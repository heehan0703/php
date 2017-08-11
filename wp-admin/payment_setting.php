<?php

session_start();

require_once('include/connectdb.php');




if($_SESSION["ADMIN_ID"]==""){
	
header("location:login.php");	
	
	exit;
	 } 
	 
	if(isset($_POST['tran_key']) && $_POST['tran_key']!='' && $_POST['paypal_id']!='' && $_POST['shop_id']){
		
		$tran_key = $_POST['tran_key'];
		$paypal_id = $_POST['paypal_id'];
		$shop_id = $_POST['shop_id'];
	mysql_query("update admin set txnKey='$tran_key',paypalEmail='$paypal_id',shopId='$shop_id' where idx=1 ");	
	
	}
	
	$admin_row = mysql_fetch_assoc(mysql_query("SELECT * FROM `admin` where idx=1"));


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Payment Setting</title>

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
                                   <td align="left" style="color:#333; font-size:24px;">Payment Setting</a></span></td>

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
                                  <tr><th colspan="2" align="center">Credit Card</th></tr>
           <tr> <td>Shop Id</td><td><input type="text" name="shop_id" id="shop_id" value="<?=$admin_row['shopId']?>" /> </td></tr>
         <tr><td>Transaction Key</td><td><input type="text" name="tran_key" id="tran_key" value="<?=$admin_row['txnKey']?>" /></td></tr>
       <tr><td>Paypal Id</td><td><input type="text" name="paypal_id" id="paypal_id" value="<?=$admin_row['paypalEmail']?>" /></td></tr>
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


<?php

session_start();

require_once('include/connectdb.php');



echo $userid;

if($_SESSION["ADMIN_ID"]==""){
	
header("location:login.php");	
	
	exit;
	 } 
	/* 
	  $limit=16;
	 $sql= ("select * from designs where prod_id='0' order by id DESC");
     $result=mysql_query(dopaging($sql,$limit));
*/
if(isset($_POST['submit']))
{    $uid =$_POST['uid'];
	$tradecode = $_POST['tradecode'];
	$userid =$_POST['userid'];
	$order_status = $_POST['order_status'];
	
	mysql_query("update `trade_goods` set order_status = '$order_status' where id ='$uid' and userid='$userid' and tradecode='$tradecode'");
 	
}


 $total_trade=mysql_query("select * from trade order by id desc ");
 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>admin</title>

<link href="style/style.css" rel="stylesheet" type="text/css" />
<link href="style/design.css" rel="stylesheet" type="text/css"  />


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

        <td width="80%" valign="top"><table width="100%" border="0" cellspacing="10" cellpadding="0">

          
          <tr>

            <td>

              <table width="100%" border="0" cellspacing="10" cellpadding="0">

                <tr>

                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                      <td class="lite-blue-bx"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                        <tr>

                          <td width="1%" ><img src="images/lft-menu-hd-corner-1.png" width="10" height="35" /></td>

                          <td width="99%" class="blue-bx-topmid-bg" ><table width="100%" border="0" cellspacing="5" cellpadding="0">

                            <tr>

                              <td align="left" class="white-18">Order List</td>

                            </tr>

                          </table></td>

                          <td width="0%" ><img src="images/lft-menu-hd-corner-2.png" width="10" height="35" /></td>

                        </tr>

                        <tr>

                          <td >&nbsp;</td>

                          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                            <tr>

                             <td colspan="4"></td>
                              
                       
                            </tr>
 
                      <tr>
                      <td><table width="100%" cellpadding="3" cellspacing="3">
                      <tr><th width="5%" align="center">Num</th>
                      <th width="12%" align="center">Trade Code</th>
                      <th width="13%" align="center">User Id</th>
                      <th width="10%" align="center">Customer</th>
                      <th width="10%" align="center">Total Money</th>
                      <th width="8%" align="center">Ship Money</th>
                      <th width="8%" align="center">Pay Money</th>
                      <th width="10%" align="center">Shipping Other Country</th>
                      <th width="10%" align="center">Pay Method</th>
                      <th width="8%" align="center">Details</th>
                      <th width="6%" align="center">Status</th>
                      </tr>
                      <tr><td colspan="10">
                      <hr color="#999999"; />
                      </td></tr>
                      
                      
                      <?php $count=0;
					    
					  while( $total_trade_row = mysql_fetch_assoc($total_trade))
					  { 
					  $count++;
					  
					  
					  
					  ?>
                      <form action="" method="post" >
                      <tr><td width="5%" align="center"><input type="hidden" name="uid" value="<?= $total_trade_row['id'] ?>" /><?=$count?></td>
                      
                      <td width="12%" align="center"><input type="hidden" name='tradecode' value="<?=$total_trade_row['tradecode']?>" /> <?=$total_trade_row['tradecode']?></td>
                      <td width="13%" align="center"><input type="hidden" name="userid" value="<?=$total_trade_row['userid']?>" /><?=$total_trade_row['userid']?></td>
                      <td width="10%" align="center"><?=$total_trade_row['userid_part']?></td>
                      <td width="8%" align="center"><?=$total_trade_row['totalM']?></td>
                      <td width="8%" align="center"><?=$total_trade_row['shipM']?></td>
                      <td width="10%" align="center"><?=$total_trade_row['shipotherM']?></td>
                      <td width="10%" align="center"><?=number_format($total_trade_row['totalM']+$total_trade_row['shipM']+$total_trade_row['shipotherM'],2)?></td>
                      <td width="8%" align="center"><?=$total_trade_row['paymethod']?></td>
                      <td width="6%" align="center"><a href="buyer_order_list_details.php?id=<?=$total_trade_row['id']?>">                        Details</a></td>
                      <td width="10%" align="center"> <select name ="order_status" id ="order_status">
                                                    
                                                      <option vaule="Cancel" <?php if($total_trade_row['order_status'] =='Cancel'){ ?> selected <?php } ?>>pending</option>
                                                      <option vaule="Cancel" <?php if($total_trade_row['order_status'] =='Cancel'){ ?> selected <?php } ?>>paid</option>
                                                      <option vaule="Cancel" <?php if($total_trade_row['order_status'] =='Cancel'){ ?> selected <?php } ?>>Cancel</option>
                                                      <option value="Complete" <?php if($total_trade_row['order_status'] =='Complete'){ ?> selected <?php } ?>>Complete</option>
                                                        <option value="not paid" <?php if($total_trade_row['order_status'] =='not paid'){ ?> <?php } ?>>not paid</option>
                                                      </select>
					                                  <input type="submit" name="submit" id="submit" value="Update" onclick="return confirm('Are you sure you want to Update?')" />
					  
					  </td>
                      
                      </tr>
                      </form>
                      <tr><td colspan="10">
                      <hr color="#999999"; /></td></tr>
                      <?php  }  ?>
                       
                      </table>
                      </td>
                      </tr>
                                        
                          

                            <tr>

                              <td colspan="10">&nbsp;</td>

                            </tr>

                            <tr>

                              <td colspan="11"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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

   </td>

  </tr>
  

  <tr>

    <td><? include('footer.php')?></td>

  </tr>

</table>


</body>

</html>


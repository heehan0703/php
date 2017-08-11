<?php
session_start();
require_once('include/connectdb.php');
$userid = $_GET['userid'];
if($_SESSION["ADMIN_ID"]==""){	
header("location:login.php");	
	
	exit;
	 } 
	/* 
	  $limit=16;
	 $sql= ("select * from designs where prod_id='0' order by id DESC");
     $result=mysql_query(dopaging($sql,$limit));
*/
 $query=mysql_query("SELECT * FROM `trade` where userid ='$userid' order by id desc ");

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
                      
                      <tr>
                      <th width="5%" align="center">Num</th>
                      <th width="15%" align="center">Trade Code</th>
                      <th width="15%" align="center">User Id</th>
                      <th width="15%" align="center">Customer</th>
                      <th width="8%" align="center">Total Money</th>
                      <th width="8%" align="center">Ship Money</th>
                      <th width="8%" align="center">Ship Money</th>
                     <!-- <th width="10%" align="center">Shipping Other Country</th> -->
                      <th width="10%" align="center">Pay Method</th>
                      <th width="6%" align="center">Details</th>
                      </tr>
                      
                     <tr>
                      <td colspan="9"> <hr color="#CCCCCC" />
                      </td>
                      </tr>
                      
					  <?php $count=0;  while($category=mysql_fetch_assoc($query)){ $count++;?>
                      <tr><td width="5%" align="center"><?=$count?></td>
                      <td width="15%" align="center"><?=$category['tradecode']?></td>
                      <td width="15%" align="center"><?=$category['userid']?></td>
                      <td width="15%" align="center"><?=$category['userid_part']?></td>
                      <td width="8%" align="center"><?=$category['totalM']?></td>
                      <td width="8%" align="center"><?=$category['shipM']?></td>
                      <td width="8%" align="center"><?=$category['shipotherM']?></td>
                     <!-- <td width="8%" align="center"><?=number_format($category['totalM']+$category['shipM']+$category['shipotherM'],2)?></td> -->
                      <td width="10%" align="center"><?=$category['paymethod']?></td>
                      <td width="6%" align="center"><a href="buyer_order_list_details.php?id=<?=$category['id']?>">Details</a></td>
                      </tr>
                      <tr>
                      <td colspan="9"> <hr color="#CCCCCC" />
                      </td>
                      </tr>
                      <?php }  ?> 
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


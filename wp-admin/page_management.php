<?php

session_start();

require_once('include/connectdb.php');




if($_SESSION["ADMIN_ID"]==""){
	
header("location:login.php");	
	
	exit;
	 } 
	/* 
	  $limit=16;
	 $sql= ("select * from designs where prod_id='0' order by id DESC");
     $result=mysql_query(dopaging($sql,$limit));

 $query=mysql_query("SELECT * FROM `product` order by id asc ");
*/ 
 $query=mysql_query("SELECT * FROM `page_details` order by page_id asc ");	  

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Page Management</title>

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

                              <td align="left" class="white-18">Page Management</td>

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
                     <th width="6%" align="left">Num</th>
                     <th width="20%" align="left">Page Name</th>
                     <th width="60%" align="left">Page Description</th>
                     <th width="14%" align="center">Action</th>
                     </tr>
                     <?php $count=0;  while($page_detail=mysql_fetch_assoc($query)){ $count++;?>
                     
                     <tr>
                     <td width="6%" align="left"><?=$count?></td>
                     <td width="20%" align="left"><?=$page_detail['page_name']?></td>
                     <td width="60%" align="left"><?=$page_detail['page_description']?></td>
                     <td width="14%" align="left"><a href="develop_page_edit.php?id=<?=$page_detail['page_id']?>">Show/Edit</a></td>
                     
                     </tr>
                     <?php } ?>
                     <tr>
                     <td colspan="5"> <a href="develop_page.php" target="_blank">New Page</a></td>
                     </tr>
                     
                      </table>
                      </td>
                      </tr>
                                        
                          

                            <tr>

                              <td colspan="4">&nbsp;</td>

                            </tr>

                            <tr>

                              <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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


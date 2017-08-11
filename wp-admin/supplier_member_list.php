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
	  
$member_id=$_GET['member_id'];
if($_GET['act']=='delete')
{
	$query3=mysql_query("delete from `member` where member_id='$member_id'");
	  
}

	$wig_list_query=mysql_query("SELECT * FROM `member` where supplier = 1 order by member_id asc");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Supplier List</title>

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

                              <td align="left" class="white-18">Supplier List</td>

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
     <tr><th width="6%" align="center">Mem_Id</th>
     <th width="12%" align="left">Name</th>
     <th width="15%" align="left">Email</th>
     <th width="15%" align="left">Account Details</th>
     <th width="10%" align="left">Product List</th>
     <th width="10%" align="left">Order Product</th>
     <th width="10%" align="left">Bulk Order</th>
     <th width="22%" colspan="2">Action</th>
     </tr>
     
       <?php
	 
	 
	
 
			while($wig_list_row=mysql_fetch_assoc($wig_list_query))
			 {
			  
			  ?> 
     
     
     
    
     <tr><td width="6%" align="center"><?=$wig_list_row['member_id']?></td>
     <td width="12%" align="left"><?=$wig_list_row['f_name']?>&nbsp;<?=$wig_list_row['l_name']?></td>
     <td width="15%" align="left"><?=$wig_list_row['email']?></td>
     <td width="15%" align="left"><a href="supplier_account_admin.php.?member_id=<?=$wig_list_row['member_id']?>">Account Details</a></td>
     <td width="10%" align="left"><a href="supplier_product_list.php?member_id=<?=$wig_list_row['member_id']?>">View</a></td>
     <td width="10%" align="left"><a href="supplier_order_list?uid=<?=$wig_list_row['member_id']?>">Veiw</a></td>
     <td width="10%" align="left"><a href="admin_bulk_order.php?uid=<?=$wig_list_row['member_id']?>">Upload</a></td>
     <td width="10%" align="left"><a href="supplier_member_edit.php?member_id=<?=$wig_list_row['member_id']?> " style="margin-left: 35px;">EDIT </a></td>
     <td width="12%" align="left"><a href="supplier_member_list.php?act=delete&member_id=<?=$wig_list_row['member_id']?>">DELETE </a></td>
      </tr>
     
      <?php  } ?>
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


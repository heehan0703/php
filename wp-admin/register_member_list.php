<?php

session_start();

require_once('include/connectdb.php');
require_once('pager2.php');




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

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Buyer List</title>

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
                                   <td align="left" style="color:#333; font-size:24px;">Buyer List &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="export_excel.php"><img src="images/excel.png" width="25" height="25" /></a></span></td>

                                   </tr>
                          </table></td>
                          

                     </tr>

                     <tr>

                           <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                              <tr>

                                 <td colspan="7"></td>
                              
                       
                               </tr>

                              <tr>
                                 <td><table width="100%" id="t01" cellpadding="3" cellspacing="3" border="0" style="color:#333;">
                                  <tr><th width="10%" align="center">Id</th>
                                  <th width="15%" align="left">Name</th>
                                  <th width="20%" align="left">Email</th>
                                  <th width="15%" align="left">Registered</th>
                                  <th width="15%" align="left">Type</th>
                                  <th width="13%" align="left">Order History</th>
                                  <th width="6%" align="left">Status</th>
                                  <th width="6%"  align="left">Account Status</th>
						     </tr>
     
       <?php
	 
	
	$wig_list_query=mysql_query(dopaging("SELECT * FROM `member` where supplier = 0 order by member_id desc",50)); 
			while($wig_list_row=mysql_fetch_assoc($wig_list_query))
			 {
			  
			  ?> 
     
     
     
    
     <tr><td width="10%" align="center"><?=$wig_list_row['member_id']?></td>
     <td width="15%" align="left"><a href="register_member_edit.php?member_id=<?=$wig_list_row['member_id']?>"><?=$wig_list_row['f_name']."&nbsp;".$wig_list_row['l_name']?> </a></td>
     <td width="20%" align="left"><?=$wig_list_row['email']?></td>
     <td width="15%" align="left"><?=date("Y-m-d H:i:s",$wig_list_row['registered_date'])?></td>
     <td width="15%" align="left"><?=$wig_list_row['i_am']?></td>
     <td width="13%" align="left"><a href="buyer_order_list?userid=<?=$wig_list_row['email']?>">View</a></td>
     <td width="6%" align="left"><? if($wig_list_row['verify_status'] == 1){ ?> Verify <? } else { ?>Not Verify <? }?></td>
     <td width="6%" align="left"><? if($wig_list_row['status'] == 1){ ?> Active <? } else { ?>Inactive <? }?></td>
     </tr>
     
      <?php  } ?>
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
                                    <font size="+2"> <?php  echo rightpaging(); ?> </font>
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
	<tr>
        </table></td>
 <td width="20%" valign="top">
 <form action="search_register_member_list.php" method="post">
 <table width="100%" border="0" cellspacing="5" cellpadding="0" id="t02">
 <tr>
 <td colspan="2" align="center">Search</td>
 </tr>
 
 <tr>
 <td>Name</td>
 </tr>
 <tr>
 <td><input type="text" name="name"> </td>
 </tr>
 
 
 <tr>
 <td>email</td>
 </tr>
 <tr>
 <td><input type="text" name="email"> </td>
 </tr>
<tr>
<td>
<input type="submit" value="Search">
</td>
</tr>

 </table>
 </form>
 </td>
      </tr>

   </td>

  </tr>
  

							
  <tr>

    <td><? include('footer.php')?></td>

  </tr>

</table>


</body>

</html>


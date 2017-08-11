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
if(isset($_POST['status']) && $_POST['status']!='')
{
	$status = $_POST['status'] ;
	$hddn_id = $_POST['hddn_id'];
	$query3=mysql_query("update bulk_upload_file set status='$status' where id='$hddn_id'");
	
}

$query=mysql_query("SELECT * FROM `bulk_upload_file` order by id desc"); 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Bulk Upload List</title>

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
     <tr><th width="3%" align="center">Num </th>
     <th width="7%" align="left">Supplier Email</th>
     <th width="20%" align="left">Sample CSV</th>
     <th width="20%" align="left">Sample Zip</th>
     <th width="20%" align="left">Date</th>
     <th width="20%" colspan="2">Action</th>
     </tr>
     
       <?php
	 
	$count=0;
	
			while($query_row=mysql_fetch_assoc($query))
			 {
			 $count++; 
	$user_email=mysql_result(mysql_query(" select email from member where member_id='$query_row[supplier_id]'"),0);		 
			 
			  ?> 
     
     <form action="" method="post" >
     
    <input type="hidden" name="hddn_id" value="<?=$query_row['id']?>"  />
   
     <tr><td width="3%" align="center"><?=$count?></td>
     <td width="17%" align="left"><?=$user_email?></td>
     <td width="20%" align="left"><?=$query_row['csv_name']?><br />
     <a href="../supplier/bulk_csv/<?=$query_row['csv_name']?>" target="_blank">Click Here To Download</a>
     </td>
     <td width="20%" align="left"><?=$query_row['zip_name']?><br>
     <a href="../supplier/bulk_zip/<?=$query_row['zip_name']?>" target="_blank">Click Here To Download</a></td>
     <td width="20%" align="left"><?=date('D-F-Y',$query_row['writeday'])?></td>
     <td width="20%" align="left"><select name="status" onchange="this.form.submit()">
     <option value="0" <? if($query_row['status']==0){?> selected="selected" <? }?>>Pending</option>
      <option value="1" <? if($query_row['status']==1){?> selected="selected" <? }?>>Complete</option>
     </select></td>

     </tr>
     </form>
     
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


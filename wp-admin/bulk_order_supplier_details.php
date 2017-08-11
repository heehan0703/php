<?php

session_start();

require_once('include/connectdb.php');

$userid = $_GET['userid'];

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
 //$query=mysql_query("SELECT supplier_id,csv_name,zip_name,DATE_FORMAT(FROM_UNIXTIME(`writeday`), '%m-%d-%Y') as date FROM `bulk_upload_file` order by id desc");
     $query=mysql_query("SELECT * FROM `bulk_upload_file` order by id desc");
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
                      <th width="10%" align="center">Num</th>
                      <th width="10%" align="center">Supplier Name</th>
                      <th width="20%" align="center">CSV FILE</th>
                      <th width="20%" align="center">ZIP FILE</th>
                      <th width="10" align="center">Upload</th>
                      <th width="20%" align="center">Date</th>
                      <th width="10%" align="center">Status</th>
                      </tr>
                      
                     <tr>
                      <td colspan="5"> <hr color="#CCCCCC" />
                      </td>
                      </tr>
                      
					  <?php $count=0;  
					  while($query_row=mysql_fetch_assoc($query))
					  { $count++;
					   
					   //$csv_name = explode('_',$category['csv_name'],2);
                    	 //$zip_name = explode('_',$category['zip_name'],2);

					  $user_email=mysql_result(mysql_query(" select email from member where member_id='$query_row[supplier_id]'"),0);	
					  
					  ?>
                      <tr>
                      <td width="20%" align="center"><?=$count?></td>
                      <td width="20%" align="center"><?=$user_email?></td>
                      <td width="20%" align="center"><a href="../supplier/bulk_csv/<?=$query_row['csv_name']?>"><?=$query_row['csv_name']?></a></td>
                      <td width="20%" align="center"><a href="../supplier/bulk_zip/<?=$query_row['zip_name']?>"><?=$query_row['zip_name']?></a></td>
                      <form action="bulk_product_upload.php" method="post" name="upload_file">
                      
                      <input type="hidden" name="user_email" value="<?=$user_email?>" />
                      <input type="hidden" name="user_id" value="<?=$query_row['id']?>" />
                      <input type="hidden" name="csv_name" value="<?=$query_row['csv_name']?>" />
                      <input type="hidden" name="zip_name" value="<?=$query_row['zip_name']?>" />
                      <td width="20%" align="center"><input type="submit" value="Upload" name="upload" /></td>
                      </form>
                      <td width="20%" align="center"><?=date('D-F-Y',$query_row['writeday'])?></td>
                      <td width="20%" align="left"><select name="status" onchange="this.form.submit()">
                      <option value="0" <? if($query_row['status']==0){?> selected="selected" <? }?>>Pending</option>
                      <option value="1" <? if($query_row['status']==1){?> selected="selected" <? }?>>Complete</option>
                      </select></td>
                      </tr>
                      <tr>
                      <td colspan="5"> <hr color="#CCCCCC" />
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


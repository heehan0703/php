<?php

session_start();
require_once('include/connectdb.php');
$cat_id=$_GET['cat_id']; 
$sub_cat_id=$_GET['sub_cat_id'];

	  

if($_SESSION["ADMIN_ID"]==""){
	
header("location:login.php");	
	
	exit;
	 } 
	/* 
	  $limit=16;
	 $sql= ("select * from designs where prod_id='0' order by id DESC");
     $result=mysql_query(dopaging($sql,$limit));
*/
 $cat_id=$_GET['cat_id']; 
// echo $cat_id;
 $id=$_GET['id'];
$query2=mysql_query("SELECT * FROM `category` where id='$cat_id' ");
$query1=mysql_query("SELECT * FROM `subcategory` where cat_id='$cat_id' ");
 $query=mysql_query("SELECT * FROM `sub_subcategory` where cat_id='$cat_id' and sub_cat_id='$sub_cat_id'");
if($_GET['act']=='delete')
{
	 $delid=$_GET['id']; 
	  
// echo $cat_id;
	$query3=mysql_query("delete from `sub_subcategory` where id='$delid'");	
 //echo "delete from `subcategory` where id='$id'";
header("location:sub_sub_category.php?cat_id=$cat_id&sub_cat_id=$sub_cat_id");
}


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

                              <td align="left" class="white-18">Sub Sub Category List</td>
 
	<td width="5%" align="left"><a href="add_new_subsubcategory.php?catid=<?=$cat_id?>&sub_catid=<?=$sub_cat_id?>" class="white-18" style="margin-left: -143px;" >
    ADD Sub Sub Category </a></td>
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
     <tr><th width="5%" align="center">Num</th><th width="15%" align="left">Category Name</th><br />
<th width="10%" align="left">SubCategory Name</th>
<th width="10%" align="left">SubSubCategory Name</th>
<th width="25%" colspan="2">Action</th></tr>
<?php $category=mysql_fetch_assoc($query1);
$category2=mysql_fetch_assoc($query2); ?>
    
      <?php $count=0;  while($subcategory=mysql_fetch_assoc($query)){ $count++;
	
	
     ?>
     
     <tr><td width="5%" align="center"><?=$count?></td>
     <td width="30%" align="left"><?=$category2['category_name']?></td>
     <td width="40%" align="left"><?=$category['name']?></td>
     <td width="20%" align="left"><?=$subcategory['name']?></td>
  
      <td width="5%" style=""><a href="edit_sub_sub_category.php?act=edit&id=<?=$subcategory['id']?>">EDIT </a></td>
     <td width="5%" align="left"><a href="sub_sub_category.php?act=delete&id=<?=$subcategory['id']?>&cat_id=<?=$cat_id?>&sub_cat_id=<?=$sub_cat_id?>">DELETE </a></td>
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


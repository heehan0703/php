<?php
session_start();
require_once('include/connectdb.php');
$id=$_GET['id'];
if(isset($_POST['submit']))
{
	
$rec = "select * from sub_subcategory where id=$id";	 
$query_sub = mysql_query($rec);
$wig_list_row=mysql_fetch_assoc($query_sub);
$cat_id=$wig_list_row['cat_id'];
$sub_cat_id=$wig_list_row['sub_cat_id'];
	$val=$_POST['name'];
	$record = "update sub_subcategory set name='$val' where id='$id'";
	 $query = mysql_query($record);
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
function show()
{
var x=document.getElementById('name').value;

jQuery("#name").html(x);
}
</script>

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

                          <td width="1%" ><img src="image/lft-menu-hd-corner-1.png" width="10" height="35" /></td>

                          <td width="99%" class="blue-bx-topmid-bg" ><table width="100%" border="0" cellspacing="5" cellpadding="0">

                            <tr>

                              <td align="left" class="white-18">Product List</td>
                              
                                 <td align="left" class="white-18">
                       <form method="get" action="" >          
                               <select style="height:25px;" name="search_cat">
                               <option value="">All Categories</option>
                                        <?php while($cat_row=mysql_fetch_assoc($cat_query)){ ?>
           <option value="<?=$cat_row['category_name']?>"><?=$cat_row['category_name']?></option>  
           <? } ?> 
     
                               </select><input type="text" name="search_text" placeholder="Search..."  />
                                <input type="submit" name="submit" value="Search" style="border:0px; background:#2992C1; color:#fff; height:25px; cursor:pointer;" />
                                	<td width="5%" align="left"><a href="product_list_add.php" class="white-18">ADD </a></td>

                               </form>
                               
                                 </td>

                            </tr>

                          </table></td>

                          <td width="0%" ><img src="image/lft-menu-hd-corner-2.png" width="10" height="35" /></td>

                        </tr>

                        <tr>

                          <td >&nbsp;</td>

                          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                            <tr>

                             <td colspan="4"></td>
                              
                       
                            </tr>

                      <tr>
                     <td><table width="100%" cellpadding="3" cellspacing="3">
     <tr><th width="25%" align="center">ID</th>
          <th width="25%" align="center">Category id</th>

     <th width="25%" align="left">Category name</th>
     
   
     <th width="25%" colspan="2">Action</th>
     </tr>
     
      <?php

require_once('include/connectdb.php');
$id=$_GET['id'];



$rec = "select * from sub_subcategory where id=$id";
	 
	 
$query_sub = mysql_query($rec);

$num_rows = mysql_num_rows($query_sub);


for($r=0;$r<$num_rows;$r++)
{
	
	$wig_list_row=mysql_fetch_assoc($query_sub);
	

//$cat_id=$wig_list_row['cat_id'];
?>

	
 
      
     <form method="post" name="form" onsubmit="show()">
     
     
    
     <tr><td width="10%" align="center"><?=$wig_list_row['id']?></td>
     <td width="10%" align="center"><?=$wig_list_row['cat_id']?></td>
     <td width="10%" align="left"><input type="text" name="name" id="name" value="<?=$wig_list_row['name']?>" /></td>
     
	
     
     
     
      <td width="5%" style=""><input type="submit" name="submit" value="submit" /></td>
     </tr>
     
     </tr>
     <?php }   ?>
     <tr><td colspan="8"><hr /></td></tr>
 
                      </table>
                      </td>
                      </tr>
                                        
                          

                            <tr>

                              <td colspan="10">&nbsp;</td>

                            </tr>

                            <tr>

                              <td colspan="11"><table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
                                	<td colspan="2" align="center">
                                   
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




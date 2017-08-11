<?php
session_start();
require_once('include/connectdb.php');
$id=$_GET['id'];
if(isset($_POST['submit']))
{
	$val=$_POST['name'];
	$page_title=$_POST['page_title'];
	$seo_tages=$_POST['seo_tages'];
	$record = "update subcategory set name='$val',seo_tags='$seo_tages',page_title='$page_title' where id='$id'";
	 $query = mysql_query($record);
	header("location:category_manage.php");
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
     
     
      <?php

require_once('include/connectdb.php');
$id=$_GET['id'];



$rec = "select * from subcategory where id=$id";
	 
	 
$query_sub = mysql_query($rec);

$num_rows = mysql_num_rows($query_sub);


	
	$wig_list_row=mysql_fetch_assoc($query_sub);
	


?>

	
 
      
    
     <tr><td colspan="8"><hr /></td></tr>
 
                      </table>
                      </td>
                      </tr>
                                        
                          

                            <tr>

                              <td colspan="10">&nbsp;</td>

                            </tr>

                            <tr>

                              <td colspan="11"><table width="100%" border="0" cellspacing="0" cellpadding="0">
								<form id="category_edit_form" name="product_edit_form" method="POST" action="" onsubmit="return Validation()" enctype="multipart/form-data">
                      <table width="100%" cellpadding="3" cellspacing="3">                  
     <tr>
     <td width="30%" align="right" colspan="4">Category Name</td>
     <td width="40%" align="left" colspan="4">
     <input type="text" name="name" id="Id" class="form-group" style="width:220px" value="<?=$wig_list_row['name']?>"  ></td>
     </tr>
     <tr>
     <td width="30%" align="right" colspan="4">Page Title</td>
     <td width="40%" align="left" colspan="4">
     <textarea  cols="25" rows="3" name="page_title"><?=$wig_list_row['page_title']?></textarea>
     </td>
     </tr>
     
     <tr>
     <td width="30%" align="right" colspan="4">SEO TAGS</td>
     <td width="40%" align="left" colspan="4">
     <textarea  cols="25" rows="3" name="seo_tages"><?=$wig_list_row['seo_tags']?></textarea>
     </td>
     </tr>
     
     
     <tr>
     <td width="30%"  align="center" colspan="10">
     <input type="submit" name="submit"  value="submit" class="form-group"  >
     </td>
    </tr>
       
     
</form>

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




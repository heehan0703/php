<?php

session_start();

require_once('include/connectdb.php');

include('pager.php');


if($_SESSION["ADMIN_ID"]==""){
	
header("location:login.php");	
	
	exit;
	 } 
	
	
$cat_query=mysql_query("SELECT * FROM `member` where supplier=1  order by member_id asc");

$id=$_GET['id'];
if($_GET['act']=='delete')
{
	$query3=mysql_query("delete from `product` where id='$id'");
	
}
$query = "SELECT * FROM `product` ";
if(isset($_REQUEST['submit']))
{
$user_email=$_REQUEST['search_cat'];

$user_id = mysql_fetch_assoc(mysql_query("select * from member where email ='$user_email'"));

$query = "SELECT * FROM `product` where user_id ='$user_id[member_id]' ";

}
/*
if(isset($_REQUEST['search_text'])){
$search_text=$_REQUEST['search_text'];
if(isset($_REQUEST['search_cat']) && $_REQUEST['search_cat']!=''){
$search_cat = $_REQUEST['search_cat'];
 $query .=" where category='$search_cat' and (product_name like '$search_text%' or description like '$search_text%' )";
}
else{
$query .="where product_name like '$search_text%' or description like '$search_text%' ";
	
}
	
}
$query .= "order by id desc";
*/

$wig_list_query=mysql_query(dopaging($query,20)); 



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

                              <td align="left" class="white-18">Supplier List</td>
                              
                                 <td align="left" class="white-18">
                       <form method="post" action="" >          
                               <select style="height:25px;" name="search_cat">
                               <option>Select Supplier</option>
                                        <?php while($cat_row=mysql_fetch_assoc($cat_query)){ ?>
                                       
           <option value="<?=$cat_row['email']?>"><?=$cat_row['email']?></option>  
           <? } ?> 
     
                               </select>
                                <input type="submit" name="submit" value="Go" style="border:0px; background:#2992C1; color:#fff; height:25px; cursor:pointer;" />
                               </form>
                               
                                 </td>

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
     <th width="10%" align="left">Model</th>
     <th width="20%" align="left">Product_Image</th>
     <th width="10%" align="left">Price</th>
     <th width="10%" align="left">Wholesale Price</th>
     <th width="10%" align="left">Min</th>
     <th width="20%" align="left">Category</th>
     <th width="15%" align="left">Action</th>
     </tr>
     
       <?php
	 
	$count=0;
	
			while($wig_list_row=mysql_fetch_assoc($wig_list_query)) {
			   $count++;
			 if (strpos($wig_list_row['images'],',') !== false) {
  $product_img=explode(',',$wig_list_row['images']);
  $product_img=$product_img[0];
}
else{
  $product_img=$wig_list_row['images'];	
}
		
		
			   
		    ?> 
     
     
     
    
     <tr><td width="5%" align="center"><?=$count?></td>
     <td width="10%" align="left"><?=$wig_list_row['product_name']?></td>
     <td width="20%" align="left"><img src="../product_img/<?=$product_img?>" width="100" height="100"/></td>
     <td width="10%" align="left">$<?=$wig_list_row['msrp_price']?></td>
     <td width="10%" align="left">$<?=$wig_list_row['wholesale_price']?></td>
     <td width="10%" align="left">1</td>
     <td width="20%" align="left">
	 <select name="select_category">
     <option value="<?=$wig_list_row['category']?>">
	 <?=$wig_list_row['category']?>
     </option>
     </select
     </td>
     <td width="15%" align="left">Question(0) <br />
     <a href="list_by_supplier.php?act=delete&id=<?=$wig_list_row['id']?>"> End Item </a><br />
      Edit</td>
     
     </tr>
     <tr><td colspan="8"><hr /></td></tr>
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
                                	<td colspan="2" align="center">
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


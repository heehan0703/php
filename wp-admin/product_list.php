<?php

session_start();

require_once('include/connectdb.php');

include('pager.php');


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
$cat_query=mysql_query("SELECT * FROM `category` where category_name!='' order by id asc");

$id=$_GET['id'];
if($_GET['act']=='delete')
{
	$query3=mysql_query("delete from `product` where id='$id'");
	 // echo "delete from `product` where id='$id';";
}
$query = "SELECT * FROM `product` ";

if(isset($_REQUEST['submit'])){
$search_text=$_REQUEST['search_text'];

if(isset($_REQUEST['search_cat']) && $_REQUEST['search_cat']!=''){
$search_cat = $_REQUEST['search_cat'];
 $query .=" where category='$search_cat' and (product_name like '$search_text%' or description like '$search_text%' )";
 //echo  $query;
}
else{
$query .="where product_name like '$search_text%' or description like '$search_text%' ";
	
}
	
}
$query .= "order by id desc";


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
     <tr><th width="10%" align="center">Num</th>
     <th width="10%" align="left">Product_list</th>
     <th width="20%" align="left">Product_Image</th>
     <th width="30%" align="left">Description</th>
     <th width="10%" align="left">Delivery_Time</th>
     <th width="10%" align="left">Ship_Method</th>
     <th width="10%" colspan="2">Action</th>
     </tr>
     
       <?php
	 
	$count=0;
	
			while($wig_list_row=mysql_fetch_assoc($wig_list_query)) {
			   $count++;
			   
			  
			   //$content = preg_replace("/<img[^>]+\>/i", " ", $wig_list_row['description']); 
				//$content = substr($wig_list_row['description'],0,23);
				
				$pieces = explode(" ", $wig_list_row['description']);
				
                $first_part = implode(array_splice($pieces, 0, 20));
				 
			 if (strpos($wig_list_row['images'],',') !== false) {
  $product_img=explode(',',$wig_list_row['images']);
  $product_img=$product_img[0];
}
else{
  $product_img=$wig_list_row['images'];	
}
		
		
			   
		    ?> 
     
     
     
    
     <tr><td width="10%" align="center"><?=$count?></td>
     <td width="10%" align="left"><?=$wig_list_row['product_name']?></td>
     <td width="20%" align="left"><img src="../product_img/<?=$product_img?>" width="100" height="100"/></td>
     <td width="30%" align="left"><?=$first_part?></td>
     <td width="10%" align="left"><?=$wig_list_row['delivery_time']?></td>
     <td width="10%" align="left"><?=$wig_list_row['shipping_method']?></td>
     <td width="5%" align="left"><a href="product_list_edit.php?id=<?=$wig_list_row['id']?>">EDIT </a></td>
     <td width="5%" align="left"><a href="product_list.php?act=delete&id=<?=$wig_list_row['id']?>">DELETE </a></td>
     
     </tr>
     <tr><td colspan="8"><hr /></td> <?php  } ?></tr>
     
                      </table>
                      </td>
                      </tr>
                                        
                          

                            <tr>

                              <td colspan="10"><font size="+2"> <?php  echo rightpaging(); ?> </font></td>

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


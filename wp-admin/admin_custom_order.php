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
*/

$user_row=mysql_fetch_assoc(mysql_query("SELECT * FROM `custom_order` where id=1"));

$country_query=mysql_query("SELECT * FROM `country` where country_name!='' order by country_Id asc");

$country_query2=mysql_query("SELECT * FROM `country` where country_name!='' order by country_Id asc");



$category=mysql_query("SELECT * FROM `category` where category_name!='' order by category_name ASC ");

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

                              <td align="left" class="white-18">Custom Order</td>

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
                      <td colspan="2"><h3>Buyer Information</h3></td>
                      </tr>
                     
                      <tr>
                       <td align="left">Company Name</td>
                       <td align="left"><input type="text" id="com_name" name="com_name" value="<?=$user_row['company_name']?>" /></td> 
                      </tr>
                       
                       <tr>
                       <td align="left">Street Address</td>
                       <td align="left"><input type="text" id="address1" name="address1" value="<?=$user_row['address1']?>" /></td> 
                      </tr>
                      
                      <tr>
                       <td align="left">Street Address Line 2</td>
                       <td align="left"><input type="text" id="address2" name="address2" value="<?=$user_row['address2']?>" /></td> 
                      </tr>
                      
                      <tr>
                       <td align="left">City</td>
                       <td align="left"><input type="text" id="city" name="city" value="<?=$user_row['city']?>" /></td> 
                      </tr>
                      
                      <tr>
                       <td align="left">State / Province</td>
                       <td align="left"><input type="text" id="state" name="state"  value="<?=$user_row['state']?>" /></td> 
                      </tr>
                      
                      <tr>
                       <td align="left">Postal / Zip Code</td>
                       <td align="left"><input type="text" id="zip" name="zip" value="<?=$user_row['zip']?>" /></td> 
                      </tr>
                       
                      <tr>
                       <td align="left">Country</td>
                       <td align="left"><select name="country">
                       <option>Please Select</option>
                       <?php
	                   while ($country_result = mysql_fetch_assoc($country_query)) {
	                    ?>	
	                  <option value="<?=$country_result['country_Id']?>" <? if($user_row['country']==$country_result['country_Id']){?>
	                  selected<? } ?>><?=$country_result['country_name']?></option>
	
	                  <?php } ?>  
                      </select></td> 
                      </tr>
                      
                      <tr>
                       <td align="left">E-mail</td>
                       <td align="left"><input type="text" id="email" name="email" value="<?=$user_row['email']?>"/></td> 
                      </tr>
                      
                      <tr>
                       <td align="left">Phone</td>
                       <td align="left"><input type="text" id="phone" name="phone" value="<?=$user_row['phone']?>" /></td> 
                      </tr>
                      
                      
                      <tr>
                      <td colspan="2"><h3>Shipping Information </h3></td>
                      </tr>
                     
                      <tr>
                       <td align="left">Company Name</td>
                       <td align="left"><input type="text"  name="rcompany_name" value="<?=$user_row['rcompany_name']?>"  /></td> 
                      </tr>
                       
                       <tr>
                       <td align="left">Street Address</td>
                       <td align="left"><input type="text" name="raddress1" value="<?=$user_row['raddress1']?>" /></td> 
                      </tr>
                      
                      <tr>
                       <td align="left">Street Address Line 2</td>
                       <td align="left"><input type="text" name="raddress2" value="<?=$user_row['raddress2']?>" /></td> 
                      </tr>
                      
                      <tr>
                       <td align="left">City</td>
                       <td align="left"><input type="text"  name="rcity" value="<?=$user_row['rcity']?>" /></td> 
                      </tr>
                      
                      <tr>
                       <td align="left">State / Province</td>
                       <td align="left"><input type="text"  name="rstate" value="<?=$user_row['rstate']?>" /></td> 
                      </tr>
                      
                      <tr>
                       <td align="left">Postal / Zip Code</td>
                       <td align="left"><input type="text" name="rzipcode" value="<?=$user_row['rzip']?>" /></td> 
                      </tr>
                      
                      <tr>
                       <td align="left">Country</td>
                       <td align="left"><select name="rcountry">
                       <option>Please Select</option>
                       <?php
	                   while ($country_result2 = mysql_fetch_assoc($country_query2)) {
	                   ?>	
	                  <option value="<?=$country_result2['country_name']?>" <? if($user_row['country']==$country_result2['country_Id']){?>
	                   selected<? } ?>><?=$country_result2['country_name']?></option>
	
	                   <?php } ?>  
                      </select></td> 
                      </tr>
                      
                      <tr>
                       <td align="left">E-mail</td>
                       <td align="left"><input type="text" name="remail" value="<?=$user_row['remail']?>" /></td> 
                      </tr>
                      
                      <tr>
                       <td align="left">Phone</td>
                       <td align="left"><input type="text" name="rphone" value="<?=$user_row['rphone']?>" /></td> 
                      </tr>
                      
                       <tr>
                       <td align="left">Describe </td>
                       <td align="left"><textarea name="description" rows="6" ><?=$user_row['description']?></textarea></td> 
                      </tr>
                      
                      <tr>
                         <td align="left">Payment Method </td>
                         <td align="left"><input type="text" name="rphone" value="<?=$user_row['pay_method']?>" /></td> 
                         </tr>
                     
                      </table>
                      </td>
                      </tr>
                         <?php
						  $product_type=explode(",",$user_row['product_type']);
						  $product_name=explode(",",$user_row['product_name']);
						  $product_length=explode(",",$user_row['product_length']);
						  $product_color=explode(",",$user_row['product_color']);
						  $custom_package=explode(",",$user_row['custom_package']);
						  $count =count($product_type);
						 ?>
                                        
                         <tr>
                         <td><table width="100%" cellpadding="3" cellspacing="3">
                         <tr>
                         <td>Product Type</td><td>Product Name</td><td>Length</td><td>Color</td><td>Custom Package</td>
                         </tr>
                         <?php for($j=0;$j<=$count;$j++)
						           {
							 ?>
                         <tr>
                         <td><?=$product_type[$j]?></td><td><?=$product_name[$j]?></td><td><?=$product_length[$j]?></td><td><?=$product_color[$j]?></td><td><?=$custom_package[$j]?></td>
                         </tr>
                             <?php }?>
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


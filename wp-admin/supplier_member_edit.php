<?php

session_start();

require_once('include/connectdb.php');

$country_query=$con_pdo->query("SELECT * FROM `country` where country_name!='' order by country_id asc");


if($_SESSION["ADMIN_ID"]=="")
   {
	header("location:login.php");	
	exit;
   } 
 $member_id=$_GET['member_id'];
 $query1 = mysql_query("select * from `member` where member_id = '$member_id' and supplier = 1");
 $query2 = mysql_fetch_assoc($query1);
 if($_GET['act']=='delete')
{
	$query3=mysql_query("delete from `member` where member_id='$member_id'");
	  
}
 if(isset($_POST['submit']))
  { 
  $pass =$_POST['current_pass'];
  $country =$_POST['country'];
  $state=$_POST['state'];
  $address1 =$_POST['address1'];
  $address2 =$_POST['address2'];
  $city =$_POST['city'];
  $zipcode = $_POST['zipcode'];
  $main_product = $_POST['main_product1'].'-'.$_POST['main_product2'].'-'.$_POST['main_product3'];
  $fee_rate=$_POST['fee_rate'];
  $listing_fee=$_POST['listing_fee'];
  $f_name = $_POST['f_name'];
  $l_name = $_POST['l_name'];
  $com_name =$_POST['com_name'];
  $tel =$_POST['tel1'].'-'.$_POST['tel2'].'-'.$_POST['tel3'];
  $cel =$_POST['cell1'].'-'.$_POST['cell2'].'-'.$_POST['cell3']; 
    
	
	$query3=mysql_query("update `member` set pwd='$pass', 
	                                          country='$country',
											  state='$state',
											  address1='$address1',
											  address2='$address2',
											  city='$city',
											  zipcode='$zipcode',
											  main_product='$main_product',
											  fee_rate='$fee_rate',
											  listing_fee='$listing_fee',
											  f_name='$f_name',
											  l_name='$l_name',
											  company_name='$com_name',
											  tel='$tel',
											  cel='$cel'
											  where member_id='$member_id'
											  and supplier=1");
											 
	echo "update `member` set pwd='$pass', 
	                                          country='$country',
											  state='$state',
											  address1='$address1',
											  address2='$address2',
											  city='$city',
											  zipcode='$zipcode',
											  main_product='$main_product',
											  fee_rate='$fee_rate',
											  listing_fee='listing_fee',
											  f_name='$f_name',
											  l_name='$l_name',
											  company_name='$com_name',
											  tel='$tel',
											  cel='$cel'
											  where member_id='$member_id'
											  and supplier=1";										  
											
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Edit Supplier Personal Information</title>

<link href="style/style.css" rel="stylesheet" type="text/css" />
<link href="style/design.css" rel="stylesheet" type="text/css"  />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

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

                              <td align="left" class="white-18">Edit Supplies Personal information </td>

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
                      <td>
                       <form id="product_edit_form" name="product_edit_form" method="POST" action="" onsubmit="return validate_form()">
                      <table width="100%" cellpadding="3" cellspacing="3">
                      
                     
     <tr>
     <td  colspan="2" width="30%" align="center">Edit Supplier Account............ </td>
     </tr>
       
       <tr>
     <td width="30%" align="left">Email </td>
     <td width="40%" align="left">
     <input type="text"  name="email" id="email" class="form-group" value ="<?=$query2['email']?>" disabled></td>
      </tr>

        <tr>
     <td width="30%" align="left">Current Password </td>
     <td width="40%" align="left">
     <input type="text" name="current_pass" id="current_pass" class="form-group" value ="<?=$query2['pwd']?>"></td>
      </tr>
<tr>
     <td width="30%" align="left">Business Location </td>
     <td width="40%" align="left">
     
     <select name="country" id="country">
     <option value="" >Select Country</option>	
     <?php
	  while ($country_result = $country_query->fetch(PDO::FETCH_ASSOC)) {
	?>	
	<option value="<?=$country_result['country_Id']?>" <?php if($query2['country']== $country_result['country_Id']){?> selected <?php } ?>><?=$country_result['country_name']?></option>
	
	<?php } ?>
	</select>	 
		
     </td>
      </tr>



      


  
   
   <tr id="state_div">
     <td  width="30%" align="left">State </td>
     <td width="40%" align="left">
     <input type="text" name="state" id="state" value="<?=$query2['state']?>" />
      </td>
      </tr>
   

 <tr>
     <td width="30%" align="left">Address </td>
     <td width="40%" align="left">
     <input type="text" name="address1" id="address1" class="form-group" value ="<?=$query2['address1']?>"></td>
      </tr>
 
  <tr>
     <td width="30%" align="left">Address2</td>
     <td width="40%" align="left">
     <input type="text" name="address2" id="address2" class="form-group" value ="<?=$query2['address2']?>"></td>
      </tr>
      
      <tr>
     <td width="30%" align="left">City </td>
     <td width="40%" align="left">
     <input type="text" name="city" id="city" class="form-group" value ="<?=$query2['city']?>"></td>
      </tr>
 
  <tr>
     <td width="30%" align="left">Zipcode</td>
     <td width="40%" align="left">
     <input type="text" name="zipcode" id="zipcode" class="form-group" value ="<?=$query2['zipcode']?>"></td>
      </tr>
 <?php
 $main_product = explode("-",$query2['main_product']); 
 ?>
 <tr>
     <td width="30%" align="left">Main Product:</td>
     
     <td width="40%" align="left"><input type="text" name="main_product1" id="main_product1" value="<?=$main_product[0]?>" />
         <input type="text" name="main_product2" id="main_product2" value="<?=$main_product[1]?>" />
         <input type="text" name="main_product3" id="main_product3" value="<?=$main_product[2]?>" />
     </td>
     </tr>
     
     <tr>
     <td colspan="2" width="30%" align="center">Payments and Fees ......... </td>
      </tr>
     <tr>
     <td width="30%" align="left">Fee rate(15~25%)</td>
     <td width="40%" align="left">
     <input type="text" id="fee_rate" name="fee_rate" class="form-group" value ="<?=$query2['fee_rate']?>"></td>
      </tr>
     <tr>
     <td width="30%" align="left">Listing fee($2 per listing)</td>
     <td width="40%" align="left">
     <input type="text"  id="listing_fee" name="listing_fee" class="form-group" value ="<?=$query2['listing_fee']?>"></td>
      </tr>
 
     
     
      <tr>
     <td colspan="2" width="30%" align="center">Edit Member Contact Information......... </td>
      </tr>
 
  <tr>
     <td width="30%" align="left">Contact Name</td>
     <td width="40%" align="left">
     <input type="text" name="f_name" id="f_name" class="form-group" value ="<?=$query2['f_name']?>">
     <input type="text" name="l_name" id="l_name" class="form-group" value ="<?=$query2['l_name']?>">
     </td>
      </tr>
 
  <tr>
     <td width="30%" align="left">Company Name</td>
     <td width="40%" align="left">
     <input type="text" name="com_name" id="com_name" class="form-group" value ="<?=$query2['company_name']?>"></td>
      </tr>
      
      <?php 
	  $i = explode("-",$query2['tel']);
	  ?>
 
  <tr>
     <td width="30%" align="left">Tel.</td>
     <td width="40%" align="left">
     <input type="text" name="tel1" id="tel1" class="form-group" value ="<?= $i[0] ?>">-
     <input type="text" name="tel2" id="tel2" class="form-group" value ="<?= $i[1] ?>">-
     <input type="text" name="tel3" id="tel3" class="form-group" value ="<?= $i[2] ?>">   
       </td>
      </tr>
      
      <?php 
	  $j = explode("-",$query2['cel']);
	  ?>
 
     <tr>
     <td width="30%" align="left">Cell.</td>
     <td width="40%" align="left">
     <input type="text" name="cell1" id="cell1" class="form-group" value ="<?= $j[0] ?>">-
     <input type="text" name="cell2" id="cell2" class="form-group" value ="<?= $j[1] ?>">-
     <input type="text" name="cell3" id="cell3" class="form-group" value ="<?= $j[2] ?>">   
     </td>
     </tr>
 
 
<tr><td >  <input  type="submit" value="Update" name="submit" onclick="alert('Want to Update?')"/></td>
<td><a href="supplier_member_list.php?act=delete&member_id=<?=$query2['member_id']?>" style="margin-left: -330px;">DELETE </a></td>
</tr>

                      </table>
                      </form>
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


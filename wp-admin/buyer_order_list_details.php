<?php
session_start();
require_once('include/connectdb.php');
$id=$_GET['id'];
if($_SESSION["ADMIN_ID"]==""){
	
header("location:login.php");	
	exit;
	 } 
	/* 
	  $limit=16;
	 $sql= ("select * from designs where prod_id='0' order by id DESC");
     $result=mysql_query(dopaging($sql,$limit));
	 $query1=mysql_query("SELECT * FROM `product` where tradecode ='$tradecode' ");
 $category1=mysql_fetch_assoc($query1)
 $query=mysql_query("SELECT * FROM `trade` where id ='$id' ");
 $count=mysql_num_rows($query);
 echo $count."<br>";
 */
$member_id=$_GET['member_id'];
$userid =$_GET['userid'];
if($_GET['act']=='delete')
{
	//print_r($_GET);	
	$member_id =$_GET['member_id'];
	$user_id =$_GET['user_id'];
	$tradecode =$_GET['tradecode'];
$query3=mysql_query("delete from `trade` where id='$member_id' ");
$query4 =mysql_query("delete from `trade_goods` where tradecode='$tradecode'");
	
	 // echo "delete from `trade` where id='$member_id' ";
	  
	  //echo "delete from `trade_goods` where tradecode='$tradecode'";
header("Location: /wp-admin/buyer_order_list_total.php");
	 	  
}

 
 if(isset($_POST['submit'])) 

{
	 $tradecode = $_POST['tradecode'];
     $status = $_POST['status'];
	 $trans_company=$_POST['trans_company'];
	 $trans_number=$_POST['trans_number'];
	  mysql_query("update `trade` set status='$status',trans_company='$trans_company',trans_number='$trans_number' where id='$id' and tradecode ='$tradecode'");
}

$trade_row= mysql_fetch_assoc(mysql_query("SELECT id,tradecode,userid_part,totalM,userid,shipM,payM,paymethod,shipotherM,
DATE_FORMAT(FROM_UNIXTIME(`writeday`), '%m-%d-%Y') as date,
name1,name2,adr1,adr2,city,state,country,zip,rname1,rname2,radr1,radr2,rcity,rstate,rcountry,rzip,totalweight,order_status,coupon_code,storeid,credit_used,discount,subdomainurl,
order_status,status,trans_company,trans_number,servicechoose,storeid,order_type,tax FROM `trade` where id='$id' "));
  
if($trade_row['order_type']=='Pickup'){
 $storeid=$trade_row['storeid'];
 $storerow = mysql_fetch_array(mysql_query("select * from store where id='$storeid'"));
}


 if(isset($_POST['submit3'])) 

{
	 $id = $_POST['retuen_issue_id'];
     $return_status = $_POST['return_status'];
	 
	  mysql_query("update `trade_goods` set return_issue='$return_status' where id='$id'");
      
}



$stmt =mysql_query("SELECT * FROM `trade_goods` where tradecode='$trade_row[tradecode]'");	

	  //$stmt_goods=mysql_fetch_assoc($stmt);
	 

if(isset($_POST['submit1']))
{    
     $user_id=$_POST['user_id'];
	 
	 $supplier_id = mysql_fetch_assoc(mysql_query("SELECT * FROM `member` where member_id='$user_id' "));
	 $supplier_email=$supplier_id['email'];
	 $product_name=$_POST['product_name'];
     $product_img=$_POST['product_img'];
     $product_code=$_POST['product_code'];
     $product_color=$_POST['product_color'];
     $product_price=$_POST['product_price'];
     $product_cnt=$_POST['product_cnt'];
     
	 $to = $supplier_email;
     $from = "info@fahair.com/";
     $subject = "User Add New Product";

$body = "<html><body>
              <p><strong>New Product Details</strong></p>
              <table border ='2'>
                   <tr><td>Product Name :</td><td>$product_name</td></tr>
                   <tr><td>Product Image :</td><td><img width='100' height='100' src='http://beautco.com/product_img/$product_img'></td></tr>
                   <tr><td>Product Code:</td><td>$product_code</td></tr>
                   <tr><td>Product Color:</td><td>$product_color</td></tr>
                   <tr><td>Product Price:</td><td>$product_price</td></tr>
				   <tr><td>Product No.:</td><td>$product_cnt</td></tr>
                   
			</table>
		</body></html>";
 
		 $headers =  "From:fahair.com\r\n";
		 $headers .= 'MIME-Version: 1.0' . "\r\n";
         $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 

		 
		
		
        mail($to,$subject,html_entity_decode($body),$headers);
		
}

if(isset($_POST['email_1']))
{    
     $user_email=$_POST['user_email'];
	 
	
	
	  
	 
	 $tradecode=$_POST['tradecode'];
     $status=$_POST['status'];
     $trans_company=$_POST['trans_company'];
     $trans_number=$_POST['trans_number'];
    
     
	 $to = $user_email;
     $from = "info@fahair.com";
     $subject = "User Trans Details";

$body = "<html><body>
              <p><strong>New Product Details</strong></p>
              <table border ='2'>
                   <tr><td>Order Name :</td><td>$tradecode</td></tr>
                   <tr><td>Status:</td><td>$status</td></tr>
                   <tr><td>Trans Company:</td><td>$trans_company</td></tr>
                   <tr><td>Trans number:</td><td>$trans_number</td></tr>
				   
                   
			</table>
		</body></html>";
 
		 $headers =  "From:fahair.com\r\n";
		 $headers .= 'MIME-Version: 1.0' . "\r\n";
         $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 

		 
		
		
        mail($to,$subject,html_entity_decode($body),$headers);
		
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

                              <td align="left" class="white-18">Orders</td>

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
                      <form action="" method="post">
                      <input type="hidden" name="user_email" value="<?=$trade_row['userid']?>" id="user_email" />
                      <table width="100%" cellpadding="3" cellspacing="3">
                      <tr><td colspan="7" align="center"><h2>Managing Orders</h2></td></tr>
                      
                      <tr><th width="15%" align="center">Ordering Number</th>
                      <th width="15%" align="center">Ordered Date</th>
                      <th width="10%" align="center">Delete</th>
                      <th width="10%" align="center">E-mail</th>
                      <th width="10%" align="center">Status</th>
                      <th width="10%" align="center">Trans Company</th>
                      <th width="10%" align="center">Trans Number</th>
                      <th width="10%" align="center"></th>
                      <th width="10%" align="center">E-mail<br />to buyer</th>
                      </tr>
                      
                     
                      <tr><td width="15%" align="center"><input type="hidden" value="<?=$trade_row['tradecode']?>" name="tradecode" /><?=$trade_row['tradecode']?></td>
                      <td width="15%" align="center"><?=$trade_row['date']?></td>
                      <td width="10%" align="center"><a href="buyer_order_list_details.php?act=delete&member_id=<?= $trade_row['id'] ?>&userid=<?=$trade_row['userid']?>&tradecode=<?=$trade_row['tradecode']?>"
                       onclick="return confirm('You want delete this order!');">Delete</a></td>
                     
                      <td width="10%" align="center"><input type="button" id="email" name="email" value="Email" /></td>
                      <td width="10%" align="center">
                                            <select name="status">
<option  value="Ordered" <?php if($trade_row['status']=='Ordered'){?> selected<?php } ?>>
Ordered</option>
<option value="Confirming Payment" <?php if($trade_row['status']=='Confirming Payment'){?> selected<?php } ?>>
Confirming Payment</option>
<option value="Now Shipping" <?php if($trade_row['status']=='Now Shipping'){?> selected<?php } ?>>
Now Shipping</option>
<option value="Shipping Completed" <?php if($trade_row['status']=='Shipping Completed'){?> selected<?php } ?> >
Shipping Completed</option>
<option value="Order Cancelled" <?php if($trade_row['status']=='Order Cancelled'){?> selected<?php } ?>>
Order Cancelled</option>
<option value="Returning" <?php if($trade_row['status']=='Returning'){?> selected<?php } ?>>
Returning</option>
<option value="Not Paid" <?php if($trade_row['status']=='Not Paid'){?> selected<?php } ?>>
Not Paid</option>
<option value="Paypal Not Paid" <?php if($trade_row['status']=='Paypal Not Paid'){?> selected<?php } ?>>
Paypal Not Paid</option>
<option value="PAID" <?php if($trade_row['status']=='PAID'){?> selected<?php } ?>>
PAID</option>
                                            </select></td>
                      <td width="10%" align="center"><input  type="text" name="trans_company" size="12" value="<?=$trade_row['trans_company']?>"></td>
                      <td width="10%" align="center"><input  type="text" name="trans_number" size="12" value="<?=$trade_row['trans_number']?>"></td>
                      <td width="10%" align="center"><input type="submit" name="submit" value="Update" /></td>
                       <td width="10%" align="center"><input type="submit" name="email_1" value="Email" onclick="alert('You mail successfully sent to <?=$trade_row['userid']?>');" /></td>
                      </tr>
                      
                      <tr><td colspan="9"><hr color="#CCCCCC"><hr color="#CCCCCC"></td></tr>
                      
                     
                      </table>
                      </form>
                      </td>
                      </tr>
                                        
                          
                          
                          
                      <tr>
                      <td><table width="100%" cellpadding="3" cellspacing="3">
                      <tr><td colspan="6" align="center"><h2>List Ordering</h2></td></tr>
                       
                      <tr>
                      <th width="15%" align="center">Product Name</th>
                      <th width="10%" align="center">Product Code</th>
                      <th width="15%" align="center">Option</th>
                      <th width="10%" align="center">Price/ Quantity</th>
                      <th width="10%" align="center">Subtotal</th>
                      <th width="10%" align="center">Ship Status</th>
                      <th width="10%" align="center"> Ship details</th>
                      <th width="10%" align="center">Order to Supplier</th>
                      <th width="10%" align="center">Return</th>
                      </tr>
                       <tr><td colspan="9"><hr color="#CCCCCC"></td></tr>
                      <?php
                      $count=0;	
					   while($trade_goods_row=mysql_fetch_assoc($stmt)){
					   $userid= $trade_goods_row['userid'];
					       $ordered_user = mysql_fetch_array(mysql_query("SELECT * FROM `member` where email='$userid'"));
						   $level=$ordered_user['level'];
			           $count++;
                       $product_row=mysql_fetch_assoc(mysql_query("SELECT * FROM `product` where id='$trade_goods_row[goodsId]'"));
					   //echo "SELECT * FROM `product` where id='$trade_goods_row[goodsId]'";
                       
                       if (strpos($product_row['images'],',') !== false) {
                       $product_img=explode(',',$product_row['images']);
                       $product_img=$product_img[0];
					    }
                        else{
                      $product_img=$product_row['images'];	
                          }
						  
					   $lenght=explode('-',$trade_goods_row['option2']);
                       $lenght=$lenght[1];	
					   
					   $subtotal +=$trade_goods_row['cnt']*$trade_goods_row['price'];	
                       ?>
                      <tr>
                      <td width="8%" align="center">
                      
                     <table><tr>
                      <td width="10%" align="center"><img width="100" height="100" src="../product_img/<?=$product_img?>" ></td>
					  <td width="5%" align="center"><?=$product_row['product_name']?></td>
                      </tr></table>
                      </td>
                      <td width="10%" align="center"><?=$product_row['product_code']?></td>
                      <td width="15%" align="center"><?=$lenght?>"/<?= $trade_goods_row['option1']?></td>
                       <? if($level==2){ 
					   
					      
	                        $userprice=explode(',',$product_row['wholesaleprice2']);
	                         $price1=$userprice[$trade_goods_row['option_index']];
					   
					   
					   ?>
                      <td width="10%" align="center">$<?=$price1."/".$trade_goods_row['cnt']?></td>
                      <? }else{ ?>
                      <td width="10%" align="center">$<?= $trade_goods_row['price']."/".$trade_goods_row['cnt']?></td>
                       <? } ?>
                      <? if($level==2){
					   
	                        $userprice=explode(',',$product_row['wholesaleprice2']);
	                         $price1=$userprice[$trade_goods_row['option_index']];
					    ?>
                        <td width="10%" align="center">$<?=$trade_goods_row['cnt']*$price1?></td>
                      <? }else{ ?>
                         <td width="10%" align="center">$<?=$trade_goods_row['cnt']*$trade_goods_row['price']?></td>
                      <? } ?>
                      <td width="10%" align="center">
                      <select name="shipping_status">
                      <option value="0">Select </option>
                      <option value="1" <?php if($trade_goods_row['shipping_status'] =='1'){ ?> selected <?php } ?>>Not Ship Yet</option>
                      <option value="2" <?php if($trade_goods_row['shipping_status'] =='2'){ ?> selected <?php } ?>>Ship Completed</option>
                      <option value="3" <?php if($trade_goods_row['shipping_status'] =='3'){ ?> selected <?php } ?> >Out of Stock</option>
                      </select>

                      
                      </td>
                      <td width="10%" align="center">Trans Company :<br />
                                           <select name="trans_company">
<option value ="USPS" <?php if($product_row['shipping_method'] =='USPS'){ ?> selected <?php } ?>>USPS</option>
<option value ="SINA SHIPPING" <?php if($product_row['shipping_method'] =='SINA SHIPPING'){ ?> selected <?php } ?>>SINA SHIPPING</option>
<option value ="UPS" <?php if($product_row['shipping_method'] =='UPS'){ ?> selected <?php } ?>>UPS</option>
<option value ="DHL" <?php if($product_row['shipping_method'] =='DHL'){ ?> selected <?php } ?>>DHL</option>
<option value ="Fedex" <?php if($product_row['shipping_method'] =='Fedex'){ ?> selected <?php } ?>>Fedex</option>
<option value ="FREE SHIPPING" <?php if($product_row['shipping_method'] =='FREE SHIPPING'){ ?> selected <?php } ?>>FREE SHIPPING</option>
</select><br />
                                                     Tracking  : <br /><input type="text" name="tracking" value="<?= $trade_goods_row['tracking'] ?>" />
                                                     </td>
                       <form method="post"  action="" >   
                 <input type="hidden" name="product_name" value="<?=$product_row['product_name']?>"  /> 
                 <input type="hidden" name="product_img" value="<?=$product_img?>"  />  
                 <input type="hidden" name="product_code" value="<?=$product_row['product_code']?>"  /> 
                 <input type="hidden" name="product_color" value="<?=$color?>"  /> 
                 <input type="hidden" name="product_price" value="<?=$trade_goods_row['price']?>"  /> 
                 <input type="hidden" name="product_cnt" value="<?=$trade_goods_row['cnt']?>"  />  
                 <input type="hidden" name="user_id" value="<?=$product_row['user_id']?>"  />          
                                               
                      <td width="10" align="center">
                  <input type="submit" name="submit1" value="E-Mail" onclick="show_alert();" 
                   style="border:0px; background:transparent;"  /></td>
                    
                   <script>
                  function show_alert() {
                  alert("Your Mail Send Successfully to Supplier");
                    }
                  </script>
                   </form>
                   <form method="post"  action="" name= "form1">
                  <td width="10%" align="center">
                  <input type="hidden" name="retuen_issue_id" value ="<?=$trade_goods_row['id'] ?>" />
                  <select name="return_status">
                  <option value="0">Select</option>
                  <option value="1" <?php if($trade_goods_row['return_issue'] =='1'){ ?> selected <?php } ?>>Not Return</option>
                  <option value="2" <?php if($trade_goods_row['return_issue'] =='2'){ ?> selected <?php } ?>>Missing Item</option>
                  <option value="3" <?php if($trade_goods_row['return_issue'] =='3'){ ?> selected <?php } ?>>Wrong Shipment</option>
                  <option value="4" <?php if($trade_goods_row['return_issue'] =='4'){ ?> selected <?php } ?>>Quality Issue</option>
                  <option value="5" <?php if($trade_goods_row['return_issue'] =='5'){ ?> selected <?php } ?>>Defective Product</option>
                  <option value="6" <?php if($trade_goods_row['return_issue'] =='6'){ ?> selected <?php } ?>>Damaged Product</option>
                  </select>
                  <br />
                  <input align="middle" type="submit" name="submit3" value="Update" />
                   </td></form>
                                        </tr>
                      
                      <tr><td colspan="9"><hr color="#CCCCCC"></td></tr>
                     <?php } 
					  ?>
                      </table>
                      </td>
                      </tr>
                                        
                          
                      <tr>
                      <td><table width="100%" cellpadding="3" cellspacing="3">
                      <tr>
                      <td colspan="2" align="center"><h2>Payment Information</h2></td>
                      </tr>
                      <tr>
                      
                      <td width="8%" align="left"><strong>Subtotal</strong></td>
                      <td width="8%" align="left">$<?=number_format($trade_row['totalM'],2)?></td>
                      </tr>
                     
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong>Shipping Price/Shipping Method</strong></td>
                      <td width="8%" align="left">$<?=number_format($trade_row['shipM'],2) ?>&nbsp; &nbsp;/&nbsp; &nbsp;<?=$trade_row['servicechoose']?></td>
                      </tr>
                      <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                       <tr>
                      <td width="8%" align="left"><strong>Tax</strong></td>
                      <td width="8%" align="left">$<?=$trade_row['tax']?></td>
                      </tr>
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong>Used Points</strong></td>
                      <td width="8%" align="left"><?=$trade_row['credit_used']?></td>
                      </tr>
                        <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong>Credit/Used Coupon</strong></td>
                      <? 
					  if($trade_row['subdomainurl']){
					  $user =mysql_fetch_array(mysql_query("select * from member where subdomainurl='$trade_row[subdomainurl]'")); 
					  //echo "select * from member where subdomainurl='$trade_row[subdomainurl]'";
					  }else{
					  $user =mysql_fetch_array(mysql_query("select * from member where refcode='$trade_row[coupon_code]'")); 
					  }
					  
					  ?>
                      
                      <td width="8%" align="left"><a href="register_member_edit.php?member_id=<?=$user['member_id']?>">$<?=$trade_row['discount']?>
                      <? if($trade_row['subdomainurl']){ ?>
                      (<?=$trade_row['subdomainurl']?>)
                      <? }else{ ?>
                      (<?=$trade_row['coupon_code']?>)
                      <? } ?>
                      </a></td>
                      </tr>
                    <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                    
                    <td width="8%" align="left"><strong>Ebha Store </strong></td>
                      <? $storeid=$trade_row['storeid'];
					  $storedetail= mysql_fetch_array(mysql_query("SELECT * FROM `store` where id='$storeid'")); ?>
                      
                      <td width="8%" align="left"><?=$storedetail['s_name']?></td>
                      </tr>
                    <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                    
                    <tr>
                      <td width="8%" align="left"><strong>Shiping cost for other country</strong></td>
                      <td width="8%" align="left">$<?=number_format($trade_row['shipotherM'],2) ?></td>
                      </tr>
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>

                      <tr>
                      <td width="8%" align="left"><strong> Total amount you will pay</strong></td>
                      <td width="8%" align="left">$<?=number_format($trade_row['payM'],2)  ?></td>
                      </tr>
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong> Payment Method</strong></td>
                      <td width="8%" align="left"><?=$trade_row['paymethod']?> </td>
                      </tr>
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong>Shipping Method</strong></td>
                      <td width="8%" align="left"><?=$product_row['shipping_method']?></td>
                      </tr>
                      
                    <?   if($trade_row['order_type']=='Pickup') { ?>
                      
                      <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong>Pickup Store Name</strong></td>
                      <td width="8%" align="left"><?=$storerow['s_name']?></td>
                      </tr>
                      
                      <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong>Pickup Store Phone</strong></td>
                      <td width="8%" align="left"><?=$storerow['s_phone']?></td>
                      </tr>
                      
                     <? }  ?>
                      
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      </table>
                      </td>
                      </tr>
                      
                          <?php  
						  $useremail=$trade_row['userid'];
						 // echo "select * from member email='$useremail'";
						 $customerinfo =mysql_fetch_array(mysql_query("select * from member where email='$useremail'"));
						  
						  
						  ?>
                           <tr>
                      <td><table width="100%" cellpadding="3" cellspacing="3">
                      <tr>
                      <td colspan="2" align="center" ><h2>Billing Information</h2></td>
                      </tr>
                      <tr>
                      <td width="8%" align="left"><strong>Customer</strong></td>
                      <td width="8%" align="left"><?=$trade_row['userid']?></td>
                      </tr>
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong>Name</strong></td>
                      <td width="8%" align="left"><?=$trade_row['name1']?> <?=$trade_row['name2']?></td>
                      </tr>
                      <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                       
                      <tr>
                      <td width="8%" align="left"><strong>Address</strong></td>
                      <td width="8%" align="left"><?=$trade_row['adr1']?> <?=$trade_row['adr2']?></td>
                      </tr>
                    <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong>City</strong></td>
                      <td width="8%" align="left"><?=$trade_row['city']?></td>
                      </tr>
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <?php $state = mysql_result(mysql_query("select state_name from state where state_id ='$trade_row[state]' "),0);
					        $country = mysql_result(mysql_query("select country_name from country where country_id ='$trade_row[country]' "),0);
					  
					   ?>
                      <tr>
                      <td width="8%" align="left"><strong>State/Country</strong></td>
                      <td width="8%" align="left"><?=$state?>/<?=$country?></td>
                      </tr>
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong>Zip Code</strong></td>
                      <td width="8%" align="left"><?=$trade_row['zip']?></td>
                      </tr>
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                     <tr>
                      <td width="8%" align="left"><strong>Phone Number</strong></td>
                      <td width="8%" align="left"><?=$customerinfo['tel']?></td>
                      </tr>
                       <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      
                      </table>
                      </td>
                      </tr>
                     
                     
                     
                                 <tr>
                      <td><table width="100%" cellpadding="3" cellspacing="3">
                      <tr><td colspan="2" align="center" ><h2>Shipping Address Information</h2></td></tr>
                      
                      <tr>
                      <td width="8%" align="left"><strong>Name</strong></td>
                      <td width="8%" align="left"> <?=$trade_row['rname2']?></td>
                      </tr>
                      <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                     
                      <tr>
                      <td width="8%" align="left"><strong>Address</strong></td>
                      <td width="8%" align="left"><?=$trade_row['radr1']?> </td>
                      </tr>
                    <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong>City</strong></td>
                      <td width="8%" align="left"><?=$trade_row['rcity']?></td>
                      </tr>
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <?php $rstate = mysql_result(mysql_query("select state_name from state where state_id ='$trade_row[rstate]' "),0);
					        $rcountry = mysql_result(mysql_query("select country_name from country where country_id ='$trade_row[rcountry]' "),0);
					  
					   ?>
                      <tr>
                      <td width="8%" align="left"><strong>State/Country</strong></td>
                      <td width="8%" align="left"><?=$rstate?>/<?=$rcountry?></td>
                      </tr>
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                      <tr>
                      <td width="8%" align="left"><strong>Zip Code</strong></td>
                      <td width="8%" align="left"><?=$trade_row['rzip']?></td>
                      </tr>
                     <tr><td colspan="2"><hr color="#CCCCCC" /></td></tr>
                     <tr>
                      <td width="8%" align="left"><strong>Ship to Phone Number</strong></td>
                      <td width="8%" align="left"></td>
                      </tr>
                      
                     
                      
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


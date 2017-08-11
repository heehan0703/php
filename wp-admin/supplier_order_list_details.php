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
$trade_row= mysql_fetch_assoc(mysql_query("SELECT id,tradecode,userid_part,totalM,userid,shipM,payM,paymethod,shipotherM,
DATE_FORMAT(FROM_UNIXTIME(`writeday`), '%m-%d-%Y') as date,
name1,name2,adr1,adr2,city,state,country,zip,rname1,rname2,radr1,radr2,rcity,rstate,rcountry,rzip,totalweight,order_status,
order_status,status,trans_company,trans_number
 FROM `trade` where id='$id' "));

  

$stmt =mysql_query("SELECT * FROM `trade_goods` where tradecode='$trade_row[tradecode]'");	


if(isset($_POST['change_order']) && $_POST['change_order']!=''){
 $change_order = $_POST['change_order'];
 $tradecode_trade = $_POST['tradecode_trade'];
 mysql_query("UPDATE `trade` SET `order_status`='$change_order' WHERE `tradecode`='$tradecode_trade'");	
}


if(isset($_POST['tradecode_hddn']) && $_POST['request_status']!=''){
//print_r($_POST);
$request_status = $_POST['request_status'];
$tradecode_hddn = $_POST['tradecode_hddn'];
$trade_goods_id = $_POST['trade_goods_id'];

mysql_query("UPDATE `trade` SET `return_status`='$request_status' WHERE `tradecode`='$tradecode_hddn'");
mysql_query("update  `trade_goods` set return_status='$request_status' where tradecode='$tradecode_hddn' and id='$trade_goods_id'");
	
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
                      <td><table width="100%" cellpadding="3" cellspacing="3">
                      <tr><td colspan="7" align="center"><h2>Managing Orders</h2></td></tr>
                      <tr><th width="8%" align="center">Ordering Number</th>
                      <th width="8%" align="center">Ordered Date</th>
                      <th width="8%" align="center">Delete</th>
                      <th width="8%" align="center">E-mail</th>
                      <th width="8%" align="center">Status</th>
                      <th width="8%" align="center">Trans Company</th>
                      <th width="8%" align="center">Trans Number</th>
                      <th width="8%" align="center">Order Status</th>
                      </tr>
                     
                      <tr><td width="8%" align="center"><?=$trade_row['tradecode']?></td>
                      <td width="8%" align="center"><?=$trade_row['date']?></td>
                      <td width="8%" align="center"><input type="button" id="del1" name="del1" value="Delete" /></td>
                      <td width="8%" align="center"><input type="button" id="email" name="email" value="Email" /></td>
                      <td width="8%" align="center"><input  type="text" name="trans_company" size="12" value='<?=$trade_row['']?>'></td>
                      <td width="8%" align="center"><input  type="text" name="trans_company" size="12" value='<?=$trade_row['']?>'></td>
                      <td width="8%" align="center"><input  type="text" name="trans_num" size="12" value='<?=$trade_row['']?>'></td>
                      <td width="8%" align="center">
                      <form action="" method="post">
                      <input type="hidden" name="tradecode_trade" value="<?=$trade_row['tradecode']?>"  >
                      <select name="change_order" onchange="this.form.submit()">
                     
                      <option value="">Order Status</option>
                      <option value="Cancel" <? if($trade_row['order_status']=='Cancel'){?> selected="selected" <? }?> >Cancel</option>
                   <option value="Complete" <? if($trade_row['order_status']=='Complete'){?> selected="selected" <? }?> >Complete</option>
                      </select>
                      </form>
                      </td>
                      </tr>
                     
                      </table>
                      </td>
                      </tr>
                                        
                          
                          
                          
                      <tr>
                      <td><table width="100%" cellpadding="3" cellspacing="3">
                      <tr><td colspan="5" align="center"><h2>List Ordering</h2></td></tr>
                      <tr><th width="8%" align="center">Product Name</th>
                      <th width="8%" align="center">Product Code</th>
                      <th width="8%" align="center">Option</th>
                      <th width="8%" align="center">Price/ Quantity</th>
                      <th width="8%" align="center">Subtotal</th>
                        <th width="8%" align="center">Return Status</th>
                      </tr>
                      <?php
                      $count=0;	
					   while($trade_goods_row=mysql_fetch_assoc($stmt)){
						  
			           $count++;
                       $product_row=mysql_fetch_assoc(mysql_query("SELECT * FROM `product` where id='$trade_goods_row[goodsId]'"));
                       
                       if (strpos($product_row['images'],',') !== false) {
                       $product_img=explode(',',$product_row['images']);
                       $product_img=$product_img[0];
					    }
                        else{
                      $product_img=$product_row['images'];	
                          }
						  
					   $color=explode('-',$trade_goods_row['option1']);
                       $color=$color[1];	
					   
					   $subtotal +=$trade_goods_row['cnt']*$trade_goods_row['price'];	
                       ?>
                     
                      <tr>
                      <td width="8%" align="center">
                      <table><tr>
                      <td width="8%" align="center"><img width="100" height="100" src="../product_img/<?=$product_img?>" ></td>
					  <td width="8%" align="center"><?=$product_row['product_name']?></td>
                      </tr></table>
                      </td>
                      <td width="8%" align="center"><?=$product_row['product_code']?></td>
                      <td width="8%" align="center"><?=$color?></td>
                      <td width="8%" align="center">$<?= $trade_goods_row['price']."/".$trade_goods_row['cnt']?></td>
                      <td width="8%" align="center">$<?=$trade_goods_row['cnt']*$trade_goods_row['price']?></td>
                        <td width="8%" align="center">
               <form method="post" action="">
              
              <input type="hidden" name="trade_goods_id" id="trade_goods_id" value="<?=$trade_goods_row['id']?>"  />
              <input type="hidden" name="tradecode_hddn" value="<?=$trade_goods_row['tradecode']?>"  />
              <select name="request_status" onchange="this.form.submit()">
                      <option value="">Request Status</option> 
     <option value="return_request" <? if($trade_goods_row['return_status']=='return_request') {?> selected="selected"<? } ?> >Return Request</option>
     <option value="return_process" <? if($trade_goods_row['return_status']=='return_process') {?> selected="selected"<? } ?>>Return Process</option> 
                        </select>
                        </form>
                        </td>
                      </tr>
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
                      <td width="8%" align="left">$<?=$subtotal?></td>
                      </tr>
                     
                      <tr>
                      <td width="8%" align="left"><strong>Shipping Price</strong></td>
                      <td width="8%" align="left">$<?=$trade_row['shipM']?></td>
                      </tr>
                      
                       <tr>
                      <td width="8%" align="left"><strong>Tax</strong></td>
                      <td width="8%" align="left"></td>
                      </tr>
                     
                      <tr>
                      <td width="8%" align="left"><strong>Used Points</strong></td>
                      <td width="8%" align="left"></td>
                      </tr>

                      <tr>
                      <td width="8%" align="left"><strong>Used Coupon</strong></td>
                      <td width="8%" align="left"></td>
                      </tr>
                      
                      <tr>
                      <td width="8%" align="left"><strong>Shipping Other Country</strong></td>
                      <td width="8%" align="left"><?=$trade_row['shipotherM']?></td>
                      </tr>

                    
                      <tr>
                      <td width="8%" align="left"><strong> Total amount you will pay</strong></td>
                      <td width="8%" align="left">$<?=number_format($subtotal + $trade_row['shipM'] + $trade_row['shipotherM'],2)  ?></td>
                      </tr>
                     
                      <tr>
                      <td width="8%" align="left"><strong> Payment Method</strong></td>
                      <td width="8%" align="left"><?=$trade_row['paymethod']?> </td>
                      </tr>
                     
                      <tr>
                      <td width="8%" align="left"><strong>Shipping Method</strong></td>
                      <td width="8%" align="left"><?=$product_row['shipping_method']?></td>
                      </tr>
                     
                      </table>
                      </td>
                      </tr>
                      
                          <?php  ?>
                           <tr>
                      <td><table width="100%" cellpadding="3" cellspacing="3">
                      <tr>
                      <td colspan="2" align="center" ><h2>Order Information</h2></td>
                      </tr>
                      <tr>
                      <td width="8%" align="left"><strong>Customer</strong></td>
                      <td width="8%" align="left"><?=$trade_row['userid']?></td>
                      </tr>
                     
                      <tr>
                      <td width="8%" align="left"><strong>Name</strong></td>
                      <td width="8%" align="left"><?=$trade_row['name1']?> <?=$trade_row['name2']?></td>
                      </tr>
                      
                       
                      <tr>
                      <td width="8%" align="left"><strong>Address</strong></td>
                      <td width="8%" align="left"><?=$trade_row['adr1']?> <?=$trade_row['adr2']?></td>
                      </tr>
                    
                      <tr>
                      <td width="8%" align="left"><strong>City</strong></td>
                      <td width="8%" align="left"><?=$trade_row['city']?></td>
                      </tr>
                     
                      <tr>
                      <td width="8%" align="left"><strong>State/Country</strong></td>
                      <td width="8%" align="left"><?=$trade_row['state']?>/<?=$trade_row['country']?></td>
                      </tr>
                     
                      <tr>
                      <td width="8%" align="left"><strong>Zip Code</strong></td>
                      <td width="8%" align="left"><?=$trade_row['zip']?></td>
                      </tr>
                     
                     <tr>
                      <td width="8%" align="left"><strong>Phone Number</strong></td>
                      <td width="8%" align="left"><?=$trade_row['']?></td>
                      </tr>

                      
                      </table>
                      </td>
                      </tr>
                     
                     
                     
                           <tr>
                      <td><table width="100%" cellpadding="3" cellspacing="3">
                      <tr><td colspan="2" align="center" ><h2>Shipping Address Information</h2></td></tr>
                      
                      <tr>
                      <td width="8%" align="left"><strong>Name</strong></td>
                      <td width="8%" align="left"><?=$trade_row['rname1']?> <?=$trade_row['rname2']?></td>
                      </tr>
                      
                     
                      <tr>
                      <td width="8%" align="left"><strong>Address</strong></td>
                      <td width="8%" align="left"><?=$trade_row['radr1']?> <?=$trade_row['radr2']?></td>
                      </tr>
                    
                      <tr>
                      <td width="8%" align="left"><strong>City</strong></td>
                      <td width="8%" align="left"><?=$trade_row['rcity']?></td>
                      </tr>
                     
                      <tr>
                      <td width="8%" align="left"><strong>State/Country</strong></td>
                      <td width="8%" align="left"><?=$trade_row['rstate']?>/<?=$trade_row['rcountry']?></td>
                      </tr>
                     
                      <tr>
                      <td width="8%" align="left"><strong>Zip Code</strong></td>
                      <td width="8%" align="left"><?=$trade_row['rzip']?></td>
                      </tr>
                     
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


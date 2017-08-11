<?php

session_start();

require_once('include/connectdb.php');




if($_SESSION["ADMIN_ID"]==""){
	
header("location:login.php");	
	
	exit;
	 } 
	

 $user_id=$_GET['member_id'];
 


$member_row=mysql_fetch_assoc(mysql_query("select * from   `member` where member_id='$user_id'"));

 $query1 = mysql_query("SELECT * FROM `product` where user_id=$user_id");
 $query2=mysql_num_rows($query1);

//$order = mysql_query("SELECT * FROM `trade` where userid='$GOOD_SHOP_USERID'");
//$order_count=mysql_num_rows($order);

$order_count=mysql_result(mysql_query("SELECT count(distinct td.tradecode)  FROM `trade_goods` as td left join `trade` as t on td.tradecode=t.tradecode where td.supplier_id='$user_id' "),0);

$order_cancel_count = mysql_result(mysql_query("SELECT count(distinct td.tradecode)  FROM `trade_goods` as td left join `trade` as t on td.tradecode=t.tradecode where td.supplier_id='$user_id' and t.order_status='Cancel'"),0);

$order_complete_count=mysql_result(mysql_query("SELECT count(distinct td.tradecode)  FROM `trade_goods` as td left join `trade` as t on td.tradecode=t.tradecode where td.supplier_id='$user_id' and t.order_status='Complete'"),0);

//$return_request_count=mysql_result(mysql_query("select count(t.id) from `trade_goods` where supplier_id='$user_id' and td.return_issue IN (1,2,3,4,5) "),0);
$return_request_count=mysql_result(mysql_query("SELECT count(t.id) FROM trade t left join trade_goods td on td.tradecode=t.tradecode where td.supplier_id='$user_id' and td.return_issue IN (1,2,3,4,5) "),0);
//$return_process_count=mysql_result(mysql_query("select count(t.id) from `trade_goods` where supplier_id='$user_id' and td.return_issue IN (1,2,3,4,5) "),0);
$return_process_count=mysql_result(mysql_query("SELECT count(t.id) FROM trade t left join trade_goods td on td.tradecode=t.tradecode where td.supplier_id='$user_id' and td.return_issue IN (1,2,3,4,5) "),0);

//$return_amount=mysql_result(mysql_query("SELECT count(cnt)*sum(price)  FROM `trade_goods`  where supplier_id='$user_id' and return_status='return_process' "),0);
$return_amount=mysql_result(mysql_query("SELECT sum(td.price*td.cnt) FROM trade t left join trade_goods td on td.tradecode=t.tradecode where td.supplier_id='$user_id' and td.return_issue IN (1,2,3,4,5) "),0);


//$sale_amount=mysql_result(mysql_query("SELECT sum(payM)  FROM `trade` where userid='$GOOD_SHOP_USERID' and order_status='Complete'"),0);

$sale_amount=mysql_result(mysql_query("SELECT sum(td.price*td.cnt) FROM trade t left join trade_goods td on td.tradecode=t.tradecode where td.supplier_id='$user_id' "),0);



$percentage_charge=$sale_amount*($member_row['fee_rate']/100);

$view_count=mysql_result(mysql_query("SELECT sum(product_seen)  FROM `product` where user_id='$user_id'"),0);



//print_r($sale_amount);
//$sale_amount_sum=mysql_fetch_assoc($sale_amount);

 $current=time();

$lastmonth=strtotime("-30 day");

$lastmonth_sale=mysql_result(mysql_query("SELECT sum(t.payM) FROM `trade` as t left join `trade_goods` as td on td.tradecode=t.tradecode where td.supplier_id='$user_id' and t.writeday>=$lastmonth and t.writeday<=$current and t.order_status='Complete'"),0);

 
 $query_supplier=mysql_query("select * from supplier_account_details where member_id ='$user_id'");
 $query_supplier_row2 =mysql_fetch_assoc($query_supplier);
 if(isset($_POST['submit']))
 {
     
	 $order_count_1=$_POST['order_count'];
	 $order_cancel_count_1=$_POST['order_cancel_count'];
	 $order_complete_count_1=$_POST['order_complete_count'];
	 $sale_amount_1=$_POST['sale_amount'];
	 $return_request_count_1=$_POST['return_request_count'];
	 $return_process_count_1=$_POST['return_process_count'];
	 $return_amount_1=$_POST['return_amount'];
	 $fee_rate_1=$_POST['fee_rate'];
	 $listing_fee_1=$_POST['listing_fee'];
	 $listing_Beautco_1=$_POST['listing_Beautco'];
	 $lastmonth_sale_1=$_POST['lastmonth_sale'];
	 $balance_Invoice_1=$_POST['balance_Invoice'];
	 $member_status_1=$_POST['member_status'];
	 $request_upgrade_1=$_POST['request_upgrade'];
	 $request_downgrade_1=$_POST['request_downgrade'];
	 
	 $query_supplier_row1= mysql_num_rows($query_supplier);
	 
	 if($query_supplier_row1>0)
	 {
		 mysql_query("update supplier_account_details set order_count ='$order_count_1',
		                                      order_cancel_count='$order_cancel_count_1',
											  order_complete_count='$order_complete_count_1',
											  sale_amount='$sale_amount_1',
											  return_request_count='$return_request_count_1',
											  return_process_count='$return_process_count_1',
											  return_amount='$return_amount_1',
											  fee_rate='$fee_rate_1',
											  listing_fee='$listing_fee_1',
											  listing_Beautco='$listing_Beautco_1', 
											  lastmonth_sale='$lastmonth_sale_1',
											  balance_Invoice='$balance_Invoice_1',
											  member_status='$member_status_1',
											  request_upgrade='$request_upgrade_1',
											  request_downgrade='$request_downgrade_1'
											  where member_id ='$user_id'");
		
		 
		 
											   
	 }
	 else
	 {
		 
		 mysql_query( "insert into supplier_account_details (member_id,order_count,order_cancel_count,order_complete_count,sale_amount,return_request_count,return_process_count,return_amount,fee_rate,listing_fee,listing_Beautco,lastmonth_sale,balance_Invoice,member_status,request_upgrade,request_downgrade) values ('$user_id','$order_count_1','$order_cancel_count_1','$order_complete_count_1','$sale_amount_1','$return_request_count_1','$return_process_count_1','$return_amount_1','$fee_rate_1','$listing_fee_1','$listing_Beautco_1','$lastmonth_sale_1','$balance_Invoice_1','$member_status_1','$request_upgrade_1','$request_downgrade_1')");

			
	 }
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

                              <td align="left" class="white-18">Supplier Account</td>

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
                      <td><table width="100%"  cellpadding="3" cellspacing="3">
                      <form action="" method="post">
                      
     <tr>
     <td  align="center" colspan="2"> <h3>Listing Status</h3> </td></tr>
     <tr><td colspan="2"><hr / color="#CCCCCC"></td></tr>
     <tr><td  align="left">Total Listing</td><td  align="left"><?=$query2;?></td></tr>
     <tr><td colspan="2"><hr / color="#CCCCCC"></td></tr>
     <tr><td  align="left">View count</td><td  align="left"><?=$view_count?></td></tr>
     <tr><td colspan="2"><hr / color="#CCCCCC"></td></tr>
     <tr><td  align="center" colspan="2"> <h3>Transaction</h3></td></tr>
      <tr><td colspan="2"><hr / color="#CCCCCC"></td></tr>
    
     <tr><td  align="left">Order</td>
     <td  align="left"><input type="text" value="<?=$query_supplier_row2['order_count']?>" name="order_count" id ="order_count" /></td></tr>
     <tr><td colspan="2"><hr / color="#CCCCCC"></td></tr>
     <tr><td  align="left">Order Cancelg</td><td  align="left"><input type="text" name="order_cancel_count" id="order_cancel_count" value="<?=$query_supplier_row2['order_cancel_count']?>" /></td></tr>
     <tr><td colspan="2"><hr / color="#CCCCCC"></td></tr>
     <tr><td  align="left">Order complete</td><td  align="left"><input type="text" name="order_complete_count" id="order_complete_count" value="<?=$query_supplier_row2['order_complete_count']?>" /></td></tr>
     <tr><td colspan="2"><hr / color="#CCCCCC"></td></tr>
     <tr><td  align="left">Sale amount</td><td  align="left"><input type="text" name="sale_amount" id="sale_amount" value="<?=$query_supplier_row2['sale_amount'];?>" /></td></tr>
     <tr><td colspan="2"><hr / color="#CCCCCC"></td></tr>
     <tr><td  align="center" colspan="2"> <h3> Return</h3></td></tr>
     <tr><td colspan="2"><hr / color="#CCCCCC"></td></tr>
     <tr><td  align="left">Return request</td><td  align="left"><input type="text" name="return_request_count" id="return_request_count" value="<?=$query_supplier_row2['return_request_count']?>" /></td></tr>
     <tr><td><td colspan="2"><hr / color="#CCCCCC"></td></tr>
     <tr><td  align="left">Return process</td><td  align="left"><input type="text" name="return_process_count" id="return_process_count" value="<?=$query_supplier_row2['return_process_count']?>" /></td></tr>
     <tr><td colspan="2"><hr / color="#CCCCCC"></td></tr>
     <tr><td  align="left">Return amount</td><td  align="left"><input type="text" name="return_amount" id="return_amount" value="<?=$query_supplier_row2['return_amount']?>" /></td></tr>
     <tr><td colspan="2"><hr / color="#CCCCCC"></td></tr>
      <tr><td  align="center" colspan="2"> <h3> Payments and Fees</h3></td></tr>
      <tr><td colspan="2"><hr / color="#CCCCCC"></td></tr>
       <tr><td  align="left">Fee rate(%)</td><td  align="left"><input type="text" name="fee_rate" id="fee_rate" value="<?=$query_supplier_row2['fee_rate']?>" /></td></tr>
       <tr><td colspan="2"><hr / color="#CCCCCC"></td></tr>
        <tr><td  align="left">Listing fee($ per listing)</td><td  align="left">
		<input type="text" name="listing_fee" id="listing_fee" value="<?=$query_supplier_row2['listing_fee']?>" />
		</td></tr>
        <tr><td colspan="2"><hr / color="#CCCCCC"></td></tr>
        <tr><td  align="left">(if listing through Beautco)</td><td  align="left"><input type="text" name="listing_Beautco" id="listing_Beautco" value="<?=$query_supplier_row2['listing_Beautco']?>" /></td></tr>
        <tr><td colspan="2"><hr / color="#CCCCCC"></td></tr>
        
        
        <tr><td  align="left">Total balance(Last Month)</td><td  align="left"><input type="text" name="lastmonth_sale" id="lastmonth_sale" value="<?=$query_supplier_row2['lastmonth_sale']?>" /></td></tr>
        <tr><td colspan="2"><hr / color="#CCCCCC"></td></tr>
        <tr><td  align="left">Balance Invoice</td><td  align="left"><input type="text" name="balance_Invoice" id="balance_Invoice" value="<?=$query_supplier_row2['balance_Invoice']?>" /></td></tr>
        <tr><td colspan="2"><hr / color="#CCCCCC"></td></tr>
        <tr> <td  align="center" colspan="2"><h3>Membership status</h3> </td></tr>
        <tr><td colspan="2"><hr / color="#CCCCCC"></td></tr>
         <tr> <td  align="left">Current membership status</td><td  align="left"><input type="text" name="member_status" id="member_status" value="<?=$query_supplier_row2['member_status']?>" /></td></tr>
         <tr><td colspan="2"><hr / color="#CCCCCC"></td></tr>
          <tr> <td  align="left">Request for upgrade </td><td  align="left"><input type="text" name="request_upgrade" id="request_upgrade" value="<?=$query_supplier_row2['request_upgrade']?>" /></td></tr>
          <tr><td colspan="2"><hr / color="#CCCCCC"></td></tr>
           <tr> <td  align="left">Request for downgrade </td><td  align="left"><input type="text" name="request_downgrade" id="request_downgrade" value="<?=$query_supplier_row2['request_downgrade']?>" /></td></tr>
           <tr><td colspan="2" align="center"><input type="submit" name="submit" value ="Update" onclick="submit_function()" /></td><td></td></tr>
             <script>
              function submit_function() {
    confirm("you want to update!");
}
</script>

      
	</form>
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


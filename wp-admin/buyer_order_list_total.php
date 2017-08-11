<?php
session_start();
require_once('include/connectdb.php');
//echo $userid;
if($_SESSION["ADMIN_ID"]==""){	
header("location:login.php");		
	exit;
	 } 
	/* 
	  $limit=16;
	 $sql= ("select * from designs where prod_id='0' order by id DESC");
     $result=mysql_query(dopaging($sql,$limit));
	 
*/

if(isset($_POST['submit']))
{    $uid =$_POST['uid'];
	$tradecode = $_POST['tradecode'];
	$userid =$_POST['userid'];
	$order_status = $_POST['order_status'];	
	mysql_query("update `trade` set order_status = '$order_status' where tradecode='$tradecode'");
 	//echo "update `trade` set order_status = '$order_status' where tradecode='$tradecode'";
	if($order_status=="Complete"){
	 $coupon_row=mysql_fetch_array(mysql_query("select * from trade where tradecode='$tradecode'"));
	 $trade_user_id=$coupon_row['userid'];
	$discount=$coupon_row['discount'];
	 $used_credit=$coupon_row['credit_used'];
	 $copuncode=$coupon_row['coupon_code'];
	 
	 $reward=$coupon_row['totalM']-$used_credit-$discount;
	 $reward= $reward*0.15;
	 
	$reward=number_format($reward,2);
	 
	 $order_id=$coupon_row['id'];
	 
	 $subdomainurl=$coupon_row['subdomainurl'];
	 if($subdomainurl){
	         $userdetail=mysql_fetch_array(mysql_query("select * from `member`  where subdomainurl='$subdomainurl'"));
			 $oldcredit=$userdetail['account_credit'];
			 $new_totalcredit=$oldcredit+$reward;
			  $custermer_id=$userdetail['member_id'];
			 
			 $rowresult=mysql_query("select * from rewards where tradecode='$tradecode'");
			$reward_num=mysql_num_rows($rowresult);
			
			if(!$reward_num){
			$ti=time();
			
			mysql_query("insert into rewards set customer_id='$custermer_id',order_id='$order_id',date_complete='$ti',tradecode='$tradecode',reward='$reward', transaction_type='credit'");
			mysql_query("update `member` set account_credit = '$new_totalcredit' where subdomainurl='$subdomainurl'");
			//echo "update `member` set account_credit = '$new_totalcredit' where subdomainurl='$subdomainurl'";
			//debited///////////////
			 $rowcredit= mysql_fetch_array(mysql_query("select * from `member`  where member_id='$trade_user_id' or email='$trade_user_id'"));
			   $debited_customer_id=$rowcredit['member_id'];
			   $olddebetedusercredit=$rowcredit['account_credit'];
			  //echo "dhirendra";
			
			  mysql_query("insert into rewards set customer_id='$debited_customer_id',order_id='$order_id',date_complete='$ti',tradecode='$tradecode',reward='$used_credit', transaction_type='debited'");
			 
			 $new_totaldebited=$olddebetedusercredit-$used_credit;
			// echo "$new_totaldebited--old $olddebetedusercredit  --used--$used_credit";
			 
			// echo "update `member` set account_credit = '$new_totaldebited' where member_id='$debited_customer_id'";
			
			mysql_query("update `member` set account_credit = '$new_totaldebited' where member_id='$debited_customer_id'");
			
			}else if($reward_num==1){
			        
					while($row_reward=mysql_fetch_array($rowresult)){
					      $type=$row_reward['transaction_type'];
					      if($type=='credit'){
						      $rowcredit= mysql_fetch_array(mysql_query("select * from `member`  where member_id='$trade_user_id' or email='$trade_user_id'"));
							  $debited_customer_id=$rowcredit['member_id'];
							  $olddebetedusercredit=$rowcredit['account_credit'];
						   mysql_query("insert into rewards set customer_id='$debited_customer_id',order_id='$order_id',date_complete='$ti',tradecode='$tradecode',reward='$used_credit', transaction_type='debited'");
						   
						   $new_totaldebited=$olddebetedusercredit-$used_credit;
			              mysql_query("update `member` set account_credit = '$new_totaldebited' where member_id='$debited_customer_id'");
						   
						     }else{
						      
				     mysql_query("insert into rewards set customer_id='$custermer_id',order_id='$order_id',date_complete='$ti',tradecode='$tradecode',reward='$reward', transaction_type='credit'");
			       mysql_query("update `member` set account_credit = '$new_totalcredit' where subdomainurl='$subdomainurl'");
							  
							  }
					}		  
					
		    
			
			}
	 
	 }else{
	 
			$rowresult=mysql_query("select * from rewards where tradecode='$tradecode'");
			$reward_num=mysql_num_rows($rowresult);
			//echo "dhirendra-$reward_num";
			$userdetail=mysql_fetch_array(mysql_query("select * from `member`  where refcode='$copuncode'"));
			 $oldcredit=$userdetail['account_credit'];
			 $custermer_id=$userdetail['member_id'];
			 $new_totalcredit=$oldcredit+$reward;
			 $ti=time();
			if(!$reward_num){
			//echo "shashi";
			 
			// echo "insert into rewards set customer_id='$custermer_id',order_id='$order_id',date_complete='$ti',tradecode='$tradecode',reward='$discount";
			mysql_query("insert into rewards set customer_id='$custermer_id',order_id='$order_id',date_complete='$ti',tradecode='$tradecode',reward='$reward', transaction_type='credit'");
			
			mysql_query("update `member` set account_credit = '$new_totalcredit' where refcode='$copuncode'");
			
			///debetid/////////////
			  $rowcredit= mysql_fetch_array(mysql_query("select * from `member`  where member_id='$trade_user_id' or email='$trade_user_id'"));
			   $debited_customer_id=$rowcredit['member_id'];
			   $olddebetedusercredit=$rowcredit['account_credit'];
			  //echo "dhirendra";
			
			  mysql_query("insert into rewards set customer_id='$debited_customer_id',order_id='$order_id',date_complete='$ti',tradecode='$tradecode',reward='$used_credit', transaction_type='debited'");
			 
			 $new_totaldebited=$olddebetedusercredit-$used_credit;
			// echo "$new_totaldebited--old $olddebetedusercredit  --used--$used_credit";
			 
			// echo "update `member` set account_credit = '$new_totaldebited' where member_id='$debited_customer_id'";
			
			mysql_query("update `member` set account_credit = '$new_totaldebited' where member_id='$debited_customer_id'");
			
			}else if($reward_num==1){
			       //  $ti=time();
			        while($row_reward=mysql_fetch_array($rowresult)){
					      $type=$row_reward['transaction_type'];
					      if($type=='credit'){
						      $rowcredit= mysql_fetch_array(mysql_query("select * from `member`  where member_id='$trade_user_id' or email='$trade_user_id'"));
							  $debited_customer_id=$rowcredit['member_id'];
							  $olddebetedusercredit=$rowcredit['account_credit'];
						   mysql_query("insert into rewards set customer_id='$debited_customer_id',order_id='$order_id',date_complete='$ti',tradecode='$tradecode',reward='$used_credit', transaction_type='debited'");
						   
						   $new_totaldebited=$olddebetedusercredit-$used_credit;
			              mysql_query("update `member` set account_credit = '$new_totaldebited' where member_id='$debited_customer_id'");
						   
						   }else{
						      
				 mysql_query("insert into rewards set customer_id='$custermer_id',order_id='$order_id',date_complete='$ti',tradecode='$tradecode',reward='$reward', transaction_type='credit'");
			mysql_query("update `member` set account_credit = '$new_totalcredit' where refcode='$copuncode'");
							  
							  }
					
				    }
				 
				 }
			
	     }
	
	
	}
	
}
 $total_trade=mysql_query("select * from trade order by id desc ");
 

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

                              <td align="left" class="white-18">Order List</td>

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
                      <th width="12%" align="center">Trade Code</th>
                      <th width="13%" align="center">User Id</th>
                      <th width="10%" align="center">EBHA Store</th>
                      <th width="10%" align="center">Total Money</th>
                      <th width="8%" align="center">Ship Money</th>
                      <th width="8%" align="center">Pay Money</th>
                      <th width="10%" align="center">Coupon Code</th>
                      <th width="10%" align="center">Pay Method</th>
                      <th width="8%" align="center">Details</th>
                      <th width="6%" align="center">Status</th>
                      </tr>
                      <tr><td colspan="10">
                      <hr color="#999999"; />
                      </td></tr>
                      
                      
                      <?php $count=0;
					    
					  while( $total_trade_row = mysql_fetch_assoc($total_trade))
					  { 
					  $count++;
					  
					  $total_trade_row = mysql_fetch_assoc(mysql_query("select * from trade where tradecode = '$total_trade_row[tradecode]'"));
					  
					  $isr_id=$total_trade_row['ISR'];
					   $rowisr =mysql_fetch_array(mysql_query("select * from member where member_id='$isr_id'"));
					  
					   $storeid=$total_trade_row['storeid'];
					  $storedetail= mysql_fetch_array(mysql_query("SELECT * FROM `store` where id='$storeid'"));
					  ?>
                      <form action="" method="post" >
                      <tr><td width="5%" align="center"><input type="hidden" name="uid" value="<?= $total_trade_row['id'] ?>" /><?=$count?></td>
                      
                      <td width="12%" align="center"><input type="hidden" name='tradecode' value="<?=$total_trade_row['tradecode']?>" /> <?=$total_trade_row['tradecode']?></td>
                      <td width="13%" align="center"><input type="hidden" name="userid" value="<?=$total_trade_row['userid']?>" /><?=$total_trade_row['userid']?></td>
                      <td width="10%" align="center"><?=$total_trade_row['subdomainurl']?></td>
                      <td width="8%" align="center"><?=$total_trade_row['totalM']?></td>
                      <td width="8%" align="center"><?=$total_trade_row['shipM']?></td>
                      <td width="10%" align="center"><?=$total_trade_row['shipotherM']?></td>
                      <td width="10%" align="center"><?=$total_trade_row['coupon_code']?></td>
                      <td width="8%" align="center"><?=$total_trade_row['paymethod']?></td>
                      <td width="6%" align="center"><a href="buyer_order_list_details.php?id=<?=$total_trade_row['id']?>">                        Details</a></td>
                      <td width="10%" align="center"> <select name ="order_status" id ="order_status">
                                                    
                                                      <option vaule="Pending" <?php if($total_trade_row['order_status'] =='Pending'){ ?> selected <?php } ?>>Pending</option>
                                                      <option vaule="Paid" <?php if($total_trade_row['order_status'] =='Paid'){ ?> selected <?php } ?>>Paid</option>
                                                       <option vaule="Pickup" <?php if($total_trade_row['order_status'] =='Pickup'){ ?> selected <?php } ?>>Pickup</option>
                                                      <option vaule="Cancel" <?php if($total_trade_row['order_status'] =='Cancel'){ ?> selected <?php } ?>>Cancel</option>
                                                      <option value="Complete" <?php if($total_trade_row['order_status'] =='Complete'){ ?> selected <?php } ?>>Complete</option>
                                                        <option value="Not Paid" <?php if($total_trade_row['order_status'] =='Not Paid'){ ?> selected <?php } ?>>Not Paid</option>
                                                      </select>
					                                  <input type="submit" name="submit" id="submit" value="Update" onclick="return confirm('Are you sure you want to Update?')" />
					  
					  </td>
                      
                      </tr>
                      </form>
                      <tr><td colspan="10">
                      <hr color="#999999"; /></td></tr>
                      <?php  }  ?>
                       
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


<?php
session_start();
require_once('include/connectdb.php');
if($_SESSION["ADMIN_ID"]=="")
   {
	header("location:login.php");	
	exit;
   } 
	/* 
	  $limit=16;
	 $sql= ("select * from designs where prod_id='0' order by id DESC");
     $result=mysql_query(dopaging($sql,$limit));
 $cat_id=$_GET['cat_id'];  
 $query=mysql_query("SELECT * FROM `subcategory` where cat_id='$cat_id' ");
 */
 $member_id=$_GET['member_id'];
$row=mysql_fetch_array(mysql_query("select * from member where member_id='$member_id'"));
$email=$row['email'];
//echo "select * from trade where userid='$email' or userid='$member_id'";
$result_credit=mysql_query("select * from rewards where customer_id='$member_id'");	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Member Personal Information</title>
<link href="style/style.css" rel="stylesheet" type="text/css" />
<link href="style/design.css" rel="stylesheet" type="text/css"  />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script type="text/javascript">

             $(document).ready(function(e) {
    
	if($("#country").val()=='230'  || $("#country").val()=='45')	{
		$("#state_div").show('fast');	
				
	   $("#state").load("get_state.php?act=select&st_id=<?=$query2['state']?>&cid="+$("#country").val());	
			
			}
			else{
		$("#state_div").hide('fast');		
			}
			
			if($("#ship_country").val()=='230'  || $("#ship_country").val()=='45')	{
		$("#ship_state_div").show('fast');	
				
	   $("#ship_state").load("get_state.php?act=select&st_id=<?=$query2['state']?>&cid="+$("#ship_country").val());	
			
			}
			else{
		$("#ship_state_div").hide('fast');		
			}

});


        </script>      
        
   <style type="text/css">
   table#t01 tr:nth-child(even) {
    background-color: #eee;
}
table#t01 tr:nth-child(odd) {
   background-color:#fff;
}
   
   </style>

		
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

                      <td style="background-color:#CCC;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                        <tr>

                          

                          <td width="100%" style="background-color:#CCC"><table width="100%" border="0" cellspacing="5" cellpadding="0">

                            <tr>

                              <td align="left" class="white-18">Credit Detail Reports </td>

                            </tr>

                          </table></td>
                           
                          
                        </tr>

                        <tr>
                        
                        

                          

                          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                            <tr>

                             <td colspan="4"></td>
                              
                       
                            </tr>
 
                      <tr>
                      <td>
                       <form id="product_edit_form" name="product_edit_form" method="POST" action="" onsubmit="return validate_form()">
                      <table width="100%" id="t01" cellpadding="3" cellspacing="3">
                      
                     
 
<tr> 
<td>Date</td>
<td>Order#</td>
<td>Reward</td>
 </tr>
 <tr> <td  colspan="3" >&nbsp; </td></tr>
 
 <? while($row_credit=mysql_fetch_array($result_credit)){
 if($row_credit['transaction_type']=="credit"){
 $total=$total+$row_credit['reward'];
 }else if($row_credit['transaction_type']=="debited"){
 $total=$total-$row_credit['reward'];
 
 }
 
  ?>
 <tr> 
<td><?=date("m/d/Y",$row_credit['date_complete'])?> </td>
<td><?=$row_credit['tradecode']?></td>
<td><? if($row_credit['transaction_type']=="credit"){ ?> <font color="#003300">+</font> <? }else{ ?> <font color="#FF0000">-</font> <? } ?> <?=$row_credit['reward']?></td>
 </tr>
<? } ?>
      
 <tr> 
<td>TOTAL</td>
<td></td>
<td><?=$total?></td>
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


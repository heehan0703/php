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
// $_SESSION["member_id"] =$member_id;  
$country_query=$con_pdo->query("SELECT * FROM `country` where country_name!='' order by country_id asc");
if($_GET['act']=='delete')
{

    mysql_query("update `member` set parent_id=0 where parent_id='$member_id'");
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
  $i_am = $_POST['i_am'];
  $f_name = $_POST['f_name'];
  $l_name = $_POST['l_name'];
  $com_name =$_POST['com_name'];
  $tel =$_POST['tel1'].'-'.$_POST['tel2'].'-'.$_POST['tel3'];
  $cel =$_POST['cell1'].'-'.$_POST['cell2'].'-'.$_POST['cell3'];
  $status =$_POST['status'];
  $verify_status =$_POST['verify_status']; 
  $credit=$_POST['credit'];
  $refcode=$_POST['refcode'];
  $Social=$_POST['Social'];
  $InstagramID=$_POST['InstagramID'];
  $Referral=$_POST['Referral'];
  $reseller=$_POST['reseller'];
  
  
  if($verify_status==1)
  {
    $level=2;
	}	
	$query3=mysql_query("update `member` set pwd='$pass', 
	                                          country='$country',
											  state='$state',
											  address1='$address1',
											  address2='$address2',
											  city='$city',
											  zipcode='$zipcode',
											  i_am='$i_am',
											  f_name='$f_name',
											  l_name='$l_name',
											  company_name='$com_name',
											  tel='$tel',
											  cel='$cel',
											  status='$status',
											  verify_status ='$verify_status',level='$level',account_credit='$credit',refcode='$refcode',Social='$Social',InstagramID='$InstagramID',Referral='$Referral',resaler='$reseller'
											  where member_id='$member_id'");
											  
	
  }  
$query1 = mysql_query("select * from `member` where member_id = '$member_id'");
$query2 = mysql_fetch_assoc($query1);
$isrval=$query2['ISR'];

$isrrow=mysql_fetch_array(mysql_query("select * from `member` where member_id = '$isrval'"));
if($isrval==0){
$isremail=$query2['email'];
}else{
$isremail=$isrrow['email'];
}
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

                              <td align="left" class="white-18">Edit Buyer Details </td>

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
     <td  colspan="2" width="30%" align="center" font-size="24px">Edit Buyer Account </td>
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
	<option value="<?=$country_result['country_Id']?>" 
	<?php if($query2['country']== $country_result['country_Id']){?> selected <?php } ?>><?=$country_result['country_name']?></option>
	
	<?php } ?>
	</select>	
     <script type="text/javascript">
			$("#country").change(function(){
			if($("#country").val()=='230'  || $("#country").val()=='45')	{
		$("#state_div").show('fast');	
	$("#state").load("get_state.php?act=select&st_id=<?=$query2['state']?>&cid="+$("#country").val());				
	
	    	//$("#state").load("get_state.php?c_id="+$("#country").val());
			
			}
			else{
		$("#state_div").hide('fast');		
			}
						});		

                                       </script>     
 
		
     </td>
      </tr>



      



   
   <tr id="state_div">
     <td  width="30%" align="left">State </td>
     <td width="40%" align="left">
     
       <select name="state" id="state" >
       <option value=""> </option>		
		</select>	
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
 
 <tr>
     <td width="30%" align="left">I am a</td>
     <td width="40%" align="left">
     <input type="radio" name="i_am" value="Wholesaler" class="radio-inline" <?php if($query2['i_am']=='Wholesaler') {?> checked <?php } ?> >Wholesaler 
     <input type="radio" name="i_am" value="Salon" class="radio-inline" <?php if($query2['i_am']=='Salon') {?> checked <?php } ?>>Salon
     <input type="radio" name="i_am" value="General Buyer" class="radio-inline" <?php if($query2['i_am']=='General Buyer') {?> checked <?php } ?> >General Buyer
     <input type="radio" name="i_am" value="Agent" class="radio-inline" <?php if($query2['i_am']=='Agent') {?> checked <?php } ?> >Agent
     <input type="radio" name="i_am" value="EBHA Member" class="radio-inline" <?php if($query2['i_am']=='EBHA Member') {?> checked <?php } ?> >EBHA Member
         
     </td>
     </tr>
    
    
    <tr>
     <td width="30%" align="left">ReSeller Permit</td>
     <td width="40%" align="left">
        <input name="reseller" value="yes" type="checkbox" <?php if($query2['resaler']=='yes') {?> checked="checked"  <?php } ?> />
     
      </tr>
      
      
    
    
     <tr>
     <td width="30%" align="left">Status</td>
     <td width="40%" align="left">
     <select name="status">
               
		      <option value="0" <?php if($query2['status']=='0'){?> selected <?php } ?>>Inactive</option>
              <option value="1" <?php if($query2['status']=='1') {?> selected<?php } ?>>Active</option>
             
          </select>
     
      </tr>
  
  <tr>
     <td width="30%" align="left">Verify Status</td>
     <td width="40%" align="left">
     <select name="verify_status">
               
		      <option value="0" <?php if($query2['verify_status']=='0'){?> selected <?php } ?>>Not Verify</option>
              <option value="1" <?php if($query2['verify_status']=='1') {?> selected<?php } ?>>Verify</option>
             
          </select>
     
      </tr>

     
     
      <tr>
     <td colspan="2" width="30%" align="center">Edit Buyer Contact Information</td>
      </tr>
 
  <tr>
     <td width="30%" align="left">Contact Name</td>
     <td width="40%" align="left">
     <input type="text" name="f_name" id="f_name" class="form-group" value ="<?=$query2['f_name']?>">
     <input type="text" name="l_name" id="l_name" class="form-group" value ="<?=$query2['l_name']?>">
     </td>
  </tr>
  
  <tr>
     <td width="30%" align="left">Social#</td>
     <td width="40%" align="left">
     <input type="text" name="Social" id="Social" class="form-group" value ="<?=$query2['Social']?>">
     
     </td>
  </tr>
 
 
 <tr>
     <td width="30%" align="left">Instagram ID</td>
     <td width="40%" align="left">
     <input type="text" name="InstagramID" id="InstagramID" class="form-group" value ="<?=$query2['InstagramID']?>">
     
     </td>
  </tr>
 
 
 <tr>
     <td width="30%" align="left">Referral</td>
     <td width="40%" align="left">
     <input type="text" name="Referral" id="Referral" class="form-group" value ="<?=$query2['Referral']?>">
     
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
    <!-- 
     <tr>
     <td width="30%" align="left">ISR.</td>
     <td width="40%" align="left"><?=$isremail?></td>
     </tr>
     -->
     <tr>
     <td width="30%" align="left">Credit.</td>
     <td width="40%" align="left"> <input  type="text" value="<?=$query2['account_credit']?>" name="credit" /> <a href="./credit_detail.php?member_id=<?=$member_id?>">Detail </a></td>
     </tr>
      <tr>
     <td width="30%" align="left">Your Code.</td>
     <td width="40%" align="left"><input  type="text" value="<?=$query2['refcode']?>" name="refcode" /></td>
     </tr>
      <tr>
     <td width="30%" align="left">Subdomainurl</td>
     <td width="40%" align="left">https://<?=$query2['subdomainurl']?>.ebhahair.com/</td>
     </tr>
 
 
 
<tr>
<td >  <input  type="submit" value="Update" name="submit" onclick="alert('Want to Update?')"/></td>
<td><a href="register_member_list.php?act=delete&member_id=<?=$query2['member_id']?>" style="margin-left: -330px;"><input  type="button" value="Delete"/> </a></td>
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


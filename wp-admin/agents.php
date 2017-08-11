<?php
session_start();
require_once('include/connectdb.php');
require_once('pager2.php');
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
if($_POST['userlavel']){
$lavelnew=$_POST['userlavel'];
$upuser_id=$_GET['userid'];
mysql_query("update member set agent_level='$lavelnew' where member_id='$upuser_id'");

}

if($_POST['moveuser']!="" and $_POST['moveuserunder']!=""){
   $moveunder=$_POST['moveuserunder'];
   $moveduser=$_POST['moveuser'];
   mysql_query("update member set parent_id='$moveunder' where member_id='$moveduser'");

}	  
	  
	  
$member_id=$_GET['member_id'];
if($_GET['act']=='delete')
{
	$query3=mysql_query("delete from `member` where member_id='$member_id'");
	  
}

function agentlist($agent_id,$lavel=1){
//$lavel=1;
for($i=0;$i<$lavel;$i++){
$gap.="&nbsp;";

}
$lavel++;
$userdetail="";
$query4=mysql_query("select * from `member` where parent_id='$agent_id' and i_am='Agent'");

$num=mysql_num_rows($query4);
		if($num){

					while($rowchildren=mysql_fetch_array($query4)) {
					  $user="'".$rowchildren['f_name'].'&nbsp;'.$rowchildren['l_name']."'";
					
						$userdetail .='<tr><td width="5%"  align="left" style="font-size:14px">'.$rowchildren['member_id'].'&nbsp;&nbsp;'. $rowchildren['Agent_code'].'</td><td width="30%" align="left" style="font-size:14px">'.$gap.'  <img src="./images/arow.png" /><a href="register_member_edit.php?member_id='.$rowchildren['member_id'].'">'.$rowchildren['f_name'].'&nbsp;'.$rowchildren['l_name'].'</a></td><td width="15%"  align="left" style="font-size:14px">'.$rowchildren['email'].'</td><td width="10%"  align="left" style="font-size:14px">'.date("Y-m-d H:i:s",$rowchildren['registered_date']).'</td><td width="5%"  align="left" style="font-size:14px">'.$rowchildren['agent_level'].'<form method="post" action="./agents.php?userid='.$rowchildren['member_id'].'"  name="userlevaleform"  ><select name="userlavel" onchange="this.form.submit()">';
						
						$userdetail .='<option value="NA" selected="selected">NA</option> ' ;
				if($rowchildren['agent_level']==NA){
                  $userdetail .='<option value="NA" selected="selected">NA</option> ' ;
				 }else{
				     $userdetail .='<option value="NA" >NA</option> ' ;
					 }
					 
					 if($rowchildren['agent_level']==SA){
                  $userdetail .='<option value="SA" selected="selected">SA</option> ' ;
				 }else{
				     $userdetail .='<option value="SA" >SA</option> ' ;
					 }
					 
					 if($rowchildren['agent_level']==SM){
                  $userdetail .='<option value="SM" selected="selected">SM</option> ' ;
				 }else{
				     $userdetail .='<option value="SM" >SM</option> ' ;
					 }
                
				    if($rowchildren['agent_level']==MD){
                  $userdetail .='<option value="MD" selected="selected">MD</option> ' ;
				 }else{
				     $userdetail .='<option value="MD" >MD</option> ' ;
					 }
					 
					 if($rowchildren['agent_level']==SMD){
                  $userdetail .='<option value="SMD" selected="selected">SMD</option> ' ;
				 }else{
				     $userdetail .='<option value="SMD" >SMD</option> ' ;
					 }
				
				if($rowchildren['agent_level']==DMD){
                  $userdetail .='<option value="DMD" selected="selected">DMD</option> ' ;
				 }else{
				     $userdetail .='<option value="DMD" >DMD</option> ' ;
					 }
					 
					 if($rowchildren['agent_level']==EMD){
                  $userdetail .='<option value="EMD" selected="selected">EMD</option> ' ;
				 }else{
				     $userdetail .='<option value="EMD" >SMD</option> ' ;
					 }
               
						
						$userdetail .='</form></td>';
					$userdetail .='<td width="5%" align="left" style="font-size:14px"><a href="buyer_order_list?userid='.$rowchildren['email'].'">View</a></td>';
					
					if($rowchildren['verify_status'] == 1){
					    $userdetail .='<td width="5%" align="left" style="font-size:14px"> Verify
						<a href="commission.php?user_id='.$rowchildren['member_id'].'"><font color="#FF0000"> commission </font></a>
						 </td>';
						}else{
					$userdetail .='<td width="5%" align="left" style="font-size:14px"> Not Verify 
					<a href="commission.php?user_id='.$rowchildren['member_id'].'"><font color="#FF0000"> commission </font></a>
					
					</td>';
					    }
						
						if($rowchildren['status'] == 1){
					    $userdetail .='<td width="5%" align="left" style="font-size:14px"> Active </td>';
						}else{
					$userdetail .='<td width="5%" align="left" style="font-size:14px"> Inactive  </td>';
					    }
					$userdetail .='<td width="15%" align="left" onclick="show('.$user.','.$rowchildren['member_id'].')" style="font-size:14px"> Move Under User  </td>';
					$userdetail .='<form></form>';
					$userdetail .='</tr>';
						 $userdetail .= agentlist($rowchildren['member_id'],$lavel);
					}

              }
return $userdetail;			  
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AGENT LIST</title>
<link href="style/style.css" rel="stylesheet" type="text/css" />
<link href="style/design.css" rel="stylesheet" type="text/css" />

<style type="text/css">
table#t01 tr:nth-child(even) {
    background-color: #eee;
}
table#t01 tr:nth-child(odd) {
   background-color:#fff;
}

table#t02 tr:nth-child(even) {
    background-color: #eee;
}
table#t02 tr:nth-child(odd) {
   background-color:#fff;
}

.overlay-mask{background:none repeat scroll 0 0 rgba(28, 45, 50, 0.8);bottom:0;height:100%;left:0;position:fixed;right:0;top:0;width:100%;z-index:999999;display:none;overflow-y:auto;overflow-x:hidden;}
.overlay.iframe-content{border:2em solid #fff;border-radius:6px;box-sizing:content-box;padding:0;width:50%;}
.overlay{background:none repeat scroll 0 0 #fff;border-radius:3px;box-shadow:0 1px 3px rgba(23, 74, 104, 0.35), 0 0 32px rgba(60, 82, 93, 0.35);box-sizing:border-box;margin:50px auto 0;padding:30px;position:relative;}
.overlay.iframe-content .title{border:medium none;margin:0;position:absolute;}
.overlay .title{border-bottom:1px solid #e2e8ea;margin-bottom:20px;}
.overlay .close-icon{font:32px Dingbatz;color:#b3c5d0;content:"?";display:block;font:bold 20px "Dingbatz";position:absolute;right:0;}
.overlay.iframe-content .close-icon{background:none repeat scroll 0 0 #000;border-radius:32px;color:white;height:32px;opacity:1;position:absolute;right:-2em;top:-2em;width:32px;}
.overlay .close-icon{cursor:pointer;float:right;}

.red{
background-color: red; 
}
.white{
background-color:#FFFFFF;
}

.gray{
background-color:#FFFFFF;
}
</style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
 
 function show(user,useridm){
 $("#overlay-mask-1").fadeIn('slow');
//alert(user);
 $("#moveuser").html(user);
 
 $('#moveduser').val(useridm);
 
 }

function selectuser(userid){
 $('#moveuserunder').val(userid);

}

 $(document).ready(function () {

      $('.movetounder').click(function () {
       $(this).css("background-color" , "#8E8DA2");
	   $(this).parent().css("background-color" , "#8E8DA2");
      });

    });


 function close_popup(id){$("#"+id).fadeOut('slow');}
 
</script>



</head>



<body style="font-size:16px;">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td><? include('header.php')?></td>

  </tr>

  <tr>

    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td width="10%" valign="top"><? include('left_menu.php');?></td>

        <td width="90%" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="0">
		      <tr>
			  <td><table width="100%" border="0" cellspacing="10" cellpadding="0">
			       <tr>
				       <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				    <tr>
               <td style="color:#CCC;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			        <tr>
                        <td width="100%"><table width="100%" border="0" cellspacing="0" cellpadding="0"
                          style="background-color:#CCC;">
						          <tr>
                                   <td align="left" style="color:#333; font-size:24px;">Agent List &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="export_excel.php"><img src="images/excel.png" width="25" height="25" /></a></span></td>

                                   </tr>
                          </table></td>
                          

                     </tr>

                     <tr>

                           <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                              <tr>

                                 <td colspan="7"></td>
                              
                       
                               </tr>

                              <tr>
                                 <td><table width="100%" id="t01" cellpadding="3" cellspacing="3" border="0" style="color:#333;">
                                  <tr><th width="5%" align="center" style="font-size:14px">Id</th>
                                  <th width="15%" align="left" style="font-size:14px">Name</th>
                                  <th width="20%" align="left" style="font-size:14px">Email</th>
                                  <th width="10%" align="left" style="font-size:14px">Registered</th>
                                  <th width="5%" align="left" style="font-size:14px">Type</th>
                                  <th width="5%" align="left" style="font-size:14px">Order History</th>
                                  <th width="5%" align="left" style="font-size:14px">Status</th>
                                  <th width="5%"  align="left" style="font-size:14px">Account Status</th>
						     </tr>
     
       <?php
	 
	
	$wig_list_query=mysql_query(dopaging("SELECT * FROM `member` where supplier = 0 and i_am='Agent' and parent_id='0' order by member_id desc",50)); 
			while($wig_list_row=mysql_fetch_assoc($wig_list_query))
			 {
			  $user=$wig_list_row['f_name']."&nbsp;".$wig_list_row['l_name'];
			  ?> 
     
    
    
     <tr><td width="5%"  align="left" style="font-size:14px"> <?=$wig_list_row['member_id']?> <?=$wig_list_row['Agent_code']?></td>
     <td width="30%" align="left" style="font-size:14px"><a href="register_member_edit.php?member_id=<?=$wig_list_row['member_id']?>"><?=$wig_list_row['f_name']."&nbsp;".$wig_list_row['l_name']?> </a></td>
     <td width="15%" align="left" style="font-size:14px"><?=$wig_list_row['email']?></td>
     <td width="10%" align="left" style="font-size:14px"><?=date("Y-m-d H:i:s",$wig_list_row['registered_date'])?></td>
     <td width="5%" align="left" style="font-size:14px"><?=$wig_list_row['agent_level']?>
     <form method="post" action="./agents.php?userid=<?=$wig_list_row['member_id']?>"  name="userlevaleform"  >
      
             <select name="userlavel" onchange="this.form.submit()">
                 <option value="NA" <? if($wig_list_row['agent_level']=='NA'){?> selected="selected" <? } ?> >NA</option>
                 <option value="SA" <? if($wig_list_row['agent_level']=='SA'){?> selected="selected" <? } ?>>SA</option>
                 <option value="SM" <? if($wig_list_row['agent_level']=='SM'){?> selected="selected" <? } ?>>SM</option>
                 <option value="MD" <? if($wig_list_row['agent_level']=='MD'){?> selected="selected" <? } ?>>MD</option>
                 <option value="SMD" <? if($wig_list_row['agent_level']=='SMD'){?> selected="selected" <? } ?>>SMD</option>
                 <option value="DMD" <? if($wig_list_row['agent_level']=='DMD'){?> selected="selected" <? } ?>>DMD</option>
                  <option value="EMD" <? if($wig_list_row['agent_level']=='EMD'){?> selected="selected" <? } ?>>EMD</option>
              </select>
      
      </form>
     
     
     </td>
     <td width="5%" align="left" style="font-size:14px"> <a href="buyer_order_list?userid=<?=$wig_list_row['email']?>">View</a></td>
     <td width="2%" align="left" style="font-size:14px"><? if($wig_list_row['verify_status'] == 1){ ?> Verify <? } else { ?>Not Verify <? }?>
     <a href="commission.php?user_id=<?=$wig_list_row['member_id']?>"><font color="#FF0000"> commission </font></a>
     
     </td>
     <td width="2%" align="left" style="font-size:14px"><? if($wig_list_row['status'] == 1){ ?> Active <? } else { ?>Inactive <? }?></td>
     <td width="15%" align="left" style="font-size:14px" onclick="show('<?=$user?>',<?=$wig_list_row['member_id']?>)"> Move Under User  </td>
     </tr>
      <?=agentlist($wig_list_row['member_id']) ?>
     
      <?php  } ?>
                      </table>
                      </td>
                      </tr>
                                        
                          

                            <tr>

                              <td colspan="10">&nbsp;</td>

                            </tr>

                            <tr>

                              <td colspan="7"><table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
                                   
                                	<td colspan="2" align="left">
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
	<tr>
        </table></td>
 
      </tr>

   </td>

  </tr>
  

							
  <tr>

    <td><? include('footer.php')?></td>

  </tr>

</table>

<!--login popup start-->

<div id="overlay-mask-1" class="overlay-mask" style="" onKeyPress="test(event)">
  

  <div class="overlay iframe-content">
    <div class="content"> 
      <div class="row">
  
   
    
      <div class="col-lg-12 col-xs-12 col-xs-12">
       <form name="login_form" action="" method="post" id="loginform'" autocomplete="on">
       
       <input type="hidden" value="" name="moveuser"  id="moveduser" />
       
        <input type="hidden" value="" name="moveuserunder"  id="moveuserunder" />
        
    <div class="full" style="padding:5%; border-width:1px; border-color:rgb(229,229,229); border-style:solid;">
    
  
   
     <h3 class="h3">Move User :<span id="moveuser"> </span> Under -></h3><hr>
     <div class="full" style="color:rgb(153,153,153); margin-top:1em; overflow:scroll; height:150px">
     <div id="berror" style="color:red;"></div>
  
   <div id="uerror" style="color:red;"></div>
 <?  $wig_list_query2=mysql_query(dopaging("SELECT * FROM `member` where supplier = 0 and i_am='Agent'  order by f_name ",50)); 
 $i=0;
			while($wig_list_row2=mysql_fetch_assoc($wig_list_query2))
			 { $i++; ?>
    <div style="width:100%; background-color:#666666;">
      <div style="width:10%; float:left; <? if(($i % 2) == 1){ ?> background-color:#e4dede; <? }else{ ?> background-color:#FFFFFF;  <? } ?>" ><?=$wig_list_row2['member_id']?></div>
           <div style="width:45%; float:left; <? if(($i % 2) == 1){ ?> background-color:#e4dede; <? }else{ ?> background-color:#FFFFFF;  <? } ?>" class="movetounder" onclick="selectuser('<?=$wig_list_row2['member_id']?>')"  > <?=$wig_list_row2['f_name'] ?> &nbsp; <?=$wig_list_row2['l_name'] ?> 
           </div>
           <div style="width:45%; float:left;<? if(($i % 2) == 1){ ?> background-color:#e4dede; <? }else{ ?> background-color:#FFFFFF;  <? } ?>" class="movetounder" onclick="selectuser('<?=$wig_list_row2['member_id']?>')" > <?=$wig_list_row2['email']?> 
           </div>
   
   </div>
   
   
  <? } ?> 
   
  
   </div>
    <div style="width:100%; text-align:right">
     <button type="button" class="blue-btn glyphicon glyphicon-lock" style="background:#ffffff; color:#FF0000; width: 10%;" onClick="close_popup('overlay-mask-1')">
  <span class="" style="font-family:sans-serif;">Cancel</span>
  </button> <input type="submit"  value="Move"/> </div>
     </div>
     </div> 
     </form>  
      </div>
    </div>
   <div style="padding:1em; border-width:0px; border-color:rgb(151,207,0); border-style:solid;" class="content"> 
   
    <div style="padding:0;" class="row">
    <div class="col-lg-12 col-xs-12 col-xs-12 text-center">
    
   
      
      </div>
      </div>
      </div>
     
  </div>
    </div>
  
    
    </div>
<!-- login popup end -->


</body>

</html>


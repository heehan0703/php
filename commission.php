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

$member_id=$_GET['user_id'];
$curYear = date('Y'); 
  if($_POST['search']){
 // echo $_POST['search_month'];
  $startdate= mktime(0,0,0,$_POST['search_month'],1,$curYear);
  $enddate=mktime(23,59,00,$_POST['search_month']+1,0,$curYear);
   }
if($_POST['comm']){

$datevalue=$_POST['datev'];
$orderid=$_POST['orderid'];
$agentcode=$_POST['agentcode'];
$agentname=$_POST['agentname'];
$saleamount=$_POST['saleamount'];
$percentage=$_POST['percentage'];
$agentname=$_POST['agentname'];
$saleagent=$_POST['saleagent'];


$num=count($orderid);
//echo "$num";
	for($i=0;$i<$num;$i++){
	$newdate=strtotime($datevalue[$i]);
	$neworderid=$orderid[$i];
	//echo "$neworderid";
	$newagentcode=$agentcode[$i];
	$newsaleamount=$saleamount[$i];
	$newpercentage=$percentage[$i];
	$agentname=$agentname[$i];
	$newsaleagent=$saleagent[$i];
	$pay=$newsaleamount*$newpercentage/100;
	//echo "select * trade where tradecode='$neworderid' and commissionstatus=''";
	$rownumtrade=mysql_num_rows(mysql_query("SELECT * FROM `trade` WHERE tradecode='$neworderid' and commissionstatus=''"));
	//echo "dhire$rownumtrade";
	//echo "insert into commission_detail set 	agent_id='$newagentcode',order_id='$neworderid',processing_date='$newdate',saleamount='$newsaleamount',mypercentage='$newpercentage',pay='$pay',agentname='$agentname',saleagent='$newsaleagent'";
	mysql_query("insert into commission_detail set 	agent_id='$newagentcode',order_id='$neworderid',processing_date='$newdate',saleamount='$newsaleamount',mypercentage='$newpercentage',pay='$pay',agentname='$agentname',saleagent='$newsaleagent'");
	//$threemonthcommission=$pay+$rowcommition[''];
	//$totalcommission=$pay+$rowcommition[''];
	     if($rownumtrade){
	      mysql_query("update trade set commissionstatus='yes' where tradecode='$neworderid'");
	       }
	
	} 

//var_dump($datevalue);
}


echo "dhirendra";
if($_POST['newpoints']){
$newpoints=$_POST['newpoints'];
echo "dhirendra--$newpoints";
mysql_query("update member set threemonthspoints='$newpoints' where member_id='$member_id'");
}

$query=mysql_fetch_array(mysql_query("select * from `member` where member_id='$member_id'"));

function childrenlist($userid){
$childrens=array();
$querychildren=mysql_query("select * from `member` where parent_id='$userid'");

if(mysql_num_rows($querychildren)>0){
	while($rowchildren=mysql_fetch_array($querychildren)){ 
	$childrens[]=$rowchildren['member_id'];
	 $childrens=array_merge($childrens,childrenlist($rowchildren['member_id']));
		
	 }
}
return $childrens;
}


function agentlist($agent_id,$lavel=1){
//$lavel=1;
for($i=0;$i<$lavel;$i++){
$gap.="&nbsp;";

}
$lavel++;
$userdetail="";
$query4=mysql_query("select * from `member` where parent_id='$agent_id'");

$num=mysql_num_rows($query4);
		if($num){

					while($rowchildren=mysql_fetch_array($query4)) {
					  $user="'".$rowchildren['f_name'].'&nbsp;'.$rowchildren['f_name']."'";
					
						$userdetail .='<tr><td width="30%" align="left" style="font-size:14px">'.$gap.'  <img src="./images/arow.png" /><a href="register_member_edit.php?member_id='.$rowchildren['member_id'].'">'.$rowchildren['f_name'].'&nbsp;'.$rowchildren['l_name'].'</a></td>';
				$userdetail .='</tr>';
						 $userdetail .= agentlist($rowchildren['member_id'],$lavel);
					}

              }
return $userdetail;			  
}

$childrenarray= childrenlist($member_id);
function Pendingtransaction($valnarray){

		foreach($valnarray as $key=>$value){
		//echo "select * from `trade` where userid='$value'";
		  //$order=mysql_query("select * from `trade` where userid='$value' and commissionstatus<>'yes'");
		    // $orderrow =mysql_fetch_array($order);
		 // $ordernum=mysql_num_rows($order);
				//  if($ordernum){
				     $pendingform=commitionform($value,$orderrow['tradecode'],$orderrow['totalM']);
				 // }
		  
		
		//echo "$pendingform";
		
		}
return $pendingform;
}

function commitionform($userid,$ordernum,$saleamount){
$commitionform="";

//echo "select * from `member` where member_id='$userid'";

$rowcommission=mysql_fetch_array(mysql_query("select * from `member` where member_id='$userid'"));

$commitionform='<tr><td style="width:100px; text-align:center;font-size:14px"><input type="text" style="width:80px;" value="'.$ordernum.'" name="orderid[]"/></td><td style="width:100px; text-align:center;font-size:14px"> <input type="text" style="width:80px;" value="" class="datep" name="datev[]"/></td><td style="width:100px; text-align:center;font-size:14px"> <input type="text" style="width:80px;" value="" name="saleagent[]"/></td><td style="width:100px; text-align:center;font-size:14px;color:#000000"><input type="hidden" style="width:80px;" value="'.$rowcommission['Agent_code'].'" name="agentcode[]"/>'.$rowcommission['Agent_code'].'</td><td style="width:100px; text-align:center;font-size:14px;color:#000000"><input type="hidden" style="width:80px;" value="'.$rowcommission['f_name'].'&nbsp;'.$rowcommission['l_name'].'" name="agentname[]"/>'.$rowcommission['f_name'].'&nbsp;'.$rowcommission['l_name'].'</td><td style="width:100px; text-align:center;font-size:14px"> <input type="text" style="width:80px;" name="saleamount[]" value="'.$saleamount.'"/></td><td style="width:100px; text-align:center;font-size:14px"> <input type="text" style="width:80px;" value="" name="percentage[]"/></td><td style="width:100px; text-align:center;font-size:14px"> <input type="text" style="width:80px;" value=""/></td></tr>';
	if($rowcommission['parent_id']){
	 $commitionform.=commitionform($rowcommission['parent_id'],$ordernum,$saleamount);
	}
return $commitionform;
}



Pendingtransaction($childrenarray);


function transaction($valnarray){
 // echo "dhirendra";
 $pendingform="";
		foreach($valnarray as $key=>$value){
		//echo "select * from `member` where member_id='$value'";
		  $order=mysql_query("select * from `member` where member_id='$value'");
		     $orderrow =mysql_fetch_array($order);
		  $ordernum=mysql_num_rows($order);
				  if($ordernum){
				 // echo $orderrow['Agent_code'];
				     $pendingform.=commissiondetail($value,$orderrow['Agent_code']);
				  }		
		
		
		}
		echo "$pendingform";
return $pendingform;
}

function commissiondetail($userid,$ordernum){
$commition="";
$i=0;
//echo "select * from commission_detail where agent_id='$ordernum' ORDER BY processing_date";
$rowcommission=mysql_query("select * from commission_detail where agent_id='$ordernum' ORDER BY processing_date");
while($commissionrow=mysql_fetch_array($rowcommission)){

if($i==0){
$commition.='<tr style="background-color:#f9f9f9">';
$i++;

}else{
$commition.='<tr style="background-color:#ffffff">';
$i=0;

}
$commition.='<td style="width:100px; text-align:center;font-size:14px">'.$commissionrow['order_id'].'</td><td style="width:100px; text-align:center;font-size:14px">'.gmdate("m/d/y", $commissionrow['processing_date']).' </td><td style="width:100px; text-align:center;font-size:14px">'.$commissionrow['saleagent'].' </td><td style="width:100px; text-align:center;font-size:14px;color:#000000">'.$commissionrow['agent_id'].'</td><td style="width:100px; text-align:center;font-size:14px;color:#000000">'.$rowcommission['agentname'].'</td><td style="width:100px; text-align:center;font-size:14px">'.number_format($commissionrow['saleamount'], 2).'</td><td style="width:100px; text-align:center;font-size:14px">'.$commissionrow['mypercentage'].' </td><td style="width:100px; text-align:center;font-size:14px"> '.$commissionrow['pay'].'</td></tr>';

}

return $commition;
}
//var_dump($childrenarray);

function searchtransaction($valnarray,$startdate,$enddate){

  //echo "dhirendra";

		foreach($valnarray as $key=>$value){
		//echo "select * from `member` where member_id='$value'";
		  $order=mysql_query("select * from `member` where member_id='$value'");
		     $orderrow =mysql_fetch_array($order);
		  $ordernum=mysql_num_rows($order);
				  if($ordernum){
				 // echo $orderrow['Agent_code'];
				     $pendingform=searchcommissiondetail($value,$orderrow['Agent_code'],$startdate,$enddate);
				  }
		  
		
		//echo "$pendingform";
		
		}
return $pendingform;
}



function searchcommissiondetail($userid,$ordernum,$startdate,$enddate){
$commition="";
$i=0;
//echo "select * from commission_detail where agent_id='$ordernum' and processing_date>=$startdate and processing_date<$enddate ORDER BY processing_date";
$rowcommission=mysql_query("select * from commission_detail where agent_id='$ordernum' and processing_date>=$startdate and processing_date<$enddate ORDER BY processing_date");
while($commissionrow=mysql_fetch_array($rowcommission)){
if($i==0){
$commition.='<tr style="background-color:#f9f9f9">';
$i++;
}else{
$commition.='<tr style="background-color:#ffffff">';
$i=0;
}


$commition.='<td style="width:100px; text-align:center;font-size:14px">'.$commissionrow['order_id'].'</td><td style="width:100px; text-align:center;font-size:14px">'.gmdate("m/d/y", $commissionrow['processing_date']).' </td><td style="width:100px; text-align:center;font-size:14px;color:#000000">'.$commissionrow['agent_id'].'</td><td style="width:100px; text-align:center;font-size:14px;color:#000000">'.$rowcommission['agentname'].'</td><td style="width:100px; text-align:center;font-size:14px">'.$commissionrow['saleamount'].'</td><td style="width:100px; text-align:center;font-size:14px">'.$commissionrow['mypercentage'].' </td><td style="width:100px; text-align:center;font-size:14px"> '.$commissionrow['pay'].'</td></tr>';
}
return $commition;
}

function currentyearcommition(){

    $year=strtotime(date('Y-01-01'));

    $querycommission=mysql_query("select * from commission_detail where processing_date>=$year");
	$thisyearcommition=0;
    while($rowcommission=mysql_fetch_array($querycommission)){
     $thisyearcommition=$thisyearcommition+$rowcommission['pay'];
	 
	 }
return $thisyearcommition; 
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Buyer List</title>
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
.overlay.iframe-content{border:2em solid #fff;border-radius:6px;box-sizing:content-box;padding:0;width:30%;}
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".datep" ).datepicker();
  } );
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
                                   <td align="left" style="color:#333; font-size:24px; height:80px">&nbsp;&nbsp;&nbsp;&nbsp;COMMISSION STATEMENT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="export_excel.php"><img src="images/excel.png" width="25" height="25" /></a></span></td>

                                   </tr>
                          </table></td>
                          

                     </tr>

                     <tr>
                       <td width="100%">
                       <table width="100%">
                         <tr>
                               <td width="80%"> 
                                 <table style="width:100%">
                                 
                                 <tr><td>AGENT ID: <?=$query['Agent_code'] ?> </td> </tr>
                                 <tr><td> AGENT NAME: <?=$query['f_name'] ?> <?=$query['l_name'] ?>  </td> </tr>
                                 <tr> <td>&nbsp; </td> </tr>
                                 
                                 <tr>

                              <td align="left" class="white-18"><font size="+1"  color="#CCCCCC"><b>Time&nbsp;Period</b></font> 
                             <form action="" name="search" method="post">
                              <select name="search_month"> 
                                 <option value="1">Jan <?=$curYear?> </option> 
                                 <option value="2">Feb <?=$curYear?></option>
                                 <option value="3">Mar <?=$curYear?> </option>
                                 <option value="4">April <?=$curYear?> </option>
                                 <option value="5">May <?=$curYear?> </option>
                                 <option value="6">June <?=$curYear?> </option>
                                 <option value="7">July <?=$curYear?> </option>
                                 <option value="8">August <?=$curYear?> </option>.
                                 <option value="9">Sep <?=$curYear?> </option>
                                 <option value="10">Octo <?=$curYear?> </option>
                                 <option value="11">Nov <?=$curYear?> </option>
                                 <option value="12">Dec <?=$curYear?> </option>
                              </select>  <input  type="submit" class="button" value="See Commission Statements" name="search" /> 
                              
                              </form>
                               </td>
                              
                                 </tr>
                                 
                                 
                               <tr> <td style="width:100%">
                               
                                <div style="float:left; padding-bottom:5px;width:100%">
                                <br />
                                 <font style="font-size:24px"> <i class="icon ion-android-calendar" ></i> </font> <font  style="width:16px;"> <b> 2017 Year To Date</b></font> 
                                 <hr/>  
                         </div>   
                               
                               </td></tr>  
                                 
                                 
                                 </table>
                                 
                                 
                               
                                 
                                 
        </div>

    <div id="datatable" style="width:100%; ">
      <table class="table table-striped white b-a" style=" width:100%; padding:0px; margin:0px;overflow:scroll; background-color:#FFFFFF"  cellpadding="0" cellspacing="">
      
      <tr>
      
      <td style="width:350px;min-width:20px; background-color:#FFFFFF">&nbsp;
          <table  style="width:100%">
           <tr>  
                  <td bgcolor="#FFFFFF" style="width:100%"> 
                       
                       
                        
                        </td>    
                        
            </tr>
            
             <tr>  
                  <td bgcolor="#FFFFFF" style=""> 
                        <div style="float:left; padding-bottom:5px; width:200px; background-color:#56af45; "> 
                             <div style="float:left; width:40px;margin-bottom:10px; margin-top:10px;"> <img src="./images/sca.png"> </div>
                             <div style="float:left;margin-bottom:10px; margin-top:10px;"> <span style="color:#FFFFFF"><font size="+1">$<?=currentyearcommition();?> </font> <br/> Commission Paid </span> </div>
                             
                           
                         </div> 
                         <div style="clear:both;height:20px;">&nbsp;</div>
                          <div style="clear:both"><font color="#56af45" size="+1"><b> Current Point (Last 3 Month):<?=$query['threemonthspoints']?> pnt</b> </font><input  type="button" value="UPDATE" onclick="show('<?=$user?>',<?=$wig_list_row['member_id']?>)" /> </div>    
                          <div style="clear:both"><font color="#101823" size="+2">Pending Transactions </font>
                          
                          
                          <hr />
                          
                           </div>   
                   </td>    
            </tr>
            
                <tr>
                     <td>
                           <table style="width:100%; background-color:#999999">
                             <tr> 
                                <td style="width:100px; text-align:center; font-size:14px">Order#</td>
                               <td  style="width:100px; text-align:center;font-size:14px">Processed Date</td> 
                               <td style="width:100px; text-align:center;font-size:14px">Sale Agent</td> 
                                <td style="width:100px; text-align:center;font-size:14px">Agent</td> 
                               <td style="width:100px; text-align:center;font-size:14px">Agent Name</td>
                               <td style="width:100px; text-align:center;font-size:14px">Sales Amount</td>  
                               <td style="width:100px; text-align:center;font-size:14px">My%</td>
                               
                               <td style="width:100px; text-align:center;font-size:14px">Pay</td> </tr>
                            
                           <tr> <td  colspan="7"> </td> </tr> 
                            
                            </table>
                            
                            <form action="" method="post" name="commission">
                            <table style="width:100%; background-color:#CCCCCC">
                            
                            <?=commitionform($member_id); ?>
                         <!--    <tr> 
                                      <td style="width:100px; text-align:center;font-size:14px"><input type="text" style="width:80px;" /></td> 
                                      <td style="width:100px; text-align:center;font-size:14px"><input type="text" style="width:80px;"  /></td> 
                                      <td style="width:100px; text-align:center;font-size:14px;color:#000000">sc232</td> 
                                      <td style="width:100px; text-align:center;font-size:14px;color:#000000">DHIRENRDA</td> 
                                      <td style="width:100px; text-align:center;font-size:14px"><input type="text"  style="width:80px;"  /></td>   
                                      <td style="width:100px; text-align:center;font-size:14px"><input type="text" style="width:80px;"  /></td> 
                                      <td style="width:100px; text-align:center;font-size:14px"><input type="text" style="width:80px;"  /></td>
                              
                              
                               </tr>
                            
                            <tr> 
                                      <td style="width:100px; text-align:center;font-size:14px"><input type="text" style="width:80px;" /></td> 
                                      <td style="width:100px; text-align:center;font-size:14px"><input type="text" style="width:80px;"  /></td> 
                                      <td style="width:100px; text-align:center;font-size:14px;color:#000000">sc232</td> 
                                      <td style="width:100px; text-align:center;font-size:14px;color:#000000">DHIRENRDA</td> 
                                      <td style="width:100px; text-align:center;font-size:14px"><input type="text"  style="width:80px;"  /></td>   
                                      <td style="width:100px; text-align:center;font-size:14px"><input type="text" style="width:80px;"  /></td> 
                                      <td style="width:100px; text-align:center;font-size:14px"><input type="text" style="width:80px;"  /></td>
                              
                              
                               </tr>
                               <tr> 
                                      <td style="width:100px; text-align:center;font-size:14px"><input type="text" style="width:80px;" /></td> 
                                      <td style="width:100px; text-align:center;font-size:14px"><input type="text" style="width:80px;"  /></td> 
                                      <td style="width:100px; text-align:center;font-size:14px;color:#000000">sc232</td> 
                                      <td style="width:100px; text-align:center;font-size:14px;color:#000000">DHIRENRDA</td> 
                                      <td style="width:100px; text-align:center;font-size:14px"><input type="text"  style="width:80px;"  /></td>   
                                      <td style="width:100px; text-align:center;font-size:14px"><input type="text" style="width:80px;"  /></td> 
                                      <td style="width:100px; text-align:center;font-size:14px"><input type="text" style="width:80px;"  /></td>
                              
                              
                               </tr>
                               
                               <tr> 
                                      <td style="width:100px; text-align:center;font-size:14px"><input type="text" style="width:80px;" /></td> 
                                      <td style="width:100px; text-align:center;font-size:14px"><input type="text" style="width:80px;"  /></td> 
                                      <td style="width:100px; text-align:center;font-size:14px; color:#000000">sc232</td> 
                                      <td style="width:100px; text-align:center;font-size:14px;color:#000000">DHIRENRDA</td> 
                                      <td style="width:100px; text-align:center;font-size:14px"><input type="text"  style="width:80px;"  /></td>   
                                      <td style="width:100px; text-align:center;font-size:14px"><input type="text" style="width:80px;"  /></td> 
                                      <td style="width:100px; text-align:center;font-size:14px"><input type="text" style="width:80px;"  /></td>
                              
                              
                               </tr>
                             -->
                            
                            </table>
                           
                            
                            
                            
                             
                            
                             <table style="width:100%; background-color:#999999">
                             
                            
                                <tr  > <td   align="right"> <input  type="submit"  value="ADD TO COMMISSION" name="comm" /></td> </tr> 
                            
                            </table> 
                            
                             </form>
                     
                     
                     </td>
                </tr>
             
            
            
            <tr>  
                  <td bgcolor="#FFFFFF" style="border-top:none"> 
                  <div style="clear:both;"><font color="#101823" size="+2">Paid Transactions </font>
                  
                  <hr />
                  
                   </div>   
                  </td>
            </tr>
            
            <tr>  
                  <td bgcolor="#FFFFFF" > 
                  <div style="clear:both;"><font color="#101823" size="+1"><b>Exported on Tue,May 23rd 2017,17:10 Total:$630.02</b> </font> </div>   
                  </td>
            </tr>
            <tr>  
                  <td bgcolor="#FFFFFF" style="border-top:none" > 
                    <table style="width:100%;">
                     <tr> <td bgcolor="#FFFFFF">
                     
                               <table style="width:100%;">
                               
                             
                                   <tr style="background-color:#eeeeee" > 
                                       <td style="width:100px; text-align:center;font-size:14px">Order#</td>  
                                       <td style="width:100px; text-align:center;font-size:14px">Processed Date</td>  
                                       <td style="width:100px; text-align:center;font-size:14px">Sale Agent</td>  
                                       <td style="width:100px; text-align:center;font-size:14px">Agent</td>  
                                       <td style="width:100px; text-align:center;font-size:14px">Agent Name</td> 
                                       <td style="width:100px; text-align:center;font-size:14px">Sales Amount</td>   
                                       <td style="width:100px; text-align:center;font-size:14px">My%</td> 
                                       <td style="width:100px; text-align:center;font-size:14px">Pay</td> 
                                   </tr>
                                   <?
								   mysql_query("select * from  commission_detail where  order_id IN (select distinct order_id from commission_detail) ORDER BY processing_date ")
								   ?>
                              <?  if($_POST['search']){ ?>
                              <?=searchtransaction($childrenarray,$startdate,$enddate)?>
                              <? }else{ ?>
                               <?=transaction($childrenarray)?>
                               <? } ?>
                               </table> 
                     
                        </td> </tr>
                    
                    
                    </table>
                 
                 
                 
                  </td>
            </tr>
                   
          </table> 
      
      
      
      
      </td>
     
       
      
      </tr>
      
              
            
           
			
        
           
        
      </table>
                              </td>
                              <td width="20%" align="left" valign="top">
                              <!--left part -->
            <?  $wig_list_query=mysql_query(dopaging("SELECT * FROM `member` where member_id='$member_id'",50));
			     $wig_list_row=mysql_fetch_assoc($wig_list_query);
			
			  ?>
                              <table style="width:100%;">
                                 <tr> <td><?=$wig_list_row['f_name']?> <?=$wig_list_row['l_name']?></td> </tr>
                                 
                                 <?=agentlist($wig_list_row['member_id'],1)?>
                              
                              </table>
                              
                              
                               </td>
                          </tr>    
                        </table> </td>
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
    
  
   
     <h3 class="h3">Current Point (Last 3 Month):<?=$query['threemonthspoints']?> pnt</h3><hr>
     <div class="full" style="color:rgb(153,153,153); margin-top:1em; height:100px">
     <div id="berror" style="color:red;"></div>
  
   <div id="uerror" style="color:red;"> New Points</div>
 
   <input type="text"  value="" name="newpoints" />
  
   </div>
    <div style="width:100%; text-align:right">
     <button type="button" class="blue-btn glyphicon glyphicon-lock" style="background:#ffffff; color:#FF0000; width: 15%;" onClick="close_popup('overlay-mask-1')">
  <span class="" style="font-family:sans-serif;">Cancel</span>
  </button> <input type="submit"  value="Submit" name="sub"/> </div>
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


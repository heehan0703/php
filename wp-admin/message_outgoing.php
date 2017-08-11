<?

session_start();

require_once('include/connectdb.php');

include("pager.php");


if($_SESSION["ADMIN_ID"]==""){
	
header("location:login.php");	
	
	exit;
	 } 
	/* 
	  $limit=16;
	 $sql= ("select * from designs where prod_id='0' order by id DESC");
     $result=mysql_query(dopaging($sql,$limit));
*/
if($_GET['act']=='del'){
	
	$msg_id=$_GET['msg_id'];
mysql_query("delete from message where id='$msg_id'");
header("location:message_list.php");
	
}


$message_query=mysql_query(dopaging(" SELECT * FROM `message` where sent=0 order by id desc ",10));

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>admin</title>

<link href="style/style.css" rel="stylesheet" type="text/css" />
<link href="style/design.css" rel="stylesheet" type="text/css"  />
<style type="text/css">
pre{
	  white-space: pre-wrap; 
    white-space: moz-pre-wrap;
    white-space: -pre-wrap;
    white-space: -o-pre-wrap; 
    word-wrap: break-word;
	
}
</style>

</head>



<body>

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

                              <td align="left" class="white-18">Message List</td>

                            </tr>

                          </table></td>

                          <td width="0%" ><img src="images/lft-menu-hd-corner-2.png" width="10" height="35" /></td>

                        </tr>

                        <tr>

                          <td >&nbsp;</td>

                          <td><table width="100%" border="0" cellspacing="3" cellpadding="3">

                            <tr>

                             <td colspan="8"></td>
                              
                       
                            </tr>
 
                    <tr>
                <th width="2%">Num</th>   
                 <th width="7%">User Email</th>   
                  <th width="5%">User Type</th>   
                   <th width="5%">From</th>   
                    <th width="18%">Subject</th>   
                     <th width="400">Message</th>   
                      <th width="5%">Received</th>  
                     <th width="3%">Delete</th>    
                    </tr> 
                    <?  $count=0;
					while($message_row=mysql_fetch_assoc($message_query)){
						$count++;
			$user_email=mysql_result(mysql_query(" select email from member where member_id='$message_row[member_id]'"),0);			
						 ?>
                      <tr>
                <td width="2%"><?=$count?></td>  
                  <td width="10%"><?=$user_email?></td>  
                    <td width="7%"><?=$message_row['user_type']?></td>  
                       <td width="7%"><?=$message_row['from']?></td>  
                          <td width="18%"><?=$message_row['subject']?></td>  
                             <td width="" style=" width:400px;"><pre style="width:400px;"><?=$message_row['message_detail']?></pre></td>  
                                <td width="5%"><?=date("M j",$message_row['date'])?></td>  
                                   <td width="2%"><a href="?act=del&msg_id=<?=$message_row['id']?>" onclick="return confirm('Are you sure want to delete this ?')">Delete</a></td>     
                  
                    </tr>  
                    <? } ?>   
                                        
                          

                            <tr>

                              <td colspan="8">&nbsp;</td>

                            </tr>

                            <tr>

                              <td colspan="8"><table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
                                	<td colspan="2" align="left">
                                   <font size="+2"> <?php echo rightpaging(); ?> </font>
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


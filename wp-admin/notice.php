<?php
ini_set('display_errors', '1');
session_start();
require_once('include/connectdb.php');
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
$id=$_GET['newsid'];
if($_GET['act']=='delete')
{
	//echo "dhirendra";
	$query3=mysql_query("delete from `admin_notice` where id='$id'");
	  
}
$wig_list_query=mysql_query("SELECT * FROM admin_notice  order by id desc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Supplier List</title>

<link href="style/style.css" rel="stylesheet" type="text/css" />
<link href="style/design.css" rel="stylesheet" type="text/css"  />


<script>
function YNconfirm() { 
    if (window.confirm('are you sure you want to delete this data'))
    {
        return true;
    }
    else
        return false;
};

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

                              <td align="left" class="white-18">Notice List</td>
                              
                              <td align="left" class="white-18"><a href="./add_notice.php"><font color="#FFFFFF">Add New Notice</font></a></td>

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
     <tr><th width="5%" align="center">Id</th>
     <th width="12%" align="left">Date</th>
     <th width="12%" align="left">notice</th>
    
     <th width="30%" align="left">Action</th>
    
     </tr>
     
       <?php
	 
	 
	
 
			while($wig_list_row=mysql_fetch_assoc($wig_list_query))
			 {
			  
			  ?> 
     
     
     
    
     <tr><td width="5%" align="center"><?=$wig_list_row['id']?></td>
     <td width="20%" align="left"><?=$wig_list_row['notice_date']?></td>
     <td width="20%" align="left"><?=$wig_list_row['Notice']?></td>
     
     <th width="30%" align="left"><a href="./notice.php?act=delete&newsid=<?=$wig_list_row['id']?>" onclick="return(YNconfirm());">Delete </a></th>
    
      </tr>
     
      <?php  } ?>
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
                                   <font size="+2"> <?php  //echo leftpaging(); ?> </font>
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


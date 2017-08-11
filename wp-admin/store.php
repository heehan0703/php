<?php

session_start();

require_once('include/connectdb.php');




if($_SESSION["ADMIN_ID"]==""){
	
header("location:login.php");	
	
	exit;
	 } 
		$wig_list_query=mysql_query("SELECT * FROM store  order by id desc");

 $id=$_GET['id'];


if($_GET['act']=='delete')
{
	$query3=mysql_query("delete from store where id='$id'");
	 //echo "delete from store where id='$id';";
	header("location:store.php");	

}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Supplier List</title>

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

                              <td align="left" class="white-18">Store List</td>

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
     <tr><th width="6%" align="center">Id</th>
     <th width="12%" align="left">S-Name</th>
     <th width="15%" align="left">S-location</th>
     <th width="15%" align="left">S-phone</th>
     <th width="15%" align="left">S-City</th>
     <th width="10%" align="left">S-State</th>
      <th width="10%" align="left">S-Zip</th>
      <th width="10%" align="left">slogan</th>
      <th width="10%" align="left">image</th>
     <th width="10%" align="left">Edit</th>
     <th width="10%" align="left">DELETE</th>
     <th width="15%" align="left">Manage Store</th>
     
     
    
     </tr>
     
       <?php
	 
	  $count=0;  
	
 
			while($wig_list_row=mysql_fetch_assoc($wig_list_query))
			 {
			  $count++;
			  ?> 
     
     
     
    
     <tr><td width="15%" align="center"><?=$wig_list_row['id']?></td>
     <td width="20%" align="left"><?=$wig_list_row['s_name']?></td>
     <td width="20%" align="left"><?=$wig_list_row['s_location']?></td>
     <td width="20%" align="left"><?=$wig_list_row['s_phone']?></td>
     <td width="20%" align="left"><?=$wig_list_row['s_city']?></td>
      <td width="20%" align="left"><?=$wig_list_row['s_state']?></td>
       <td width="20%" align="left"><?=$wig_list_row['zip']?></td>
        <td width="20%" align="left"><?=$wig_list_row['slogan']?></td>
         <td width="20%" align="left"><img width="50" height="50" src="<?=$wig_list_row['banner_image']?>"></td>
       <td width="20%" align="left"><a href="add_store.php?act=edit&id=<?=$wig_list_row['id']?>">EDIT </a></td>
        <td width="20%" align="left"><a href="store.php?act=delete&id=<?=$wig_list_row['id']?>">DELETE </a></td>
        <td width="40%" align="left"><a href="manage_store.php?id=<?=$wig_list_row['id']?>">Manage Store</a></td>
         
    
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


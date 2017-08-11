<?php

session_start();

require_once('include/connectdb.php');




if($_SESSION["ADMIN_ID"]==""){
	
header("location:login.php");	
	
	exit;
	 } 
	if(isset($_POST['submit'])){
	 $page_name = $_POST['page_name'];
	 $page_description = $_POST['description'];
	 
	 mysql_query("INSERT INTO `page_details`(`page_name`, `page_description`) VALUES 
		                                    ('$page_name','$page_description')");
	 }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>New Page</title>

<link href="style/style.css" rel="stylesheet" type="text/css" />
<link href="style/design.css" rel="stylesheet" type="text/css"  />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="../ckeditor/ckeditor.js"></script>

<script type="text/javascript">

function validate_form()
{
var page_name=document.getElementById('page_name').value;

if(page_name==''){
			alert("Please Enter a Page Name");
			document.getElementById('page_name').focus();
			return false
			}
		
}
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

                              <td align="left" class="white-18">New Page</td>

                            </tr>

                          </table></td>

                          <td width="0%" ><img src="images/lft-menu-hd-corner-2.png" width="10" height="35" /></td>

                        </tr>

                        <tr>

                          <td >&nbsp;</td>

                          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

                            <tr>

                             <td colspan="2"></td>
                              
                       
                            </tr>
                     <form id="form1" action="" method="post" onsubmit="return validate_form()">
                     <tr>
                     <td><table width="100%" cellpadding="3" cellspacing="3">
                     <tr>
                     <td>Page Name</td>
                     <td><input type="text" name="page_name" id="page_name" /></td>
                     </tr>
                     <tr>
                     <td colspan="2"> Page Description</td>
                     </tr>
                     <tr>
                     <td colspan="2"><textarea class="ckeditor" cols="80" id="description" name="description" rows="10"></textarea>	</td>
                     </tr>
                     <tr>
                     <td colspan="2"> <input type="submit" name="submit" value="Submit" onclick="Validation(") /></td>
                     </tr>
                      </table>
                      </td>
                      </tr>
                     </form>                   
                          

                            <tr>

                              <td colspan="2">&nbsp;</td>

                            </tr>

                            <tr>

                              <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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


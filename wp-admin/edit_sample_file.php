<?php

session_start();

require_once('include/connectdb.php');

if($_SESSION["ADMIN_ID"]==""){
	
header("location:login.php");	
	
	exit;
	 } 

//$id=$_GET['id'];
$sample_csv_row= mysql_fetch_assoc(mysql_query("SELECT * FROM sample_csv_file where id=1 "));


 echo $page_row;
 
	 
	 if(isset($_FILES['csv']) && $_FILES['csv']!=''){
	 
	 
	  $mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
if(in_array($_FILES['csv']['type'],$mimes)){
	
	$file_csv=$_FILES['csv'];
  			$name_csv=time().'_'.$file_csv['name'];

		move_uploaded_file($file_csv['tmp_name'],'../supplier/bulk_csv/'.$name_csv);
mysql_query("update  `sample_csv_file` set csv_name='$name_csv' where id='1'");
}

 
	 	


 }
   ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Edit Page</title>

<link href="style/style.css" rel="stylesheet" type="text/css" />
<link href="style/design.css" rel="stylesheet" type="text/css"  />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="../ckeditor/ckeditor.js"></script>

<script type="text/javascript">

function validate_form()
{
var csv =document.getElementById('csv').value;

if(csv==''){
			alert("Please upload a csv file");
			document.getElementById('csv').focus();
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

                              <td align="left" class="white-18">Edit Page</td>

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
                     <form id="form1" action="" method="post" enctype="multipart/form-data" onsubmit="return validate_form()">
                     <tr>
                     <td><table width="100%" cellpadding="3" cellspacing="3">
                     <tr>
                     <td>Sample File</td>
                     <td><a href="../supplier/bulk_csv/<?=$sample_csv_row['csv_name']?>" target="_blank">
                      <?=$sample_csv_row['csv_name']?> </a></td>
                     </tr>
                     <tr>
                     <td colspan="2"></td>
                     </tr>
                     <tr>
                     <td>Change Sample File</td>
                     <td><input type="file" name="csv" id="csv"  /></td>
                     </tr>
                   
                     <tr>
                     <td colspan="2"> <input type="submit" name="submit" value="Update" /></td>
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


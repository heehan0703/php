<?php 
session_start();
require_once('../wp-admin/include/connectdb.php');
if($_SESSION["id"]==""){
	
header("location:login.php");	
	
	exit;
	 }
	  
 $ids = $_SESSION['id'];
echo  $ids;
$time=mysql_query("SELECT * FROM store_times where store_id = $ids order by id asc");

 $id=$_GET['id'];


if($_GET['act']=='delete')
{
	$query3=mysql_query("delete from store_times where id='$id'");
	 //echo "delete from store where id='$id';";
	header("location:manage_time.php");	

}


?>
<!DOCTYPE html>
<html>
    
    <head>
        <title>Tables</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <link href="assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script><![endif]-->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    
    <body>
      <?php include 'store_header.php';?>
        <div class="container-fluid">
            <div class="row-fluid">
                <!-- left menu start-->
                  <?php include 'store_leftmenu.php';?>
                
               <!-- left menu end-->
                <div class="span9" id="content">

                  

                     <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">MANAGE OPEN CLOSE TIME</div>
                                  <div class="muted pull-right"><a href="add_time.php">ADD TIME</a></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   
                                    
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>STORE ID</th>
                                                <th>OPEN TIME</th>
                                                <th>CLOSE TIME</th>
                                                <th>DAY</th>
                                                <th>EDIT</th>
                                                 <th>DELETE</th>
                                            </tr>
                                        </thead>
        <?php
	 
	  $count=0;  
	
 
			while($times=mysql_fetch_assoc($time))
			 {
			  $count++;
			  ?> 
                                          <tr class="gradeU">
                                                <td><?=$times['id']?></td>
                                                <td><?=$times['store_id']?></td>
                                                <td><?=$times['open_time']?></td>
                                                <td class="center"><?=$times['close_time']?></td>
                                                <td class="center"><?=$times['day']?></td>
                                       <td> <a href="add_time.php?act=edit&id=<?=$times['id']?>">EDIT </a></td>
                                <td><a href="manage_time.php?act=delete&id=<?=$times['id']?>">DELETE </a></td>        
                                            </tr> 
                                            <?php  } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
            </div>
            <hr>
            <footer>
                <p>&copy; Vincent Gabriel 2013</p>
            </footer>
        </div>
        <!--/.fluid-container-->

        <script src="vendors/jquery-1.9.1.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="vendors/datatables/js/jquery.dataTables.min.js"></script>


        <script src="assets/scripts.js"></script>
        <script src="assets/DT_bootstrap.js"></script>
        <script>
        $(function() {
            
        });
        </script>
    </body>

</html>
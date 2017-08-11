<?php 
require_once('./wp-admin/include/connectdb.php');
$act=$_GET['act'];
if($act =="del"){
$cartId=$_REQUEST['cartId'];
$URL=$_REQUEST['URL'];
mysql_query("delete from cart  where id=$cartId");
echo("<script>location.href = 'cart.php';</script>");
}
?>
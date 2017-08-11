<?
session_start();
require_once('wp-admin/include/connectdb.php');
$storeid=$_POST['storeid'];
$_SESSION['my_shop']=$storeid;
if($_SESSION['member_id']){
$memberid=$_SESSION['member_id'];
mysql_query("update member set my_shop='$storeid' where member_id='$memberid'");
}
?>
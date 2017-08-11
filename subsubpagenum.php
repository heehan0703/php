<?php
session_start();
//$text_show=$_SESSION["text_show"] ;
//$subcat=$_SESSION["subcat"] ;
$subsubcat=$_GET['subsubcat'];
  include('pager_ajax.php');
require_once('wp-admin/include/connectdb.php');
$value = $_POST['param8'];
$count_value =count($value);
if($subsubcat == '')
{
$a= "SELECT * FROM `product` where category = '$text_show' ";
}
else
{
$a= "SELECT * FROM `product` where sub_subcategory='$subsubcat'";

}

$product_query= mysql_query(dopaging($a,20));
echo rightpaging();
?>

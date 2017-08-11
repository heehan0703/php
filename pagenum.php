<?php
session_start();
$text_show=$_SESSION["text_show"] ;
$subcat=$_SESSION["subcat"] ;
  include('pager_ajax.php');
require_once('wp-admin/include/connectdb.php');
$value = $_POST['param8'];
 $productnum=$_POST['productnum'];
$count_value =count($value);
if($subcat == '')
{
$a= "SELECT * FROM `product` where category = '$text_show' ORDER BY `product`.`wholesale_price` DESC";
}
else
{
$a= "SELECT * FROM `product` where category = '$text_show' and subcategory='$subcat' ORDER BY product_name DESC";

}

$product_query= mysql_query(dopaging($a,$productnum));
echo rightpaging();
?>

<?php
session_start();
$member_id=$_SESSION['member_id'];
//print_r($_SESSION);
//echo $_SESSION['cart_continus_url']."dhi";
require_once('wp-admin/include/connectdb.php');
$couponcode=$_POST['couponcode'];
if($member_id){
$mysqlarray=mysql_query("select * from member where refcode='$couponcode' and member_id<>$member_id");
}else{
$mysqlarray=mysql_query("select * from member where refcode='$couponcode'");
}
$numrefrel=mysql_num_rows($mysqlarray);
if($numrefrel){
 $discounttype="refrel";
}else{
     $mysqlarray=mysql_query("select * from couponcode where code='$couponcode'");
	 $numcoupon=mysql_num_rows($mysqlarray);
	}

if($numcoupon){
$discounttype="coupon";
}

if($numrefrel or $numcoupon){
$row=mysql_fetch_array($mysqlarray);

$results = array();
$results['id']=$row['id'];
$results['value']=$row['value'];
$results['type']=$row['type'];
$results['discounttype']=$discounttype;
$results['sucess']="sucess";
$data=json_encode($results);
echo "$data";
}else{
      echo "error";
    }
?>
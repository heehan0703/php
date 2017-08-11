<?
session_start();
require_once('wp-admin/include/connectdb.php');
$latitude=$_POST['lat'];
$longitude=$_POST['long'];
if($_SESSION['my_shop']){
$query="SELECT id,s_name,s_location,s_phone,s_city,zip,s_state,lat,lng, ( 3959 * acos( cos( radians($latitude) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( lat ) ) ) ) AS distance FROM store  where id <> $mystoreid ORDER BY distance";
}else{
 $query="SELECT id,s_name,s_location,s_phone,s_city,zip,s_state,lat,lng, ( 3959 * acos( cos( radians($latitude) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( lat ) ) ) ) AS distance FROM store  ORDER BY distance"; 
 }
 $store=mysql_query($query);
 for ($x = 0; $x < 3; $x++) {
		$rows = mysql_fetch_array($store);
		$storeid=$rows['id'];
		$storename=$rows['s_name'];
		$storelocation=$rows['s_location'];
		$s_state=$rows['s_state'];
		echo" store name--$storename   Store location--$storelocation  State--$s_state <br/> " ;
}
?>
<?php
session_start();
require_once('wp-admin/include/connectdb.php');
    $zipcode=$_POST['zipcode'];
	//echo "$zipcode";
	$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$zipcode."&sensor=false";
    $details=file_get_contents($url);
    $result = json_decode($details,true);
    $latitude=$result['results'][0]['geometry']['location']['lat'];
    $longitude=$result['results'][0]['geometry']['location']['lng'];
	//echo "$latitude--$longitude";
	$_SESSION['latitude']=$latitude;
	$_SESSION['longitude']=$longitude;
	$latitude = $_SESSION['latitude'];
    $longitude = $_SESSION['longitude'];
$query="SELECT id,s_name,s_location,s_phone,s_city,zip,s_state,lat,lng, ( 3959 * acos( cos( radians($latitude) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( lat ) ) ) ) AS distance FROM store  ORDER BY distance";
$store=mysql_query($query);
?>
<ul>
<?
while($rows = mysql_fetch_array($store)) {
?>
<li>
  <div style="float:left; vertical-align:top;">
   <input type="radio" onClick="pickup(<?=$rows['id']?>)" name="shipping_type">
  </div>
   <div>
   <label for="1"> <b style="color:#000; font-size:18px;">&nbsp;&nbsp;<?=$rows['s_name']?></b> <br> <font style="font-size:12px">&nbsp;&nbsp;&nbsp;&nbsp; <?=$rows['s_location']?></font>
</label>
 </div>
</li>																
<?	
}
?>
</ul>
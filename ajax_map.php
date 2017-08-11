<?php 
session_start();
require_once('wp-admin/include/connectdb.php');
$location=$_POST['location'];
$distance=$_POST['distance'];
$Distancetype=$_POST['Distancetype'];

if(ctype_digit($location))
{ 
 //$zipcode="92604";
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$location."&sensor=false";
    $details=file_get_contents($url);
    $result = json_decode($details,true);

    $latitude=$result['results'][0]['geometry']['location']['lat'];

    $longitude=$result['results'][0]['geometry']['location']['lng'];
	$_SESSION['latitude']=$latitude;
	$_SESSION['longitude']=$longitude;
}else{	  
// We get the JSON results from this request
$geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($location).'&sensor=false');
// We convert the JSON to an array
$geo = json_decode($geo, true);
// If everything is cool
if ($geo['status'] = 'OK') {
  // We set our values
  $latitude = $geo['results'][0]['geometry']['location']['lat'];
  $longitude = $geo['results'][0]['geometry']['location']['lng'];
  $_SESSION['latitude']=$latitude;
  $_SESSION['longitude']=$longitude;
// echo "$latitude--$longitude";
}else{
$Error= "Incorrect Address";
}
}
//3959 for miles and 6371 for kilometers
if($Distancetype=="miles"){
$query="SELECT id,s_name,s_location,s_city,s_state,zip,lat,lng, ( 3959 * acos( cos( radians($latitude) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( lat ) ) ) ) AS distance FROM store HAVING distance < $distance ORDER BY distance LIMIT 0 , 20";
$mi="mi";
}else{
$query="SELECT id,s_name,s_location,s_city,s_state,zip,lat,lng, ( 6371 * acos( cos( radians($latitude) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( lat ) ) ) ) AS distance FROM store HAVING distance < $distance ORDER BY distance LIMIT 0 , 20";
$mi="km";
}

$row_query= mysql_query($query);

$dataquery=mysql_query($query);

while($row=mysql_fetch_array($row_query)){
if($_SESSION['my_shop']==$row[id] and $_SESSION['my_shop']!=""){
$buttontext="My Store";
}else{
$buttontext="Make This my store";
}
$address='<div style="clear:both;height:20px;"></div><div style="float:left;"  >'.$row[s_location].'</div><div style="float:left;">&nbsp;'.$row[s_city].'</div><div style="float:left;">&nbsp;'.$row[s_state].'</div>';
$address=$address.'<div style="float:left;">&nbsp;'.$row[zip].'</div>';
$storetime=mysql_query("select * from store_times where store_id='$row[id]'");
$storetimedata='<div style="clear:both;height:3px;"></div>';
while($storetimerow=mysql_fetch_array($storetime)){
$storetimedata=$storetimedata.'<span><div style="float:left;"><div style="width:100px;"></div><font style="font-size:14px;">'.$storetimerow[day].': &nbsp;&nbsp;&nbsp;</div><div style="float:left;">&nbsp;&nbsp;&nbsp;'.$storetimerow[open_time].'</div><div style="float:left;">&nbsp;&nbsp;&nbsp;'.$storetimerow[close_time].'</font></div></span><div style="clear:both;"></div>';
}
$store_content='<div class="content"><div  class="top" ><font size="+2"><b>'.$row[s_name].'</b></font></div> <div style="" class="makestore"><a href="#" class="button" onclick="makestore('.$row[id].')" id="mystore">'.$buttontext.'</a></div> <div stlye="clear:both;" ><font class="location">'.$address.'</font></div><div stlye="clear:both;width:350px;">'.$storetimedata.'</div></div><div style="width:100%;text-align:centre"><div style="float:left; width:150px;">&nbsp;</div><div style="text-align:centre"><a href="/store_front.php?id='.$row[id].'" class="button2">See weekly ad</a></div></div>';
 
 $content=$store_content;
 $lat=$row['lat'];
 $lng=$row['lng'];





$points = array();
array_push($points, array('name' =>$content, 'lat' =>$lat, 'lng' =>$lng)); 

  }
  
   $i=0;
   $store="";
 while($datarow=mysql_fetch_array($dataquery)){ 
 $distance=round($datarow['distance'],2);
 $s=$i+1;
 
 $store=$store.'<li><a href="javascript:triggerClick('.$i.')">
  <div style="width:100%; height:"> 
     <div style="float:left;">'.$s.'.&nbsp;&nbsp;&nbsp;<b>'.$datarow[s_name].'</b> </div> <div style="text-align:right;">'.$distance.''.$mi.' </div>
     <div style="clear:both; text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$datarow[s_location].'</div>
   </div></a>
  </li>';
   $i++; } 
  
echo json_encode(array("mapdata"=>$points,"store"=>$store));
 ?>
<?php
session_start();
require_once('wp-admin/include/connectdb.php');
// We define our address
$Error="";
//"Mountain View, CA";
$address =$_POST['address'];
//$address ='Mountain View, CA';
if($address!=""){
// We get the JSON results from this request
$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
// We convert the JSON to an array
$geo = json_decode($geo, true);
// If everything is cool
if ($geo['status'] = 'OK') {
  // We set our values
  $latitude = $geo['results'][0]['geometry']['location']['lat'];
  $longitude = $geo['results'][0]['geometry']['location']['lng'];
// echo "$latitude--$longitude";
}else{
$Error= "Incorrect Address";
}

//3959 for miles and 6371 for kilometers
$query="SELECT id,s_location,s_city,s_state,zip,lat,lng, ( 3959 * acos( cos( radians($latitude) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( lat ) ) ) ) AS distance FROM store HAVING distance < 25 ORDER BY distance LIMIT 0 , 20";

$row_query= mysql_query($query);

$num=mysql_num_rows($row_query);
//echo "";
if(!$num)
{
 $Error= "No Store Available with in 25 miles ";
 }
$dataquery=mysql_query($query);
}else{
$Error= "Please Enter the address ";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Store map</title>
<script src="http://maps.google.com/maps/api/js"></script>
<style type="text/css">
body {
  padding: 0;
  margin: 0;
}
.container {
  width: 100%;
  height: 100%;
}
.archive-map {
  width: 100%;
  height: 600px;
}
.nav {
  background-color: #fff;
  width: 100%;
  text-align: center;
  margin: 0;
  padding-left: 0;
}
.nav li {
list-style-type:none;
border-bottom:2px solid #c8cfd9;
}
.nav li a {
  color: #000;
  padding: 10px;
  display: block;
  position: relative;
  z-index: 100;
  text-decoration:none;
}
#floating-panel {
        position: absolute;
        top: 250px;
        left: 10%;
        z-index: 5;
        background-color: #fff;
        
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        
		width:300px;
		height:500px;
		overflow: scroll;
      }
      #floating-panel {
        margin-left: -52px;
      }
	  .button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 5px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 18px;
    margin: 4px 2px;
    cursor: pointer;
}
 .button2 {
    background-color: #fff;
    border: none;
    color: green;
    padding: 5px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 18px;
    margin: 4px 2px;
    cursor: pointer;
	border:2px solid #c8cfd9;
}
</style>
<script language="javascript"> 
	var markers = new Array();
var map;
var locations = [<? while($row=mysql_fetch_array($row_query)){
if($_SESSION['my_shop']==$row[id] and $_SESSION['my_shop']!=""){
$buttontext="My Store";
}else{
$buttontext="Make This my store";
}
$address='<div style="clear:both;height:20px;"></div><div style="float:left;" ><font size="+1">'.$row[s_location].'</div><div style="float:left;">&nbsp;'.$row[s_city].'</div><div style="float:left;">&nbsp;'.$row[s_state].'</div>';
$address=$address.'<div style="float:left;">&nbsp;'.$row[zip].'</font></div>';
$storetime=mysql_query("select * from store_times where store_id='$row[id]'");
$storetimedata='<div style="clear:both;height:3px;"></div>';
while($storetimerow=mysql_fetch_array($storetime)){
$storetimedata=$storetimedata.'<span><div style="float:left;"><font style="font-size:14px;">'.$storetimerow[day].': &nbsp;&nbsp;&nbsp;</div><div style="float:left;">&nbsp;&nbsp;&nbsp;'.$storetimerow[open_time].'</div><div style="float:left;">&nbsp;&nbsp;&nbsp;'.$storetimerow[close_time].'</font></div></span><div style="clear:both;"></div>';
}
$store_content='<div style="width:400px; height:300px;"><div style="float:left;"><font size="+2"><b>'.$row[s_city].'</b></font></div> <div style="text-align:right"><a href="#" class="button" onclick="makestore('.$row[id].')" id="mystore">'.$buttontext.'</a></div> <div stlye="clear:both;width:400px;">'.$address.'</div><div stlye="clear:both;width:350px;">'.$storetimedata.'</div></div><div style="width:100%;text-align:centre"><div style="float:left; width:150px;">&nbsp;</div><div style="text-align:centre"><a href="/store_add.php?store_id='.$row[id].'" class="button2">See weekly ad</a></div></div>'; ?>
 ['<?=$store_content;?>', <?=$row['lat']?>, <?=$row['lng']?>],<? } ?>]


// Setup the different icons and shadows
var iconURLPrefix = 'http://maps.google.com/mapfiles/ms/icons/';

var icons = [
  iconURLPrefix + 'red-dot.png',
  iconURLPrefix + 'green-dot.png',
  iconURLPrefix + 'green-dot.png',
  iconURLPrefix + 'red-dot.png',
  iconURLPrefix + 'purple-dot.png',
  iconURLPrefix + 'green-dot.png'
]
var iconsLength = icons.length;

function initialize() {
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: new google.maps.LatLng(locations[0][1], locations[0][2]),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    mapTypeControl: false,
    streetViewControl: false,
    panControl: false,
    zoomControlOptions: {
      position: google.maps.ControlPosition.LEFT_BOTTOM
    }
  });


  var infowindow = new google.maps.InfoWindow({
    maxWidth: 400
  });

  var iconCounter = 0;

  // Add the markers and infowindows to the map
  for (var i = 0; i < locations.length; i++) {
    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
      map: map,
      icon: icons[iconCounter],
      title: 'Click to zoom'
    });

    markers.push(marker);

    google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {

      return function() {
        infowindow.setContent(locations[i][0]);
        infowindow.open(map, marker);
        map.setZoom(12);
        //map.setCenter(marker.getPosition());	
      }
    })(marker, i));

    google.maps.event.addListener(marker, 'click', (function(marker, i) {

      return function() {
        infowindow.setContent(locations[i][0]);
        infowindow.open(map, marker);
        map.setZoom(12);
       // map.setCenter(marker.getPosition());
      }
    })(marker, i));


    iconCounter++;
    // We only have a limited number of possible icon colors, so we may have to restart the counter
    if (iconCounter >= iconsLength) {
      iconCounter = 0;
    }

  }
  autoCenter();
}
google.maps.event.addDomListener(window, 'load', initialize);

function triggerClick(i) {
  google.maps.event.trigger(markers[i], 'click');
  
  //map.getBounds();	
}


function makestore(data){
//$('#mystore').html('Save');
$.ajax({
  type: "POST",
  url: "make-mystore.php",
  data: data,
  success: success,
  dataType: dataType
});
document.getElementById("mystore").innerHTML="My Store"
}

function autoCenter() {
  //  Create a new viewpoint bound
  var bounds = new google.maps.LatLngBounds();
  //  Go through each...
  for (var i = 0; i < markers.length; i++) {
    bounds.extend(markers[i].position);
  }
  //  Fit these bounds to the map
  map.fitBounds(bounds);
}
</script>
</head>
<body onload="triggerClick(0)">
<?php include'var1.php'?>
<? if($Error==""){ ?>
<div id="floating-panel">
<div style="width:100%; background:#b3d1ff; height:auto; text-align:left;border-bottom:2px solid #c8cfd9; padding:4px;">We found <?=$num;?> fahair Stores near <?=$address?></div>
<ul class="nav">
<? $i=0;
 while($datarow=mysql_fetch_array($dataquery)){ 
 $distance=round($datarow['distance'],2);
 ?>
  <li><a href="javascript:triggerClick(<?=$i?>)">
  <div style="width:100%; height:"> 
     <div style="float:left;"><?=$i+1;?>.&nbsp;&nbsp;&nbsp;<b><?=$datarow['s_state']?></b> </div> <div style="text-align:right;"><?=$distance;?>mi </div>
     <div style="clear:both; text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$datarow['s_location']?></div>
   </div></a>
  </li>
  <? $i++; } ?>
</ul>
</div>
<div class="container">
  <div id="map" class="archive-map"></div>
</div>
<? }else{ ?>
<div align="center"><font size="+2"> <?=$Error?></font> </div>
<? } ?>

<?php include'foot.php'?>
</body>
</html>
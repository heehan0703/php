<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print "$firstname $lastname"; ?></title>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Abel|Satisfy' rel='stylesheet' type='text/css' />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->

<script type = "text/javascript" src = "http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</script>

<style type="text/css">
            #map {
    width: 850px;
    height: 500px;
    border: 0px;
    padding: 0px;
    position: absolute;
    top: 76px;
    left: 253px;
}
</style>
<script src="http://maps.google.com/maps/api/js?key=AIzaSyC9YBiNmZG9jIWY32FzJwn92iuJtJZHjfc&sensor=false" type="text/javascript"></script>
<script type="text/javascript">
 var icon = new google.maps.MarkerImage("http://maps.google.com/mapfiles/ms/micons/blue.png",
                       new google.maps.Size(32, 32), new google.maps.Point(0, 0),
                       new google.maps.Point(16, 32));
            var center = null;
            var map = null;
            var currentPopup;
            var bounds = new google.maps.LatLngBounds();
            function addMarker(lat, lng, info) {
                var pt = new google.maps.LatLng(lat, lng);
                bounds.extend(pt);
                var marker = new google.maps.Marker({
                    position: pt,
                    icon: icon,
                    map: map
                });
                var popup = new google.maps.InfoWindow({
                    content: info,
                    maxWidth: 300
                });
                google.maps.event.addListener(marker, "click", function() {
                    if (currentPopup != null) {
                        currentPopup.close();
                        currentPopup = null;
                    }
                    popup.open(map, marker);
                    currentPopup = popup;
                });
                google.maps.event.addListener(popup, "closeclick", function() {
                    map.panTo(center);
                    currentPopup = null;
                });
            }           
            function initMap() {
                map = new google.maps.Map(document.getElementById("map"), {
                    center: new google.maps.LatLng(0, 0),
                    zoom: 14,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    mapTypeControl: true,
                    mapTypeControlOptions: {
                        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
                    },
                    navigationControl: true,
                    navigationControlOptions: {
                        style: google.maps.NavigationControlStyle.ZOOM_PAN
                    }
                });


<?php
session_start();

require_once('include/connectdb.php');

$query = mysql_query("SELECT lattitude, longiude FROM user u 
                      INER JOIN village v
                       ON u.village = v.id")or die(mysql_error());
while($row = mysql_fetch_array($query))
{
 // $name = $row['user_name'];
  $lat = $row['lattitude'];
  $lon = $row['longitude'];
  //$desc = $row['desc'];
//'<b>$name</b>


  echo("addMarker($lat, $lon <br />');\n");

}

?>
 center = bounds.getCenter();
     map.fitBounds(bounds);

     }
</script>
</head>
<body onload="initMap()" style="margin:0px; border:0px; padding:0px;">
<?php  /*require_once('header.php');*/ ?>
<div id="wrapper">
    <div id="page-wrapper">
      <div id="page">
            <div id="wide-content">
              <div id="map"></div>
                </div>
          </div>
        </div>
      </div>
   </div>
   <?php /*require_once('footer.php');*/ ?>
 </body>
</html>
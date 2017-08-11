<?php
session_start();
require_once('wp-admin/include/connectdb.php');
// We define our address
$Error="";
//"Mountain View, CA";
$address =$_POST['address'];
//$address ='Mountain View, CA';
if($address==""){
$address ='Mountain View, CA';
}


if($address!=""){
if(ctype_digit($address))
{ 
 //$zipcode="92604";
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$address."&sensor=false";
    $details=file_get_contents($url);
    $result = json_decode($details,true);
	
	while ($result['status']=="OVER_QUERY_LIMIT") {
    sleep(0.2); // seconds
    $json = file_get_contents($url);
    $result = json_decode($details,true);
	$overlimit="OVER_QUERY_LIMIT";
    }


    $latitude=$result['results'][0]['geometry']['location']['lat'];

    $longitude=$result['results'][0]['geometry']['location']['lng'];
	$_SESSION['latitude']=$latitude;
	$_SESSION['longitude']=$longitude;
}else{	  
// We get the JSON results from this request
$geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
// We convert the JSON to an array
$geo = json_decode($geo, true);

// If everything is cool

while ($geo['status']=="OVER_QUERY_LIMIT") {
    sleep(0.2); // seconds
    $json = file_get_contents($url);
    $geo = json_decode($details,true);
	$overlimit="OVER_QUERY_LIMIT";
    }

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
$query="SELECT id,s_name,s_location,s_city,s_state,zip,lat,lng, ( 3959 * acos( cos( radians($latitude) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( lat ) ) ) ) AS distance FROM store HAVING distance < 200 ORDER BY distance LIMIT 0 , 20";

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width" />
<title>Store map</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<!--Bootstrap-->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyB0FmqpdpeQ_QGHTJ5q8U-nzQT0dSvjQsY&callback=initialize" async="" defer="defer" type="text/javascript"></script>
<!--<script src="https://maps.google.com/maps/api/js"></script>-->
<!-- all css here -->
<!-- AIzaSyBe4Zh7zuphzoYlo5iuBdbnZN3eu7GRP8s  -->
		<!-- bootstrap v3.3.6 css -->
        <link rel="stylesheet" href="/shopick/css/bootstrap.min.css">
		<!-- animate css -->
        <link rel="stylesheet" href="/shopick/css/animate.css">
		<!-- jquery-ui.min css -->
        <link rel="stylesheet" href="/shopick/css/jquery-ui.min.css">
		<!-- meanmenu css -->
        <link rel="stylesheet" href="/shopick/css/meanmenu.min.css">
		<!-- nivo-slider css -->
        <link rel="stylesheet" href="/shopick/lib/css/nivo-slider.css">
		<!-- owl.carousel css -->
        <link rel="stylesheet" href="/shopick/css/owl.carousel.css">
		<!-- flaticon css -->
        <link rel="stylesheet" href="/shopick/css/shopick-icon.css">
		<!-- pe-icon-7-stroke css -->
        <link rel="stylesheet" href="/shopick/css/pe-icon-7-stroke.css">
		<!-- lightbox css -->
        <link rel="stylesheet" href="/shopick/css/lightbox.min.css">
		<!-- style css -->
		
        <link rel="stylesheet" href="/shopick/fstyle.css">
		<!-- responsive css -->
        <link rel="stylesheet" href="/shopick/css/responsive.css">
		<!-- modernizr css -->
        <script src="/shopick/js/vendor/modernizr-2.8.3.min.js"></script>

<link href="css/bootstrap.min.css" rel="stylesheet">



<style type="text/css">
body {
  padding: 0;
  margin: 0;
}
.container2 {
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
        top: 500px;
        left: 10%;
        z-index: 5;
        background-color: #fff;
        
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        
		width:300px;
		height:auto;
		overflow: scroll;
      }
      #floating-panel {
        margin-left: -52px;
      }
	  
	  #floating-panel2 {
        position: absolute;
        top: 250px;
        left: 10%;
        z-index: 5;
        background-color:#f5f5f5;
        
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        
		width:300px;
		height:250px;
		overflow:hidden;
      }
      #floating-panel2 {
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

.button3 {
    background-color: #57c7f8;
	color:#FFFFFF;
    border: none;
    padding: 5px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 18px;
    margin: 4px 2px;
    cursor: pointer;
	border:2px solid #c8cfd9;
	width:250px
	
}
.content{
width:400px;
height:300px;
}
.location{
font-size:20px;
width:400px
}
.top{
float:left;
}
.makestore{
text-align:right;
}
@media (min-width: 100px) and (max-width: 500px) {
.wsmenucontainer {
min-height: 450px !important; 
}
.makestore{
text-align:center;
}
.top{
float:none;
text-align:center
}
.content{
width:200px;
height:300px;
}
.location{
font-size:12px;
width:200px;
}
#floating-panel {
        margin-left: 0px;
      }
	  
#floating-panel {
        position: absolute;
        top: 560px;
        left: 10%;
        z-index: 5;
        background-color: #fff;
        
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        
		width:300px;
		height:auto;
		overflow: scroll;
      }	 
	  
 #floating-panel2 {
        position: absolute;
        top: 310px;
        left: 10%;
        z-index: 100;
        background-color:#f5f5f5;
        
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        
		width:300px;
		height:250px;
		overflow:hidden;
      }
      #floating-panel2 {
        margin-left: 0px;
      }	  
	  .archive-map {
	  top: 380px;
  width: 100%;
  height: 400px;
} 
	}
.overlay-mask {
	background: none repeat scroll 0 0 rgba(28, 45, 50, 0.8);
	/* [disabled]bottom: 0; */
	height: 100%;
	left: 0;
	position: fixed;
	right: 0;
	top: 0;
	width: 100%;
	z-index: 999999;
	display: none;
	overflow-y: hidden;
	overflow-x: hidden;	
}
.overlay.iframe-content {
	border: 2em solid #fff;
	border-radius: 6px;
	box-sizing: content-box;
	padding: 0;
	width: 30%;
	height:70%
}
.overlay {
	background: none repeat scroll 0 0 #fff;
	border-radius: 3px;
	box-shadow: 0 1px 3px rgba(23, 74, 104, 0.35), 0 0 32px rgba(60, 82, 93, 0.35);
	box-sizing: border-box;
	margin: 50px auto 0;
	padding: 30px;
	position: relative;
}
.overlay.iframe-content .title {
	border: medium none;
	margin: 0;
	position: absolute;
}
.overlay .title {
	border-bottom: 1px solid #e2e8ea;
	margin-bottom: 20px;
}
.overlay .close-icon {
	font: 32px Dingbatz;
	color: #b3c5d0;
	content: "";
	display: block;
	font: bold 20px "Dingbatz";
	position: absolute;
	right: 0;
}
.overlay.iframe-content .close-icon {
	/*background: none repeat scroll 0 0 white;
	border-radius: 32px;
	height: 32px;
	left: 706px;
	position: absolute;
	top: -16px;
	width: 32px;

*/
	background: none repeat scroll 0 0 #000;
	border-radius: 32px;
	color: white;
	height: 32px;
	opacity: 1;
	position: absolute;
	right: -2em;
	top: -2em;
	width: 32px;
}
.overlay .close-icon {
	cursor: pointer;
	float: right;
}
	
	
</style>

<style type="text/css">
.main-menu ul li .submenu li:hover a, .subwigs span a:hover {
  padding-left: 20px;
}
.main-menu ul li .submenu .submenu-title a, .subwigs span .subwigs-title  {
  border-bottom: 1px solid #f6416c;
  color: #f6416c;
  display: block;
  font-size: 13px;
  font-weight: 500;
  padding-bottom: 0;
  text-transform: uppercase;
}
.main-menu ul li .submenu, .main-menu ul li .subwigs {
  opacity: 0;
  transform: scaleY(0);
  transform-origin: 0 0 0;
}
.main-menu ul li:hover .submenu, .main-menu ul li:hover .subwigs {
  opacity: 1;
  transform: scaleY(1);
  z-index: 999999;
}
.main-menu ul li .submenu li.submenu-title a:before,
.subwigs span .subwigs-title:before,
.subwigs-photo a::before {
  display: none;
}
.main-menu ul li .subwigs {
    background: #fff none repeat scroll 0 0;
    border-top: 2px solid #f6416c;
    box-shadow: 2px 6px 8px 6px rgba(0, 0, 0, 0.13);
    left: -100px;
    padding: 30px;
    position: absolute;
    width: 340px;
    z-index: 9;
}

.subwigs span {
    float: left;
    padding-right: 30px;
    width: 95%;
}
.subwigs span a {
  color: #000;
  display: block;
  font-size: 12px;
  line-height: 40px;
  position: relative;
}
.subwigs span a::before {
  color: #f6416c;
  content: "\e905";
  font-family: shopick;
  opacity: 0;
  position: absolute;
  transition: all 0.3s ease 0s;
  left: 0;
}
.subwigs span a:hover::before {
  opacity: 1;
}


/* for subweaves  */
.main-menu ul li .submenu li:hover a, .subweaves span a:hover {
  padding-left: 20px;
}
.main-menu ul li .submenu .submenu-title a, .subweaves span .subwigs-title  {
  border-bottom: 1px solid #f6416c;
  color: #f6416c;
  display: block;
  font-size: 13px;
  font-weight: 500;
  padding-bottom: 0;
  text-transform: uppercase;
}
.main-menu ul li .submenu, .main-menu ul li .subweaves {
  opacity: 0;
  transform: scaleY(0);
  transform-origin: 0 0 0;
}
.main-menu ul li:hover .submenu, .main-menu ul li:hover .subweaves {
  opacity: 1;
  transform: scaleY(1);
  z-index: 999999;
}
.main-menu ul li .submenu li.submenu-title a:before,
.subweaves span .subweaves-title:before,
.subweaves-photo a::before {
  display: none;
}
.main-menu ul li .subweaves {
    background: #fff none repeat scroll 0 0;
    border-top: 2px solid #f6416c;
    box-shadow: 2px 6px 8px 6px rgba(0, 0, 0, 0.13);
    left: -100px;
    padding: 30px;
    position: absolute;
    width: 340px;
    z-index: 9;
}

.subweaves span {
    float: left;
    padding-right: 30px;
    width: 95%;
}
.subweaves span a {
  color: #000;
  display: block;
  font-size: 12px;
  line-height: 40px;
  position: relative;
}
.subweaves span a::before {
  color: #f6416c;
  content: "\e905";
  font-family: shopick;
  opacity: 0;
  position: absolute;
  transition: all 0.3s ease 0s;
  left: 0;
}
.subweaves span a:hover::before {
  opacity: 1;
}



@media (min-width:200px) and (max-width: 600px) {
 table{
 border-collapse: collapse;
    border-spacing: 0;
    table-layout: fixed;
    width: 100%;
    word-break: break-all;
	}

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
$address='<div style="clear:both;height:20px;"></div><div style="float:left;"  >'.$row[s_location].'</div><div style="float:left;">&nbsp;'.$row[s_city].'</div><div style="float:left;">&nbsp;'.$row[s_state].'</div>';
$address=$address.'<div style="float:left;">&nbsp;'.$row[zip].'</div>';
$storetime=mysql_query("select * from store_times where store_id='$row[id]'");
$storetimedata='<div style="clear:both;height:3px;"></div>';
while($storetimerow=mysql_fetch_array($storetime)){
$storetimedata=$storetimedata.'<span><div style="float:left;"><div style="width:100px;"></div><font style="font-size:14px;">'.$storetimerow[day].': &nbsp;&nbsp;&nbsp;</div><div style="float:left;">&nbsp;&nbsp;&nbsp;'.$storetimerow[open_time].'</div><div style="float:left;">&nbsp;&nbsp;&nbsp;'.$storetimerow[close_time].'</font></div></span><div style="clear:both;"></div>';
}
$store_content='<div class="content"><div  class="top" ><font size="+2"><b>'.$row[s_name].'</b></font></div> <div style="" class="makestore"><a href="#" class="button" onclick="makestore('.$row[id].')" id="mystore">'.$buttontext.'</a></div> <div stlye="clear:both;" ><font class="location">'.$address.'</font></div><div stlye="clear:both;width:350px;">'.$storetimedata.'</div></div><div style="width:100%;text-align:centre"><div style="float:left; width:150px;">&nbsp;</div><div style="text-align:centre"><a href="/store_front.php?id='.$row[id].'" class="button2">See weekly ad</a></div></div>'; ?>
 ['<?=$store_content;?>', <?=$row['lat']?>, <?=$row['lng']?>],<? } ?>]


// Setup the different icons and shadows
var iconURLPrefix = 'https://maps.google.com/mapfiles/ms/icons/';

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
    zoom: 12,
    center: new google.maps.LatLng(locations[0][1], locations[0][2]),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    mapTypeControl: false,
    streetViewControl: false,
    panControl: false,
    zoomControlOptions: {
      position: google.maps.ControlPosition.LEFT_BOTTOM
    }
  });
google.maps.event.addDomListener(window, "resize", function() {
   var center = map.getCenter();
   google.maps.event.trigger(map, "resize");
   map.setCenter(center); 
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
 $(document).ready(function(){
google.maps.event.addDomListener(window, 'load', initialize);
 });

function triggerClick(i) {
  google.maps.event.trigger(markers[i], 'click');
  
  //map.getBounds();	
}




function updatemap(){
//alert("dhirendra");
  var location = document.getElementById("location").value;
   var distance = document.getElementById("distance").value;
   var distancetype = $('input[name=distancetype]:checked').val();
   


	$.ajax({
	  type: "POST",
	  url: "ajax_map.php",
	  data: {location:location,distance:distance,Distancetype:distancetype},
	  success: function(json) {
	  
	  var data = $.parseJSON(json);
	 //alert(data.store);

     $("#stores").html(data.store);

	locations=[];
	markers=[];
	  //var locations = [];
	 // var locations = 
	   for (i=0; i < data.mapdata.length; i++){
	  // alert($.toJSON(location));
	    locations[i]=[];
		locations[i][0]=data.mapdata[i].name;
		locations[i][1]=data.mapdata[i].lat;
		locations[i][2]=data.mapdata[i].lng;
		
		//alert(location[i][2]);
		
	  }
	  
	  var i=0;
	 // alert(locations[i][0]);
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
google.maps.event.addDomListener(window, "resize", function() {
   var center = map.getCenter();
   google.maps.event.trigger(map, "resize");
   map.setCenter(center); 
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
    
	infowindow.setContent(locations[0][0]);
        infowindow.open(map, marker);
        map.setZoom(12);
   
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
	  
	});

}


function makestore(data){
//$('#mystore').html('Save');
//alert(data);
$.ajax({
  type: "POST",
  url: "make-mystore.php",
  data: {storeid:data},
  success: function(msg) {
 // alert(msg);
   document.getElementById("mystore").innerHTML="<font color='#FFFFFF'>My Store </font>";
}
  
});
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

function check()
{
	//alert("dhirendra");
	var login = document.getElementById("email_login").value;
	var pass = document.getElementById("pwd_login").value;
	
	if(login=="")
	{
     // alert("please enter the username");
	  document.getElementById("uerror").innerHTML="Please enter the username";
	 
		}else if(pass==""){
		//alert("please enter the password");
		 document.getElementById("perror").innerHTML="Please enter the password";
		}else{
		
					   $.ajax({
						  url: 'ajax_login.php',
					 data: {
					  email: login,
					  pass: pass
					   },
					 error: function() {
						 $('#info').html('<p>An error has occurred</p>');
						   },
					 success: function(data) {
					  //alert(data);
					   if(data=='sucess'){
					    document.location.href="index.php"
						}else{
						 document.getElementById("berror").innerHTML="Username and Password do not match ";
						}
					
					},
					type: 'POST'
				   });
		
		
		
		}
		
		
		
	//alert("login"+login);
	return false;
	
}

function test(event)
{
  if(event.keyCode==13){
   check();
   }
}

function show(){
 $("#overlay-mask-8").fadeIn('slow');	
 
}
function close_popup(id){
 //$(".overlay-mask").fadeOut('slow');	
 $("#"+id).fadeOut('slow');
}

</script>

</head>
<body >
 <?php include'header-new.php'?>
 
<div style="height:10px;"></div>
<? if($Error==""){ ?>
<div id="floating-panel2" >
<p style="height:3px;">&nbsp;</p>
   <div>
   <input type="text" name="location" style="background:#FFFFFF; width:250px; border:1px solid  #999999;" id="location" />
    </div>
    <div>
                <div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Country:</b></div>
                <div>
                
                
                 <select name="cars" style="background:#FFFFFF;border:1px solid  #999999; height:35px; width:250px;-webkit-appearance: menulist;-moz-appearance:menulist">
                 <option>Select country </option>
                  <option value="volvo">United States of America</option>
                  
                  
                </select>
                
                </div>
    </div>
    <div style="height:15px;">&nbsp;</div>
    <div style="width:250px; text-align:center">
        <div style="float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Radius:<select id="distance" style="border:1px solid  #999999; height:35px; width:65px;background:#FFFFFF;-webkit-appearance: menulist;-moz-appearance:menulist"><option value="">Select Radius</option><option value="10">10</option><option value="25" selected="selected">25</option><option value="50">50</option><option value="100">100</option> </select></div>
        <div><input  type="radio" name="distancetype" value="miles" checked="checked">Miles &nbsp;&nbsp; <input  type="radio" name="distancetype" value="km">KM </div>
        
        
    </div>
    <div style="height:15px;">&nbsp;</div>
    <div>
    
    <input type="button" value="APPLY" class="button3" onclick="updatemap()" />
    </div>

</div>
<div id="floating-panel">



<div style="width:100%; background:#b3d1ff; height:auto; text-align:left;border-bottom:2px solid #c8cfd9; padding:4px;">We found <?=$num;?> fahair Stores near</div>
<ul class="nav" id="stores">
<? $i=0;
 while($datarow=mysql_fetch_array($dataquery)){ 
 $distance=round($datarow['distance'],2);
 ?>
  <li><!-- <a href="javascript:triggerClick(<?=$i?>)"> -->
  <a href="/store_front.php?id=<?=$datarow[id]?>">
  <div style="width:100%; height:"> 
     <div style="float:left;"><?=$i+1;?>.&nbsp;&nbsp;&nbsp;<b><?=$datarow['s_name']?></b> </div> <div style="text-align:right;"><?=$distance;?>mi </div>
     <div style="clear:both; text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$datarow['s_location']?></div>
   </div></a>
  </li>
  <? $i++; } ?>
</ul>
</div>
<div class="container2">
  <div id="map" class="archive-map"></div>
</div>
<? }else{ ?>
<div align="center"><font size="+2"> <?=$Error?></font> </div>
<? } ?>
<div><? if($overlimit){ ?> <font size="+1">Your have crosss the google api map limit </font>   <? } ?></div>
<div  onclick="triggerClick(0)" id="dhi">&nbsp; </div>
<div class="col-lg-12" style="margin:0px; padding:0px" >
<?php include'foot-new.php'?>
</div>

<div id="overlay-mask-8" class="overlay-mask" style="" onKeyPress="test(event)">
  

  <div class="overlay iframe-content"><a class="close close-icon" onClick="close_popup('overlay-mask-8')">
  <span id="close_button" style="position: absolute; text-align: center; width: 100%;">X</span></a>
    <div class="content"> 
    <div class="row">
  
   
    
      <div class="col-lg-12 col-xs-12 col-xs-12">
       
        
    <div class="full" style="background:#FBFBFB; border:1px solid #E5E5E5; padding:5%;">
     <div class="full"><img class="img-responsive" src="images/logo_1.png"></div>
  
   
     <h3 class="h3">Member Login</h3><hr>
     <div class="full" style="color:#999999; margin-top:1em;">
     <div id="berror" style="color:#FF0000" ></div>
  
   <div id="uerror" style="color:#FF0000" ></div>
   <div class="form-group"><input type="email" placeholder="email" id="email_login" name="email_login" class="form-control"></div>
   
   
   <div id="perror" style="color:#FF0000" ></div>
   <div class="form-group"><input type="password" placeholder="password" name="pwd_login" id="pwd_login" class="form-control"></div>
   
   
   <div class="" style="margin-top:2em;">
   <button type="button"   class="blue-btn glyphicon glyphicon-lock" onClick="check()" style="background:#268BB9; color:#FFF; width: 85%;">
  <span class="" style="font-family:sans-serif;" >SIGN IN</span>
  </button>
  <br>
   <span style="text-decoration:underline;"> <a href ="forget_password.php">Forgot Your Password ?</a></span><br>
   
  
   <br>
    <button type="submit" class="blue-btn glyphicon glyphicon-lock" style="background:#268BB9; color:#FFF; width: 85%;">
  <span class="" style="font-family:sans-serif;">Cancel</span>
  </button>
   </div>
     </div>
     </div> 
     
      </div>
    </div>
   <div style="border:0px solid #97cf00; padding:1em;" class="content"> 
    <div style="width:98%; padding:0;;" class="row">
    <div class="col-lg-12 col-xs-12 col-xs-12 text-center">
      <strong> <a href="/supplier/register_member.php" target="_blank">NEW MEMBER REGISTER</a></strong>
      </div>
      </div>
      </div>
     
    </div>
    </div>
  
    
    </div>


</body>
</html>
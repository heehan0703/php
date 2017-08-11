<?php
session_start();
require_once('wp-admin/include/connectdb.php');
$arr1 = array();
$i=0;
//echo $_SESSION['my_shop'];
if($_SESSION['my_shop']){
$mystoreid=$_SESSION['my_shop'];
$mystoreinfo=mysql_fetch_array(mysql_query("select * FROM store where id='$mystoreid'"));
$arr1[$i]=  array('id'=>$mystoreid,'distance'=>10000,'s_city'=>$mystoreinfo['s_city'],'s_state'=>$mystoreinfo['s_state'],'zip'=>$mystoreinfo['zip'],'s_name'=>$mystoreinfo['s_name'],'s_location'=>$mystoreinfo['s_location'],'s_phone'=>$mystoreinfo['s_phone']);
$i++;
}
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
$ip=get_client_ip();
//echo $ip;
//$ip = "70.134.212.32";
$service_url = 'https://api.ip2location.com/?ip='.$ip.'&key=11952EB359&package=WS5';
 
//Setting up connection using the service url
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $service_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
 
$temp = $result;
$result_split = explode(";", $temp);
//Retrieving latitude and longitude information from the result returned by the API
$latitude = $_SESSION['latitude'];
$longitude = $_SESSION['longitude'];
//$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
//print_r($details);
//$cordinates=$details->loc;
//$cordinates = explode(",", $cordinates);
 //$latitude=$cordinates[0];
// $longitude=$cordinates[1];
 
//  $latitude=32.715328216553;
// $longitude=-117.15725708008;

if(!$latitude and !$longitude){
  if($_SESSION['member_id']){
  
    $memid=$_SESSION['member_id'];
    $userrow =mysql_fetch_array(mysql_query("SELECT * FROM `member` where member_id=$memid"));
	$zipcode=$userrow['zipcode'];
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
	}
}

 
if($_SESSION['my_shop']){
$query="SELECT id,s_name,s_location,s_phone,s_city,zip,s_state,lat,lng, ( 3959 * acos( cos( radians($latitude) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( lat ) ) ) ) AS distance FROM store  where id <> $mystoreid ORDER BY distance";
}else{
 $query="SELECT id,s_name,s_location,s_phone,s_city,zip,s_state,lat,lng, ( 3959 * acos( cos( radians($latitude) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( lat ) ) ) ) AS distance FROM store  ORDER BY distance";
 }
//echo "$query";

$store=mysql_query($query);

 while($rows = mysql_fetch_array($store)) {
//$addressFrom = $rows['s_city'];

//$addressTo = $details->city; 


// $distance = getDistance($addressFrom, $addressTo, "K");
// echo $distance;
 
//$array = array($distance);

//print_r($array); 
$storeid = $rows['id'];
$s_city=$rows['s_city'];
$s_state=$rows['s_state'];
$zip=$rows['zip'];
$s_name=$rows['s_name'];
$s_location=$rows['s_location'];
$s_phone=$rows['s_phone'];


$arr1[$i]=  array('id'=>$storeid,'distance'=>$distance,'s_city'=>$s_city,'s_state'=>$s_state,'zip'=>$zip,'s_name'=>$s_name,'s_location'=>$s_location,'s_phone'=>$s_phone);



$i++;

}



$distance = array();

foreach($arr1 as $arr) {

    $distance[] = $arr['distance'];
	
}

//array_multisort($distance, SORT_ASC, $arr1, SORT_NUMERIC);
//print_r($arr1);



$numberofstore= sizeof($arr1);

//echo $numberofstore;
$j=0;
$p=0;
$q=0;
$r=0;
$s=0;
$t=0;

$ids=$arr1[$i]['id'];
for ($x = 0; $x < $numberofstore; $x++) {
$city[$j]=$arr1[$x]['s_city'];
$name[$p]=$arr1[$x]['s_name'];
$state[$q]=$arr1[$x]['s_state'];
$location[$r]=$arr1[$x]['s_location'];
$phone[$s]=$arr1[$x]['s_phone'];
$idss[$t]=$arr1[$x]['id'];
$idss1=$arr1[$x]['id'];
//echo "$idss1";
 ++$j; 
  ++$p; 
   ++$q;
     ++$r; 
	  ++$s;  
	  ++$t; 
	  
	   
	      //echo "The number is: $x <br>";
}
//print_r($id);

?>

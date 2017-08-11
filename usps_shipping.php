<?php
function USPSParcelRate_local($weight,$ounces,$dest_zip) {

// This script was written by Mark Sanborn at http://www.marksanborn.net  
// If this script benefits you are your business please consider a donation  
// You can donate at http://www.marksanborn.net/donate.  

// ========== CHANGE THESE VALUES TO MATCH YOUR OWN ===========

$userName = '962RANAT5370'; // Your USPS Username
$orig_zip = '60007'; // Zipcode you are shipping FROM

// =============== DON'T CHANGE BELOW THIS LINE ===============

$url = "http://Production.ShippingAPIs.com/ShippingAPI.dll";


$ch = curl_init();

// set the target url
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

// parameters to post
curl_setopt($ch, CURLOPT_POST, 1);

$data ="API=RateV4&XML= 
<RateV4Request USERID=\"$userName\">
<Package ID=\"1ST\">
<Service>ALL</Service> <ZipOrigination>$orig_zip</ZipOrigination> <ZipDestination>$dest_zip</ZipDestination> <Pounds>$weight</Pounds> 
<Ounces>$ounces</Ounces> <Container>Variable</Container> <Size>Regular</Size> 
<Width></Width> 
<Length></Length> 
<Height></Height> 
<Girth></Girth> 
<Machinable>true</Machinable> 
<ReturnLocations>FALSE</ReturnLocations> 
</Package> 
</RateV4Request>";

//$data = "API=RateV4&XML=<RateV4Request USERID=\"$userName\"><Package ID=\"1ST\"><Service>ALL</Service><ZipOrigination>$orig_zip</ZipOrigination><ZipDestination>$dest_zip</ZipDestination><Pounds>$weight</Pounds><Ounces>$ounces</Ounces><Size>REGULAR</Size><Machinable>TRUE</Machinable></Package></RateV4Request>";

// send the POST values to USPS
curl_setopt($ch, CURLOPT_POSTFIELDS,$data);

$result=curl_exec ($ch);
$data = strstr($result, '<?');
// echo '<!-- '. $data. ' -->'; // Uncomment to show XML in comments
$xml_parser = xml_parser_create();
xml_parse_into_struct($xml_parser, $data, $vals, $index);
xml_parser_free($xml_parser);
$params = array();
$level = array();
foreach ($vals as $xml_elem) {
    if ($xml_elem['type'] == 'open') {
        if (array_key_exists('attributes',$xml_elem)) {
            list($level[$xml_elem['level']],$extra) = array_values($xml_elem['attributes']);
        } else {
        $level[$xml_elem['level']] = $xml_elem['tag'];
        }
    }
    if ($xml_elem['type'] == 'complete') {
    $start_level = 1;
    $php_stmt = '$params';
    while($start_level < $xml_elem['level']) {
        $php_stmt .= '[$level['.$start_level.']]';
        $start_level++;
    }
    $php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';
    eval($php_stmt);
    }
}
curl_close($ch);
 //echo '<pre>'; print_r($params); echo'</pre>'; // Uncomment to see xml tags
 
 //echo'<pre>'; print_r($params['RATEV3RESPONSE']['1ST']['17']['RATE']); echo'</pre>';
return $params['RATEV4RESPONSE']['1ST']['3']['RATE'];
}

//echo USPSParcelRate_local(0,40,10128);


function USPSParcelRate_local_All($weight,$ounces,$dest_zip) {

// This script was written by Mark Sanborn at http://www.marksanborn.net  
// If this script benefits you are your business please consider a donation  
// You can donate at http://www.marksanborn.net/donate.  

// ========== CHANGE THESE VALUES TO MATCH YOUR OWN ===========

$userName = '962RANAT5370'; // Your USPS Username
$orig_zip = '60007'; // Zipcode you are shipping FROM

// =============== DON'T CHANGE BELOW THIS LINE ===============

$url = "https://Production.ShippingAPIs.com/ShippingAPI.dll";


$ch = curl_init();

// set the target url
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

// parameters to post
curl_setopt($ch, CURLOPT_POST, 1);

$data ="API=RateV4&XML= 
<RateV4Request USERID=\"$userName\">
<Package ID=\"1ST\">
<Service>ALL</Service> <ZipOrigination>$orig_zip</ZipOrigination> <ZipDestination>$dest_zip</ZipDestination> <Pounds>$weight</Pounds> 
<Ounces>$ounces</Ounces> <Container>Variable</Container> <Size>Regular</Size> 
<Width></Width> 
<Length></Length> 
<Height></Height> 
<Girth></Girth> 
<Machinable>true</Machinable> 
<ReturnLocations>FALSE</ReturnLocations> 
</Package> 
</RateV4Request>";




//$data = "API=RateV4&XML=<RateV4Request USERID=\"$userName\"><Package ID=\"1ST\"><Service>ALL</Service><ZipOrigination>$orig_zip</ZipOrigination><ZipDestination>$dest_zip</ZipDestination><Pounds>$weight</Pounds><Ounces>$ounces</Ounces><Size>REGULAR</Size><Machinable>TRUE</Machinable></Package></RateV4Request>";

// send the POST values to USPS
curl_setopt($ch, CURLOPT_POSTFIELDS,$data);

$result=curl_exec ($ch);
$data = strstr($result, '<?');
// echo '<!-- '. $data. ' -->'; // Uncomment to show XML in comments
$xml_parser = xml_parser_create();
xml_parse_into_struct($xml_parser, $data, $vals, $index);
xml_parser_free($xml_parser);
$params = array();
$level = array();
foreach ($vals as $xml_elem) {
    if ($xml_elem['type'] == 'open') {
        if (array_key_exists('attributes',$xml_elem)) {
            list($level[$xml_elem['level']],$extra) = array_values($xml_elem['attributes']);
        } else {
        $level[$xml_elem['level']] = $xml_elem['tag'];
        }
    }
    if ($xml_elem['type'] == 'complete') {
    $start_level = 1;
    $php_stmt = '$params';
    while($start_level < $xml_elem['level']) {
        $php_stmt .= '[$level['.$start_level.']]';
        $start_level++;
    }
    $php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';
    eval($php_stmt);
    }
}
curl_close($ch);
 //echo '<pre>'; print_r($params); echo'</pre>'; // Uncomment to see xml tags
 
 //echo'<pre>'; print_r($params['RATEV3RESPONSE']['1ST']['17']['RATE']); echo'</pre>';
return $params['RATEV4RESPONSE']['1ST'];
}





function USPSParcelRate_service_post($weight,$ounces,$dest_zip) {

// This script was written by Mark Sanborn at http://www.marksanborn.net  
// If this script benefits you are your business please consider a donation  
// You can donate at http://www.marksanborn.net/donate.  

// ========== CHANGE THESE VALUES TO MATCH YOUR OWN ===========

$userName = '962RANAT5370'; // Your USPS Username
$orig_zip = '60007'; // Zipcode you are shipping FROM

// =============== DON'T CHANGE BELOW THIS LINE ===============

$url = "http://Production.ShippingAPIs.com/ShippingAPI.dll";


$ch = curl_init();

// set the target url
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

// parameters to post
curl_setopt($ch, CURLOPT_POST, 1);

$data ="API=RateV4&XML= 
<RateV4Request USERID=\"$userName\">
<Revision>2</Revision>
<Package ID=\"1ST\">
<Service>Standard Post</Service> <ZipOrigination>$orig_zip</ZipOrigination> <ZipDestination>$dest_zip</ZipDestination> <Pounds>$weight</Pounds> 
<Ounces>$ounces</Ounces> <Container>Variable</Container> <Size>Regular</Size> 
<Width>10</Width> 
<Length>10</Length> 
<Height>10</Height> 
<Girth>10</Girth> 
<GroundOnly>TRUE</GroundOnly>
<Machinable>true</Machinable> 
<ReturnLocations>FALSE</ReturnLocations> 
</Package> 
</RateV4Request>";




//$data = "API=RateV4&XML=<RateV4Request USERID=\"$userName\"><Package ID=\"1ST\"><Service>ALL</Service><ZipOrigination>$orig_zip</ZipOrigination><ZipDestination>$dest_zip</ZipDestination><Pounds>$weight</Pounds><Ounces>$ounces</Ounces><Size>REGULAR</Size><Machinable>TRUE</Machinable></Package></RateV4Request>";

// send the POST values to USPS
curl_setopt($ch, CURLOPT_POSTFIELDS,$data);

$result=curl_exec ($ch);
$data = strstr($result, '<?');
// echo '<!-- '. $data. ' -->'; // Uncomment to show XML in comments
$xml_parser = xml_parser_create();
xml_parse_into_struct($xml_parser, $data, $vals, $index);
xml_parser_free($xml_parser);
$params = array();
$level = array();
foreach ($vals as $xml_elem) {
    if ($xml_elem['type'] == 'open') {
        if (array_key_exists('attributes',$xml_elem)) {
            list($level[$xml_elem['level']],$extra) = array_values($xml_elem['attributes']);
        } else {
        $level[$xml_elem['level']] = $xml_elem['tag'];
        }
    }
    if ($xml_elem['type'] == 'complete') {
    $start_level = 1;
    $php_stmt = '$params';
    while($start_level < $xml_elem['level']) {
        $php_stmt .= '[$level['.$start_level.']]';
        $start_level++;
    }
    $php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';
    eval($php_stmt);
    }
}
curl_close($ch);
 //echo '<pre>'; print_r($params); echo'</pre>'; // Uncomment to see xml tags
 
 //echo'<pre>'; print_r($params['RATEV3RESPONSE']['1ST']['17']['RATE']); echo'</pre>';
return $params['RATEV4RESPONSE']['1ST']['4']['RATE'];
}

function USPSParcelRate_international($weight,$ounces,$dest_country) {

// This script was written by Mark Sanborn at http://www.marksanborn.net  
// If this script benefits you are your business please consider a donation  
// You can donate at http://www.marksanborn.net/donate.  

// ========== CHANGE THESE VALUES TO MATCH YOUR OWN ===========

$userName = '962RANAT5370'; // Your USPS Username
$orig_zip = '60007'; // Zipcode you are shipping FROM

// =============== DON'T CHANGE BELOW THIS LINE ===============

$url = "http://Production.ShippingAPIs.com/ShippingAPI.dll";


$ch = curl_init();

// set the target url
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

// parameters to post
curl_setopt($ch, CURLOPT_POST, 1);

$data="API=IntlRateV2&XML=<IntlRateV2Request USERID=\"$userName\"><Package ID='1ST'><Pounds>$weight</Pounds><Ounces>$ounces</Ounces><Machinable>True</Machinable><MailType>Package</MailType><GXG><POBoxFlag>Y</POBoxFlag><GiftFlag>Y</GiftFlag></GXG><ValueOfContents></ValueOfContents><Country>$dest_country</Country><Container>RECTANGULAR</Container><Size>REGULAR</Size><Width></Width><Length></Length><Height></Height><Girth>0</Girth><CommercialFlag>N</CommercialFlag></Package></IntlRateV2Request>";



// send the POST values to USPS
curl_setopt($ch, CURLOPT_POSTFIELDS,$data);

$result=curl_exec ($ch);
$data = strstr($result, '<?');
// echo '<!-- '. $data. ' -->'; // Uncomment to show XML in comments
$xml_parser = xml_parser_create();
xml_parse_into_struct($xml_parser, $data, $vals, $index);
xml_parser_free($xml_parser);
$params = array();
$level = array();
foreach ($vals as $xml_elem) {
    if ($xml_elem['type'] == 'open') {
        if (array_key_exists('attributes',$xml_elem)) {
            list($level[$xml_elem['level']],$extra) = array_values($xml_elem['attributes']);
        } else {
        $level[$xml_elem['level']] = $xml_elem['tag'];
        }
    }
    if ($xml_elem['type'] == 'complete') {
    $start_level = 1;
    $php_stmt = '$params';
    while($start_level < $xml_elem['level']) {
        $php_stmt .= '[$level['.$start_level.']]';
        $start_level++;
    }
    $php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';
    eval($php_stmt);
    }
}
curl_close($ch);
 //echo '<pre>'; print_r($params); echo'</pre>'; // Uncomment to see xml tags
 
 //echo'<pre>'; print_r($params['INTLRATEV2RESPONSE']['1ST']['9']['POSTAGE']); echo'</pre>';
return $params['INTLRATEV2RESPONSE']['1ST']['9']['POSTAGE'];
}


function USPSParcelRate_international_All($weight,$ounces,$dest_country) {

// This script was written by Mark Sanborn at http://www.marksanborn.net  
// If this script benefits you are your business please consider a donation  
// You can donate at http://www.marksanborn.net/donate.  

// ========== CHANGE THESE VALUES TO MATCH YOUR OWN ===========

$userName = '962RANAT5370'; // Your USPS Username
$orig_zip = '60007'; // Zipcode you are shipping FROM

// =============== DON'T CHANGE BELOW THIS LINE ===============

$url = "https://Production.ShippingAPIs.com/ShippingAPI.dll";


$ch = curl_init();

// set the target url
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

// parameters to post
curl_setopt($ch, CURLOPT_POST, 1);

$data="API=IntlRateV2&XML=<IntlRateV2Request USERID=\"$userName\"><Package ID='1ST'><Pounds>$weight</Pounds><Ounces>$ounces</Ounces><Machinable>True</Machinable><MailType>Package</MailType><GXG><POBoxFlag>Y</POBoxFlag><GiftFlag>Y</GiftFlag></GXG><ValueOfContents></ValueOfContents><Country>$dest_country</Country><Container>RECTANGULAR</Container><Size>REGULAR</Size><Width></Width><Length></Length><Height></Height><Girth>0</Girth><CommercialFlag>N</CommercialFlag></Package></IntlRateV2Request>";



// send the POST values to USPS
curl_setopt($ch, CURLOPT_POSTFIELDS,$data);

$result=curl_exec ($ch);
$data = strstr($result, '<?');
// echo '<!-- '. $data. ' -->'; // Uncomment to show XML in comments
$xml_parser = xml_parser_create();
xml_parse_into_struct($xml_parser, $data, $vals, $index);
xml_parser_free($xml_parser);
$params = array();
$level = array();
foreach ($vals as $xml_elem) {
    if ($xml_elem['type'] == 'open') {
        if (array_key_exists('attributes',$xml_elem)) {
            list($level[$xml_elem['level']],$extra) = array_values($xml_elem['attributes']);
        } else {
        $level[$xml_elem['level']] = $xml_elem['tag'];
        }
    }
    if ($xml_elem['type'] == 'complete') {
    $start_level = 1;
    $php_stmt = '$params';
    while($start_level < $xml_elem['level']) {
        $php_stmt .= '[$level['.$start_level.']]';
        $start_level++;
    }
    $php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';
    eval($php_stmt);
    }
}
curl_close($ch);
 //echo '<pre>'; print_r($params); echo'</pre>'; // Uncomment to see xml tags
 
 //echo'<pre>'; print_r($params['INTLRATEV2RESPONSE']['1ST']['9']['POSTAGE']); echo'</pre>';
return $params['INTLRATEV2RESPONSE']['1ST'];
}



?>
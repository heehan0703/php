<?php

include("ups_rate2.php");

function get_UPS_Price_Ups_three_day($to_postalcode,$to_countrycode,$packageweight){

$cServiceCodes = array('UGN' => "GND", 'U2D' => "2DA", 'U2A' => "2DM", 'U3S' => "3DS", 
'UNS' => "1DP", 'UND' => "1DA", 'UNA' => "1DM", 'UWE' => "UPSWWE", 'UWP' => "UPSWWEXPP",
'UWX' => "UPSWWX", 'UCX' => "UPSSTD", 'UCE' => "UPSSTD", 'UCP' => "UPSSTD", 'UCS' => "UPSSTD");

$upsobj = new UPS();
//  457E36
$upsobj->SetLicenseNumer("3CE8D42B015A4366");    # UPS License Number
$upsobj->SetUserName("Adele Liu");              # UPS Username
$upsobj->SetUserPassword("Beijing2008");          # UPS Password

$upsobj->SetPickUpType("03");                  # Drop Off Location

$upsobj->SetShipToPostalCode($to_postalcode);         # Origin Postal Code
$upsobj->SetShipToCountryCode($to_countrycode);           # Origin Country

$upsobj->SetShipFromPostalCode("60007");       # Destination Postal Code
$upsobj->SetShipFromCountryCode("US");         # Destination Country

$upsobj ->SetResidentialIndicator("RES");      # Residence Shipping and for commercial shipping "COM"

//$upsobj->SetServiceCode($cServiceCodes["UGN"]); # Sipping rate for UPS Ground 

$upsobj->SetServiceCode($cServiceCodes["U3S"]);

$upsobj->SetPackagingType("02");
$upsobj->SetPackageDimensionUOM("IN");         # Dimension in Inches

$upsobj->SetPackageLength(10);                  # Package Length
$upsobj->SetPackageWidth(10);                   # Package Width
$upsobj->SetPackageHeight(10);                  # Package Height

$upsobj->SetPackageWeightUOM("LBS");            # Weight in Pounds
$upsobj->SetPackageWeight($packageweight);                  # Package Weight

//print_r($upsobj);

$rate = $upsobj->GetRate();


//echo $rate;
return $rate;

}


function get_UPS_Price_Ups_GND($to_postalcode,$to_countrycode,$packageweight){

$cServiceCodes = array('UGN' => "GND", 'U2D' => "2DA", 'U2A' => "2DM", 'U3S' => "3DS", 
'UNS' => "1DP", 'UND' => "1DA", 'UNA' => "1DM", 'UWE' => "UPSWWE", 'UWP' => "UPSWWEXPP",
'UWX' => "UPSWWX", 'UCX' => "UPSSTD", 'UCE' => "UPSSTD", 'UCP' => "UPSSTD", 'UCS' => "UPSSTD");

$upsobj = new UPS();
//  457E36
$upsobj->SetLicenseNumer("3CE8D42B015A4366");    # UPS License Number
$upsobj->SetUserName("Adele Liu");              # UPS Username
$upsobj->SetUserPassword("Beijing2008");          # UPS Password

$upsobj->SetPickUpType("03");                  # Drop Off Location

$upsobj->SetShipToPostalCode($to_postalcode);         # Origin Postal Code
$upsobj->SetShipToCountryCode($to_countrycode);           # Origin Country

$upsobj->SetShipFromPostalCode("60007");       # Destination Postal Code
$upsobj->SetShipFromCountryCode("US");         # Destination Country

$upsobj ->SetResidentialIndicator("RES");      # Residence Shipping and for commercial shipping "COM"

//$upsobj->SetServiceCode($cServiceCodes["UGN"]); # Sipping rate for UPS Ground 

$upsobj->SetServiceCode($cServiceCodes["UGN"]);

$upsobj->SetPackagingType("02");
$upsobj->SetPackageDimensionUOM("IN");         # Dimension in Inches

$upsobj->SetPackageLength(10);                  # Package Length
$upsobj->SetPackageWidth(10);                   # Package Width
$upsobj->SetPackageHeight(10);                  # Package Height

$upsobj->SetPackageWeightUOM("LBS");            # Weight in Pounds
$upsobj->SetPackageWeight($packageweight);                  # Package Weight

//print_r($upsobj);

$rate = $upsobj->GetRate();


//echo $rate;
return $rate;

}


function get_UPS_Price_Ups_2da($to_postalcode,$to_countrycode,$packageweight){

$cServiceCodes = array('UGN' => "GND", 'U2D' => "2DA", 'U2A' => "2DM", 'U3S' => "3DS", 
'UNS' => "1DP", 'UND' => "1DA", 'UNA' => "1DM", 'UWE' => "UPSWWE", 'UWP' => "UPSWWEXPP",
'UWX' => "UPSWWX", 'UCX' => "UPSSTD", 'UCE' => "UPSSTD", 'UCP' => "UPSSTD", 'UCS' => "UPSSTD");

$upsobj = new UPS();
//  457E36
$upsobj->SetLicenseNumer("3CE8D42B015A4366");    # UPS License Number
$upsobj->SetUserName("Adele Liu");              # UPS Username
$upsobj->SetUserPassword("Beijing2008");          # UPS Password

$upsobj->SetPickUpType("03");                  # Drop Off Location

$upsobj->SetShipToPostalCode($to_postalcode);         # Origin Postal Code
$upsobj->SetShipToCountryCode($to_countrycode);           # Origin Country

$upsobj->SetShipFromPostalCode("60007");       # Destination Postal Code
$upsobj->SetShipFromCountryCode("US");         # Destination Country

$upsobj ->SetResidentialIndicator("RES");      # Residence Shipping and for commercial shipping "COM"

//$upsobj->SetServiceCode($cServiceCodes["UGN"]); # Sipping rate for UPS Ground 

$upsobj->SetServiceCode($cServiceCodes["U2D"]);

$upsobj->SetPackagingType("02");
$upsobj->SetPackageDimensionUOM("IN");         # Dimension in Inches

$upsobj->SetPackageLength(10);                  # Package Length
$upsobj->SetPackageWidth(10);                   # Package Width
$upsobj->SetPackageHeight(10);                  # Package Height

$upsobj->SetPackageWeightUOM("LBS");            # Weight in Pounds
$upsobj->SetPackageWeight($packageweight);                  # Package Weight

//print_r($upsobj);

$rate = $upsobj->GetRate();


//echo $rate;
return $rate;

}

function get_UPS_Price_Ups_es($to_postalcode,$to_countrycode,$packageweight){

$cServiceCodes = array('UGN' => "GND", 'U2D' => "2DA", 'U2A' => "2DM", 'U3S' => "3DS", 
'UNS' => "1DP", 'UND' => "1DA", 'UNA' => "1DM", 'UWE' => "UPSWWE", 'UWP' => "UPSWWEXPP",
'UWX' => "UPSWWX", 'UCX' => "UPSSTD", 'UCE' => "UPSSTD", 'UCP' => "UPSSTD", 'UCS' => "UPSSTD");

$upsobj = new UPS();
//  457E36
$upsobj->SetLicenseNumer("3CE8D42B015A4366");    # UPS License Number
$upsobj->SetUserName("Adele Liu");              # UPS Username
$upsobj->SetUserPassword("Beijing2008");          # UPS Password

$upsobj->SetPickUpType("03");                  # Drop Off Location

$upsobj->SetShipToPostalCode($to_postalcode);         # Origin Postal Code
$upsobj->SetShipToCountryCode($to_countrycode);           # Origin Country

$upsobj->SetShipFromPostalCode("60007");       # Destination Postal Code
$upsobj->SetShipFromCountryCode("US");         # Destination Country

$upsobj ->SetResidentialIndicator("RES");      # Residence Shipping and for commercial shipping "COM"

//$upsobj->SetServiceCode($cServiceCodes["UGN"]); # Sipping rate for UPS Ground 

$upsobj->SetServiceCode($cServiceCodes["UWP"]);

$upsobj->SetPackagingType("02");
$upsobj->SetPackageDimensionUOM("IN");         # Dimension in Inches

$upsobj->SetPackageLength(10);                  # Package Length
$upsobj->SetPackageWidth(10);                   # Package Width
$upsobj->SetPackageHeight(10);                  # Package Height

$upsobj->SetPackageWeightUOM("LBS");            # Weight in Pounds
$upsobj->SetPackageWeight($packageweight);                  # Package Weight

//print_r($upsobj);

$rate = $upsobj->GetRate();


//echo $rate;
return $rate;

}



?>
 
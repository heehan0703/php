<?php
session_start();
// Include config file
require("../wp-admin/include/connectdb.php");
require_once('../include/config.php');

$GOOD_SHOP_USERID=$_SESSION['GOOD_SHOP_USERID'];
$GOOD_SHOP_PART = $_SESSION['GOOD_SHOP_PART'];
 
function NVPToArray($NVPString)
{
	$proArray = array();
	while(strlen($NVPString))
	{
		// name
		$keypos= strpos($NVPString,'=');
		$keyval = substr($NVPString,0,$keypos);
		// value
		$valuepos = strpos($NVPString,'&') ? strpos($NVPString,'&'): strlen($NVPString);
		$valval = substr($NVPString,$keypos+1,$valuepos-$keypos-1);
		// decoding the respose
		$proArray[$keyval] = urldecode($valval);
		$NVPString = substr($NVPString,$valuepos+1,strlen($NVPString));
	}
	return $proArray;
}
function card_number($card_number){
$cc = $card_number;
$cclength = strlen($cc);
$ccposshow = $cclength - 4;
$ccdisp = substr($cc, $ccposshow);
for ( $counter = 1; $counter <= $ccposshow; $counter += 1){
$ccdisp = "x" . $ccdisp;
}
return $ccdisp;
}

if(isset($_POST['x_amount'])){

//$user_id=$_SESSION['user_id'];
$f_name=$_POST['x_first_name'];
$l_name=$_POST['x_last_name'];
//$card_type=$_POST['creditCardType'];
$card_type='Visa';
$card_number=$_POST['x_card_num'];
$cv2=$_POST['x_card_code'];
$email=$_POST['x_email'];
$country=$_POST['x_ship_to_country'];
$state=$_POST['x_ship_to_state'];
$street=$_POST['x_ship_to_address'];
$city=$_POST['x_ship_to_city'];
$zip=$_POST['x_ship_to_zip'];
$ip_address=$_POST['x_customer_ip']; //$ip_address=$_SERVER['REMOTE_ADDR'];
$expDateMonth=$_POST['x_month_date'];
$expDateYear=$_POST['x_year_date'];
$PaymAmount=$_POST['x_amount'];
$tradecode=$_POST['x_description'];
$card_type=$_POST['x_card_type'];



//$ListingId=$_POST['ListingId'];
$EXPDATE=$expDateMonth.$expDateYear;
// Store request params in an array



$request_params = array
					(
					'METHOD' => 'DoDirectPayment', 
					'USER' => $api_username, 
					'PWD' => $api_password, 
					'SIGNATURE' => $api_signature, 
					'VERSION' => $api_version, 
					'PAYMENTACTION' => 'Sale', 					
					'IPADDRESS' => $ip_address,
					'CREDITCARDTYPE' => $card_type, 
					'ACCT' =>$card_number, 						
					'EXPDATE' => $EXPDATE, 			
					'CVV2' => $cv2, 
					'FIRSTNAME' => $f_name, 
					'LASTNAME' => $l_name,
					'EMAIL' => $email,
					'STREET' => $street, 
					'CITY' => $city, 
					'STATE' => $state, 					
					'COUNTRYCODE' => $country, 
					'ZIP' => $zip, 
					'AMT' => $PaymAmount, 
					'CURRENCYCODE' => 'USD', 
					'DESC' => $tradecode,
					'SHIPTONAME'=>$f_name,
					'SHIPTOSTREET'=>$street,
					'SHIPTOSTREET2'=>'',
					'SHIPTOCITY'=>$city,
					'SHIPTOSTATE'=>$state,
					'SHIPTOZIP'=>$zip,
					'SHIPTOCOUNTRY'=>$country,
					'SHIPTOPHONENUM'=>''
					);
					
// Loop through $request_params array to generate the NVP string.
$nvp_string = '';
foreach($request_params as $var=>$val)
{
	$nvp_string .= '&'.$var.'='.urlencode($val);	
}

// Send NVP string to PayPal and store response
$curl = curl_init();
		curl_setopt($curl, CURLOPT_VERBOSE, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_URL, $api_endpoint);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string);

$result = curl_exec($curl);
curl_close($curl);
// Parse the API response
$result_array = NVPToArray($result);
//print_r($result_array);

$status=$result_array['ACK'];

//var_dump($status);
        if($status=='Success' || $status=='SuccessWithWarning')
          {
		  $TRANSACTIONID=$result_array['TRANSACTIONID'];
		  
	      $card_n=card_number($card_number);
		  
	      $sql=mysql_query("update `trade` set transaction_id ='$TRANSACTIONID',paymethod='Credit' where tradecode ='$tradecode'");
		  
		  header("location: https://ebhahair.com/order_ok.php?tradecode=$tradecode&p=card");
		 }
		 else
		 {
			 ?>
			<script type="text/javascript">
          	 alert("Your Information is incorrect");
			 window.location = "https://ebhahair.com/isr/cart.php"
	         </script>		

			<?
			//header("location: http://fahair.com/card.php"); 
		 }
		 
	
	?>

<?
}else{
	header("location: https://ebhahair.com/login_index.php");
	}

?>	
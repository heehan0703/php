<?php
// Set sandbox (test mode) to true/false.
$sandbox = FALSE;
//$sandbox = true;
// Set PayPal API version and credentials.
$api_version = '85.0';
$api_endpoint = $sandbox ? 'https://api-3t.sandbox.paypal.com/nvp' : 'https://api-3t.paypal.com/nvp';
$api_username = $sandbox ? 'testdhirendra_api1.yahoo.com' : 'pay_api1.fahair.com';
$api_password = $sandbox ? 'Q7P2RFY9R2RVKP95' : 'PN3D2MBUUVA665Q6';
$api_signature = $sandbox ? 'An5ns1Kso7MWUdW4ErQKJJJ4qi4-AIPj-D73BcdgyITksOilHD2keYI2' : 'AWygsXvCA7jJnjnssMcv3c75gZYNAxVIPYVkI3l2lFV8DLy696GWpSVF';

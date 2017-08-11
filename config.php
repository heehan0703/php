<?php
// Set sandbox (test mode) to true/false.
$sandbox = FALSE;

// Set PayPal API version and credentials.
$api_version = '85.0';
$api_endpoint = $sandbox ? 'https://api-3t.sandbox.paypal.com/nvp' : 'https://api-3t.paypal.com/nvp';
$api_username = $sandbox ? 'baislavimal_api1.gmail.com' : 'pay_api1.fahair.com';
$api_password = $sandbox ? '1367647630' : 'PN3D2MBUUVA665Q6';
$api_signature = $sandbox ? 'AFcWxV21C7fd0v3bYYYRCpSSRl31APVhmvO4C1Qf3wF7MKBJrOA5UCuF' : 'AWygsXvCA7jJnjnssMcv3c75gZYNAxVIPYVkI3l2lFV8DLy696GWpSVF';

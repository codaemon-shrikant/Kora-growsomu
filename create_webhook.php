<?php
$ch = curl_init($BASE_URL+'webhooks');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: application/json"));

$auth = $GROWSUMO_PUBLIC_KEY+':'+$GROWSUMO_PRIVATE_KEY;

$data = [
   'event': 'customer_created',
   'target_url': $ADMIN_BASE_URL+'/posts',
];

curl_setopt($ch, CURLOPT_USERPWD, $auth);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

$response = curl_exec($ch);

curl_close($ch);

if($response === false || $response['http_code'] != 200) {
	if (curl_error($ch)) {
  	$response .= "\n  ". curl_error($ch); 
  } 
}

echo($response);

?>

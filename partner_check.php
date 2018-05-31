<?php
include('config.php');

print_r($_POST);

//Store data for future reference
storeCustomer();

//getPartners 
$partners = getPartners();

//compare partners with the customer created.
$isPartner = comparePartnerCustomers($partners, $POST)

// if customer is partner create new customer.
if($isPartner)
	createCustomer();


function comparePartnerCustomers($partners, $POST) {
 
}

function storeCustomer() {

}

//need to add flag to check if the partner is in the step 1 and only fetch those partners
function getPartners() {
	$ch = set_curl();

	$response = curl_exec($ch);

	curl_close($ch);

	if($response === false || $response['http_code'] != 200) {
		if (curl_error($ch)) {
	  	$response .= "\n  ". curl_error($ch); 
	  } 
	}

	echo($response);
}


function createCustomer() {

	$ch = set_curl();
	//Need to modify this data according to the requirement
	$data = [
	    'key' => 'cus_a80SV515feLAA',
	  	'partner_key' => 'bertramgilfoyle',
	    'email' => 'johnsmith@gmail.com',
	    'name'   => 'John Smith',
	];

	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

	$response = curl_exec($ch);

	curl_close($ch);

	if($response === false || $response['http_code'] != 200) {
		if (curl_error($ch)) {
	  	$response .= "\n  ". curl_error($ch); 
	  } 
	}

	echo($response);
}

function set_curl() {
	$ch = curl_init($BASE_URL.'partnerships');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$auth = $GROWSUMO_PUBLIC_KEY.':'.$GROWSUMO_PRIVATE_KEY;

	curl_setopt($ch, CURLOPT_USERPWD, $auth);
	return $ch;
}
?>

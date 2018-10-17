<?php 
include 'MasterClass_ip-to-geolocation.com-v1.0.php';

$APIKey = 'PUT_HERE_YOUR_API_KEY';

//Create the object
$ip2locationapiObject = new ip2locationapi($APIKey, 'json', '1.152.109.38');

//Exemple 1:
//Perform the request and get the JSON result converted into a PHP Array
$ip2locationapiArray = json_decode($ip2locationapiObject->performRequest(), true);
echo '<table>';
foreach($ip2locationapiArray as $k=>$v){
	echo '<tr><td>'.$k.'</td><td>'.$v.'</td></tr>';
}
echo '</table><hr/>';

//Exemple 1:
//Perform the request and get the PHP array from serialized answer
$ip2locationapiObject->setOutputFormat('serializedphp');
$ip2locationapiObject->setLookupIP('47.247.246.47');
$ip2locationapiArray2 = unserialize( $ip2locationapiObject->performRequest() );
echo '<table>';
foreach($ip2locationapiArray as $k=>$v){
	echo '<tr><td>'.$k.'</td><td>'.$v.'</td></tr>';
}
echo '</table>';
?>
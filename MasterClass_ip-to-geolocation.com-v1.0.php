<?php 
/**
 *  Copyright (C) 2018 ip-to-geolocation.com
 *
 *  PHP version 7.2 and <
 *
 *  This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *  You should have received a copy of the GNU General Public License
 *   along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * 
 * @category  API
 * @author    ip2location-api (ip2location.api@gmail.com)
 * @copyright 2018 ip-to-geolocation.com
 * @license   http://www.gnu.org/licenses/gpl-3.0.html  GNU GENERAL PUBLIC LICENSE (GPL V3.0)
 * @version   1.0
 * @link      https://ip-to-geolocation.com/documentation/
 * 
 */
 
/*


	The following piece of code is an exemple of use of the service.

	
	include_once 'MasterClass_ip2location-api.php';
	$obIP2Location = new ip2locationapi('YOUR_API_KEY', '142.21.3.54', 'json');
	echo $obIP2Location->performRequest();
	echo '<br/>';
	echo $obIP2Location->performRequest('5.23.14.155');
	

/**/

class ip2locationapi { 
	
	protected $apiKey = ''; 
    public $lookupIP = '';
    public $outputFormat = 'json';
	public $FormatsAllowed = ['json', 'xml', 'csv', 'serializedphp'];
	/*
		Constructor with optional parameters to set API Key, output format and lookup IP
		You can get an API Key for free on: http://ip-to-geolocation.com/ip-geolocation-api-register-0.html
		The paid plan gives unlimited requests
	*/
	public function __construct($key='', $format='json', $ip='') {
        $this->setAPIKey($key);
        $this->setLookupIP($ip);
		$this->setOutputFormat($format);
    }
	/*
		Method to set an API Key to be used when requests are performed
		Parameter: API Key
		Return null
	*/
	public function setAPIKey($key){
		$this->apiKey = $key;
	}
	/*
		Method to set an IP address to lookup
		Parameter: IP address IPv4 or IPv6 
		return null
	*/
	public function setLookupIP($ip){
		if( !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) &&  !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6 ) ) throw new Exception('The IP address that you are planning to lookup does not appear to be an IP address. Check out IPv4 / IPv6 formats');
		$this->lookupIP = $ip;
	}
	/*
		Method to set an output format to be returned by the request
		Parameter: format type, one from the list 
		return null
	*/
	public function setOutputFormat($format){
		if( !in_array($format, $this->FormatsAllowed) ) throw new Exception('The output format requested ('.$format.') is not included in the formats list supported ('.implode(',', $this->FormatsAllowed).')');
		$this->outputFormat = $format;
	}
	/*
		Method to perform a request
		Parameter: (optional) IP address to lookup
		return: String, the geolocation in the format desired or json by default
		for more details, check out the documentation: https://ip-to-geolocation.com/documentation/
	*/
	public function performRequest($ip=null){
		if( $ip!=null ){
			$this->setLookupIP($ip);
		}
		if( $this->apiKey=="" ) throw new Exception('The API Key has not been set. (Method to use: setAPIKey("123...") )');
		if( $this->lookupIP=="" ) throw new Exception('The IP address to lookup has not been set. (Method to use: setLookupIP("154.21.52.36") )');
		$plainTextOutput = file_get_contents('http://ip-to-geolocation.com/api/'.$this->outputFormat.'/'.$this->lookupIP.'?key='.$this->apiKey);
		return $plainTextOutput;
	}
	
}





	










?>
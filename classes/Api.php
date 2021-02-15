<?php 
namespace SimplyOrg;
	// Class to comunicate with simplyOrg apis
	// having singleton pattern so we can use only one instance throug out execution life cycle
	// Never make instance of this class out side
	// All public methods should be designed to be called statically 
	// Author : Rupesh Patel
	// Date : 27/06/2018
use SimplyOrg\Settings;
use SimplyOrg\Session;
	
Class Api{
	
	static $inst = false;
	public $locale = 'en';
	protected $token = false;
	protected $baseApiUrl = false;
	protected $version = 'v3';
	public $resolve = ['stagingtest.simplyorg.de:443:18.197.149.140'];
	
	public static function inst(){
		if(self::$inst == false){
			self::$inst = new Api();
			self::$inst->locale = 'en';
			// Session::get('lang', Settings::getClientLanguage());
			self::$inst->version = 'v3';
		}
		return self::$inst;
	}
	public static function getCredentials(){
			return [	"email"=>"apiuser@mail.com","password"=>"123456"];
	}
	public function aquireToken(){
		$token = self::post('authenticate',self::getCredentials('api'),false);
		$token = json_decode($token);
		$this->token = $token->token;
		return $token->token;
	}
	//to get the token 
	public function getToken(){
		if($this->token == false){
			// aquire token and set it 
			$this->aquireToken();
		}
		return $this->token;
	}
	
	public static function setLocale($locale){
		self::inst()->locale = $locale;
	}
	
	public function getLocale(){
		return $this->locale;
	}

	public static function setVersion($version){
		self::inst()->version = $version;
	}
	
	public function getVersion(){
		return self::inst()->version;
	}
	
	public function getBaseApiUrl($baseUrl = false ){
		return "https://jatin-admin.test-simplyorg-tenant.de/".$this->getLocale()."/"."api/".$this->getVersion();
		// if($baseUrl == false) {
		// 	return Settings::get('simplyOrgUrl').'/'.$this->getLocale().'/'.$this->getVersion().'/api';
		// } else {
		// 	return Settings::get('simplyOrgUrl').'/'.$this->getLocale().'/'.$baseUrl;
		// }
	}
	
	
	public static function get($endpoint, $params=[] , $token = true,$baseUrl = false){
		if($token == true){
			$token = self::inst()->getToken();
			$params['token'] = $token;
		}
		$paramsStr = http_build_query($params);
		// var_dump($paramsStr);
		$baseUrl = self::inst()->getBaseApiUrl($baseUrl);
		$url = $baseUrl.'/'.$endpoint.'?'.$paramsStr;
		$ch = curl_init();
		// add proxy support
		$api_proxy = null;
		if(!empty($api_proxy)) {
			curl_setopt($ch, CURLOPT_PROXY, $api_proxy);
		}
        curl_setopt($ch, CURLOPT_URL, $url);
		
		// resolve : placed only for ease of testing in development 
		curl_setopt($ch, CURLOPT_RESOLVE, self::inst()->resolve);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// if(Settings::get('ssl_verify_host') == 'no') { // this setting value come from cms backend.. Settings > Extention Configuration > simplyorg_features
		// }
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $response = curl_exec($ch);
		return $response;
	}
	
	public static function post($endpoint,$params = [], $token = true ,$baseUrl = false){
		$dataWithBuildQuery = false;
		$baseUrl = self::inst()->getBaseApiUrl($baseUrl);
		$url = $baseUrl.'/'.$endpoint;
		if($token == true){
			$token = self::inst()->getToken();
			$params['token'] = $token;
			$url = $baseUrl.'/'.$endpoint.'?token='.$token;
		}
		$ch = curl_init();
		// add proxy support
		$api_proxy ='';
		if(!empty($api_proxy)) {
			curl_setopt($ch, CURLOPT_PROXY, $api_proxy);
		}
        curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data"));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,self::curl_postfields_flatten($params));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		// if(Settings::get('ssl_verify_host') == 'no') {
		// }
		$response = curl_exec($ch);
		return $response;
	}

	public static function curl_postfields_flatten($data, $prefix = '') {
	  if (!is_array($data)) {
	    return $data; // in case someone sends an url-encoded string by mistake
	  }

	  $output = array();
	  foreach($data as $key => $value) {
	    $final_key = $prefix ? "{$prefix}[{$key}]" : $key;
	    if (is_array($value)) {
	      // @todo: handle name collision here if needed
	      $output += self::curl_postfields_flatten($value, $final_key);
	    }
	    else {
	      $output[$final_key] = $value;
	    }
	  }
	  return $output;
	}
}

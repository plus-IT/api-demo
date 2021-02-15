<?php
namespace SimplyOrg;
class Api
{

    static $inst = false;
    public $locale = 'en';
    protected $token = false;
    protected $version = 'v3';

    protected $baseApiUrl = "https://jatin-admin.test-simplyorg-tenant.de/";
    protected $apiUserName = 'apiuser@mail.com';
    protected $apiPassword = '123456';
    public static function inst()
    {
        if (self::$inst == false)
        {
            self::$inst = new Api();
            self::$inst->locale = 'en';
            self::$inst->version = 'v3';
        }
        return self::$inst;
    }
    public function getCredentials()
    {
        return ["email" => $this->apiUserName, "password" => $this->apiPassword];
    }
    public function aquireToken()
    {
        $token = self::post('authenticate', self::getCredentials('api') , false);
        $token = json_decode($token);
        $this->token = $token->token;
        return $token->token;
    }
    //to get the token
    public function getToken()
    {
        if ($this->token == false)
        {
            // aquire token and set it
            $this->aquireToken();
        }
        return $this->token;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function getVersion()
    {
        return self::inst()->version;
    }

    public function getBaseApiUrl()
    {
        return $this->baseApiUrl . $this->getLocale() . "/" . "api/" . $this->getVersion();
    }

    public static function get($endpoint, $params = [], $token = true, $baseUrl = false)
    {
        if ($token == true)
        {
            $token = self::inst()->getToken();
            $params['token'] = $token;
        }
        $paramsStr = http_build_query($params);
        // var_dump($paramsStr);
        $baseUrl = self::inst()->getBaseApiUrl($baseUrl);
        $url = $baseUrl . '/' . $endpoint . '?' . $paramsStr;
        $ch = curl_init();
        // add proxy support
        $api_proxy = null;
        if (!empty($api_proxy))
        {
            curl_setopt($ch, CURLOPT_PROXY, $api_proxy);
        }
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);

        $response = curl_exec($ch);
        return $response;
    }

    public static function post($endpoint, $params = [], $token = true, $baseUrl = false)
    {
        $dataWithBuildQuery = false;
        $baseUrl = self::inst()->getBaseApiUrl($baseUrl);
        $url = $baseUrl . '/' . $endpoint;
        if ($token == true)
        {
            $token = self::inst()->getToken();
            $params['token'] = $token;
            $url = $baseUrl . '/' . $endpoint . '?token=' . $token;
        }
        $ch = curl_init();
        // add proxy support
        $api_proxy = '';
        if (!empty($api_proxy))
        {
            curl_setopt($ch, CURLOPT_PROXY, $api_proxy);
        }
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-type: multipart/form-data"
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, self::curl_postfields_flatten($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Expect:'
        ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        $response = curl_exec($ch);
        return $response;
    }

    public static function curl_postfields_flatten($data, $prefix = '')
    {
        if (!is_array($data))
        {
            return $data; // in case someone sends an url-encoded string by mistake
            
        }

        $output = array();
        foreach ($data as $key => $value)
        {
            $final_key = $prefix ? "{$prefix}[{$key}]" : $key;
            if (is_array($value))
            {
                // @todo: handle name collision here if needed
                $output += self::curl_postfields_flatten($value, $final_key);
            }
            else
            {
                $output[$final_key] = $value;
            }
        }
        return $output;
    }
}


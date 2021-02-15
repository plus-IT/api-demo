<?php

use SimplyOrg\Api;

class ajaxHandler{
        public static function handle(){
            $method='get';
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $method='post';
                // The request is using the POST method
            }
            $endPoint=isset($_REQUEST["endpoint"])?$_REQUEST['endpoint']:'';
            return Api::$method($endPoint,$_REQUEST);
        }
}

?>
<?php

use SimplyOrg\Api;

class ajaxHandler{
        public static function handle(){
            $method='get';
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // The request is using the POST method
                $method='post';
            }
            $endPoint=isset($_REQUEST["endpoint"])?$_REQUEST['endpoint']:'';
            return Api::$method($endPoint,$_REQUEST);
        }
}

?>
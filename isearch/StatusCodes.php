<?php


    function errmsg($code){
        $data = null;
        http_response_code($code);
        switch($code){
            case 401:
                $data = array("message"=>"Unauthorized user", "date"=>date_create());
            break;
            case 403:
                $data = array("message"=>"Forbidden Access", "date"=>date_create());
            break;
            case 500:
                $data = array("message"=>"Server not responding", "date"=>date_create());
            break;
            default: break;

        }
        return json_encode($data);
    }



?>
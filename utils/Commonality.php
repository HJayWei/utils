<?php
namespace Utils;

use Exception;

trait Commonality{
    private $path_config = "/var/www/html/config/conf.json";

    private function get_config(){
        $data = file_get_contents($this->path_config);

        return json_decode($data);
    }


    private function get_database_conf(){
        $conf = $this->get_config();

        if(array_key_exists("database", (array) $conf)){
            return $conf->database;
        }else{
            throw new Exception('Have not database setting in configuration file.');
        }
    }

    function response($data, $useEcho=false, $EOL=""){
        if(is_array($data) || is_object($data) || is_bool($data)){
            $data = json_encode($data);
        }

        if($useEcho){
            echo $data.$EOL;
        }else{
            return $data;
        }
    }
}
?>
<?php
namespace Utils;

require_once __DIR__."/Commonality.php";

use PDO;
use Exception;
use Utils\Commonality;

try{
    class PDO_MySQL{
        use Commonality;

        private $pdo;

        function __construct(){
            $conf = $this->get_database_conf();

            if(array_key_exists("mysql", (array) $conf)){
                $mysq_conf = $conf->mysql;

                $this->pdo = new PDO(
                    "mysql: host={$mysq_conf->host}; port={$mysq_conf->port}",
                    $mysq_conf->user,
                    $mysq_conf->pwd,
                    array(PDO::ATTR_PERSISTENT => true)
                );
            }else{
                throw new Exception('Have not mysql setting in configuration file.');
            }
        }

        function query($sql){
            $result = $this->pdo->query($sql);

            if($this->pdo->errorCode() !== "00000"){
                throw new Exception(
                    'MySQL query error, message: '.$this->response($this->pdo->errorInfo()).
                    ' SQL: '.$sql
                );
            }

            return $result;
        }

        function fetch($sql){
            $query = $this->query($sql);

            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        function switch_database($database){
            $this->query("USE `$database`");
        }

        function check_database($database){
            $fetch = $this->fetch("SHOW DATABASES LIKE '$database'");

            if(count($fetch)){
                $this->switch_database($database);

                return true;
            }else{
                return false;
            }
        }

        function __destruct(){
            $this->pdo = null;
        }
    }
}catch(Exception $err){
    $this->response($err->getMessage(), true);
}
?>
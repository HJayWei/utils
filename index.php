<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once __DIR__."/utils/PDO_MySQL.php";

use utils\PDO_MySQL;

$pdo_mysql = new PDO_MySQL();

$pdo_mysql->switch_database("mysql");
var_dump($pdo_mysql->fetch("SHOW TABLES"));

$pdo_mysql->response("", true, "<br><br>");


$pdo_mysql->switch_database("sys");
var_dump($pdo_mysql->fetch("SHOW TABLES"));
?>
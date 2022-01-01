<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once __DIR__."/utils/PDO_MySQL.php";

use utils\Databases\PDO_MySQL;

$pdo_mysql = new PDO_MySQL();

$pdo_mysql->check_database("mysql");
var_dump($pdo_mysql->check_table("user"));
var_dump($pdo_mysql->check_table("user1"));
?>
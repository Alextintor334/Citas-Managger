<?php


define('DB_HOST', 'localhost');
define('DB_NAME', 'db_citas_managger');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

/*
define('DB_HOST', 'localhost');
define('DB_NAME', 'id21234036_db_aplicaciones');
define('DB_USER', 'id21234036_us_alejandro_valdez');
define('DB_PASSWORD', 'Huevos65!');
*/


try {
    $utf8 = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    $cnnPDO = new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME, DB_USER, DB_PASSWORD, $utf8);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>

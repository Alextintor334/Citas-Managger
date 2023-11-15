<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'vista_admin');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

try {
    $utf8 = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    $cnnPDO = new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME, DB_USER, DB_PASSWORD, $utf8);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>

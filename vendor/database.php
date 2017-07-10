<?php
try {
    $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, 
    				DBUSER, 
    				DBPASS,
    				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
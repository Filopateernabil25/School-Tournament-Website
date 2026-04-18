<?php
$dsn="mysql:host=localhost;dbname=tour_db";
define('USER',"root");
$password="";
try{
    $pdo=new PDO($dsn,USER,$password);

}catch(Exception $e){
    echo $e->getMessage();
}
?>
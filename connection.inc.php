<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
$con=new mysqli("localhost","root","root","osdbms");
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/Project/');
define('SITE_PATH','http://localhost/Project/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'/media/product/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'/media/product/');
// $con=new PDO("localhost","root","root","osdbms");
// if ($con!=NULL) { 
//     die("Connection failed: " . $con->connect_error); 
// }  
// echo "Connected successfully"; 
// ?> 
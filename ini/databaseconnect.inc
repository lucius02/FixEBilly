<?php 
$host		= "192.168.0.126";
$username	= "postgres"; 
$password	= "WelKom7993"; 
$dbname		= "EBilly";
$dsn		= "pgsql:host=$host;dbname=$dbname"; 
$options	= array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
?>
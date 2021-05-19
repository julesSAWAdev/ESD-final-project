<?php
$host="localhost";
$user="root";
$pass="";
$db="esd_pro";
//$port="3306";
$conn = mysqli_connect($host,$user,$pass,$db);
if ($conn-> connect_error) {
    	die("connection failed" .$conn-> connect_error);
    }
   //else{echo "connected";}
  
error_reporting(E_ERROR);  
?>

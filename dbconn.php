<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ams";
$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("Failed to connect: ".mysqli_connect_error());  
}


?>
<?php 
    $host="localhost";
    $root="root";
    $password="";
    $database="xelpmoc";
   

 $connection=mysqli_connect($host,$root,$password,$database);
 if ($connection->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

?>
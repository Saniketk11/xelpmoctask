<?php 
include("database.php");
 $id=$_GET["id"];
 $d="delete from history where id='$id'";
 $q=mysqli_query($connection,$d);
 if($q)
 {
    echo "<script> window.location.href='index.php'; </script>";

 }
?>
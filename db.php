<?php
$conn = new mysqli("localhost","root","","hotel");

if($conn->connect_error){
    die("Connect failed: ".$conn->connect_error);
}
?>
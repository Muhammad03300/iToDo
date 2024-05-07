<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "todo";
session_start();
$conn = mysqli_connect($server, $username, $password, $database);
if(!$conn){
    die("Error in ". mysqli_connect_error());
}
?>
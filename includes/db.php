<?php 
$hostname = "localhost";
$username = "root";
$password = "";
$database = "language";

$con = mysqli_connect($hostname,$username,$password,$database);
if(!$con){
    die("Connection failed: ". mysqli_connect_error());
    
}
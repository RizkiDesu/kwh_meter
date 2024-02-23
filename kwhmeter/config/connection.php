<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "kwhmeter";

$conn = mysqli_connect($host,$user,$pass,$db);
if(!$conn){
    die("Gagal Terhubung ke Database" . mysqli_connect_error());
}
<?php
include('../config/connection.php');

if(isset($_GET['relay'])){
    $relay = $_GET['relay'];

    $query = "UPDATE pengaturan SET relay = '$relay'";
    $update = mysqli_query($conn, $query);

    if($update){
        header('location: ../index.php');
    }else{
        echo 'Gagal: ' . mysqli_error($conn);
    }

}
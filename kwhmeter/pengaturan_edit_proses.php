<?php
include('config/connection.php');

if(isset($_POST['simpan'])){
    $batas_kwh = $_POST['batas_kwh'];
    $harga = $_POST['harga'];
    $harga_wbp = $_POST['harga_wbp'];
    $harga_lwbp = $_POST['harga_lwbp'];

    $query = "UPDATE pengaturan SET batas_kwh=$batas_kwh, harga=$harga, harga_wbp=$harga_wbp, harga_lwbp=$harga_lwbp";
    $update = mysqli_query($conn, $query);
    if($update){
        header("location: pengaturan.php");
    }else{
        echo "Gagal: " . mysqli_error($conn);
    }
}else{
    echo "No Data";
}
<?php
session_start();
include('config/connection.php');
$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM admin WHERE username='$username'";
$data = mysqli_query($conn, $query);
$cek = mysqli_num_rows($data);

if ($cek > 0) {
    $row = mysqli_fetch_array($data);
    $password_hash = $row['password'];

    if (password_verify($password, $password_hash)) {
        
        echo 'Password is valid!';
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        header("location: index.php");

    } else {
        echo 'Invalid password.';
        header("location: login.php?pesan=password_salah");
    }
} else {
    header("location: login.php?pesan=username_salah");
}

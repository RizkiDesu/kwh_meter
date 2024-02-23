<?php include('layout/header.php') ?>
<?php include('layout/navbar.php') ?>
<?php
session_start();
if ($_SESSION['status'] != 'login') {
    header("location: login.php?pesan=belum_login");
}

include('config/connection.php');
$query = "SELECT * FROM pengaturan";
$read = mysqli_query($conn, $query);
$row = mysqli_fetch_array($read);
?>
<div class="container col-md-6">

    <h1 class="mb-3">Pengaturan</h1>

    <div class="card">
        <div class="card-body">

            <table class="table">
                <tr>
                    <th scope="row">Batas KWH</th>
                    <td><?php echo $row['batas_kwh'] . " KWH"; ?></td>
                </tr>
                <tr>
                    <th scope="row">Harga</th>
                    <td><?php echo $row['harga'] . " Rupiah"; ?></td>
                </tr>
                <tr>
                    <th scope="row">Harga WBP</th>
                    <td colspan="2"><?php echo $row['harga_wbp'] . " Rupiah"; ?></td>
                </tr>
                <tr>
                    <th scope="row">Harga LWBP</th>
                    <td colspan="2"><?php echo $row['harga_lwbp'] . " Rupiah"; ?></td>
                </tr>
            </table>

            <a href="pengaturan_edit.php" class="btn btn-primary bg-primary border-0">Edit Pengaturan</a>

        </div>
    </div>

</div>

<?php include('layout/footer.php') ?>
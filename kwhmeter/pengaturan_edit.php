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

            <form action="pengaturan_edit_proses.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Batas KWH</label>
                    <input type="text" class="form-control p-3 border-0 bg-light" name="batas_kwh" placeholder="Isi Batas KWH..." value="<?php echo $row['batas_kwh'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="text" class="form-control p-3 border-0 bg-light" name="harga" placeholder="Isi Harga..." value="<?php echo $row['harga'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga WBP</label>
                    <input type="text" class="form-control p-3 border-0 bg-light" name="harga_wbp" placeholder="Isi Harga WBP..." value="<?php echo $row['harga_wbp'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga LWBP</label>
                    <input type="text" class="form-control p-3 border-0 bg-light" name="harga_lwbp" placeholder="Isi Harga LWBP..." value="<?php echo $row['harga_lwbp'] ?>" required>
                </div>
                <button type="submit" name="simpan" class="btn btn-primary bg-primary border-0 p-3 px-5">Simpan</button>
            </form>


        </div>
    </div>

</div>

<?php include('layout/footer.php') ?>
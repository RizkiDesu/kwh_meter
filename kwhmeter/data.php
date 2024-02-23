<?php include('layout/header.php') ?>
<?php include('layout/navbar.php') ?>
<?php
session_start();
if ($_SESSION['status'] != 'login') {
    header("location: login.php?pesan=belum_login");
}

include('config/connection.php');
$query = "SELECT * FROM data";
$read = mysqli_query($conn, $query);
$jumlahData = mysqli_num_rows($read);
?>
<div class="container">

    <h1 class="mb-3">Data Table</h1>
    <p>Total Data: <strong><?php echo $jumlahData ?></strong></p>
    <div class="card border-0 shadow-sm p-3">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">Voltage</th>
                        <th scope="col">Current</th>
                        <th scope="col">Power</th>
                        <th scope="col">Energy</th>
                        <th scope="col">Freq</th>
                        <th scope="col">Pf</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM data ORDER BY id DESC LIMIT 100";
                    $read = mysqli_query($conn, $query);
                    $no = 0;
                    while ($row = mysqli_fetch_array($read)) {
                        $no++;
                    ?>
                        <tr>
                            <th scope="row"><?php echo $no; ?></th>
                            <td><?php echo $row['tanggal'] ?></td>
                            <td><?php echo $row['waktu'] ?></td>
                            <td><?php echo $row['voltage']; ?></td>
                            <td><?php echo $row['current']; ?></td>
                            <td><?php echo $row['power']; ?></td>
                            <td><?php echo $row['energy']; ?></td>
                            <td><?php echo $row['freq']; ?></td>
                            <td><?php echo $row['pf']; ?></td>
                        <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php include('layout/footer.php') ?>
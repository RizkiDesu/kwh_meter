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
$relay = $row['relay'];
$harga = $row['harga'];
$harga_wbp = $row['harga_wbp'];
$harga_lwbp = $row['harga_lwbp'];
$batas_kwh = $row['batas_kwh'];
?>
<div class="container">

    <h1 class="mb-3">Dashboard</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4">

        <div class="col">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="card-body">
                    <p class="card-title">Stop Kontak</p>
                    <div class="row">
                        <div class="col">
                            <div class="d-grid gap-2">
                                <a href="api/update.php?relay=ON" class="btn btn-primary bg-primary border-0">ON</a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-grid gap-2">
                                <a href="api/update.php?relay=OFF" class="btn btn-danger bg-danger border-0">OFF</a>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3">Status:
                        <strong>
                            <?php
                            if ($relay == 'ON') {
                                echo "<span class='text-primary'>" . $relay . "</span>";
                            } else if ($relay == 'OFF') {
                                echo "<span class='text-danger'>" . $relay . "</span>";
                            }
                            ?>
                        </strong>
                    </p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card tr-card h-100 border-0 shadow-sm p-3 p-3">
                <div class="card-body">
                    <p class="card-title">Voltage</p>
                    <h1 class="card-text text-secondary"><strong id='voltage' class="text-dark">00</strong> V</h1>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="card-body">
                    <p class="card-title">Current</p>
                    <h1 class="card-text text-secondary"><strong id='current' class="text-dark">00</strong> A</h1>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="card-body">
                    <p class="card-title">Power</p>
                    <h1 class="card-text text-secondary"><strong id='power' class="text-dark">00</strong> W</h1>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="card-body">
                    <p class="card-title">Energy</p>
                    <h1 class="card-text text-secondary"><strong id='energy' class="text-dark">00</strong> KWH</h1>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="card-body">
                    <p class="card-title">Sisa KWH</p>
                    <h1 class="card-text text-secondary"><strong id='sisa_kwh' class="text-dark">00</strong> KWH</h1>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="card-body">
                    <p class="card-title">Frequency</p>
                    <h1 class="card-text text-secondary"><strong id='freq' class="text-dark">00</strong> Hz</h1>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="card-body">
                    <p class="card-title">Power Faktor</p>
                    <h1 class="card-text text-secondary"><strong id='pf' class="text-dark">00</strong></h1>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="card-body">
                    <p class="card-title">Estimasi Harga</p>
                    <h1 class="card-text text-secondary"><strong id='harga' class="text-dark">5500</strong> Rupiah</h1>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="card-body">
                    <p class="card-title">Estimasi Harga WBP</p>
                    <h1 class="card-text text-secondary"><strong id='harga_wbp' class="text-dark">5500</strong> Rupiah</h1>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="card-body">
                    <p class="card-title">Estimasi Harga LWBP</p>
                    <h1 class="card-text text-secondary"><strong id='harga_lwbp' class="text-dark">5500</strong> Rupiah</h1>
                </div>
            </div>
        </div>

    </div>

    <p class="mt-5">Terakhir Update: <strong id='waktu'>2021-07-01 00:00:00</strong></p>

</div>

<script>
    if (typeof(EventSource) !== "undefined") {
        var source = new EventSource("sse_data.php");
        source.addEventListener('data', function(e) {
            var data = JSON.parse(e.data);

            var tanggal = data.tanggal;
            var waktu = data.waktu;
            var voltage = data.voltage;
            var current = data.current;
            var power = data.power;
            var energy = data.energy;
            var freq = data.freq;
            var pf = data.pf;

            var sisa_kwh = <?php echo $batas_kwh; ?> - energy;

            var harga = energy * <?php echo $harga; ?>;
            var harga_wbp = energy * <?php echo $harga_wbp; ?>;
            var harga_lwbp = energy * <?php echo $harga_lwbp; ?>;

            document.getElementById("voltage").innerText = voltage;
            document.getElementById("current").innerText = current;
            document.getElementById("power").innerText = power;
            document.getElementById("energy").innerText = energy;
            document.getElementById("freq").innerText = freq;
            document.getElementById("pf").innerText = pf;
            document.getElementById("waktu").innerText = tanggal + " " + waktu;
            document.getElementById("harga").innerText = harga.toFixed(2);
            document.getElementById("harga_wbp").innerText = harga_wbp.toFixed(2);
            document.getElementById("harga_lwbp").innerText = harga_lwbp.toFixed(2);
            document.getElementById("sisa_kwh").innerText = sisa_kwh.toFixed(2);

        }, false);
    } else {
        document.getElementById("result").innerHTML = "Not Support";
    }
</script>


<?php include('layout/footer.php') ?>
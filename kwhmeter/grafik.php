<?php
session_start();
if ($_SESSION['status'] != 'login') {
    header("location: login.php?pesan=belum_login");
}
include('config/connection.php');
$query = "SELECT * FROM data ORDER BY id DESC LIMIT 50";
$waktu = mysqli_query($conn, $query);
$voltage = mysqli_query($conn, $query);
$current = mysqli_query($conn, $query);
$power = mysqli_query($conn, $query);
$energy = mysqli_query($conn, $query);
$freq = mysqli_query($conn, $query);
$pf = mysqli_query($conn, $query);
?>

<?php include('layout/header.php') ?>
<?php include('layout/navbar.php') ?>

<div class="container">

    <h1 class="mb-3">Grafik</h1>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="row row-cols-1 row-cols-md-2 g-4">

        <!-- //GRAFIK VOLTAGE  -->
        <div class="col">
            <div class="card tr-card h-100 border-0 shadow-sm p-3 p-3">
                <div class="card-body">
                    <h5 class="card-title">Voltage</h5>
                    <div>
                        <canvas id="voltageChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- //GRAFIK CURRENT  -->
        <div class="col">
            <div class="card tr-card h-100 border-0 shadow-sm p-3 p-3">
                <div class="card-body">
                    <h5 class="card-title">Current</h5>
                    <div>
                        <canvas id="currentChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- //GRAFIK POWER  -->
        <div class="col">
            <div class="card tr-card h-100 border-0 shadow-sm p-3 p-3">
                <div class="card-body">
                    <h5 class="card-title">Power</h5>
                    <div>
                        <canvas id="powerChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- //GRAFIK ENERGY  -->
        <div class="col">
            <div class="card tr-card h-100 border-0 shadow-sm p-3 p-3">
                <div class="card-body">
                    <h5 class="card-title">Energy</h5>
                    <div>
                        <canvas id="energyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- //GRAFIK FREQ  -->
        <div class="col">
            <div class="card tr-card h-100 border-0 shadow-sm p-3 p-3">
                <div class="card-body">
                    <h5 class="card-title">Freq</h5>
                    <div>
                        <canvas id="freqChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- //GRAFIK PF  -->
        <div class="col">
            <div class="card tr-card h-100 border-0 shadow-sm p-3 p-3">
                <div class="card-body">
                    <h5 class="card-title">Pf</h5>
                    <div>
                        <canvas id="pfChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        const labels = [
            <?php
            while ($row = mysqli_fetch_array($waktu)) {
                echo "'" . $row['waktu'] . "', ";
            } ?>
        ];

        // GRAFIK VOLTAGE ------------------------------
        const dataVoltage = {
            labels: labels,
            datasets: [{
                label: 'Voltage (V)',
                backgroundColor: '#673783',
                borderColor: '#673783',
                data: [
                    <?php
                    while ($row = mysqli_fetch_array($voltage)) {
                        echo $row['voltage'] . ", ";
                    } ?>
                ],
            }]
        };
        const configVoltage = {
            type: 'line',
            data: dataVoltage,
            options: {
                animation: {
                    duration: 0
                },
            }
        };
        const voltageChart = new Chart(
            document.getElementById('voltageChart'),
            configVoltage
        );

        // GRAFIK CURRENT ------------------------------
        const dataCurrent = {
            labels: labels,
            datasets: [{
                label: 'Current (A)',
                backgroundColor: '#8B2D73',
                borderColor: '#8B2D73',
                data: [
                    <?php
                    while ($row = mysqli_fetch_array($current)) {
                        echo $row['current'] . ", ";
                    } ?>
                ],
            }]
        };
        const configCurrent = {
            type: 'line',
            data: dataCurrent,
            options: {
                animation: {
                    duration: 0
                },
            }
        };
        const currentChart = new Chart(
            document.getElementById('currentChart'),
            configCurrent
        );

        // GRAFIK POWER ------------------------------
        const dataPower = {
            labels: labels,
            datasets: [{
                label: 'Power (W)',
                backgroundColor: '#A3276A',
                borderColor: '#A3276A',
                data: [
                    <?php
                    while ($row = mysqli_fetch_array($power)) {
                        echo $row['power'] . ", ";
                    } ?>
                ],
            }]
        };
        const configPower = {
            type: 'line',
            data: dataPower,
            options: {
                animation: {
                    duration: 0
                },
            }
        };
        const powerChart = new Chart(
            document.getElementById('powerChart'),
            configPower
        );

        // GRAFIK ENERGY ------------------------------
        const dataEnergy = {
            labels: labels,
            datasets: [{
                label: 'Energy (kWh)',
                backgroundColor: '#BA2160',
                borderColor: '#BA2160',
                data: [
                    <?php
                    while ($row = mysqli_fetch_array($energy)) {
                        echo $row['energy'] . ", ";
                    } ?>
                ],
            }]
        };
        const configEnergy = {
            type: 'line',
            data: dataEnergy,
            options: {
                animation: {
                    duration: 0
                },
            }
        };
        const energyChart = new Chart(
            document.getElementById('energyChart'),
            configEnergy
        );

        // GRAFIK FREQ ------------------------------
        const dataFreq = {
            labels: labels,
            datasets: [{
                label: 'Freq (Hz)',
                backgroundColor: '#C91C59',
                borderColor: '#C91C59',
                data: [
                    <?php
                    while ($row = mysqli_fetch_array($freq)) {
                        echo $row['freq'] . ", ";
                    } ?>
                ],
            }]
        };
        const configFreq = {
            type: 'line',
            data: dataFreq,
            options: {
                animation: {
                    duration: 0
                },
            }
        };
        const freqChart = new Chart(
            document.getElementById('freqChart'),
            configFreq
        );

        // GRAFIK PF ------------------------------
        const dataPf = {
            labels: labels,
            datasets: [{
                label: 'Pf',
                backgroundColor: '#D91852',
                borderColor: '#D91852',
                data: [
                    <?php
                    while ($row = mysqli_fetch_array($pf)) {
                        echo $row['pf'] . ", ";
                    } ?>
                ],
            }]
        };
        const configPf = {
            type: 'line',
            data: dataPf,
            options: {
                animation: {
                    duration: 0
                },
            }
        };
        const pfChart = new Chart(
            document.getElementById('pfChart'),
            configPf
        );

    </script>
</div>
<?php include('layout/footer.php') ?>
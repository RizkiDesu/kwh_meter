<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

include('config/connection.php');
$query = "SELECT * FROM data ORDER BY id DESC LIMIT 1";
$read = mysqli_query($conn, $query);
$row = mysqli_fetch_array($read);

$tanggal    = $row['tanggal'];
$waktu      = $row['waktu'];
$voltage    = $row['voltage'];
$current    = $row['current'];
$power      = $row['power'];
$energy     = $row['energy'];
$freq       = $row['freq'];
$pf         = $row['pf'];

$data = array(
    'tanggal'   => $tanggal,
    'waktu'     => $waktu,
    'voltage' => $voltage,
    'current' => $current,
    'power' => $power,
    'energy' => $energy,
    'freq' => $freq,
    'pf' => $pf
);

echo "data: " . json_encode($data);
echo PHP_EOL;
// Event user
echo "event: data";
echo PHP_EOL;
echo PHP_EOL;
flush();

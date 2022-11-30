<?php 
include "../Backend/db_conn.php"; 

//fetch data
$fetchDateQuery = "SELECT datetime from data_table LIMIT 0, 10";
$result1 = mysqli_query($conn, $fetchDateQuery);
$rowsDate = mysqli_fetch_all($result1, MYSQLI_ASSOC);
$xValues = array_map(function ($item) {
    return $item['datetime'];
}, $rowsDate);

//fetch temperature
$fetchTemp = "SELECT temperature from data_table LIMIT 0, 10";
$temps = mysqli_query($conn, $fetchTemp);
$rowsAtd = mysqli_fetch_all($temps, MYSQLI_ASSOC);
$temperatureValues = array_map(function ($item) {
    return $item['temperature'];
}, $rowsAtd);

//fetch humidity
$fetchHumidity = "SELECT humidity from data_table LIMIT 0, 10";
$humidity = mysqli_query($conn, $fetchHumidity);
$rowsH = mysqli_fetch_all($humidity, MYSQLI_ASSOC);
$humidityValues = array_map(function ($item) {
    return $item['humidity'];
}, $rowsH);

//fetch soil mositure
$fetchMoisture = "SELECT moisture from data_table LIMIT 0, 10";
$moisture = mysqli_query($conn, $fetchMoisture);
$rowsM = mysqli_fetch_all($moisture, MYSQLI_ASSOC);
$moistureValues = array_map(function ($item) {
    return $item['moisture'];
}, $rowsM);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./assets/style.css" />
    <link rel="stylesheet" href="./assets/share.css">
    <link rel="stylesheet" href="./assets/graph.css">

    <title>S-Farms</title>
</head>

<body>
    <div class="main">
        <div class="case">
            <div class="nav">
                <h1 class="logo">S-Farms</h1>
                <div class="nav-link">
                    <a href="./index.php" class="path">Home</a>
                    <a href="./datapool.php" class="path">Table</a>
                    <a href="./graphs.php" class="path active">Graph</a>
                    <a href="./share.php" class="path">News Feed</a>
                </div>
            </div>
        </div>

        <div id="graph">
            <div class="chart">
                <canvas id="temperatureChart"></canvas>
            </div>
        </div>
        <button class="refresh-button" onclick="reloadPage()">Refresh Page</button>
    </div>

    <!-- Include CDN to chart Js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    function reloadPage() {
        window.location.reload();
    }

    const ctx = document.getElementById('temperatureChart');

    const x = <?php echo json_encode($xValues) ?>;
    const temperature = <?php echo json_encode($temperatureValues) ?>;
    const humidity = <?php echo json_encode($humidityValues) ?>;
    const moisture = <?php echo json_encode($moistureValues) ?>;

    new Chart(ctx, {
        type: "line",
        data: {
            labels: x,
            datasets: [{
                label: "Temperature",
                backgroundColor: "rgba(0,0,255,1.0)",
                borderColor: "rgba(0,0,255,0.1)",
                data: temperature,
            }, {
                label: "Humidity",
                backgroundColor: "rgba(0,255,0,1.0)",
                borderColor: "rgba(0,255,0,0.1)",
                data: humidity,
            }, {
                label: "Soil Moisture",
                backgroundColor: "rgba(255,0,0,1.0)",
                borderColor: "rgba(255,0,0,0.1)",
                data: moisture,
            }, ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: "top",
                },
                title: {
                    display: true,
                    text: "Chart for sensor readings",
                },
            },
        },
    });
    </script>
</body>

</html>
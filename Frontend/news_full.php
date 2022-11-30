<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Insert User Styles -->
    <link rel="stylesheet" href="./assets/style.css" />
    <link rel="stylesheet" href="./assets/share.css">

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
                    <a href="./graphs.php" class="path">Graph</a>
                    <a href="./share.php" class="path active">News Feed</a>
                </div>
            </div>
        </div>

        <div id="temp" class="chart">
            <h2>Temperature chart</h2>
            <div>
                <canvas id="temperatureChart"></canvas>
            </div>
        </div>
    </div>
</body>

</html>
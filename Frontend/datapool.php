<?php 
include '../Backend/db_conn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--Include all required css  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">

    <!-- Include users css  -->
    <link rel="stylesheet" href="./assets/style.css" />

    <title>SFM System</title>
</head>

<body>
    <div class="main">
        <div class="case">
            <div class="nav">
                <h1 class="logo">S-Farms</h1>
                <div class="nav-link">
                    <a href="index.php" class="path">Home</a>
                    <a href="datapool.php" class="path active">Table</a>
                    <a href="./graphs.php" class="path ">Graph</a>
                    <a href="share.php" class="path">Data Forum</a>
                </div>
            </div>
        </div>

        <div class="main_body">
            <table id="data_table" class="display">
                <thead>
                    <th>S/N</th>
                    <th>Temperature</th>
                    <th>Humidity</th>
                    <th>Soil Moisture</th>
                    <th>Date</th>
                </thead>
                <tbody>
                    <?php 
                    $sql = "SELECT * from data_table ORDER BY `id` DESC";
                    if ($result = $conn->query($sql)) {
                        $sn = 0;
                        while ($row = $result->fetch_assoc()) {
                            $sn++;
                            $row_id = $row["id"];
                            $temperature = $row["temperature"];
                            $humidity = $row["humidity"];
                            $moisture = $row["moisture"];
                            $row_reading_time = $row["datetime"]; 
                            
                            echo '<tr> 
                                    <td>' . $sn. '</td> 
                                    <td>' . $temperature . '<sup>o</sup>C</td> 
                                    <td>' . $humidity . '%</td>
                                    <td>' . $moisture . '%</td>
                                    <td>' . $row_reading_time . '</td> 
                                    </tr>';
                        }
                        
                        $result->free();
                    }

                    $conn->close();
                ?>
                </tbody>
            </table>

            <button class="refresh-button" onclick="reloadPage()">Refresh Page</button>
        </div>


        <!-- Include jquery and other needed js files here-->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>


        <script type="text/javascript">
        $(document).ready(function() {
            $("#data_table").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });

        function reloadPage() {
            window.location.reload();
        }
        </script>
    </div>
    < </body>

</html>
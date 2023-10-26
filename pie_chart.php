<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gender Distribution Pie Chart</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f5dc, #d2b48c, #d2691e);
            color: black;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        #genderPieChart {
            width: 400px;
            margin-top: 20px;
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 20px;
        }

        a {
            text-decoration: none;
            color: black;
            font-weight: bold;
            margin-top: 20px;
        }

        a:hover {
            color: #333;
        }

        .back-to-menu {
            padding: 10px 20px;
            color: black;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
            background-color: #8B4513; /* Mocha color */
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Shadow effect */
            transition: background-color 0.3s ease; /* Smooth transition on hover */
        }

        .back-to-menu:hover {
            background-color: #F5F5DC; /* Beige color on hover */
        }
    </style>
</head>

<body>
    <a href="admin_home.php" class="back-to-menu">Back to Menu</a>

    <div style="width: 400px; margin: 0 auto;">
        <canvas id="genderPieChart"></canvas>
    </div>

    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gamboa";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to get gender distribution
    $query = "SELECT gender, COUNT(*) as count FROM users GROUP BY gender";
    $result = $conn->query($query);

    // Data for the chart
    $genderLabels = [];
    $genderCounts = [];

    while ($row = $result->fetch_assoc()) {
        $genderLabels[] = $row['gender'];
        $genderCounts[] = $row['count'];
    }
    ?>

    <script>
        // Data for the gender distribution chart
        const genderData = {
            labels: <?php echo json_encode($genderLabels); ?>,
            datasets: [{
                data: <?php echo json_encode($genderCounts); ?>,
                backgroundColor: ['#FF5733', '#3498DB', '#F1C40F'], // Colors for each segment
            }],
        };

        // Get the chart canvas
        const ctx = document.getElementById('genderPieChart').getContext('2d');

        // Create the gender distribution pie chart
        new Chart(ctx, {
            type: 'pie',
            data: genderData,
        });
    </script>
</body>

</html>

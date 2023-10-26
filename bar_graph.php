<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Bar Graph</title>
</head>
<style>
    body {
    font-size: 25px;
    font-family: 'Arial', sans-serif;
    margin: 100px;
    padding: 0;
    background: linear-gradient(135deg, #F5F5DC, #D2B48C, #D2691E);
    height: 100vh; /* Set height to 100% of the viewport */
}

#chart-container {
    width: 80%;
    margin: 20px auto;
    background: #fff; /* Set a solid background for the chart container */
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

#activityBarChart {
    width: 100%;
}

a {
    display: block;
    margin-top: 20px;
    text-align: center;
    font-weight: bold;
    text-decoration: none;
    color: #fff; /* Change text color to white */
}


</style>
<body>

<?php
// Your database connection code here

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gamboa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT MONTH(date) AS month, COUNT(*) AS activity_count FROM user_activities GROUP BY month";
$result = $conn->query($sql);

$monthNames = [
    1 => 'January',
    2 => 'February',
    3 => 'March',
    4 => 'April',
    5 => 'May',
    6 => 'June',
    7 => 'July',
    8 => 'August',
    9 => 'September',
    10 => 'October',
    11 => 'November',
    12 => 'December',
];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gamboa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT MONTH(date) AS month, COUNT(*) AS activity_count FROM user_activities GROUP BY month";
$result = $conn->query($sql);

// Fetch data and store it in arrays
$months = [];
$activityCounts = [];

while ($row = $result->fetch_assoc()) {
    $months[] = $monthNames[$row['month']];
    $activityCounts[] = $row['activity_count'];
}

$conn->close();
?>

<div style="width: 800px; margin: 0 auto;">
    <canvas id="activityBarChart"></canvas>
</div>

<script>
    // Use PHP data to generate JavaScript arrays
    const months = <?php echo json_encode($months); ?>;
    const activityCounts = <?php echo json_encode($activityCounts); ?>;

    const ctx = document.getElementById('activityBarChart').getContext('2d');
    const activityBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Number of Activities',
                data: activityCounts,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<br>
    <a href="admin_home.php" style="color: black; text-decoration: none; font-weight: bold; text-align: center">Back to Menu</a>
</body>
</html>

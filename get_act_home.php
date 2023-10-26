<!DOCTYPE html>
<html>
<head>
    <title>Activity Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="navbar">
        <!-- ... -->
    </div>

    <!-- Add a logout button -->
    <div class="logout-button">
        <!-- ... -->
    </div>

    <div style="width: 80%; margin: 0 auto;">
        <h1>Monthly Activity Chart</h1> <br>
        <h1>wla pa q kasabut unsaon ni cya</h1>
        <!-- Use a single canvas element for the chart -->
        <canvas id="activityChart"></canvas>
    </div>

    <script>
        var ctx = document.getElementById("activityChart").getContext("2d");

        // Fetch data from the server
        fetch("get_activity_data.php")
            .then((response) => response.json())
            .then((data) => {
                var activityChart = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: data.months,
                        datasets: [
                            {
                                label: "Activity Count",
                                data: data.activityCounts,
                                backgroundColor: "rgba(75, 192, 192, 0.2)",
                                borderColor: "rgba(75, 192, 192, 1)",
                                borderWidth: 1,
                            },
                            {
                                label: "Activity Data",
                                data: data.activityData,
                                backgroundColor: "rgba(255, 99, 132, 0.2)",
                                borderColor: "rgba(255, 99, 132, 1)",
                                borderWidth: 1,
                            },
                        ],
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                            },
                        },
                    },
                });
            });
    </script>
     <a href="admin_home.php">Back to Menu</a>
</body>
</html>

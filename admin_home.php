<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
   
    <title>Admin Dashboard</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-image: url('images/bg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            text-align: center;
        }

        h1 {
            font-size: 3rem;
            font-weight: bold;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
        }

        h2 {
            font-size: 1.5rem;
            color: #8B4513;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
            padding: 10px 20px; 
            border-radius: 15px;
            background-color: #ddd;
            display: inline-block; 
            margin: 10px;
        }

        .navbar {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .navbar a {
            font-size: 1rem;
            color: brown;
            text-decoration: none;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
            padding: 10px 20px; 
            border-radius: 15px;
            background-color: #ddd;
            display: inline-block; 
            margin: 10px;
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar a:hover {
            background-color: beige;
            color: green;
        }

        button[name="logout"] {
            font-size: 1rem;
            background-color: #ff3333;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            transition: background-color 0.3s, transform 0.3s ease;
        }

        button[name="logout"]:hover {
            background-color: #cc0000;
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
        <h1>ADMIN DASHBOARD</h1>
        <h2>WELCOME, Admin:)</h2>
        <br>
    <div class="navbar">
        <a href="#" onclick="loadContent('show_users.php')">List of Users</a>
        <!-- <a href="#" onclick="loadContent('charts-chartjs.html')">Pie Chart & Bar Graph</a> -->
        <a href="pie_chart.php" onclick="loadContent('pie_chart.php')">Pie Chart</a>
        <a href="bar_graph.php" onclick="loadContent('bar_graph.php')">Bar Graph</a>
        <a href="#" onclick="loadContent('admin_announcements.php')">Announcement</a>
    </div>

    <form method="post" action="logout.php" style="position: absolute; top: 10px; right: 10px;">
        <button type="submit" name="logout">Logout</button>
    </form>

    <div id="content-container"></div>

    <script>
        function loadContent(url) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("content-container").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        }
    </script>
</body>
</html>

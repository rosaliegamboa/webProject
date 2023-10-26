<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Announcements</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #d2b48c; /* Brown */
            color: #4d4d4d; /* Dark Gray */
            margin: 0;
            padding-bottom: 20px; /* Space for the menu button */
        }

        h1, h2 {
            color: #8b4513; /* Saddle Brown */
            text-align: center;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f5f5dc; /* Beige */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #4d4d4d; /* Dark Gray */
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            background-color: #f8f8f8; /* Light Gray */
            border: 1px solid #ccc; /* Light Gray */
            color: #4d4d4d; /* Dark Gray */
            border-radius: 5px;
        }

        button {
            background-color: #8b4513; /* Saddle Brown */
            color: #fff; /* White */
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #6a391e; /* Darker Brown on hover */
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 20px;
        }

        div {
            max-width: 600px;
            margin: 20px auto;
            padding: 15px;
            background-color: #f5f5dc; /* Beige */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        a {
            text-decoration: none;
            color: #8b4513; /* Saddle Brown */
            margin-right: 15px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1>Manage Announcements</h1>

    <!-- Form to create a new announcement -->
    <form action="create_announcement.php" method="POST">
        <label for="title">Announcement Title:</label>
        <input type="text" name="title" required><br>
        <label for="content">Announcement Content:</label>
        <textarea name="content" required></textarea><br>
        <button type="submit">Create Announcement</button>
    </form>

    <!-- List of existing announcements with edit and delete options -->
    <h2>Existing Announcements</h2>
    <ul>
        <!-- PHP code to fetch and display announcements -->
        <?php
            // Include your database connection code (e.g., dbutil.php)
            include_once("dbutil.php");

            // Connect to the database
            $conn = getConnection();

            // Query to fetch announcements (adjust table and column names as needed)
            $sql = "SELECT id, title, content, created_at FROM announcements ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $announcementId = $row["id"];
                    $title = htmlspecialchars($row["title"]);
                    $content = htmlspecialchars($row["content"]);
                    $created_at = $row["created_at"];

                    // Display each announcement with edit and delete links
                    echo "<div>";
                    echo "<h3>$title</h3>";
                    echo "<p>$content</p>";
                    echo "<p>Created at: $created_at</p>";

                    // Edit and delete links (replace with actual URLs and buttons)
                    echo "<a href='edit_announcement.php?id=$announcementId'>Edit</a>";
                    echo "<a href='delete_announcement.php?id=$announcementId'>Delete</a>";
                    echo "</div>";
                }
            } else {
                echo "No announcements found.";
            }

            // Close the database connection
            closeConnection($conn);
        ?>
    </ul>

    <!-- Menu Button -->
    <br>
    <a href="admin_home.php">Back to Menu</a>
</body>

</html>

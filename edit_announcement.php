<!DOCTYPE html>
<html>
<head>
    <title>Edit Announcement</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8; /* Light Gray */
            color: #333; /* Dark Gray */
            margin: 200px;
        }

        h1 {
            color: #800080; /* Purple */
            text-align: center;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff; /* White */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333; /* Dark Gray */
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            background-color: #f5f5f5; /* Light Gray */
            border: 1px solid #ccc; /* Light Gray */
            color: #333; /* Dark Gray */
            border-radius: 5px;
        }

        button {
            background-color: #800080; /* Purple */
            color: #fff; /* White */
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4b0082; /* Indigo */
        }
    </style>
<body>
    <h1>Edit Announcement</h1>

    <?php
    include_once("dbutil.php");
    
    if (isset($_GET['id'])) {
        // Get the announcement ID from the URL
        $announcementId = $_GET['id'];

        // Connect to the database
        $conn = getConnection();

        // Query to fetch the announcement based on the provided ID
        $sql = "SELECT title, content FROM announcements WHERE id = $announcementId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Fetch the announcement data
            $row = $result->fetch_assoc();
            $title = $row["title"];
            $content = $row["content"];

            // Display the form to edit the announcement
            ?>
            <form action="update_announcement.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $announcementId; ?>">
                <label for="title">Announcement Title:</label>
                <input type="text" name="title" value="<?php echo $title; ?>" required><br>
                <label for="content">Announcement Content:</label>
                <textarea name="content" required><?php echo $content; ?></textarea><br>
                <button type="submit">Update Announcement</button>
            </form>
            <?php
        } else {
            echo "Announcement not found.";
        }

        // Close the database connection
        closeConnection($conn);
    } else {
        echo "Invalid announcement ID.";
    }
    ?>
    
</body>
</html>

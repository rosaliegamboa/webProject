<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Activity</title>
</head>
<style>
    
        body {
            background-color: #f9efeb;
            font-family: Arial, sans-serif;
            margin: 100px;
            padding: 80px;
        }

        h2 {
            color: #7a287d;
            text-align: center;
            font-size: 45px;
            margin-top: 20px;
        }

        form {
            background-color: #ece0f5;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 500px;
            padding: 20px;
        }

        label {
            color: #7a287d;
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"] {
            border: 1px solid #e69fbd;
            border-radius: 3px;
            padding: 5px;
            width: 100%;
        }

        input[type="submit"] {
            background-color: #aa55bb;
            border: none;
            border-radius: 3px;
            color: white;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            padding: 10px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #9933aa;
        }
    
</style>
<body>
    <h2>Edit Activity</h2>
    <!-- Form for editing activities -->
    <form method="post" action="update_activity.php">
        <!-- Include the activity ID -->
        <input type="hidden" name="edit_id" value="1"> <!-- Assuming '1' is the ID you want to edit -->
        <label for="edit_Name">Your Name:</label>
        <input type="text" id="edit_Name" name='edit_Name' required><br>

        <label for="edit_dateofActivity">Date:</label>
        <input type="date" id="edit_dateofActivity" name='edit_dateofActivity' required><br>

        <label for="edit_timeofActivity">Time:</label>
        <input type="time" id="edit_timeofActivity" name='edit_timeofActivity' required><br>

        <label for="edit_location">Location:</label>
        <input type="text" id="edit_location" name='edit_location' required><br>

        <label for="edit_ootd">OOTD:</label>
        <input type="text" id="edit_ootd" name='edit_ootd' required><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>

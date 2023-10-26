<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (isset($_SESSION['update_success']) && $_SESSION['update_success'] === true) {
    echo '<p style="color: green;">Activity updated successfully!</p>';
    // Reset the session variable
    unset($_SESSION['update_success']);
}

include_once("dbutil.php");

$conn = getConnection();

// Handle form submission for changing the order
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['changeOrder'])) {
    $orderOption = $_POST['orderOption'];
    $orderSql = ($orderOption === 'asc') ? 'ASC' : 'DESC';
    $sql = "SELECT * FROM user_activities ORDER BY date $orderSql";
} else {
    // Default query for ascending order
    $sql = "SELECT * FROM user_activities ORDER BY date ASC";
}

$result = $conn->query($sql);

// Handle form submission for activity actions
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['activityAction'])) {
    $activityId = $_POST['activityId'];
    $action = $_POST['set_activity']; // Update this line

    switch ($action) {
        case 'cancel':
            // Handle 'Cancel' action
            $cancelSql = "UPDATE user_activities SET activity_status = 'cancel' WHERE id = $activityId";
            $conn->query($cancelSql);
            echo "Activity canceled.";
            break;

        case 'markDone':
            // Handle 'Mark Done' action
            $markDoneSql = "UPDATE user_activities SET activity_status = 'done' WHERE id = $activityId";
            $conn->query($markDoneSql);
            echo "Activity marked as done.";
            break;

        case 'addRemarks':
            // Handle 'Add Remarks' action
            $remarks = $_POST['remarks']; // Make sure to sanitize user input to prevent SQL injection
            $addRemarksSql = "UPDATE user_activities SET activity_status = 'remarks', remarks_column = '$remarks' WHERE id = $activityId";
            $conn->query($addRemarksSql);
            echo "Remarks added to the activity.";
            break;

        default:
            echo "Invalid action.";
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <style>
        body {
            background-color: #f5f5f0;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #8b4513;
            text-align: center;
            font-family: 'Times New Roman', serif;
            margin-bottom: 20px;
        }

        #addActivityForm {
            width: 300px;
            margin: 0 auto;
            text-align: center;
            background-color: #d2b48c;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #8b4513;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
            color: #2f4f4f;
            font-family: 'Cursive', sans-serif;
            border: 1px solid #8b4513;
            border-radius: 5px;
        }

        button {
            background-color: #8b4513;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #a0522d;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #8b4513;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #d2b48c;
            color: white;
        }

        /* Activity boxes */
        tbody tr {
            background-color: #fff8dc;
        }

        /* Remarks input field styling */
        input[name="remarks"] {
            width: 100%;
            padding: 8px;
            margin-top: 8px;
            background-color: #fff8dc;
            border: 1px solid #8b4513;
            border-radius: 5px;
        }

        form[action="logout.php"] {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        button[name="logout"] {
            background-color: #8b0000;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[name="logout"]:hover {
            background-color: #cc0000;
        }
    </style>


</head>
<body>
    <h1>User Page</h1>
    
    <!-- Form to add a new activity -->
  <form id="addActivityForm" method='post' action='add_activity.php'>
        <label for="name">Activity Name:</label> <!-- Updated column name -->
        <input type="text" id="userName" name='yourName' required><br>

        <label for="date">Date:</label>
        <input type="date" id="activityDate" name='dateofActivity' required><br>

        <label for="time">Time:</label>
        <input type="time" id="activityTime" name='timeofActivity' required><br>

        <label for="location">Location:</label>
        <input type="text" id="activityLocation" name='location' required><br>

        <label for="ootd">OOTD:</label>
        <input type="text" id="activityOOTD" name='ootd' required><br>

        <button type="submit" name='addActivity'>Add Activity</button>
    </form>

    <!-- Dropdown for changing order -->
    <form method="post" action="">
        <label for="orderOption">Show All:</label>
        <select name="orderOption">
            <option value="asc">Ascending by Date</option>
            <option value="desc">Descending by Date</option>
        </select>
        <button type="submit" name="changeOrder">Change Order</button>
    </form>

    <!-- Display all activities based on selected order -->
<h2>All Activities</h2>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Location</th>
            <th>OOTD</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['date']?></td>
                <td><?php echo $row['time']?></td>
                <td><?php echo $row['location']?></td>
                <td><?php echo $row['ootd']?></td>
                <td>
                    <form method='post' action=''>
                        <input type='hidden' name='activityId' value='<?php echo $row['id']; ?>'>
                        <select name='set_activity' onchange="showRemarksField(this)">
                            <option value='cancel'>Cancel</option>
                            <option value='markDone'>Mark Done</option>
                            <option value='addRemarks'>Add Remarks</option>
                        </select>

                        <!-- Add the input field for remarks with an initial style of display:none -->
                        <input type='text' name='remarks' placeholder='Enter remarks' style='display:none;'>

                        <button type='submit' name='activityAction'>Submit</button>
                        <button type='button' onclick='editActivity(<?php echo $row['id']; ?>)'>Edit</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    function showRemarksField(selectElement) {
        var remarksField = selectElement.parentElement.querySelector('input[name="remarks"]');
        remarksField.style.display = (selectElement.value === 'addRemarks') ? 'block' : 'none';
    }
</script>



    <script>
        function editActivity(activityId) {
            // Redirect to the edit_activity.php page with the activity ID
            window.location.href = 'edit_activity.php?id=' + activityId;
        }
    </script>
</body>
</html>


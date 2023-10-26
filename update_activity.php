<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

print_r($_POST);

// Your database connection code here
session_start();
include_once("dbutil.php");

$conn = getConnection();

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add debug message
echo "Connected to the database successfully";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $editId = $_POST['edit_id'];
    $editName = $_POST['edit_Name'];
    $editDate = $_POST['edit_dateofActivity'];
    $editTime = $_POST['edit_timeofActivity'];
    $editLocation = $_POST['edit_location'];
    $editOOTD = $_POST['edit_ootd'];

    // Print the values for debugging
    echo "ID: $editId, Name: $editName, Date: $editDate, Time: $editTime, Location: $editLocation, OOTD: $editOOTD";

    // Check if $editId is not empty
    if (!empty($editId)) {
        // Update the activity in the database using prepared statement
        $sql = "UPDATE user_activities SET
                name = ?,
                date = ?,
                time = ?,
                location = ?,
                ootd = ?
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $editName, $editDate, $editTime, $editLocation, $editOOTD, $editId);

        if ($stmt->execute()) {
            // Set a session variable for success message
            $_SESSION['update_success'] = true;

            // Redirect to the main page
            header("Location: user_home.php");
            exit();
        } else {
            // Display an error message on the page
            echo "Error updating activity: " . $stmt->error;
            // Print the SQL query for debugging
            echo "SQL: " . $sql;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "ID is empty.";
    }

    // Close the database connection
    closeConnection($conn);
} else {
    // Display an error message on the page for invalid request method
    echo "Invalid request method";
}
?>

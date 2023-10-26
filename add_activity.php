<?php
session_start();

include_once("dbutil.php");

$conn = getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $name = $_POST['yourName'];
    $date = $_POST['dateofActivity'];
    $time = $_POST['timeofActivity'];
    $location = $_POST['location'];
    $ootd = $_POST['ootd'];

    // Insert new activity into the database
    $sql = "INSERT INTO user_activities (name, date, time, location, ootd) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $date, $time, $location, $ootd);

    if ($stmt->execute()) {
        header("Location: user_home.php");
        exit();
    } else {
        echo "Error creating activity: " . $conn->error;
    }

    // Close the prepared statement
    $stmt->close();

    // Close the database connection
    closeConnection($conn);
} else {
    echo "Activity not submitted.";
}
?>

<?php
// Include your database connection code (e.g., dbutil.php)
include_once("dbutil.php");

// Check if an announcement ID is provided in the URL
if (isset($_GET['id'])) {
    // Get the announcement ID from the URL
    $announcementId = $_GET['id'];

    // Connect to the database
    $conn = getConnection();

    // Query to delete the announcement based on the provided ID
    $sql = "DELETE FROM announcements WHERE id = $announcementId";
    
    if ($conn->query($sql) === TRUE) {
        echo "Announcement deleted successfully.";
    } else {
        echo "Error deleting announcement: " . $conn->error;
    }

    // Close the database connection
    closeConnection($conn);
} else {
    echo "Invalid announcement ID.";
}
?>

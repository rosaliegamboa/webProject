<?php
// Include your database connection code (e.g., dbutil.php)
include_once("dbutil.php");

// Check if form data is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the announcement ID and updated data from the form
    $announcementId = $_POST['id'];
    $updatedTitle = $_POST['title'];
    $updatedContent = $_POST['content'];

    // Connect to the database
    $conn = getConnection();

    // Update the announcement in the database
    $sql = "UPDATE announcements SET title = '$updatedTitle', content = '$updatedContent' WHERE id = $announcementId";
    
    if ($conn->query($sql) === TRUE) {
        echo "Announcement updated successfully.";
    } else {
        echo "Error updating announcement: " . $conn->error;
    }

    // Close the database connection
    closeConnection($conn);
} else {
    echo "Invalid request method.";
}
?>
<button class="back-button" onclick="window.location.href='admin_announcements.php'">Back</button>

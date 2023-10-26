<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection code (e.g., dbutil.php)
    include_once("dbutil.php");

    // Retrieve and sanitize the data from the form
    $title = htmlspecialchars($_POST["title"]);
    $content = htmlspecialchars($_POST["content"]);

    // Create a timestamp for the announcement
    $created_at = date("Y-m-d H:i:s");

    // Perform database insertion
    $conn = getConnection();

    $sql = "INSERT INTO announcements (title, content, created_at) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss",  $title, $content, $created_at);

    if ($stmt->execute()) {
        // Announcement created successfully
        header("Location: admin_announcements.php");
        exit();
    } else {
        // Error occurred while creating the announcement
        echo "Error creating announcement: " . $conn->error;
    }

    closeConnection($conn);
} else {
    // Handle the case where the form was not submitted
    echo "Form not submitted.";
}
?>

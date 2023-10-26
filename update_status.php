<?php
session_start();
include_once("dbutil.php");

if (isset($_POST['update_status'])) {
    $user_id = $_POST['user_id'];
    $new_status = $_POST['new_status'];

    $conn = getConnection();
    $updateSql = "UPDATE users SET status = '$new_status' WHERE id = $user_id";
    
    if ($conn->query($updateSql) === TRUE) {
        // Status updated successfully
        header("Location: admin_home.php");
        exit();
    } else {
        echo "Error updating status: " . $conn->error;
    }

    closeConnection($conn);
}
?>

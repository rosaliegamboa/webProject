<!-- process_activity.php -->
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check which button was clicked
    if (isset($_POST['submit'])) {
        $action = $_POST['submit'];

        // Process based on the action
        switch ($action) {
            case 'done':
                // Handle 'Done' action
                $activityName = $_POST['activity_name'];
                $activityDate = $_POST['activity_date'];

                // Your logic to save the activity to the database or perform other actions
                // ...

                echo "Activity '$activityName' set for $activityDate.";
                break;

            case 'cancel':
                // Handle 'Cancel' action
                echo "Activity setting canceled.";
                break;

            default:
                // Handle other actions if needed
                break;
        }
    } else {
        echo "Invalid action.";
    }
} else {
    echo "Invalid request method.";
}
?>

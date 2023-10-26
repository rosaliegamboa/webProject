<?php
include_once("dbutil.php");

$conn = getConnection();

try {
    $sql = "SELECT calendar.Month AS Month, COUNT(user_activities.Date) AS ActivityCount
            FROM (
                SELECT 'January' AS Month
                UNION SELECT 'February' AS Month
                UNION SELECT 'March' AS Month
                UNION SELECT 'April' AS Month
                UNION SELECT 'May' AS Month
                UNION SELECT 'June' AS Month
                UNION SELECT 'July' AS Month
                UNION SELECT 'August' AS Month
                UNION SELECT 'September' AS Month
                UNION SELECT 'October' AS Month
                UNION SELECT 'November' AS Month
                UNION SELECT 'December' AS Month
            ) calendar
            LEFT JOIN user_activities ON calendar.Month = MONTHNAME(user_activities.Date)
            GROUP BY calendar.Month
            ORDER BY STR_TO_DATE(calendar.Month, '%M')";

    $result = $conn->query($sql);

    if ($result === false) {
        throw new Exception("Error in SQL query: " . $conn->error);
    }

    $months = [];
    $activityCounts = [];
    $activityData = [];

    while ($row = $result->fetch_assoc()) {
        // Sanitize data before using it
        $month = htmlspecialchars($row['Month']);
        $activityCount = (int)$row['ActivityCount'];

        $months[] = "Month " . $month;
        $activityCounts[] = $activityCount;
        $activityData[] = $row['ActivityCount'];
    }

    echo json_encode([
        'months' => $months,
        'activityCounts' => $activityCounts,
        'activityData' => $activityData,
    ]);
} catch (Exception $e) {
    // Log or display the exception message
    echo json_encode(['error' => $e->getMessage()]);
}

$conn->close();
?>

<style>
   body {
    font-family: Arial, sans-serif;
    color: #333; /* Dark Gray */
    margin: 0;
}

.container {
    max-width: 100%;
    margin: 100px auto;
    padding: 20px;
    background-color: #F5F5F5; /* Light Gray */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    color: #4CAF50; /* Green */
    text-align: center;
    font-size: 35px;
    margin-bottom: 20px;
}

h2 {
    color: #333;
    text-align: center;
    font-size: 16px;
    margin-bottom: 20px;
    padding: 20px 20px; 
    border-radius: 5px;
    background-color: #E0E0E0; /* Lighter Gray */
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #FFF; /* White */
    margin-top: 20px;
}

th, td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
    background-color: #F9F9F9; /* Off-White */
    color: #333; /* Dark Gray */
}

th {
    background-color: #ECECEC; /* Light Gray */
    font-weight: bold;
}

tr:hover {
    background-color: #f5f5f5; /* Lighter Gray on hover */
}

a {
    text-decoration: none;
    color: #007BFF; /* Royal Blue */
}

a:hover {
    text-decoration: underline;
    color: #0056b3; /* Slightly Darker Blue on hover */
}

</style>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gamboa";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id, fullName, email, password, role, gender, status FROM users";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Show Users</title>
</head>
<body>
<div class="container">
        <h1>All Users</h1>
        <table border="1">
    <tr>
        <th>FullName</th>
        <th>Email</th>
        <th>Password</th>
        <th>Role</th>
        <th>Gender</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['fullName']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['password']) . "</td>";
        echo "<td>" . htmlspecialchars($row['role']) . "</td>";
        echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
        echo '<td>';
        echo '<form action="update_status.php" method="post">';
        echo '<input type="hidden" name="user_id" value="' . $row['id'] . '">';
        echo '<select name="new_status">';
        echo '<option value="active">Active</option>';
        echo '<option value="inactive">Inactive</option>';
        echo '</select>';

        echo '<button type="submit" name="update_status">Update Status</button>';
        echo '</form>';
        echo '</td>';
        echo "</tr>";
    }
    ?>
</table><br>
<h2>This is the members' record and their account info.</h2>
</body>
</html>

<?php
mysqli_close($conn);
?>
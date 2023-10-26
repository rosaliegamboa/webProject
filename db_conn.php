<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gamboa";

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to retrieve data from the table
$sql = "SELECT id, fullName, email, password FROM users";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row["id"] . "<br>";
        echo "Full Name: " . $row["fullName"] . "<br>";
        echo "Email: " . $row["email"] . "<br>";
        echo "Password: " . $row["password"] . "<br>";
    }
} else {
    echo "No records found";
}

// Close the database connection
mysqli_close($conn);
?>

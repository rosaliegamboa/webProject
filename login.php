<?php
session_start();
include_once("dbutil.php");

$username = $_POST["email"];
$password = $_POST["password"];

$conn = getConnection();
$sql = "SELECT * FROM users WHERE email = '".$username."' AND password = '".$password."'";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();

    if ($row["email"] == $username && $row["password"] == $password) {
        if ($row["role"] == "admin") {
            header("Location: admin_home.php");
        } else {
            header("Location: user_home.php");
        }
        $_SESSION["Role"] = $row["Role"];
    } else {
        header("Location: first.html");
    }
} else {
    echo "Error executing SQL query: " . $conn->error;
}

closeConnection($conn);

?>

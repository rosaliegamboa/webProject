<?php
session_start();

include_once("dbutil.php");

$conn = getConnection();

$name = $_POST["name"];
$email = $_POST["email"];
$pass = $_POST["password"];
$role = $_POST["role"];
$gender = $_POST["gender"];

$sql = "INSERT INTO users (fullName, email, password, role, gender)
VALUES ('".$name."', '".$email."', '".$pass."', '".$role."', '".$gender."')";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    header("Location: w3schools.com");
}

closeConnection();
?>

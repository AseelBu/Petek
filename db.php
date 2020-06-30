<?php
$servername = "localhost";
$username = "root";
$password = "";
// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);
$dbName = "Petek";
if (!mysqli_select_db($conn, $dbName)) { // בודק אם מסד הנתונים לא קיים כבר
    $sql = "CREATE DATABASE $dbName";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }
}
$conn = new mysqli($servername, $username, $password, $dbName);
//list
$sql = "SELECT id FROM list";
if (!$conn->query(($sql))) {
    //create table if it doesnt exist
}



$conn->close();

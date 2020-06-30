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
//users list

$sql = "SELECT id FROM Users";
if (!$conn->query(($sql))) {
    //create table if it doesnt exist
    $sql = "CREATE TABLE Users( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    Email Varchar(50) NOT null UNIQUE CHECK (email like '_%@_%._%'), 
    pswrd varchar(20) not null CHECK (length(pswrd)>=5), 
    Nickname varchar(30), 
    phone char(10)check (Phone like '%[0-9]%'and length(Phone)<=10) )";
}
if($conn->query($sql)===TRUE){
    echo "Table Users Created successfully";
}else{
    echo "Error creating table: ".$conn->error;
}

//list
// $sql = "SELECT id FROM list";
// if (!$conn->query(($sql))) {
//     //create table if it doesnt exist
    
// }



$conn->close();

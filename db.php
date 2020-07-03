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
        //  echo "Database created successfully ";
    } else {
        //  echo "Error creating database: " . $conn->error;
    }
}
$conn = new mysqli($servername, $username, $password, $dbName);

//users table creation+insert demo user
$sql = "SELECT id FROM Users";
if (!$conn->query(($sql))) {
    //create table if it doesnt exist
    $sql = "CREATE TABLE Users( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    Email Varchar(50) NOT null UNIQUE CHECK (email like '_%@_%._%'), 
    pswrd varchar(20) not null CHECK (length(pswrd)>=5), 
    Nickname varchar(30), 
    phone varchar(10))";
}
if ($conn->query($sql) === TRUE) {
    $sql = "INSERT INTO `users`(`Email`,`pswrd`) 
                    VALUES ('admin@admin.com','12345')";
    if ($conn->query($sql) === TRUE) {
        //   echo "Table Users Created successfully ".PHP_EOL;
    }
} else {
    //  echo "Error creating table: ".$conn->error;
}

//list table creation
$sql = "SELECT id FROM List";
if (!$conn->query(($sql))) {
    //create table if it doesnt exist
    $sql = "CREATE TABLE List( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name Varchar(50),
    creteTime datetime NOT null  DEFAULT CURRENT_TIMESTAMP)";
}
if ($conn->query($sql) === TRUE) {

    // echo "Table List Created successfully ".PHP_EOL;
} else {
    // echo "Error creating table: ".$conn->error;
}
//product table creation
$sql = "SELECT id FROM Product";
if (!$conn->query(($sql))) {
    //create table if it doesnt exist
    $sql = "CREATE TABLE Product( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    name Varchar(50) NOT null UNIQUE )";
}
if ($conn->query($sql) === TRUE) {
    //  echo "Table Product Created successfully ".PHP_EOL;
} else {
    // echo "Error creating table: ".$conn->error;
}

//ListProducts table creation
$sql = "SELECT id FROM ListProducts";
if (!$conn->query(($sql))) {
    //create table if it doesnt exist
    $sql = "CREATE TABLE ListProducts( ListId INT(6) NOT null REFERENCES List(id),
    ProductId INT(6) NOT null REFERENCES product(id),
    amount int(6) CHECK (amount>=0), 
    done char(1) NOT null CHECK (done='Y' or done='N'),
PRIMARY KEY(ListId,ProductID)                          
)";
}
if ($conn->query($sql) === TRUE) {
    // echo "Table ListProducts Created successfully ".PHP_EOL;
} else {
    // echo "Error creating table: ".$conn->error;
}

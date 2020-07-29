<?php
$servername = "localhost";
$username = "root";
$password = "";
// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);
$dbName = "Petek2";
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
    phone varchar(10),
    familyId INT(6) REFERENCES Family(id) ON DELETE CASCADE ON UPDATE CASCADE
    )";
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

//family table creation
$sql = "SELECT id FROM Family";
if (!$conn->query(($sql))) {
    //create table if it doesnt exist
    $sql = "CREATE TABLE Family( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name Varchar(50) NOT null,
    adminId int(6)  not null UNIQUE REFERENCES FAdmin(id) ON DELETE CASCADE ON UPDATE CASCADE )";
}
if ($conn->query($sql) === TRUE) {

    // echo "Table Family Created successfully ".PHP_EOL;
} else {
     //echo json_encode("Error creating table: ".$conn->error);
}

//family admin table creation
$sql = "SELECT id FROM FAdmin";
if (!$conn->query(($sql))) {
    //create table if it doesnt exist
    $sql = "CREATE TABLE FAdmin( id INT(6) PRIMARY KEY 
    REFERENCES Users(id) ON DELETE CASCADE ON UPDATE CASCADE )";
}
if ($conn->query($sql) === TRUE) {

    // echo "Table FAdmin Created successfully ".PHP_EOL;
} else {
     //echo json_encode("Error creating table: ".$conn->error);
}

//invites table creation
$sql = "SELECT senderId FROM invites";
if (!$conn->query(($sql))) {
    //create table if it doesnt exist
    $sql="CREATE TABLE invites( senderId INT(6)REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE, 
    sendedToId INT(6)REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE, 
    familyId INT(6)REFERENCES family (id) ON DELETE CASCADE ON UPDATE CASCADE, 
    PRIMARY KEY(senderId,sendedToId,familyId)
)";
}
if ($conn->query($sql) === TRUE) {

    // echo "Table invites Created successfully ".PHP_EOL;
} else {
     //echo json_encode("Error creating table: ".$conn->error);
}

//request table creation
$sql = "SELECT id FROM request";
if (!$conn->query(($sql))) {
    //create table if it doesnt exist
    $sql="CREATE TABLE request( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    userId INT(6) NOT null UNIQUE REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE, 
    adminId INT(6) not null REFERENCES fAdmin(id) ON DELETE CASCADE ON UPDATE CASCADE, 
    approved char(1)NOT null DEFAULT 'W' CHECK (approved IN ('Y','N','W'))
 
)";
}
if ($conn->query($sql) === TRUE) {

    // echo "Table request Created successfully ".PHP_EOL;
} else {
     //echo json_encode("Error creating table: ".$conn->error);
}

//list table creation
$sql = "SELECT id FROM List";
if (!$conn->query(($sql))) {
    //create table if it doesnt exist
    $sql = "CREATE TABLE List( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name Varchar(50) NOT null ,
    creteTime datetime NOT null  DEFAULT CURRENT_TIMESTAMP)";
}
if ($conn->query($sql) === TRUE) {

    // echo "Table List Created successfully ".PHP_EOL;
} else {
     //echo json_encode("Error creating table: ".$conn->error);
}

// create Users' Lists
$sql = "SELECT listId FROM userLists";
if (!$conn->query(($sql))) {
    //create table if it doesnt exist
    $sql = "CREATE TABLE userLists( listId INT(6) NOT null REFERENCES List(id) ON DELETE CASCADE ON UPDATE CASCADE,
    userId INT(6) NOT null REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
PRIMARY KEY(listId, userId)                          
)";
}
if ($conn->query($sql) === TRUE) {
    // echo "Table ListProducts Created successfully ".PHP_EOL;
} else {
     //echo json_encode("Error creating table: ".$conn->error);
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
     //echo json_encode("Error creating table: ".$conn->error);
}

//ListProducts table creation
$sql = "SELECT ListId FROM ListProducts";
if (!$conn->query(($sql))) {
    //create table if it doesnt exist
    $sql = "CREATE TABLE ListProducts( ListId INT(6) NOT null REFERENCES List(id) ON DELETE CASCADE ON UPDATE CASCADE,
    ProductId INT(6) NOT null REFERENCES product(id) ON DELETE CASCADE ON UPDATE CASCADE,
    amount int(6) CHECK (amount>=0), 
    done char(1) NOT null CHECK (done='Y' or done='N'),
PRIMARY KEY(ListId,ProductID)                          
)";
}
if ($conn->query($sql) === TRUE) {
    // echo "Table ListProducts Created successfully ".PHP_EOL;
} else {
     //echo json_encode("Error creating table: ".$conn->error);
}

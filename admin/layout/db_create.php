<?php 
require("./db.php");

$sql = "CREATE TABLE IF NOT EXISTS staff (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(500) NOT NULL,
    mobile VARCHAR(500) NOT NULL UNIQUE,
    email VARCHAR(500) NOT NULL UNIQUE,
    password VARCHAR(500) NOT NULL,
    dept VARCHAR(500) NOT NULL,
    sem VARCHAR(500) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Staff created successfully<br>";
} else {
    echo "Error creating table: Staff";
}

$sql = "CREATE TABLE IF NOT EXISTS student (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    reg VARCHAR(500) NOT NULL,
    name VARCHAR(500) NOT NULL,
    mobile VARCHAR(500) NOT NULL UNIQUE,
    dept VARCHAR(500) NOT NULL,
    year VARCHAR(500) NOT NULL,
    sem VARCHAR(500) NOT NULL,
    batch VARCHAR(500) NOT NULL,
    gender VARCHAR(500) NOT NULL,
    email VARCHAR(500) NOT NULL UNIQUE,
    dob VARCHAR(500) NOT NULL,
    fname VARCHAR(500) NOT NULL,
    mname VARCHAR(500) NOT NULL,
    address VARCHAR(500) NOT NULL,
    pmobile VARCHAR(500) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Student created successfully<br>";
} else {
    echo "Error creating table: Student";
}

$sql = "CREATE TABLE IF NOT EXISTS attendance (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    reg VARCHAR(500) NOT NULL,
    date VARCHAR(500) NOT NULL,
    status VARCHAR(500) NOT NULL,
    reason VARCHAR(500) NOT NULL,
    sem VARCHAR(500) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Attendance created successfully<br>";
} else {
    echo "Error creating table: Attendance";
}


$sql = "CREATE TABLE IF NOT EXISTS result (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    sem VARCHAR(500) NOT NULL,
    reg VARCHAR(500) NOT NULL,
    type VARCHAR(500) NOT NULL,
    data JSON NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Result created successfully<br>";
} else {
    echo "Error creating table: Result";
}
?>
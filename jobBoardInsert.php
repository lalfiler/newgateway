<?php

$link = mysqli_connect("localhost", "root", "", "job_board_db");
 

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

$sql = "CREATE TABLE jobseekers(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    lastName VARCHAR(277) NOT NULL,
    firstName VARCHAR(277) NOT NULL,
    Email VARCHAR(277) NOT NULL,
    userName VARCHAR(277) NOT NULL,
    password VARCHAR(40) NOT NULL,
    LinkedIn VARCHAR(277) NOT NULL,
    Address VARCHAR(277) NOT NULL,
    City VARCHAR(277) NOT NULL,
    State VARCHAR(277) NOT NULL,
    zip VARCHAR(30) NOT NULL,
    Telephone VARCHAR(277) NOT NULL
)";
if(mysqli_query($link, $sql)){
    echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 

mysqli_close($link);
?>
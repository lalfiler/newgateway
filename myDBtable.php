<?php

$link = mysqli_connect("localhost", "root", "", "job_board_db");
 

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

$sql = "CREATE TABLE persons(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    email VARCHAR(70) NOT NULL UNIQUE,
    phone_number VARCHAR(30) NOT NULL
)";
if(mysqli_query($link, $sql)){
    echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 

mysqli_close($link);
?>
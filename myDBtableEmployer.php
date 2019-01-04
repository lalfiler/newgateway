<?php

$link = mysqli_connect("localhost", "root", "", "job_board_db");
 

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

$sql = "CREATE TABLE employers(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";
if(mysqli_query($link, $sql)){
    echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 

mysqli_close($link);
?>
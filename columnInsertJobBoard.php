<?php

$link = mysqli_connect("localhost", "root", "", "job_board_db");
 

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sql = "ALTER TABLE employers ADD COLUMN JobTitle VARCHAR(200) AFTER Telephone"; 
if(mysqli_query($link, $sql)){
    echo "Column inserted successfully.";
  
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
mysqli_close($link);
?>
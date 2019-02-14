<?php

$link = mysqli_connect("localhost", "root", "", "job_board_db");
 
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

ALTER TABLE persons ADD Address VARCHAR(50) NOT NULL;


if(mysqli_query($link, $sql)){
    echo "column added successfully.";

} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

mysqli_close($link);
?>

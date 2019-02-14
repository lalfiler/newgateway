<?php

$link = mysqli_connect("localhost", "root", "", "mynewtest");
 

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

$sql = "INSERT INTO persons (first_name, last_name, email, phone_number) VALUES ('jordany', 'Collado', 'jordy@swccd.edu', '629-998-7854')";
if(mysqli_query($link, $sql)){
    echo "Records inserted successfully.";
  
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
mysqli_close($link);
?>
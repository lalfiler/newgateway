<?php

$link = mysqli_connect("localhost", "root", "", "job_board_db");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$email = $_POST["email"];
$password = $_POST["password"];

printf("the email is %u and the password is %f.", $email, $password);

$sqlEmployers = "SELECT * from 'employers' WHERE 'email'='$email' AND 'password'='$password'";
$sqlJobSeekers = "SELECT * from 'jobseekers' WHERE 'email'='$email' AND 'password' = '$password'";

$resultEmployers = mysqli_query($link, $sqlEmployers);
$resultJobSeekers = mysqli_query($link, $sqlJobSeekers);

$rowCountEmployers = mysqli_num_rows($resultEmployers);
$rowCountJobSeekers = mysqli_num_rows($resultJobSeekers);

if($resultEmployers){
header('Location: employers-dashboard.html');

}elseif($resultJobSeekers){
header('location: job-seekers-dashboard.html');

}else{

echo "You have entered an Incorrect Password";
exit();


}


?>
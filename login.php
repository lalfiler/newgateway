<?php

$link = mysqli_connect("localhost", "root", "", "job_board_db");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$email = $_POST["email"];
$password = hash('sha256', $_POST["password"]);

$result = "SELECT * from employers WHERE email = '".$email."' AND password = '".$password."' limit 1";
$row = mysqli_query($link, $result);

$result2 = "SELECT * from jobseekers WHERE email = '".$email."' AND password = '".$password."' limit 1";
$r = mysqli_query($link, $result2);

if(mysqli_num_rows($row) == 1){
header('Location: employers-dashboard.html');
echo "Welcome to the Employer Portal";
exit;

}elseif(mysqli_num_rows($r) == 1){
header('location: job-seekers-dashboard.html');
echo "Welcome to the Job Seeker Portal";
exit;

}else{
header('location: login-fail.html');
exit();


}


?>
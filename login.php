<?php
//include_once 'accesscontrol.php';

echo "<script>console.log('omg what')</script>";


$link = mysqli_connect("localhost", "root", "", "job_board_db");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$email = $_POST["email"];
$password = hash('sha256', $_POST["password"]);

$result_employers = "SELECT * from employers WHERE email = '".$email."' AND password = '".$password."' limit 1";
$row_employers = mysqli_query($link, $result_employers);

$result_jobseekers = "SELECT * from jobseekers WHERE email = '".$email."' AND password = '".$password."' limit 1";
$row_jobseekers = mysqli_query($link, $result_jobseekers);

echo "<script>console.log('Hello! ')</script>";

if(mysqli_num_rows($row_employers) == 1){
header('Location: employers-dashboard.html');
echo "Welcome to the Employer Portal";
echo "<script>console.log('Hello! ')</script>";
exit;

}elseif(mysqli_num_rows($row_jobseekers) == 1){
header('location: job-seekers-dashboard.html');
echo "Welcome to the Job Seeker Portal";
echo "<script> console.log('Hello, " . $email . "! ')</script>";
exit;

}else{
header('location: login-fail.html');
exit();


}


?>
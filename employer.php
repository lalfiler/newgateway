<?php

$link = mysqli_connect("localhost", "root", "", "job_board_db");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$company = mysqli_real_escape_string($link, $_REQUEST['company']);
$website = mysqli_real_escape_string($link, $_REQUEST['website']);
$linkedIn = mysqli_real_escape_string($link, $_REQUEST['linkedIn']);
$address = mysqli_real_escape_string($link, $_REQUEST['address']);
$city = mysqli_real_escape_string($link, $_REQUEST['city']);
$state = mysqli_real_escape_string($link, $_REQUEST['state']);
$zip = mysqli_real_escape_string($link, $_REQUEST['zip']);
$telephone = mysqli_real_escape_string($link, $_REQUEST['telephone']);
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$userName = mysqli_real_escape_string($link, $_REQUEST['userName']);
$password = mysqli_real_escape_string($link, $_REQUEST['password']);

// Attempt insert query execution
$passwordHash = hash('sha256', $password);
$sql = "INSERT INTO employers (companyName, website, linkedIn, address, city, state, zip, telephone, email, userName, password) 
VALUES ('$company', '$website', '$linkedIn', '$address', '$city', '$state', '$zip', '$telephone', '$email', '$userName', '$passwordHash')";
if(mysqli_query($link, $sql)){
	session_start();
	$_SESSION['email'] = $email;
    header('location: employers-dashboard.php');
	exit();
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);

?>



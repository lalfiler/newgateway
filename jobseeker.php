<?php

$link = mysqli_connect("localhost", "root", "", "job_board_db");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$firstName = mysqli_real_escape_string($link, $_REQUEST["firstName"]);
$lastName = mysqli_real_escape_string($link, $_REQUEST['lastName']);
$Address = mysqli_real_escape_string($link, $_REQUEST['Address']);
$City = mysqli_real_escape_string($link, $_REQUEST['City']);
$State = mysqli_real_escape_string($link, $_REQUEST['State']);
$zip = mysqli_real_escape_string($link, $_REQUEST['zip']);
$Telephone = mysqli_real_escape_string($link, $_REQUEST['Telephone']);
$Email = mysqli_real_escape_string($link, $_REQUEST['Email']);
$userName = mysqli_real_escape_string($link, $_REQUEST['userName']);
$password = mysqli_real_escape_string($link, $_REQUEST['password']);
$LinkedIn = mysqli_real_escape_string($link, $_REQUEST['LinkedIn']);
 
// Attempt insert query execution
$passwordHash = hash('sha256', $password);
$sql = "INSERT INTO jobseekers (firstName, lastName, Address, City, State, zip, Telephone, Email, userName, password, LinkedIn) 
VALUES ('$firstName', '$lastName', '$Address', '$City', '$State', '$zip', '$Telephone', '$Email', '$userName', '$passwordHash', '$LinkedIn')";
if(mysqli_query($link, $sql)){
    header('Location: job-seekers-dashboard.html');
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);


?>
<?php
session_start();
$email = $_SESSION['email'];
echo "<script> console.log('Hello, " . $email . "! ')</script>";

$link = mysqli_connect("localhost", "root", "", "job_board_db");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Grab company from database
$companyID_object = mysqli_query($link, "SELECT id from employers WHERE email = '".$email."'");
$companyID = (mysqli_fetch_row($companyID_object))[0];
echo "<script> console.log('companyID is: " . $companyID . "!')</script>";

// Escape user inputs for security
$contactEmail = mysqli_real_escape_string($link, $_REQUEST['contactEmail']);
$address = mysqli_real_escape_string($link, $_REQUEST['address']);
$city = mysqli_real_escape_string($link, $_REQUEST['city']);
$state = mysqli_real_escape_string($link, $_REQUEST['state']);
$zip = mysqli_real_escape_string($link, $_REQUEST['zip']);
$jobTitle = mysqli_real_escape_string($link, $_REQUEST['jobTitle']);
$positionType = mysqli_real_escape_string($link, $_REQUEST['positionType']);
$experienceLevel = mysqli_real_escape_string($link, $_REQUEST['experienceLevel']);
$category = mysqli_real_escape_string($link, $_REQUEST['category']);
$salary = mysqli_real_escape_string($link, $_REQUEST['salary']);
$website = mysqli_real_escape_string($link, $_REQUEST['website']);
$jobDescription = mysqli_real_escape_string($link, $_REQUEST['jobDescription']);

// Attempt insert query execution
$sql = "INSERT INTO postajob (companyID, address, city, state, zip, jobTitle, positionType, experienceLevel, category, salary, website, jobDescription) 
VALUES ('$companyID', '$address', '$city', '$state', '$zip', '$jobTitle', '$positionType', '$experienceLevel', '$category', '$salary', '$website', '$jobDescription')";

if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
	header('location: myjobs.php');
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);

?>


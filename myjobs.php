<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My Jobs</title>
    <link rel="stylesheet" href="css/job-posting.css" type="text/css">
</head>
<body>
    <a href="https://newgateway.org/"><img src="images/logo.JPG" alt="logo" class="logo"></a>
    <h1>My Jobs</h1>

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

// Find company's jobs in database
$query = mysqli_query($link, "SELECT * FROM postajob WHERE companyID = '".$companyID."'");
$num_rows = mysqli_num_rows($query);
//$link->close();

echo "<b>
</b>
<br>
<br>";
while ($row = mysqli_fetch_assoc($query) ){
$jobTitle = $row['jobTitle'];
$experienceLevel = $row['experienceLevel'];
echo "<b>
$jobTitle <a href='#'>Edit This Job</a><br>
$experienceLevel <a href='#'>Delete This Job</a></b>
<hr>
<br>
<br>";
}
?>

    <footer>
        <p>&copy; 2018 New GateWay Solutions Corporation</p>
    </footer>
</body>
</html>
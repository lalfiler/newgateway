<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "job_board_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_POST['employer_email'];
$password = hash('sha256', $_POST['employer_password']);


$sql = "INSERT INTO Employers (email, password)
VALUES ('$email', '$password')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
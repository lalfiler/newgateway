<?php

 
try {
	//include_once 'accesscontrol.php';
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
		
    // get record ID
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
    // delete query
    $query = "DELETE FROM events WHERE id = '" .$id. "'";
    $stmt = $link->prepare($query);
     
    if($stmt->execute()){
        // redirect to read records page and 
        // tell the user record was deleted
        header('Location: myevents.php?action=deleted');
    }else{
        die('Unable to delete record.');
    }
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
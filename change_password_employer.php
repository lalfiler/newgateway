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
			
	/*
	if ($error_message != '') {
		echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $error_message . '</div>';
	};
	if ($success_message != '') {
		echo '<div class="alert alert-success"><strong>Success: </strong> ' . $success_message . '</div>';
	};
	*/

	$oldPassword = $_POST['oldPassword'];
	$newPassword = $_POST['newPassword'];
	$newPasswordConfirm = $_POST['newPasswordConfirm'];
	
	$oldPasswordHashed = hash('sha256', $oldPassword);
	$query = "SELECT password FROM employers WHERE email = '" . $email . "'";
	$oldPasswordDB_object = mysqli_query($link, $query);
	$oldPasswordDB = (mysqli_fetch_row($oldPasswordDB_object))[0];
	
	if ($oldPasswordHashed == $oldPasswordDB){
		echo "<script> console.log('passwords match!');</script>";
		if ($newPassword == $newPasswordConfirm){
			echo "<script> console.log('NEW passwords match! update database!');</script>";
			$newPasswordHashed = hash("sha256", $newPassword);
			$query = "UPDATE employers SET password='" . $newPasswordHashed . "' WHERE email ='" . $email . "'";
			
			$stmt = $link->prepare($query);
			
			if($stmt->execute()){
				echo "Success! Password has been updated";
			}else {
				echo "Unable to update password. Please try again.";
			};
		} else {
			echo "<script> console.log('NEW passwords DO NOT match!');</script>";
			echo "New password entered does not match new password confirmation. Please try again";
		}
	} else {
		echo "<script> console.log('passwords DO NOT match!');</script>";
		echo "Old Password entered does not match our records.  Please try again";
	};

?>
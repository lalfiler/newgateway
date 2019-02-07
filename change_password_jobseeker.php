<?php
	session_start();
	$email = $_SESSION['email'];
	
	$link = mysqli_connect("localhost", "root", "", "job_board_db");

	// Check connection
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}

	// Grab company from database
	$jobSeekerID_object = mysqli_query($link, "SELECT id from jobseekers WHERE email = '".$email."'");
	$jobSeekerID = (mysqli_fetch_row($jobSeekerID_object))[0];
			
	$oldPassword = $_POST['oldPassword'];
	$newPassword = $_POST['newPassword'];
	$newPasswordConfirm = $_POST['newPasswordConfirm'];
	
	$oldPasswordHashed = hash('sha256', $oldPassword);
	$query = "SELECT password FROM jobseekers WHERE email = '" . $email . "'";
	$oldPasswordDB_object = mysqli_query($link, $query);
	$oldPasswordDB = (mysqli_fetch_row($oldPasswordDB_object))[0];
	
	if ($oldPasswordHashed == $oldPasswordDB){
		if ($newPassword == $newPasswordConfirm){
			$newPasswordHashed = hash("sha256", $newPassword);
			$query = "UPDATE jobseekers SET password='" . $newPasswordHashed . "' WHERE email ='" . $email . "'";
			
			$stmt = $link->prepare($query);
			
			if($stmt->execute()){
				header('location: job-seekers-dashboard.php?status=password');
			}else {
				echo "Unable to update password. Please try again.";
			};
		} else {
			header('location: edit_password_jobseeker.php?status=new-nomatch');
		}
	} else {
		header('location: edit_password_jobseeker.php?status=old-nomatch');

	};

?>
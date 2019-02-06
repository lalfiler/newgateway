<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit My Password</title>
    <link rel="stylesheet" href="css/job-posting.css" type="text/css">
</head>
<body>
 
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Change Password</h1>
        </div>
         
		<?php
		
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
			$jobSeekerID_object = mysqli_query($link, "SELECT id from jobseekers WHERE email = '".$email."'");
			$jobSeekerID = (mysqli_fetch_row($jobSeekerID_object))[0];
			echo "<script> console.log('companyID is: " . $jobSeekerID . "!')</script>";
					
		?>
 
		<form method="POST" action="change_password_jobseeker.php" id="form">
			<div>
				<label for="oldPassword">Old Password:</label>
				<br>
				<input type="text" id="oldPassword" name="oldPassword">
			</div>
			<div>
				<label for="newPassword">New Password:</label>
				<br>
				<input type="text" id="newPassword" name="newPassword">
			</div>
			<div>
				<label for="newPasswordConfirm">Confirm New Password:</label>
				<br>
				<input type="text" id="newPasswordConfirm" name="newPasswordConfirm">
			</div>
			<div>
				<input type="submit" id="submit" class="submit">
			</div>
		</form>
 
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>
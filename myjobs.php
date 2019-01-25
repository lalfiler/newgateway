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

	$action = isset($_GET['action']) ? $_GET['action'] : "";
	
	// if it was redirected from delete.php
	if($action=='deleted'){
		echo "<div class='alert alert-success'>Job post was successfully deleted.</div>";
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
		$jobID = $row['id'];
		echo "<b>
		$jobTitle <a href='job.php?id={$jobID}'>View This Job</a><br>
		$experienceLevel <a href='update_job_post.php?id={$jobID}'>Edit This Job</a><br>";
		echo "<a href='#' onclick='delete_job({$jobID});' class='btn btn-danger'>Delete This Job</a></b>
		<hr>
		<br>
		<br>";
	}
?>

<script type="text/javascript">
	function delete_job(id){
		console.log("delete_job is running!");
		var confirmation = confirm("Are you sure you want to delete this job posting?");
		if(confirmation){
			window.location = 'delete_job_post.php?id=' + id;
		}
	}
</script>

    <footer>
        <p>&copy; 2018 New GateWay Solutions Corporation</p>
    </footer>
</body>
</html>
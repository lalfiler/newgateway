<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My Events</title>
    <link rel="stylesheet" href="css/job-list.css" type="text/css">
</head>
<body>
    <a href="https://newgateway.org/"><img src="images/logo.JPG" alt="logo" class="logo"></a>
    <h1>My Events</h1>
	
	<form action="employers-dashboard.php">
		<input type="submit" class="button" value="Back to Dashboard" style="width:100%">
	</form>

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
	
	// if it was redirected from a delete action
	if($action=='deleted'){
		echo "<div class='alert alert-success'>Event was successfully deleted.</div>";
	};
	
	// Grab company from database
	$companyID_object = mysqli_query($link, "SELECT id from employers WHERE email = '".$email."'");
	$companyID = (mysqli_fetch_row($companyID_object))[0];
	echo "<script> console.log('companyID is: " . $companyID . "!')</script>";

	// Find company's jobs in database
	$query = mysqli_query($link, "SELECT * FROM events WHERE companyID = '".$companyID."'");
	$num_rows = mysqli_num_rows($query);
	//$link->close();
	
	echo "<b>
	</b>
	<br>
	<br>";
	while ($row = mysqli_fetch_assoc($query) ){
		$title = $row['title'];
		$date = $row['date'];
		$time = $row['timeStart'];
		$eventID = $row['id'];
		echo "<b>
		$title
		<br>
		$date 
		<br>
		$time
		<br>
		<a href='event.php?id={$eventID}' class='button'>View Event</a>
		<br>
		<a href='update_event.php?id={$eventID}' class='button'>Edit Event</a>
		<br>
		<a href='#' onclick='delete_event({$eventID});' class='button'>Delete Event</a></b>
		<hr>
		<br>";
	}
?>

<script type="text/javascript">
	function delete_event(id){
		console.log("delete_job is running!");
		var confirmation = confirm("Are you sure you want to delete this event?");
		if(confirmation){
			window.location = 'delete_event.php?id=' + id;
		}
	}
</script>

    <footer>
        <p>&copy; 2018 New GateWay Solutions Corporation</p>
    </footer>
</body>
</html>
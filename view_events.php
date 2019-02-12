<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Upcoming Events</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/job-posting.css" type="text/css">
</head>
<body>
    <a href="https://newgateway.org/"><img src="images/logo.JPG" alt="logo" class="logo"></a>
	
	<form action="job-seekers-dashboard.php">
		<input type="submit" class="button" value="Back to Dashboard" style="width:100%">
	</form>
	
    <h1>Upcoming Events</h1>
	
<?php
   $link = mysqli_connect("localhost", "root", "", "job_board_db");

	// Check connection
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	$query = mysqli_query($link, "SELECT * FROM events");
	$num_rows = mysqli_num_rows($query);
	
	echo "
	<br>
	<br>
	<table class='table table-hover table-responsive table-bordered' style='background-color: rgba(238,238,238,.8)'>";
	echo "<tr>";
		echo "<th>Event Title</th>";
		echo "<th>Host Company</th>";
		echo "<th>Date</th>";
		echo "<th>Time</th>";
		echo "<th>Action</th>";
	echo "</tr>";
	while ($row = mysqli_fetch_assoc($query) ){
		$title = $row['title'];
		$date = $row['date'];
		$time = $row['timeStart'];
		$eventID = $row['id'];
		//grab company name from database
		$companyID = $row['companyID'];
		$queryEmployers = mysqli_query($link, "SELECT * FROM employers WHERE id ='" .$companyID . "'");
		$assoc = mysqli_fetch_assoc($queryEmployers);
		$company = $assoc['companyName'];
		echo "
		<tr>
			<td><strong>$title</strong></td>
			<td>$company</td>
			<td>$date</td>
			<td>$time</td>
			<td>
				<a href='view_event.php?id={$eventID}' class='btn btn-info m-r-1em'>View Event Details</a>
			</td>
		</tr>
		";
	}
?>
<!--
    <footer>
        <p>&copy; 2018 New GateWay Solutions Corporation</p>
    </footer>
-->
</body>
</html>
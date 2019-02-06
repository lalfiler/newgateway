<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Upcoming Events</title>
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
	
	echo "<b>
	</b>
	<br>
	<br>";
	while ($row = mysqli_fetch_assoc($query) ){
		$title = $row['title'];
		$date = $row['date'];
		$time = $row['timeStart'];
		$eventID = $row['id'];
		if(strtotime($date) >= time()) {
			// date is in the future or present
			echo "<b>
			$title
			<br>
			$date 
			<br>
			$time
			<br>
			<a href='view_event.php?id={$eventID}' class='button'>View Event</a>
			<hr>
			<br>";
		};
	}
?>

    <footer>
        <p>&copy; 2018 New GateWay Solutions Corporation</p>
    </footer>
</body>
</html>
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
		<input type="submit" class="button" value="Back to Dashboard" style="width:100%; font-size: 130%">
	</form>
	
    <h1>Upcoming Events</h1>
	
<?php
   $link = mysqli_connect("localhost", "root", "", "job_board_db");

	// Check connection
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	
	$records_per_page = 5;
	
	if( isset($_GET{'page'} ) ) {
		$page = $_GET{'page'};
		$next_page = $page + 1;
		$offset = $records_per_page * ($page - 1) ;
	}else {
		$next_page = 2;
		$offset = 0;
		$page= 1;
	}; 
	
	$query = mysqli_query($link, "SELECT count(id) FROM events WHERE date >= CURDATE()");
	
	$row = mysqli_fetch_array($query, MYSQLI_NUM );
	$record_count = $row[0];
	$records_left = $record_count - ($records_per_page * ($page - 1));
	
	$sql = ("SELECT * FROM events WHERE date >= CURDATE() ORDER BY date LIMIT $offset, $records_per_page");
	$result = $link->query($sql);
	
	if ($result->num_rows > 0){
		
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
		while ($row = $result->fetch_assoc() ){
			$title = $row['title'];
			$companyID = $row['companyID'];
			$date = $row['date'];
			$time = $row['timeStart'];
			$eventID = $row['id'];
			
			//determine company event belongs to
			$query = mysqli_query($link, "SELECT companyName FROM employers WHERE id='" . $companyID . "'");
			$companyName = (mysqli_fetch_row($query))[0];
			
			
			echo "
			<tr>
				<td><strong>$title</strong></td>
				<td>$companyName</td>
				<td>$date</td>
				<td>$time</td>
				<td>
					<a href='view_event.php?id={$eventID}' class='btn btn-info m-r-1em'>View Event Details</a>
				</td>
			</tr>
			";
		};
		echo "</table>";
		
		if(!(($next_page == 2) && ($record_count <= $records_per_page))){ //this is not the only page
			if( $next_page == 2 ) { //this is the first page
				echo "<a href = \"view_events.php?page=2\" class='btn btn-primary m-r-1em'>Next 5 Events</a>";
			}else if( $records_left <= $records_per_page) { //this is the last page
				$last = $next_page - 2;
				echo "<a href = \"view_events.php?page=$last\" class='btn btn-primary m-r-1em'>Last 5 Events</a>";
			 }else { //there are pages both before and after this one
				$last = $next_page - 2;
				echo "<a href = \"view_events.php?page=$last\" class='btn btn-primary m-r-1em'>Last 5 Events</a> |";
				echo "<a href = \"view_events.php?page=$next_page\" class='btn btn-primary m-r-1em'>Next 5 Events</a>";
			 };
		};
	}
?>
    <footer>
        <p>&copy; 2019 New GateWay Solutions Corporation</p>
    </footer>
</body>
</html>
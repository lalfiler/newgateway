<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My Events</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/job-list.css" type="text/css">
</head>
<body>
    <a href="https://newgateway.org/"><img src="images/logo.JPG" alt="logo" class="logo"></a>
    <h1>My Events</h1>
	
	<form action="employers-dashboard.php">
		<input type="submit" class="button" value="Back to Dashboard" style="width:100%; font-size: 130%">
	</form>

<?php
	session_start();
	$email = $_SESSION['email'];

	$link = mysqli_connect("localhost", "root", "", "job_board_db");
	 
	// Check connection
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}

	$action = isset($_GET['action']) ? $_GET['action'] : "";
	
	//set pagination variables
	$records_per_page = 5;
	
	if( isset($_GET{'page'} ) ) {
		$page = $_GET{'page'};
		$next_page = $page + 1;
		$offset = $records_per_page * ($page - 1);
	}else {
		$next_page = 2;
		$offset = 0;
		$page= 1;
	}; 
	
	// Grab company from database
	$companyID_object = mysqli_query($link, "SELECT id from employers WHERE email = '".$email."'");
	$companyID = (mysqli_fetch_row($companyID_object))[0];
	
	$query = mysqli_query($link, "SELECT count(id) FROM events WHERE companyID = '".$companyID."'");
	
	$row = mysqli_fetch_array($query, MYSQLI_NUM );
	$record_count = $row[0];
	$records_left = $record_count - ($records_per_page * ($page - 1));
	
	// if it was redirected from a delete action
	if($action=='deleted'){
		echo "<div class='alert alert-success'>Event was successfully deleted.</div>";
	};
	
	// Find company's events in database
	$query = mysqli_query($link, "SELECT * FROM events WHERE companyID = '".$companyID."' LIMIT $offset, $records_per_page");
	$num_rows = mysqli_num_rows($query);
	
	if ($num_rows > 0){
		echo "
		<br>
		<br>
		<table class='table table-hover table-responsive table-bordered' style='background-color: rgba(238,238,238,.8)'>";
		echo "<tr>";
			echo "<th>Event Title</th>";
			echo "<th>Date</th>";
			echo "<th>Time</th>";
			echo "<th>Action</th>";
		echo "</tr>";
		while ($row = mysqli_fetch_assoc($query) ){
			$title = $row['title'];
			$date = $row['date'];
			$time = $row['timeStart'];
			$eventID = $row['id'];
			echo "
			<tr>
				<td><strong>$title</strong></td>
				<td>$date</td>
				<td>$time</td>
				<td>
					<a href='event.php?id={$eventID}' class='btn btn-info m-r-1em'>View Event</a>
					<a href='update_event.php?id={$eventID}' class='btn btn-primary m-r-1em'>Edit Event</a>
					<a href='#' onclick='delete_event({$eventID});' class='btn btn-danger'>Delete Event</a>
				</td>
			</tr>
			";
		};
		echo "</table>";
		
		if(!(($next_page == 2) && ($record_count <= $records_per_page))){ //this is not the only page
			if( $next_page == 2 ) { //this is the first page
				echo "<a href = \"myevents.php?page=2\" class='btn btn-primary m-r-1em'>Next</a>";
			}else if( $records_left <= $records_per_page) { //this is the last page
				$last = $next_page - 2;
				echo "<a href = \"myevents.php?page=$last\" class='btn btn-primary m-r-1em'>Previous</a>";
			 }else { //there are pages both before and after this one
				$last = $next_page - 2;
				echo "<a href = \"myevents.php?page=$last\" class='btn btn-primary m-r-1em'>Previous</a> |";
				echo "<a href = \"myevents.php?page=$next_page\" class='btn btn-primary m-r-1em'>Next</a>";
			 };
		};
	}
?>

<script type="text/javascript">
	function delete_event(id){
		var confirmation = confirm("Are you sure you want to delete this event?");
		if(confirmation){
			window.location = 'delete_event.php?id=' + id;
		}
	}
</script>
<br>
<br>
<br>
<br>
    <footer>
        <p>&copy; 2019 New GateWay Solutions Corporation</p>
    </footer>
</body>
</html>
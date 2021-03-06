<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>View My Event</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/job-posting.css" type="text/css">
</head>
<body>
         
		<?php
		
			//include_once 'accesscontrol.php';
			session_start();
			$email = $_SESSION['email'];
			
			$link = mysqli_connect("localhost", "root", "", "job_board_db");
	 
			// Check connection
			if($link === false){
				die("ERROR: Could not connect. " . mysqli_connect_error());
			}

			// Grab company from database
			$companyID_object = mysqli_query($link, "SELECT id from employers WHERE email = '".$email."'");
			$companyID = (mysqli_fetch_row($companyID_object))[0];
					
			// get passed parameter value, in this case, the record ID
			// isset() is a PHP function used to verify if a value is there or not
			$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
			
			//verify the correct company is viewing the job
			$jobCompany_object = mysqli_query($link, "SELECT companyID from events WHERE id= '" . $id . "' LIMIT 1 ");
			$jobCompany = (mysqli_fetch_row($jobCompany_object))[0];
			
			if ($jobCompany != $companyID){
				echo "ERROR: Record ID not found";
				exit;
			};
			 
			// read current record's data
			// prepare select query
			$query = mysqli_query($link, "SELECT * FROM events WHERE id = '" . $id . "' LIMIT 1");
			$row = mysqli_fetch_assoc($query);
		 
			$eventTitle = $row['title'];
			$date = $row['date'];
			$timeStart = $row['timeStart'];
			$timeEnd = $row['timeEnd'];
			$address = $row['address'];
			$city = $row['city'];
			$state = $row['state'];
			$zip = $row['zip'];
			$website = $row['website'];
			$description = $row['description'];
			$contactEmail = $row['email'];
			 
		?>
		
	 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Event Details</h1>
			<form action="employers-dashboard.php">
				<input type="submit" class="button" value="Back to Dashboard" style="width:100%; font-size:130%">
			</form>
        </div>
		
		<div style="margin-right: auto">
			<a href='update_event.php?id=<?php echo $id ?>' class='btn btn-primary m-r-1em'>Edit This Event</a>
			<a href='#' onclick='delete_event(<?php echo $id ?>);' class='btn btn-danger'>Delete This Event</a>
		</div>
 
        <table style="margin-left:auto; margin-right:auto; background-color: rgba(238, 238, 238, .8)">
			<tr>
				<td style="width:15%">Title</td>
				<td><strong><?php echo htmlspecialchars($eventTitle, ENT_QUOTES);  ?></strong></td>
			</tr>
			<br>
			<tr>
				<td style="width:15%">Date</td>
				<td><strong><?php echo htmlspecialchars($date, ENT_QUOTES);  ?></strong></td>
			</tr>
			<br>
			<tr>
				<td style="width:15%">Event Start Time</td>
				<td><strong><?php echo htmlspecialchars($timeStart, ENT_QUOTES);  ?></strong></td>
			</tr>
			<br>
			<tr>
				<td style="width:15%">Event End Time</td>
				<td><strong><?php echo htmlspecialchars($timeEnd, ENT_QUOTES);  ?></strong></td>
			</tr>
			<br>
			<tr>
				<td style="width:15%">Location</td>
				<td><strong><?php echo htmlspecialchars($address) . ", " . htmlspecialchars($city) . ", " . htmlspecialchars($state); ?></strong></td>
			</tr>
			<br>
			<tr>
				<td>Description</td>
			</tr>
			<tr>
				<td></td>
				<td><strong><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></strong></td>
			</tr>
			<tr>
				<td>Contact Email</td>
				<td><strong><?php echo htmlspecialchars($contactEmail, ENT_QUOTES);  ?></strong></td>
			</tr>
			<br>
			<tr>
				<td style="width:15%">Website</td>
				<td><strong><?php echo htmlspecialchars($website, ENT_QUOTES);  ?></strong></td>
			</tr>
		</table>
 
    </div> <!-- end .container -->
	
<script type="text/javascript">
	function delete_event(id){
		var confirmation = confirm("Are you sure you want to delete this event?");
		if(confirmation){
			window.location = 'delete_event.php?id=' + id;
		}
	}
</script>
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<footer>
     <p>&copy; 2019 New GateWay Solutions Corporation</p>
</footer>
 
</body>
</html>
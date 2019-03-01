<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>View Event</title>
    <link rel="stylesheet" href="css/job-posting.css" type="text/css">
</head>
<body>
 
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Event Details</h1>
			
			<form action="job-seekers-dashboard.php">
				<input type="submit" class="button" value="Back to Dashboard" style="width:100%">
			</form>
        </div>
         
		<?php
		
			//include_once 'accesscontrol.php';
			session_start();
			$email = $_SESSION['email'];
			
			$link = mysqli_connect("localhost", "root", "", "job_board_db");
	 
			// Check connection
			if($link === false){
				die("ERROR: Could not connect. " . mysqli_connect_error());
			}

			// get passed parameter value, in this case, the record ID
			// isset() is a PHP function used to verify if a value is there or not
			$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
			
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
			
			//grab the associated company name from database
			$companyID = $row['companyID'];
			$queryCompany = mysqli_query($link, "SELECT * FROM employers WHERE id ='" .$companyID . "'");
			$assoc = mysqli_fetch_assoc($queryCompany);
			$company = $assoc['companyName'];
		?>
 
        <table style="margin-left:auto; margin-right:auto; background-color: rgba(238, 238, 238, .8)">
			<tr>
				<td style="width:15%">Title</td>
				<td><strong><?php echo htmlspecialchars($eventTitle, ENT_QUOTES);  ?></strong></td>
			</tr>
			<br>
			<tr>
				<td style="width:15%">Host Company</td>
				<td><strong><?php echo htmlspecialchars($company, ENT_QUOTES);  ?></strong></td>
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
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<footer>
        <p>&copy; 2019 New GateWay Solutions Corporation</p>
    </footer>
 
</body>
</html>
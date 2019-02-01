<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>View Job</title>
    <link rel="stylesheet" href="css/job-posting.css" type="text/css">
</head>
<body>
 
    <div class="container">
  
        <div class="page-header">
            <h1>Job Details</h1>
        </div>
		
		<a href='search.php' class='btn btn-danger'>Back to my job search</a>
         
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
					
			// get passed parameter value, in this case, the record ID
			// isset() is a PHP function used to verify if a value is there or not
			$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
			
			if (!$jobSeekerID){
				echo "ERROR: Please log in to view this job posting";
				exit;
			};
			 
			// read current record's data
			// prepare select query
			$query = mysqli_query($link, "SELECT * FROM postajob WHERE id = '" . $id . "' LIMIT 1");
			$row = mysqli_fetch_assoc($query);
		 
			$jobTitle = $row['jobTitle'];
			$experienceLevel = $row['experienceLevel'];
			$address = $row['address'];
			$city = $row['city'];
			$state = $row['state'];
			$zip = $row['zip'];
			$positionType = $row['positionType'];
			$category = $row['category'];
			$salary = $row['salary'];
			$website = $row['website'];
			$jobDescription = $row['jobDescription'];
			 
		?>
 
		<table style="margin-left:auto; margin-right:auto; background-color: rgba(238, 238, 238, .8)">
			<tr>
				<td style="width:15%">Job Title</td>
				<td><strong><?php echo htmlspecialchars($jobTitle, ENT_QUOTES);  ?></strong></td>
			</tr>
			<br>
			<tr>
				<td style="width:15%">Position Type</td>
				<td><strong><?php echo htmlspecialchars($positionType, ENT_QUOTES);  ?></strong></td>
			</tr>
			<br>
			<tr>
				<td style="width:15%">Wage (per hour)</td>
				<td><strong><?php echo htmlspecialchars($salary, ENT_QUOTES);  ?></strong></td>
			</tr>
			<br>
			<tr>
				<td style="width:15%">Experience Level</td>
				<td><strong><?php echo htmlspecialchars($experienceLevel, ENT_QUOTES);  ?></strong></td>
			</tr>
			<br>
			<tr>
				<td>Description</td>
			</tr>
			<tr>
				<td></td>
				<td><strong><?php echo htmlspecialchars($jobDescription, ENT_QUOTES);  ?></strong></td>
			</tr>
			<tr>
				<td></td>
			</tr>
		</table>
 
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>
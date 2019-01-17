<!DOCTYPE HTML>
<html>
<head>
    <title>View My Job</title>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 
</head>
<body>
 
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Job Details</h1>
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
			$companyID_object = mysqli_query($link, "SELECT id from employers WHERE email = '".$email."'");
			$companyID = (mysqli_fetch_row($companyID_object))[0];
			echo "<script> console.log('companyID is: " . $companyID . "!')</script>";
					
			// get passed parameter value, in this case, the record ID
			// isset() is a PHP function used to verify if a value is there or not
			$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
			 
			//connect to database
			 
			// read current record's data
			// prepare select query
			$query = mysqli_query($link, "SELECT jobTitle, experienceLevel FROM postajob WHERE id = '" . $id . "' LIMIT 1");
			$row = mysqli_fetch_assoc($query);
		 
			// values to fill up our form
			$jobTitle = $row['jobTitle'];
			$experienceLevel = $row['experienceLevel'];
			 
		?>
 
        <!--we have our html table here where the record will be displayed-->
		<table class='table table-hover table-responsive table-bordered'>
			<tr>
				<td>Job Title</td>
				<td><?php echo htmlspecialchars($jobTitle, ENT_QUOTES);  ?></td>
			</tr>
			<tr>
				<td>Experience Level</td>
				<td><?php echo htmlspecialchars($experienceLevel, ENT_QUOTES);  ?></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<a href='myJobs.php' class='btn btn-danger'>Back to my jobs</a>
				</td>
			</tr>
		</table>
 
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>
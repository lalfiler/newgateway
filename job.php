<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>View My Job</title>
    <link rel="stylesheet" href="css/job-posting.css" type="text/css">
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
			$jobCompany_object = mysqli_query($link, "SELECT companyID from postajob WHERE id= '" . $id . "' LIMIT 1 ");
			$jobCompany = (mysqli_fetch_row($jobCompany_object))[0];
			
			if ($jobCompany != $companyID){
				echo "ERROR: Record ID not found";
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
			$contactEmail = $row['contactEmail'];
			
			//associative arrays to translate database categories
			$position_arr = ["full-time"=>"Full Time", "part-time"=>"Part Time", "temporary"=>"Temporary", "contract"=>"Contract", "commission"=>"Commission", "internship"=>"Internship"];
			$experience_arr = ["entry-level"=>"Entry Level", "mid-level"=>"Mid Level", "senior-level"=>"Senior Level"];
			$category_arr = ["jobFunctionAcct"=>"Accounting", "jobFunctionAdmn"=>"Administrative", 
			"jobFunctionCre"=>"Arts and Design", 
			"jobFunctionBd"=>"Business Development", 
			"jobFunctionCss"=>"Community & Social Services", 
			"jobFunctionCnsl"=>"Consulting",
			"jobFunctionEdu"=>"Education",
			"jobFunctionEng"=>"Engineering",
			"jobFunctionEnt"=>"Entrepreneurship",
			"jobFunctionFinc"=>"Finance",
			"jobFunctionMd"=>"Healthcare Services",
			"jobFunctionHr"=>"Human Resources",
			"jobFunctionIt"=>"Information Technology",
			"jobFunctionLgl"=>"Legal",
			"jobFunctionMktg"=>"Marketing",
			"jobFunctionPr"=>"Media & Communications",
			"jobFunctionMps"=>"Military & Protective Services",
			"jobFunctionOps"=>"Operations",
			"jobFunctionProd"=>"Product Management",
			"jobFunctionPpm"=>"Program & Product Management",
			"jobFunctionBuy"=>"Purchasing",
			"jobFunctionQa"=>"Quality Assurance",
			"jobFunctionRe"=>"Real Estate",
			"jobFunctionAcad"=>"Research",
			"jobFunctionSale"=>"Sales",
			"jobFunctionSupp"=>"Support"];
			 
		?>
 
        <table style="margin-left:auto; margin-right:auto; background-color: rgba(238, 238, 238, .8)">
			<tr>
				<td style="width:15%">Job Title</td>
				<td><strong><?php echo htmlspecialchars($jobTitle, ENT_QUOTES);  ?></strong></td>
			</tr>
			<br>
			<tr>
				<td style="width:15%">Location</td>
				<td><strong><?php echo htmlspecialchars($address) . ", " . htmlspecialchars($city) . ", " . htmlspecialchars($state); ?></strong></td>
			</tr>
			<br>
			<tr>
				<td style="width:15%">Position Type</td>
				<td><strong><?php echo htmlspecialchars($position_arr[$positionType], ENT_QUOTES);  ?></strong></td>
			</tr>
			<br>
			<tr>
				<td style="width:15%">Position Category</td>
				<td><strong><?php echo htmlspecialchars($category_arr[$category], ENT_QUOTES);  ?></strong></td>
			</tr>
			<br>
			<tr>
				<td style="width:15%">Wage (per hour)</td>
				<td><strong><?php echo htmlspecialchars($salary, ENT_QUOTES);  ?></strong></td>
			</tr>
			<br>
			<tr>
				<td style="width:15%">Experience Level</td>
				<td><strong><?php echo htmlspecialchars($experience_arr[$experienceLevel], ENT_QUOTES);  ?></strong></td>
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
 
</body>
</html>
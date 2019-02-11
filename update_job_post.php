<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit My Job</title>
    <link rel="stylesheet" href="css/job-posting.css" type="text/css">
</head>
<body>
 
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Edit My Job</h1>
        </div>
         
		<?php
		
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
		 
			// values to fill up our form
			$jobTitle = $row['jobTitle'];
			$experienceLevel = $row['experienceLevel'];
			$address = $row['address'];
			$city = $row['city'];
			$state = $row['state'];
			$zip = $row['zip'];
			$positionType = $row['positionType'];
			$category = $row['category'];
			$website = $row['website'];
			$jobDescription = $row['jobDescription'];
			$salary = $row['salary'];
			 
		// check if form was submitted
		if($_POST){
			 
			try{
			 
				// posted values
				$address=htmlspecialchars(strip_tags($_POST['address']));
				$city=htmlspecialchars(strip_tags($_POST['city']));
				$state=htmlspecialchars(strip_tags($_POST['state']));
				$zip=htmlspecialchars(strip_tags($_POST['zip']));
				$jobTitle=htmlspecialchars(strip_tags($_POST['jobTitle']));
				$positionType=htmlspecialchars(strip_tags($_POST['positionType']));
				$experienceLevel=htmlspecialchars(strip_tags($_POST['experienceLevel']));
				$category=htmlspecialchars(strip_tags($_POST['category']));
				$salary=htmlspecialchars(strip_tags($_POST['salary']));
				$website=htmlspecialchars(strip_tags($_POST['website']));
				$jobDescription=htmlspecialchars(strip_tags($_POST['jobDescription']));
		 
				// write update query
				$query = "UPDATE postajob 
							SET address='". $address ."', city='" .$city. "', state='" .$state. "', zip='" .$zip. "', jobTitle='" .$jobTitle. "', positionType='" .$positionType. "', experienceLevel='" .$experienceLevel. "', category='" .$category. "', salary='" .$salary. "', website='" .$website. "', jobDescription='" .$jobDescription. "'
							WHERE id ='" .$id. "'";
		 
				// prepare query for execution
				$stmt = $link->prepare($query);
				
				// Execute the query
				if($stmt->execute()){
					echo "<div class='alert alert-success'>Job Post was updated.</div>";
				}else{
					echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
				}
				 
			}
			 
			// show errors
			catch(Exception $e){
				die('ERROR: ' . $e->getMessage());
			}
		}
		?>
 
		<div id="form">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
            <fieldset>
                <div class="right">
                    <div>
                        <label for="address">Address:</label>
                        <br>
                        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address, ENT_QUOTES);  ?>">
                    </div>
                    <div>
                        <label for="city">City:</label>
                        <br>
                        <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($city, ENT_QUOTES);  ?>">
                    </div>
                    <div>
                        <label for="state">State:</label>
                        <br>
                        <input type="text" id="state" name="state" value="<?php echo htmlspecialchars($state, ENT_QUOTES);  ?>">
                    </div>
                    <div>
                        <label for="zip">ZipCode:</label>
                        <br>
                        <input type="text" id="zip" name="zip" value="<?php echo htmlspecialchars($zip, ENT_QUOTES);  ?>">
                    </div>
                    <div>
                        <label for="job-title">Job Title:</label>
                        <br>
                        <input type="text" id="job-title" name="jobTitle" value="<?php echo htmlspecialchars($jobTitle, ENT_QUOTES);  ?>">
                    </div>
                    <div>
                        <label for="positionType">Position Type:</label>
                        <br>
                        <select name="positionType">
                            <option value="full-time" <?php if($positionType == 'full-time'){echo("selected");}?>>Full-Time</option>
                            <option value="part-time" <?php if($positionType == 'part-time'){echo("selected");}?>>Part-Time</option>
                            <option value="temporary" <?php if($positionType == 'temporary'){echo("selected");}?>>Temporary</option>
                            <option value="contract" <?php if($positionType == 'contract'){echo("selected");}?>>Contract</option>
                            <option value="commission" <?php if($positionType == 'commission'){echo("selected");}?>>Commission</option>
                            <option value="internship" <?php if($positionType == 'internship'){echo("selected");}?>>Internship</option>
                        </select>
                    </div>
                    <div>
                        <label for="experienceLevel">Experience Level:</label>
                        <br>
                        <select name="experienceLevel">
                            <option value="">Select</option>
                            <option value="entry-level" <?php if($experienceLevel == 'entry-level'){echo("selected");}?>>Entry Level</option>
                            <option value="mid-level" <?php if($experienceLevel == 'mid-level'){echo("selected");}?>>Mid Level</option>
                            <option value="senior-level" <?php if($experienceLevel == 'senior-level'){echo("selected");}?>>Senior Level</option>
                        </select>
                    </div>
                </div>
                <div class="left">
                    <div>
                        <label for="category">Category:</label>
                        <br>
                        <select name="category" id="employerJobFunction">
                            <option value="jobFunctionAcct" <?php if($category == 'jobFunctionAcct'){echo("selected");}?>>Accounting</option>
                            <option value="jobFunctionAdmn" <?php if($category == 'jobFunctionAdmn'){echo("selected");}?>>Administrative</option>
                            <option value="jobFunctionCre" <?php if($category == 'jobFunctionCre'){echo("selected");}?>>Arts and Design</option>
                            <option value="jobFunctionBd" <?php if($category == 'jobFunctionBd'){echo("selected");}?>>Business Development</option>
                            <option value="jobFunctionCss" <?php if($category == 'jobFunctionCss'){echo("selected");}?>>Community & Social Services</option>
                            <option value="jobFunctionCnsl" <?php if($category == 'jobFunctionCnsl'){echo("selected");}?>>Consulting</option>
                            <option value="jobFunctionEdu" <?php if($category == 'jobFunctionEdu'){echo("selected");}?>>Education</option>
                            <option value="jobFunctionEng" <?php if($category == 'jobFunctionEng'){echo("selected");}?>>Engineering</option>
                            <option value="jobFunctionEnt" <?php if($category == 'jobFunctionEnt'){echo("selected");}?>>Entrepreneurship</option>
                            <option value="jobFunctionFinc" <?php if($category == 'jobFunctionFinc'){echo("selected");}?>>Finance</option>
                            <option value="jobFunctionMd" <?php if($category == 'jobFunctionMd'){echo("selected");}?>>Healthcare Services</option>
                            <option value="jobFunctionHr" <?php if($category == 'jobFunctionHr'){echo("selected");}?>>Human Resources</option>
                            <option value="jobFunctionIt" <?php if($category == 'jobFunctionIt'){echo("selected");}?>>Information Technology</option>
                            <option value="jobFunctionLgl" <?php if($category == 'jobFunctionLgl'){echo("selected");}?>>Legal</option>
                            <option value="jobFunctionMktg" <?php if($category == 'jobFunctionMktg'){echo("selected");}?>>Marketing</option>
                            <option value="jobFunctionPr" <?php if($category == 'jobFunctionPr'){echo("selected");}?>>Media & Communications</option>
                            <option value="jobFunctionMps" <?php if($category == 'jobFunctionMps'){echo("selected");}?>>Military & Protective Services</option>
                            <option value="jobFunctionOps" <?php if($category == 'jobFunctionOps'){echo("selected");}?>>Operations</option>
                            <option value="jobFunctionProd" <?php if($category == 'jobFunctionProd'){echo("selected");}?>>Product Management</option>
                            <option value="jobFunctionPpm" <?php if($category == 'jobFunctionPpm'){echo("selected");}?>>Program & Product Management</option>
                            <option value="jobFunctionBuy" <?php if($category == 'jobFunctionBuy'){echo("selected");}?>>Purchasing</option>
                            <option value="jobFunctionQa" <?php if($category == 'jobFunctionQa'){echo("selected");}?>>Quality Assurance</option>
                            <option value="jobFunctionRe" <?php if($category == 'jobFunctionRe'){echo("selected");}?>>Real Estate</option>
                            <option value="jobFunctionAcad" <?php if($category == 'jobFunctionAcad'){echo("selected");}?>>Research</option>
                            <option value="jobFunctionSale" <?php if($category == 'jobFunctionSale'){echo("selected");}?>>Sales</option>
                            <option value="jobFunctionSupp" <?php if($category == 'jobFunctionSupp'){echo("selected");}?>>Support</option>
                        </select>
                    </div>
                    <div>
                        <label for="salary">Salary (per hour):</label>
                        <br>
                        <input type="number" id="salary" name="salary" value="<?php echo htmlspecialchars($salary, ENT_QUOTES);  ?>">
                    </div>
                    <div>
                        <label for="website">Website:</label>
                        <br>
                        <input type="url" id="website" name="website" value="<?php echo htmlspecialchars($website, ENT_QUOTES);  ?>">
                    </div>
                    <div>
                        <label for="jobDescription">Job Description:</label>
                        <br>
                        <textarea name="jobDescription" id="jobDescription"><?php echo htmlspecialchars($jobDescription, ENT_QUOTES);  ?></textarea>
						<!--
                        <p>Upload a description</p>
                        <input type="file" name="pic" accept="text">
						-->
                    </div>
                </div>
                <br>
                <div>
                    <input type="submit" id="submit" class="submit">
                </div>
            </fieldset>
        </form>
    </div>
 
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit My Profile</title>
    <link rel="stylesheet" href="css/job-posting.css" type="text/css">
</head>
<body>
 
	<form action="job-seekers-dashboard.php">
		<input type="submit" class="button" value="Back to Dashboard" style="width:100%">
	</form>
	
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Edit My Profile</h1>
        </div>
        
		<div style="display: block; text-align:center">
			<form action="edit_password_jobseeker.php">
				<input class="submit" type="submit" value="Change Password"  style="width:100%">
			</form>
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
			$jobseekerID_object = mysqli_query($link, "SELECT id from jobseekers WHERE email = '".$email."'");
			$jobseekerID = (mysqli_fetch_row($jobseekerID_object))[0];
			echo "<script> console.log('companyID is: " . $jobseekerID . "!')</script>";
					
			
			 
			// read current record's data
			// prepare select query
			$query = mysqli_query($link, "SELECT * FROM jobseekers WHERE id = '" . $jobseekerID . "' LIMIT 1");
			$row = mysqli_fetch_assoc($query);
		 
			$firstName = $row['firstName'];
			$lastName = $row['lastName'];
			$address = $row['Address'];
			$city = $row['City'];
			$state = $row['State'];
			$zip = $row['zip'];
			$telephone = $row['Telephone'];
			$email = $row['Email'];
			$userName = $row['userName'];
			$linkedIn = $row['LinkedIn'];
			 
		// check if form was submitted
		if($_POST){
			 
			try{
			 
				// posted values
				$firstName=htmlspecialchars(strip_tags($_POST['firstName']));
				$lastName=htmlspecialchars(strip_tags($_POST['lastName']));
				$address=htmlspecialchars(strip_tags($_POST['Address']));
				$city=htmlspecialchars(strip_tags($_POST['City']));
				$state=htmlspecialchars(strip_tags($_POST['State']));
				$zip=htmlspecialchars(strip_tags($_POST['zip']));
				$telephone=htmlspecialchars(strip_tags($_POST['Telephone']));
				$email=htmlspecialchars(strip_tags($_POST['Email']));
				$userName=htmlspecialchars(strip_tags($_POST['userName']));
				$linkedIn=htmlspecialchars(strip_tags($_POST['LinkedIn']));
		 
				// write update query
				$query = "UPDATE jobseekers 
							SET firstName='". $firstName ."', lastName='". $lastName ."', Address='". $address ."', City='" .$city. "', State='" .$state. "', zip='" .$zip. "', Telephone='". $telephone ."', Email='". $email ."', userName='". $userName ."', LinkedIn='" .$linkedIn. "'
							WHERE id ='" .$jobseekerID. "'";
		 
				// prepare query for execution
				$stmt = $link->prepare($query);
				
				// Execute the query
				if($stmt->execute()){
					echo "<div class='alert alert-success'>Your profile was updated.</div>";
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
        <form action="jobseeker_profile.php" method="post">
            <fieldset>
                    <div>
                        <label for="firstName">First Name:</label>
                        <br>
                        <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($firstName, ENT_QUOTES);  ?>">
                    </div>
                    <div>
                        <label for="lastName">Last Name:</label>
                        <br>
                        <input type="text" id="lasName" name="lastName" value="<?php echo htmlspecialchars($lastName, ENT_QUOTES);  ?>">
                    </div>
                    <div>
                        <label for="address">Address:</label>
                        <br>
                        <input type="text" id="address" name="Address" value="<?php echo htmlspecialchars($address, ENT_QUOTES);  ?>">
                    </div>
                    <div>
                        <label for="city">City:</label>
                        <br>
                        <input type="text" id="city" name="City" value="<?php echo htmlspecialchars($city, ENT_QUOTES);  ?>">
                    </div>
                    <div>
                        <label for="state">State:</label>
                        <br>
                        <input type="text" id="state" name="State" value="<?php echo htmlspecialchars($state, ENT_QUOTES);  ?>">
                    </div>
                    <div>
                        <label for="zipcode">Zipcode:</label>
                        <br>
                        <input type="number" id="zipcode" name="zip" value="<?php echo htmlspecialchars($zip, ENT_QUOTES);  ?>">
                    </div>
                    <div>
                        <label for="phone">Phone:</label>
                        <br>
                        <input type="tel" id="phone" name="Telephone" value="<?php echo htmlspecialchars($telephone, ENT_QUOTES);  ?>">
                    </div>
                    <div>
                        <label for="email">Email:</label>
                        <br>
                        <input type="email" id="email" name="Email" value="<?php echo htmlspecialchars($email, ENT_QUOTES);  ?>">
                    </div>
                    <div>
                        <label for="username">User Name:</label>
                        <br>
                        <input type="username" id="username" name="userName" value="<?php echo htmlspecialchars($userName, ENT_QUOTES);  ?>">
                    </div>
                    <div>
                        <label for="linkedin">LinkedIn Profile:</label>
                        <br>
                        <input type="url" id="linkedin" name="LinkedIn" value="<?php echo htmlspecialchars($linkedIn, ENT_QUOTES);  ?>">
                    </div>
                    <br>
                    <span>
                        <input type="submit" id="submit" class="submit">
                    </span>
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
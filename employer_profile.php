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
 
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Edit My Profile</h1>
        </div>
        
		<div style="display: block; text-align:center">
			<form action="edit_password_employer.php">
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
			$companyID_object = mysqli_query($link, "SELECT id from employers WHERE email = '".$email."'");
			$companyID = (mysqli_fetch_row($companyID_object))[0];
			echo "<script> console.log('companyID is: " . $companyID . "!')</script>";
					
			
			 
			// read current record's data
			// prepare select query
			$query = mysqli_query($link, "SELECT * FROM employers WHERE id = '" . $companyID . "' LIMIT 1");
			$row = mysqli_fetch_assoc($query);
		 
			$company = $row['companyName'];
			$website = $row['website'];
			$address = $row['address'];
			$city = $row['city'];
			$state = $row['state'];
			$zip = $row['zip'];
			$telephone = $row['telephone'];
			$email = $row['email'];
			$userName = $row['userName'];
			$linkedIn = $row['linkedIn'];
			 
		// check if form was submitted
		if($_POST){
			 
			try{
			 
				// posted values
				$company=htmlspecialchars(strip_tags($_POST['company']));
				$website=htmlspecialchars(strip_tags($_POST['website']));
				$address=htmlspecialchars(strip_tags($_POST['address']));
				$city=htmlspecialchars(strip_tags($_POST['city']));
				$state=htmlspecialchars(strip_tags($_POST['state']));
				$zip=htmlspecialchars(strip_tags($_POST['zip']));
				$telephone=htmlspecialchars(strip_tags($_POST['telephone']));
				$email=htmlspecialchars(strip_tags($_POST['email']));
				$userName=htmlspecialchars(strip_tags($_POST['userName']));
				$linkedIn=htmlspecialchars(strip_tags($_POST['linkedIn']));
		 
				// write update query
				$query = "UPDATE employers
							SET companyName='". $company ."', website='". $website ."', address='". $address ."', city='" .$city. "', state='" .$state. "', zip='" .$zip. "', telephone='". $telephone ."', email='". $email ."', userName='". $userName ."', linkedIn='" .$linkedIn. "'
							WHERE id ='" .$companyID. "'";
		 
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
        <form action="employer_profile.php" method="post">
            <fieldset>
				<div>
					<label for="company">Company Name:</label>
					<br>
					<input type="text" id="company" name="company" value="<?php echo htmlspecialchars($company, ENT_QUOTES);  ?>"">
				</div>
				<div>
					<label for="website">Company Website:</label>
					<br>
					<input type="text" id="website" name="website" value="<?php echo htmlspecialchars($website, ENT_QUOTES);  ?>">
				</div>
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
					<label for="zipcode">Zipcode:</label>
					<br>
					<input type="number" id="zipcode" name="zip" value="<?php echo htmlspecialchars($zip, ENT_QUOTES);  ?>"
				</div>
				<div>
					<label for="phone">Phone:</label>
					<br>
					<input type="tel" id="phone" name="telephone" value="<?php echo htmlspecialchars($telephone, ENT_QUOTES);  ?>">
				</div>
				<div>
					<label for="email">Email:</label>
					<br>
					<input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email, ENT_QUOTES);  ?>">
				</div>
				<div>
					<label for="username">User Name:</label>
					<br>
					<input type="username" id="username" name="userName" value="<?php echo htmlspecialchars($userName, ENT_QUOTES);  ?>">
				</div>
				<div>
					<label for="linkedin">Corporate LinkedIn Profile:</label>
					<br>
					<input type="url" id="linkedin" name="linkedIn" value="<?php echo htmlspecialchars($linkedIn, ENT_QUOTES);  ?>">
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
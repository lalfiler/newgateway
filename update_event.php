<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit My Event</title>
    <link rel="stylesheet" href="css/job-posting.css" type="text/css">
</head>
<body>
 
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Edit My Event</h1>
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
			 
			// read current record's data
			// prepare select query
			$query = mysqli_query($link, "SELECT * FROM events WHERE id = '" . $id . "' LIMIT 1");
			$row = mysqli_fetch_assoc($query);
		 
			$title = $row['title'];
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
				$query = "UPDATE events 
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
                        <label for="eventTitle">Event Title:</label>
                        <br>
                        <input type="text" id="eventTitle" name="eventTitle" value="<?php echo htmlspecialchars($title, ENT_QUOTES); ?>">
                    </div>
					<div>
                        <label for="eventDescription">Event Description:</label>
                        <br>
                        <textarea name="eventDescription" id="eventDescription" ><?php echo htmlspecialchars($description); ?></textarea>
                    </div>
					<div>
						<label for="eventDate">Event Date:</label>
						<br>
						<input type="date" id="eventDate" name="eventDate" value="<?php echo htmlspecialchars($date, ENT_QUOTES); ?>">
					</div>
					<div>
						<label for="eventTimeStart">Time Start:</label>
						<br>
						<input type="time" id="eventTimeStart" name="eventTimeStart" value="<?php echo htmlspecialchars($timeStart, ENT_QUOTES); ?>">
					</div>
					<div>
						<label for="eventTimeEnd">Time End:</label>
						<br>
						<input type="time" id="eventTimeEnd" name="eventTimeEnd" value="<?php echo htmlspecialchars($timeEnd, ENT_QUOTES); ?>">
					</div>
					<div>
                        <label for="contactEmail">Contact Email:</label>
                        <br>
                        <input type="text" id="contactEmail" name="contactEmail" value="<?php echo htmlspecialchars($email, ENT_QUOTES); ?>">
                    </div>
                    <div>
                        <label for="address">Event Address:</label>
                        <br>
                        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address, ENT_QUOTES); ?>">
                    </div>
                    <div>
                        <label for="city">City:</label>
                        <br>
                        <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($city, ENT_QUOTES); ?>">
                    </div>
                    <div>
                        <label for="state">State:</label>
                        <br>
                        <input type="text" id="state" name="state" value="<?php echo htmlspecialchars($state, ENT_QUOTES); ?>">
                    </div>
                    <div>
                        <label for="zip">ZipCode:</label>
                        <br>
                        <input type="text" id="zip" name="zip" value="<?php echo htmlspecialchars($zip, ENT_QUOTES); ?>">
                    </div>
                    <div>
                        <label for="website">Website:</label>
                        <br>
                        <input type="url" id="website" name="website" value="<?php echo htmlspecialchars($website, ENT_QUOTES); ?>">
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
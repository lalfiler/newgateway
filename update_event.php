<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit My Event</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/job-posting.css" type="text/css">
</head>
<body>
 
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Edit My Event</h1>
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
			$eventCompany_object = mysqli_query($link, "SELECT companyID from events WHERE id= '" . $id . "' LIMIT 1 ");
			$eventCompany = (mysqli_fetch_row($eventCompany_object))[0];
			
			if ($eventCompany != $companyID){
				echo "ERROR: Record ID not found";
				exit;
			};
			 
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
				$title=htmlspecialchars(strip_tags($_POST['title']));
				$date=htmlspecialchars(strip_tags($_POST['date']));
				$timeStart=htmlspecialchars(strip_tags($_POST['timeStart']));
				$timeEnd=htmlspecialchars(strip_tags($_POST['timeEnd']));
				$website=htmlspecialchars(strip_tags($_POST['website']));
				$description=htmlspecialchars(strip_tags($_POST['description']));
		 
				// write update query
				$query = "UPDATE events 
							SET address='". $address ."', city='" .$city. "', state='" .$state. "', zip='" .$zip. "', title='" .$title. "', date='" .$date. "', timeStart='" .$timeStart. "', timeEnd='" .$timeEnd. "', website='". $website . "', description='" . $description . "' WHERE id ='" .$id . "'";
							
							//
									 
				// prepare query for execution
				$stmt = $link->prepare($query);
				
				// Execute the query
				if($stmt->execute()){
					echo "<div class='alert alert-success'>Event was updated.</div>";
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
                        <label for="title">Event Title:</label>
                        <br>
                        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title, ENT_QUOTES); ?>">
                    </div>
					<div>
                        <label for="description">Event Description:</label>
                        <br>
                        <textarea name="description" id="description"><?php echo htmlspecialchars($description, ENT_QUOTES); ?></textarea>
                    </div>
					<div>
						<label for="date">Event Date:</label>
						<br>
						<input type="date" id="date" name="date" value="<?php echo htmlspecialchars($date, ENT_QUOTES); ?>">
					</div>
					<div>
						<label for="timeStart">Time Start:</label>
						<br>
						<input type="time" id="timeStart" name="timeStart" value="<?php echo htmlspecialchars($timeStart, ENT_QUOTES); ?>">
					</div>
					<div>
						<label for="timeEnd">Time End:</label>
						<br>
						<input type="time" id="timeEnd" name="timeEnd" value="<?php echo htmlspecialchars($timeEnd, ENT_QUOTES); ?>">
					</div>
					<div>
                        <label for="email">Contact Email:</label>
                        <br>
                        <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email, ENT_QUOTES); ?>">
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
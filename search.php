<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My Job Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/job-posting.css" type="text/css">
</head>
<body>
    <a href="https://newgateway.org/"><img src="images/logo.JPG" alt="logo" class="logo"></a>
	<form action="job-seekers-dashboard.php">
		<input type="submit" class="button" value="Back to Dashboard" style="width:100%; font-size:130%">
	</form>
    <h1>My Job Search Results</h1>
	
<?php
   $link = mysqli_connect("localhost", "root", "", "job_board_db");

   // PAGINATION VARIABLES
	if( isset($_GET{'page'} ) ) {
		$page = $_GET{'page'} + 1;
		$offset = $rec_limit * $page ;
	}else {
		$page = 0;
		$offset = 0;
	}; 
	// set records or rows of data per page
	$records_per_page = 5;
	 
	// Check connection
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	};
	
	$jobTitle = $_POST['jobTitle'];
	$address = $_POST['address'];
	$sql = ("SELECT * FROM postajob WHERE (jobTitle LIKE '%$jobTitle%') AND ((city LIKE '%$address%') OR (zip LIKE '%$address%')) ORDER BY updatedAt LIMIT $offset, $records_per_page");
	$result = $link->query($sql);

	if ($result->num_rows > 0) {
		echo "
		<br>
		<br>
		<table class='table table-hover table-responsive table-bordered' style='background-color: rgba(238,238,238,.8)'>";
		echo "<tr>";
			echo "<th>Job Title</th>";
			echo "<th>Company</th>";
			echo "<th>Description</th>";
			echo "<th>Salary</th>";
			echo "<th>Last Edited</th>";
			echo "<th>Details</th>";
		echo "</tr>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$jobTitle = $row['jobTitle'];
			$description = $row['jobDescription'];
			$salary = $row['salary'];
			$jobID = $row['id'];
			$updatedAt = $row['updatedAt'];
			$companyID = $row['companyID'];
			$query = mysqli_query($link, "SELECT * FROM employers WHERE id ='" .$companyID . "'");
			$assoc = mysqli_fetch_assoc($query);
			$company = $assoc['companyName'];
			echo "
			<tr>
				<td><strong>$jobTitle</strong></td>
				<td>$company</td>
				<td>$description</td>
				<td>$$salary/hr</td>
				<td>$updatedAt</td>
				<td>
					<a href='view_job.php?id={$jobID}' class='btn btn-info m-r-1em'>View Job Details</a>
				</td>
			</tr>
			";
		}
		echo "</table>";
	} else {
		echo "No results match your query. Try broadening your search.";
	}
	$link->close();
?>

    <footer>
        <p>&copy; 2018 New GateWay Solutions Corporation</p>
    </footer>
</body>
</html>
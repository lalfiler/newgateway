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
	 
	// Check connection
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	};
	
	 // PAGINATION VARIABLES
	$records_per_page = 5;
	
	if( isset($_GET{'page'} ) ) {
		$page = $_GET{'page'};
		$next_page = $page + 1;
		$offset = $records_per_page * ($page - 1);
	}else {
		$next_page = 2;
		$offset = 0;
		$page= 1;
	}; 
	
	//set search parameters
	if( isset($_GET{'jobTitle'})){
		$searchJobTitle = $_GET{'jobTitle'};
		$searchAddress = $_GET{'address'};
	} else {
		$searchJobTitle = $_POST['jobTitle'];
		$searchAddress = $_POST['address'];
	};
	
	
	$sql = ("SELECT * FROM postajob WHERE (jobTitle LIKE '%$searchJobTitle%') AND ((city LIKE '%$searchAddress%') OR (zip LIKE '%$searchAddress%')) ORDER BY updatedAt LIMIT $offset, $records_per_page");
	$result = $link->query($sql);

	
	$count_sql = ("SELECT count(id) FROM postajob WHERE (jobTitle LIKE '%$searchJobTitle%') AND ((city LIKE '%$searchAddress%') OR (zip LIKE '%$searchAddress%'))");
	$count_query = mysqli_query($link, $count_sql);
	$row = mysqli_fetch_array($count_query, MYSQLI_NUM);
	
	$record_count = $row[0];
	$records_left = $record_count - ($records_per_page * ($page - 1));
	
	if ($record_count > 0) {
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
		
		if(!(($next_page == 2) && ($record_count <= $records_per_page))){ //this is not the only page
			if( $next_page == 2 ) { //this is the first page
				echo "<a href = \"search.php?page=$next_page&jobTitle=$searchJobTitle&address=$searchAddress\" class='btn btn-primary m-r-1em'>Next</a>";
			}else if( $records_left <= $records_per_page) { //this is the last page
				$last = $next_page - 2;
				echo "<a href = \"search.php?page=$last&jobTitle=$searchJobTitle&address=$searchAddress\" class='btn btn-primary m-r-1em'>Previous</a>";
			 }else { //there are pages both before and after this one
				$last = $next_page - 2;
				echo "<a href = \"search.php?page=$last&jobTitle=$searchJobTitle&address=$searchAddress\" class='btn btn-primary m-r-1em'>Previous</a> |";
				echo "<a href = \"search.php?page=$next_page&jobTitle=$searchJobTitle&address=$searchAddress\" class='btn btn-primary m-r-1em'>Next</a>";
			 };
		};
		 
	} else {
		echo "No results match your query. Try broadening your search.";
	}
	$link->close();
?>

    <footer>
        <p>&copy; 2019 New GateWay Solutions Corporation</p>
    </footer>
</body>
</html>
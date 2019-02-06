<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My Job Results</title>
    <link rel="stylesheet" href="css/job-posting.css" type="text/css">
</head>
<body>
    <a href="https://newgateway.org/"><img src="images/logo.JPG" alt="logo" class="logo"></a>
	<form action="job-seekers-dashboard.php">
		<input type="submit" class="button" value="Back to Dashboard" style="width:100%">
	</form>
    <h1>My Job Search Results</h1>
	
<?php
   $link = mysqli_connect("localhost", "root", "", "job_board_db");

	// Check connection
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	$jobTitle = $_POST['jobTitle'];
	$address = $_POST['address'];
	$sql = ("SELECT * FROM postajob WHERE (jobTitle LIKE '%$jobTitle%') AND ((city LIKE '%$address%') OR (zip LIKE '%$address%'))");
	$result = $link->query($sql);

	if ($result->num_rows > 0) {
		echo "<table border='1'><th></th>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$timeStamp = $row['updatedAt'];
			$timeStamp = date( "m/d/Y", strtotime($timeStamp));
			echo "<tr><td>".$timeStamp."</td><td><a href='view_job.php?id=".$row["id"]."' target='_blank'>".$row["jobTitle"]."</a></td><td>".$row["zip"]."</td></tr>";
			echo "<tr><td>".$row["jobDescription"]."</td></tr>";
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
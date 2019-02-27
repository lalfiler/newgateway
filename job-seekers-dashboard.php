<?php 
//include_once 'accesscontrol.php';
session_start();
$email = $_SESSION['email'];
if(isset($_GET['status'])){
	$status = $_GET['status']; 
} else{
	$status = null;
};
if(isset($_GET['login'])){
	$login = true;
} else{
	$login = false;
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Job Seekers Dashboard</title>
    <link rel="stylesheet" href="css/dashborad.css" type="text/css">
</head>
<body>
    <div>
		<a href="https://newgateway.org/"><img src="images/logo.JPG" alt="logo" class="logo"></a>
		<div id="donate" style="display:inline-block;">
			<form action="https://www.paypal.com/cgi-bin" method="post" target="_top" id="donateButton">
				<p>
					<input name="cmd" type="hidden" value="_s-xclick">
					<input name="hosted_button_id" type="hidden" value="BJQBXZUMH3UQ4">
				</p>
				<p>
					<input alt="PayPal - The safer, easier way to pay online!" border="0" name="submit"
					src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" type="image">
				</p>
				<p style="text-align: center;">
					<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
					style="display:block; height:1px; margin-left:auto; margin-right:auto; width:1px">
				</p>
			</form>
		</div>
		<form action="logout.php" class="logout" style="inline-block">
			<input class="submit" type="submit" value="Log Out">
		</form>
		<form action="jobseeker_profile.php" class="logout" style="inline-block">
			<input class="submit" type="submit" value="My Profile">
		</form>
	</div>
    <div class="container">
		<?php 
			if($status == "password"){
				echo "<p style='color: #fff; background-color: rgba(0, 255, 0, 0.6); text-align:center'>Password Successfully Updated!</p>";
			};
			
			if($login){
				echo "<h1>Welcome to the Job Seeker's Dashboard, $email</h1>";
			} else {
				echo "<h1>Job Seeker's Dashboard</h1>";
			};
		?>
        <div id="form">
            <form class="form search" action="search.php" method="post">
                <h1>Search for jobs</h1>
                <br>
                <input class="job-title" type="text" name="jobTitle" placeholder="Job Title">
                <input class="address" type="text" name="address" placeholder="City / Zipcode">
                <br>
                <input class="submit" type="submit" value="Search">
            </form>
        </div>
        <p class="events"><a href="view_events.php">Upcoming events</a></p>
        </div>
    <footer>
        <p>&copy; 2019 New GateWay Solutions Corporation</p>
    </footer>
</body>
</html>
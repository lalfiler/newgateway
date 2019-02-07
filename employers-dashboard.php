<?php 
//include_once 'accesscontrol.php';
session_start();
$email = $_SESSION['email'];
if(isset($_GET['status'])){
	$status = $_GET['status']; 
} else{
	$status = null;
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Employers Dashboard</title>
    <link rel="stylesheet" href="css/dashborad.css" type="text/css">
</head>
<body>
	<div>
		<a href="https://newgateway.org/"><img src="images/logo.JPG" alt="logo" class="logo" style="display:inline-block; margin-left:30%;"></a>
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
		<form action="employer_profile.php" class="logout" style="inline-block">
			<input class="submit" type="submit" value="My Profile">
		</form>
	</div>
    <div class="container">
        <h1>Welcome to the Employer's Dashboard</h1>
		<?php 
			if($status == "password"){
				echo "<p style='color: #fff; background-color: rgba(0, 255, 0, 0.6); text-align:center'>Password Successfully Updated!</p>";
				};
		?>
        <div class="options">
			<table style="margin-left:auto; margin-right:auto">
				<tr>
					<td align="center"><a href="postajob.html" target="_blank">Add Job</a></td>
					<td align="center"><a href="new_event.html" target="_blank">Add Event</a><td>
				</tr>
				<tr>
					<td style="padding-top: 30px"><a href="myjobs.php" target="_blank">View My Jobs</a></td>
					<td style="padding-top: 30px"><a href="myevents.php" target="_blank">View My Events</a></td>
				</tr>
			</table>
        </div>
        <!-- <div id="form">
            <form class="form search" action="search.html" method="post">
                <h2>Search for job seekers</h2>
                <br>
                <input class="job-title" type="text" name="job-title" placeholder="Job Title">
                <input class="address" type="text" name="address" placeholder="City / Zipcode">
                <br>
                <input class="submit" type="submit" value="Search">
            </form>
        </div> -->
    </div>
    <footer>
        <p>&copy; 2018 New GateWay Solutions Corporation</p>
    </footer>
</body>
</html>
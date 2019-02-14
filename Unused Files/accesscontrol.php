<?php
session_start();

if (isset($_POST['email'])) {
$email = $_POST['email'];
} else {
$email = $_SESSION['email'];
};

if (isset($_POST['password'])) {
$password = $_POST['password'];
} else {
$password = $_SESSION['password'];
};

if(!isset($email)) {
	header('Location: login.html');
} else{
		
	$link = mysqli_connect("localhost", "root", "", "job_board_db");
 
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}

	$password_hashed = hash('sha256', $password);
		
	$result_employers = "SELECT * from employers WHERE email = '".$email."' AND password = '".$password_hashed."' limit 1";
	
	$row_employers = mysqli_query($link, $result_employers);

	$result_jobseekers = "SELECT * from jobseekers WHERE email = '".$email."' AND password = '".$password_hashed."' limit 1";
	
	$row_jobseekers = mysqli_query($link, $result_jobseekers);

	if(mysqli_num_rows($row_employers) == 1){
	$_SESSION['email'] = $email;
	$_SESSION['password_hashed'] = $password_hashed;
	
	//exit();

	}elseif(mysqli_num_rows($row_jobseekers) == 1){
	$_SESSION['email'] = $email;
	$_SESSION['password_hashed'] = $password_hashed;
	exit;

	}else{
	unset($_SESSION['email']);
	unset($_SESSION['password']);
	header('location: login-fail.html');
	exit();
	};
};
?>
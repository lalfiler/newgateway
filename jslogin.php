<?php

$link = mysqli_connect("localhost", "root", "", "job_board_db");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}



$email = $_POST["email"];
$password = md5($_POST["password"]);


$sql = "SELECT * from jobseekers WHERE email = '".$email."' AND password = '".$password."' limit 1";

$result = mysqli_query($link, $sql);

if(mysqli_num_rows($result)==1){
echo "You have successfully logged in";
exit();


}else{

echo "You have entered an Incorrect Password";
exit();


}


?>
<?php
   $link = mysqli_connect("localhost", "root", "", "job_board_db");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$set = $_POST['keywordSearch'];
$get = $_POST['cnzSearch'];
$sql = ("SELECT * FROM jobseekers WHERE firstName LIKE '%$set%' AND City LIKE '%$get%'");
$result = $link->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Name</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["firstName"]."</td><td>".$row["City"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
 $link->close();
 ?> 
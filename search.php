<?php
   $link = mysqli_connect("localhost", "root", "", "job_board_db");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$jobTitle = $_POST['jobTitle'];
$city = $_POST['address'];
$sql = ("SELECT * FROM postajob WHERE (jobTitle LIKE '%$jobTitle%') AND ((city LIKE '%$city%') OR (zip LIKE '%$city%'))");
$result = $link->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Results</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["jobTitle"]."</td><td>".$row["city"]."</td><td>".$row["zip"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$link->close();
?>

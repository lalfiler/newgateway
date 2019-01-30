<?php
   $link = mysqli_connect("localhost", "root", "", "job_board_db");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$set = $_POST['jobTitle'];
$get = $_POST['address'];
$sql = ("SELECT * FROM postajob WHERE jobTitle, category LIKE '%$set%' AND city, zip LIKE '%$get%'");
$result = mysqli_query($link, $sql);
$num_rows = mysqli_num_rows($result);

echo "<script>console.log('result is: " . $result . "');</script>";
echo "<script>console.log('num_rows is: " . $num_rows . "');</script>";


if ($num_rows > 0) {
    echo "<table><tr><th>Name</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["jobTitle"]."</td><td>".$row["category"]."</td><td>".$row["city"]."</td><td>".$row["zip"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
 $link->close();
 ?> 
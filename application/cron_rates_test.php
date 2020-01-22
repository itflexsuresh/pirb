<?php
$servername = "localhost";
$username = "audituser";
$password = "ALe#8m3MOsARSVC5S";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `ID`,`futuredate` FROM `rates`";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
        if (strtotime($row['futuredate'])>=strtotime(date())) {
          // $update = "UPDATE rates SET Amount='".$row['futureammount']."' `ValidFrom`='".$row['futuredate']."' WHERE id='".$row['ID']."'";
          // $conn->query($sql);
          echo "hii";
        }
    }


?>
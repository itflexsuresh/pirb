<?php
$servername = "localhost";
$username = "audituser";
$DB = "audit";
$password = "ALe#8m3MOsARSVC5S";

// Create connection
$conn = new mysqli($servername, $username, $password,$DB);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `ID`,`futuredate`,`futureammount` FROM `rates`";
$result = $conn->query($sql);


while($row = $result->fetch_assoc()) {
	if ($row['futureammount'] && $row['futuredate'] !='') {
		// echo date('Y-m-d H:i:s');
		// print('<pre>');
		// echo $row['futuredate'].$row['futureammount'];
		// print('</pre>');
		if (strtotime(date('Y-m-d H:i:s'))>= strtotime($row['futuredate'])) {
			$null = 'null';
			//$updatedatefuture = 'null';
		//echo $row['futuredate'].$row['futureammount'];
			$update = "UPDATE rates SET Amount='".$row['futureammount']."',`ValidFrom`='".$row['futuredate']."',`futureammount`=".$null.",`futuredate`=".$null." WHERE id='".$row['ID']."'";
			//echo $update;
			$conn->query($update);
		}
	}
	
}


?>
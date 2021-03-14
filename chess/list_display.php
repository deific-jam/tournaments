<?php
	$servername = "localhost";
		$dbusername = "id16371456_userwebsite";
		$dbpassword = "/_K@S\3q7>?Im0kW";
		$dbname = "id16371456_dbparticipants";
	
	// Create connection
		$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}else{
			$fetchdata = "SELECT id, name, username From part-list";
			$data = $conn-query($fetchdata);
			
			if($data->num_rows > 0){
				while($rows = $data->fetch_assoc)()){
					echo "<br> ID: ".$row[""]."<br> Name: ".$rows["name"]."<br> Username: ".$row["username"]."<br>";
				}
			}else{
				echo "No one has registered yet."
			}
		}
	$conn->close();
?>
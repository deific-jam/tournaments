<?php
	$servername = "localhost";
	$dbusername = "id6397543_register";
	$dbpassword = "/_K@S\3q7>?Im0kW";
	$dbname = "id6397543_registration"
	
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
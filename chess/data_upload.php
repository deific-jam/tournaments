<?php

$in_name = $_POST['Name'];
$in_username = $_POST['Username'];
$in_email = $_POST['Username'];
$in_wanum = $POST['Whatsapp'];
$in_zoom = $_POST['Zoom'];

if(!empty($in_name) || !empty($in_username) || !empty($in_email) || !empty($in_wanum)
	|| !empty($in_zoom)){
		
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
			$validate = "SELECT email From part-list Where email = ? Limit =1";
			$insert = "INSERT Into part-list (name, username, email, wanum, zoom)
			values(?, ?, ?, ?, ?)";
			
			//Prepare Validation
			$stmt = $conn->prepare($validate);
			$stmt->bind_param("s", $in_email);
			$stmt->execute();
			$stmt->bind_result($in_email);
			$stmt->store_result();
			$enum = $stmt->num_rows;
			
			if($enum==0){
				$stmt->close();
				
				$stmt=$conn->prepare($insert);
				$stmt->bind_param("sssis", $in_name, $in_username, $in_email, $in_wanum, $in_zoom);
				$stmt->execute();
				echo "First stage of registeration completed";
			}else{
				echo "Someone already registered using this email";
			}
			$stmt->close();
			$conn->close();
		}
	}else{
		echo "All fields are required";
	}
?>
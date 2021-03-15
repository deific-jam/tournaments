<?php
	$server = "localhost";
    $dbuname = "id16371456_dbadmin";
    $dbpass = "Y)e7)ZGKtJ8LTu?k";
    $dbname = "id16371456_dbparticipants";
	$data;
	
	function get_data(){
	
		// Create connection
		$conn = new mysqli($server, $dbuname, $dbpass, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}else{
			$fetchdata = "SELECT id, name, username From partlist";
			$data = $conn->query($fetchdata);
			
			
		}
	}
?>
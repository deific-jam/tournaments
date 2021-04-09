<?php
	$in_auth= $_POST['auth'];
	
	$server = "localhost";
	$dbuname = "id16371456_dbadmin";
	$dbpass = "Y)e7)ZGKtJ8LTu?k";
	$dbname = "id16371456_dbparticipants";
	
	$conn= new mysqli($server, $dbuname, $dbpass, $dbname);
	
	if(!empty($in_auth) || !empty($remove_id)){
		if($in_auth==='motherflipper69420'){
			
			//connection validation
			if($conn->connect_error){
				die("Connection failed: " . $conn->connect_error);
			}else{
				$fetchdata = "SELECT id, ip, reason FROM banned";
				$data = $conn->query($fetchdata);
			
				if($data->num_rows > 0){
					echo "<table>";
					echo "<tr><th>ID</th><th>IP</th><th>REASON</th></tr>";
					while($row = $data->fetch_assoc()){
						echo "<tr><td>".$row["id"]."</td><td>".$row["ip"]."</td><td>".$row["reason"]."</td></tr>";
					}
					echo "</table>";
				}else{
					echo "No one in the banned list";
				}
			}
		}else{
			echo "Wrong Authrization Key";
		}
	}else{
		echo "Wrong Authrization Key";
	}
	$conn->close();
?>
<?php
	$in_auth= $_POST['auth'];
	
	$server = "localhost";
	$dbuname = "id16371456_dbadmin";
	$dbpass = "Y)e7)ZGKtJ8LTu?k";
	$dbname = "id16371456_dbparticipants";
	
	$conn= new mysqli($server, $dbuname, $dbpass, $dbname);
	
	if(!empty($in_auth)){
		if($in_auth==='motherflipper69420'){
			
			//connection validation
			if($conn->connect_error){
				die("Connection failed: " . $conn->connect_error);
			}else{
				$fetchdata = "SELECT id, name, username, email, wanum, zoom, payment, ip, date, time From partlist";
				$data = $conn->query($fetchdata);
			
				if($data->num_rows > 0){
					echo '<table width="100%" border="1" style="border-collapse: collapse">';
					echo "<tr><th>ID</th><th>Name</th><th>Username</th><th>Email</th><th>WhatsApp</th><th>Zoom</th><th>Payment</th><th>IP</th><th>Date</th><th>Time</th></tr>";
					while($row = $data->fetch_assoc()){
						echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["username"]."</td><td>".$row["email"]."</td><td>".$row["wanum"]."</td><td>".$row["zoom"]."</td><td>".$row["payment"]."</td><td>".$row["ip"]."</td><td>".$row["date"]."</td><td>".$row["time"]."</td></tr>";
					}
					echo "</table>";
				}else{
					echo "No one has registered yet.";
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
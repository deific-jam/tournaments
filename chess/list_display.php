<?php
	$server = "localhost";
    $dbuname = "id16371456_dbadmin";
    $dbpass = "Y)e7)ZGKtJ8LTu?k";
    $dbname = "id16371456_dbparticipants";
	$data;
	
	
	
		// Create connection
		$conn = new mysqli($server, $dbuname, $dbpass, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}else{
			$fetchdata = "SELECT id, name, username, payment From partlist";
			$data = $conn->query($fetchdata);
			if($data->num_rows > 0){
			    echo '<table width="100%" border="1" style="border-collapse: collapse">';
			    echo "<tr><th>ID</th><th>Name</th><th>Username</th><th>Payment</th></tr>";
				while($row = $data->fetch_assoc()){
				    if($row["payment"]==1){
				            $payment="Confirmed";
				        }else{
				            $payment="Pending";
				        }
					echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["username"]."</td><td>".$payment."</td></tr>";
				}
				echo "</table>";
			}else{
				echo "<h2>No one has registered yet</h2>";
			}
			
		}
	$conn->close();
	
?>
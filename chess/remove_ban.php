<?php
	$remove_id= $_POST['ipid'];
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
				$task= "DELETE FROM banned WHERE id=?";
				
				$stmt=$conn->prepare($task);
				$stmt->bind_param("i", $remove_id);
				$stmt->execute();
				$stmt->close();
				
				header("Refresh:2; url=admin_page.html");
			}
		}else{
			echo "Wrong Authrization Key";
		}
	}else{
		echo "Wrong Authrization Key";
	}
	$conn->close();
?>
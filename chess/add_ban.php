<?php
	$in_auth= $_POST['auth'];
	$ip= $_POST['ban_add'];
	$reason= $_POST['ban_reason'];
	$date= date("d/m/Y");
	$time= date("H:i:s");
	
	$server = "localhost";
	$dbuname = "id16371456_dbadmin";
	$dbpass = "Y)e7)ZGKtJ8LTu?k";
	$dbname = "id16371456_dbparticipants";
	
	$conn= new mysqli($server, $dbuname, $dbpass, $dbname);
	
	if(!empty($in_auth) || !empty($ip) || !empty($reason)){
		if($in_auth==='motherflipper69420'){
			
			//connection validation
			if($conn->connect_error){
				die("Connection failed: " . $conn->connect_error);
			}else{
				$task= "INSERT INTO banned(ip, date, time, reason) VALUES('$ip', '$date', '$time', '$reason')";
				
				if($conn->query($task)===true){
				    header("Refresh:2; url=admin_page.html");
			    }else{
				echo "Error: " . $task . "<br>" . $conn->error;
			    }
				
				
	    	}
		}else{
		        header("Refresh:1; url=admin_page.html");
	    }
	    
	}else{
        echo "Wrong Authrizartion Key";
	}
	$conn->close();
?>
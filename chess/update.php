<?php
	$in_auth= $_POST['auth'];
	$partid = $_POST['id'];
	$partstat = $_POST['status'];
	
	$server = "localhost";
	$dbuname = "id16371456_dbadmin";
	$dbpass = "Y)e7)ZGKtJ8LTu?k";
	$dbname = "id16371456_dbparticipants";
	
	$conn= new mysqli($server, $dbuname, $dbpass, $dbname);
	
	if($in_auth==='motherflipper69420'){
	
	    //connection validation
	    if($conn->connect_error){
		    die("Connection failed: " . $conn->connect_error);
	    }else{
    		if(!empty($partstat)){
		        $task="UPDATE partlist SET payment =? where id= ?";
			
		        $stmt= $conn->prepare($task);
	            $stmt->bind_param("ii", $partstat, $partid);
		        $stmt->execute();

    		    $stmt->close();
		
	    	    header("Refresh:2; url=admin_page.html");
	    	}else{
		        header("Refresh:1; url=admin_page.html");
		    }
	    }
	    
	}else{
        echo "Wrong Authrizartion Key";
	}
	$conn->close();
?>
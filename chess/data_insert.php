<?php
	$in_name = $_POST['Name'];
	$in_uname = $_POST['Username'];
	$in_email = $_POST['Email'];
	$in_wanum = $_POST['Whatsapp'];
	$in_zoom = $_POST['Zoom'];
	
	if(!empty($in_name) || !empty($in_uname) || !empty($in_email) || !empty($in_wanum)
	|| !empty($in_zoom)){
		
		$server = "localhost";
	    $dbuname = "id16371456_dbadmin";
	    $dbpass = "Y)e7)ZGKtJ8LTu?k";
	    $dbname = "id16371456_dbparticipants";
		
		$conn = new mysqli($server, $dbuname, $dbpass, $dbname);
		
		//connection validation
		if($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
		}else{
			
			//Name Validation
			if(!preg_match("/^[a-zA-Z-' ]*$/",$in_name)){
				die ("Only Letters and spaces allowed in Name");
			}
			
			//username validation
			if (strpos($str, ' ') !== false){
			    die("No Spaces in Username");
			}else{
				$validate = "select * from partlist where username='$in_uname'";
				$result = mysqli_query($conn, $validate);
				if(mysqli_num_rows($result)>0){
					die("Someone already registered using this Username");
				}
			}
			
			//Email Validation
			if (!filter_var($in_email, FILTER_VALIDATE_EMAIL)){
				die ("Invalid Email");
			}else{
				$validate = "select * from partlist where email='$in_email'";
				$result = mysqli_query($conn, $validate);
				if(mysqli_num_rows($result)>0){
					die("Someone already registered using this Email");
				}
			}
			
			//Phone number Validation
			if(!filter_var($in_wanum, FILTER_SANITIZE_NUMBER_INT)){
				die("Invalid Phone Number");
			}else{
				if(strlen($in_wanum)!=10){
					die("Invalid Phone Number");
				}else{
				    $validate = "select * from partlist where wanum='$in_wanum'";
				    $result = mysqli_query($conn, $validate);
				    if(mysqli_num_rows($result)>0){
				    	die("Someone already registered using this Whatsapp Number");
				    }
				}
			}
			
			
			//zoom if validation
			if(!preg_match("/^[1-9][0-9]{9}$/", $in_zoom)){
				die("Invalid Zoom ID");
			}else{
			    $validate = "select * from partlist where zoom='$in_zoom'";
				$result = mysqli_query($conn, $validate);
				if(mysqli_num_rows($result)>0){
					die("Someone already registered using this Zoom ID");
				}
			}
			
			//data entry
			$entry = "INSERT Into partlist (name, username, email, wanum, zoom) VALUES ('$in_name', '$in_uname', '$in_email', '$in_wanum', '$in_zoom')";
			if($conn->query($entry)===true){
				echo "New Data Inserted";
			}else{
				echo "Error: " . $entry . "<br>" . $conn->error;
			}
		}
	}
?>
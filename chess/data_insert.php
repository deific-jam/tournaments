<?php 
    
	$in_name = $_POST['Name'];
	$in_uname = $_POST['Username'];
	$in_email = $_POST['Email'];
	$in_wanum = $_POST['Whatsapp'];
	$in_zoom = $_POST['Zoom'];
	$in_address= getIpAddress(); //$_SERVER['REMOTE_ADDR'];
	$in_date= date("d/m/Y");
	$in_time= date("H:i:s");
	
	/*$proxy_headers = array(
        'HTTP_VIA',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_FORWARDED',
        'HTTP_CLIENT_IP',
        'HTTP_FORWARDED_FOR_IP',
        'VIA',
        'X_FORWARDED_FOR',
        'FORWARDED_FOR',
        'X_FORWARDED',
        'FORWARDED',
        'CLIENT_IP',
        'FORWARDED_FOR_IP',
        'HTTP_PROXY_CONNECTION'
    );
    foreach($proxy_headers as $x){
        if (isset($_SERVER[$x])) die("You are using a proxy!");
    }*/
	
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
		    
		    $validate = "select * from banned where ip='$in_address'";
	        $result = mysqli_query($conn, $validate);
		    if(mysqli_num_rows($result)>0){
			    $message = "You are banned from registering. Contact the Admins";
                echo "<script>alert('$message');</script>";
                
		    }
			
			//Name Validation
			if(!preg_match("/^[a-zA-Z-' ]*$/",$in_name)){
				$message = "Only Letters and spaces allowed in Name";
                echo "<script>alert('$message');</script>";
			}
			
			//username validation
			if (strpos($in_uname, ' ') !== false){
			    die("No Spaces in Username");
			}else{
				$validate = "select * from partlist where username='$in_uname'";
				$result = mysqli_query($conn, $validate);
				if(mysqli_num_rows($result)>0){
					$message = "Someone already registered using this Username";
                    echo "<script>alert('$message');</script>";
                    echo "<script>location.href = '/register.html';</script>";
                    die();
				}
			}
			
			//Email Validation
			if (!filter_var($in_email, FILTER_VALIDATE_EMAIL)){
				die ("Invalid Email");
			}else{
				$validate = "select * from partlist where email='$in_email'";
				$result = mysqli_query($conn, $validate);
				if(mysqli_num_rows($result)>0){
					$message = "Someone already registered using this Email";
                    echo "<script>alert('$message');</script>";
                    echo "<script>location.href = '/register.html';</script>";
                    die();
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
				    	$message = "Someone already registered using this Whatsapp Number";
                        echo "<script>alert('$message');</script>";
                        echo "<script>location.href = '/register.html';</script>";
                        die();
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
					$message = "Someone already registered using this Zoom ID";
                    echo "<script>alert('$message');</script>";
                    echo "<script>location.href = '/register.html';</script>";
                    die();
				}
			}
			
			//Length of Input Validation
			if(strlen(in_name)>30){
			    $message = "Name should be not more than 30 characters";
                echo "<script>alert('$message');</script>";
                echo "<script>location.href = '/register.html';</script>";
                die();
            }
            if(strlen(in_uname)>30){
			    $message = "Username should be not more than 30 characters";
                echo "<script>alert('$message');</script>";
                echo "<script>location.href = '/register.html';</script>";
                die();
            }
            if(strlen(in_email)>40){
			    $message = "Name should be not more than 40 characters. Contact the admins";
                echo "<script>alert('$message');</script>";
                echo "<script>location.href = '/register.html';</script>";
                die();
            }
			
			//data entry
			$entry = "INSERT Into partlist (name, username, email, wanum, zoom, payment, ip, date, time) VALUES ('$in_name', '$in_uname', '$in_email', '$in_wanum', '$in_zoom', false, '$in_address', '$in_date',  '$in_time')";
			if($conn->query($entry)===true){
			    $message = "Registeration Successful";
			    echo "<script>alert('$message')</script>";
			    echo "<script>location.href = '/participants.html';</script>";
                die();
			}else{
				echo "Error: " . $entry . "<br>" . $conn->error;
			}
		}
	}
	
	function getIpAddress()
    {
        $ipAddress = '';
        if (! empty($_SERVER['HTTP_CLIENT_IP']) && $this->isValidIpAddress($_SERVER['HTTP_CLIENT_IP'])) {
            // check for shared ISP IP
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // check for IPs passing through proxy servers
            // check if multiple IP addresses are set and take the first one
            $ipAddressList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($ipAddressList as $ip) {
                if (isValidIpAddress($ip)) {
                    $ipAddress = $ip;
                    break;
                }
            }
        } else if (! empty($_SERVER['HTTP_X_FORWARDED']) && $this->isValidIpAddress($_SERVER['HTTP_X_FORWARDED'])) {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if (! empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && $this->isValidIpAddress($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
            $ipAddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        } else if (! empty($_SERVER['HTTP_FORWARDED_FOR']) && $this->isValidIpAddress($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (! empty($_SERVER['HTTP_FORWARDED']) && $this->isValidIpAddress($_SERVER['HTTP_FORWARDED'])) {
            $ipAddress = $_SERVER['HTTP_FORWARDED'];
        } else if (! empty($_SERVER['REMOTE_ADDR']) && $this->isValidIpAddress($_SERVER['REMOTE_ADDR'])) {
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        }
        return $ipAddress;
    }
    
    function isValidIpAddress($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
            return false;
        }
        return true;
    }
?>
<?php 
	/*if($_SERVER["HTTPS"] != "on" || $_SERVER['SERVER_PORT'] == 80 ) 
	{ 
		$newurl = "https://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]; 
		header("Location: $newurl"); 
		exit(); 
    } */
?>

<!DOCTYPE HTML> 
<html>
	<head>
		<link media="screen" type="text/css" rel="stylesheet" href="style.css" />
		<title>Roulette login + session test website!</title> 
	</head>
<body>

<?php
	//LOGIN FORM SENT && NOT LOGGED IN!
	if ( isset( $_POST['r_login'] ) && !isset( $_SESSION['UserId'] ) )
	{
		//echo "Login form sent!";
		$data = array( "EmailOrUsername" => $_POST['r_username'], "Password" => $_POST['r_password'], "SiteId" => 3, "IpAddress" => "127.0.0.1" );
		$data_string = json_encode($data);
		
		$contextData = array ( 
						'method' => 'POST',
						'header' => "Connection: close\r\n".
									"Content-type: text/json; charset=utf-8\r\n".
									"X-Client-Id: e4650ce7-21b5-11e2-af35-4040da9c77a0\r\n".
									"Content-Length: ".strlen($data_string)."\r\n",
						'content'=> $data_string );
		 
		// Create context resource for our request
		$context = stream_context_create (array ( 'http' => $contextData ));
		 
		// Read page rendered as result of your POST request
		$result =  file_get_contents ('http://dev06-sgp.bedegaming.com:18206/Player/Login',  // page url
										false,
										$context);
										
		$res_data = json_decode( $result, true );
		
		//Successful login!
		if ( $res_data["Status"] == "OK" )
		{
			session_start();
			$_SESSION['UserId'] = $res_data['UserId'];
			$_SESSION['Token'] = $res_data['Token'];
			$_SESSION['PlayerInfo'] = $res_data['PlayerInfo'];
		}
		else
			printf( $result );
	}
	
	//We are logged in!
	if( isset( $_SESSION['UserId'] ) )
	{
		include_once("r.html");
		include_once("logout.php");
	}
	else
	{
		//Not logged in, use login form!
		include_once("login.php");
	}
?>
</body>
</html>
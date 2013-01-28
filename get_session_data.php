<?php 
	$headers = getallheaders ();
	//$headers = apache_request_headers();
	/*
	$headers = array();
		foreach($_SERVER as $key => $value) 
		{
			if (substr($key, 0, 5) <> 'HTTP_') {
				continue;
        }
        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
        $headers[$header] = $value;
    }
	*/
	if ( !isset( $headers['GameCode'] ) || $headers['GameCode'] != '1433' )
	{
		echo "ACCESS NOT ALLOWED";
		return;
	}
	else
	{
		session_start();
		
		if ( isset( $_SESSION['UserId'] ) && isset( $_SESSION['Token'] ) )
		{
			$data = array( "UserId" => $_SESSION['UserId'], "Token" => $_SESSION['Token'] );
			$data_string = json_encode($data);
		}
		
		echo $data_string;
	}
?>

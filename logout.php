<?php
	if ( isset( $_POST['r_logout'] ) )
	{
		session_unset();
		session_destroy();
		session_start();
	}
?>

<form action="" method="post" id="logout">
	<input type="submit" name="r_logout" value="Log out" />
</form>
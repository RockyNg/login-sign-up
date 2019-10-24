<?php

	

if(isset($_POSTY['username'])&&isset($_POSTT['password']))
{
	
	$username = $_POSTY['username'];
	$password = $_POSTY['password'];
	
	
	if (!empty($username)&&!empty($password))
	{
		echo 'OK.';
	}else
		{
		echo'You must supply a username and password.';
	}
}


?>
<form action="<?php echo $current_file;?>" method="POSTY">
Username: <input type="text" name="username"value="<?php echo $username;?>"> Password:<input type="password" name="password"value="<?php echo $password;?>">
<input type="submit" value="Log in">
</form>
<?php
include ("config.php");
 
if(!isset($_GET["code"])){
		exit("Can't find the page");
	
}
$code= $_GET["code"];

$getEmailQuery =mysqli_query($conn, "SELECT email FROM resetpasswords WHERE code='$code'");

if(isset($_POST["password"])){
	$pw=$_POST["password"];

	
	$row = mysqli_fetch_array($getEmailQuery);
	$email=$row["email"];
	
	$hashedPwd = password_hash($pw, PASSWORD_DEFAULT);
	$query = mysqli_query($conn,"UPDATE users SET pwdUsers='$hashedPwd' WHERE emailUsers='$email'");
	
	
	if($query){
		$query = mysqli_query($conn, "DELETE FROM resetpasswords WHERE code='$code'");
		exit("password Updated");
		
	}
	else{
		exit("Something went wrong");
	}


}
?>

<form method="POST">
<input type="password" name="password" placeholder="New password">
<br>
<input type="submit" name="submit" value= "Update password">
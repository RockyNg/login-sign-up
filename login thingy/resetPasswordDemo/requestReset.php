<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'config.php';



if(isset($_POST["email"])){
	
	$emailTo = $_POST["email"];
	
	$code = uniqid(true);
	$query = mysqli_query($conn, "INSERT INTO resetpasswords(code, email) VALUES('$code','$emailTo')");
	if(!$query){
		exit("Error");
		
		
	}
	$mail = new PHPMailer(true);

	try {
		//Server settings
		$mail->isSMTP();                                            // Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = 'rockeee18@gmail.com';                     // SMTP username
		$mail->Password   = 'beawes0me';                               // SMTP password
		$mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		$mail->Port       = 587;                                    // TCP port to connect to

		//Recipients
		$mail->setFrom('rockeee18@gmail.com', 'FRBooks');
		$mail->addAddress($emailTo);     // Add a recipient
		$mail->addReplyTo('no-reply@gmail.com', 'No reply');
	  


		// Content
		$url= "http://". $_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/resetPassword.php?code=$code";

		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'Your password reset link';
		$mail->Body    = "<h1>You requested a password reset link</h1>
								Click <a href='$url'>this link</a> to do so";
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
		echo 'Reset password link has been sent to your email';
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
	exit();
}
// Instantiation and passing `true` enables exceptions

?>

<form method="POST">
	<input type="text" name="email" placeholder="Email" autocomplete="off">
	<br>
	<input type="submit" name="submit" value="Reset email"> 

</form>
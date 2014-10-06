<?php 
	
	require_once("photoGallery/incl/phpmailer/class.phpmailer.php");
	require_once("photoGallery/incl/phpmailer/class.smtp.php");
	require_once("photoGallery/incl/phpmailer/language/phpmailer.lang-de.php");

	$to_name = "Mirko Czerny";
	$to = "mczerny@gmx.de";
	$subject = "Mail Test at ".strftime("%T", time());
	$message = "This is a testmessage";
	$message = wordwrap($message, 70);
	$from_name = "Gurkensalat";
	$from = "mczerny@gmx.de";

	// PHP mail version (default)

	$mail = new PHPMailer();

	$mail->FromName 	= $from_name;
	$mail->From 		= $from;
	$mail->AddAddress($to, $to_name);
	$mail->Subject = $subject;
	$mail->Body = $message;

	$result = $mail->Send();
	// $result = mail($to, $subject, $message, $headers);
	echo $result ? "succes, mail sent" : "failure, mail NOT sent";

?>
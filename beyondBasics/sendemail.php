<?php 

	// $to = "mczerny@gmx.de";

	// Windows might not handle this format well
	$to = "Mirko Czerny <mczerny@gmx.de>";

	// multiple recipients
	// $to = "mczerny@gmx.de, shavedturtle@gmx.de"
	// $to = "mczerny@gmx.de, Mirko Czerny <shavedturtle@gmx.de>";

	$subject = "Mail Test at ".strftime("%T", time());

	$message = wordwrap("This is a testmessage", 70);

	$from = "Mirko Czerny <mczerny@gmx.de>";
	$headers  = "From: {$from}\n";
	$headers .= "Reply-To: {$from}\n";
	// $headers .= "Cc: {$to}\n";
	// $headers .= "Bcc: {$to}\n";
	$headers .= "X-Mailer: PHP/".phpversion()."\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-Type: text/plain; charset=iso-8859-1";


	$result = mail($to, $subject, $message, $headers);

	echo $result ? "succes, mail sent" : "failure, mail NOT sent";

?>
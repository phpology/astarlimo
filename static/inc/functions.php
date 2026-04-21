<?php
function pprint_r($array = null, $exit = true)
{
	echo "<pre>";
		print_r($array);
	echo "</pre>";
	echo "<hr />";

	if($exit) { exit; }		
}

function send_email($to = null, $from = null, $subject = null, $message = null, $attachment = null, $debug = false)
{
	//Create a new PHPMailer instance
	$mail = new PHPMailer;

	if($debug)
	{
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 2;
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
	}

	$mail->IsSMTP();                // send via SMTP
	$mail->Host     = SMTP_HOST; 		// SMTP servers
	$mail->SMTPAuth = true;     		// turn on SMTP authentication
	$mail->Username = SMTP_USERNAME; // SMTP username
	$mail->Password = SMTP_PASSWORD; // SMTP password

	//Set who the message is to be sent from
	$mail->setFrom($from, $from);
	//Set who the message is to be sent to
	$mail->addAddress($to);
	//Set the subject line
	$mail->Subject = $subject;
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML($message);
	$mail->isHTML(true);                                  // Set email format to HTML

	if(!is_null($attachment))
	{
		$mail->addAttachment($attachment);
	}

	//send the message, check for errors
	if (!$mail->send()) {
	    echo "Mailer Error: " . $mail->ErrorInfo;
	    return false;
	}
	return true;
}
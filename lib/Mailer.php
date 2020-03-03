<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';

class Mailer{
	public function sendFeatureRequestEmail(){
		$mail = new PHPMailer(true);
		try {
			//Server settings
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
			$mail->isSMTP();                                            // Send using SMTP
			$mail->Host       = 'malta.metanet.ch';                    // Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = 'pm@mastaz.ch';                     // SMTP username
			$mail->Password   = 'B*x1ao56';                               // SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
			$mail->Port       = 587;                                    // TCP port to connect to

			//Recipients
			$mail->setFrom('do-not-reply@mastaz.ch', 'Mailer');
			$mail->addAddress('shabbir.bharmal@arsenaltech.com', 'Shabbir');     // Add a recipient
			/*$mail->addReplyTo('info@example.com', 'Information');
			$mail->addCC('cc@example.com');
			$mail->addBCC('bcc@example.com');*/

			// Attachments
			/*$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name*/

			// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Here is the subject';
			$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
}
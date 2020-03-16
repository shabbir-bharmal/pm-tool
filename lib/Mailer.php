<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

/**
 * Class Mailer
 */
class Mailer
{
	/**
	 * @var PHPMailer
	 */
	public $mail;

	/**
	 *
	 */
	public function __construct()
	{
		$mail = new PHPMailer(true);
		try {
			//Server settings
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
			$mail->isSMTP();                                            // Send using SMTP
			$mail->Host       = SMTP_HOST;                    // Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = SMTP_USERNAME;                     // SMTP username
			$mail->Password   = SMTP_PW;                               // SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
			$mail->Port       = SMTP_PORT;                                    // TCP port to connect to
			$this->mail       = $mail;
		} catch (Exception $e) {
			echo "Can't establish SMTP connection. Error: {$mail->ErrorInfo}";
		}
	}

	/**
	 * Send mail to admin once Feature Request has submitted
	 * @param $data
	 * @return bool
	 */
	public function sendFeatureRequestEmail($data)
	{
		try {
			$mail = $this->mail;

			//Recipients
			$mail->setFrom('do-not-reply@mastaz.ch', 'mastaz.ch');
			$mail->addAddress('philipp@wuermli.com');     // Add a recipient
			// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Neuer Feature beantragt';

			$body = '<p>Hallo, </p>';
      $body .= '<p>Ein neuer Feature mit dem Titel <b>'.$data['f_title'].'</b> wurde beantragt, bitte pr&uuml;fen.</p>';
      $body .= '<p>https://pm.mastaz.ch/feature-request.php?f_id='.$data['f_id'].'</p>';      
      

			$mail->Body = $body;

			$mail->send();
			return true;
		} catch (Exception $e) {

		}
		return false;
	}

	/**
	 * Send mail to admin once Epic Request has submitted
	 * @param $data
	 * @return bool
	 */
	public function sendEpicRequestEmail($data)
	{
		try {
			$mail = $this->mail;

			//Recipients
			$mail->setFrom('do-not-reply@mastaz.ch', 'mastaz.ch');
			//$mail->addAddress('wurp@zhaw.ch');     // Add a recipient
      		$mail->addAddress('philipp@wuermli.com');     // Add a recipient
			
			// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Neuer Epic erfassen';

			$body = '<p>Hallo, </p>';
			$body .= '<p>Ein neuer Epic mit dem Titel <b>'.$data['e_title'].'</b> wurde beantragt, bitte pr&uuml;fen.</p>';
      $body .= '<p>https://pm.mastaz.ch/epic-request.php?e_id='.$data['e_id'].'</p>';      

			$mail->Body = $body;

			$mail->send();
			return true;
		} catch (Exception $e) {

		}
		return false;
	}
}
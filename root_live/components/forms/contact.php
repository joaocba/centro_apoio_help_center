<?php
// require ReCaptcha class
require('recaptcha-master/src/autoload.php');
require('PHPMailer-master/PHPMailerAutoload.php');

// configure
// an email address that will be in the From field of the email.
$fromEmail = $_POST['email'];
$fromName = $_POST['name'];

// an email address that will receive the email with the output of the form
$sendToEmail = 'contact@blakw.com';
$sendToName = 'Nova mensagem de contacto recebida';

// subject of the email
$subject = 'Nova mensagem de contacto recebida';

// form field names and their translations.
// array variable name => Text to appear in the email
$fields = array('name' => 'Name', 'email' => 'Email', 'message' => 'Message');

// message that will be displayed when everything is OK :)
$okMessage = header('Location: ../../contacto.php?status=contactsent');

// If something goes wrong, we will display this message.
$errorMessage = header('Location: ../../contacto.php?status=senderror');

// ReCaptch Secret
$recaptchaSecret = '6Le87ikkAAAAAMNq1qGaRqecCKeuQbtv6LnfSU1h';

// if you are not debugging and don't need error reporting, turn this off by error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE);

try {
    if (!empty($_POST)) {

        // validate the ReCaptcha, if something is wrong, we throw an Exception,
        // i.e. code stops executing and goes to catch() block

        if (!isset($_POST['g-recaptcha-response'])) {
            throw new \Exception('ReCaptcha is not set.');
        }

        // do not forget to enter your secret key from https://www.google.com/recaptcha/admin

        $recaptcha = new \ReCaptcha\ReCaptcha($recaptchaSecret, new \ReCaptcha\RequestMethod\CurlPost());

        // we validate the ReCaptcha field together with the user's IP address

        $response = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

        if (!$response->isSuccess()) {
            throw new \Exception('ReCaptcha was not validated.');
        }

        // everything went well, we can compose the message, as usually

        if(count($_POST) == 0) throw new \Exception('Form is empty');

        $emailTextHtml = "<h1>Centro de Apoio - Contacto</h1><hr>";
        $emailTextHtml .= "<table>";

        foreach ($_POST as $key => $value) {
            // If the field exists in the $fields array, include it in the email
            if (isset($fields[$key])) {
                $emailTextHtml .= "<tr><th>$fields[$key]</th><td>$value</td></tr>";
            }
        }
        $emailTextHtml .= "</table><hr>";

        $mail = new PHPMailer;

        $mail->setFrom($fromEmail, $fromName);
        $mail->addAddress($sendToEmail, $sendToName); // you can add more addresses by simply adding another line with $mail->addAddress();
        $mail->addReplyTo($from);

        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->msgHTML($emailTextHtml); // this will also create a plain-text version of the HTML email, very handy


        if(!$mail->send()) {
            throw new \Exception('We could not send the email.' . $mail->ErrorInfo);
        }

        $responseArray = array('type' => 'success', 'message' => $okMessage);
    }
}
catch (\Exception $e)
{
    // $responseArray = array('type' => 'danger', 'message' => $errorMessage);
    $responseArray = array('type' => 'danger', 'message' => $e->getMessage());
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
} else {
    echo $responseArray['message'];
}

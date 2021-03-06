<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */

//Import PHPMailer classes into the global namespace
// use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
// require '../vendor/autoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug =0;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "info@mogulmatter.com";

//Password to use for SMTP authentication
$mail->Password = "Mogulmatter1!";

// keeps the current $mail settings and creates new object
$mail1 = clone $mail;

//Set who the message is to be sent from
$mail->setFrom('info@mogulmatter.com', 'MogulMatter');
//For user mail set who the message is to be sent from
$mail1->setFrom('info@mogulmatter.com', 'MogulMatter');
//Set an alternative reply-to address
$mail->addReplyTo('info@mogulmatter.com', 'MogulMatter');

//Set who the message is to be sent to
$mail->addAddress('info@mogulmatter.com', 'MogulMatter');
//For user mail set who the message is to be sent to
$mail1->addAddress($_POST['emailaddress'], 'MogulMatter');
//$mail->addAddress($_POST['emailaddress'] , 'MogulMatter');

//Set the subject line
$mail->Subject = 'SMM Submission';
//For user mail set the subject line
$mail1->Subject = 'SMM Submission';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
// $mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$html = '<p> Firstname: ' .$_POST['firstname'].'</p>';
$html.= '<p> Lastname: ' .$_POST['lastname'].'</p>';
$html.= '<p> Email: ' .$_POST['email'].'</p>';
$html.= '<p> Phone: ' .$_POST['phone'].'</p>';
$html.= '<p> CC-name: ' .$_POST['cc-name'].'</p>';
$html.= '<p> CC-number: ' .$_POST['cc-number'].'</p>';
$html.= '<p> CC-expiration: ' .$_POST['cc-expiration'].'</p>';
$html.= '<p> CC-CVV: ' .$_POST['cc-cvv'].'</p>';
$html.= '<p> Zipcode: ' .$_POST['zipcode'].'</p>';

$html1 = "<p>Hello ".$_POST['firstname']."</p>

<p>Thank you for your interest in Fb + IG Ads for ".$_POST['businessname'].".</p>

<p>We will reach out to you shortly to get started with your project</p>

<p>Thank you, <br> MogulMatter</p>";

$mail->msgHTML($html);

$mail1->msgHTML($html1);

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

$mail1->AltBody = 'This is a plain-text message body';

//Attach an image file
// $mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} elseif(!$mail1->send()){ 
echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{    echo "Thank you for your submission";

    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}


//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
/*
function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}*/

header('Location: https://www.mogulmatter.com/success.html');
die;
?>


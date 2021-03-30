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

//Set who the message is to be sent from
$mail->setFrom('info@mogulmatter.com', 'MogulMatter');

//Set an alternative reply-to address
$mail->addReplyTo('info@mogulmatter.com', 'MogulMatter');

//Set who the message is to be sent to
$mail->addAddress('info@mogulmatter.com', 'MogulMatter');
//$mail->addAddress($_POST['emailaddress'] , 'MogulMatter');

//Set the subject line
$mail->Subject = 'MogulMatter Contact Us';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
// $mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$html = '<p> Firstname: ' .$_POST['firstname'].'</p>';
$html.= '<p> Lastname: ' .$_POST['lastname'].'</p>';
$html.= '<p> Email: ' .$_POST['emailaddress'].'</p>';
$html.= '<p> Message: ' .$_POST['message'].'</p>';
$html.= '<p> Services: ' .implode("," , $_POST['services']).'</p>';
$mail->msgHTML($html);

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

//Attach an image file
// $mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Thank you for contacting us, We will message you shortly. Please continue on in our site.";
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
function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css"/>  
    <link rel="shortcut icon" type="image/png" href="src/favicon.png"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="css/style.css"/>  
    <title>MogulMatter|Home</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand pl-5 pr-5" href="index.html">MogulMatter</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse centered" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto pr-5">
    <li class="nav-item active pr-2">
        <a class="nav-link" href="index.html">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="websitedesign.html">Website Design<span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="websitehosting.html">Website Hosting<span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="advertising.html">Advertising<span class="sr-only"></span></a>
      </li>
    </ul>
  </div>
</nav>
<!--End Nav Bar--->

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4 text-center">MogulMatter</h1>
    <p class="lead text-center">We are a company that has been in Advertising, Website Design and Real Estate Photography and Video for many years. We create websites from scratch, get clients more business and make amazing high quality media.</p>
  </div>
</div>


<br><br>
<!--- Strart Card Deck--->
<div class="container mb-5">
<div class="card-deck">
  <div class="card">
    <img class="card-img-top" src="src/webad.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title text-center">Website Design</h5>
      <p class="card-text">We create and manage websites, from single page profiles to multiple complex e-commerce websites. We use the best computer programmers and designers. We have the best servers and foundation for all website. We use Google Cloud Platform and Amazon Web Services.
      </p>
    </div>
    <div class="card-footer text-center">
      <a href="websitedesign.html"><button type="button" class="btn btn-dark">Find Out More</button></a>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="src/fbadcard.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title text-center">Advertising</h5>
      <p class="card-text">We help our clients build their business though online advertising. We have been specializing in advertising for 11+ years. We manage Facebook, Instagram and Google Ad accounts</p>
    </div>
    <div class="card-footer text-center">
      <a href="advertising.html"><button type="button" class="btn btn-dark">Find Out More</button></a>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="src/housead2.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title text-center">Real Estate Photo & Video</h5>
      <p class="card-text">For many years we have been helping our clients show properties in the best way with the highest quality media. Schedule and an appointment to day to get started on your property.</p>
    </div>
    <div class="card-footer text-center">
      <a href="realestate.html"><button type="button" class="btn btn-dark">Find Out More</button></a>
    </div>
  </div>
</div>
</div>
<!--- End Card Deck--->

<!--- Contact form--->
<div class="container-fluid bg-secondary text-white">
<div class="container pt-5 pb-5 bg-secondary text-white">
  <div class="display-4 text-center mb-3">
    Contact Us
  </div>
<form action="sendgmail.php" method="post">
  <div class="form-group">
    <div class="form-row mb-3">
    <div class="col">
      <label for="exampleInputEmail1">First Name</label>
      <input type="text" name="firstname" class="form-control" placeholder="First name">
    </div>
    <div class="col">
      <label for="exampleInputEmail1">Last Name</label>
      <input type="text" name="lastname" class="form-control" placeholder="Last name">
    </div>
  </div>
    <label for="exampleInputEmail1">Email Address</label>
    <input type="email" class="form-control" name="emailaddress"id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <hr>
  <label for="exampleInputEmail1">Services I am Interested in</label>
  <br>
  <div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Advertising">
  <label class="form-check-label" name="services[]" for="inlineCheckbox1">Advertising</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" name="services[]" type="checkbox" id="inlineCheckbox2" value="Website Design">
  <label class="form-check-label" for="inlineCheckbox2">Website Design</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input"  name="services[]" type="checkbox" id="inlineCheckbox2" value="Real Estate Photo/Video">
  <label class="form-check-label" for="inlineCheckbox2">Real Estate Photo/Video</label>
</div>
  <br>
<hr>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Message</label>
    <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button type="submit" name="submit" class="btn btn-primary mt-3">Submit</button>
</form>
</div>
</div>
<!--- End Contact Form--->

<!-- Footer -->
  <section id="footer">
    <div class="container">
      <div class="row text-center text-xs-center text-sm-left text-md-left">
        <div class="col-xs-12 col-sm-4 col-md-4">
        <h5>Website Hosting</h5>
          <ul class="list-unstyled quick-links">
            <li><a href="websitehosting.html"><i class="fa fa-angle-double-right"></i>Home</a></li>
            <li><a href="websitehosting.html"><i class="fa fa-angle-double-right"></i>Pricing</a></li>
          </ul>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
          <h5>Website Design</h5>
          <ul class="list-unstyled quick-links">
            <li><a href="websitedesign.html"><i class="fa fa-angle-double-right"></i>Home</a></li>
            <li><a href="contact.html"><i class="fa fa-angle-double-right"></i>Contact</a></li>
            <li><a href="websitedesign.html"><i class="fa fa-angle-double-right"></i>Pricing</a></li>
          </ul>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4">
          <h5>Advertising</h5>
          <ul class="list-unstyled quick-links">
            <li><a href="advertising.html"><i class="fa fa-angle-double-right"></i>Home</a></li>
            <li><a href="contact.html"><i class="fa fa-angle-double-right"></i>Contact</a></li>
            <li><a href="advertising.html"><i class="fa fa-angle-double-right"></i>Pricing</a></li>
          </ul>
        </div>
      </div>
  
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
          <p><u><a href="mogulmatter.com">MogulMatter.com</a></u> Is a Registered Company In Los Angeles California<br> All Designs created by MogulMatter</p>
          <p class="h6">&copy All right Reversed.<a class="text-green ml-2" href="https://www.mogulmatter.com" target="_blank">MogulMatter</a></p>
        </div>
      </div>
      </div>
  </section>
  <!-- ./Footer -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>


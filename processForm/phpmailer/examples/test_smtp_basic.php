<html>
<head>
<title>PHPMailer - SMTP basic test with authentication</title>
</head>
<body>

<?php

//error_reporting(E_ALL);
error_reporting(E_STRICT);

date_default_timezone_set('Asia/Calcutta');

require_once('../class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

$body             = file_get_contents('contents.html');
$body             = preg_replace('/[\]/','',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "mail.goaecotourism.com"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "mail.goaecotourism.com"; // sets the SMTP server
$mail->Port       = 26;                    // set the SMTP port for the GMAIL server
$mail->Username   = "admin@goaecotourism.com"; // SMTP account username
$mail->Password   = "get@123";        // SMTP account password

$mail->SetFrom('admin@goaecotourism.com', 'Goa Eco Tourism');

$mail->AddReplyTo("admin@goaecotourism.com", "Goa Eco Tourism");

$mail->Subject    = "PHPMailer Test Subject via smtp, basic with authentication";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML(file_get_contents('contents.html'));

$address = "dmsservicesgoa@gmail.com";
$mail->AddAddress($address, "DMS Services");
$mail->AddAddress("admin@goaecotourism.com", "Admin Jungle book");

$mail->AddAttachment("images/phpmailer.gif");      // attachment
$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>

</body>
</html>

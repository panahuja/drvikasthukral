<?php 
//GET IN TOUCH EMAIL NOTIFICATION
if(isset($_POST['Submit']) && $_POST['Submit'] == "Submit")
{
if(isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response']!=''){
$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lf9IUsUAAAAABJLcj8QuJ4_qzPK7yUQwrLxtKcT&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
foreach($_POST as $key=>$value){$$key = str_replace("'","",$value);}
require_once('class.phpmailer.php');
$mail  = new PHPMailer();
$body = '<p>Dear Admin,</p><p>Please see the below appointment details.</p><table>
<tr><td><b>Name </b></td><td><b>:</b></td><td>'.$name.' '.$lname.'</td></tr>
<tr><td><b>Phone </b></td><td><b>:</b></td><td>'.$phone.' </td></tr>
<tr><td><b>Email </b></td><td><b>:</b></td><td>'.$email.'</td></tr>
<tr><td><b>Message </b></td><td><b>:</b></td><td>'.$msg.'</td></tr>
</table><p>Kind Regards,<br />Dr. Vikas Thukral Team<br/>www.drvikasthukral.com</p>';
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "webmail.drvikasthukral.com"; // SMTP server
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "webmail.drvikasthukral.com";      // sets GMAIL as the SMTP server
$mail->Username   = "smtp@drvikasthukral.com";  // GMAIL username
$mail->Password   = "WsT]Pq+(G+g&";           // GMAIL password
$mail->SetFrom('info@drvikasthukral.com', 'info');
$mail->AddReplyTo($email,$name);
$mail->Subject    = "Make an Appointment";
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($body);
$mail->AddAddress('info@drvikasthukral.com', "info");
$mail->AddAddress('viksthukral@gmail.com', "info");

$mail->Send();
//EMAIL USER
$mail  = new PHPMailer();
$body = '<p>Dear '.$name.',</p><p>Please see the below appointment details.</p>
<table>
<tr><td><b>Name </b></td><td><b>:</b></td><td>'.$name.' '.$lname.'</td></tr>
<tr><td><b>Phone </b></td><td><b>:</b></td><td>'.$phone.' </td></tr>
<tr><td><b>Email </b></td><td><b>:</b></td><td>'.$email.'</td></tr>
<tr><td><b>Message </b></td><td><b>:</b></td><td>'.$msg.'</td></tr>
</table>
<p>Kind Regards,<br />Dr. Vikas Thukral Team<br/>www.drvikasthukral.com</p>';
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "webmail.drvikasthukral.com"; // SMTP server
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "webmail.drvikasthukral.com";      // sets GMAIL as the SMTP server
$mail->Username   = "smtp@drvikasthukral.com";  // GMAIL username
$mail->Password   = "WsT]Pq+(G+g&";           // GMAIL password
$mail->SetFrom('info@drvikasthukral.com', 'info');
$mail->Subject    = "Make an Appointment";
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($body);
$mail->AddAddress($email,$name);
$mail->Send();
header('Location:thankyou.html');
}else{
$msg = '<p style="color:#FF0000;">Please fill captcha</p>';
}
}
//GET IN TOUCH EMAIL NOTIFICATION
?>

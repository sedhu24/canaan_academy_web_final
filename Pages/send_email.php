<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';  

if(!empty($_REQUEST['firstname']))
{   
   /*$sql = "INSERT INTO userpanel_contact_form (guest_name, guest_email, guest_message, guest_phone_number, created_at) VALUES ('".$_REQUEST['guest_name']."', '".$_REQUEST['guest_email']."', '".$_REQUEST['guest_message']."', '".$_REQUEST['guest_phone_number']."', CURRENT_TIMESTAMP)";
   $conn->query($sql); */
   $_SESSION['msg'] = 'success';
   
   $guestName =$_REQUEST['firstname'].' '.$_REQUEST['lastname'];
   $fromId = $_REQUEST['email'];
   $guestMsg = $_REQUEST['message'];
   $guestPhoneNo = $_REQUEST['phone']; 

   //Create an instance; passing `true` enables exceptions
   $mail = new PHPMailer(true);

   try {
       //Server settings
       $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;                      //Enable verbose debug output
       $mail->isSMTP();                                            //Send using SMTP
       $mail->Host       = 'smtpout.secureserver.net';                     //Set the SMTP server to send through
       $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
       $mail->Username   = 'info@colortaxi.in';                     //SMTP username
       $mail->Password   = 'indM&8390470';                               //SMTP password
       $mail->SMTPSecure = "ssl";          //Enable implicit TLS encryption
       $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

       //Recipients
       $mail->setFrom('info@colortaxi.in', 'Enquiry');
       $mail->addAddress('info@colortaxi.in', 'Info');     //Add a recipient 
       $mail->addReplyTo($fromId, 'Replied From: colortaxi.in');
       //$mail->addCC('cc@example.com');
       //$mail->addBCC('bcc@example.com');

       //Attachments
      // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

       //Content
       $mail->isHTML(true);                                  //Set email format to HTML
       $mail->Subject = 'Enquiry From colortaxi.in - Contact Us';
       $mail->Body    = '<b>Name:</b>'.$guestName.'<br><b>e-Mail:</b>'.$fromId.'<br>'.'<b>Phone Number:</b>'.$guestPhoneNo.'<br>'.'<b>Message:</b>'.$guestMsg;
       //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

       $mail->send();
       echo 'success';
   } catch (Exception $e) {
       echo 'failed';
   }  
} else {
   echo 'failed';
} 

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $name = strip_tags(trim($_POST["name"]));
//     $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
//     $message = trim($_POST["message"]);

//     if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
//         http_response_code(400);
//         echo "Please complete the form and try again.";
//         exit;
//     }

//     $recipient = "info@canaangroup.in"; 
//     $subject = "New contact from $name";

//     $email_content = "Name: $name\n";
//     $email_content .= "Email: $email\n\n";
//     $email_content .= "Message:\n$message\n";

//     $email_headers = "From: $name <$email>";

//     if (mail($recipient, $subject, $email_content, $email_headers)) {
//         http_response_code(200);
//         echo "Thank You! Your message has been sent.";
//     } else {
//         http_response_code(500);
//         echo "Oops! Something went wrong and we couldn't send your message.";
//     }

// } else {
//     http_response_code(403);
//     echo "There was a problem with your submission, please try again.";
// }


?>
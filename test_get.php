<?php
$to_email = "mmassie@genesco.com";
$subject = "Help Desk Check-In Status";
$body = "Hello," ."\n" ."This email is to notify you that your computer is currently being looked at. We will notify you when the issue is resolved." 
        ."\n\n" ."Thanks," ."\n" ."Help Desk";
$headers = "From: HelpDesk";

 if (mail($to_email, $subject, $body, $headers)) {
   echo "Email successfully sent to $to_email...";
 } else {
   echo "Email sending failed...";
 }

?>
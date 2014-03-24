<?php
$name=$_POST["contactName"];
$message=$_POST["contactMessage"];
$to = "123050033@iitb.ac.in";
$from = $_POST["contactEmail"];
$headers = 'From: '.$from."\r\n".
'Reply-To: '.$from."\r\n" .
'X-Mailer: PHP/' . phpversion();
$subject = $_POST["contactSubject"];
echo mail($to, $subject, $message, $headers);
?>

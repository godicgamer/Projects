<?php
//check if its an ajax request, exit if not
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
  $output = json_encode(array('type'=>'error', 'text' => 'Sorry Request must be Ajax POST'));
  die($output); //exit script outputting json data
} 

$to_email = "jason.huang0425@gmail.com"; 
$name = $_POST["userName"];
$email = $_POST['userEmail'];
$message = $_POST['userMessage'];

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ //email validation
    $output = json_encode(array('type'=>'error', 'text' => 'Please enter a valid email!'));
    die($output);
}

if(strlen($message)<3){ //check emtpy message
    $output = json_encode(array('type'=>'error', 'text' => 'Too short message! Please enter something.'));
    die($output);
}


$message_body = $message."\r\n\r\n-".$name."\r\nEmail : ".$email;
$headers = 'From: '.$name.'' . "\r\n" .
'Reply-To: '.$email.'' . "\r\n" .
'X-Mailer: PHP/' . phpversion();
$subject = "hi there";



if (mail($to_email, $subject, $message_body, $headers)){
	    $output = json_encode(array('type'=>'success', 'text' => 'Message Sent!'));
    die($output);
	}
else{
	    $output = json_encode(array('type'=>'error', 'text' => 'Could not send message!'));
    die($output);
	}
?>
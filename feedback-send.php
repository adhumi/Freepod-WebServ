<?php
session_start();
if (!$_SESSION['auth']) {
	header('Location: index.php');
} 

if (isset($_POST['mail']) && $_POST['mail'] != "") {
	//send email
	$email = $_REQUEST['mail'] ;
	$subject = "[WebservFeedback] " . $_REQUEST['object'] ;
	$message = $_REQUEST['content'] . "\n -------------------------\n Message envoyé par " . $email;
	mail("adhumi@gmail.com", "$subject",
			stripslashes ( $message ), "From:" . "webserv@freepod.net");
	
	header ( 'Location: index2.php?feedback_success');
}
else
//if "email" is not filled out, display the form
{
	header ( 'Location: feedback.php?feedback_mail');
}
?>
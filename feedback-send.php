<?php
session_start();
if (!$_SESSION['auth']) {
	header('Location: index.php');
} 

if (isset($_POST['mail'])) {
	//send email
	$email = $_REQUEST['mail'] ;
	$subject = "[WebservFeedback] " . $_REQUEST['object'] ;
	$message = $_REQUEST['content'] . "\n -------------------------\n Message envoyé par " . $email;
	mail("adhumi@gmail.com", "$subject",
			$message, "From:" . "webserv@freepod.net");
	
	header ( 'Location: index2.php?feedback_success');
}
else
//if "email" is not filled out, display the form
{
	echo "Erreur";
}
?>
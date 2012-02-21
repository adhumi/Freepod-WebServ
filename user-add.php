<?php
session_start ();
if (! $_SESSION ['auth']) {
	header ( 'Location: index.php' );
}

include ('bdd_connect.php');
connexion ( 'webserv' );

$pass = "";

if ($_POST ['password1'] == $_POST ['password2'] && $_POST ['login'] != "" && $_POST ['mail'] != "" ) {
	$pass = crypt ($_POST['password1'],"dopeerf");
	
	$query = "INSERT INTO users (login, password, mail)
		VALUES ('" . $_POST ['login'] . "', '" . $pass . "', '" . $_POST ['mail'] . "')";
	mysql_query ( $query );
	
	header ( 'Location: users.php?success_add' );
} else {
	header ( 'Location: users.php?error_add' );
}
?>
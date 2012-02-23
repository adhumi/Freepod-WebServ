<?php
include ('includes/bdd_connect.php');
connexion ( 'webserv' );

session_start ();

$_SESSION ['auth'] = false;

$query = "SELECT * FROM users WHERE login = '" . $_POST ['login'] . "' AND password = '" . crypt ( $_POST ['password'], "dopeerf" ) . "'";
$res = mysql_query ( $query );

while ( $r = mysql_fetch_assoc ( $res ) ) {
	$_SESSION ['auth'] = true;
	$_SESSION ['login'] = $r ['login'];
}

$query = "UPDATE users SET lastVisit = now() WHERE login = '" . $_POST ['login'] . "'";
mysql_query ( $query );

if ($_SESSION ['auth']) {
	header ( 'Location: index2.php' );
	echo "Connexion réussie<br/> Bienvenue " . $_SESSION ['login'];
} else {
	echo "Erreur authentification";
}

?>
<?php
include ('bdd_connect.php');
connexion ( 'webserv' );

session_start();

$_SESSION['auth'] = false;

$query = "SELECT * FROM users WHERE login = '" . $_POST['login'] . "' AND password = '" . crypt ($_POST['password'],"dopeerf") . "'";
$res = mysql_query($query);

while ( $r = mysql_fetch_assoc ( $res ) ) {
	$_SESSION['auth'] = true;
	$_SESSION['login'] = $r['login'];
}
header('Location: index2.php');
if($_SESSION['auth']) {
	echo "Connexion réussie<br/> Bienvenue " . $_SESSION['login'];
} else {
	echo "Erreur authentification";
}



?>
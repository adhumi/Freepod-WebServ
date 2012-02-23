<?php
session_start();
if (!$_SESSION['auth']) {
	header('Location: index.php');
} 

if (! isset ( $_GET ['id'] )) {
	header ( 'Location: podcasts.php' );
}

include ('includes/bdd_connect.php');
connexion ( 'webserv' );

$query = "DELETE FROM podcasts WHERE id = " . $_GET ['id'];
mysql_query ( $query );

header ( 'Location: podcasts.php');

?>
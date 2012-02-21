<?php
session_start();
if (!$_SESSION['auth']) {
	header('Location: index.php');
} 

include ('bdd_connect.php');
connexion ( 'webserv' );

$query = "INSERT INTO podcasts (nom, url_flux, description, explicite, url_site, url_freepod, logo_normal)
		VALUES ('".htmlspecialchars($_POST['titre'])."', '".$_POST['url_rss']."', '". htmlspecialchars($_POST['description'])."', '".$_POST['explicite']."',
		'".$_POST['url_site']."', '".$_POST['url_freepod']."', '".$_POST['logo']."')";
mysql_query ( $query );

header ( 'Location: podcasts.php');

?>
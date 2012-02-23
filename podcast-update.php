<?php
session_start();
if (!$_SESSION['auth']) {
	header('Location: index.php');
} 

include ('includes/bdd_connect.php');
connexion ( 'webserv' );

$query = "UPDATE podcasts SET nom = '".htmlspecialchars($_POST['titre'])."', url_flux = '".$_POST['url_rss']."', 
		description = '". htmlspecialchars($_POST['description'])."', explicite = '".$_POST['explicite']."',
		url_site = '".$_POST['url_site']."', url_freepod = '".$_POST['url_freepod']."', logo_normal = '".$_POST['logo']."'
		WHERE id = " . $_POST['id_podcast'];
mysql_query ( $query );

header ( 'Location: podcast.php?id=' . $_POST['id_podcast']);

?>
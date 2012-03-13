<?php
session_start ();
if (! $_SESSION ['auth']) {
	header ( 'Location: index.php' );
}

include ('includes/bdd_connect.php');
connexion ( 'webserv' );

require_once ($_SERVER ['DOCUMENT_ROOT'] . "/class/Podcast.php");

$id = 0;
if (isset($_POST['id_podcast'])) {
	$id = $_POST['id_podcast'];
}
Podcast::insertPodcast ( $id, $_POST ['titre'], $_POST ['url_rss'], $_POST ['description'], $_POST ['explicite'], $_POST ['url_site'], $_POST ['url_freepod'], $_POST ['logo'], $_POST ['logo_banner'] );

header ( 'Location: podcast.php?id=' . $id );

?>
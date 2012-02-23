<?php

include ('includes/bdd_connect.php');
connexion ( 'webserv' );

// Si l'appelant n'est pas le serveur de Freepod (éviter les requêtes de status.php) 
if ($_SERVER ['REMOTE_ADDR'] != "46.105.123.206") {
	require_once ($_SERVER ['DOCUMENT_ROOT'] . "/class/Statistiques.php");
	Statistiques::insertClientInfos ();
}

if (isset ( $_GET ['key'] ) && mysql_num_rows ( mysql_query ( "SELECT * FROM `api_key`  WHERE token = '" . $_GET ['key'] . "'" ) ) != 0) {
	
	if (isset ( $_GET ['podcasts'] )) {
		$cache = "cache/get_podcasts.html";
		$expire = time () - 3600;
		
		if (file_exists ( $cache ) && filemtime ( $cache ) > $expire) {
			readfile ( $cache );
		} else {
			ob_start ();
			$query = "SELECT * FROM podcasts";
			$sth = mysql_query ( $query );
			$rows = array ();
			while ( $r = mysql_fetch_assoc ( $sth ) ) {
				$rows [] = $r;
			}
			echo json_encode ( $rows );
			
			$page = ob_get_contents ();
			ob_end_clean ();
			
			file_put_contents ( $cache, $page );
			echo $page;
		}
	} 

	else if (isset ( $_GET ['episodes'] )) {
		$cache = "cache/get_episodes_" . $_GET ['episodes'] . ".html";
		$expire = time () - 600;
		
		if (file_exists ( $cache ) && filemtime ( $cache ) > $expire) {
			readfile ( $cache );
		} else {
			ob_start ();
			$query = "SELECT * FROM episodes WHERE id_podcast = " . $_GET ['episodes'];
			$sth = mysql_query ( $query );
			$rows = array ();
			while ( $r = mysql_fetch_assoc ( $sth ) ) {
				$rows [] = $r;
			}
			echo json_encode ( $rows );
			
			$page = ob_get_contents ();
			ob_end_clean ();
			
			file_put_contents ( $cache, $page );
			echo $page;
		}
	}

} else {
	echo "{\"erreur\":\"API Key\"}";
}

?>

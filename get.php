<?php

include ('includes/bdd_connect.php');
connexion ( 'webserv' );

// TODO Implementation Satistiques

//if (isset($_GET['platform'])) {
//	require_once ($_SERVER ['DOCUMENT_ROOT'] . "/class/Statistiques.php");
//	Statistiques::insertClientInfos ();
//}

//if (isset ( $_GET ['key'] ) && mysql_num_rows ( mysql_query ( "SELECT * FROM `api_key`  WHERE token = '" . $_GET ['key'] . "'" ) ) != 0) {
	
	if (isset ( $_GET ['podcasts'] )) {
		$cache = "cache/get_podcasts.html";
		$expire = time () - 3600;
		
		if (file_exists ( $cache ) && filemtime ( $cache ) > $expire) {
			readfile ( $cache );
		} else {
			ob_start ();
			$query = "SELECT * FROM podcasts ORDER BY nom ASC";
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
			$query = "SELECT * FROM episodes WHERE id_podcast = " . $_GET ['episodes'] . " ORDER BY pubDate ASC";
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
	
	else if (isset ( $_GET ['podcast_recent'] )) {
		
		if ($_GET ['podcast_recent'] != null) {
			$limit = $_GET ['podcast_recent'];
		} else {
			$limit = 1;
		}
		
		$cache = "cache/get_podcast_recent_" . $limit . ".html";
		$expire = time () - 600;
	
		if (file_exists ( $cache ) && filemtime ( $cache ) > $expire) {
			readfile ( $cache );
		} else {
			ob_start ();
			$query = "SELECT * FROM podcasts ORDER BY lastUpdate DESC LIMIT " . $limit;
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
	
	else if (isset ( $_GET ['episode_recent'] )) {
		
		if ($_GET ['episode_recent'] != null) {
			$limit = $_GET ['episode_recent'];
		} else {
			$limit = 1;
		}
		
		$cache = "cache/get_episode_recent_" . $limit . ".html";
		$expire = time () - 1;
	
		if (file_exists ( $cache ) && filemtime ( $cache ) > $expire) {
			readfile ( $cache );
		} else {
			ob_start ();
			$query = "SELECT * FROM episodes ORDER BY pubDate DESC LIMIT " . $limit;
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

//} else {
//	echo "{\"erreur\":\"API Key\"}";
//}

?>

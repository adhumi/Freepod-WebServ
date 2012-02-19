<?php

include ('bdd_connect.php');

connexion ( 'webserv' );

if (isset ( $_GET ['key'] ) && !mysql_query ( "SELECT * FROM api_key WHERE key='" . $_GET ['key'] . "'" ) ) {
	
	if (isset ( $_GET ['podcasts'] )) {
		$query = "SELECT * FROM podcasts";
		$sth = mysql_query ( $query );
		$rows = array ();
		while ( $r = mysql_fetch_assoc ( $sth ) ) {
			$rows [] = $r;
		}
		echo json_encode ( $rows );
	} 

	else if (isset ( $_GET ['episodes'] )) {
		$query = "SELECT * FROM episodes WHERE id_podcast = " . $_GET ['episodes'];
		$sth = mysql_query ( $query );
		$rows = array ();
		while ( $r = mysql_fetch_assoc ( $sth ) ) {
			$rows [] = $r;
		}
		echo json_encode ( $rows );
	}
} else {
	echo "{\"erreur\":\"API Key\"}";
}
?>
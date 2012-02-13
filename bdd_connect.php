<?php

function connexion($database) {
	$host = 'localhost';
	$login = 'webserv';
	$pass = 'Wef8uXEp';
	
	mysql_connect ( $host, $login, $pass ) or die ( "Erreur de connexion au serveur" );
	mysql_select_db ( $database ) or die ( "Erreur de connexion à la BDD" );
}

?>
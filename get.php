<?php include('bdd_connect.php'); ?>

<?php

connexion ( 'webserv' );


if (isset ( $_GET ['podcasts'] )) {
	$query = "SELECT * FROM podcasts";
	$sth = mysql_query ( $query );
	$rows = array ();
	while ( $r = mysql_fetch_assoc ( $sth ) ) {
		$rows [] = $r;
	}
	print json_encode ( $rows );
} 

else if (isset ( $_GET ['episodes'] )) {
	$query = "SELECT * FROM episodes WHERE id_podcast = " . $_GET['episodes'];
	$sth = mysql_query ( $query );
	$rows = array ();
	while ( $r = mysql_fetch_assoc ( $sth ) ) {
		$rows [] = $r;
	}
	print json_encode ( $rows );
}

?>
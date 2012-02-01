<?php include('bdd_connect.php'); ?>

<?php
connexion ( 'webserv' );
$query = "SELECT * FROM podcasts LIMIT 1";

$result = mysql_query ( $query );

while ( $row = mysql_fetch_row ( $result ) ) {
	print_r ( $row [2] );
	echo ("<br/>");
	
	$xml = simplexml_load_file ( $row [2] );
	
	echo $xml->getName () . "<br />";
	
	foreach ( $xml->children () as $child ) {
		foreach ( $child->children () as $child2 ) {
			if ($child2->getName () == "item") {
				echo "<h1>".$child2->getName () . ": " . $child2 . "</h1><br />";
				$ns_dc = $child2->children('http://www.itunes.com/dtds/podcast-1.0.dtd');
				foreach ( $child2->children () as $child3 ) {
					echo "<b>".$child3->getName () . ": </b> " . $child3 . "<br />";
				}
				echo $ns_dc->image->attributes()->href."<br />";
			}
		}
	}
}
?>

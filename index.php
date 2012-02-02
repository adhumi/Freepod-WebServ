<?php include('bdd_connect.php'); ?>

<?php
connexion ( 'webserv' );
$query = "SELECT * FROM podcasts ORDER BY id DESC  LIMIT 1";

$result = mysql_query ( $query );

while ( $row = mysql_fetch_row ( $result ) ) {
	print_r ( $row [2] );
	echo ("<br/>");
	
	$xml = simplexml_load_file ( $row [2] );
	
	
	foreach ( $xml->channel->item as $item ) {
		if ($item->getName () == "item") {
			$itunes = $item->children('http://www.itunes.com/dtds/podcast-1.0.dtd');
			echo "Titre : " . $item->title . "<br />";
			echo "Link : " . $item->link . "<br />";
			echo "URL : " . $item->guid . "<br />";
			echo "Description : " . $item->description . "<br />";
			echo "pubDate : " . $item->pubDate . "<br />";
			echo "author : " . $itunes->author . "<br />";
			echo "explicit : " . $itunes->explicit . "<br />";
			echo "duration : " . $itunes->duration . "<br />";
			echo "image : " . $itunes->image->attributes()->href . "<br />";
			echo "keywords : " . $itunes->keywords . "<br />";
			echo "<hr>";
		}
	}
}
?>

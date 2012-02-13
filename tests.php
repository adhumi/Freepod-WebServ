<?php include('bdd_connect.php'); ?>

<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body>
<?php
connexion ( 'webserv' );
$query = "SELECT * FROM podcasts";

$result = mysql_query ( $query );

while ( $row = mysql_fetch_row ( $result ) ) {
	print_r ( "<h1>" . $row [2] . "</h1>" );
	echo ("<br/>");
	
	$xml = simplexml_load_file ( $row [2] );
	
	foreach ( $xml->channel->item as $item ) {
		if ($item->getName () == "item") {
			$itunes = $item->children ( 'http://www.itunes.com/dtds/podcast-1.0.dtd' );
			echo "Titre : " . htmlentities($item->title,ENT_QUOTES) . "<br />";
			echo "URL : " . $item->enclosure->attributes ()->url . "<br />";
			echo "Description : " . htmlentities($item->description,ENT_QUOTES) . "<br />";
			echo "pubDate : " . $item->pubDate . "<br />";
			echo "author : " . htmlentities($itunes->author,ENT_QUOTES) . "<br />";
			echo "explicit : " . $itunes->explicit . "<br />";
			echo "duration : " . $itunes->duration . "<br />";
			if ($itunes->image) {
				if ($itunes->image->attributes ()->href != null) {
					echo "image : " . $itunes->image->attributes ()->href . "<br />";
					$img = $itunes->image->attributes ()->href;
				} else {
					echo "image : " . $itunes->image . "<br />";
					$img = $itunes->image;
				}
			} else {
				$img = "";
			}
			echo "keywords : " . $itunes->keywords . "<br />";
			echo "Type : " . $item->enclosure->attributes ()->type . "<br />";
			echo "<hr>";
			
			$query = "INSERT INTO episodes (id_podcast, title, url, type, description, pubDate, author, explicit, duration, image, keywords)
						VALUES ('".$row[0]."',
								'".addslashes ($item->title)."',
								'".$item->enclosure->attributes ()->url."',
								'".$item->enclosure->attributes ()->type."',
								'".addslashes ($item->description)."',
								'".$item->pubDate."',
								'".addslashes ($itunes->author)."',
								'".$itunes->explicit."',
								'".$itunes->duration."',
								'".$img."',
								'".addslashes ($itunes->keywords)."')";
			echo $query . "<hr />";
			print_r(mysql_query ( $query ));
		}
	}
}
?>
</body>
</html>
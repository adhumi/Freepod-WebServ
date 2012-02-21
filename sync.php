<?php
session_start();
if (!$_SESSION['auth']) {
	header('Location: index.php');
} 

include ('bdd_connect.php');
connexion ( 'webserv' );

if (isset ( $_GET ['id'] )) {
	/*
	 * On récupère le podcast à mettre à jour dans la base de données
	 */
	$query = "SELECT * FROM podcasts WHERE id = " . $_GET ['id'];
	$result = mysql_query ( $query );
	
	/*
	 * On balaye la liste des podcasts
	 */
	while ( $row = mysql_fetch_row ( $result ) ) {
		$xml = simplexml_load_file ( $row [2] );
		
		/*
		 * On balaye le XML, pour chaque <item></item>
		 */
		foreach ( $xml->channel->item as $item ) {
			if ($item->getName () == "item") {
				// Récupération des informations du XML (images et balises
				// spécifiques iTunes
				$itunes = $item->children ( 'http://www.itunes.com/dtds/podcast-1.0.dtd' );
				if ($itunes->image) {
					if ($itunes->image->attributes ()->href != null) {
						$img = $itunes->image->attributes ()->href;
					} else {
						$img = $itunes->image;
					}
				} else {
					$img = $row[9];
				}
				
				/*
				 * On vérifie si l'épisode est déjà dans la BDD
				 */
				$episodeExistsInBDD = false;
				$query = "SELECT * FROM episodes WHERE url = '" . $item->enclosure->attributes ()->url . "' AND pubDate = '" . date ( 'Y-m-d H:i:s', strtotime ( $item->pubDate ) ) . "'";
				$episode = mysql_query ( $query );
				
				while ( $row_episode = mysql_fetch_row ( $episode ) ) {
					$episodeExistsInBDD = true;
				}
				
				if ($episodeExistsInBDD) {
					// Si l'épisode est déjà présent dans la base de données, on
					// met
					// à jour les données (elles ont peut-être été modifiées)
					$query = "UPDATE episodes SET
							id_podcast = '" . $row [0] . "', 
							title = '" . addslashes ( $item->title ) . "', 
							url = '" . $item->enclosure->attributes ()->url . "', 
							type = '" . $item->enclosure->attributes ()->type . "', 
							description = '" . addslashes ( $item->description ) . "', 
							pubDate = '" . date ( 'Y-m-d H:i:s', strtotime ( $item->pubDate ) ) . "', 
							author = '" . addslashes ( $itunes->author ) . "', 
							explicite = '" . $itunes->explicit . "', 
							duration = '" . $itunes->duration . "', 
							image = '" . $img . "', 
							keywords = '" . addslashes ( $itunes->keywords ) . "'
						WHERE id = " . $row_episode[0];
					mysql_query ( $query );
				} else {
					// Si l'épisode n'est pas présent dans la base, il est
					// inséré
					// normalement
					$query = "INSERT INTO episodes (id_podcast, title, url, type, description, pubDate, author, explicite, duration, image, keywords)
					VALUES ('" . $row [0] . "',
					'" . addslashes ( $item->title ) . "',
					'" . $item->enclosure->attributes ()->url . "',
					'" . $item->enclosure->attributes ()->type . "',
					'" . addslashes ( $item->description ) . "',
					'" . date ( 'Y-m-d H:i:s', strtotime ( $item->pubDate ) ) . "',
					'" . addslashes ( $itunes->author ) . "',
					'" . $itunes->explicit . "',
					'" . $itunes->duration . "',
					'" . $img . "',
					'" . addslashes ( $itunes->keywords ) . "')";
					mysql_query ( $query );
				}
			}
		}
		
		/*
		 * On vérifie pour le podcast i que le tous les épisodes de la base de
		 * données existent toujours dans le flux
		 */
		$query = "SELECT * FROM episodes WHERE id_podcast = " . $row [0] . " ORDER BY pubDate";
		$episode = mysql_query ( $query );
		while ( $row_episode = mysql_fetch_row ( $episode ) ) {
			$episodeExistsInXML = false;
			
			/*
			 * Pour cet épisode présent dans la base de données; on vérifie
			 * qu'il existe dans le XML
			 */
			foreach ( $xml->channel->item as $item ) {
				if ($item->getName () == "item") {
					if (date ( 'Y-m-d H:i:s', strtotime ( $item->pubDate ) ) == $row_episode [6] && $item->enclosure->attributes ()->url == $row_episode [3]) {
						$episodeExistsInXML = true;
					}
				}
			}
			
			if ($episodeExistsInXML) {
				// On fait rien, c'est toujours disponible
			} else {
				// On supprime de la base de données
				$query = "DELETE FROM episodes WHERE url = '" . $item->enclosure->attributes ()->url . "' AND pubDate = '" . date ( 'Y-m-d H:i:s', strtotime ( $item->pubDate ) ) . "'";
			}
			
			$query = "UPDATE podcasts SET lastUpdate = '".$row_episode[6]."', lastSynch = now()
					WHERE id = " . $row_episode[1];
			mysql_query ( $query );
		}
	}
	
	header('Location: podcast.php?id='.$_GET ['id'] . '&success_sync');
} else {
	/*
	 * On récupère la liste des podcasts dans la base de données
	 */
	$query = "SELECT * FROM podcasts";
	$result = mysql_query ( $query );
	
	/*
	 * On balaye la liste des podcasts
	 */
	while ( $row = mysql_fetch_row ( $result ) ) {
		/*
		 * Affichage du nom et de l'URL du podcast
		 */
		echo "<h1>" . $row [1] . "</h1>";
		echo "<h2>" . $row [2] . "</h2><br/>";
		
		$xml = simplexml_load_file ( $row [2] );
		
		/*
		 * On balaye le XML, pour chaque <item></item>
		 */
		foreach ( $xml->channel->item as $item ) {
			if ($item->getName () == "item") {
				// Récupération des informations du XML (images et balises
				// spécifiques iTunes
				$itunes = $item->children ( 'http://www.itunes.com/dtds/podcast-1.0.dtd' );
				if ($itunes->image) {
					if ($itunes->image->attributes ()->href != null) {
						$img = $itunes->image->attributes ()->href;
					} else {
						$img = $itunes->image;
					}
				} else {
					$img = $row[9];
				}
				
				/*
				 * On vérifie si l'épisode est déjà dans la BDD
				 */
				$episodeExistsInBDD = false;
				$query = "SELECT * FROM episodes WHERE url = '" . $item->enclosure->attributes ()->url . "' AND pubDate = '" . date ( 'Y-m-d H:i:s', strtotime ( $item->pubDate ) ) . "'";
								
				$episode = mysql_query ( $query );
				while ( $row_episode = mysql_fetch_row ( $episode ) ) {
					$episodeExistsInBDD = true;
				}
				
				if ($episodeExistsInBDD) {
					// Si l'épisode est déjà présent dans la base de données, on
					// met
					// à jour les données (elles ont peut-être été modifiées)
					$query = "INSERT INTO episodes SET
							id_podcast = '" . $row [0] . "', 
							title = '" . addslashes ( $item->title ) . "', 
							url = '" . $item->enclosure->attributes ()->url . "', 
							type = '" . $item->enclosure->attributes ()->type . "', 
							description = '" . addslashes ( $item->description ) . "', 
							pubDate = '" . date ( 'Y-m-d H:i:s', strtotime ( $item->pubDate ) ) . "', 
							author = '" . addslashes ( $itunes->author ) . "', 
							explicite = '" . $itunes->explicit . "', 
							duration = '" . $itunes->duration . "', 
							image = '" . $img . "', 
							keywords = '" . addslashes ( $itunes->keywords ) . "'";
					mysql_query ( $query );
				} else {
					// Si l'épisode n'est pas présent dans la base, il est
					// inséré
					// normalement
					$query = "INSERT INTO episodes (id_podcast, title, url, type, description, pubDate, author, explicite, duration, image, keywords)
						VALUES ('" . $row [0] . "',
						'" . addslashes ( $item->title ) . "',
						'" . $item->enclosure->attributes ()->url . "',
						'" . $item->enclosure->attributes ()->type . "',
						'" . addslashes ( $item->description ) . "',
						'" . date ( 'Y-m-d H:i:s', strtotime ( $item->pubDate ) ) . "',
						'" . addslashes ( $itunes->author ) . "',
						'" . $itunes->explicit . "',
						'" . $itunes->duration . "',
						'" . $img . "',
						'" . addslashes ( $itunes->keywords ) . "')";
					mysql_query ( $query );
				}
			}
		}
		
		/*
		 * On vérifie pour le podcast i que le tous les épisodes de la base de
		 * données existent toujours dans le flux
		 */
		$query = "SELECT * FROM episodes WHERE id_podcast = " . $row [0];
		$episode = mysql_query ( $query );
		while ( $row_episode = mysql_fetch_row ( $episode ) ) {
			$episodeExistsInXML = false;
			
			/*
			 * Pour cet épisode présent dans la base de données; on vérifie
			 * qu'il existe dans le XML
			 */
			foreach ( $xml->channel->item as $item ) {
				if ($item->getName () == "item") {
					if (date ( 'Y-m-d H:i:s', strtotime ( $item->pubDate ) ) == $row_episode [6] && $item->enclosure->attributes ()->url == $row_episode [3]) {
						$episodeExistsInXML = true;
					}
				}
			}
			
			if ($episodeExistsInXML) {
				// On fait rien, c'est toujours disponible
			} else {
				// On supprime de la base de données
				$query = "DELETE FROM episodes WHERE url = '" . $item->enclosure->attributes ()->url . "' AND pubDate = '" . date ( 'Y-m-d H:i:s', strtotime ( $item->pubDate ) ) . "'";
			}
		}
	}
	header('Location: podcasts.php');
}
?>
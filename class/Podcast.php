<?php
/**
 * @author Adrien Humili�re
 *
 *
 */
class Podcast {
	/**
	 * Récupère les informations des podcasts.
	 *
	 * @param $id int
	 *       	 Identifiant du podcast
	 * @param $orderBy String
	 *       	 Champ à trier (par défaut : id)
	 * @param $order String
	 *       	 Ordre du tri (par défaut : ASC)
	 * @return array
	 */
	static function getPodcasts($id = 0, $orderBy = "id", $order = "ASC") {
		if ($id == 0) {
			$tmp = array ();
			$query = "SELECT * FROM podcasts ORDER BY " . $orderBy . " " . $order;
			$result = mysql_query ( $query );
			while ( $row = mysql_fetch_array ( $result, MYSQL_ASSOC ) ) {
				array_push ( $tmp, $row );
			}
		} else {
			$query = "SELECT * FROM podcasts WHERE id = " . $id . " ORDER BY " . $orderBy . " " . $order;
			$result = mysql_query ( $query );
			while ( $row = mysql_fetch_array ( $result, MYSQL_ASSOC ) ) {
				$tmp = $row;
			}
		}
		return $tmp;
	}
	
	/**
	 * Insère ou met à jour les informations d'un podcast, selon si son
	 * identifiant est donné.
	 *
	 * @param $id int
	 *       	 Identifiant du podcast
	 * @param $nom String
	 *       	 Nom du podcast
	 * @param $url_flux String
	 *       	 URL du flux RSS
	 * @param $description String
	 *       	 Description du podcast
	 * @param $explicite String
	 *       	 Explicite
	 * @param $url_site String
	 *       	 URL Site
	 * @param $url_freepod String
	 *       	 URL Freepod
	 * @param $logo_normal String
	 *       	 URL du logo normal
	 */
	static function insertPodcast($id = 0, $nom, $url_flux, $description, $explicite, $url_site, $url_freepod, $logo_normal, $logo_banner) {
		if ($id == 0) {
			$query = "INSERT INTO podcasts SET
				nom = '" . addslashes(htmlspecialchars($nom)) . "', 
				url_flux = '" . $url_flux . "', 
				description = '" . addslashes(htmlspecialchars($description)) . "', 
				explicite = '" . $explicite . "', 
				url_site = '" . $url_site . "', 
				url_freepod = '" . $url_freepod . "', 
				logo_normal = '" . $logo_normal . "',
				logo_banner = '" . $logo_banner . "'";
		} else {
			$query = "UPDATE podcasts SET
				nom = '" . addslashes(htmlspecialchars($nom)) . "',
				url_flux = '" . $url_flux . "',
				description = '" . addslashes(htmlspecialchars($description)) . "',
				explicite = '" . $explicite . "',
				url_site = '" . $url_site . "',
				url_freepod = '" . $url_freepod . "',
				logo_normal = '" . $logo_normal ."',
				logo_banner = '" . $logo_banner . "'
				WHERE id = " . $id;
		}
		echo $query;
		mysql_query ( $query );
	}
}

?>
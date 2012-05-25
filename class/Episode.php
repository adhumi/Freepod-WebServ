<?php
/**
 * @author Adrien Humiliere
 *
 *
 */
class Episode {
	/**
	 * Récupère les informations des épisodes.
	 * 
	 * @param int Identifiant du podcast
	 * @param String Champ à trier (defaut : "id")
	 * @param String Ordre du tri (defaut : "ASC")
	 * @return array
	 */
	static function getEpisodesByPodcasts($id = 0, $orderBy = "id", $order = "ASC") {
		$tmp =array();
		if ($id == 0) {
			$tmp = array ();
			$query = "SELECT episodes.id, episodes.id_podcast, episodes.title, episodes.url, episodes.type, episodes.description, episodes.pubDate, episodes.author, episodes.explicite, 
						episodes.duration, episodes.image, episodes.keywords, podcasts.nom FROM episodes AS episodes, podcasts AS podcasts WHERE episodes.id_podcast = podcasts.id ORDER BY " . $orderBy . " " . $order;
			$result = mysql_query ( $query );
			while ( $row = mysql_fetch_array ( $result, MYSQL_ASSOC ) ) {
				array_push ( $tmp, $row );
			}
		} else {
			$query = "SELECT * FROM episodes WHERE id_podcast = " . $id . " ORDER BY " . $orderBy . " " . $order;
			$result = mysql_query ( $query );
			while ( $row = mysql_fetch_array ( $result, MYSQL_ASSOC ) ) {
				array_push ( $tmp, $row );
			}
		}
		//echo "<pre>";
		//print_r($tmp);
		//echo "</pre>";
			
		return $tmp;
	}
}

?>
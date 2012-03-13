<?php
/**
 * @author Adrien Humili�re
 *
 *
 */
class Episode {
	/**
	 * Récupère les informations des épisodes.
	 * 
	 * @param int $id Identifiant du podcast
	 * @param unknown_type $orderBy Champ à trier (defaut : id)
	 * @param unknown_type $order Ordre du tri (defaut : ASC)
	 * @return array
	 */
	static function getEpisodesByPodcasts($id = 0, $orderBy = "id", $order = "ASC") {
		$tmp =array();
		if ($id == 0) {
			$tmp = array ();
			$query = "SELECT * FROM episodes ORDER BY " . $orderBy . " " . $order;
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
		return $tmp;
	}
}

?>
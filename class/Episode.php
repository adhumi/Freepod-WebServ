<?php

class Episode {
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
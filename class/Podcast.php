<?php

class Podcast {
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
}

?>
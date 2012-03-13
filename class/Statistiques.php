<?php
/**
 * @author Adrien Humili�re
 *
 *
 */
class Statistiques {
	/**
	 * Affiche les informations du client.
	 */
	static function printClientInfos() {
		require_once ($_SERVER ['DOCUMENT_ROOT'] . "/includes/php-local-browscap.php");
		$browser = get_browser_local ( null, true );
		
		print_r ( "<pre>" . $_SERVER ['HTTP_ACCEPT_LANGUAGE'] . "</pre>" );
		print_r ( "<pre>" . $_SERVER ['HTTP_CONNECTION'] . "</pre>" );
		print_r ( "<pre>" . $_SERVER ['HTTP_REFERER'] . "</pre>" );
		print_r ( "<pre>" . $_SERVER ['HTTP_USER_AGENT'] . "</pre>" );
		print_r ( "<pre>" . $_SERVER ['REMOTE_ADDR'] . "</pre>" );
		print_r ( "<pre>" . $_SERVER ['SCRIPT_NAME'] . "</pre>" );
		print_r ( "<pre>" );
		print_r ( $browser );
		print_r ( "</pre>" );
	}
	
	/**
	 * Permet d'insérer les informations du client dans la base de données pour
	 * la gestion des statistiques.
	 */
	static function insertClientInfos() {
		require_once ($_SERVER ['DOCUMENT_ROOT'] . "/includes/php-local-browscap.php");
		$browser = get_browser_local ( null, true );
		
		$query = "INSERT INTO statistiques SET
			language = '" . $_SERVER ['HTTP_ACCEPT_LANGUAGE'] . "',
			connection = '" . $_SERVER ['HTTP_CONNECTION'] . "',";
		if (isset ( $_SERVER ['HTTP_REFERER'] )) {
			$query .= "referer = '" . $_SERVER ['HTTP_REFERER'] . "',";
		}
		$query .= "user_agent = '" . $_SERVER ['HTTP_USER_AGENT'] . "',
			ip_client = '" . $_SERVER ['REMOTE_ADDR'] . "',
			script = '" . $_SERVER ['SCRIPT_NAME'] . "',
			url_page = '" . $_SERVER ['SCRIPT_NAME'] . "',
			parent = '" . $browser ['parent'] . "', 
			platform = '" . $browser ['platform'] . "', 
			browser= '" . $browser ['browser'] . "', 
			version = '" . $browser ['version'] . "', 
			isMobileDevice = '" . $browser ['ismobiledevice'] . "'";
		mysql_query ( $query );
	}
	
	/**
	 * Retourne un array contenant les statistiques par navigateur sur un nombre
	 * de jours donnés (Default : 30)
	 *
	 * @param $nbJours int       	
	 * @return array
	 */
	static function getBrowserStats($nbJours = 30) {
		$tmp = array ();
		$query = "SELECT COUNT(*), browser FROM statistiques WHERE DATEDIFF(visitDate, CURRENT_DATE) > -" . $nbJours . " GROUP BY browser";
		$result = mysql_query ( $query );
		while ( $row = mysql_fetch_row ( $result ) ) {
			array_push ( $tmp, array ("nbVisites" => $row [0], "browser" => $row [1] ) );
		}
		return $tmp;
	}
	
	/**
	 * Retourne un array contenant les statistiques des OS sur un nombre
	 * de jours donnés (Default : 30)
	 *
	 * @param $nbJours int       	
	 * @return array
	 */
	static function getPlatformStats($nbJours = 30) {
		$tmp = array ();
		$query = "SELECT COUNT(*), platform FROM statistiques WHERE DATEDIFF(visitDate, CURRENT_DATE) > -" . $nbJours . " GROUP BY platform";
		$result = mysql_query ( $query );
		while ( $row = mysql_fetch_row ( $result ) ) {
			array_push ( $tmp, array ("nbVisites" => $row [0], "platform" => $row [1] ) );
		}
		return $tmp;
	}
	
	/**
	 * Retourne un array contenant les statistiques de requêtes quotidennes sur
	 * un nombre de jours donnés
	 *
	 * @param $nbJours int       	
	 * @return array
	 */
	static function getRequestStats($nbJours = 30) {
		$tmp = array ();
		$query = "SELECT COUNT(*), YEAR(visitDate), MONTH(visitDate), DAY(visitDate) FROM statistiques WHERE DATEDIFF(visitDate, CURRENT_DATE) > -" . $nbJours . " GROUP BY YEAR(visitDate), MONTH(visitDate), DAY(visitDate) ";
		$resultat = mysql_query ( $query );
		
		$row = mysql_fetch_row ( $resultat );
		array_push ( $tmp, array ('nbVisites' => $row [0], 'day' => $row [3], 'month' => $row [2], 'year' => $row [1] ) );
		
		$pre_day = $row [3];
		$pre_month = $row [2];
		$pre_year = $row [1];
		
		date_default_timezone_set ( 'CET' );
		
		while ( $row = mysql_fetch_row ( $resultat ) ) {
			$begin = new DateTime ( $pre_year . '-' . $pre_month . '-' . $pre_day );
			$end = new DateTime ( $row [1] . '-' . $row [2] . '-' . $row [3] );
			
			$interval = DateInterval::createFromDateString ( '1 day' );
			$period = new DatePeriod ( $begin->add ( $interval ), $interval, $end );
			
			foreach ( $period as $dt ) {
				array_push ( $tmp, array ('nbVisites' => 0, 'day' => $dt->format ( "d" ), 'month' => $dt->format ( "m" ), 'year' => $dt->format ( "Y" ) ) );
			}
			array_push ( $tmp, array ('nbVisites' => $row [0], 'day' => $row [3], 'month' => $row [2], 'year' => $row [1] ) );
			
			$pre_day = $row[3];
			$pre_month = $row [2];
			$pre_year = $row [1];
		}
		return $tmp;
	}
}

?>
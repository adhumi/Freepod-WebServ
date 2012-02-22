<?php

class Statistiques {
	function printClientStats() {
		require_once ($_SERVER ['DOCUMENT_ROOT'] . "/includes/php-local-browscap.php");
		$browser = get_browser_local ( null, true );
		
		print_r("<pre>" . $_SERVER ['HTTP_ACCEPT_LANGUAGE'] . "</pre>");
		print_r("<pre>" . $_SERVER ['HTTP_CONNECTION'] . "</pre>");
		print_r("<pre>" . $_SERVER ['HTTP_REFERER'] . "</pre>");
		print_r("<pre>" . $_SERVER ['HTTP_USER_AGENT'] . "</pre>");
		print_r("<pre>" . $_SERVER ['REMOTE_ADDR'] . "</pre>");
		print_r("<pre>" . $_SERVER ['SCRIPT_NAME'] . "</pre>");
		print_r("<pre>");
		print_r($browser);
		print_r("</pre>");
	}
	
	function insertClientInfos() {
		require_once ($_SERVER ['DOCUMENT_ROOT'] . "/includes/php-local-browscap.php");
		$browser = get_browser_local ( null, true );

		$query = "INSERT INTO statistiques SET
					language = '" . $_SERVER ['HTTP_ACCEPT_LANGUAGE'] . "',
					connection = '" . $_SERVER ['HTTP_CONNECTION'] . "',
					referer = '" . $_SERVER ['HTTP_REFERER'] . "',
					user_agent = '" . $_SERVER ['HTTP_USER_AGENT'] . "',
					ip_client = '" . $_SERVER ['REMOTE_ADDR'] . "',
					script = '" . $_SERVER ['SCRIPT_NAME'] . "',
					url_page = '" . $_SERVER ['SCRIPT_NAME'] . "',
					parent = '" . $browser['parent'] . "', 
					platform = '" . $browser['platform'] . "', 
					browser= '" . $browser['browser'] . "', 
					version = '" . $browser['version'] . "', 
					isMobileDevice = '" . $browser['ismobiledevice'] . "'";
		mysql_query($query);
	}
}

?>
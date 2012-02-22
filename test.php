<?php 
echo $_SERVER['HTTP_ACCEPT_LANGUAGE'] . "<br/>";
echo $_SERVER['HTTP_CONNECTION'] . "<br/>";
echo $_SERVER['HTTP_HOST'] . "<br/>";
echo $_SERVER['HTTP_REFERER'] . "<br/>";
echo $_SERVER['HTTP_USER_AGENT'] . "<br/>";
echo $_SERVER['QUERY_STRING'] . "<br/>";
echo $_SERVER['REMOTE_ADDR'] . "<br/>";
echo $_SERVER['SCRIPT_NAME'] . "<br/>";

if (get_cfg_var('browscap'))
	$browser = get_browser(null, true); //If available, use PHP native function
else
{
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/php-local-browscap.php");
	$browser=get_browser_local(null, true);
}
print_r($browser);
?>
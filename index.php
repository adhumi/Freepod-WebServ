<?php
session_start();
if ($_SESSION['auth']) {
	header('Location: index2.php');
} 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="none,noarchive" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css"
	type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script href="bootstrap.min.js" type="text/javascript"></script>
<script href="jquery-1.7.1.min.js" type="text/javascript"></script>
<title>Webservice Freepod</title>
</head>
<body>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="brand" href="#"> Freepod </a>
			</div>
		</div>
	</div>
	<div class="container first">
		<div class="row">
			<div class="span4 offset4 well">
				<form method="post" action="auth.php">
					<fieldset>
						<legend>Se connecter</legend>
						<label>Login</label> <input type="text" name="login" /> <label>Password</label>
						<input type="password" name="password" /> <input type="submit"
							value="Connexion" />
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
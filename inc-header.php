<?php
session_start();
if (!$_SESSION['auth']) {
	header('Location: index.php');
} 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="charset=utf-8" />
<meta name="robots" content="none,noarchive" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css"
	type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<title>Webservice Freepod</title>
</head>
<body>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="brand" href="index2.php"> Freepod </a>
				<ul class="nav pull-right">
					<li><a href="feedback.php">Feedback</a></li>
					<li class="divider-vertical"></li>
					<li class="dropdown">
						<a href="#user" class="dropdown-toggle" data-toggle="dropdown"> <? echo $_SESSION['login']; ?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="logout.php">Log out</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
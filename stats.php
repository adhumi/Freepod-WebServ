<?php
include 'inc-header.php';

include ('bdd_connect.php');
connexion ( 'webserv' );
?>

<div class="container first">
	<div class="row">
		<?php include 'inc-menu.php'; ?>
		<div class="span9">
			<div class="page-header">
				<h1>Statistiques</h1>
			</div>
			<ul class="breadcrumb">
				<li><a href="index2.php">Home</a> <span class="divider">/</span></li>
				<li><a>Statistiques</a> <span class="divider">/</span></li>
				<li class="active"><a href="stats.php">Stats générales</a></li>
			</ul>
			
			<pre>http://code.google.com/apis/chart/interactive/docs/gallery/columnchart.html</pre>
		</div>
	</div>
</div>
<?php
include 'inc-footer.php';
?>

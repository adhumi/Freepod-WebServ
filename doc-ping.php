<?php
include 'includes/header.php';
?>
<div class="container first">
	<div class="row">
		<?php include 'includes/menu.php'; ?>
		<div class="span9">
			<div class="page-header">
				<h1>Méthodes Ping</h1>
			</div>
			<div class="row">
				<div class="span9">
					<h2>Principes de fonctionnement</h2>
					<p>Ces méthodes permettent à un utilisateur de forcer la synchronisation du flux RSS d'un podcast avec la base de données.
					Elles peuvent être appellées sans authentification, mais avec une clé <code>API_KEY</code>.</p>
						
					<h2>Méthodes</h2>
				</div>
			</div>
			<div class="row">
				<div class="span3">
					<h4>Forcer la synchronisation d'un podcast</h4>
					<p>Permet la synchronisation de la base de données avec les flux
						RSS des podcasts. Cette action n'est pas autorisée par une clé API
						standard.</p>
					<pre>http://webserv.freepod.net/sync.php?id=ID_PODCAST</pre>
				</div>
				<div class="span3">
					
				</div>
				<div class="span3">
					
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include 'includes/footer.php';
?>

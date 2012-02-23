<?php
include 'includes/header.php';
?>
<div class="container first">
	<div class="row">
		<?php include 'includes/menu.php'; ?>
		<div class="span9">
			<div class="page-header">
				<h1>M&eacute;thodes GET</h1>
			</div>
			<div class="row">
				<div class="span9">
					<h2>Principes de fonctionnement</h2>
					<p>
						Ces méthodes permettent de récupérer des informations au format
						JSON. La clé
						<code>API_KEY</code>
						permet de valider l'accès de l'application au webservice et de
						tracer les requêtes effectuées.
					</p>

					<h2>Méthodes</h2>
				</div>
			</div>
			<div class="row">
				<div class="span3">
					<h4>Récupération de la liste des podcasts</h4>
					<p>
						Permet de récupérer un json avec la liste des podcasts et leurs
						caractéristiques. Triés et identifiés par un id unique.
						<code>API_KEY</code>
						correspond à la clé d'authenfication de l'application.
					</p>
					<pre>http://webserv.freepod.net/get.php?podcasts&key=API_KEY</pre>
					<h6>Récupère les champs suivants :</h6>
					<ul>
						<li><code>id</code></li>
						<li><code>nom</code></li>
						<li><code>url_flux</code></li>
						<li><code>description</code></li>
						<li><code>explicite</code></li>
						<li><code>url_site</code></li>
						<li><code>url_freepod</code></li>
						<li><code>lastUpdate</code></li>
						<li><code>lastSynch</code></li>
						<li><code>logo_normal</code></li>
					</ul>
				</div>
				<div class="span3">
					<h4>Récupération de la liste des émissions pour un podcast</h4>
					<p>
						Permet de récupérer un json avec la liste des épisodes du podcast
						<code>ID_PODCAST</code>
						donné dans l'URL et leurs caractéristiques. Triés et identifiés
						par un id unique.
						<code>API_KEY</code>
						correspond à la clé d'authenfication de l'application.
					</p>
					<pre>http://webserv.freepod.net/get.php?episodes=ID_PODCAST&key=API_KEY</pre>
					<h6>Récupère les champs suivants :</h6>
					<ul>
						<li><code>id</code></li>
						<li><code>id_podcast</code></li>
						<li><code>title</code></li>
						<li><code>url</code></li>
						<li><code>type</code></li>
						<li><code>description</code></li>
						<li><code>pubDate</code></li>
						<li><code>author</code></li>
						<li><code>explicite</code></li>
						<li><code>duration</code></li>
						<li><code>image</code></li>
					</ul>
				</div>
				<div class="span3"></div>
			</div>
		</div>
	</div>
</div>
<?php
include 'includes/footer.php';
?>

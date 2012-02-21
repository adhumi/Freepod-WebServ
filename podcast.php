<?php
if (! isset ( $_GET ['id'] )) {
	header ( 'Location: podcasts.php' );
}

include 'inc-header.php';

include ('bdd_connect.php');
connexion ( 'webserv' );

$query = "SELECT * FROM podcasts WHERE id = " . $_GET ['id'];
$result = mysql_query ( $query );
while ( $row = mysql_fetch_row ( $result ) ) {
	
	?>

<div class="container first">
	<div class="row">
		<div class="span3 wall">
			<ul class="nav nav-list">
				<li><a href="index2.php"><i class="icon-home"></i>Home</a></li>

				<li class="nav-header">Outils</li>
				<li class="active"><a href="podcasts.php"><i
						class="icon-th-list icon-white"></i> Tous les podcasts</a></li>
				<li><a href="episodes.php"><i class="icon-music"></i> Tous les
						&eacute;pisodes</a></li>
				<li><a href="#"><i class="icon-plus"></i> Ajout d'un podcast</a></li>
				<li><a href="#"><i class="icon-signal"></i> Statistiques</a></li>
			</ul>
		</div>
		<div class="span9">
			<div class="page-header">
				<h1><?php echo $row[1]; ?></h1>
			</div>
			<ul class="breadcrumb">
				<li><a href="index2.php">Home</a> <span class="divider">/</span></li>
				<li><a href="podcasts.php">Tous les podcasts</a> <span
					class="divider">/</span></li>
				<li class="active"><a href="podcast.php?id=<?php echo $row[0]; ?>"><?php echo $row[1]; ?></a></li>
			</ul>

			<div class="row">
				<div class="span7">
					<h6>Description</h6>
					<p><?php echo $row[3]; ?></p>
				</div>
				<div class="span2">
					<span class="label label-important pull-right"><?php echo $row[4]; ?></span>
				</div>
			</div>

			<h6>Flux RSS (URL)</h6>
			<pre><?php echo $row[2]; ?></pre>

			<div class="row">
				<div class="span5">
					<h6>Site du podcast (URL)</h6>
					<pre><?php echo $row[5]; ?></pre>

					<h6>Page Freepod du podcast (URL)</h6>
					<pre><?php echo $row[6]; ?></pre>

					<h6>Derni&egrave;re mise &agrave; jour du flux</h6>
					<p><?php echo $row[7]; ?></p>

					<h6>Derni&egrave;re synchronisation avec la base de donn&eacute;es</h6>
					<p><?php echo $row[8]; ?></p>
					
					<a href="sync.php?id=<?php echo $row[0]; ?>" class="btn btn-warning btn-large pull-right"><i class="icon-refresh icon-white"></i> Synchroniser maintenant</a>
				</div>
				<div class="span4">
					<h6>Logo normal</h6>
					<a href="<?php echo $row[9]; ?>" class="thumbnail"> <img
						src="<?php echo $row[9]; ?>" alt="<?php echo $row[1]; ?>" />
					</a>
				</div>
			</div>

		</div>
	</div>
</div>
</body>
</html>
<?php
}
?>
<?php
if (! isset ( $_GET ['id'] ) || $_GET['id'] == 0) {
	header ( 'Location: podcasts.php' );
}

include 'includes/header.php';

include ('includes/bdd_connect.php');
connexion ( 'webserv' );

require_once ($_SERVER ['DOCUMENT_ROOT'] . "/class/Podcast.php");
require_once ($_SERVER ['DOCUMENT_ROOT'] . "/class/Episode.php");

$podcast = Podcast::getPodcasts ( $_GET ['id'] );
$episodes = Episode::getEpisodesByPodcasts ( $_GET ['id'], "pubDate", "DESC");
?>

<div class="container first">
	<div class="row">
		<?php include 'includes/menu.php'; ?>
		<div class="span9">
			<?php if (isset($_GET['success_sync'])) { ?>
			<div class="alert alert-success alert-block">
				<a class="close" data-dismiss="alert">×</a>
				<h4 class="alert-heading">Terminé</h4>
				La synchronisation a été effectuée correctement. Inutile de
				reproduire l'opération.
			</div>
			<?php } ?>
			<div class="page-header">
				<h1><?php echo $podcast['nom']; ?></h1>
			</div>
			<ul class="breadcrumb">
				<li><a href="index2.php">Home</a> <span class="divider">/</span></li>
				<li><a href="podcasts.php">Tous les podcasts</a> <span
					class="divider">/</span></li>
				<li class="active"><a
					href="podcast.php?id=<?php echo $podcast['id']; ?>"><?php echo $podcast['nom']; ?></a></li>
			</ul>

			<div class="row">
				<div class="span7">
					<h6>Description</h6>
					<p><?php echo $podcast['description'];; ?></p>
				</div>
				<div class="span2">
					<?php if ($podcast['explicite'] == "Explicit") { ?>
					<span class="label label-important pull-right"><?php echo $podcast['explicite']; ?></span>
					<?php } elseif ($podcast['explicite'] == "Clean") { ?>
					<span class="label label-success pull-right"><?php echo $podcast['explicite']; ?></span>
					<?php } elseif ($podcast['explicite'] == "No") { ?>
					<span class="label label-info pull-right"><?php echo $podcast['explicite']; ?></span>
					<?php } ?>
				</div>
			</div>
			<div class="row">
				<div class="span5">
					<h6>Flux RSS (URL)</h6>
					<pre><?php echo $podcast['url_flux']; ?></pre>

					<h6>Site du podcast (URL)</h6>
					<pre><?php echo $podcast['url_site']; ?></pre>

					<h6>Page Freepod du podcast (URL)</h6>
					<pre><?php echo $podcast['url_freepod']; ?></pre>

					<h6>Derni&egrave;re modification du flux RSS</h6>
					<p><?php echo $podcast['lastUpdate']; ?></p>

					<h6>Derni&egrave;re synchronisation avec la base de donn&eacute;es</h6>
					<p><?php echo $podcast['lastSynch']; ?></p>
					<p>
						<a href="podcast-edit.php?id=<?php echo $podcast['id']; ?>"
							class="btn btn-warning btn-large ">Modifier</a> <a
							href="sync.php?id=<?php echo $podcast['id']; ?>"
							class="btn btn-primary btn-large ">Synchroniser maintenant</a>
					</p>
				</div>
				<div class="span4">
					<h6>Logo Normal</h6>
					<a href="<?php echo $podcast['logo_normal']; ?>" class="thumbnail">
						<img src="<?php echo $podcast['logo_normal']; ?>"
						alt="<?php echo $podcast['nom']; ?>" />
					</a>
					<h6>Logo Banner</h6>
					<a href="<?php echo $podcast['logo_banner']; ?>" class="thumbnail">
						<img src="<?php echo $podcast['logo_banner']; ?>"
						alt="<?php echo $podcast['nom']; ?>" />
					</a>
				</div>
			</div>
			<div class="row first">
				<h6 class="span7">Tous les épisodes de <?php echo $podcast['nom']; ?></h6>
				<table class="span9 table table-striped table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Nom</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
					<?php
					foreach ( $episodes as $episode ) {
						echo "<tr><td>" . $episode ['id'] . "</td>";
						echo "<td><a href=\"" . $episode ['url'] . "\">" . $episode ['title'] . "</a></td>";
						echo "<td>" . $episode ['pubDate'] . "</td></tr>";
					}
					?>
				</tbody>
				</table>
			</div>
			<div class="row first">
				<a href="podcast-delete.php?id=<?php echo $podcast['id']; ?>"
					class="btn btn-mini btn-danger pull-right"
					onclick="return confirm ('Etes vous sûr de vouloir supprimer le podcast <?php echo $podcast['nom']; ?> ?');"><i
					class="icon-warning-sign icon-white"></i> Supprimer</a>
			</div>

		</div>
	</div>
</div>
<?php
include 'includes/footer.php';
	?>
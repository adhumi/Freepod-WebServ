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
		<?php include 'inc-menu.php'; ?>
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
					<?php if ($row[4] == "Explicit") { ?>
					<span class="label label-important pull-right"><?php echo $row[4]; ?></span>
					<?php } elseif ($row[4] == "Clean") { ?>
					<span class="label label-success pull-right"><?php echo $row[4]; ?></span>
					<?php } elseif ($row[4] == "No") { ?>
					<span class="label label-info pull-right"><?php echo $row[4]; ?></span>
					<?php } ?>
				</div>
			</div>
			<div class="row">
				<div class="span5">
					<h6>Flux RSS (URL)</h6>
					<pre><?php echo $row[2]; ?></pre>

					<h6>Site du podcast (URL)</h6>
					<pre><?php echo $row[5]; ?></pre>

					<h6>Page Freepod du podcast (URL)</h6>
					<pre><?php echo $row[6]; ?></pre>

					<h6>Derni&egrave;re modification du flux RSS</h6>
					<p><?php echo $row[7]; ?></p>

					<h6>Derni&egrave;re synchronisation avec la base de donn&eacute;es</h6>
					<p><?php echo $row[8]; ?></p>
					<p>
						<a href="podcast-edit.php?id=<?php echo $row[0]; ?>"
							class="btn btn-warning btn-large ">Modifier</a> <a
							href="sync.php?id=<?php echo $row[0]; ?>"
							class="btn btn-primary btn-large ">Synchroniser maintenant</a>
					</p>
				</div>
				<div class="span4">
					<h6>Logo normal</h6>
					<a href="<?php echo $row[9]; ?>" class="thumbnail"> <img
						src="<?php echo $row[9]; ?>" alt="<?php echo $row[1]; ?>" />
					</a>
				</div>
			</div>
			<div class="row first">
				<h6 class="span7">Tous les épisodes de <?php echo $row[1]; ?></h6>
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
	
	$query = "SELECT * FROM episodes WHERE id_podcast = " . $_GET ['id'] . " ORDER BY pubDate DESC";
	$result2 = mysql_query ( $query );
	
	while ( $row_episode = mysql_fetch_row ( $result2 ) ) {
		echo "<tr><td>" . $row_episode [0] . "</td>";
		echo "<td><a href=\"" . $row_episode [3] . "\">" . $row_episode [2] . "</a></td>";
		echo "<td>" . $row_episode [6] . "</td></tr>";
	}
	?>
				</tbody>
				</table>
			</div>
			<div class="row first">
				<a href="podcast-delete.php?id=<?php echo $_GET ['id']; ?>" class="btn btn-mini btn-danger pull-right" onclick="return confirm ('Etes vous sûr de vouloir supprimer ce podcast ?');"><i class="icon-warning-sign icon-white"></i> Supprimer</a>
			</div>

		</div>
	</div>
</div>
<?php
	include 'inc-footer.php';
	?>
<?php
}
?>
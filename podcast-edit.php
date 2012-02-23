<?php
if (! isset ( $_GET ['id'] )) {
	header ( 'Location: podcasts.php' );
}

include 'includes/header.php';

include ('includes/bdd_connect.php');
connexion ( 'webserv' );

$query = "SELECT * FROM podcasts WHERE id = " . $_GET ['id'];
$result = mysql_query ( $query );
while ( $row = mysql_fetch_row ( $result ) ) {
	
	?>

<div class="container first">
	<div class="row">
		<?php include 'includes/menu.php'; ?>
		<div class="span9">
			<div class="page-header">
				<h1><?php echo $row[1]; ?></h1>
			</div>
			<ul class="breadcrumb">
				<li><a href="index2.php">Home</a> <span class="divider">/</span></li>
				<li><a href="podcasts.php">Tous les podcasts</a> <span
					class="divider">/</span></li>
				<li><a href="podcast.php?id=<?php echo $row[0]; ?>"><?php echo $row[1]; ?></a>
					<span class="divider">/</span></li>
				<li class="active">Edit</li>
			</ul>

			<form class="form-horizontal" method="post"
				action="podcast-update.php">
				<fieldset>
					<legend>Modifier les informations</legend>
					<input type="hidden" name="id_podcast"
						value="<?php echo $row[0]; ?>" />
					<div class="control-group">
						<label class="control-label" for="titre">Titre</label>
						<div class="controls">
							<input type="text" class="input-xlarge span5" id="titre"
								name="titre" value="<?php echo $row[1]; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="description">Description</label>
						<div class="controls">
							<textarea id="description" name="description" class="span6"
								rows="10"><?php echo $row[3]; ?></textarea>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="url_rss">Flux RSS (URL)</label>
						<div class="controls">
							<input type="text" class="input-xlarge span5" id="url_rss"
								name="url_rss" value="<?php echo $row[2]; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="url_site">Site du podcast (URL)</label>
						<div class="controls">
							<input type="text" class="input-xlarge span5" id="url_site"
								name="url_site" value="<?php echo $row[5]; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="url_freepod">Page Freepod (URL)</label>
						<div class="controls">
							<input type="text" class="input-xlarge span5" id="url_freepod"
								name="url_freepod" value="<?php echo $row[6]; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="explicite">Explicite</label>
						<div class="controls">
							<select id="explicite" name="explicite" class="span3">
								<option><?php echo $row[4]; ?></option>
								<option disabled="disabled">----------------------</option>
								<option>Explicit</option>
								<option>Clean</option>
								<option>No</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="logo">Logo normal</label>
						<div class="controls">
							<input type="text" class="input-xlarge span5" id="logo" name="logo"
								value="<?php echo $row[9]; ?>">
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<input type="submit" class="btn-primary btn-large"
								value="Enregistrer">
						</div>
					</div>
				</fieldset>

			</form>
		</div>
	</div>
</div>
<?php
include 'includes/footer.php';
?>
<?php
}
?>
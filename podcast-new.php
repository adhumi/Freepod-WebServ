<?php
include 'includes/header.php';
?>

<div class="container first">
	<div class="row">
		<?php include 'includes/menu.php'; ?>
		<div class="span9">
			<div class="page-header">
				<h1>Ajouter un nouveau podcast</h1>
			</div>
			<ul class="breadcrumb">
				<li><a href="index2.php">Home</a> <span class="divider">/</span></li>
				<li class="active">Nouveau podcast</li>
			</ul>

			<form class="form-horizontal" method="post"
				action="podcast-add.php">
				<fieldset>
					<legend>Entrer les informations</legend>
					<input type="hidden" name="id_podcast"
						value="" />
					<div class="control-group">
						<label class="control-label" for="titre">Titre</label>
						<div class="controls">
							<input type="text" class="input-xlarge span5" id="titre"
								name="titre" value="">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="description">Description</label>
						<div class="controls">
							<textarea id="description" name="description" class="span6"
								rows="10"></textarea>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="url_rss">Flux RSS (URL)</label>
						<div class="controls">
							<input type="text" class="input-xlarge span5" id="url_rss"
								name="url_rss" value="">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="url_site">Site du podcast (URL)</label>
						<div class="controls">
							<input type="text" class="input-xlarge span5" id="url_site"
								name="url_site" value="">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="url_freepod">Page Freepod (URL)</label>
						<div class="controls">
							<input type="text" class="input-xlarge span5" id="url_freepod"
								name="url_freepod" value="">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="explicite">Explicite</label>
						<div class="controls">
							<select id="explicite" name="explicite" class="span3">
								<option> </option>
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
								value="">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="logo">Logo Banner</label>
						<div class="controls">
							<input type="text" class="input-xlarge span5" id="logo_banner" name="logo_banner"
								value="">
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
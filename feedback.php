<?php
include 'includes/header.php';

include ('includes/bdd_connect.php');
connexion ( 'webserv' );

?>

<div class="container first">
	<div class="row">
		<?php include 'includes/menu.php'; ?>
		<div class="span9">
			<?php if (isset($_GET['feedback_mail'])) { ?>
			<div class="alert alert-error alert-block">
				<a class="close" data-dismiss="alert">×</a>
				<h4 class="alert-heading">Erreur</h4>
				Veuillez indiquer votre email !
			</div>
			<?php } ?>
			<div class="page-header">
				<h1>Feedback</h1>
			</div>
			<ul class="breadcrumb">
				<li><a href="index2.php">Home</a> <span class="divider">/</span></li>
				<li class="active"><a href="feedback.php">Feedback</a></li>
			</ul>

			<p>Ce formulaire est là pour envoyer un commentaire de toute forme
				aux developpeurs (retour, découverte de bug, demande d'ajouts de
				fonctionnalités, etc.). N'hésitez pas :-).</p>

			<div class="well">
				<form method="post" action="feedback-send.php"
					class="form-horizontal">
					<fieldset>
						<legend>Ecrire un message</legend>
						<div class="control-group">
							<label for="object">Sujet</label>
							<div class="controls">
								<input type="text" name="object" class="span4"
									value="Un problème sur webserv.freepod.net" />
							</div>
						</div>
						<div class="control-group">
							<label for="mail">Mail</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on">@</span> <input type="text" name="mail"
										class="" />
								</div>
							</div>
						</div>
						<div class="control-group">
							<label for="content">Message</label>
							<div class="controls">
								<textarea rows="15" class="span5" name="content">Bonjour,

Je t'écris pour te dire que...</textarea>
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<input type="submit" value="Envoyer"
									class="btn btn-large btn-primary" />
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
include 'includes/footer.php';
?>

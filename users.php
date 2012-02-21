<?php
include 'inc-header.php';
?>

<div class="container first">
	<div class="row">
		<?php include 'inc-menu.php'; ?>
		<div class="span9">
			<?php if (isset($_GET['success_add'])) { ?>
			<div class="alert alert-success alert-block">
				<a class="close" data-dismiss="alert">×</a>
				<h4 class="alert-heading">Terminé</h4>
				L'utilisateur a été ajouté à la base de données.
			</div>
			<?php } ?>
			
			<?php if (isset($_GET['error_add'])) { ?>
			<div class="alert alert-error alert-block">
				<a class="close" data-dismiss="alert">×</a>
				<h4 class="alert-heading">Erreur</h4>
				Les champs n'ont pas été remplis correctement.
			</div>
			<?php } ?>
			
			<div class="page-header">
				<h1>Liste des utilisateurs</h1>
			</div>
			<ul class="breadcrumb">
				<li><a href="index2.php">Home</a> <span class="divider">/</span></li>
				<li class="active"><a href="podcasts.php">Liste des utilisateurs</a></li>
			</ul>

			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>Pseudo</th>
						<th>Email</th>
						<th>Dernière visite</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include ('bdd_connect.php');
					connexion ( 'webserv' );
					
					$query = "SELECT * FROM users";
					$result = mysql_query ( $query );
					
					while ( $row = mysql_fetch_row ( $result ) ) {
						echo "<tr><td>" . $row [0] . "</td>";
						echo "<td>" . $row [1] . "</td>";
						echo "<td>" . $row [4] . "</td>";
						echo "<td>" . $row [3] . "</td>";
						echo "</tr>";
					}
					?>
				</tbody>
			</table>

			<form class="well form-horizontal" action="user-add.php" method="post">
				<fieldset>
					<legend>Ajouter un nouvel utilisateur</legend>
					<div class="control-group">
						<label for="login">Login</label>
						<div class="controls">
							<input type="text" name="login" />
						</div>
					</div>
					<div class="control-group">
						<label for="mail">Mail</label>
						<div class="controls">
							<input type="text" name="mail" />
						</div>
					</div>
					<div class="control-group">
						<label for="password">Password</label>
						<div class="controls">
							<input type="password" name="password1" />
							<input type="password" name="password2" />
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<input type="submit" value="Créer un compte" class="btn span2 btn-primary" />
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>
<?php
include 'inc-footer.php';
?>
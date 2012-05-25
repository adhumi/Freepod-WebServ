<?php
include 'includes/header.php';
?>

<div class="container first">
	<div class="row">
		<?php include 'includes/menu.php'; ?>
		<div class="span9">
			<div class="page-header">
				<h1>Statut</h1>
			</div>
			<ul class="breadcrumb">
				<li><a href="index2.php">Home</a> <span class="divider">/</span></li>
				<li class="active"><a href="status.php">Statut</a></li>
			</ul>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Méthode</th>
						<th>URL</th>
						<th>Statut</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>GET</td>
						<td>/get.php?podcasts&key=API_KEY</td>
						<td>
						<?php if (json_decode(file_get_contents('http://webserv.freepod.net/get.php?podcasts'))){ ?>
							<a href="http://webserv.freepod.net/get.php?podcasts" class="btn btn-small btn-success">Opérationnel</a>
						<?php } else { ?>
							<a href="http://webserv.freepod.net/get.php?podcasts" class="btn btn-small btn-danger">Erreur</a>
						<?php } ?>
						</td>
					</tr>
					<tr>
						<td>GET</td>
						<td>/get.php?episodes=ID_PODCAST&key=API_KEY</td>
						<td>
						<?php if (json_decode(file_get_contents('http://webserv.freepod.net/get.php?episodes=1'))){ ?>
							<a href="http://webserv.freepod.net/get.php?episodes=1" class="btn btn-small btn-success">Opérationnel</a>
						<?php } else { ?>
							<a href="http://webserv.freepod.net/get.php?episodes=1" class="btn btn-small btn-danger">Erreur</a>
						<?php } ?>
						</td>
					</tr>
				</tbody>
			</table>

		</div>
	</div>
</div>
<?php
include 'includes/footer.php';
?>
<?php
include 'inc-header.php';

include ('bdd_connect.php');
connexion ( 'webserv' );

?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Navigateur');
        data.addColumn('number', 'Nombre de visites');
        data.addRows([
		<?php
		$query = "SELECT COUNT(*), browser FROM statistiques GROUP BY browser";
		$rez = mysql_query ( $query );
		
		$row = mysql_fetch_row ( $rez );
		$row = mysql_fetch_row ( $rez );
		echo "['" . $row [1] . "', " . $row [0] . "]";
		while ( $row = mysql_fetch_row ( $rez ) ) {
			echo ",['" . $row [1] . "', " . $row [0] . "]";
		}
		?>
        ]);

        var options = {
        	legend:{position:'none'}, height:250
        };

        var chart = new google.visualization.PieChart(document.getElementById('camenbert_navigateur'));
        chart.draw(data, options);
    } 
</script>

<div class="container first">
	<div class="row">
		<?php include 'inc-menu.php'; ?>
		<div class="span9">
			<div class="page-header">
				<h1>Statistiques d'utilisation</h1>
			</div>
			<ul class="breadcrumb">
				<li><a href="index2.php">Home</a> <span class="divider">/</span></li>
				<li class="active"><a href="stats.php">Statistiques</a></li>
			</ul>

			<div class="row">
				<div class="span3">
					<h6>Répartition navigateurs</h6>
					<div id="camenbert_navigateur"></div>
					<p>Ces statistiques se basent sur le total des appels aux méthodes GET sur 30 jours glissants.</p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include 'inc-footer.php';
?>

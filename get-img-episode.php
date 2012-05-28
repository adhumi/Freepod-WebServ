<?php

include ('includes/bdd_connect.php');
connexion ( 'webserv' );

/**
 *	Initialisation de toutes les constantes
 */


// Durée du cache (en secondes)
$expire = time () - 60 * 60 * 24;
//Dossier de cache
$img_dst_chemin = $_SERVER ['DOCUMENT_ROOT'] . "/cache/img/";
// Fichier par défaut
$src_filename = "http://webserv.freepod.net/img/podcasts/default.png";
// Nom du fichier de cache
$dst_filename = "episode" . $_GET ['id'] . "_" . $_GET['nom'] . "_" . $_GET['width'] . ".png";
// Emplacement du fichier de cache
$cache = $_SERVER ['DOCUMENT_ROOT'] . "/cache/img/" . $dst_filename;

// Récupération de l'URL de l'image
$query = "SELECT " . $_GET['nom'] . " FROM episodes WHERE id = " . $_GET ['id'] . " LIMIT 1";

$sth = mysql_query ( $query );
while ( $r = mysql_fetch_row( $sth ) ) {
	$src_filename = $r [0];
}

// Si le cache est encore valide
if (file_exists ( $cache ) && filemtime ( $cache ) > $expire) {
	header("Location: http://webserv.freepod.net/cache/img/" . $dst_filename);
} else {
	// Déterminer l'extension à partir du nom de fichier
	$extension = substr( $img_src_chemin . $src_filename, -3 );
	// Afin de simplifier les comparaisons, on met tout en minuscule
	$extension = strtolower( $extension );
	
	if ($extension == "jpg" || $extension == "peg") {
		$img_src_ressource = imagecreatefromjpeg( $src_filename);
		$extension = "jpeg";
	} else if ($extension == "gif") {
		$img_src_ressource = imagecreatefromgif( $src_filename );
	} else if ($extension == "png") {
		$img_src_ressource = imagecreatefrompng( $src_filename );
	}
	
	// Exemple avec imagesx() et imagesy()
	$img_src_width = imagesx( $img_src_ressource );
	$img_src_height = imagesy( $img_src_ressource );
	
	$width = $_GET['width'];
	$height = ($img_src_height * $width) / $img_src_width;
	
	//Pour créer une image de destination de $height pixels de large sur $width de haut
	$img_dst_ressource = imagecreatetruecolor( $height, $width );
	
	imagecopyresampled($img_dst_ressource, $img_src_ressource, 0, 0, 0, 0, $height, $width, $img_src_width, $img_src_height);
	
	// Vérifions tout d'abord que nous pouvons enregistrer le fichier
	$handle = fopen( $img_dst_chemin . $dst_filename, "w" );
	if ( !$handle ) {
		echo "Impossible d'ecrire l'image. Verifiez le chemin, et les droits du serveur.";
		exit;
	}
	fclose( $handle );
	
	imagepng ($img_dst_ressource, $img_dst_chemin . $dst_filename);
	
	header("Location: http://webserv.freepod.net/cache/img/" . $dst_filename);
}


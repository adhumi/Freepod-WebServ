<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

$height = 800;
$width = 800;

$img_src_chemin = "/home/freepod/sd/webserv/www/img/";
$filename = "logo-itunes.png";
$img_dst_chemin = $_SERVER ['DOCUMENT_ROOT'] . "/cache/img/";

// DŽterminer l'extension ˆ partir du nom de fichier
$extension = substr( $img_src_chemin . $filename, -3 );
// Afin de simplifier les comparaisons, on met tout en minuscule
$extension = strtolower( $extension );

if ($extension == "jpg" || $extension == "peg") {
	$img_src_ressource = imagecreatefromjpeg( $img_src_chemin . $filename);
	$extension = "jpeg";
} else if ($extension == "gif") {
	$img_src_ressource = imagecreatefromgif( $img_src_chemin . $filename );
} else if ($extension == "png") {
	$img_src_ressource = imagecreatefrompng( $img_src_chemin . $filename );
}

//Pour crŽer une image de destination de 200 pixels de large sur 200 de haut
$img_dst_ressource = imagecreatetruecolor( $height, $width );

// Exemple avec imagesx() et imagesy()
$img_src_width = imagesx( $img_src_ressource );
$img_src_height = imagesy( $img_src_ressource );

imagecopyresampled($img_dst_ressource, $img_src_ressource, 0, 0, 0, 0, $height, $width, $img_src_width, $img_src_height);

// VŽrifions tout d'abord que nous pouvons enregistrer le fichier
$handle = fopen( $img_dst_chemin . $filename, "w" );
if ( !$handle ) {
	echo "Impossible d'ecrire l'image. Verifiez le chemin, et les droits du serveur.";
	exit;
}
fclose( $handle );

imagepng ($img_dst_ressource, $img_dst_chemin . $filename);

header ("Content-type: image/" . $extension);
imagepng ($img_dst_ressource);


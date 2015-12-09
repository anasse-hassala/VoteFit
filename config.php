<?php
try{
	$bdd = new PDO('mysql:host=localhost;dbname=rms', 'rms', 'V0teFit');
}
catch(Exception $e){
	die('Erreur : '.$e->getMessage());
}
?>

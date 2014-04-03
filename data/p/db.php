<?php

$database = array
(
			//Database 
			'DB' => 'projects',
			//Adresse IP de la base de donnée
			'HOST' => '127.0.0.1',
			//Nom d'utilisateur de la base de donnée
			'USER' => 'root',
			//Mot de passe de la base de donnée
			'PASSWORD' => '',
);

$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_WARNING;
$db = new PDO('mysql:host='.$database['HOST'].';dbname='.$database['DB'], $database['USER'], $database['PASSWORD']);					 

?>
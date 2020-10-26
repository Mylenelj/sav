<?php
// Pour la connexion, on demande login + mot de passe

//Ouvrir la base
$sql_host='127.0.0.1';
$sqli_user='root';
$sql_password="";
$sql_db='sav';

//Connection à la BDD
$lien_bdd = mysqli_connect($sql_host, $sqli_user, $sql_password, $sql_db);

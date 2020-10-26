<?php
session_start();


require_once 'connexion.php';
// Variables pour création de ticket
$mail= "";
$aleatoire=0;
$titre= "";
$message= "";
$etat= "";
$IDcategorie= 0;
$tableauError=[];
$tableauReussi=[];


// Variables pour recherche de ticket
$saisiRecherche = "";

if (isset ($_GET ['saisi']) && !EMPTY($_GET ['saisi'])) 
{
    $requeteRecherSaisi= "SELECT * FROM ticket WHERE MailUser LIKE ".$_GET['saisi'] ."OR Aleatoire=".$_GET['saisi']." ;";
$resultSaisi= mysqli_query($lien_bdd,$requeteRecherSaisi); 

// Fonction pour utiliser les données faites avec la requete SELECT 
$ligneResultatSaisi= mysqli_fetch_assoc($resultSaisi);
}


// assainir les variables avec les valeurs :
if (isset($_GET['mail']) && !EMPTY($_GET['mail']))

{
$requeteEmailUnique= "SELECT * FROM ticket WHERE MailUser LIKE ".$_GET['mail'].";";
$resultMail= mysqli_query($lien_bdd,$requeteEmailUnique);

// Fonction pour utiliser les données faites avec la requete SELECT 
if (EMPTY($resultMail))
{
//$ligneResultat= mysqli_fetch_assoc($resultMail); 
$mail= htmlspecialchars(trim(stripslashes(strip_tags($_GET ['mail']))));

} else {
$tableauError [] = 'Email existant';
}


}else{
    $tableauError []= 'Email vide';
}



if (isset($_GET['titre']) && !EMPTY($_GET['titre']))
{
$titre= htmlspecialchars(trim(stripslashes(strip_tags($_GET ['titre']))));

}else{
    $tableauError []= 'Titre vide';
}

if (isset($_GET['message']) && !EMPTY($_GET['message']))
{
$message= htmlspecialchars(trim(stripslashes(strip_tags($_GET ['message']))));

}else{
    $tableauError []= 'Message vide';
}

//Générer un nombre aleatoire et faire une requete pour tester si le numero est unique
$Nbchoisi= rand (80000000, 99999999);
$requeteNbUnique= "SELECT * FROM ticket WHERE aleatoire LIKE '$aleatoire'";
$resultat= mysqli_query($lien_bdd,$requeteNbUnique);

// Fonction pour utiliser les données faites avec la requete SELECT 
$ligneResultat= mysqli_fetch_assoc($resultat);

if (EMPTY ($ligneResultat)) {
    $aleatoire = $Nbchoisi;
} else {
    $tableauError [] = 'Le numero existe deja dans la base de donnees';
}


//Recuperer la categorie choisit par l'utlisateur
if(isset($_GET['categorie']) && !EMPTY($_GET['categorie'])) 
{
    $IDcategorie= intval($_GET ['categorie']) ;
}else{
    $tableauError []= 'Il faut choisir une catégorie';
}



//REQUETE pour inserer un nouveau ticket
$requete= "INSERT INTO ticket (MailUser, Aleatoire, Titre, Message, ID_categorie) VALUES ('$mail', '$aleatoire', '$titre', '$message', '$IDcategorie')";

if (EMPTY ($tableauError)) {

// execute la requete dans SQL    
mysqli_query($lien_bdd,$requete);

// Recuperer une info dans la BDD :
$last_id = mysqli_insert_id($lien_bdd);


//Si ca fonctionne et si ca fonctionne pas
if ($last_id !=0) {
    echo 'Insertion réussi';

}

else
{
    echo 'Insertion échouée';
}
}

// User
// creer le formullaire en HTML
?>
<?php
for ($i=0; $i<count ($tableauError); $i++){
echo $tableauError [$i];
}
?>

<form action="" method="get">
<input type="mail" placeholder="saisissez votre email" name="mail">
<input type="text" placeholder="saisissez titre message" name="titre">
<textarea placeholder="saisissez le message" name="message"> </textarea>

<select name="categorie" id="categorie">
    <option value="">--choisir une categorie--</option>
    <option value="1">Panne</option>
    <option value="2">Rupture de fourniture</option>
    <option value="3">Autre</option>
   </select>
<input type ="text"  value ="<?=$aleatoire?>">
<input type="submit" value="Envoyez">
</form>

<form action="">
<input type="text" placeholder="saisissez le numero du ticket ou votre email SVP" name="saisi">
<input type="submit" value="Chercher">
</form>

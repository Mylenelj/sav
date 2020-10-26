<?php

function traite_post($variable) {
    //On vérifie que la variable existe dans le post et qu'elle n'est pas vide
    if (isset($_POST[$variable]) && !empty($_POST[$variable]))
    {
        //on retourne la variable assainie si elle existe
        return htmlspecialchars(trim(stripslashes(strip_tags($_POST[$variable]))));
    }
}

session_start();

require_once 'connexion.php';

//$_POST
if (!empty ($_POST)) {
    $numero_ticket=0;
    $categorie=0;
    $reponse="";
    $toutesLesreponses="";

    $numero_ticket = traite_post("numero_ticket");
    $categorie = traite_post("categorie");
    $reponse = traite_post("reponse");
    $toutesLesReponses = traite_post("toutesLesReponses");

        if (isset ($_POST ['MAJ'])){
//Je veux modifier la catégorie
if ($lien_bdd) { 
   $sql = "UPDATE ticket SET ID_categorie = $categorie WHERE ID=$numero_ticket"; 
   // Exécution de la requête 
   $resultat = mysqli_query($lien_bdd, $sql); 
   
}
        }
     if (isset ($_POST ['REPONDRE'])){
//Je veux modifier la catégorie
if ($lien_bdd) { 
   $sql = "INSERT INTO reponse (ID_ticket, Message) VALUES ($numero_ticket,'$reponse')"; 
   // Exécution de la requête 
   $resultat = mysqli_query($lien_bdd, $sql);
   
}
        }

}

// $_GET
$numero_ticket = $_GET["id"];

$requete = "SELECT * FROM ticket WHERE ticket.Aleatoire = $numero_ticket";
$resultat = mysqli_query($lien_bdd, $requete);
while($row_resultat = mysqli_fetch_assoc($resultat)) {
    $ticket[] = $row_resultat;

    //Déclaration d'un tableau de réponses vide
    $reponses = array();

    //Exécution de la requête des réponses du ticket
    $toutesLesReponses= "SELECT * FROM reponse WHERE ID_ticket =  ".$row_resultat['ID'];
    $resultatReponses =mysqli_query($lien_bdd, $toutesLesReponses);
    while($row_resultatReponses = mysqli_fetch_assoc($resultatReponses)) {
        $reponses[] = $row_resultatReponses;
    }

    //On place le tableau des réponses dans le dernier ticket du tableau ticket
    $ticket[count($ticket)-1]["reponses"] = $reponses;
}

?>


<form action="" method="POST">
    <label for="numero_ticket">Numero du ticket</label>
<input type="text" value="<?= $ticket[0]["Aleatoire"] ?>" name="numero_ticket" id="numero_ticket">
<textarea placeholder="saisissez une réponse" name="réponse"><?= $ticket[0]["Message"] ?></textarea>


<select name="categorie" id="categorie">
    <option value="">--modifier la catégorie--</option>
    <option value="1">Panne</option>
    <option value="2">Rupture de fourniture</option>
    <option value="3">Autre</option>
   </select>
<input type ="text"  value ="<?= $ticket[0]["Date"] ?>">
<input type="submit" value="Envoyez" name="MAJ">
</form>

<br>
<?php
for  ($i = 0; $i < count($ticket[0]["reponses"]); $i++) {
    echo $ticket[0]["reponses"][$i]["Message"];
    echo "<br>";
}
?>
<br>
<h2>REPONDRE AU DEMANDEUR</h2>
   
    <form method="post">
  <textarea placeholder="saisissez une réponse" name="reponse"></textarea>
<input type="hidden" value="<?= $ticket[0]["ID"] ?>" name="numero_ticket" id="numero_ticket">
    <input type="submit" name="REPONDRE"></form>
   
    


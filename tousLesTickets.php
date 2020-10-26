<?php
session_start();

require_once 'connexion.php';

//Sélectionner les tickets dans la base de données
$requete = "SELECT * FROM ticket ORDER BY Date";
$resultat = mysqli_query($lien_bdd, $requete);

?>
<table>
    <thead>
        <tr>
               <th>Numero du Ticket</th>
               <th>Titre</th>
               <th>Message</th>
               <th>Date</th>
               <th>Statut</th>
        </tr>
    </thead>
<?php
//Les afficher un par un
while ($ligne_resultat = mysqli_fetch_assoc($resultat)) {
?>
<tr>
    <td><a href= "AccesAuTicket.php?id=<?= $ligne_resultat['Aleatoire'] ?>"><?= $ligne_resultat['Aleatoire'] ?></a></td>
    <td><?= $ligne_resultat['Titre'] ?></td>
    <td><?= $ligne_resultat['Message'] ?></td>
    <td><?= $ligne_resultat['Date'] ?></td>
    <td><?= $ligne_resultat['Etat'] ?></td>
<?php
}
?>
</table>




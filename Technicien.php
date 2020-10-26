<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACCES TECHNICIEN</title>
</head>
<body>
 <?php
 //L'assistant technique doit se connecter à l'aide d'un mot de passe générique (commun à tout le monde).
    if (isset($_POST['mot_de_passe']) AND $_POST['mot_de_passe'] ==  "azerty") // Si le mot de passe est bon
    {
    // On affiche les tickets et les techniciens peuvent réatribuer des catégories à ceux-ci
    ?>
        
        <?php
        
    }
    else // Sinon, on affiche un message d'erreur
    {
        echo '<p>Mot de passe incorrect</p>';
    }
    ?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saisissez le PASSWORD, merci.</title>
</head>
<body>
    <h1>Accès à la liste des tickets: <a href="tousLesTickets.php">Liste des tickets</a></h1>
    <p>
    <form method="post">
    <input type="password" name="mot_de_passe"> 
    <input type="submit" name="Envoyez"></form>
    </p>
    <p>Cet espace est réservé. Vous devez saisir le password pour y accéder.</p>


    
</body>
</html>
            


<?php
// Connexion à la base de données
try
{
$bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}

$messages = $bdd->query("SELECT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5");


while($donnees_messages = $messages->fetch())
{
    echo '<strong>' . $donnees_messages['date_creation_fr'].' : '.nl2br(htmlspecialchars($donnees_messages['titre'])) . '</strong> : '.'<br/>';
    echo nl2br(htmlspecialchars($donnees_messages['contenu'])) . '</p>';
    echo "<p><a href=\"commentaires.php?billet=".$donnees_messages['id']."\">Commentaires</a></h3>";
    echo '<br><br>';
    echo '<br><br>';
}
$messages->closeCursor();

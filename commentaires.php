<?php
//affichage d'un billet et de ses commentaires.

echo'<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
echo'<link rel="stylesheet" type="text/css" href="style.css" media="all"/>';
echo'<h1>MON SUPER BLOG!</h1>';

echo'<p><a href="index.php">Retour à la liste des billets</a></p>';


// Connexion à la base de données
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

$billet = $_GET['billet'];

$sql = "SELECT * FROM billets where id='". $billet . " ' ";
$sql2 = "SELECT * FROM commentaires as c inner join billets as b ON c.id_billet = b.id and id_billet=' " . $billet . " ' order by date_commentaire";
$sql3 = "SELECT COUNT(*) FROM commentaires where id_billet=' " . $billet ."'";

$countBillet = $bdd->query($sql3)->fetchAll();
var_dump($countBillet);

$billet = $bdd->query($sql)->fetch();

if($billet !== false){
    echo '<fieldset>';
    echo '<legend>Billet :</legend>';
    echo '<strong>' . $billet['date_creation'].' : '.nl2br(htmlspecialchars($billet['titre'])) . '</strong> : '.'<br/>';
    echo nl2br(htmlspecialchars($billet['contenu'])) . '</p>';
    echo '</fieldset>';
    echo '<br/>';




$commentaires = $bdd->query($sql2);


if(isset($billet)){
    while($resultat = $commentaires->fetch())
    {
        echo '<strong>' . $resultat['date_commentaire'].' : '.$resultat['auteur'] . '</strong> : '.'<br/>';
        echo $resultat['commentaire'] . '</p>';
    }
}

echo '<br/>';
echo '<h4>Ajouter un commentaire</h4>';
echo "<form method='post' action='commentaire_post.php'>";
echo "<input type='text' name='auteur' placeholder='Auteur'><br/><br/>";
echo "<textarea name='commentaire' rows=\"4\" cols=\"50\" placeholder='Ecrivez votre commentaire'></textarea>";
echo "<input type='hidden' name='billet' value='".$billet['id']."'>";
echo "<input type=\"submit\" value=\"Valider\">";
echo "</form>";

}else{
    echo'<h2>Ce billet n\'existe pas !!!</h2>';
}

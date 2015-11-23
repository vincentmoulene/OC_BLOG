<?php

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

$billet = $_POST['billet'];
$auteur = $_POST['auteur'];
$commentaire = $_POST['commentaire'];

$addCommentaire = $bdd->query("INSERT INTO commentaires(id_billet, auteur, commentaire, date_commentaire) VALUES ('$billet','$auteur','$commentaire', NOW())");
$addCommentaire->fetch();

header("Location: commentaires.php?billet=".$billet);

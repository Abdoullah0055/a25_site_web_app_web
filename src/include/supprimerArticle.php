<?php
session_start();
require '../AlgosBD.php';

if (isset($_POST['idArticle'])) {
    $idArticle = $_POST['idArticle'];

    //Verifier autorisation de supprimer l'article
    $nomUsagerConnecte = $_SESSION['nom'] ?? null;
    $validiteSuppression = get_validiteSuppressionArticle($idArticle, $nomUsagerConnecte);


    // Appeler une fonction pour supprimer l'article de la base de données
    if ($validiteSuppression) {
        $suppressionReussie = supprimer_article($idArticle);
        if ($suppressionReussie) {
            header("Location: ../index.php");
            exit();
        } else {
            die("Erreur lors de la suppression de l'article.");
        }
    } else {
        die("Vous n'êtes pas autorisé à supprimer cet article.");
    }
}

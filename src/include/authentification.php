<?php
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Ouvrir et parcourir fichier pour trouver si user + mdp valide
    $bdMDP = fopen('../BD_CSV/informations_login.csv', 'r');

    // Bool qui devient true quand connection est bonne
    $authentifié = false;

    while (($ligne = fgetcsv($bdMDP, 1000, ";", '"', '')) !== false) {
        if ($username == $ligne[0] && $password == $ligne[1]) {
            $authentifié = true;
            break;
        }
    }
    fclose($bdMDP);

    if ($authentifié) {
        $_SESSION['connected'] = true;
        $_SESSION['nom'] = $username;
    } else {
        $_SESSION['connected'] = false;
        unset($_SESSION['nom']);
    }

    header("Location: ../index.php");
    exit();
}

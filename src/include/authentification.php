<?php
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Bool qui devient true quand connection est bonne
    $authentifié = false;

    // Essayer de se connecter: true si ok, false sinon
    require_once "../AlgosBD.php";
    $authentifié = verifierLogin($username, $password);

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
?>
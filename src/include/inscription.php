<?php
session_start();
require_once "../AlgosBD.php";
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confpassword'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confpassword = trim($_POST['confpassword']);

    if($password !== $confpassword){
        consoleLog("Les mots de passe ne sont pas identiques.");
        header("Location: ../formulaireLogin.php");
    }

    $inscriptionRéussie = inscrireUsager($username, $password);

    if($inscriptionRéussie){
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
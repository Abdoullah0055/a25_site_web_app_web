<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publier un article - Abdou's Market</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <?php
    $theme = $_COOKIE['theme'] ?? 'clair';
    $cssFile = $theme === 'sombre' ? 'theme-sombre.css' : 'theme-clair.css';
    ?>
    <link rel="stylesheet" href="<?= $cssFile ?>">
</head>

<body class="font-sans m-0 p-0">

    <!-- Nav -->
    <nav class="border-b">
        <?php include "include/nav.php"; ?>
    </nav>

    <!-- Contenu du formulaire -->
    <main class="flex justify-center items-center py-24 bg-gray-100">
        <?php include "include/formulaireLogin.php"; ?>
    </main>

    <!-- Footer -->
    <footer class="border-t mt-16">
        <?php include "include/footer.php"; ?>
    </footer>

</body>

</html>
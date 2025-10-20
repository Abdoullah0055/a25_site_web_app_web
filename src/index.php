<!-- Source pour les icones: https://www.flaticon.com/search?word=message -->
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Abdou's Market</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <?php
  $theme = $_COOKIE['theme'] ?? 'clair';
  $cssFile = $theme === 'dark' ? 'css/theme-sombre.css' : 'css/theme-clair.css';
  ?>
  <link rel="stylesheet" href="<?= $cssFile ?>">
</head>

<body class="font-sans m-0 p-0">

  <!-- Header -->
  <nav class="border-b">
    <?php include "include/nav.php"; ?>
  </nav>

  <!-- Bannière Header -->
  <header class="relative bg-cover bg-center" style="background-image: url('images/elegant-marketplace.jpg');">
    <?php include "include/header.php"; ?>
  </header>

  <main class="max-w-6xl mx-auto px-6 py-12">

    <!-- Catégories -->
    <?php include "include/catégories.php"; ?>

    <!-- Produits -->
    <?php include "include/produits.php"; ?>
  </main>

  <footer class="border-t mt-16">
    <!-- Footer -->
    <?php include "include/footer.php"; ?>
  </footer>

</body>

</html>

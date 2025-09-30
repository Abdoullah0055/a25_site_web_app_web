<!-- Source pour les icones: https://www.flaticon.com/search?word=message -->
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Abdou's Market</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            light: "#F5F5F5", // fond clair
            silver: "#C0C0C0", // accents métalliques
            anthracite: "#2E2E2E", // gris foncé élégant
            blacklux: "#1B1B1B" // noir profond
          },
          fontFamily: {
            sans: ["Inter", "Helvetica", "Arial", "sans-serif"],
            serif: ["Georgia", "serif"]
          }
        }
      }
    }
  </script>
</head>
<!-- 
TO DO: 
- Changer le chemin du fichier pour ne plus avoir d'espaces dans l'URL.
-  
-->
<body class="bg-light text-anthracite font-sans m-0 p-0">

  <!-- Header -->
  <nav class="bg-anthracite border-b border-anthracite">
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

  <footer class="bg-blacklux border-t border-anthracite mt-16">
    <!-- Footer -->
    <?php include "include/footer.php"; ?>
  </footer>

</body>

</html>
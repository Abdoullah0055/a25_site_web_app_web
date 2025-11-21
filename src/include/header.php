<!-- Bannière Header -->
<div class="absolute inset-0 bg-blacklux bg-opacity-60"></div>

<div class="relative max-w-6xl mx-auto px-6 pt-6 pb-2 text-center">
  <h2 class="text-3xl md:text-4xl font-semibold text-light text-shadow-dark">
    À une recherche du coup de coeur
  </h2>

  <!-- Search bar -->
  <form class="max-w-xl mx-auto mt-8">
    <div class="flex rounded-lg overflow-hidden shadow-md">
      <input
        type="search"
        placeholder="Rechercher un produit ou une catégorie..."
        class="w-full p-3 text-sm text-anthracite bg-light placeholder-anthracite focus:outline-none focus:ring-2 focus:ring-silver"
        required>
      <button
        type="submit"
        class="px-4 bg-silver text-blacklux font-semibold hover:bg-anthracite hover:text-light transition">
        <img src="images/icones/icone-loupe.png" alt="Recherche" class="w-5 h-5">
      </button>
    </div>
  </form>

  <!-- Afficher le message dépendamment à si l'utilisateur est connecté -->
  <?php if (isset($_SESSION['connected']) && $_SESSION['connected'] === true): ?>
    <h3 class="mt-7 text-3xl font-normal text-shadow-dark">
      Bienvenue, <?= htmlspecialchars($_SESSION['nom']) ?>!
    </h3>

    <div class="mt-5 mb-10 flex justify-center gap-6" items.center>
      <?php include "include/boutonPublier.php"; ?>
      <?php include "include/boutonLogout.php"; ?>
    </div>

  <?php else: ?>
    <h3 class="mt-7 text-3xl font-normal text-shadow-dark">
        Veuillez vous connecter pour pouvoir publier des annonces.
      </h3>
    <div class="mt-5">
      <?php include "include/boutonLogin.php"; ?>
    </div>
  <?php endif; ?>
</div>
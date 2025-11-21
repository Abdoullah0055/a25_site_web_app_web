<?php
// Lire le thème actuel depuis le cookie (clair par défaut)
$theme = $_COOKIE['theme'] ?? 'clair';

// Image du texte selon le thème
$texteSrc = $theme === 'clair'
  ? 'images/header-nom/sombre-image-header.png'
  : 'images/header-nom/clair-image-header.png';

// Exemple : variable de session (true si connecté, false sinon)
$connected = $_SESSION['connected'] ?? false;
?>

<div class="relative max-w-6xl mx-auto px-4 flex justify-between items-center text-black">
  <!-- Logo -->
  <a href="index.php" class="flex items-center space-x-3 hover:opacity-90 transition">
    <img src="images/elegant-logo-site.png" alt="Logo du site" class="w-[5rem] h-[5rem]">
  </a>

  <!-- Titre -->
  <a href="index.php" class="absolute left-1/2 -translate-x-1/2 hover:opacity-90 transition">
    <img src="<?= $texteSrc ?>" alt="Nom du site" class="h-[1.8rem] object-contain">
  </a>

  <!-- Icones + bouton thème -->
  <div class="flex items-center space-x-4 relative">
    <a href="#" class="hover:opacity-80 transition">
      <img src="images/icones/icone-loupe.png" alt="Recherche" class="w-6 h-6">
    </a>

    <!-- Profil -->
    <div class="relative">
      <button id="profile-btn" class="hover:opacity-80 transition focus:outline-none">
        <img src="images/icones/icone-profile.png" alt="Profil" class="w-6 h-6 rounded-full">
      </button>

      <!-- Mini-menu déroulant -->
      <div id="profile-menu" class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-lg hidden z-50">
        <?php if ($connected): ?>
          <a href="logout.php" class="block px-4 py-2 text-black hover:bg-gray-200 hover:text-black">Déconnexion</a>
        <?php else: ?>
          <a href="login.php" class="block px-4 py-2 text-black hover:bg-gray-200 hover:text-black">Connexion + Inscription</a>
        <?php endif; ?>
      </div>


      <!-- Bouton thème -->
      <button id="theme-toggle" class="text-2xl" aria-label="Basculer thème">
        <?= $theme === 'clair' ? '🌙' : '☀️'; ?>
      </button>
    </div>
  </div>


  <script>
    // Toggle thème
    document.getElementById('theme-toggle').addEventListener('click', function() {
      const currentTheme = getCookie('theme') || 'clair';
      const newTheme = currentTheme === 'clair' ? 'sombre' : 'clair';
      document.cookie = "theme=" + newTheme + "; path=/; max-age=" + (60 * 60 * 24 * 30);
      location.reload();
    });

    function getCookie(name) {
      const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
      return match ? match[2] : null;
    }

    // Toggle menu profil
    const profileBtn = document.getElementById('profile-btn');
    const profileMenu = document.getElementById('profile-menu');

    profileBtn.addEventListener('click', () => {
      profileMenu.classList.toggle('hidden');
    });

    // Fermer le menu si clic en dehors
    document.addEventListener('click', (e) => {
      if (!profileBtn.contains(e.target) && !profileMenu.contains(e.target)) {
        profileMenu.classList.add('hidden');
      }
    });
  </script>
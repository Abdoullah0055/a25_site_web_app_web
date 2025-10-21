<?php
// Lire le thème actuel depuis le cookie (clair par défaut)
$theme = $_COOKIE['theme'] ?? 'clair';
?>

<div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center">
  <!-- Logo cliquable -->
  <a href="index.php" class="flex items-center space-x-3 hover:opacity-90 transition">
    <img src="images/elegant-logo-site.png" alt="Logo du site" class="w-[5rem] h-[5rem]">
  </a>

  <!-- Icônes + bouton thème -->
  <div class="flex items-center space-x-4">
    <a href="#" class="hover:opacity-80 transition">
      <img src="images/icones/icone-loupe.png" alt="Recherche" class="w-6 h-6">
    </a>
    <a href="#" class="hover:opacity-80 transition">
      <img src="images/icones/icone-messagerie.png" alt="Messages" class="w-6 h-6">
    </a>
    <a href="#" class="hover:opacity-80 transition relative">
      <img src="images/icones/icone-notification.png" alt="Notifications" class="w-6 h-6">
    </a>
    <a href="#" class="hover:opacity-80 transition">
      <img src="images/icones/icone-profile.png" alt="Profil" class="w-6 h-6 rounded-full">
    </a>

    <!-- Bouton thème -->
    <button id="theme-toggle" class="text-2xl">
      <?= $theme === 'clair' ? '🌙' : '☀️'; ?>
    </button>
  </div>
</div>

<script>
  document.getElementById('theme-toggle').addEventListener('click', function() {
    const currentTheme = getCookie('theme') || 'clair';
    const newTheme = currentTheme === 'clair' ? 'sombre' : 'clair';
    document.cookie = "theme=" + newTheme + "; path=/; max-age=" + (60 * 60 * 24 * 30);
    location.reload();
  });

  // Petite fonction utilitaire pour lire un cookie
  function getCookie(name) {
    const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    return match ? match[2] : null;
  }
</script>
<?php
if (isset($_POST['theme_toggle'])) {
  $theme = $_COOKIE['theme'] ?? 'clair';
  $theme = $theme === 'clair' ? 'dark' : 'clair';
  setcookie('theme', $theme, time() + 60 * 60 * 24 * 30, '/');
  $_COOKIE['theme'] = $theme;
  header("Location: " . $_SERVER['PHP_SELF']);
  exit;
}
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
    <form method="POST">
      <button type="submit" name="theme_toggle">
        <?php
        $theme = $_COOKIE['theme'] ?? 'clair';
        echo $theme === 'clair' ? '🌙' : '☀️';
        ?>
      </button>
    </form>
  </div>
</div>
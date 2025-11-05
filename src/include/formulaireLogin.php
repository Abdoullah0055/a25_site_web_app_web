<?php
?>

<form action="include/authentification.php" method="POST" class="bg-white rounded-lg shadow-xl text-sm text-gray-500 border border-gray-200 p-8 py-12 w-80 sm:w-[352px]">
    <p class="text-2xl font-medium text-center">
        <span class="text-indigo-500">Connection</span>
    </p>

    <div class="mt-4">
        <label for="username" class="block">Nom d'utilisateur</label>
        <input type="text" id="username" name="username" placeholder="Entrez votre nom d'utilisateur" required
            class="border border-gray-200 rounded w-full p-2 mt-1 outline-indigo-500">
    </div>

    <div class="mt-4">
        <label for="password" class="block">Mot de passe</label>
        <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required
            class="border border-gray-200 rounded w-full p-2 mt-1 outline-indigo-500">
    </div>

    <p class="mt-4">
        Create an account?
        <a href="#" class="text-indigo-500">Click here</a>
    </p>

    <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 transition-all text-white w-full py-2 rounded-md mt-4 cursor-pointer">
        Login
    </button>
</form>
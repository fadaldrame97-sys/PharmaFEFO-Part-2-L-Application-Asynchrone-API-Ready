<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<header class="bg-blue-600 text-white p-4 flex justify-between items-center">
    <div class="font-bold">
        PharmaFEFO
    </div>

    <div class="flex items-center gap-4">

        <?php if (!empty($_SESSION['user_role'])): ?>
            <span class="text-sm bg-blue-800 px-2 py-1 rounded">
                <?= $_SESSION['user_role'] ?>
            </span>

            <a href="index.php?route=logout"
               class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-white">
                Déconnexion
            </a>
        <?php endif; ?>

    </div>
</header>
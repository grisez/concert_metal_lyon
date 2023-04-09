<?php
$title = "Admin";

session_start();
if (!isset($_SESSION['isConnected'])) {
    $_SESSION['isConnected'] = false;
};
require_once 'layout/header.php'; ?>

<section class='container text-center'>
    <h1 class="text-light">Gestionnaire</h1>
    <div class="row">
        <div class="dropdown">
            <button class="btn btn-success dropdown-toggle w-50" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Menu
            </button>
            <ul class="dropdown-menu w-50">
                <li><a class="dropdown-item" href="listConcertGroup.php">Concert</a></li>
                <li><a class="dropdown-item" href="listMusicGroup.php">Groupes de musique</a></li>
            </ul>
        </div>
    </div>
</section>

<?php require_once 'layout/footer.php'; ?>
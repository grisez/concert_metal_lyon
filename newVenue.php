<?php

$title = "Modifier salle de concert";

session_start();
if (!isset($_SESSION['isConnected'])) {
    $_SESSION['isConnected'] = false;
};

require_once 'layout/header.php';
require_once 'db/pdo.php'; ?>

<section class="container m-auto">
    <div>
        <a href="admin.php" class="btn btn-outline-success colorSecondButton my-2">Retour au menu</a>
    </div>
    <h2 class="text-light mb-3">Salle de concert</h2>
    <div>
        <h3 class="text-light mb-3">Ajouter une salle</h3>
        <form action="newVenueAction.php" method="POST">
            <div class="form-floating mb-3">
                <input type="text" name="nameVenue" class="form-control w-50" id="floatingInput" placeholder=" ">
                <label for="floatingInput">Nom</label>
            </div>
    </div>
    <button class="btn btn-outline-success colorButton my-2" type="submit">Validation</button>
    </form>
</section>





<?php require_once 'layout/footer.php'; ?>
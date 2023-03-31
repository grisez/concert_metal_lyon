<?php
require_once 'function/redirect.php';

if (empty($_POST) || !isset($_POST['nameVenue'])) {
    redirect('newVenue.php');
}

require_once 'db/pdo.php';
require_once 'classes/VenueCrud.php';

// Je crée un objet
// Instance de classe me permettant de réaliser des opérations de CRUD
//sur les salles de concerts
$crud = new VenueCrud($pdo);

// Je récupère les données de mon formulaire
$nameVenue = $_POST['nameVenue'];


// Je passe les données de mon formulaire à la méthode appropriée
$newVenue = $crud->new($nameVenue);

redirect('admin.php');


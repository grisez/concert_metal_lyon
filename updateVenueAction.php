<?php
require_once 'function/redirect.php';
require_once 'db/pdo.php';
require_once 'classes/VenueCrud.php';


if (empty($_POST) || !isset($_POST['id_venue']) || !isset($_POST['modify_Name_Venue'])){
    redirect('admin.php');
}


// Je crée un objet
// Instance de classe me permettant de réaliser des opérations de CRUD
//sur les salles de concerts
$crud = new VenueCrud($pdo);

// Je récupère les données de mon formulaire
$modifyNameVenue = $_POST['modify_Name_Venue'];
$selectIdVenue = intval($_POST['id_venue']);


// Je passe les données de mon formulaire à la méthode appropriée
$crud->update($modifyNameVenue , $selectIdVenue);

redirect('listVenue.php');

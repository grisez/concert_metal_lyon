<?php
require_once 'function/redirect.php';


if (empty($_POST) || !isset($_POST['selectNameVenue']) || !isset($_POST['modifyNameVenue'])){
    redirect('updateVenue.php');
}

require_once 'db/pdo.php';
require_once 'classes/VenueCrud.php';

// Je crée un objet
// Instance de classe me permettant de réaliser des opérations de CRUD
//sur les salles de concerts
$crud = new VenueCrud($pdo);

// Je récupère les données de mon formulaire
$modifyNameVenue = $_POST['modifyNameVenue'];
$SelectNameVenue = $_POST['selectNameVenue'];


// Je passe les données de mon formulaire à la méthode appropriée
$modifyVenue = $crud->update($modifyNameVenue , $SelectNameVenue);


redirect('admin.php');
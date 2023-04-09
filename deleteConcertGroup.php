<?php
require_once 'db/pdo.php';
require_once 'classes/ConcertGroupCrud.php';

$title = "Suppression concert";

session_start();
if (!isset($_SESSION['isConnected'])) {
    $_SESSION['isConnected'] = false;
};

$id_event = intval($_GET['id_event']);
// $id_style = intval($_GET['id_style']);

$crud = new ConcertGroupCrud($pdo);
$rowEvent = $crud->rowEventGroupById($id_event);

var_dump($rowEvent);


require_once 'layout/header.php';
?>

<section class="container m-auto">
    <div>
        <a href="listMusicGroup.php" class="btn btn-outline-success colorSecondButton my-2">Retour à la liste</a>
    </div>
    <h2 class="text-light mb-3">Modification de la ligne</h2>
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Affiche</th>
                                <th>Nom du concert</th>
                                <th>Date</th>
                                <th>Prix</th>
                                <th>Lieu</th>
                                <th>Groupes de musique</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-light"><?php echo $rowEvent['id_event']; ?></td>
                                <td class="text-light"><?php echo $rowEvent['name_event']; ?></td>
                                <td class="text-light"><?php echo $rowEvent['date_event']; ?></td>
                                <td class="text-light"><?php echo $rowEvent['name_style']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-row mb-3">
        <p class="fs-4 text-danger me-3">Etes vous sur de vouloir supprimer ce groupe ? </p>
        <div>
            <a href="deleteMusicGroupAction.php?id_musicGroup=<?php echo $_GET['id_musicGroup'] ?>" class=" mx-2 btn btn-outline-success colorSecondButton my-2">Oui</a>
        </div>
        <div>
            <a href="listMusicGroup.php" class=" mx-2 btn btn-outline-success colorSecondButton my-2">Non</a>
        </div>
    </div>
</section>


<?php require_once 'layout/footer.php'; ?>
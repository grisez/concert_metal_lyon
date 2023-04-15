<?php
require_once 'db/pdo.php';
require_once 'function/crud.php';
require_once 'classes/ConcertGroupCrud.php';

$title = "Suppression concert";

session_start();
if (!isset($_SESSION['isConnected'])) {
    $_SESSION['isConnected'] = false;
};

$id_event = intval($_GET['id_event']);

$crud = new ConcertGroupCrud($pdo);
$rowEvent = $crud->rowEventGroupById($id_event);

require_once 'layout/header.php';
?>

<section class="container m-auto py-5">
    <div>
        <a href="listConcertGroup.php" class="btn btn-outline-success my-2">Retour à la liste</a>
    </div>
    <h2 class="text-secondary text-center mb-3">Modification de la ligne</h2>
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="table-responsive">
                    <table class="table texte-center">
                        <thead class="text-light thead-dark bg-black bg-opacity-50">
                            <tr>
                                <th>AFFICHE</th>
                                <th>NOM DU CONCERT</th>
                                <th>DATE</th>
                                <th>PRIX</th>
                                <th>LIEU</th>
                                <th class="w-25">GROUPES DE MUSIQUE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-light">
                                    <?php
                                    if ($rowEvent['img_event'] == null) { ?>
                                        <div class="hSizeArrayPicture">
                                            <img class="" src="./assets/img/concert_rock_metal_little.png" alt="affiche par default">
                                        </div>
                                    <?php } else { ?>
                                        <div class="h-50">
                                            <img src="./assets/img/ <?php echo $rowEvent['img_event']; ?>" alt="affiche du concert">
                                        </div>
                                    <?php } ?>
                                </td>
                                <td class="text-light">
                                    <?php
                                    $headlineMusicGroup = getHeadlineGroup($pdo, $id_event);
                                    $countOfMusicGroup = countOfMusicGroup($pdo, $id_event);

                                    if (is_null($rowEvent['name_event']) && $countOfMusicGroup > 1 ) {
                                        echo $headlineMusicGroup['name_musicGroup'] . " + guest";
                                    } elseif (is_null($rowEvent['name_event']) && $countOfMusicGroup === 1) {
                                        echo $headlineMusicGroup['name_musicGroup'];
                                    } else {
                                        echo $rowEvent['name_event'];
                                    }?>
                                </td>
                                <td class="text-light"><?php echo $rowEvent['date_event']; ?></td>
                                <td class="text-light">
                                    <?php
                                    if ($rowEvent['price_event'] == null) {
                                        echo ("/");
                                    } else {
                                        echo $rowEvent['price_event'] . " € ";
                                    }?>
                                </td>
                                <td class="text-light"><?php echo $rowEvent['name_venue']; ?></td>
                                <td class="text-light"><?php echo $rowEvent['musicGroups']; ?></td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-row mb-3">
        <p class="fs-4 text-danger me-3">Etes vous sur de vouloir supprimer ce concert ? </p>
        <div>
            <a href="deleteConcertGroupAction.php?id_event=<?php echo $_GET['id_event'] ?>" class=" mx-2 btn btn-success colorSecondButton my-2">Oui</a>
        </div>
        <div>
            <a href="listConcertGroup.php" class=" mx-2 btn btn-outline-success colorSecondButton my-2">Non</a>
        </div>
    </div>
</section>


<?php require_once 'layout/footer.php'; ?>
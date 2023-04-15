<?php
require_once 'db/pdo.php';
require_once 'function/crud.php';
require_once 'classes/ConcertGroupCrud.php';
require_once 'classes/CrudMessages.php';

$title = "Modification concert";

session_start();
if (!isset($_SESSION['isConnected'])) {
    $_SESSION['isConnected'] = false;
};

$id_event = intval($_GET['id_event']);

$crud = new ConcertGroupCrud($pdo);
$rowEvent = $crud->rowEventGroupById($id_event);

$queryVenue = "SELECT * FROM venue ORDER BY name_venue ASC";
$stmtVenue = $pdo->query($queryVenue);

$queryMusicGroup = "SELECT * FROM musicgroup ORDER BY name_musicGroup ASC";
$stmtMusicGroup = $pdo->query($queryMusicGroup);
$listsMusicGroup = $stmtMusicGroup->fetchAll(PDO::FETCH_ASSOC);

$id_event = $rowEvent["id_event"];
$HeadlineGroup = getHeadlineGroup($pdo, $id_event);
$countOfMusicGroup = countOfMusicGroup($pdo, $id_event);
$musicGroupwithoutHeadlineGroup = getMusicGroupwithoutHeadlineGroup($pdo, $id_event);

require_once 'layout/header.php';
?>
<div class='pt-5'>
    <?php if (array_key_exists('msgCrud', $_GET)) { ?>
        <div class="m-auto shadow-lg bg-black bg-opacity-50 text-danger w-25 rounded-2 p-2 text-center">
            <?php echo CrudMessages::getCrudMessage(intval($_GET['msgCrud'])); ?>
        </div>
    <?php } ?>
</div>

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
                                    if (is_null($rowEvent['name_event']) && $countOfMusicGroup > 1) {
                                        echo $HeadlineGroup['name_musicGroup'] . " + guest";
                                    } elseif (is_null($rowEvent['name_event']) && $countOfMusicGroup === 1) {
                                        echo $HeadlineGroup['name_musicGroup'];
                                    } else {
                                        echo $rowEvent['name_event'];
                                    } ?>
                                </td>
                                <td class="text-light"><?php echo $rowEvent['date_event']; ?></td>
                                <td class="text-light">
                                    <?php
                                    if ($rowEvent['price_event'] == null) {
                                        echo ("/");
                                    } else {
                                        echo $rowEvent['price_event'] . " € ";
                                    } ?>
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
</section>

<section class="container mb-5">
    <form action="updateConcertGroupAction.php" method="POST" class="col-md-6">
        <div class="mb-3 w-50">
            <input type="hidden" name="id_event" value="<?php echo $_GET['id_event'] ?>">
        </div>
        <h3 class="text-secondary fs-3 mb-3">Que voulez vous modifier ? </h3>
        <div class="form-floating mb-3">
            <input type="text" class="form-control w-50" value="<?php echo $rowEvent['name_event']?>" id="floatingInput" name="name_event" placeholder=" ">
            <label for="floatingInput">Nom du concert</label>
            <p class='text-warning text-opacity-50 fs-6'>Facultatif si pas de nom de concert alors la tête d'affiche fera office de nom de concert </p>
        </div>

        <div class="mb-3">
            <label for="formFile" class="form-label fs-5 fw-bold">Importer l'affiche de concert</label>
            <input class="form-control" name="img_event" type="file" id="formFile" value="<?php echo $rowEvent['img_event']?>">
            <p class='text-warning text-opacity-50 fs-6'>Facultatif</p>
        </div>
        <div class="form-group mb-3 d-flex flex-column">
            <label for="start" class="form-label fs-5 fw-bold">Date</label>
            <input type="date" class="form-control" id="start" name="date_event" value="<?php echo $rowEvent['date_event']?>" min="<?php echo date("Y-m-d"); ?>">
        </div>
        <div class="input-group mb-3 d-flex flex-column">
            <label class="form-label fs-5 fw-bold">Prix</label>
            <div class="d-flex flex-row">
                <input type="text" class="form-control" name="price_event" value="<?php echo $rowEvent['price_event']?>" aria-label="Dollar amount (with dot and two decimal places)">
                <span class="input-group-text">€</span>
            </div>
            <p class='text-warning text-opacity-50 fs-6'>Facultatif</p>
        </div>
        <div class="form-group mb-3">
            <label for="disabledSelect" class="form-label fs-5 fw-bold">Choisissez un lieu</label>
            <select id="disabledSelect" name="id_venue"class="form-select">
            <option selected value="<?php echo $rowEvent['id_venue']?>"><?php echo $rowEvent['name_venue']; ?></option>
                <?php while ($rowVenue = $stmtVenue->fetch()) { ?>
                    <option value="<?php echo $rowVenue['id_venue'] ?>"><?php echo $rowVenue['name_venue']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="disabledSelect" class="form-label fs-5 fw-bold">Choisissez le tête d'affiche</label>
            <select id="disabledSelect" name="id_headlining" class="form-select">
            <option selected  value="<?php echo $HeadlineGroup['id_musicGroup']?>"><?php echo $HeadlineGroup['name_musicGroup']?></option>
                <?php foreach ($listsMusicGroup as $listMusicGroup) { ?>
                    <option value="<?php echo $listMusicGroup['id_musicGroup'] ?>"><?php echo $listMusicGroup['name_musicGroup']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="select-multiple" class="form-label fs-5 fw-bold">Selectionnez les groupes de musique</label>
            <select multiple class="form-control" name="id_musicGroup[]" id="multipleSelectIdMusicGroup">
            <?php foreach ($musicGroupwithoutHeadlineGroup as $rowMusicGroupwithoutHeadlineGroup) { ?>
                <option selected value="<?php echo $rowMusicGroupwithoutHeadlineGroup['id_musicGroup']?>"><?php echo $rowMusicGroupwithoutHeadlineGroup['name_musicGroup'] ?></option>
                <?php } ?>
                <?php foreach ($listsMusicGroup as $listMusicGroup) { ?>
                    <option value="<?php echo $listMusicGroup['id_musicGroup'] ?>"><?php echo $listMusicGroup['name_musicGroup']; ?></option>
                <?php } ?>
            </select>
        </div>
        <button class="btn btn-success colorButton my-2" type="submit">Modifier</button>
    </form>
</section>


<?php require_once 'layout/footer.php'; ?>
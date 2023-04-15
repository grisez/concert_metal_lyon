<?php
require_once 'db/pdo.php';
require_once 'classes/ConcertGroupCrud.php';
require_once 'classes/CrudMessages.php';

$title = "Ajouter un Concert";

session_start();
if (!isset($_SESSION['isConnected'])) {
    $_SESSION['isConnected'] = false;
};

$queryVenue = "SELECT * FROM venue ORDER BY name_venue ASC";
$stmtVenue = $pdo->query($queryVenue);

$queryMusicGroup = "SELECT * FROM musicgroup ORDER BY name_musicGroup ASC";
$stmtMusicGroup = $pdo->query($queryMusicGroup);
$listsMusicGroup = $stmtMusicGroup->fetchAll(PDO::FETCH_ASSOC);

require_once 'layout/header.php';
?>

<div class='pt-5'>
    <?php if (array_key_exists('msgCrud', $_GET)) { ?>
        <div class="m-auto shadow-lg bg-black bg-opacity-50 text-danger w-25 rounded-2 p-2 text-center">
            <?php echo CrudMessages::getCrudMessage(intval($_GET['msgCrud'])); ?>
        </div>
    <?php } ?>
</div>

<section class="container mb-5">
        <a href="listConcertGroup.php" class="btn btn-outline-success my-2">Retour liste</a>
        <h2 class="my-3 text-secondary fs-3">Ajouter un concert </h2>
        <form action="newConcertGroupAction.php" method="POST" class="col-md-6">
            <div class="form-floating mb-3">
                <input type="text" class="form-control w-50" id="floatingInput" name="name_event" placeholder=" ">
                <label for="floatingInput" class="form-label">Nom du concert</label>
                <p class='text-warning text-opacity-50 fs-6'>Facultatif si pas de nom de concert alors la tête d'affiche fera office de nom de concert </p>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label fs-5 fw-bold">Importer l'affiche de concert</label>
                <input class="form-control" name="img_event" type="file" id="formFile">
                <p class='text-warning text-opacity-50 fs-6'>Facultatif</p>
            </div>
            <div class="form-group mb-3 d-flex flex-column">
                <label for="start" class="form-label fs-5 fw-bold">Date</label>
                <input type="date" class="form-control" id="start" name="date_event" min="<?php echo date("Y-m-d"); ?>">
            </div>
            <div class="input-group mb-3 d-flex flex-column">
                <label class="form-label fs-5 fw-bold">Prix</label>
                <div class="d-flex flex-row">
                    <input type="text" class="form-control" name="price_event" aria-label="Dollar amount (with dot and two decimal places)">
                    <span class="input-group-text">€</span>
                </div>
                <p class='text-warning text-opacity-50 fs-6'>Facultatif</p>
            </div>
            <div class="form-group mb-3">
                <label for="disabledSelect" class="form-label fs-5 fw-bold">Choisissez un lieu</label>
                <select id="disabledSelect" name="id_venue" class="form-select">
                    <?php while ($rowVenue = $stmtVenue->fetch()) { ?>
                        <option value="<?php echo $rowVenue['id_venue'] ?>"><?php echo $rowVenue['name_venue']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="disabledSelect" class="form-label fs-5 fw-bold">Choisissez le tête d'affiche</label>
                <select id="disabledSelect" name="id_headlining" class="form-select">
                    <?php foreach ($listsMusicGroup as $listMusicGroup) { ?>
                        <option value="<?php echo $listMusicGroup['id_musicGroup'] ?>"><?php echo $listMusicGroup['name_musicGroup']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="select-multiple" class="form-label fs-5 fw-bold">Selectionnez les groupes de musique</label>
                <select multiple class="form-control" name="id_musicGroup[]" id="multipleSelectIdMusicGroup">
                    <?php foreach ($listsMusicGroup as $listMusicGroup) { ?>
                        <option value="<?php echo $listMusicGroup['id_musicGroup'] ?>"><?php echo $listMusicGroup['name_musicGroup']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button class="btn btn-success colorButton my-2" type="submit">Ajouter</button>
        </form>
</section>

<?php require_once 'layout/footer.php'; ?>
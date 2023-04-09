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

<section class="container">
    <div class='container'>
        <?php if (array_key_exists('msgCrud', $_GET)) { ?>
            <div class="bg-dark text-danger w-25 rounded-3 text-center m-auto mb-2">
                <?php echo CrudMessages::getCrudMessage(intval($_GET['msgCrud'])); ?>
            </div>
        <?php } ?>
    </div>
    <div>
        <a href="listConcertGroup.php" class="btn btn-outline-success colorSecondButton my-2">Retour liste</a>
        <h2 class="text-light my-3">Ajouter un concert </h2>
        <form action="newConcertGroupAction.php" method="POST" class="col-md-6">
            <div class="form-floating mb-3">
                <input type="text" class="form-control w-50" id="floatingInput" name="name_event" placeholder=" ">
                <label for="floatingInput" class="form-label">Nom du concert</label>
                <p class='text-warning'>Facultatif si pas de nom de concert alors la tête d'affiche fera office de nom de concert </p>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Importer l'affiche de concert</label>
                <input class="form-control" name="img_event" type="file" id="formFile">
                <p class='text-warning'>Facultatif si pas d'affiche alors nous afficherons une affiche type </p>
            </div>
            <div class="form-group mb-3 d-flex flex-column">
                <label for="start" class="form-label">Date</label>
                <input type="date" class="form-control" id="start" name="date_event" min="2023-04-06">
            </div>
            <div class="input-group mb-3 d-flex flex-column">
                <label class="form-label">Prix</label>
                <div class="d-flex flex-row">
                <input type="text" class="form-control" name="price_event" aria-label="Dollar amount (with dot and two decimal places)">
                <span class="input-group-text">€</span>
                </div>
                <p class='text-warning'>Facultatif</p>
            </div>
            <div class="form-group mb-3">
                <label for="disabledSelect" class="form-label">Choisissez un lieu</label>
                <select id="disabledSelect" name="id_venue" class="form-select">
                    <?php while ($rowVenue = $stmtVenue->fetch()) { ?>
                        <option value="<?php echo $rowVenue['id_venue'] ?>"><?php echo $rowVenue['name_venue']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="disabledSelect" class="form-label">Choisissez le tête d'affiche</label>
                <select id="disabledSelect" name="id_headlining" class="form-select">
                    <?php foreach ($listsMusicGroup as $listMusicGroup) { ?>
                        <option value="<?php echo $listMusicGroup['id_musicGroup'] ?>"><?php echo $listMusicGroup['name_musicGroup']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="select-multiple" class="form-label">Selectionnez les groupes de musique</label>
                <select multiple class="form-control" name="id_musicGroup[]" id="multipleSelectIdMusicGroup">
                    <?php foreach ($listsMusicGroup as $listMusicGroup)  { ?>
                        <option value="<?php echo $listMusicGroup['id_musicGroup'] ?>"><?php echo $listMusicGroup['name_musicGroup']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button class="btn btn-outline-success colorButton my-2" type="submit">Ajouter</button>
        </form>
</section>



<?php require_once 'layout/footer.php'; ?>
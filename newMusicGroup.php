<?php
require_once 'db/pdo.php';
require_once 'classes/MusicGroupCrud.php';
require_once 'classes/CrudMessages.php';

$title = "Ajouter un groupe de musique";

session_start();
if (!isset($_SESSION['isConnected'])) {
    $_SESSION['isConnected'] = false;
};

$queryCountry = "SELECT * FROM country ORDER BY name_country ASC";
$stmtCountry = $pdo->query($queryCountry);

$queryStyle = "SELECT * FROM style ORDER BY name_style ASC";
$stmtStyle = $pdo->query($queryStyle);

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
    <div>
        <a href="listMusicGroup.php" class="btn btn-outline-success my-2">Retour liste</a>
        <h2 class="text-secondary my-3 fs-3">Ajouter un groupe de musique </h2>
        <form action="newMusicGroupAction.php" method="POST" class="col-md-6">
            <div class="form-floating mb-3">
                <input type="text" class="form-control w-50" id="floatingInput" name="name_musicGroup" placeholder=" ">
                <label for="floatingInput">Nom du groupe de musique</label>
            </div>
            <div class="form-group mb-3">
                <label for="disabledSelect" class="form-label fs-5 fw-bold">Choisissez le pays</label>
                <select id="disabledSelect" name="id_country" class="form-select">
                    <?php while ($rowCountry = $stmtCountry->fetch()) { ?>
                        <option value="<?php echo $rowCountry['id_country'] ?>"><?php echo $rowCountry['name_country']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="disabledSelect" class="form-label fs-5 fw-bold">Choisissez le style de musique</label>
                <select id="disabledSelect" name="id_style" class="form-select">
                    <?php while ($rowStyle = $stmtStyle->fetch()) { ?>
                        <option value="<?php echo $rowStyle['id_style'] ?>"><?php echo $rowStyle['name_style']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button class="btn btn-success colorButton my-2" type="submit">Ajouter</button>
        </form>
</section>


<?php require_once 'layout/footer.php'; ?>
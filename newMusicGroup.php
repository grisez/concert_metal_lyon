<?php

$title = "Ajouter un groupe";

session_start();
if (!isset($_SESSION['isConnected'])) {
    $_SESSION['isConnected'] = false;
};

require_once 'layout/header.php';
require_once 'db/pdo.php';

$queryCountry="SELECT * FROM country ORDER BY name_country ASC";
$stmtCountry = $pdo->query($queryCountry);

$queryStyle="SELECT * FROM style ORDER BY name_style ASC";
$stmtStyle = $pdo->query($queryStyle);

?>

<section class="container">
    <div>
        <a href="listMusicGroup.php" class="btn btn-outline-success colorSecondButton my-2">Retour liste</a>
        <h2 class="text-light my-3">Ajouter un groupe de musique </h2>
        <form action="newMusicGroupAction.php" method="POST" class="col-md-6">
            <div class="form-floating mb-3">
                <input type="text" class="form-control w-50" id="floatingInput" name="name_musicGroup" placeholder=" ">
                <label for="floatingInput">Nom du groupe de musique</label>
            </div>
            <div class="form-group mb-3">
                <select id="disabledSelect" name="name_country" class="form-select">
                    <option disabled selected hidden="choisir"> Choisissez le pays </option>
                    <?php while ($rowCountry = $stmtCountry->fetch()){ ?>
                    <option><?php echo $rowCountry['name_country'];?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <select id="disabledSelect" name="name_style" class="form-select">
                    <option disabled selected hidden="choisir"> Choisissez le style </option>
                    <?php while ($rowStyle= $stmtStyle->fetch()){ ?>
                    <option><?php echo $rowStyle['name_style'];?></option>
                    <?php } ?>
                </select>
            </div>
            <button class="btn btn-outline-success colorButton my-2" type="submit">Ajouter</button>
        </form>
</section>


<?php require_once 'layout/footer.php'; ?>


<?php

$title = "Modification salle de concert";

session_start();
if (!isset($_SESSION['isConnected'])) {
    $_SESSION['isConnected'] = false;
};

require_once 'layout/header.php';
require_once 'db/pdo.php';
require_once 'classes/MusicGroupCrud.php';


$id_musicGroup = intval($_GET['id_musicGroup']);
$id_style = intval($_GET['id_style']);

$crud = new MusicGroupCrud($pdo);
$rowMusicGroup = $crud->rowMusicGroupById($id_musicGroup);

var_dump($rowMusicGroup);

$queryCountry="SELECT * FROM country ORDER BY name_country ASC";
$stmtCountry = $pdo->query($queryCountry);

$queryStyle="SELECT * FROM style ORDER BY name_style ASC";
$stmtStyle = $pdo->query($queryStyle);


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
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Pays</th>
                                <th>Style de musique</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-light"><?php echo $rowMusicGroup['img_musicGroup']; ?></td>
                                <td class="text-light"><?php echo $rowMusicGroup['name_musicGroup']; ?></td>
                                <td class="text-light"><?php echo $rowMusicGroup['name_country']; ?></td>
                                <td class="text-light"><?php echo $rowMusicGroup['name_style']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <form action="newMusicGroupAction.php" method="POST" class="col-md-6">
    <div class="mb-3 w-50">
            <input type="hidden" name="id_musicGroup" value="<?php echo $_GET['id_musicGroup'] ?>">
        </div>
    <h3 class="text-light mb-3">Que voulez vous modifier ? </h3>
            <div class="form-floating mb-3">
                <input type="text" class="form-control w-50" id="floatingInput" name="name_musicGroup" placeholder=" ">
                <label for="floatingInput">Nom du groupe de musique</label>
            </div>
            <div class="form-group mb-3">
                <select id="disabledSelect" name="name_country" class="form-select">
                    <option disabled selected hidden="choisir"> Pays </option>
                    <?php while ($rowCountry = $stmtCountry->fetch()){ ?>
                    <option><?php echo $rowCountry['name_country'];?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <select id="disabledSelect" name="name_style" class="form-select">
                    <option disabled selected hidden="choisir">Style </option>
                    <?php while ($rowStyle= $stmtStyle->fetch()){ ?>
                    <option><?php echo $rowStyle['name_style'];?></option>
                    <?php } ?>
                </select>
            </div>
            <button class="btn btn-outline-success colorButton my-2" type="submit">Modifier</button>
        </form>
</section>






<?php require_once 'layout/footer.php'; ?>
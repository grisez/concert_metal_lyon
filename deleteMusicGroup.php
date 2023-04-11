<?php
require_once 'db/pdo.php';
require_once 'classes/MusicGroupCrud.php';

$title = "Suppression groupe de musique";

session_start();
if (!isset($_SESSION['isConnected'])) {
    $_SESSION['isConnected'] = false;
};

$id_musicGroup = intval($_GET['id_musicGroup']);
// $id_style = intval($_GET['id_style']);

$crud = new MusicGroupCrud($pdo);
$rowMusicGroup = $crud->rowMusicGroupById($id_musicGroup);


$queryCountry = "SELECT * FROM country ORDER BY name_country ASC";
$stmtCountry = $pdo->query($queryCountry);

$queryStyle = "SELECT * FROM style ORDER BY name_style ASC";
$stmtStyle = $pdo->query($queryStyle);

require_once 'layout/header.php';
?>

<section class="container m-auto py-5">
    <div>
        <a href="listMusicGroup.php" class="btn btn-outline-success my-2">Retour à la liste</a>
    </div>
    <h2 class="text-secondary text-center mb-3">Modification de la ligne</h2>
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead class="text-light thead-dark bg-black bg-opacity-50">
                            <tr>
                                <th>IMAGE</th>
                                <th>NOM</th>
                                <th>PAYS</th>
                                <th>STYLE DE MUSIQUE</th>
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
    <div class="d-flex flex-row mb-3">
        <p class="fs-5 text-danger me-3">Etes vous sur de vouloir supprimer ce groupe ? </p>
        <div>
            <a href="deleteMusicGroupAction.php?id_musicGroup=<?php echo $_GET['id_musicGroup'] ?>" class=" mx-2 btn btn-success colorSecondButton my-2">Oui</a>
        </div>
        <div>
            <a href="listMusicGroup.php" class=" mx-2 btn btn-outline-success colorSecondButton my-2">Non</a>
        </div>
    </div>
</section>






<?php require_once 'layout/footer.php'; ?>
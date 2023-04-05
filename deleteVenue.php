<?php
require_once 'db/pdo.php';

$title = "Suppression salle de concert";

session_start();
if (!isset($_SESSION['isConnected'])) {
    $_SESSION['isConnected'] = false;
};



var_dump(intval($_GET['id_venue']));

$id_venue = intval($_GET['id_venue']);
// var_dump($id_venue);
$query = "SELECT * FROM venue WHERE id_venue = :id_venue ";
$stmt = $pdo->prepare($query);
$stmt->execute([
    'id_venue' => $id_venue
]);
$row = $stmt->fetch();
// var_dump($row);
require_once 'layout/header.php';
?>
<section class="container m-auto">
    <div>
        <a href="listVenue.php" class="btn btn-outline-success colorSecondButton my-2">Retour à la liste</a>
    </div>
    <h2 class="text-light mb-3">Modification de la ligne</h2>
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-light"><?php echo $row['id_venue']; ?></td>
                                <td class="text-light"><?php echo $row['name_venue']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-row mb-3">
        <p class="fs-4 text-danger me-3">Etes vous sur de vouloir supprimer cette ligne ? </p>
        <div>
            <a href="deleteVenueAction.php?id_venue=<?php echo $_GET['id_venue'] ?>" class=" mx-2 btn btn-outline-success colorSecondButton my-2">Oui</a>
        </div>
        <div>
            <a href="listVenue.php" class=" mx-2 btn btn-outline-success colorSecondButton my-2">Non</a>
        </div>
    </div>

</section>




<?php require_once 'layout/footer.php'; ?>
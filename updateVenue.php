<?php

$title = "Modification salle de concert";

session_start();
if (!isset($_SESSION['isConnected'])) {
    $_SESSION['isConnected'] = false;
};

require_once 'layout/header.php';
require_once 'db/pdo.php';


var_dump(intval($_GET['id_venue']));

$id_venue = intval($_GET['id_venue']);
var_dump($id_venue);
$query = "SELECT * FROM venue WHERE id_venue = :id_venue ";
$stmt = $pdo->prepare($query);
$stmt->execute([
    'id_venue' => $id_venue
]);
$row = $stmt->fetch();
var_dump($row);
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
    <form action="updateVenueAction.php" method="POST">
        <div class="mb-3 w-50">
            <input type="hidden" name="id_venue" value="<?php echo $_GET['id_venue'] ?>">
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="modify_Name_Venue" class="form-control w-50" id="floatingInput" placeholder=" ">
            <label for="floatingInput">Nouveau nom de salle </label>
        </div>
        <button class="btn btn-outline-success colorButton my-2" type="submit">Validation</button>
    </form>

</section>




<?php require_once 'layout/footer.php'; ?>
<?php 

$title="Modification salle de concert";

session_start();
if (!isset($_SESSION['isConnected'])){
    $_SESSION['isConnected']=false;
};

require_once 'layout/header.php'; 
require_once 'db/pdo.php';

$query="SELECT * FROM venue";
$stmt = $pdo->query($query);
?>

<section class="container m-auto">
    <div>
        <a href="admin.php" class="btn btn-outline-success colorSecondButton my-2">Retour au menu</a>
    </div>
    <h2 class="text-light mb-3">Salle de concert</h2>
    <div>
        <h3 class="text-light mb-3">Modifiez le nom d'une salle</h3>
        <form action="updateVenueAction.php" method="POST">
        <div class="mb-3 w-50">
            <select id="disabledSelect" name="selectNameVenue" class="form-select">
                <option disabled selected hidden="choisir"> Selectionner le nom </option>
                <?php while ($row = $stmt->fetch()){ ?>
                <option><?php echo $row['name_venue'];?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="modifyNameVenue" class="form-control w-50" id="floatingInput" placeholder=" ">
            <label for="floatingInput">Nouveau nom</label>
        </div>
            <button class="btn btn-outline-success colorButton my-2" type="submit">Validation</button>
        </form>
    </div>
</section>




<?php require_once 'layout/footer.php'; ?>


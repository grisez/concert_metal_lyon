<?php
require_once 'classes/RegisterMessages.php';

$title = "S'inscrire";

session_start();
if (!isset($_SESSION['isConnected'])) {
    $_SESSION['isConnected'] = false;
}
require_once "layout/header.php"; ?>

<section class='pt-5'>
    <?php if (array_key_exists('msgRegister', $_GET)) { ?>
        <div class="m-auto shadow-lg bg-black bg-opacity-50 text-danger w-25 rounded-2 p-2 text-center">
            <?php echo RegisterMessages::getRegisterMessage(intval($_GET['msgRegister'])); ?>
        </div>
    <?php } ?>
</section>

<section class="container p-5 m-auto">
    <div class="formStyle m-auto w-50 bg-black bg-opacity-50 text-center rounded-2 p-4">
        <h1>S'inscrire</h1>
        <form action="registerAction.php" method="POST">
            <div class="form-floating mb-3">
                <input type="name" name="lastName" class="form-control h-25" id="floatingInput" placeholder="votreAdresseEmail@example.com" required>
                <label for="floatingInput">Nom</label>
            </div>
            <div class="form-floating mb-3">
                <input type="name" name="firstName" class="form-control h-25" id="floatingInput" placeholder="votreAdresseEmail@example.com" required>
                <label for="floatingInput">Prénom</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control h-25" id="floatingInput" placeholder="votreAdresseEmail@example.com" required>
                <label for="floatingInput">Adresse e-mail</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control h-25" id="floatingPassword" placeholder="votreMotDePasse" required>
                <label for="floatingPassword">Mot de passe</label>
            </div>
            <button class="btn btn-success colorButton my-2" type="submit">Valider</button>
            <a href="login.php" class="btn btn-outline-success colorButton my-2" tabindex="-1" role="button" aria-disabled="true">Se connecter</a>
        </form>
    </div>
</section>


<?php require_once 'layout/footer.php'; ?>
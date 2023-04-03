<?php 
$title="S'inscrire";

session_start();
if (!isset($_SESSION['isConnected'])){
    $_SESSION['isConnected']=false;
}
require_once 'classes/RegisterMessages.php';
require_once "layout/header.php"; ?>

<section class='container'>
    <?php if (array_key_exists('msgRegister', $_GET)) { ?>
    <div class="bg-dark text-danger w-25 rounded-3 text-center m-auto mb-2">
        <?php echo RegisterMessages::getRegisterMessage(intval($_GET['msgRegister'])); ?>
    </div>
    <?php } ?> 
</section>

<section class="container">
<div class="formStyle">
    <div>
        <h1>S'inscrire</h1>
        <form action="registerAction.php" method="POST" >
            <input type="name" name="lastName" placeholder="Nom" />
            <input type="name" name="firstName" placeholder="Prénom" />
            <input type="email" name="email" placeholder="E-mail" />
            <input type="password" name="password" placeholder="Mot de passe" />
            <button class="btn btn-outline-success colorButton my-2" type="submit">Valider</button>
            <a class="visualLink" href="login.php">Se connecter</a>
        </form>
    </div>  
</div>
</section>


<?php require_once 'layout/footer.php'; ?>
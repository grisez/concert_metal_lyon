
<?php 
$title="Connexion";

session_start();
if (!isset($_SESSION['isConnected'])){
    $_SESSION['isConnected']=false;
}
require_once 'classes/ConnexionMessages.php';
require_once "layout/header.php"; ?>

<section class='container'>
        <?php if (array_key_exists('msgLogin', $_GET)) { ?>
        <div class="bg-dark text-danger w-25 rounded-3 text-center m-auto mb-2">
            <?php echo ConnexionMessages::getConnexionMessage(intval($_GET['msgLogin'])); ?>
        </div>
        <?php } ?> 
    </section>
    
<section class="container">
<div class="formStyle">
    <div>
        <h1>Se connecter</h1>
        <form action="loginAction.php" method="POST" >
            <input type="email" name="email" placeholder="E-mail" required />
            <input type="password" name="password" placeholder="Mot de passe" />
            <button class="btn btn-outline-success colorButton my-2" type="submit">Connexion</button>
            <a class="visualLink" href="register.php">S'inscrire</a>
        </form>
    </div>  
</div>
</section>




<?php require_once 'layout/footer.php'; ?>
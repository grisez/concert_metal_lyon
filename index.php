<?php 
$title="Accueil";
require_once 'classes/ConnexionMessage.php';

session_start();
if (!isset($_SESSION['isConnected'])){
    $_SESSION['isConnected']=false;
};

require_once 'layout/header.php';?>

    <section class='container'>
        <?php if (array_key_exists('msg', $_GET)) { ?>
        <div class="bg-dark text-success-emphasis w-25 rounded-3 text-center m-auto mb-2">
            <?php echo ConnexionMessages::getConnexionMessage(intval($_GET['msg'])); ?>
        </div>
        <?php } ?> 

        <h1> Concert de metal Lyon !</h1>
    </section>

<?php  require_once 'layout/footer.php'; ?>


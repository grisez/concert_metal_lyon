<?php
$title = "Accueil";
require_once 'classes/ConnexionMessages.php';
require_once 'classes/RegisterMessages.php';

session_start();
if (!isset($_SESSION['isConnected'])) {
    $_SESSION['isConnected'] = false;
};

require_once 'layout/header.php' ?>


<section class='container '>
    <?php if (array_key_exists('msgLogin', $_GET)) { ?>
        <div class="shadow-lg bg-black bg-opacity-75 text-success w-25 rounded-2 p-2 text-center positionAbsolute translate-middle z-3">
            <?php echo ConnexionMessages::getConnexionMessage(intval($_GET['msgLogin'])); ?>
        </div>
    <?php } ?>
    <?php if (array_key_exists('msgRegister', $_GET)) { ?>
        <div class="shadow-lg bg-black bg-opacity-75 text-success w-25 rounded-2 p-2 text-center positionAbsolute  translate-middle z-3">
            <?php echo RegisterMessages::getRegisterMessage(intval($_GET['msgRegister'])); ?>
        </div>
    <?php } ?>
    <div class="shadow-lg">
        <h1 class="position-absolute top-50 start-50 translate-middle z-3 text-success bg-black bg-opacity-75 text-center rounded-2 p-3"> Concerts de metal sur Lyon !</h1>
    </div>
</section>
<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner hSize">
        <div class="carousel-item active" data-bs-interval="10000">
            <img src="assets/img/slide1.jpg" class="d-block w-100  img-fluid" alt="concert 1">
        </div>
        <div class="carousel-item hSize" data-bs-interval="2000">
            <img src="assets/img/slide2.jpg" class="d-block w-100  img-fluid" alt="concert 2">
        </div>
        <div class="carousel-item hSize">
            <img src="assets/img/slide3.jpg" class="d-block w-100 img-fluid" alt="concert 3">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>






<?php require_once 'layout/footer.php'; ?>
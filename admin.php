<?php 
$title="Admin";

session_start();
if (!isset($_SESSION['isConnected'])){
    $_SESSION['isConnected']=false;
};
require_once 'layout/header.php'; ?>

<section class='container'>
    <h1>Gestion</h1>
    <h2>Menu </h2>
    <div class="row">
        <div>
            <a class=" visualLink link-offset-2 link-underline link-underline-opacity-0" href="listVenue.php">
                Salles de concert
            </a>
        </div>
        <div>
            <a class=" visualLink link-offset-2 link-underline link-underline-opacity-0" href="listMusicGroup.php">
                Groupes de musique 
            </a>
        </div>

    </div>



</section>

<?php require_once 'layout/footer.php'; ?>
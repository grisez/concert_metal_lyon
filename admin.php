<?php 
$title="Admin";

session_start();
if (!isset($_SESSION['isConnected'])){
    $_SESSION['isConnected']=false;
};
require_once 'layout/header.php'; ?>

<section class='container'>
    <h1>Gestion crud</h1>
    <h2>Menu </h2>

    <a class=" visualLink link-offset-2 link-underline link-underline-opacity-0" href="listVenue.php">Salle de concert</a>
</section>

<?php require_once 'layout/footer.php'; ?>
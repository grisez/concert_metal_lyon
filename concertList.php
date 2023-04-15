<?php
require_once 'db/pdo.php';
require_once 'function/crud.php';
require_once 'classes/ConcertGroupCrud.php';
require_once 'classes/MusicGroupCrud.php';

$title = "Concerts";

session_start();
if (!isset($_SESSION['isConnected'])) {
    $_SESSION['isConnected'] = false;
};


$crud = new ConcertGroupCrud($pdo);
$listConcertGroups = $crud->list();

$crud = new MusicGroupCrud($pdo);
$listMusicGroups = $crud->list();


require_once 'layout/header.php'; ?>


<section class="container py-5">
    <h1 class="fs-4 fw-bold shadow-lg bg-black bg-opacity-50 text-success w-50 rounded-2 p-2 text-center mb-5">Liste de concerts prévu : </h1>
    <?php foreach ($listConcertGroups as $listConcertGroup) { ?>
        <div class="row row-cols row-cols-lg-3 row-cols-1 mb-5 m-auto shadow-lg bg-black bg-opacity-50 rounded-2 py-3">
            <?php if ($listConcertGroup['img_event'] == null) { ?>
                <div class="hSizeArrayPictureConcertList d-flex justify-content-center px-5 col my-auto">
                    <img class="" src="./assets/img/concert_rock_metal middle.png" alt="affiche par default">
                </div>
            <?php } else { ?>
                <div class="hSizeArrayPictureConcertList d-flex justify-content-center px-5 col my-auto">
                    <img src="./assets/img/ <?php echo $listConcertGroup['img_event']; ?>" alt="affiche du concert">
                </div>
            <?php } ?>
            <div class="col text-center">
                <p class="text-success fw-bold">
                    <?php
                    $id_event = $listConcertGroup['id_event'];
                    $headlineMusicGroup = getHeadlineGroup($pdo, $id_event);
                    $countOfMusicGroup = countOfMusicGroup($pdo, $id_event);
                    if (is_null($listConcertGroup['name_event']) && ($countOfMusicGroup == 1)) {
                        echo $headlineMusicGroup['name_musicGroup'];
                    } else if (is_null($listConcertGroup['name_event']) && ($countOfMusicGroup > 1)) {
                        echo $headlineMusicGroup['name_musicGroup'] . " + guest";
                    } else {
                        echo $listConcertGroup['name_event'];
                    }
                    ?>
                </p>
                <div class="d-flex justify-content-center gap-3 text-light fw-4">
                    <p>
                        <?php echo $listConcertGroup['NewDate_event'] ?>
                    </p>
                    <p class="fst-italic">
                        <?php echo $listConcertGroup['name_venue'] ?>
                    </p>
                </div>
                <div class="text-light fw-4">
                    <span>Groupes :</span>
                    <?php
                    $listMusicGroupAndStyleAccordingToIdEvent = listMusicGroupAndStyleAccordingToIdEvent($pdo, $id_event);
                    foreach ($listMusicGroupAndStyleAccordingToIdEvent as $rowMusicGroupAndStyleAccordingToIdEvent) {
                        // $id_event = $listConcertGroup['id_event'];
                    ?>
                        <div class="d-flex justify-content-center gap-3">
                            <p class="text-success m-0"><?php echo $rowMusicGroupAndStyleAccordingToIdEvent['name_musicGroup'] . " : " ?></p>
                            <p class="m-0"><?php echo $rowMusicGroupAndStyleAccordingToIdEvent['name_style']; ?></p>
                        </div>
                    <?php } ?>
                    <span>Prix :</span>
                    <span>
                        <?php if ($listConcertGroup['price_event'] == null) {
                            echo ("/");
                        } else {
                            echo $listConcertGroup['price_event'] . " € ";
                        } ?>
                    </span>
                </div>
            </div>
            <div class="col d-flex justify-content-center gap-3 m-auto">
                <a href="updateConcertGroup.php?id_event=<?php echo $listConcertGroup['id_event'] ?> " class="btn btn-success btn-sm">
                    <i class="bi bi-pencil-square"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                        <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                    </svg>
                    <span> J'y vais !</span>
                </a>
                <a href="deleteConcertGroup.php?id_event=<?php echo $listConcertGroup['id_event'] ?> " class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-calendar-heart" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5ZM1 14V4h14v10a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1Zm7-6.507c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z" />
                    </svg>
                    <span> Peut être...</span>
                </a>
            </div>
        </div>
    <?php } ?>
</section>

<?php require_once 'layout/footer.php'; ?>
<?php
require_once 'db/pdo.php';
require_once 'classes/MusicGroupCrud.php';
require_once 'classes/CrudMessages.php';

$title="Groupe de musique";

session_start();
if (!isset($_SESSION['isConnected'])){
  $_SESSION['isConnected']=false;
};

$crud = new MusicGroupCrud($pdo);
$listMusicGroups = $crud->list();
// var_dump($listMusicGroups);

require_once 'layout/header.php';
?>

  <div class='pt-5'>
        <?php if (array_key_exists('msgCrud', $_GET)) { ?>
        <div class="m-auto shadow-lg bg-black bg-opacity-50 text-success w-25 rounded-2 p-2 text-center">
            <?php echo CrudMessages::getCrudMessage(intval($_GET['msgCrud'])); ?>
        </div>
        <?php } ?> 
  </div>

<div class="container-fluid py-5">
  <div class="row justify-content-between mb-3">
    <div class="col-md-2 ms-3">
    <a href="admin.php" class="btn btn-outline-success my-2">Retour au menu</a>
    </div>
    <div class="col-md-2 me-3">
      <a href="newMusicGroup.php" class="btn btn-success my-2">Ajouter un groupe</a>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <h2 class="text-center mb-4 text-secondary">Groupes de musique</h2>
      <div class="table-responsive">
        <table class="table text-center">
          <thead class="text-light thead-dark bg-black bg-opacity-50 ">
            <tr>
              <th>IMAGE</th>
              <th>NOM</th>
              <th>PAYS</th>
              <th>STYLE DE MUSIQUE</th>
              <th class="sizeColumnAction">ACTION</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($listMusicGroups as $listMusicGroup) { ?>
              <tr>
                <td class="text-light"><?php echo $listMusicGroup['img_musicGroup']; ?></td>
                <td class="text-light"><?php echo $listMusicGroup['name_musicGroup']; ?></td>
                <td class="text-light"><?php echo $listMusicGroup['name_country']; ?></td>
                <td class="text-light"><?php echo $listMusicGroup['name_style']; ?></td>
                <td>
                  <a href="updateMusicGroup.php?id_musicGroup=<?php echo $listMusicGroup['id_musicGroup']?> " class="btn btn-success btn-sm">
                    <i class="bi bi-pencil-square"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                      <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                    </svg>
                  </a>
                  <a href="deleteMusicGroup.php?id_musicGroup=<?php echo $listMusicGroup['id_musicGroup']?>&id_style=<?php echo $listMusicGroup['id_style']?>  " class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                      <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                    </svg>
                  </a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<?php require_once 'layout/footer.php'; ?>
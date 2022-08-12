<!-- header -->
<?php
// demarrer session
session_start();
$title = "Accueil"; // title for current page
include("partials/_header.php"); // include header
include("helpers/functions.php"); // include function
// inclure PDO pour la connexion a la BDD dans mon script
require_once("helpers/pdo.php");
// query for all games
require_once("sql/select_all.php")
?>
<!-- main-content -->
<div class="py-16 wrap__content">
  <!-- head content -->
  <div class="wrap__content-head text-center">
    <div class="">
      <h1 class="text-blue-500 text-5xl uppercase font-black"><a href="index.php">App game</a></h1>
      <p>L'app qui repertorie vos jeux</p>
      <!-- button for add game -->
      <div class="pt-4">
        <a href="addGame.php" class="btn btn-success text-gray-100">Nouveau jeux</a>
      </div>
      <div class="mt-4">
        <?php include("partials/_search-bar.php") ?>
      </div>
    </div>
    <?php
    // je verifie que session error ou succes est vide ou pas
    if ($_SESSION["error"]) {
      include("partials/_alert-error.php");
    } elseif ($_SESSION["success"]) {
      include("partials/_alert-success.php");
    }
    // je vide ma variable $_SESSION["error"] pour qu'il n'affiche pas de message en creant un array vide
    $_SESSION["error"] = [];
    $_SESSION["success"] = [];
    ?>
  </div>
  <!-- search section -->
  <div class="max-w-lg mx-auto mt-8 ">
    <?php include("partials/_section-search.php") ?>
  </div>
  <!-- table -->
  <div class="overflow-x-auto mt-16">
    <table class="table w-full">
      <!-- head -->
      <?php include("partials/table/_table-head.php") ?>
      <tbody>
        <?php
        if (count($games) == 0) {
          echo "<tr><td class=text-center>Aucun jeux disponible actuellement</td></tr>";
        } else { ?>
          <?php foreach ($games as $game) : ?>
            <tr>
              <th><?= key($games) ?></th>
              <td><?= $game['name'] ?></td>
              <td><?= $game['genre'] ?></td>
              <td><?= $game['plateforms'] ?></td>
              <td><?= $game['price'] ?></td>
              <td><?= $game['PEGI'] ?></td>
              <td>
                <a href="show.php?id=<?= $game['id'] ?>&name=<?= $game['name'] ?>">
                  <img src="img/loupe.png" alt="loupe" class="w-4">
                </a>
              </td>
              <td>
                <?php include("partials/_modal-delete.php") ?>
              </td>
            </tr>
          <?php endforeach ?>
        <?php } ?>
      </tbody>
    </table>
  </div>

</div>
<!-- end main-content -->

<!-- footer -->
<?php
include("partials/_footer.php") // include footer
?>
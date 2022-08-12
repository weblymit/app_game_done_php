<!-- header -->
<?php
// start session
session_start();
$title = "Afficher jeux"; // title for current page
include("partials/_header.php"); // include header
include("helpers/functions.php"); // include function
// inclure PDO pour la connexion a la BDD dans mon script
require_once("helpers/pdo.php");
//////////////////////////////////
// Traitetement du formulaire
///////////////////////////////////
// création array error
$error = [];
$errorMessage = "<span class='text-red-500'>*Ce champs est obligatoire</span>";
// variable success
$success = false;

//1- recupère jeux avec le bon ID
// on  verifie que id existe ( pas vide) et qu'il est numérique
if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
  // 2- je nettoie mon id contre xss
  $id = clear_xss($_GET['id']);
  // 3- faire la query vers BDD
  $sql = "SELECT * FROM jeux WHERE id= :id";
  // 4- Préparation de la query
  $query = $pdo->prepare($sql);
  // 5- Securise la query contre injection sql
  $query->bindValue(':id', $id, PDO::PARAM_INT);
  // 6 Execute la requette vers la BDD
  $query->execute();
  // 7- On stock tous dans une variable
  $game = $query->fetch();
  // debug_array($game);
  if (!$game) {
    $_SESSION["error"] = "Le jeu n'est pas disponible !";
    header("Location: index.php");
  }
} else {
  $_SESSION["error"] = "URL invalide!";
  header("Location: index.php");
}


// 2- je verifie que le btn submit fonctionne en affichant un message echo "Hourra"
if (!empty($_POST["submited"])) {
  // 2 faille xss
  include_once("validate-form/_clear_input.php");
  // 3- validation de chaque input
  ////////////////////////////////
  // name
  include_once("validate-form/_name.php");
  //prix
  include_once("validate-form/_price.php");
  //note
  include_once("validate-form/_note.php");
  // description
  include_once("validate-form/_description.php");
  //genre
  include_once("validate-form/_genre.php");
  //plateforms
  include_once("validate-form/_plateforms.php");
  // select pegi
  if (empty($pegi)) {
    $error["pegi"] = $errorMessage;
  }

  debug_array(count($error));
  //4- if no error
  if (count($error) == 0) {
    $success = true;
    // inscription en BDD
    include_once("sql/update_query.php");
  }
}

?>
<section class="py-12">
  <a href="index.php" class="text-blue-500 font-light text-xs ">
    Retour </a>
  <h1 class="text-blue-500 text-5xl uppercase font-black pt-6 text-center pb-10">Modifier <?= $game["name"] ?></h1>
  <form action="" method="POST">
    <!-- input for name -->
    <div class="mb-3">
      <label for="name" class="font-semibold text-blue-900">Nom</label>
      <input type="text" name="name" class="input input-bordered w-full max-w-xs block" value="<?= $game["name"] ?>" />
      <p>
        <?php
        if (!empty($error["nom"])) {
          echo $error["nom"];
        }
        ?>
      </p>
    </div>
    <!-- input for price -->
    <div class="mb-3">
      <label for="price" class="font-semibold text-blue-900">Prix</label>
      <input type="number" step="0.01" name="price" class="input input-bordered w-full max-w-xs block" value="<?= $game["price"] ?>" />
      <p>
        <?php
        if (!empty($error["prix"])) {
          echo $error["prix"];
        }
        ?>
      </p>
    </div>
    <!-- input for genre -->
    <?php
    include_once("input/_input_update_genre.php");
    ?>
    <!-- input for note -->
    <div class="mb-3">
      <label for="note" class="font-semibold text-blue-900">Note</label>
      <input type="number" step="0.1" name="note" class="input input-bordered w-full max-w-xs block" value="<?= $game["note"] ?>" />
      <p>
        <?php
        if (!empty($error["note"])) {
          echo $error["note"];
        }
        ?>
      </p>
    </div>
    <!-- input for plateforms -->
    <?php
    include_once("input/_input_update_plateforms.php");
    ?>
    <!-- input description -->
    <div class="mt-5">
      <label for="description" class="font-semibold text-blue-900">Description</label>
      <textarea name="description" class="textarea textarea-bordered block" placeholder="Description du jeu"><?= $game["description"] ?></textarea>
      <p>
        <?php
        if (!empty($error["description"])) {
          echo $error["description"];
        }
        ?>
      </p>
    </div>
    <!-- select for PEGI -->
    <?php
    include_once("input/_input_update_pegi.php");
    ?>
    <!-- id input -->
    <input type="hidden" name="id" value="<?= $game['id'] ?>">
    <!-- submit btn -->
    <div class="mt-4">
      <input type="submit" name="submited" value="Modifier" class="btn bg-blue-500">
    </div>
  </form>
</section>

<!-- footer -->
<?php
include("partials/_footer.php") // include footer
?>
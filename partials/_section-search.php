<?php
if (!empty($rows)) {
  if ($rows > 0) { ?>
    <p class="font-black text-2xl pb-2 text-orange-600"><?= $rows > 1 ? "$rows jeux trouvés" : "$rows jeu trouvé" ?></p>
    <section class="bg-orange-50 p-6 mt-10z">
      <ul>
        <?php foreach ($results as $result) : ?>
          <li class="pb-2 hover:underline italic">
            <a href="show.php?id=<?= $result['id'] ?>&name=<?= $result['name'] ?>">
              <?= $result["name"] ?>
            </a>
          </li>
        <?php endforeach ?>
      </ul>
    </section>
  <?php } elseif ($rows == 0) { ?>
    <p class="text-2xl">hello</p>
    <!-- <p class="font-black text-2xl pb-2 text-orange-600"><?= $rows ?> jeu trouvé</p> -->
<?php }
}
?>
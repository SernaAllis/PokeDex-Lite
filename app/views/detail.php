<?php require 'layout/header.php'; ?>

<section class="detail">
  <h2><?= ucfirst($pokemon['name']) ?> (#<?= $pokemon['id'] ?>)</h2>

  <img src="<?= $pokemon['sprite'] ?>" alt="<?= $pokemon['name'] ?>">

  <h3>Tipos</h3>
  <ul>
    <?php foreach ($pokemon['types'] as $type): ?>
      <li><?= $type ?></li>
    <?php endforeach; ?>
  </ul>

  <h3>Estadísticas</h3>
  <ul>
    <?php foreach ($pokemon['stats'] as $stat): ?>
      <li><?= $stat['name'] ?>: <?= $stat['value'] ?></li>
    <?php endforeach; ?>
  </ul>

  <h3>Habilidades</h3>
  <ul>
    <?php foreach ($pokemon['abilities'] as $ability): ?>
      <li><?= $ability ?></li>
    <?php endforeach; ?>
  </ul>

  <a href="?page=favorites&action=add&id=<?= $pokemon['id'] ?>&name=<?= $pokemon['name'] ?>&sprite=<?= urlencode($pokemon['sprite']) ?>" class="btn-favorite">❤️ Agregar a Favoritos</a>
</section>

<?php require 'layout/footer.php'; ?>

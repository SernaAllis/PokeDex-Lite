<?php require 'layout/header.php'; ?>

<h2>❤️ Favoritos</h2>

<?php if (empty($favorites)): ?>
  <p>No tienes Pokémon favoritos aún.</p>
<?php endif; ?>

<section class="grid">
  <?php foreach ($favorites as $pokemon): ?>
    <div class="card">
      <h3><?= ucfirst($pokemon['name']) ?></h3>

      <img src="<?= $pokemon['sprite'] ?>" alt="<?= $pokemon['name'] ?>">

      <div class="actions">
        <a href="?page=detail&name=<?= $pokemon['name'] ?>">Ver</a>

        <a href="?page=favorites&action=remove&id=<?= $pokemon['id'] ?>">
          ❌ Quitar
        </a>
      </div>
    </div>
  <?php endforeach; ?>
</section>

<?php require 'layout/footer.php'; ?>

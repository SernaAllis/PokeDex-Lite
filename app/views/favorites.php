<?php require 'layout/header.php'; ?>

<div class="container">
  <div class="favorites-header">
    <div class="header-content">
      <h1 class="page-title">❤️ Mis Pokémon Favoritos</h1>
      <p class="page-subtitle">
        <?php if (count($favorites) > 0): ?>
          Tienes <strong><?= count($favorites) ?></strong> Pokémon <?= count($favorites) === 1 ? 'favorito' : 'favoritos' ?>
        <?php else: ?>
          Aún no has agregado ningún Pokémon favorito
        <?php endif; ?>
      </p>
    </div>
    <a href="?" class="btn btn-primary">🏠 Volver al inicio</a>
  </div>

  <?php if (empty($favorites)): ?>
    <div class="empty-state">
      <div class="empty-icon">💔</div>
      <h3>No tienes Pokémon favoritos</h3>
      <p>Explora el Pokédex y agrega tus Pokémon favoritos para verlos aquí</p>
      <a href="?" class="btn btn-primary">Explorar Pokédex</a>
    </div>
  <?php else: ?>
    <section class="pokemon-grid">
      <?php foreach ($favorites as $pokemon): ?>
        <div class="pokemon-card favorite-card">
          <div class="favorite-badge">⭐</div>
          
          <div class="pokemon-image">
            <img src="<?= $pokemon['sprite'] ?>" alt="<?= $pokemon['name'] ?>" loading="lazy">
            <span class="pokemon-id">#<?= str_pad($pokemon['id'], 3, '0', STR_PAD_LEFT) ?></span>
          </div>

          <h3 class="pokemon-name"><?= ucfirst($pokemon['name']) ?></h3>

          <div class="pokemon-actions">
            <a href="?page=detail&name=<?= $pokemon['name'] ?>" class="btn-action btn-detail">
              <span>👁️</span> Ver detalle
            </a>

            <a href="?page=favorites&action=remove&id=<?= $pokemon['id'] ?>" class="btn-action btn-remove">
              <span>🗑️</span> Quitar
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </section>
  <?php endif; ?>
</div>

<?php require 'layout/footer.php'; ?>

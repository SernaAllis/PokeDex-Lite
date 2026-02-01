<?php require 'layout/header.php'; ?>

<div class="container">
  <div class="detail-header">
    <a href="javascript:history.back()" class="btn btn-secondary">← Volver</a>
    <a href="?page=favorites&action=add&id=<?= $pokemon['id'] ?>&name=<?= $pokemon['name'] ?>&sprite=<?= urlencode($pokemon['sprite']) ?>" class="btn btn-favorite-add">
      ❤️ Agregar a Favoritos
    </a>
  </div>

  <section class="detail-container">
    <div class="detail-main">
      <div class="detail-card">
        <div class="detail-image-section">
          <div class="pokemon-id-badge">#<?= str_pad($pokemon['id'], 3, '0', STR_PAD_LEFT) ?></div>
          <img src="<?= $pokemon['sprite'] ?>" alt="<?= $pokemon['name'] ?>" class="detail-sprite">
          <h1 class="detail-name"><?= ucfirst($pokemon['name']) ?></h1>
          
          <div class="detail-types">
            <?php foreach ($pokemon['types'] as $type): ?>
              <span class="type <?= $type ?>"><?= ucfirst($type) ?></span>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <div class="detail-info">
        <div class="info-section">
          <h3 class="section-title">📊 Estadísticas Base</h3>
          <div class="stats-grid">
            <?php foreach ($pokemon['stats'] as $stat): ?>
              <?php 
                $statName = strtoupper(str_replace('-', ' ', $stat['name']));
                $percentage = min(100, ($stat['value'] / 255) * 100);
                $statClass = '';
                if ($stat['value'] >= 100) $statClass = 'stat-high';
                elseif ($stat['value'] >= 60) $statClass = 'stat-medium';
                else $statClass = 'stat-low';
              ?>
              <div class="stat-row">
                <div class="stat-label"><?= $statName ?></div>
                <div class="stat-value <?= $statClass ?>"><?= $stat['value'] ?></div>
                <div class="stat-bar-container">
                  <div class="stat-bar-fill <?= $statClass ?>" style="width: <?= $percentage ?>%"></div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="info-section">
          <h3 class="section-title">⚡ Habilidades</h3>
          <div class="abilities-list">
            <?php foreach ($pokemon['abilities'] as $ability): ?>
              <span class="ability-badge"><?= ucfirst(str_replace('-', ' ', $ability)) ?></span>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php require 'layout/footer.php'; ?>

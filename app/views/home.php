<?php require 'layout/header.php'; ?>

<div class="container">
  <section class="controls-bar">
    <div class="search-group">
      <form method="GET" class="search-form">
        <input type="text" name="name" placeholder="🔍 Buscar por nombre o ID" class="search-input">
        <button type="submit" class="btn btn-primary">Buscar</button>
      </form>
    </div>

    <div class="filter-group">
      <select onchange="location.href='?type=' + this.value" class="select-filter">
        <option value="">🏷️ Todos los tipos</option>
        <option value="fire">🔥 Fire</option>
        <option value="water">💧 Water</option>
        <option value="grass">🌿 Grass</option>
        <option value="electric">⚡ Electric</option>
        <option value="poison">☠️ Poison</option>
        <option value="flying">🦅 Flying</option>
        <option value="bug">🐛 Bug</option>
        <option value="normal">⚪ Normal</option>
      </select>
      
      <button id="compareBtn" onclick="startCompare()" class="btn btn-compare">🆚 Comparar</button>
    </div>
  </section>

  <div id="compareMode" class="compare-mode" style="display:none;">
    <div class="compare-content">
      <span class="compare-text">Selecciona 2 Pokémon para comparar</span>
      <span id="selectedCount" class="selected-count">0/2</span>
    </div>
    <div class="compare-actions">
      <button onclick="cancelCompare()" class="btn btn-secondary">Cancelar</button>
      <button id="compareSubmit" onclick="submitCompare()" disabled class="btn btn-success">Comparar Ahora</button>
    </div>
  </div>

  <section class="pokemon-grid">
    <?php foreach ($results as $pokemon): ?>
      <?php
        // Extraer ID desde la URL de la API
        preg_match('/\/pokemon\/(\d+)\//', $pokemon['url'], $matches);
        $id = $matches[1] ?? null;
        $sprite = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/$id.png";
      ?>

      <div class="pokemon-card" data-pokemon-id="<?= $id ?>" data-pokemon-name="<?= $pokemon['name'] ?>">
        <div class="compare-checkbox">
          <input type="checkbox" class="pokemon-checkbox" value="<?= $id ?>" onchange="handleCheckbox(this)">
        </div>
        
        <div class="pokemon-image">
          <img src="<?= $sprite ?>" alt="<?= $pokemon['name'] ?>" loading="lazy">
          <span class="pokemon-id">#<?= str_pad($id, 3, '0', STR_PAD_LEFT) ?></span>
        </div>

        <h3 class="pokemon-name"><?= ucfirst($pokemon['name']) ?></h3>

        <div class="pokemon-actions">
          <a href="?page=detail&name=<?= $pokemon['name'] ?>" class="btn-action btn-detail">
            <span>👁️</span> Ver detalle
          </a>

          <?php if ($id): ?>
            <a href="?page=favorites&action=add&id=<?= $id ?>&name=<?= $pokemon['name'] ?>&sprite=<?= $sprite ?>" class="btn-action btn-favorite">
              <span>❤️</span> Favorito
            </a>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </section>
</div>

<div class="container">
  <nav class="pagination-wrapper">
    <div class="pagination-info">
      <span class="info-text">Mostrando <strong><?= $offset + 1 ?></strong> - <strong><?= $offset + count($results) ?></strong></span>
      <span class="page-indicator">Página <strong><?= $page ?></strong> • <span class="limit-text"><?= $limit ?> por página</span></span>
    </div>
    
    <div class="pagination-controls">
      <?php if ($page > 1): ?>
        <a href="?p=<?= $page - 1 ?>" class="btn-pagination btn-prev">
          <span>←</span> Anterior
        </a>
      <?php else: ?>
        <span class="btn-pagination btn-disabled">
          <span>←</span> Anterior
        </span>
      <?php endif; ?>

      <span class="page-number">Página <?= $page ?></span>

      <a href="?p=<?= $page + 1 ?>" class="btn-pagination btn-next">
        Siguiente <span>→</span>
      </a>
    </div>
  </nav>
</div>

<?php require 'layout/footer.php'; ?>

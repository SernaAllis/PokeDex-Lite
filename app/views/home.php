<?php require 'layout/header.php'; ?>

<section class="controls">
  <form method="GET">
    <input type="text" name="name" placeholder="Buscar por nombre o ID">
    <button>Buscar</button>
  </form>

  <select onchange="location.href='?type=' + this.value">
    <option value="">Filtrar por tipo</option>
    <option value="fire">Fire</option>
    <option value="water">Water</option>
    <option value="grass">Grass</option>
    <option value="electric">Electric</option>
  </select>
</section>

<section class="grid">
  <?php foreach ($results as $pokemon): ?>
    <?php
      // Extraer ID desde la URL de la API
      preg_match('/\/pokemon\/(\d+)\//', $pokemon['url'], $matches);
      $id = $matches[1] ?? null;
    ?>

    <div class="card">
      <h3><?= ucfirst($pokemon['name']) ?></h3>

      <a href="?page=detail&name=<?= $pokemon['name'] ?>">Ver detalle</a>

      <?php if ($id): ?>
        <a href="?page=favorites&action=add&id=<?= $id ?>&name=<?= $pokemon['name'] ?>&sprite=https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/<?= $id ?>.png">
          ❤️ Agregar a favoritos
        </a>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
</section>

<nav class="pagination">
  <?php if ($page > 1): ?>
    <a href="?p=<?= $page - 1 ?>">← Anterior</a>
  <?php endif; ?>

  <a href="?p=<?= $page + 1 ?>">Siguiente →</a>
</nav>

<?php require 'layout/footer.php'; ?>

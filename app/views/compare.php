<?php require 'layout/header.php'; ?>

<?php if ($error): ?>
  <div class="error"><?= $error ?></div>
  <a href="?" class="back-link">← Volver al inicio</a>
<?php elseif ($pokemon1 && $pokemon2): ?>

  <a href="?" class="back-link">← Volver al inicio</a>
  
  <section class="compare-container">
    <h1>Comparador de Pokémon</h1>
    
    <div class="pokemon-comparison">
      <!-- Pokémon 1 -->
      <div class="pokemon-card">
        <h2><?= ucfirst($pokemon1['name']) ?></h2>
        <img src="<?= $pokemon1['sprite'] ?>" alt="<?= $pokemon1['name'] ?>">
        <div class="types">
          <?php foreach ($pokemon1['types'] as $type): ?>
            <span class="type <?= $type ?>"><?= ucfirst($type) ?></span>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Tabla de comparación de stats -->
      <div class="stats-comparison">
        <table>
          <thead>
            <tr>
              <th>Stat</th>
              <th><?= ucfirst($pokemon1['name']) ?></th>
              <th><?= ucfirst($pokemon2['name']) ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($pokemon1['stats'] as $index => $stat): ?>
              <?php 
                $value1 = $stat['value'];
                $value2 = $pokemon2['stats'][$index]['value'];
                $winner1 = $value1 > $value2 ? 'winner' : '';
                $winner2 = $value2 > $value1 ? 'winner' : '';
                $tie = $value1 == $value2 ? 'tie' : '';
              ?>
              <tr>
                <td class="stat-name"><?= strtoupper(str_replace('-', ' ', $stat['name'])) ?></td>
                <td class="stat-value <?= $winner1 ?> <?= $tie ?>">
                  <?= $value1 ?>
                  <div class="stat-bar">
                    <div class="stat-fill" style="width: <?= ($value1 / 255 * 100) ?>%"></div>
                  </div>
                </td>
                <td class="stat-value <?= $winner2 ?> <?= $tie ?>">
                  <?= $value2 ?>
                  <div class="stat-bar">
                    <div class="stat-fill" style="width: <?= ($value2 / 255 * 100) ?>%"></div>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <!-- Pokémon 2 -->
      <div class="pokemon-card">
        <h2><?= ucfirst($pokemon2['name']) ?></h2>
        <img src="<?= $pokemon2['sprite'] ?>" alt="<?= $pokemon2['name'] ?>">
        <div class="types">
          <?php foreach ($pokemon2['types'] as $type): ?>
            <span class="type <?= $type ?>"><?= ucfirst($type) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

<?php endif; ?>

<?php require 'layout/footer.php'; ?>

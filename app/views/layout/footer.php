</main>

<footer class="main-footer">
  <div class="footer-container">
    <div class="footer-content">
      <div class="footer-brand">
        <div class="footer-logo">
          <span class="footer-icon">🎮</span>
          <span class="footer-title">PokeDex</span>
        </div>
        <p class="footer-description">Explora el fascinante mundo de los Pokémon. Descubre información detallada de tus criaturas favoritas.</p>
      </div>

      <div class="footer-links">
        <div class="footer-column">
          <h4>Navegación</h4>
          <ul>
            <li><a href="/pokedex/public/">🏠 Inicio</a></li>
            <li><a href="/pokedex/public/?page=favorites">❤️ Favoritos</a></li>
          </ul>
        </div>

        <div class="footer-column">
          <h4>Recursos</h4>
          <ul>
            <li><a href="https://pokeapi.co/" target="_blank">📡 PokéAPI</a></li>
            <li><a href="https://www.pokemon.com/" target="_blank">🌐 Pokémon Official</a></li>
          </ul>
        </div>

        <div class="footer-column">
          <h4>Información</h4>
          <ul>
            <li><span class="footer-stat">📊 <?= date('Y') ?></span></li>
            <li><span class="footer-stat">⚡ Powered by PHP</span></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p class="footer-copyright">
        &copy; <?= date('Y') ?> PokéDex · Hecho con 💜 para los fans de Pokémon
      </p>
      <p class="footer-disclaimer">
        Pokémon y todos los nombres relacionados son marcas registradas de Nintendo, Game Freak y The Pokémon Company.
      </p>
    </div>
  </div>
</footer>

<script src="/pokedex/public/js/app.js"></script>
</body>
</html>

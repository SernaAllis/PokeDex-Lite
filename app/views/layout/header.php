<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PokéDex - Explora el mundo Pokémon</title>
  <link rel="stylesheet" href="/pokedex/public/css/styles.css">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎮</text></svg>">
</head>
<body>

<header class="main-header">
  <div class="header-container">
    <div class="header-brand">
      <a href="/pokedex/public/" class="logo-link">
        <span class="logo-icon">🎮</span>
        <div class="logo-text">
          <span class="logo-title">PokéDex</span>
          <span class="logo-subtitle">Gotta catch 'em all!</span>
        </div>
      </a>
    </div>
    
    <nav class="header-nav">
      <a href="/pokedex/public/" class="nav-link <?= !isset($_GET['page']) ? 'active' : '' ?>">
        <span class="nav-icon">🏠</span>
        <span class="nav-text">Inicio</span>
      </a>
      <a href="/pokedex/public/?page=favorites" class="nav-link <?= isset($_GET['page']) && $_GET['page'] === 'favorites' ? 'active' : '' ?>">
        <span class="nav-icon">❤️</span>
        <span class="nav-text">Favoritos</span>
      </a>
      <a href="/pokedex/public/?page=compare" class="nav-link <?= isset($_GET['page']) && $_GET['page'] === 'compare' ? 'active' : '' ?>">
        <span class="nav-icon">🆚</span>
        <span class="nav-text">Comparar</span>
      </a>
    </nav>

    <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </div>
</header>

<main>

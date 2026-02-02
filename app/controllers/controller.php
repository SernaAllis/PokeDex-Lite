<?php

require '../app/services/pokeApiService.php';
require '../app/services/cacheService.php';

$page = isset($_GET['p']) ? max(1, (int)$_GET['p']) : 1;
$type = $_GET['type'] ?? null;
$view = $_GET['page'] ?? 'home';
$name = $_GET['name'] ?? null;

$limit = 20;
$offset = ($page - 1) * $limit;

$results = [];
$count = 0;



if ($view === 'favorites') {
    require '../app/controllers/favoritesController.php';
    exit;
}


if ($view === 'compare') {
    require '../app/controllers/compareController.php';
    exit;
}


if ($view === 'detail' && $name) {
    $url = "https://pokeapi.co/api/v2/pokemon/$name";

    $data = CacheService::get($url) ?? PokeApiService::get($url);
    if ($data) CacheService::set($url, $data);

    if (!$data) {
        die('Pokémon no encontrado');
    }

    $pokemon = [
        'id' => $data['id'],
        'name' => $data['name'],
        'sprite' => $data['sprites']['front_default'],
        'types' => array_map(fn($t) => $t['type']['name'], $data['types']),
        'stats' => array_map(fn($s) => [
            'name' => $s['stat']['name'],
            'value' => $s['base_stat']
        ], $data['stats']),
        'abilities' => array_map(fn($a) => $a['ability']['name'], $data['abilities']),
    ];

    require '../app/views/detail.php';
    exit;
}

if ($name && $view === 'home') {
    $url = "https://pokeapi.co/api/v2/pokemon/$name";

    $data = CacheService::get($url) ?? PokeApiService::get($url);
    if ($data) CacheService::set($url, $data);

    if (!$data) {
        $error = "El Pokémon no existe";
        require '../app/views/home.php';
        exit;
    }

    // Reutilizamos la vista de detalle
    $pokemon = [
        'id' => $data['id'],
        'name' => $data['name'],
        'sprite' => $data['sprites']['front_default'],
        'types' => array_map(fn($t) => $t['type']['name'], $data['types']),
        'stats' => array_map(fn($s) => [
            'name' => $s['stat']['name'],
            'value' => $s['base_stat']
        ], $data['stats']),
        'abilities' => array_map(fn($a) => $a['ability']['name'], $data['abilities']),
    ];

    require '../app/views/detail.php';
    exit;
}


if ($type) {
    $url = "https://pokeapi.co/api/v2/type/$type";

    $data = CacheService::get($url) ?? PokeApiService::get($url);
    if ($data) CacheService::set($url, $data);

    $all = $data['pokemon'] ?? [];
    $results = array_map(
        fn($p) => $p['pokemon'],
        array_slice($all, $offset, $limit)
    );

    $count = count($all);


} else {
    $url = "https://pokeapi.co/api/v2/pokemon?limit=$limit&offset=$offset";

    $data = CacheService::get($url) ?? PokeApiService::get($url);
    if ($data) CacheService::set($url, $data);

    $results = $data['results'] ?? [];
    $count = $data['count'] ?? 0;
}

require '../app/views/home.php';

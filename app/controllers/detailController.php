<?php

require '../app/services/pokeApiService.php';
require '../app/services/cacheService.php';

// Leer parámetros
$id   = $_GET['id']   ?? null;
$name = $_GET['name'] ?? null;

// Validar entrada
$key = $id ?? $name;

if (!$key) {
    http_response_code(400);
    echo json_encode([
        'error' => 'Debe enviar un ID o nombre de Pokémon'
    ]);
    exit;
}

// URL API
$url = "https://pokeapi.co/api/v2/pokemon/$key";

// Cache primero
$data = CacheService::get($url);

if (!$data) {
    $data = PokeApiService::get($url);
    if ($data) {
        CacheService::set($url, $data);
    }
}

// Manejo de error si no existe
if (!$data) {
    http_response_code(404);
    echo json_encode([
        'error' => 'Pokémon no encontrado'
    ]);
    exit;
}

require '../app/views/detail.php';

echo json_encode([
    'id'         => $data['id'],
    'name'       => $data['name'],
    'sprite'     => $data['sprites']['front_default'],
    'types'      => array_map(fn($t) => $t['type']['name'], $data['types']),
    'stats'      => array_map(fn($s) => [
        'name'  => $s['stat']['name'],
        'value' => $s['base_stat']
    ], $data['stats']),
    'abilities'  => array_map(fn($a) => $a['ability']['name'], $data['abilities'])
]);

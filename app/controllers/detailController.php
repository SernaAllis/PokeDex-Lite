<?php

require '../app/services/pokeApiService.php';
require '../app/services/cacheService.php';

$id   = $_GET['id']   ?? null;
$name = $_GET['name'] ?? null;

$key = $id ?? $name;

if (!$key) {
    http_response_code(400);
    echo json_encode([
        'error' => 'Debe enviar un ID o nombre de Pokémon'
    ]);
    exit;
}

$url = "https://pokeapi.co/api/v2/pokemon/$key";

$data = CacheService::get($url);

if (!$data) {
    $data = PokeApiService::get($url);
    if ($data) {
        CacheService::set($url, $data);
    }
}

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

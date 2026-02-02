<?php

require_once '../app/services/pokeApiService.php';
require_once '../app/services/cacheService.php';

$pokemon1 = null;
$pokemon2 = null;
$error = null;

$id1 = $_GET['id1'] ?? null;
$id2 = $_GET['id2'] ?? null;

if (!$id1 || !$id2) {
    $error = "Debes seleccionar dos Pokémon para comparar";
} else {
    $url1 = "https://pokeapi.co/api/v2/pokemon/$id1";
    $data1 = CacheService::get($url1) ?? PokeApiService::get($url1);
    if ($data1) CacheService::set($url1, $data1);

    if ($data1) {
        $pokemon1 = [
            'id' => $data1['id'],
            'name' => $data1['name'],
            'sprite' => $data1['sprites']['front_default'],
            'types' => array_map(fn($t) => $t['type']['name'], $data1['types']),
            'stats' => array_map(fn($s) => [
                'name' => $s['stat']['name'],
                'value' => $s['base_stat']
            ], $data1['stats']),
        ];
    } else {
        $error = "No se encontró el primer Pokémon";
    }

    $url2 = "https://pokeapi.co/api/v2/pokemon/$id2";
    $data2 = CacheService::get($url2) ?? PokeApiService::get($url2);
    if ($data2) CacheService::set($url2, $data2);

    if ($data2) {
        $pokemon2 = [
            'id' => $data2['id'],
            'name' => $data2['name'],
            'sprite' => $data2['sprites']['front_default'],
            'types' => array_map(fn($t) => $t['type']['name'], $data2['types']),
            'stats' => array_map(fn($s) => [
                'name' => $s['stat']['name'],
                'value' => $s['base_stat']
            ], $data2['stats']),
        ];
    } else {
        $error = "No se encontró el segundo Pokémon";
    }
}

require '../app/views/compare.php';

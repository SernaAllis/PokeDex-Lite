<?php

require '../app/services/favoritesService.php';


$action = $_GET['action'] ?? null;
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;


if ($action && $id) {

    if ($action === 'add') {
        FavoritesService::add([
            'id' => $id,
            'name' => $_GET['name'] ?? '',
            'sprite' => $_GET['sprite'] ?? ''
        ]);
    }

    if ($action === 'remove') {
        FavoritesService::remove($id);
    }

    header('Location: ?page=favorites');
    exit;
}


$favorites = FavoritesService::all();
require '../app/views/favorites.php';

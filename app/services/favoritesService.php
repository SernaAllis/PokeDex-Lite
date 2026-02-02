<?php

class FavoritesService {

private static string $file = __DIR__ . '/../../storage/favorites.json';

    private static function read(): array
    {
        if (!file_exists(self::$file)) {
            return [];
        }

        return json_decode(file_get_contents(self::$file), true) ?? [];
    }

    private static function write(array $data): void
    {
        file_put_contents(self::$file, json_encode($data, JSON_PRETTY_PRINT));
    }

    public static function all(): array
    {
        return self::read();
    }

    public static function exists(int $id): bool
    {
        $favorites = self::read();
        return isset($favorites[$id]);
    }

    public static function add(array $pokemon): void
    {
        $favorites = self::read();
        $favorites[$pokemon['id']] = $pokemon;
        self::write($favorites);
    }

    public static function remove(int $id): void
    {
        $favorites = self::read();
        unset($favorites[$id]);
        self::write($favorites);
    }
}

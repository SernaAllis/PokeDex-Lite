<?php

class CacheService {

    private static $path = "../storage/cache/";
    private static $ttl = 600; // 10 minutos

    public static function get(string $key): ?array {
        $file = self::$path . md5($key) . '.json';

        if (!file_exists($file)) {
            return null;
        }

        if ((time() - filemtime($file)) > self::$ttl) {
            return null;
        }

        return json_decode(file_get_contents($file), true);
    }

    public static function set(string $key, array $data): void {
        $file = self::$path . md5($key) . '.json';
        file_put_contents($file, json_encode($data));
    }
}

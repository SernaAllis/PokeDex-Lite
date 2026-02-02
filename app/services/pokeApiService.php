<?php

class PokeApiService {
    public static function get($url) {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10
        ]);

        $response = curl_exec($ch);

        if ($response === false) {
            return null;
        }

        curl_close($ch);
        return json_decode($response, true);
    }
}

<?php

if (!function_exists('docker_secret')) {
    function docker_secret($secret_name, $default = null) {
        $secretFile = "/run/secrets/{$secret_name}";
        
        if (file_exists($secretFile)) {
            return trim(file_get_contents($secretFile));
        }
        
        // Fallback to environment variable for local development
        $env_var = strtoupper($secret_name);
        return env($env_var, $default);
    }
}
 <?php

function docker_secret(string $secret_file): string
{
    return trim(file_get_contents($secret_file));
}
